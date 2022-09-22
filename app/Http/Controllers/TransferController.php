<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Warehouse;
use App\Models\WarehouseLogs;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class TransferController extends Controller
{
    public function index(){
        $all_products = Products::all();
        $all_users = User::all();
        $all_transfer_records = WarehouseLogs::get_transfer_details();
        // dd($all_transfer_records);
        return view('pages.transfer', compact('all_products', 'all_users', 'all_transfer_records'));
    }


    public function transfer_stock(Request $request){
        dd($request->all());
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

        $current_original_stock = $get_stock_records->total_items;
        $total_price = $get_stock_records->total_price;
        $price_per_piece = $get_stock_records->price_per_piece;
        $quantity_per_crate = $get_stock_records->quantity_per_crate;

        $quantity_transfered = ((double)($quantity_per_crate) * (double)($quantity_in_crate)) + (double)($quantity_in_pieces);

        $get_product_details_from_warehouse_logs = WarehouseLogs::select_product($product_id);

        if(count($get_product_details_from_warehouse_logs) > 0){

            $previous_original_stock = $get_product_details_from_warehouse_logs[0]->original_stock;
            $previous_stock_before = $get_product_details_from_warehouse_logs[0]->stock_before;
            $previous_stock_after = $get_product_details_from_warehouse_logs[0]->stock_after;

            if ($current_original_stock - $previous_original_stock == 0) {

                $original_stock = $previous_original_stock;
                $stock_before = $previous_stock_after;

                if ($stock_before - $quantity_transfered >= 0) {
                    $stock_after =  $stock_before - $quantity_transfered;
                }
                else {
                    Alert::toast('Quantity left is not up to the transfer requested','warning');
                    return redirect()->back();
                }

            }
            elseif ($current_original_stock - $previous_original_stock > 0) {
                $original_stock = $current_original_stock;
                $difference_in_stock = $current_original_stock - $previous_original_stock;
                $stock_before = $previous_stock_after + $difference_in_stock;
                // $stock_after = $stock_before - $quantity_transfered;

                if ($stock_before - $quantity_transfered >= 0) {
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

            //====Save in Warehouse_logs DB ==============
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
        }
        else{
            //====Save in Warehouse_logs DB ==============
           $original_stock = $current_original_stock;
           $stock_before = $current_original_stock;

           if ($stock_before - $quantity_transfered >= 0) {
            $stock_after =  $stock_before - $quantity_transfered;
            } else {
                Alert::toast('Quantity left is not up to the transfer requested','warning');
                return redirect()->back();
            }

        //    $stock_after = $stock_before - $quantity_transfered;
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
       }

       Alert::toast('Product Transfered Successfully','success');
       return redirect()->back();

    }

}
