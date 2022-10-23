<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Dashboard;
use App\Models\Sales;
use App\Models\SalesAudit;
use App\Models\Retail;
use App\Models\WarehouseLogs;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // public function index(){
    //     return view('pages.dashboard');
    // }

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


        // $current_time = Carbon::now()->toDateTimeString();
        $last_audit_time = SalesAudit::select_audit();
        if(count($last_audit_time) > 0){
            $last_audit_time = $last_audit_time[0]->created_at;
            $all_sales_audit_records = SalesAudit::get_all_product_audit_records($last_audit_time);
            // dd($all_sales_audit_records);
        }
        else{
            $all_sales_audit_records = array();
            // $get_warehouse_records  = array();
        }

        $get_retail_records = Retail::get_each_product_details();


        $all_transaction_dates = array();
        $overall_sales_record = $this->overall_sales_record();

        $get_sales_start_date = Dashboard::sales_start_date();
        if (count($get_sales_start_date) > 0) {
            $sales_start_date = $get_sales_start_date[0]->created_at;
        } else {
            $sales_start_date = Carbon::now()->format('Y-m-d');
        }


        $get_sales_end_date = Dashboard::sales_end_date();
        if (count($get_sales_end_date) > 0) {
            $sales_end_date = $get_sales_end_date[0]->created_at;
        } else {
            $sales_end_date = "";
        }

        array_push( $all_transaction_dates, ['sales_start_date' => $sales_start_date, 'sales_end_date'=>$sales_end_date]);

        return view('pages.retailer_dashboard', compact('total_quantity_sold', 'total_expected_price', 'all_sales_data', 'all_sales_audit_records', 'get_retail_records', 'overall_sales_record', 'all_transaction_dates'));
    }


    public function overall_sales_record(){
        $user_session = Session::get('user_session');
        $active_user = $user_session->first_name." ".$user_session->last_name;
        $firstname = $user_session->first_name;
        $last_name = $user_session->last_name;


        // ============ GETTING TABLE RECORDS=================
        $all_sales_records = Dashboard::get_all_sales_details_in_group();

        $total_quantity_sold_per_product = 0;
        $total_expected_price_per_product = 0;
        $get_all_sales = array();

        if (count($all_sales_records) > 0) {

            foreach ($all_sales_records as $sales_record) {
                $product_id = $sales_record->product_id;

                $get_all_sales_under_each_product = Dashboard::get_all_sales_detail_of_each_product($product_id);

                $product_name = $get_all_sales_under_each_product[0]->name;
                // $original_stock = $get_all_sales_under_each_product[0]->original_stock;

                $count_product_ids_array = count($get_all_sales_under_each_product);

                $quantity_sold = 0;
                $expected_price = 0;

                for ($i=0; $i < $count_product_ids_array; $i++) {
                    $quantity_sold = $quantity_sold + $get_all_sales_under_each_product[$i]->quantity_sold;
                    $expected_price = (double)$expected_price + (double)$get_all_sales_under_each_product[$i]->expected_price;
                }

                array_push( $get_all_sales, ['product_name' => $product_name, 'total_quantity_sold_per_product'=>$quantity_sold, 'total_expected_price_per_product'=>$expected_price]);
            }

        }
        else {
            array_push( $get_all_sales, ['product_name' => '', 'total_quantity_sold_per_product'=> 0, 'total_expected_price_per_product'=> 0]);
        }

        $overall_sales_data = json_encode($get_all_sales);

        return $overall_sales_data;
    }
}
