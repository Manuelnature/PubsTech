
====================== TRANSFER CONTROLLER INITIAL CODE (TRANSFER STOCK METHOD )=========================

public function transfer_stock(Request $request){
        // dd($request->all());
        $request->validate([
            'txt_product_id' => 'required',
            'txt_quantity_to_transfer_in_crate' => 'regex:/^[0-9\s]+$/|nullable',
            'txt_quantity_to_transfer_in_pieces' => 'regex:/^[0-9\s]+$/|nullable',
            'txt_collected_by' => 'required',
            'txt_collected_at' => 'required',
            ], [
            'txt_product_id.required' => 'Product Name is required',
            'txt_quantity_to_transfer_in_crate.regex' => 'Quantity must be in numbers only',
            'txt_quantity_to_transfer_in_pieces.regex' => 'Quantity must be in numbers only',
            'txt_collected_by.required' => 'Collected By is required',
            'txt_collected_at.required' => 'Date Collected is required',
        ]);

        $user_session = Session::get('user_session');
        $active_user = $user_session->first_name." ".$user_session->last_name;

        $product_id = $request->get('txt_product_id');

        if ($request->get('txt_quantity_to_transfer_in_crate') != "" || $request->get('txt_quantity_to_transfer_in_crate') != NULL) {
            $quantity_in_crate = $request->get('txt_quantity_to_transfer_in_crate');
        }
        else {
            $quantity_in_crate = 0;
        }

        if ($request->get('txt_quantity_to_transfer_in_pieces') != "" || $request->get('txt_quantity_to_transfer_in_pieces') != NULL) {
            $quantity_in_pieces = $request->get('txt_quantity_to_transfer_in_pieces');
        } else {
            $quantity_in_pieces = 0;
        }

        $remarks = $request->get('txt_remarks');
        $collected_by = $request->get('txt_collected_by');
        $date_collected = $request->get('txt_collected_at');


        // $get_stock_records = Warehouse::find($product_id);
        $get_stock_records = Warehouse::where('product_id', $product_id)->get()[0];


        // dd($get_stock_records);

        $warehouse_id_of_product = $get_stock_records->id;
        $current_original_stock = $get_stock_records->total_items;
        $total_price = $get_stock_records->total_price;
        $price_per_piece = $get_stock_records->price_per_piece;
        $quantity_per_crate = $get_stock_records->quantity_per_crate;

        $quantity_transfered = ((double)($quantity_per_crate) * (double)($quantity_in_crate)) + (double)($quantity_in_pieces);

        // $get_product_details_from_warehouse_logs = WarehouseLogs::select_product($product_id);
        $get_product_details_from_warehouse_logs = WarehouseLogs::where('product_id', $product_id)->get();
        // dd($get_product_details_from_warehouse_logs);

        if (count($get_product_details_from_warehouse_logs) > 0){

            $previous_original_stock = $get_product_details_from_warehouse_logs[0]->original_stock;
            $previous_stock_before = $get_product_details_from_warehouse_logs[0]->stock_before;
            $previous_stock_after = $get_product_details_from_warehouse_logs[0]->stock_after;

            if (($current_original_stock - $previous_original_stock) == 0) {

                $original_stock = $previous_original_stock;
                $stock_before = $previous_stock_after;

                if (($stock_before - $quantity_transfered) >= 0) {
                    $stock_after =  $stock_before - $quantity_transfered;
                }
                else {
                    Alert::toast('Quantity left is not up to the transfer requested','warning');
                    return redirect()->back();
                }

            }
            elseif (($current_original_stock - $previous_original_stock) > 0) {
                $original_stock = $current_original_stock;
                $difference_in_stock = $current_original_stock - $previous_original_stock;
                $stock_before = $previous_stock_after + $difference_in_stock;
                // $stock_after = $stock_before - $quantity_transfered;

                if (($stock_before - $quantity_transfered) >= 0) {
                    $stock_after =  $stock_before - $quantity_transfered;
                } else {
                    Alert::toast('Quantity left is not up to the transfer requested','warning');
                    return redirect()->back();
                }
            }
            else {
                Alert::toast('Invalid Transfer','warning');
                return redirect()->back();
            }

            $expected_price = ((double)$stock_before - (double)$stock_after) * (double)$price_per_piece;

            //============ SAVE IN WAREHOUSE_LOGS DB ==============
            $warehouse_logs = new WarehouseLogs();
            $warehouse_logs->product_id = $product_id;
            $warehouse_logs->price_per_piece = $price_per_piece;
            $warehouse_logs->quantity_transfered_in_pieces = $quantity_transfered;
            $warehouse_logs->original_stock = $original_stock;
            $warehouse_logs->stock_before = $stock_before;
            $warehouse_logs->stock_after = $stock_after;
            $warehouse_logs->expected_price = $expected_price;
            $warehouse_logs->collected_by = $collected_by;
            $warehouse_logs->collected_at = $date_collected;
            $warehouse_logs->remarks = $remarks;
            $warehouse_logs->created_by = $active_user;
            $warehouse_logs->save();


            // ============ UPDATING WAREHOUSE DB AFTER TRANSFER ==============
            if (($quantity_transfered / $quantity_per_crate) > 0) {
                $pieces_transfered = $quantity_transfered % $quantity_per_crate;
                $crates_transfered = (int)($quantity_transfered / $quantity_per_crate);
            } else {
                $pieces_transfered = $quantity_in_pieces;
                $crates_transfered = $quantity_in_crate;
            }

            $get_warehouse_records_of_the_product = Warehouse::find($warehouse_id_of_product);
            $total_items_from_warehouse = $get_warehouse_records_of_the_product->total_items;
            $total_crates_from_warehouse = $get_warehouse_records_of_the_product->no_of_crates;
            $total_pieces_from_warehouse = $get_warehouse_records_of_the_product->no_of_pieces;
            $total_expected_from_warehouse = $get_warehouse_records_of_the_product->expected_price;

            $get_warehouse_records_of_the_product->total_items = (int)$total_items_from_warehouse - (int)$quantity_transfered;
            $get_warehouse_records_of_the_product->no_of_crates = (int)$total_crates_from_warehouse - (int)$crates_transfered;
            $get_warehouse_records_of_the_product->no_of_pieces = (int)$total_pieces_from_warehouse - (int)$pieces_transfered;
            $get_warehouse_records_of_the_product->total_price = (int)$total_expected_from_warehouse - (int)$expected_price;
            $get_warehouse_records_of_the_product->save();
        }
        else {
            //============= SAVE IN WAREHOUSE_LOGS DB ==============
           $original_stock = $current_original_stock;
           $stock_before = $current_original_stock;

           if (($stock_before - $quantity_transfered) >= 0) {
            $stock_after =  $stock_before - $quantity_transfered;
            } else {
                Alert::toast('Quantity left is not up to the transfer requested','warning');
                return redirect()->back();
            }

           $expected_price = ((double)$stock_before - (double)$stock_after) * (double)$price_per_piece;

           $warehouse_logs = new WarehouseLogs();
           $warehouse_logs->product_id = $product_id;
           $warehouse_logs->price_per_piece = $price_per_piece;
           $warehouse_logs->quantity_transfered_in_pieces = $quantity_transfered;
           $warehouse_logs->original_stock = $original_stock;
           $warehouse_logs->stock_before = $stock_before;
           $warehouse_logs->stock_after = $stock_after;
           $warehouse_logs->expected_price = $expected_price;
           $warehouse_logs->collected_by = $collected_by;
           $warehouse_logs->collected_at = $date_collected;
           $warehouse_logs->remarks = $remarks;
           $warehouse_logs->created_by = $active_user;
           $warehouse_logs->save();


           // ============ UPDATING WAREHOUSE DB AFTER TRANSFER ==============
           if (($quantity_transfered / $quantity_per_crate) > 0) {
                $pieces_transfered = $quantity_transfered % $quantity_per_crate;
                $crates_transfered = (int)($quantity_transfered / $quantity_per_crate);
            } else {
                $pieces_transfered = $quantity_in_pieces;
                $crates_transfered = $quantity_in_crate;
            }
            dump('Pieces Transfered: '.$pieces_transfered);
            dump('Crates Transfered: '.$crates_transfered);

            $get_warehouse_records_of_the_product = Warehouse::find($warehouse_id_of_product);

            $total_items_from_warehouse = $get_warehouse_records_of_the_product->total_items;
            $total_price_from_warehouse = $get_warehouse_records_of_the_product->total_price;
            // $total_crates_from_warehouse = $get_warehouse_records_of_the_product->no_of_crates;
            // $total_pieces_from_warehouse = $get_warehouse_records_of_the_product->no_of_pieces;


            $total_items_left = (int)$total_items_from_warehouse - (int)$quantity_transfered;

            if (($total_items_left / $quantity_per_crate) > 0 ) {
                $total_pieces_left = $total_items_left % $quantity_per_crate;
                $total_crates_left = (int)($total_items_left / $quantity_per_crate);
            } else {
                $total_pieces_left = $total_items_left;
                $total_crates_left = 0;
            }

            $total_amount_left = (double)$total_items_left * (double)$price_per_piece;


            $get_warehouse_records_of_the_product->total_items = $total_items_left;
            $get_warehouse_records_of_the_product->no_of_crates = $total_crates_left;
            $get_warehouse_records_of_the_product->no_of_pieces = $total_pieces_left;
            $get_warehouse_records_of_the_product->total_price = $total_amount_left;
            $get_warehouse_records_of_the_product->save();
        }

       Alert::toast('Product Transfered Successfully','success');
       return redirect()->back();

}




====================== ONLY THE IF ELSE STATEMENT (TRANSFER STOCK METHOD )=========================
$get_product_details_from_warehouse_logs = WarehouseLogs::where('product_id', $product_id)->get();

if (count($get_product_details_from_warehouse_logs) > 0){

    $previous_original_stock = $get_product_details_from_warehouse_logs[0]->original_stock;
    $previous_stock_before = $get_product_details_from_warehouse_logs[0]->stock_before;
    $previous_stock_after = $get_product_details_from_warehouse_logs[0]->stock_after;

    if (($current_original_stock - $previous_original_stock) == 0) {

        $original_stock = $previous_original_stock;
        $stock_before = $previous_stock_after;

        if (($stock_before - $quantity_transfered) >= 0) {
            $stock_after =  $stock_before - $quantity_transfered;
        }
        else {
            Alert::toast('Quantity left is not up to the transfer requested','warning');
            return redirect()->back();
        }

    }
    elseif (($current_original_stock - $previous_original_stock) > 0) {
        $original_stock = $current_original_stock;
        $difference_in_stock = $current_original_stock - $previous_original_stock;
        $stock_before = $previous_stock_after + $difference_in_stock;
        // $stock_after = $stock_before - $quantity_transfered;

        if (($stock_before - $quantity_transfered) >= 0) {
            $stock_after =  $stock_before - $quantity_transfered;
        } else {
            Alert::toast('Quantity left is not up to the transfer requested','warning');
            return redirect()->back();
        }
    }
    else {
        Alert::toast('Invalid Transfer','warning');
        return redirect()->back();
    }

    $expected_price = ((double)$stock_before - (double)$stock_after) * (double)$price_per_piece;

    //============ SAVE IN WAREHOUSE_LOGS DB ==============
    $warehouse_logs = new WarehouseLogs();
    $warehouse_logs->product_id = $product_id;
    $warehouse_logs->price_per_piece = $price_per_piece;
    $warehouse_logs->quantity_transfered_in_pieces = $quantity_transfered;
    $warehouse_logs->original_stock = $original_stock;
    $warehouse_logs->stock_before = $stock_before;
    $warehouse_logs->stock_after = $stock_after;
    $warehouse_logs->expected_price = $expected_price;
    $warehouse_logs->collected_by = $collected_by;
    $warehouse_logs->collected_at = $date_collected;
    $warehouse_logs->remarks = $remarks;
    $warehouse_logs->created_by = $active_user;
    $warehouse_logs->save();


    // ============ UPDATING WAREHOUSE DB AFTER TRANSFER ==============
    if (($quantity_transfered / $quantity_per_crate) > 0) {
        $pieces_transfered = $quantity_transfered % $quantity_per_crate;
        $crates_transfered = (int)($quantity_transfered / $quantity_per_crate);
    } else {
        $pieces_transfered = $quantity_in_pieces;
        $crates_transfered = $quantity_in_crate;
    }

    $get_warehouse_records_of_the_product = Warehouse::find($warehouse_id_of_product);
    $total_items_from_warehouse = $get_warehouse_records_of_the_product->total_items;
    $total_crates_from_warehouse = $get_warehouse_records_of_the_product->no_of_crates;
    $total_pieces_from_warehouse = $get_warehouse_records_of_the_product->no_of_pieces;
    $total_expected_from_warehouse = $get_warehouse_records_of_the_product->expected_price;

    $get_warehouse_records_of_the_product->total_items = (int)$total_items_from_warehouse - (int)$quantity_transfered;
    $get_warehouse_records_of_the_product->no_of_crates = (int)$total_crates_from_warehouse - (int)$crates_transfered;
    $get_warehouse_records_of_the_product->no_of_pieces = (int)$total_pieces_from_warehouse - (int)$pieces_transfered;
    $get_warehouse_records_of_the_product->total_price = (int)$total_expected_from_warehouse - (int)$expected_price;
    $get_warehouse_records_of_the_product->save();
}
else {
    //========================= SAVE IN WAREHOUSE_LOGS DB =================================
   $original_stock = $current_original_stock;
   $stock_before = $current_original_stock;

   if (($stock_before - $quantity_transfered) >= 0) {
    $stock_after =  $stock_before - $quantity_transfered;
    } else {
        Alert::toast('Quantity left is not up to the transfer requested','warning');
        return redirect()->back();
    }

   $expected_price = ((double)$stock_before - (double)$stock_after) * (double)$price_per_piece;

   $warehouse_logs = new WarehouseLogs();
   $warehouse_logs->product_id = $product_id;
   $warehouse_logs->price_per_piece = $price_per_piece;
   $warehouse_logs->quantity_transfered_in_pieces = $quantity_transfered;
   $warehouse_logs->original_stock = $original_stock;
   $warehouse_logs->stock_before = $stock_before;
   $warehouse_logs->stock_after = $stock_after;
   $warehouse_logs->expected_price = $expected_price;
   $warehouse_logs->collected_by = $collected_by;
   $warehouse_logs->collected_at = $date_collected;
   $warehouse_logs->remarks = $remarks;
   $warehouse_logs->created_by = $active_user;
   $warehouse_logs->save();


   // ============ UPDATING WAREHOUSE DB AFTER TRANSFER ==============
   if (($quantity_transfered / $quantity_per_crate) > 0) {
        $pieces_transfered = $quantity_transfered % $quantity_per_crate;
        $crates_transfered = (int)($quantity_transfered / $quantity_per_crate);
    } else {
        $pieces_transfered = $quantity_in_pieces;
        $crates_transfered = $quantity_in_crate;
    }
    dump('Pieces Transfered: '.$pieces_transfered);
    dump('Crates Transfered: '.$crates_transfered);

    $get_warehouse_records_of_the_product = Warehouse::find($warehouse_id_of_product);

    $total_items_from_warehouse = $get_warehouse_records_of_the_product->total_items;
    $total_price_from_warehouse = $get_warehouse_records_of_the_product->total_price;
    // $total_crates_from_warehouse = $get_warehouse_records_of_the_product->no_of_crates;
    // $total_pieces_from_warehouse = $get_warehouse_records_of_the_product->no_of_pieces;


    $total_items_left = (int)$total_items_from_warehouse - (int)$quantity_transfered;

    if (($total_items_left / $quantity_per_crate) > 0 ) {
        $total_pieces_left = $total_items_left % $quantity_per_crate;
        $total_crates_left = (int)($total_items_left / $quantity_per_crate);
    } else {
        $total_pieces_left = $total_items_left;
        $total_crates_left = 0;
    }

    $total_amount_left = (double)$total_items_left * (double)$price_per_piece;


    $get_warehouse_records_of_the_product->total_items = $total_items_left;
    $get_warehouse_records_of_the_product->no_of_crates = $total_crates_left;
    $get_warehouse_records_of_the_product->no_of_pieces = $total_pieces_left;
    $get_warehouse_records_of_the_product->total_price = $total_amount_left;
    $get_warehouse_records_of_the_product->save();
}
