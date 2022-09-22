<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Dashboard;
use App\Models\Sales;
use App\Models\SalesAudit;
use App\Models\WarehouseLogs;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        return view('pages.dashboard');
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
                // dump('Quantity Sold '.$quantity_sold);
                // dump('Expected_price '.$expected_price);

                // $total_quantity_sold_per_product = (double)$total_quantity_sold_per_product + (double)$quantity_sold;
                // $total_expected_price_per_product = (double)$total_expected_price_per_product + (double)$expected_price;

                // dump('Total Quantity Sold '.$total_quantity_sold_per_product);
                // dump('Total Expected '.$total_expected_price_per_product);

                // array_push( $get_all_sales, ['product_name' => $product_name, 'original_stock'=> $original_stock, 'total_quantity_sold_per_product'=>$total_quantity_sold_per_product, 'total_expected_price_per_product'=>$total_expected_price_per_product]);

                array_push( $get_all_sales, ['product_name' => $product_name, 'original_stock'=> $original_stock, 'total_quantity_sold_per_product'=>$quantity_sold, 'total_expected_price_per_product'=>$expected_price]);

            }

        }

        $all_sales_data = json_encode($get_all_sales);



        // $current_user_id = $user_session->id;
        // $sales_audit_records = array();
        // $date_and_time_now = Carbon::now()->toDateTimeString();

        // $all_sales_records_for_audit = Sales::get_sales_details_in_group();
        // if (count($all_sales_records_for_audit) > 0) {
        //     foreach ($all_sales_records_for_audit as $sales_record) {
        //         $product_id = $sales_record->product_id;

        //         $last_sale_under_each_product_id = Sales::select_last_sale_under_each_product_id($product_id, $date_and_time_now);
        //         if(count($last_sale_under_each_product_id) > 0){
        //             foreach ($last_sale_under_each_product_id as $last_sale) {
        //                 $main_product_id = $last_sale->product_id;
        //                 $product_name = $last_sale->name;
        //                 $price_per_item = $last_sale->price_per_item;
        //                 $stock_left = $last_sale->stock_after;

        //                 //====Save in Sales Audit DB ==============
        //                 $sales_audit = new SalesAudit();
        //                 $sales_audit->user_id = $current_user_id;
        //                 $sales_audit->product_id = $main_product_id;
        //                 $sales_audit->starting_stock = $stock_left;
        //                 $sales_audit->sales_date = $today_date;
        //                 $sales_audit->save();

        //                 array_push( $sales_audit_records, ['product_name' => $product_name, 'price_per_item'=> $price_per_item, 'stock_left'=>$stock_left]);
        //             }
        //         }

        //     }
        // }
        // $all_sales_audit_records = json_encode($sales_audit_records);

        $all_sales_audit_records = SalesAudit::get_all_sales_audit_records();
        // dd($all_sales_audit_records);

        return view('pages.retailer_dashboard', compact('total_quantity_sold', 'total_expected_price', 'all_sales_data', 'all_sales_audit_records'));
    }
}
