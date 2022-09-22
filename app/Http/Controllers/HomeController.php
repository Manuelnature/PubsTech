<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Warehouse;
use App\Models\WarehouseLogs;
use App\Models\Sales;
use App\Models\SalesAudit;
use App\Models\Dashboard;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(){
        $get_all_products = Products::all();
        $get_all_warehouse_records = Warehouse::all();

        $total_no_of_items = 0;

        if(count($get_all_warehouse_records) > 0){
            foreach ($get_all_warehouse_records as $warehouse_record) {
                $total_no_of_items = $total_no_of_items + $warehouse_record->total_items;
            }
        }


        $total_price_of_items = 0;
        if(count($get_all_warehouse_records) > 0){
            foreach ($get_all_warehouse_records as $warehouse_record) {
                $total_price_of_items = $total_price_of_items + $warehouse_record->total_price;
            }
        }

        $total_products = count($get_all_products);

        $get_sales_records = Sales::all();

        $total_quantity_sold = 0;

        if(count($get_sales_records) > 0){
            foreach ($get_sales_records as $sales_record) {
                $total_quantity_sold = $total_quantity_sold + $sales_record->quantity_sold;
            }
        }

        $total_expected_sold_price = 0;
        if(count($get_sales_records) > 0){
            foreach ($get_sales_records as $sales_record) {
                $total_expected_sold_price = $total_expected_sold_price + $sales_record->expected_price;
            }
        }


        $all_transfer_records = WarehouseLogs::get_transfer_details_in_group();
        // dd($all_transfer_records);
        $total_quantity_transfered = 0;
        $total_expected_price = 0;
        $get_all_transactions = array();

        if (count($all_transfer_records) > 0) {
            foreach ($all_transfer_records as $transfer_record) {
                $product_id = $transfer_record->product_id;

                $get_all_with_each_product_id = WarehouseLogs::select_all_under_each_product_id($product_id);

                $product_name = $get_all_with_each_product_id[0]->name;
                $original_stock = $get_all_with_each_product_id[0]->original_stock;

                $count_product_ids_array = count($get_all_with_each_product_id);

                $quantity_transfered = 0;
                $expected_price = 0;

                for ($i=0; $i < $count_product_ids_array; $i++) {
                    $quantity_transfered = (double)$quantity_transfered + (double)$get_all_with_each_product_id[$i]->quantity_transfered_in_pieces;

                    $expected_price = (double)$expected_price + (double)$get_all_with_each_product_id[$i]->expected_price;
                }

                // dump($quantity_transfered);
                // dump($expected_price);

                // $total_quantity_transfered = (double)$total_quantity_transfered + (double)$quantity_transfered;
                // $total_expected_price = (double)$total_expected_price + (double)$expected_price;

                // dump($total_quantity_transfered);
                // dump($total_expected_price);

                // array_push( $get_all_transactions, ['product_name' => $product_name, 'original_stock'=> $original_stock, 'total_quantity_transfered'=>$total_quantity_transfered, 'total_expected_price'=>$total_expected_price]);

                array_push( $get_all_transactions, ['product_name' => $product_name, 'original_stock'=> $original_stock, 'total_quantity_transfered'=>$quantity_transfered, 'total_expected_price'=>$expected_price]);
            }

        }
        $all_data = json_encode($get_all_transactions);

        // ===========INDIVIDUAL RETAIL DETAILS ===============
        $response_from_retailer_dashboard = $this->retailer_dashboard();
        $individual_total_quantity_sold = $response_from_retailer_dashboard[0];
        $individual_total_expected_price = $response_from_retailer_dashboard[1];
        $individual_all_sales_data = $response_from_retailer_dashboard[2];
        // dd($individual_all_sales_data);

        $all_sales_audit_records = SalesAudit::get_all_sales_audit_records();

        return view('pages.home', compact('total_no_of_items', 'total_quantity_sold', 'total_expected_sold_price', 'all_data', 'individual_total_quantity_sold', 'individual_total_expected_price', 'individual_all_sales_data', 'all_sales_audit_records'));
    }


    public function retailer_dashboard(){
        $user_session = Session::get('user_session');
        $active_user = $user_session->first_name." ".$user_session->last_name;
        $firstname = $user_session->first_name;
        $last_name = $user_session->last_name;

        $today_date = Carbon::now()->format('Y-m-d');
        // dd($today_date->toDateTimeString());

        // ============GETTING DASHBOARD RECORDS=================
        $get_user_sales = Dashboard::get_retailer_sales($active_user, $today_date);

        $total_quantity_sold = 0;
        $total_expected_price = 0;
        if(count($get_user_sales) > 0){
            foreach ($get_user_sales as $sales_record) {
                $total_quantity_sold = $total_quantity_sold + $sales_record->quantity_sold;
                $total_expected_price = (double)$total_expected_price + (double)$sales_record->expected_price;
            }
        }

         // ============GETTING TABLE RECORDS=================
        $all_sales_records = Dashboard::get_sales_details_in_group($active_user, $today_date);

        $total_quantity_sold_per_product = 0;
        $total_expected_price_per_product = 0;
        $get_all_sales = array();

        if (count($all_sales_records) > 0) {

            foreach ($all_sales_records as $sales_record) {
                $product_id = $sales_record->product_id;

                $get_all_sales_under_each_product_id = Dashboard::select_all_sales_under_each_product_id($product_id, $active_user, $today_date);
                // dump($get_all_sales_under_each_product_id);

                $product_name = $get_all_sales_under_each_product_id[0]->name;
                $original_stock = $get_all_sales_under_each_product_id[0]->original_stock;

                $count_product_ids_array = count($get_all_sales_under_each_product_id);

                $quantity_sold = 0;
                $expected_price = 0;

                for ($i=0; $i < $count_product_ids_array; $i++) {
                    $quantity_sold = $quantity_sold + $get_all_sales_under_each_product_id[$i]->quantity_sold;
                    $expected_price = (double)$expected_price + (double)$get_all_sales_under_each_product_id[$i]->expected_price;
                }

                array_push( $get_all_sales, ['product_name' => $product_name, 'original_stock'=> $original_stock, 'total_quantity_sold_per_product'=>$quantity_sold, 'total_expected_price_per_product'=>$expected_price]);
            }

        }

        $all_sales_data = json_encode($get_all_sales);

        $response = [$total_quantity_sold, $total_expected_price, $all_sales_data];

        return $response;
    }



    public function filter_sales_records (Request $request){
        // dd($request->all());
        $request->validate([
            'txt_date_from' => 'required',
            'txt_date_to' => 'required',
            ], [
            'txt_date_from.required' => 'Start Date is required for filter',
            'txt_date_to.required' => 'End Date is required for filter',
        ]);

        $date_from = $request->get('txt_date_from');
        $date_to = $request->get('txt_date_to');


        $all_filter_records = array();

        $get_filter_records = Dashboard::filter_response($date_from, $date_to);

        if(count($get_filter_records) > 0){
            $total_quantity_sold = 0;
            $total_quantity_of_stocks = 0;
            $total_stock_left = 0;
            $total_expected_price = 0;
            foreach ($get_filter_records as $sales_record) {
                $total_quantity_sold = $total_quantity_sold + $sales_record->quantity_sold;
                $total_quantity_of_stocks = $total_quantity_of_stocks + $sales_record->original_stock;
                $total_stock_left = $total_stock_left + $sales_record->stock_after;
                $total_expected_price = (double)$total_expected_price + (double)$sales_record->expected_price;
            }

            array_push( $all_filter_records, ['date_from' => $date_from, 'date_to'=>$date_to, 'total_quantity_sold' => $total_quantity_sold, 'total_quantity_of_stocks'=> $total_quantity_of_stocks, 'total_stock_left'=>$total_stock_left, 'total_expected_price'=>$total_expected_price]);
        }
        else {
            Alert::toast('No records found within the selected date range','warning');
                return redirect()->back();
        }



        $all_transfer_records = WarehouseLogs::get_transfer_details_in_group();
        // dd($all_transfer_records);
        $total_quantity_transfered = 0;
        $total_expected_price = 0;
        $get_all_transactions = array();

        if (count($all_transfer_records) > 0) {
            foreach ($all_transfer_records as $transfer_record) {
                $product_id = $transfer_record->product_id;

                $get_all_with_each_product_id = WarehouseLogs::select_all_under_each_product_id($product_id);

                $product_name = $get_all_with_each_product_id[0]->name;
                $original_stock = $get_all_with_each_product_id[0]->original_stock;

                $count_product_ids_array = count($get_all_with_each_product_id);

                $quantity_transfered = 0;
                $expected_price = 0;

                for ($i=0; $i < $count_product_ids_array; $i++) {
                    $quantity_transfered = (double)$quantity_transfered + (double)$get_all_with_each_product_id[$i]->quantity_transfered_in_pieces;

                    $expected_price = (double)$expected_price + (double)$get_all_with_each_product_id[$i]->expected_price;
                }

                // $total_quantity_transfered = (double)$total_quantity_transfered + (double)$quantity_transfered;
                // $total_expected_price = (double)$total_expected_price + (double)$expected_price;

                // dump($total_quantity_transfered);
                // dump($total_expected_price);

                // array_push( $get_all_transactions, ['product_name' => $product_name, 'original_stock'=> $original_stock, 'total_quantity_transfered'=>$total_quantity_transfered, 'total_expected_price'=>$total_expected_price]);

                array_push( $get_all_transactions, ['product_name' => $product_name, 'original_stock'=> $original_stock, 'total_quantity_transfered'=>$quantity_transfered, 'total_expected_price'=>$expected_price]);
            }

        }

        $all_data = json_encode($get_all_transactions);

        // ===========INDIVIDUAL RETAIL DETAILS ===============
        $response_from_retailer_dashboard = $this->retailer_dashboard();
        $individual_total_quantity_sold = $response_from_retailer_dashboard[0];
        $individual_total_expected_price = $response_from_retailer_dashboard[1];
        $individual_all_sales_data = $response_from_retailer_dashboard[2];


        return view('pages.dashboard', compact('all_filter_records', 'all_data', 'individual_total_quantity_sold', 'individual_total_expected_price', 'individual_all_sales_data'));
    }

}
