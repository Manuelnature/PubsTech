<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sales extends Model
{
    protected $table = 'tbl_sales';

    public static function select_product(String $product_id){
        return  DB::table('tbl_sales')
        ->where('product_id', '=', $product_id)
        ->orderBy('id', 'desc')
        ->limit(1)
        ->get();
    }

    public static function get_sales_details(){
        try{
            return  DB::table('tbl_products')
            ->select('tbl_products.id', 'tbl_products.name', 'tbl_sales.*')
            ->join('tbl_sales', 'tbl_sales.product_id', '=', 'tbl_products.id')
            ->orderBy('tbl_sales.created_at', 'desc')
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }

    public static function get_individual_sales_details_for_today(String $username, String $today_date){
        try{
            return  DB::table('tbl_products')
            ->select('tbl_products.id', 'tbl_products.name', 'tbl_sales.*')
            ->join('tbl_sales', 'tbl_sales.product_id', '=', 'tbl_products.id')
            ->where('tbl_sales.created_by', '=',  $username)
            ->where(DB::raw('CAST(tbl_sales.created_at as date)'), '=',  $today_date)
            ->orderBy('tbl_sales.created_at', 'desc')
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }

    public static function get_sales_details_in_group(){
        try{
            return  DB::table('tbl_sales')
            ->select('tbl_sales.product_id')
            ->groupBy('product_id')
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }

    public static function select_last_sale_under_each_product_id($product_id, $date_and_time_now){
        try{
            return  DB::table('tbl_products')
            ->select('tbl_products.*', 'tbl_sales.*')
            ->join('tbl_sales', 'tbl_sales.product_id', '=', 'tbl_products.id')
            ->where('tbl_products.id', '=', $product_id)
            ->where('tbl_sales.created_at', '<=', $date_and_time_now)
            ->orderBy('tbl_sales.id', 'desc')
            ->limit(1)
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }

}
