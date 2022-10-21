<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Warehouse;
use App\Models\WarehouseLogs;
use App\Models\Retail;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use Carbon\Carbon;
use Log;

class TransferController extends Controller
{
    public function index(){
        // $all_products = Products::all();
        // $all_products = Products::where('status', 'Active')->get();
        $all_products = Products::select_products_in_warehouse();
        // dd($all_products);
        // $all_products_id = Warehouse::select_all_product_ids();
        // foreach ($all_products_id as $product) {
        //     $select_product_name = Products::select_product($product->product_id);
        //     dd($select_product_name);
        // }
        // dd($all_products);
        $all_users = User::all();
        $all_transfer_records = WarehouseLogs::get_transfer_details();


        //=========== Latest Transfers ========
        $latest_transfers = $this->last_product_transfer();


        return view('pages.transfer', compact('all_products', 'all_users', 'all_transfer_records', 'latest_transfers'));
    }


    public function last_product_transfer(){
        $all_transfer_records = WarehouseLogs::get_transfer_details_in_group();

        $get_latest_transfers = array();

        if (count($all_transfer_records) > 0) {
            foreach ($all_transfer_records as $transfer_record) {
                $product_id = $transfer_record->product_id;

                $get_last_transfer_under_product_id = WarehouseLogs::select_last_transfer_under_each_product_id($product_id);
                // dump($get_last_transfer_under_product_id);
                $date_created = $get_last_transfer_under_product_id[0]->created_at;
                // dump($date_created);

                array_push( $get_latest_transfers, ['product_id' => $product_id, 'created_at'=> $date_created]);
            }
            return $get_latest_transfers;
        }
    }

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


        $warehouse_id_of_product = $get_stock_records->id;
        $current_original_stock = $get_stock_records->total_items;
        $total_price = $get_stock_records->total_price;
        $price_per_piece = $get_stock_records->price_per_piece;
        $quantity_per_crate = $get_stock_records->quantity_per_crate;

        $quantity_transfered = ((double)($quantity_per_crate) * (double)($quantity_in_crate)) + (double)($quantity_in_pieces);

        // $get_product_details_from_warehouse_logs = WarehouseLogs::select_product($product_id);

        // $get_product_details_from_warehouse_logs = WarehouseLogs::where('product_id', $product_id)->get();
        // dd($get_product_details_from_warehouse_logs);


            $original_stock = $current_original_stock;
            $stock_before = $current_original_stock;

           if (($stock_before - $quantity_transfered) >= 0) {
                $stock_after =  (int)$stock_before - (int)$quantity_transfered;
            }
            else {
                Alert::toast('Quantity left is not up to the transfer requested','warning');
                return redirect()->back();
            }



            //================ GET CRATES AND PIECES TRANSFERED ==========================
                if (($quantity_transfered / $quantity_per_crate) > 0) {
                        $pieces_transfered = $quantity_transfered % $quantity_per_crate;
                        $crates_transfered = (int)($quantity_transfered / $quantity_per_crate);
                    } else {
                        $pieces_transfered = $quantity_in_pieces;
                        $crates_transfered = $quantity_in_crate;
                    }
                // dump('Pieces Transfered: '.$pieces_transfered);
                // dd('Crates Transfered: '.$crates_transfered);


           $expected_price = ((double)$stock_before - (double)$stock_after) * (double)$price_per_piece;

           $warehouse_logs = new WarehouseLogs();
           $warehouse_logs->product_id = $product_id;
           $warehouse_logs->price_per_piece = $price_per_piece;
        //    $warehouse_logs->quantity_transfered_in_pieces = $quantity_transfered;
           $warehouse_logs->quantity_transfered_in_crates = $crates_transfered;
           $warehouse_logs->quantity_transfered_in_pieces = $pieces_transfered;
           $warehouse_logs->total_quantity_transfered = $quantity_transfered;
           $warehouse_logs->original_stock = $original_stock;
           $warehouse_logs->stock_before = $stock_before;
           $warehouse_logs->stock_after = $stock_after;
           $warehouse_logs->expected_price = $expected_price;
           $warehouse_logs->collected_by = $collected_by;
           $warehouse_logs->collected_at = $date_collected;
           $warehouse_logs->remarks = $remarks;
           $warehouse_logs->created_by = $active_user;
           $warehouse_logs->save();


        //    ================ GET CRATES AND PIECES TRANSFERED ==========================
        //    if (($quantity_transfered / $quantity_per_crate) > 0) {
        //         $pieces_transfered = $quantity_transfered % $quantity_per_crate;
        //         $crates_transfered = (int)($quantity_transfered / $quantity_per_crate);
        //     } else {
        //         $pieces_transfered = $quantity_in_pieces;
        //         $crates_transfered = $quantity_in_crate;
        //     }
        //     dump('Pieces Transfered: '.$pieces_transfered);
        //     dump('Crates Transfered: '.$crates_transfered);




            // ============ UPDATING RETAIL TABLE AFTER TRANSFER ==============
           $check_product_in_retail = Retail::where('product_id', $product_id)->get();

           if(count($check_product_in_retail) > 0){
                $check_product_in_retail = $check_product_in_retail[0];
                $retail_id_of_product =  $check_product_in_retail->id;
                $previous_total_stock = $check_product_in_retail->total_quantity;
                $previous_stock_after = $check_product_in_retail->stock_after;
                $previous_no_of_crates = $check_product_in_retail->no_of_crates;

                $all_pieces = $check_product_in_retail->no_of_pieces +  $pieces_transfered;

                if (($all_pieces / $quantity_per_crate) > 0 ) {
                    $new_number_of_pieces = $all_pieces % $quantity_per_crate;
                    $new_number_of_crates = $crates_transfered + (int)($all_pieces / $quantity_per_crate);
                }
                else{
                    $new_number_of_pieces = $pieces_transfered;
                    $new_number_of_crates = $crates_transfered;
                }

                // $retail_stock_before = $previous_stock_after;
                // $retail_stock_after = $stock_before + $quantity_transfered;


                $retail_stock_before = $previous_total_stock;
                $retail_stock_after = $retail_stock_before + $quantity_transfered;

                $current_date_and_time = Carbon::now()->toDateTimeString();


                $update_retail = Retail::find($retail_id_of_product);

                $new_total_quantity = (int)$update_retail->total_quantity + (int)$quantity_transfered;
                $new_total_amount = (double)$update_retail->total_amount + (double)$expected_price;
                // $new_number_of_crates = $crates_transfered;
                // $new_number_of_pieces = $pieces_transfered;

                $update_retail->price_per_piece = $price_per_piece;
                $update_retail->stock_before = $retail_stock_before;
                $update_retail->stock_after = $retail_stock_after;
                $update_retail->no_of_crates = $previous_no_of_crates + $new_number_of_crates;
                $update_retail->no_of_pieces = $new_number_of_pieces;
                $update_retail->total_quantity = $new_total_quantity;
                $update_retail->total_amount = $new_total_amount;
                $update_retail->updated_at = $current_date_and_time;
                $update_retail->save();
           }
           else {
                $retail_stock_before = 0;
                $retail_stock_before = $quantity_transfered;

                $retail = new Retail();
                $retail->product_id =  $product_id;
                $retail->price_per_piece = $price_per_piece;
                $retail->stock_before = $stock_before;
                $retail->stock_after = $stock_after;
                $retail->no_of_crates = $crates_transfered;
                $retail->no_of_pieces = $pieces_transfered;
                $retail->total_quantity = $quantity_transfered;
                $retail->total_amount = $expected_price;
                $retail->save();
           }


           // ============ UPDATING WAREHOUSE TABLE AFTER TRANSFER ==============

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


            // ======== Getting product threshold from the product table ===========
            $get_product = Products::find($product_id);
            $product_threshold = $get_product->stock_threshold;

            if ($total_items_left <= $product_threshold) {
                Log::channel('my_logs')->info('Threshold met again');
                Alert::info('Transfer successful', 'You are running out of stock, Please restock');
                // Alert::toast('You are running out of stock, Please restock','warning');
            }
            else{
                Alert::toast('Product Transfered Successfully','success');
            }


            return redirect()->back();
    }



    public function update_transfer (Request $request){
        // dd($request->all());
        try {
            $user_session = Session::get('user_session');
            $active_user = $user_session->first_name." ".$user_session->last_name;

            $transfer_id = $request->get('txt_transfer_id');
            $product_id = $request->get('txt_product_id');
            // $product_name = $request->get('txt_edit_product_name');
            // $total_quantity_transfered = $request->get('txt_edit_total_quantity_transfered');
            $quantity_transfered_in_crates = $request->get('txt_edit_quantity_transfered_in_crates');
            $quantity_transfered_in_pieces = $request->get('txt_edit_quantity_transfered_in_pieces');

            $remarks = $request->get('txt_edit_remarks');
            $collected_by = $request->get('txt_edit_collected_by');
            $date_collected = $request->get('txt_edit_collected_at');

            $get_stock_records_form_warehouse = Warehouse::where('product_id', $product_id)->get()[0];
            $warehouse_id = $get_stock_records_form_warehouse->id;
            $price_per_piece = $get_stock_records_form_warehouse->price_per_piece;
            $quantity_per_crate = $get_stock_records_form_warehouse->quantity_per_crate;
            $previous_warehouse_total_items = $get_stock_records_form_warehouse->total_items;
            $previous_warehouse_total_price = $get_stock_records_form_warehouse->total_price;



            $new_total_quantity_transfered = (int)($quantity_transfered_in_crates) * (int)($quantity_per_crate) + $quantity_transfered_in_pieces;

            // if ($new_total_quantity_transfered > $previous_warehouse_total_items) {
            //     Alert::toast('Quantity left is not up to the transfer requested','warning');
            //     return redirect()->back();
            // }



             //================ GET CRATES AND PIECES TRANSFERED ==========================
             if (($new_total_quantity_transfered / $quantity_per_crate) > 0) {
                $pieces_transfered = $new_total_quantity_transfered % $quantity_per_crate;
                $crates_transfered = (int)($new_total_quantity_transfered / $quantity_per_crate);
            } else {
                $pieces_transfered = $quantity_transfered_in_pieces;
                $crates_transfered = $quantity_transfered_in_crates;
            }
            // dump('Pieces Transfered: '.$pieces_transfered);
            // dd('Crates Transfered: '.$crates_transfered);


            $get_stock_records_form_retail = Retail::where('product_id', $product_id)->get()[0];
            $retail_id = $get_stock_records_form_retail->id;
            $previous_retail_total_quantity = $get_stock_records_form_retail->total_quantity;
            $previous_retail_total_amount = $get_stock_records_form_retail->total_amount;



            $transfer_records_from_warehouse_logs = WarehouseLogs::find($transfer_id);
            // $previous_warehouse_logs_quantity_transfered = $transfer_records_from_warehouse_logs->total_quantity_transfered;

            $previous_total_quantity_transfer = $transfer_records_from_warehouse_logs->total_quantity_transfered;
            $previous_stock_after = $transfer_records_from_warehouse_logs->stock_after;

            // dd( $transfer_records_from_warehouse_logs->product_id);

            if ($new_total_quantity_transfered > $previous_total_quantity_transfer && $new_total_quantity_transfered > $previous_warehouse_total_items) {
                Alert::toast('Quantity left is not up to the transfer requested','warning');
                return redirect()->back();
            }


            // if ($transfer_records_from_warehouse_logs->product_id == $product_id) {



                $difference_in_quantity = $new_total_quantity_transfered - $previous_total_quantity_transfer;

                if ($difference_in_quantity > 0 ) {
                    $new_total = $previous_total_quantity_transfer + $difference_in_quantity;

                    $new_stock_after = $previous_stock_after - $difference_in_quantity;

                    // $new_warehouse_total_items = $previous_warehouse_total_items + $difference_in_quantity;
                    $new_warehouse_total_items = $previous_warehouse_total_items - $difference_in_quantity;

                    // $new_retail_total_items = $previous_retail_total_quantity - $difference_in_quantity;
                    $new_retail_total_items = $previous_retail_total_quantity + $difference_in_quantity;
                }
                elseif ($difference_in_quantity < 0 ) {
                    $new_total = $previous_total_quantity_transfer - abs($difference_in_quantity);

                    $new_stock_after = $previous_stock_after + abs($difference_in_quantity);

                    $new_warehouse_total_items = $previous_warehouse_total_items + abs($difference_in_quantity);

                    $new_retail_total_items = $previous_retail_total_quantity - abs($difference_in_quantity);
                }
                else{
                    $new_total = $previous_total_quantity_transfer;

                    $new_stock_after = $previous_stock_after;

                    $new_warehouse_total_items = $previous_warehouse_total_items;

                    $new_retail_total_items = $previous_retail_total_quantity;
                }

                $expected_price = (double)$new_total * (double)$price_per_piece;

                // =====warehouse total price
                $warehouse_new_total_price = (double)$new_warehouse_total_items * (double)$price_per_piece;

                $retail_new_total_amount = (double)$new_retail_total_items * (double)$price_per_piece;



                // =========== UPDATING WAREHOUSE LOGS TABLE =============

                    if (($new_total_quantity_transfered / $quantity_per_crate) > 0 ) {
                        $new_total_pieces = $new_total_quantity_transfered % $quantity_per_crate;
                        $new_total_crates = (int)($new_total_quantity_transfered / $quantity_per_crate);
                    } else {
                        $new_total_pieces = $new_total_quantity_transfered;
                        $new_total_crates = 0;
                    }

                $update_warehouse_logs = WarehouseLogs::find($transfer_id);
                $update_warehouse_logs->product_id = $product_id ;
                $update_warehouse_logs->quantity_transfered_in_crates = $new_total_crates ;
                $update_warehouse_logs->quantity_transfered_in_pieces = $new_total_pieces ;
                $update_warehouse_logs->total_quantity_transfered = $new_total_quantity_transfered ;
                $update_warehouse_logs->expected_price = $expected_price;
                $update_warehouse_logs->stock_before = $previous_stock_after;
                $update_warehouse_logs->stock_after = $new_stock_after;
                $update_warehouse_logs->remarks = $remarks;
                $update_warehouse_logs->collected_by = $collected_by;
                $update_warehouse_logs->collected_at = $date_collected;
                $update_warehouse_logs->save();




                // =========== UPDATING WAREHOUSE TABLE =============

                    if (($new_warehouse_total_items / $quantity_per_crate) > 0 ) {
                        $new_warehouse_total_pieces = $new_warehouse_total_items % $quantity_per_crate;
                        $new_warehouse_total_crates = (int)($new_warehouse_total_items / $quantity_per_crate);
                    } else {
                        $new_warehouse_total_pieces = $new_warehouse_total_items;
                        $new_warehouse_total_crates = 0;
                    }

                $update_warehouse = Warehouse::find($warehouse_id);
                // $update_warehouse->product_id = $product_id ;
                $update_warehouse->no_of_crates = $new_warehouse_total_crates ;
                $update_warehouse->no_of_pieces = $new_warehouse_total_pieces ;
                $update_warehouse->total_items = $new_warehouse_total_items ;
                $update_warehouse->total_price = $warehouse_new_total_price;
                $update_warehouse->save();


                // =========== UPDATING RETAILING TABLE TABLE =============

                if (($new_retail_total_items / $quantity_per_crate) > 0 ) {
                    $new_retail_total_pieces = $new_retail_total_items % $quantity_per_crate;
                    $new_retail_total_crates = (int)($new_retail_total_items / $quantity_per_crate);
                } else {
                    $new_retail_total_pieces = $new_retail_total_items;
                    $new_retail_total_crates = 0;
                }

                $update_retail = Retail::find($retail_id);
                // $update_warehouse->product_id = $product_id ;
                $update_retail->no_of_crates = $new_retail_total_crates ;
                $update_retail->no_of_pieces = $new_retail_total_pieces ;
                $update_retail->total_quantity = $new_retail_total_items ;
                $update_retail->total_amount = $retail_new_total_amount;
                $update_retail->save();


             // ======== Getting product threshold from the product table ===========
                $get_product = Products::find($product_id);
                $product_threshold = $get_product->stock_threshold;

                if ($new_warehouse_total_items <= $product_threshold) {
                    Alert::info('Records Updated successful', 'You are running out of stock, Please restock');
                    // Alert::toast('You are running out of stock, Please restock','warning');
                }else{
                    Alert::toast('Records Updated Successfully','success');
                }

                return redirect()->back();


        } catch (exception $e) {
            echo 'Caught exception';
        }
    }


}
