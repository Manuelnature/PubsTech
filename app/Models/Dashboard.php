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

    public static function get_retailer_sales(String $username, String $today_date){
        return DB::table('tbl_sales')
            ->select('tbl_sales.*')
            ->where('created_by', '=',  $username)
            ->where(DB::raw('CAST(created_at as date)'), '=',  $today_date)
            ->get();
    }

    public static function get_sales_details_in_group(String $username, String $today_date){
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

    public static function select_all_sales_under_each_product_id($product_id, String $username, String $today_date){
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


}
