<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dashboard extends Model
{
    public static function filter_response(String $date_from, String $date_to){
        return DB::table('tbl_sales')
            ->select('tbl_sales.*')
            ->where(DB::raw('CAST(created_at as date)'), '>=',  $date_from)
            ->where(DB::raw('CAST(created_at as date)'), '<=',  $date_to)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public static function get_retailer_sales($username, $today_date){
        return DB::table('tbl_sales')
            ->select('tbl_sales.*')
            ->where('created_by', '=',  $username)
            ->where(DB::raw('CAST(created_at as date)'), '=',  $today_date)
            ->get();
    }

    public static function get_sales_details_in_group( $username, $today_date){
        try{
            return  DB::table('tbl_sales')
            ->select('tbl_sales.product_id')
            ->where('created_by', '=',  $username)
            ->where(DB::raw('CAST(created_at as date)'), '=',  $today_date)
            ->groupBy('product_id')
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }

    public static function select_all_sales_under_each_product_id($product_id, $username, $today_date){
        try{
            return  DB::table('tbl_products')
            ->select('tbl_products.id', 'tbl_products.name', 'tbl_sales.*')
            ->join('tbl_sales', 'tbl_sales.product_id', '=', 'tbl_products.id')
            ->where('tbl_products.id', '=', $product_id)
            ->where('tbl_sales.created_by', '=',  $username)
            ->where(DB::raw('CAST(tbl_sales.created_at as date)'), '=',  $today_date)
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }


    public static function get_all_sales_details_in_group(){
        try{
            return  DB::table('tbl_sales')
            ->select('tbl_sales.product_id')
            ->groupBy('product_id')
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }

    public static function get_all_sales_detail_of_each_product($product_id){
        try{
            return  DB::table('tbl_products')
            ->select('tbl_products.id', 'tbl_products.name', 'tbl_sales.*')
            ->join('tbl_sales', 'tbl_sales.product_id', '=', 'tbl_products.id')
            ->where('tbl_products.id', '=', $product_id)
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }


    public static function get_transfer_product_ids_in_group($date_from, $date_to){
        try{
            return  DB::table('tbl_warehouse_logs')
            ->select('tbl_warehouse_logs.product_id')
            ->where(DB::raw('CAST(created_at as date)'), '>=',  $date_from)
            ->where(DB::raw('CAST(created_at as date)'), '<=',  $date_to)
            ->groupBy('product_id')
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }

    public static function select_all_transfers_under_each_product($product_id, $date_from, $date_to){
        try{
            return  DB::table('tbl_products')
            ->select('tbl_products.*', 'tbl_warehouse_logs.*')
            ->join('tbl_warehouse_logs', 'tbl_warehouse_logs.product_id', '=', 'tbl_products.id')
            ->where('tbl_products.id', '=', $product_id)
            ->where(DB::raw('CAST(tbl_warehouse_logs.created_at as date)'), '>=',  $date_from)
            ->where(DB::raw('CAST(tbl_warehouse_logs.created_at as date)'), '<=',  $date_to)
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }


    public static function get_sales_product_ids_in_group($date_from, $date_to){
        try{
            return  DB::table('tbl_sales')
            ->select('tbl_sales.product_id')
            ->where(DB::raw('CAST(created_at as date)'), '>=',  $date_from)
            ->where(DB::raw('CAST(created_at as date)'), '<=',  $date_to)
            ->groupBy('product_id')
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }


    public static function select_all_sales_under_each_product($product_id, $date_from, $date_to){
        try{
            return  DB::table('tbl_products')
            ->select('tbl_products.id', 'tbl_products.name', 'tbl_sales.*')
            ->join('tbl_sales', 'tbl_sales.product_id', '=', 'tbl_products.id')
            ->where('tbl_products.id', '=', $product_id)
            ->where(DB::raw('CAST(tbl_sales.created_at as date)'), '>=',  $date_from)
            ->where(DB::raw('CAST(tbl_sales.created_at as date)'), '<=',  $date_to)
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }

    public static function sales_start_date(){
        try{
            return  DB::table('tbl_sales')
            ->select('tbl_sales.created_at')
            // ->where('tbl_sales.created_at', '<=', $date_and_time_now)
            ->orderBy('tbl_sales.created_at', 'asc')
            ->limit(1)
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }

    public static function sales_end_date(){
        try{
            return  DB::table('tbl_sales')
            ->select('tbl_sales.created_at')
            ->orderBy('tbl_sales.created_at', 'desc')
            ->limit(1)
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }

    public static function transfer_start_date(){
        try{
            return  DB::table('tbl_warehouse_logs')
            ->select('tbl_warehouse_logs.created_at')
            ->orderBy('tbl_warehouse_logs.created_at', 'asc')
            ->limit(1)
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }

    public static function transfer_end_date(){
        try{
            return  DB::table('tbl_warehouse_logs')
            ->select('tbl_warehouse_logs.created_at')
            ->orderBy('tbl_warehouse_logs.created_at', 'desc')
            ->limit(1)
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }


    public static function get_all_sales(){
        try{
            return  DB::table('tbl_sales')
            ->select('tbl_sales.*')
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }


    public static function get_all_filter_sales($date_from, $date_to){
        try{
            return  DB::table('tbl_sales')
            ->select('tbl_sales.*')
            ->whereBetween(DB::raw('CAST(created_at as date)'), [$date_from, $date_to])
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }


}
