<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Warehouse extends Model
{
    protected $table = 'tbl_warehouse';
    public $timestamps = false;

    public static function get_each_product_details(){

        try{
            return  DB::table('tbl_products')
            ->select( 'tbl_products.*', 'tbl_warehouse.*')
            ->join('tbl_warehouse', 'tbl_warehouse.product_id', '=', 'tbl_products.id')
            // ->where('tbl_products.id', '=', $product_id)
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }

    public static function select_product(String $product_id){
        try {
            return  DB::table('tbl_warehouse')
            ->where('product_id', '=', $product_id)
            ->get();
        } catch (exception $e) {
            echo 'Caught exception';
        }
    }
}
