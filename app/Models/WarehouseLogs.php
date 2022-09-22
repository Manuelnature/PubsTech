<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class WarehouseLogs extends Model
{
    protected $table = 'tbl_warehouse_logs';


    public static function select_product(String $product_id){
        return  DB::table('tbl_warehouse_logs')
        ->where('product_id', '=', $product_id)
        ->orderBy('id', 'desc')
        ->limit(1)
        ->get();
    }


    public static function get_transfer_details(){
        try{
            return  DB::table('tbl_products')
            ->select('tbl_products.id', 'tbl_products.name', 'tbl_warehouse_logs.*')
            ->join('tbl_warehouse_logs', 'tbl_warehouse_logs.product_id', '=', 'tbl_products.id')
            ->orderBy('tbl_warehouse_logs.created_at', 'desc')
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }

    public static function get_transfer_details_in_group(){
        try{
            return  DB::table('tbl_warehouse_logs')
            ->select('tbl_warehouse_logs.product_id')
            ->groupBy('product_id')
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }

    public static function select_all_under_each_product_id($product_id){
        try{
            return  DB::table('tbl_products')
            ->select('tbl_products.*', 'tbl_warehouse_logs.*')
            ->join('tbl_warehouse_logs', 'tbl_warehouse_logs.product_id', '=', 'tbl_products.id')
            ->where('tbl_products.id', '=', $product_id)
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }

}

