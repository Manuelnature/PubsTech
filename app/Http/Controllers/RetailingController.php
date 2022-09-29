<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Retail;
use App\Models\Warehouse;
use App\Models\WarehouseLogs;
use App\Models\Sales;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use Carbon\Carbon;
use Log;

class RetailingController extends Controller
{
    public function index(){
        $all_products = Products::where('status', 'Active')->get();
        $most_purchased_products = Products::where('is_most_purchased', '1')->where('status', 'Active')->get();
        $all_sales_records = Sales::get_sales_details();

        $user_session = Session::get('user_session');
        $active_user = $user_session->first_name." ".$user_session->last_name;
        $today_date = Carbon::now()->format('Y-m-d');

        $individual_sales_for_today = Sales::get_individual_sales_details_for_today($active_user, $today_date);
        // dd( $individual_sales_for_today);

        return view('pages.retailing', compact('all_products', 'most_purchased_products', 'all_sales_records', 'individual_sales_for_today' ));
    }


    public function add_sale(Request $request){
        $request->validate([
            'txt_product_id' => 'required',
            'txt_quantity' => 'required|numeric',
            // 'txt_total_amount' => 'required',
            ], [
            'txt_product_id.required' => 'Product Name is required',
            'txt_quantity.required' => 'Quantity Item is required',
            'txt_quantity.numeric' => 'Enter only numeric values',
            // 'txt_total_amount.required' => 'Total Amount is required',
        ]);

        // dd($request->all());
        $user_session = Session::get('user_session');
        $active_user = $user_session->first_name." ".$user_session->last_name;

        $amount = floatval(preg_replace('/[^\d.]/', '', $request->get('txt_total_amount'))); //Removes comma from the amount entered
        $product_id = $request->get('txt_product_id');
        $quantity_sold = $request->get('txt_quantity');
        $remarks = $request->get('txt_remarks');

        //===========Getting the total stock records available for Retailing=================
        $get_stock_records_from_retail = Retail::where('product_id', $product_id)->get();

        if (count($get_stock_records_from_retail) > 0) {

            $retail_id = $get_stock_records_from_retail[0]->id;
            $price_per_piece = $get_stock_records_from_retail[0]->price_per_piece;
            $original_total_quantity = (int)$get_stock_records_from_retail[0]->total_quantity;
            $original_total_amount= (int)$get_stock_records_from_retail[0]->total_amount;
            $get_no_of_crates = $get_stock_records_from_retail[0]->no_of_crates;
            $get_no_of_pieces = $get_stock_records_from_retail[0]->no_of_pieces;
            $stock_before = $original_total_quantity;

            if (($stock_before - $quantity_sold) >= 0) {
                $stock_after =  $stock_before - $quantity_sold;
            } else {
                Alert::toast('Quantity left is not up to the purchase requested','warning');
                    return redirect()->back();
            }

            // $expected_price = ((double)$stock_before - (double)$stock_after) * (double)$price_per_piece;
            $expected_price = (double)$quantity_sold * (double)$price_per_piece;
            $total_amount_left = (double)$original_total_amount - (double)$expected_price;
            $total_quantity_left = $original_total_quantity - $quantity_sold;

            // ============= SAVE IN SALES TABLE =====================
            $sales = new Sales();
            $sales->product_id = $product_id;
            // $sales->original_stock = $original_stock;
            $sales->stock_before = $stock_before;
            $sales->stock_after = $stock_after;
            $sales->quantity_sold = $quantity_sold;
            $sales->expected_price = $expected_price;
            $sales->remarks = $remarks;
            $sales->created_by = $active_user;
            $sales->save();

            // ============= UPDATING RETAIL TABLE =====================
            $get_product_details = Products::find($product_id);
            $quantity_per_crate = $get_product_details->quantity_per_crate;

            if (($total_quantity_left / $quantity_per_crate) > 0 ) {
                $total_pieces_left = $total_quantity_left % $quantity_per_crate;
                $total_crates_left = (int)($total_quantity_left / $quantity_per_crate);
            } else {
                $total_pieces_left = $total_quantity_left;
                $total_crates_left = 0;
            }

            $update_retail = Retail::find($retail_id);
            if($update_retail->product_id ==  $product_id){
                $update_retail->stock_before = $stock_before;
                $update_retail->stock_after = $stock_after;
                $update_retail->no_of_crates = $total_crates_left;
                $update_retail->no_of_pieces = $total_pieces_left;
                $update_retail->total_quantity = $total_quantity_left;
                $update_retail->total_amount = $total_amount_left;
                // $update_retail->stock_after = $stock_after;
                $update_retail->save();
            }
            Alert::toast('Sales Recorded Successfully','success');
            return redirect()->back();
        }
        else {
            Alert::toast('Product not found in retail! Please re-stock','warning');
                    return redirect()->back();
        }

    }




    public function add_sale_from_modal(Request $request){
        $request->validate([
            'txt_product_id_modal' => 'required',
            'txt_quantity_modal' => 'required|numeric',
            ], [
            'txt_product_id_modal.required' => 'Product Name is required',
            'txt_quantity_modal.required' => 'Quantity Item is required',
            'txt_quantity_modal.numeric' => 'Enter only numeric values',
        ]);

        // dd($request->all());
        $user_session = Session::get('user_session');
        $active_user = $user_session->first_name." ".$user_session->last_name;

        $amount = floatval(preg_replace('/[^\d.]/', '', $request->get('txt_total_amount_modal'))); //Removes comma from the amount entered
        $product_id = $request->get('txt_product_id_modal');
        $quantity_sold = $request->get('txt_quantity_modal');
        $remarks = $request->get('txt_remarks_modal');



         //===========Getting the total stock records available for Retailing=================
         $get_stock_records_from_retail = Retail::where('product_id', $product_id)->get();

         if (count($get_stock_records_from_retail) > 0) {

             $retail_id = $get_stock_records_from_retail[0]->id;
             $price_per_piece = $get_stock_records_from_retail[0]->price_per_piece;
             $original_total_quantity = (int)$get_stock_records_from_retail[0]->total_quantity;
             $original_total_amount= (int)$get_stock_records_from_retail[0]->total_amount;
             $get_no_of_crates = $get_stock_records_from_retail[0]->no_of_crates;
             $get_no_of_pieces = $get_stock_records_from_retail[0]->no_of_pieces;
             $stock_before = $original_total_quantity;

             if (($stock_before - $quantity_sold) >= 0) {
                 $stock_after =  $stock_before - $quantity_sold;
             } else {
                 Alert::toast('Quantity left is not up to the purchase requested','warning');
                     return redirect()->back();
             }

             // $expected_price = ((double)$stock_before - (double)$stock_after) * (double)$price_per_piece;
             $expected_price = (double)$quantity_sold * (double)$price_per_piece;
             $total_amount_left = (double)$original_total_amount - (double)$expected_price;
             $total_quantity_left = $original_total_quantity - $quantity_sold;

             // ============= SAVE IN SALES TABLE =====================
             $sales = new Sales();
             $sales->product_id = $product_id;
             // $sales->original_stock = $original_stock;
             $sales->stock_before = $stock_before;
             $sales->stock_after = $stock_after;
             $sales->quantity_sold = $quantity_sold;
             $sales->expected_price = $expected_price;
             $sales->remarks = $remarks;
             $sales->created_by = $active_user;
             $sales->save();

             // ============= UPDATING RETAIL TABLE =====================
             $get_product_details = Products::find($product_id);
             $quantity_per_crate = $get_product_details->quantity_per_crate;

             if (($total_quantity_left / $quantity_per_crate) > 0 ) {
                 $total_pieces_left = $total_quantity_left % $quantity_per_crate;
                 $total_crates_left = (int)($total_quantity_left / $quantity_per_crate);
             } else {
                 $total_pieces_left = $total_quantity_left;
                 $total_crates_left = 0;
             }

             $update_retail = Retail::find($retail_id);
             if($update_retail->product_id ==  $product_id){
                 $update_retail->stock_before = $stock_before;
                 $update_retail->stock_after = $stock_after;
                 $update_retail->no_of_crates = $total_crates_left;
                 $update_retail->no_of_pieces = $total_pieces_left;
                 $update_retail->total_quantity = $total_quantity_left;
                 $update_retail->total_amount = $total_amount_left;
                 // $update_retail->stock_after = $stock_after;
                 $update_retail->save();
             }
             Alert::toast('Sales Recorded Successfully','success');
             return redirect()->back();
         }
         else {
             Alert::toast('Product not found in retail! Please re-stock','warning');
                     return redirect()->back();
         }
    }



    public function update_sale (Request $request){
        // dd($request->all());
        try {
            $user_session = Session::get('user_session');
            $active_user = $user_session->first_name." ".$user_session->last_name;
            $current_date_and_time = Carbon::now()->toDateTimeString();

            $sale_id = $request->get('txt_sale_id');
            $product_id = $request->get('txt_edit_product_id');
            $quantity_sold = $request->get('txt_edit_quantity');
            $total_amount = $request->get('txt_edit_total');
            $remarks = $request->get('txt_edit_remarks');

            // dd($remarks);

            // $get_record_from_product = Product::find($product_id);
            // $price_per_piece = $get_record_from_product->price_per_item;
            $get_product_details = Products::find($product_id);
            $quantity_per_crate = $get_product_details->quantity_per_crate;




            // ========== Get records from sales table ===========
            $get_records_from_sales = Sales::find($sale_id);
            $old_sale_product_id = $get_records_from_sales->product_id;
            $previous_quantity_sold = $get_records_from_sales->quantity_sold;
            $previous_expected_price = $get_records_from_sales->expected_price;
            $previous_stock_before = $get_records_from_sales->stock_before;
            $previous_stock_after = $get_records_from_sales->stock_after;

            if ($old_sale_product_id == $product_id) {

                    //===========Get records from Retail Table ================
                $get_stock_records_form_retail = Retail::where('product_id', $product_id)->get()[0];
                $retail_id = $get_stock_records_form_retail->id;
                $previous_retail_total_quantity = $get_stock_records_form_retail->total_quantity;
                $previous_retail_total_amount = $get_stock_records_form_retail->total_amount;
                $price_per_piece = $get_stock_records_form_retail->price_per_piece;
                $stock_before = $previous_retail_total_quantity;


                if (($quantity_sold - $previous_quantity_sold) > $previous_retail_total_quantity) {
                    Alert::toast('Quantity left is not up to the sale requested','warning');
                    return back();
                }
                else {
                        $difference_in_quantity = (int)$quantity_sold - (int)$previous_quantity_sold;

                    if ($difference_in_quantity >= 0) {
                        $new_quantity_sold = (int)$previous_quantity_sold + (int)$difference_in_quantity;
                        $new_stock_after = (int)$previous_stock_after - (int)$difference_in_quantity;
                        $new_retail_total_quantity = (int)$previous_retail_total_quantity - (int)$difference_in_quantity;
                    }
                    else {
                        $new_quantity_sold = (int)$previous_quantity_sold - (int)$difference_in_quantity;
                        $new_stock_after = (int)$previous_stock_after + (int)$difference_in_quantity;
                        $new_retail_total_quantity = (int)$previous_retail_total_quantity + (int)$difference_in_quantity;
                    }

                    $new_expected_price = (double)$new_quantity_sold * (double)$price_per_piece;

                    $new_retail_total_amount = (double)$new_retail_total_quantity * (double)$price_per_piece;


                    // // ===========Updating Sales Table ================
                    // $update_sale = Sales::find($sale_id);

                    // $update_sale->quantity_sold = $new_quantity_sold;
                    // $update_sale->expected_price = $new_expected_price;
                    // $update_sale->stock_after = $new_stock_after;
                    // $update_sale->remarks = $remarks;
                    // $update_sale->updated_by = $active_user;
                    // $update_sale->updated_at = $current_date_and_time;
                    // $update_sale->save();


                    //===========Updating Retail Table ================
                    if (($new_retail_total_quantity / $quantity_per_crate) > 0 ) {
                        $new_retail_total_pieces = $new_retail_total_quantity % $quantity_per_crate;
                        $new_retail_total_crates = (int)($new_retail_total_quantity / $quantity_per_crate);
                    } else {
                        $new_retail_total_pieces = $new_retail_total_quantity;
                        $new_retail_total_crates = 0;
                    }

                    $update_retail = Retail::find($retail_id);
                    $update_retail->no_of_crates = $new_retail_total_crates ;
                    $update_retail->no_of_pieces = $new_retail_total_pieces ;
                    $update_retail->total_quantity = $new_retail_total_quantity ;
                    $update_retail->total_amount = $new_retail_total_amount;
                    $update_retail->save();

                    Alert::toast('Records Updated Successfully','success');
                    return redirect()->back();
                }


                // ===========Updating Sales Table ================
                $update_sale = Sales::find($sale_id);

                $update_sale->quantity_sold = $new_quantity_sold;
                $update_sale->expected_price = $new_expected_price;
                $update_sale->stock_after = $new_retail_total_quantity;
                $update_sale->remarks = $remarks;
                $update_sale->updated_by = $active_user;
                $update_sale->updated_at = $current_date_and_time;
                $update_sale->save();

            }
            else {
                 //===========Get records from Retail Table ================
                 $old_product_records_form_retail = Retail::where('product_id', $old_sale_product_id)->get();
                 $old_product_retail_id = $old_product_records_form_retail[0]->id;
                 $old_product_previous_retail_total_quantity = $old_product_records_form_retail[0]->total_quantity;
                 $old_product_previous_retail_total_amount = $old_product_records_form_retail[0]->total_amount;
                 $old_product_price_per_piece = $old_product_records_form_retail[0]->price_per_piece;
                 $old_product_stock_before = $old_product_previous_retail_total_quantity;


                 $new_product_records_form_retail = Retail::where('product_id', $product_id)->get();
                 $new_product_retail_id = $new_product_records_form_retail[0]->id;
                 $new_product_previous_retail_total_quantity = $new_product_records_form_retail[0]->total_quantity;
                 $new_product_previous_retail_total_amount = $new_product_records_form_retail[0]->total_amount;
                 $new_product_price_per_piece = $new_product_records_form_retail[0]->price_per_piece;
                 $new_product_stock_before = $new_product_previous_retail_total_quantity;


                if (count($new_product_records_form_retail) > 0) {

                    if (($new_product_stock_before - $quantity_sold) >= 0) {
                        $new_product_stock_after =  $new_product_stock_before - $quantity_sold;
                    } else {
                        Alert::toast('Quantity left is not up to the sale requested','warning');
                            return redirect()->back();
                    }

                    // $expected_price = (double)$quantity_sold * (double)$price_per_piece;
                    // $new_retail_total_amount = (double)$previous_retail_total_amount - (double)$expected_price;
                    // $new_retail_total_quantity = $previous_retail_total_quantity + $previous_quantity_sold;


                    $expected_price = (double)$quantity_sold * (double)$new_product_price_per_piece;

                    $new_product_new_retail_total_amount = (double)$new_product_previous_retail_total_amount - (double)$expected_price;
                    $new_product_new_retail_total_quantity = $new_product_previous_retail_total_quantity - $quantity_sold;


                    $old_product_new_retail_total_amount = (double)$old_product_previous_retail_total_amount + (double)$previous_expected_price;
                    $old_product_new_retail_total_quantity = $old_product_previous_retail_total_quantity + $previous_quantity_sold;

                    $old_product_stock_after = $old_product_new_retail_total_quantity;



                    // ============= Updating SALES TABLE =====================
                    $update_sales = Sales::find($sale_id);
                    $update_sales->product_id = $product_id;
                    $update_sales->stock_before = $new_product_stock_before;
                    $update_sales->stock_after = $new_product_stock_after;
                    $update_sales->quantity_sold = $quantity_sold;
                    $update_sales->expected_price = $expected_price;
                    $update_sales->remarks = $remarks;
                    $update_sales->updated_by = $active_user;
                    $update_sales->updated_at = $current_date_and_time;
                    $update_sales->save();


                    // ============= UPDATING RETAIL TABLE =====================
                    // $get_product_details = Products::find($product_id);
                    // $quantity_per_crate = $get_product_details->quantity_per_crate;

                    if (($new_product_new_retail_total_quantity / $quantity_per_crate) > 0 ) {
                        $new_product_total_pieces_left = $new_product_new_retail_total_quantity % $quantity_per_crate;
                        $new_product_total_crates_left = (int)($new_product_new_retail_total_quantity / $quantity_per_crate);
                    } else {
                        $new_product_total_pieces_left = $new_product_new_retail_total_quantity;
                        $new_product_total_crates_left = 0;
                    }


                    // ====updating retail for new product ==============
                    $update_retail = Retail::find($new_product_retail_id);
                    // if($update_retail->product_id ==  $product_id){
                        $update_retail->stock_before = $new_product_stock_before;
                        $update_retail->stock_after = $new_product_stock_after;
                        $update_retail->no_of_crates = $new_product_total_crates_left;
                        $update_retail->no_of_pieces = $new_product_total_pieces_left;
                        $update_retail->total_quantity = $new_product_new_retail_total_quantity;
                        $update_retail->total_amount = $new_product_new_retail_total_amount;
                        // $update_retail->stock_after = $stock_after;
                        $update_retail->save();
                        Log::channel('my_logs')->info('Newwwwwww Product');
                    // }


                    // / ====updating retail for old product ==============
                        if (($old_product_new_retail_total_quantity / $quantity_per_crate) > 0 ) {
                            $old_product_total_pieces_left = $old_product_new_retail_total_quantity % $quantity_per_crate;
                            $old_product_total_crates_left = (int)($old_product_new_retail_total_quantity / $quantity_per_crate);
                        } else {
                            $old_product_total_pieces_left = $old_product_new_retail_total_quantity;
                            $old_product_total_crates_left = 0;
                        }

                        $update_old_product_retail = Retail::find($old_product_retail_id);
                        $update_old_product_retail->stock_before = $old_product_stock_before;
                        $update_old_product_retail->stock_after = $old_product_stock_after;
                        $update_old_product_retail->no_of_crates = $old_product_total_crates_left;
                        $update_old_product_retail->no_of_pieces = $old_product_total_pieces_left;
                        $update_old_product_retail->total_quantity = $old_product_new_retail_total_quantity;
                        $update_old_product_retail->total_amount = $old_product_new_retail_total_amount;
                        // $update_retail->stock_after = $stock_after;
                        $update_old_product_retail->save();
                        Log::channel('my_logs')->info('Oldddddddddddddddddddd Product');


                    Alert::toast('Records Updated Successfully','success');
                    return redirect()->back();

                }
                else {
                    Alert::toast('Product not found in retail! Please re-stock','warning');
                            return redirect()->back();
                }
            }




        } catch (exception $e) {
            echo 'Caught exception';
        }
    }





    public function add_sale_old(Request $request){
        $request->validate([
            'txt_product_id' => 'required',
            'txt_quantity' => 'required|numeric',
            // 'txt_total_amount' => 'required',
            ], [
            'txt_product_id.required' => 'Product Name is required',
            'txt_quantity.required' => 'Quantity Item is required',
            'txt_quantity.numeric' => 'Enter only numeric values',
            // 'txt_total_amount.required' => 'Total Amount is required',
        ]);

        // dd($request->all());
        $user_session = Session::get('user_session');
        $active_user = $user_session->first_name." ".$user_session->last_name;

        $amount = floatval(preg_replace('/[^\d.]/', '', $request->get('txt_total_amount'))); //Removes comma from the amount entered
        $product_id = $request->get('txt_product_id');
        $quantity_sold = $request->get('txt_quantity');
        $remarks = $request->get('txt_remarks');

        // $data = new Retail();
        // $data->product_id = $product_id;
        // $quantity_sold = $request->get('txt_quantity');
        // $data->quantity_sold = $quantity_sold;
        // $data->remarks = $request->get('txt_remarks');
        // $data->amount =  $amount;
        // $data->sold_by = $active_user;
        // $data->save();

        // $get_stock_records = Warehouse::find($product_id);
        // $current_original_stock = $get_stock_records->total_items;
        // $total_price = $get_stock_records->total_price;
        // $price_per_piece = $get_stock_records->price_per_piece;

        //===========Getting the total stock records available for Retailing=================
        $get_stock_records = WarehouseLogs::where('product_id', $product_id)->get();
        $total_stock = 0;
        $total_price = 0;

        foreach ($get_stock_records as $each_stock) {
           $total_stock = (int)$total_stock + (int)$each_stock->quantity_transfered_in_pieces;
           $total_price = (double)$total_price + (double)$each_stock->expected_price;
           $price_per_piece = (int)$each_stock->price_per_piece;
        }

        $current_original_stock = $total_stock;

        $get_product_details_from_sales = Sales::select_product($product_id);

        if(count($get_product_details_from_sales) > 0){

            $previous_original_stock = $get_product_details_from_sales[0]->original_stock;
            $previous_stock_before = $get_product_details_from_sales[0]->stock_before;
            $previous_stock_after = $get_product_details_from_sales[0]->stock_after;

            if ($current_original_stock - $previous_original_stock == 0) {

                $original_stock = $previous_original_stock;
                $stock_before = $previous_stock_after;
                // $stock_after =  $stock_before - $quantity_sold;
                if ($stock_before - $quantity_sold >= 0) {
                    $stock_after =  $stock_before - $quantity_sold;
                }
                else {
                    Alert::toast('Quantity left is not up to the purchase requested','warning');
                    return redirect()->back();
                }
            }
            elseif ($current_original_stock - $previous_original_stock > 0) {
                $original_stock = $current_original_stock;
                $difference_in_stock = $current_original_stock - $previous_original_stock;
                $stock_before = $previous_stock_after + $difference_in_stock;
                // $stock_after = $stock_before - $quantity_sold;
                if ($stock_before - $quantity_sold >= 0) {
                    $stock_after =  $stock_before - $quantity_sold;
                }
                else {
                    Alert::toast('Quantity left is not up to the purchase requested','warning');
                    return redirect()->back();
                }
            }
            $expected_price = ((double)$stock_before - (double)$stock_after) * (double)$price_per_piece;
            //====Save in sales DB ==============
            $sales = new Sales();
            $sales->product_id = $product_id;
            $sales->original_stock = $original_stock;
            $sales->stock_before = $stock_before;
            $sales->stock_after = $stock_after;
            $sales->quantity_sold = $quantity_sold;
            $sales->expected_price = $expected_price;
            $sales->remarks = $remarks;
            $sales->created_by = $active_user;
            $sales->save();
        }
        else{
             //====Save in sales DB ==============
            $original_stock = $current_original_stock;
            $stock_before = $current_original_stock;
            // $stock_after = $stock_before - $quantity_sold;
            if ($stock_before - $quantity_sold >= 0) {
                $stock_after =  $stock_before - $quantity_sold;
            }
            else {
                Alert::toast('Quantity left is not up to the purchase requested','warning');
                return redirect()->back();
            }
            $expected_price = ((double)$stock_before - (double)$stock_after) * (double)$price_per_piece;

            $sales = new Sales();
            $sales->product_id = $product_id;
            $sales->original_stock = $original_stock;
            $sales->stock_before = $stock_before;
            $sales->stock_after = $stock_after;
            $sales->quantity_sold = $quantity_sold;
            $sales->expected_price = $expected_price;
            $sales->remarks = $remarks;
            $sales->created_by = $active_user;
            $sales->save();
        }

        Alert::toast('Sales Recorded Successfully','success');
        return redirect()->back();
    }


    public function add_sale_from_modal_old(Request $request){
        $request->validate([
            'txt_product_id_modal' => 'required',
            'txt_quantity_modal' => 'required|numeric',
            ], [
            'txt_product_id_modal.required' => 'Product Name is required',
            'txt_quantity_modal.required' => 'Quantity Item is required',
            'txt_quantity_modal.numeric' => 'Enter only numeric values',
        ]);

        // dd($request->all());
        $user_session = Session::get('user_session');
        $active_user = $user_session->first_name." ".$user_session->last_name;

        $amount = floatval(preg_replace('/[^\d.]/', '', $request->get('txt_total_amount_modal'))); //Removes comma from the amount entered
        $product_id = $request->get('txt_product_id_modal');
        $quantity_sold = $request->get('txt_quantity_modal');
        $remarks = $request->get('txt_remarks_modal');

        // $data = new Retail();
        // $data->product_id = $product_id;
        // $quantity_sold = $request->get('txt_quantity_modal');
        // $data->quantity_sold = $quantity_sold;
        // $data->amount =  $amount;
        // $data->sold_by = $active_user;
        // $data->save();



        // $get_stock_records = Warehouse::find($product_id);
        // $current_original_stock = $get_stock_records->total_items;
        // $total_price = $get_stock_records->total_price;
        // $price_per_piece = $get_stock_records->price_per_piece;

        //===========Getting the total stock records available for Retailing=================
        $get_stock_records = WarehouseLogs::where('product_id', $product_id)->get();
        $total_stock = 0;
        $total_price = 0;

        foreach ($get_stock_records as $each_stock) {
           $total_stock = (int)$total_stock + (int)$each_stock->quantity_transfered_in_pieces;
           $total_price = (double)$total_price + (double)$each_stock->expected_price;
           $price_per_piece = (int)$each_stock->price_per_piece;
        }

        $current_original_stock = $total_stock;

        $get_product_details_from_sales = Sales::select_product($product_id);

        if(count($get_product_details_from_sales) > 0){

            $previous_original_stock = $get_product_details_from_sales[0]->original_stock;
            $previous_stock_before = $get_product_details_from_sales[0]->stock_before;
            $previous_stock_after = $get_product_details_from_sales[0]->stock_after;

            if ($current_original_stock - $previous_original_stock == 0) {

                $original_stock = $previous_original_stock;
                $stock_before = $previous_stock_after;
                // $stock_after =  $stock_before - $quantity_sold;
                if ($stock_before - $quantity_sold >= 0) {
                    $stock_after =  $stock_before - $quantity_sold;
                }
                else {
                    Alert::toast('Quantity left is not up to the purchase requested','warning');
                    return redirect()->back();
                }
            }
            elseif ($current_original_stock - $previous_original_stock > 0) {
                $original_stock = $current_original_stock;
                $difference_in_stock = $current_original_stock - $previous_original_stock;
                $stock_before = $previous_stock_after + $difference_in_stock;
                // $stock_after = $stock_before - $quantity_sold;

                if ($stock_before - $quantity_sold >= 0) {
                    $stock_after =  $stock_before - $quantity_sold;
                }
                else {
                    Alert::toast('Quantity left is not up to the purchase requested','warning');
                    return redirect()->back();
                }
            }
            else {
                Alert::toast('Invalid Sales','warning');
                return redirect()->back();
            }
            $expected_price = ((double)$stock_before - (double)$stock_after) * (double)$price_per_piece;
            //====Save in Sales DB ==============
            $sales = new Sales();
            $sales->product_id = $product_id;
            $sales->original_stock = $original_stock;
            $sales->stock_before = $stock_before;
            $sales->stock_after = $stock_after;
            $sales->quantity_sold = $quantity_sold;
            $sales->expected_price = $expected_price;
            $sales->remarks = $remarks;
            $sales->created_by = $active_user;
            $sales->save();
        }
        else{
             //====Save in Sales DB ==============
            $original_stock = $current_original_stock;
            $stock_before = $current_original_stock;
            // $stock_after = $stock_before - $quantity_sold;
            if ($stock_before - $quantity_sold >= 0) {
                $stock_after =  $stock_before - $quantity_sold;
            }
            else {
                Alert::toast('Quantity left is not up to the purchase requested','warning');
                return redirect()->back();
            }
            $expected_price = ((double)$stock_before - (double)$stock_after) * (double)$price_per_piece;

            $sales = new Sales();
            $sales->product_id = $product_id;
            $sales->original_stock = $original_stock;
            $sales->stock_before = $stock_before;
            $sales->stock_after = $stock_after;
            $sales->quantity_sold = $quantity_sold;
            $sales->expected_price = $expected_price;
            $sales->remarks = $remarks;
            $sales->created_by = $active_user;
            $sales->save();
        }

        Alert::toast('Sales Recorded Successfully','success');
        return redirect()->back();
    }




    public function update_sale_initial_one (Request $request){
        // dd($request->all());
        try {
            $user_session = Session::get('user_session');
            $active_user = $user_session->first_name." ".$user_session->last_name;
            $current_date_and_time = Carbon::now()->toDateTimeString();

            $sale_id = $request->get('txt_sale_id');
            $product_id = $request->get('txt_edit_product_id');
            $quantity_sold = $request->get('txt_edit_quantity');
            $total_amount = $request->get('txt_edit_total');
            $remarks = $request->get('txt_edit_remarks');

            $get_record_from_product = Product::find($product_id);
            $price_per_piece = $get_record_from_product->price_per_item;


            //===========Get records from Retail Table ================
            $get_stock_records_form_retail = Retail::where('product_id', $product_id)->get()[0];
            $retail_id = $get_stock_records_form_retail->id;
            $previous_retail_total_quantity = $get_stock_records_form_retail->total_quantity;
            $previous_retail_total_amount = $get_stock_records_form_retail->total_amount;

            // ========== Get records from sales table ===========
            $get_records_from_sales = Sales::find($sale_id);
            $previous_quantity_sold = $get_records_from_sales->quantity_sold;
            $previous_expected_price = $get_records_from_sales->expected_price;
            $previous_stock_before = $get_records_from_sales->stock_before;
            $previous_stock_after = $get_records_from_sales->stock_after;

            if ($get_records_from_sales->product_id == $product_id) {


            } else {
                # code...
            }

            if ($quantity_sold > $previous_retail_total_quantity) {
                Alert::toast('Quantity left is not up to the sale requested','warning');
                return back();
            }
            else {
                    $difference_in_quantity = (int)$quantity_sold - (int)$previous_quantity_sold;

                if ($difference_in_quantity >= 0) {
                    $new_quantity_sold = (int)$previous_quantity_sold + (int)$difference_in_quantity;
                    $new_stock_after = (int)$previous_stock_after + (int)$difference_in_quantity;
                    $new_retail_total_quantity = (int)$previous_retail_total_quantity - (int)$difference_in_quantity;
                }
                else {
                    $new_quantity_sold = (int)$previous_quantity_sold - (int)$difference_in_quantity;
                    $new_stock_after = (int)$previous_stock_after - (int)$difference_in_quantity;
                    $new_retail_total_quantity = (int)$previous_retail_total_quantity + (int)$difference_in_quantity;
                }

                $new_expected_price = (double)$new_quantity_sold * (double)$price_per_piece;

                $new_retail_total_amount = (double)$new_retail_total_quantity * (double)$price_per_piece;


                // ===========Updating Sales Table ================
                $update_sale = Sales::find($sale_id);

                $update_sale->quantity_sold = $new_quantity_sold;
                $update_sale->expected_price = $new_expected_price;
                $update_sale->updated_by = $active_user;
                $update_sale->updated_at = $current_date_and_time;
                $update_sale->save();


                //===========Updating Retail Table ================
                if (($new_retail_total_quantity / $quantity_per_crate) > 0 ) {
                    $new_retail_total_pieces = $new_retail_total_quantity % $quantity_per_crate;
                    $new_retail_total_crates = (int)($new_retail_total_quantity / $quantity_per_crate);
                } else {
                    $new_retail_total_pieces = $new_retail_total_quantity;
                    $new_retail_total_crates = 0;
                }

                $update_retail = Retail::find($retail_id);
                $update_retail->no_of_crates = $new_retail_total_crates ;
                $update_retail->no_of_pieces = $new_retail_total_pieces ;
                $update_retail->total_quantity = $new_retail_total_quantity ;
                $update_retail->total_amount = $new_retail_total_amount;
                $update_retail->save();

                Alert::toast('Records Updated Successfully','success');
                return redirect()->back();

            }


        } catch (exception $e) {
            echo 'Caught exception';
        }
    }


}
