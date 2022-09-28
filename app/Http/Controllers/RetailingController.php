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
                $update_retail->stock_after = $stock_after;
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


}
