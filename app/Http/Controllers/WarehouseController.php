<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Warehouse;
use App\Models\WarehouseLogs;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use Carbon\Carbon;

class WarehouseController extends Controller
{
    public function index(){
        $all_products = Products::all();
        $all_warehouse_records = Warehouse::all();
        $get_product_records = Warehouse::get_each_product_details();
        // dd($get_product_records);
        return view('pages.warehouse', compact('all_products', 'get_product_records'));
    }

    public function add_stock(Request $request){
        // dd($request->all());
        $request->validate([
            'txt_product_name' => 'required',
            'txt_quantity_of_crates' =>  'regex:/^[0-9\s]+$/|nullable',
            'txt_quantity' =>  'regex:/^[0-9\s]+$/|nullable',
            'txt_stock_date' => 'required',
            // 'txt_total_quantity' => 'required|numeric'
            ], [
            'txt_product_name.required' => 'Product Name is required',
            // 'txt_quantity_of_crates.required' => 'Quantity of crates is required',
            'txt_quantity_of_crates.regex' => 'Enter only postive numeric values',
            // 'txt_quantity.required' => 'Quantity is required',
            'txt_quantity.regex' => 'Enter only positive numeric values',
            'txt_stock_date.required' => 'Stock Date is required',
            // 'txt_total_quantity.required' => 'Price per Crate is required',
            // 'txt_total_quantity.numeric' => 'Enter only numeric values'
        ]);

        // dd($request->all());
        $user_session = Session::get('user_session');
        $active_user = $user_session->first_name." ".$user_session->last_name;

        $product_id = $request->get('txt_product_name');
        $number_of_crates = $request->get('txt_quantity_of_crates');
        $number_of_pieces = $request->get('txt_quantity');

        dump((int)($number_of_pieces / 12));
        dd($number_of_pieces % 12);

        $get_product_details = Products::find($product_id);
        $quantity_per_crate = $get_product_details->quantity_per_crate;
        $price_per_crate = $get_product_details->price_per_crate;
        $price_per_item = $get_product_details->price_per_item;


        $total_items = ((double)($quantity_per_crate) * (double)($number_of_crates)) + (double)($number_of_pieces);

        $total_price = (double)($price_per_item)  *  $total_items;


        //Check if product already exist
        // $check_product = Warehouse::select_product($product_id);

        $check_product = Warehouse::where('product_id', $product_id)->get()[0];
        // dd($check_product);

        if ($check_product) {
            $warehouse_id = $check_product->id;
            // dd($warehouse_id);
            //====Update Warehouse DB ==============
            $update_warehouse = Warehouse::find($product_id);
            // $update_warehouse = Warehouse::where('product_id', $product_id)->get();
            $update_warehouse->no_of_crates = $check_product->no_of_crates +  $number_of_crates;
            $update_warehouse->no_of_pieces = $check_product->no_of_pieces +  $number_of_pieces;
            $update_warehouse->total_items = $check_product->total_items + $total_items;
            $update_warehouse->total_price = $check_product->total_price + $total_price;
            $update_warehouse->updated_by = $active_user;

            $current_date_time = Carbon::now()->toDateTimeString();
            $update_warehouse->updated_at = $current_date_time;
            $update_warehouse->save();
        }
        else {

            //====Save in Warehouse DB ==============
            $data = new Warehouse();
            $data->product_id = $product_id ;
            $data->description = $request->get('txt_description');
            $data->no_of_crates = $request->get('txt_quantity_of_crates');
            $data->no_of_pieces = $request->get('txt_quantity');
            $data->stock_date = $request->get('txt_stock_date');
            $data->quantity_per_crate = $quantity_per_crate;
            $data->price_per_crate = $price_per_crate;
            $data->price_per_piece = $price_per_item;
            $data->total_items = $total_items;
            $data->total_price = $total_price;
            $data->created_by = $active_user;
            $data->save();
        }


        // $get_stock_records = Warehouse::find($product_id);
        // $original_stock = $get_stock_records->total_items;

        // $get_product_details_from_warehouse_logs = WarehouseLogs::select_product($product_id);
        // // dd($get_product_details_from_warehouse_logs);


        // if(count($get_product_details_from_warehouse_logs) > 0){
        //     $stock_before = $get_product_details_from_warehouse_logs[0]->stock_before;
        //     // $stock_after = $get_product_details_from_warehouse_logs->stock_after;
        //     if ($original_stock - $stock_before == 0) {
        //         $stock_after = $original_stock;
        //     }
        //     elseif ($original_stock - $stock_before > 0) {
        //         $stock_after = $original_stock - $stock_before;
        //     }

        //     //====Save in Warehouse_logs DB ==============
        //     $warehouse_logs = new WarehouseLogs();
        //     $warehouse_logs->product_id = $product_id;
        //     $warehouse_logs->original_stock = $original_stock;
        //     $warehouse_logs->stock_before = $stock_before;
        //     $warehouse_logs->stock_after = $stock_after;
        //     //  $warehouse_logs->expected_price =
        //     //  $warehouse_logs->collected_by =
        //     //  $warehouse_logs->remarks =
        //     $warehouse_logs->created_by = $active_user;
        //     $warehouse_logs->save();
        // }
        // else{
        //      //====Save in Warehouse_logs DB ==============
        //     $warehouse_logs = new WarehouseLogs();
        //     $warehouse_logs->product_id = $product_id;
        //     $warehouse_logs->original_stock = $original_stock;
        //     // $warehouse_logs->stock_before = $stock_before;
        //     $warehouse_logs->stock_after = $original_stock;
        //     //  $warehouse_logs->expected_price =
        //     //  $warehouse_logs->collected_by =
        //     //  $warehouse_logs->remarks =
        //     $warehouse_logs->created_by = $active_user;
        //     $warehouse_logs->save();
        // }

        Alert::toast('Warehouse record entered','success');
        return redirect()->back();
    }
}
