        $today_date = Carbon::now()->format('Y-m-d');
        $user_session = Session::get('user_session');
        $current_user_id = $user_session->id;
        $sales_audit_records = array();

        $all_sales_records_for_audit = Sales::get_sales_details_in_group();
        if (count($all_sales_records_for_audit) > 0) {
            foreach ($all_sales_records_for_audit as $sales_record) {
                $product_id = $sales_record->product_id;

                $last_sale_under_each_product_id = Sales::select_last_sale_under_each_product_id($product_id);
                if(count($last_sale_under_each_product_id) > 0){
                    foreach ($last_sale_under_each_product_id as $last_sale) {
                        $main_product_id = $last_sale->product_id;
                        $product_name = $last_sale->name;
                        $price_per_item = $last_sale->price_per_item;
                        $stock_left = $last_sale->stock_after;

                        //====Save in Sales Audit DB ==============
                        $sales_audit = new SalesAudit();
                        $sales_audit->user_id = $current_user_id;
                        $sales_audit->product_id = $main_product_id;
                        $sales_audit->starting_stock = $stock_left;
                        $sales_audit->sales_date = $today_date;
                        $sales_audit->save();

                        array_push( $sales_audit_records, ['product_name' => $product_name, 'price_per_item'=> $price_per_item, 'stock_left'=>$stock_left]);

                    }
                }
            }
        }
        $all_sales_audit_records = json_encode($sales_audit_records);




========== IF THERE IS NO SALES AUDIT PICK FROM WAREHOUSE LOGS TABLE ===================
$sales_audit_records = SalesAudit::all();
if(count($sales_audit_records) > 0){
    $all_sales_audit_records = json_encode($sales_audit_records);
    dd($all_sales_audit_records);
}
else{
    $all_transfer_records = WarehouseLogs::get_transfer_details_in_group();

    $get_all_transactions = array();
    if (count($all_transfer_records) > 0) {
        foreach ($all_transfer_records as $transfer_record) {
            $product_id = $transfer_record->product_id;

            $get_all_with_each_product_id = WarehouseLogs::select_all_under_each_product_id($product_id);

            $product_name = $get_all_with_each_product_id[0]->name;
            $original_stock = $get_all_with_each_product_id[0]->original_stock;
            $price_per_item = $get_all_with_each_product_id[0]->price_per_item;

            $count_product_ids_array = count($get_all_with_each_product_id);

            $quantity_transfered = 0;
            $expected_price = 0;

            for ($i=0; $i < $count_product_ids_array; $i++) {
                $quantity_transfered = (double)$quantity_transfered + (double)$get_all_with_each_product_id[$i]->quantity_transfered_in_pieces;

                $expected_price = (double)$expected_price + (double)$get_all_with_each_product_id[$i]->expected_price;
            }

            array_push( $get_all_transactions, ['product_name' => $product_name, 'original_stock'=> $original_stock, 'stock_left'=>$quantity_transfered, 'total_expected_price'=>$expected_price, 'price_per_item'=>$price_per_item]);
        }

    }
    // dd($get_all_transactions);
    // $all_sales_audit_records = $get_all_transactions;
    $all_sales_audit_records = json_encode($get_all_transactions);
} //, 'all_sales_audit_records'





        $today_date = Carbon::now()->format('Y-m-d');
        $user_session = Session::get('user_session');
        $current_user_id = $user_session->id;
        $sales_audit_records = array();

        $all_sales_records_for_audit = Sales::get_sales_details_in_group();
        if (count($all_sales_records_for_audit) > 0) {
            foreach ($all_sales_records_for_audit as $sales_record) {
                $product_id = $sales_record->product_id;

                $last_sale_under_each_product_id = Sales::select_last_sale_under_each_product_id($product_id);
                if(count($last_sale_under_each_product_id) > 0){
                    foreach ($last_sale_under_each_product_id as $last_sale) {
                        $main_product_id = $last_sale->product_id;
                        $product_name = $last_sale->name;
                        $price_per_item = $last_sale->price_per_item;
                        $stock_left = $last_sale->stock_after;

                        //====Save in Sales Audit DB ==============
                        $get_all_from_sales_audit = SalesAudit::find($main_product_id);
                        if(count($get_all_from_sales_audit) > 0){
                            $sales_audit = SalesAudit::find($main_product_id);
                            // $sales_audit->user_id = $current_user_id;
                            // $sales_audit->product_id = $main_product_id;
                            $sales_audit->starting_stock = $stock_left;
                            $sales_audit->sales_date = $today_date;
                            $sales_audit->save();
                        }
                        else{
                            $sales_audit = new SalesAudit();
                            $sales_audit->user_id = $current_user_id;
                            $sales_audit->product_id = $main_product_id;
                            $sales_audit->starting_stock = $stock_left;
                            $sales_audit->sales_date = $today_date;
                            $sales_audit->save();
                        }


                        // array_push( $sales_audit_records, ['product_name' => $product_name, 'price_per_item'=> $price_per_item, 'stock_left'=>$stock_left]);

                    }
                }
            }
        }
