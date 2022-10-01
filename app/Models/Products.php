<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    protected $table = 'tbl_products';

    public static function select_product(String $product_id){
        try {
            return  DB::table('tbl_products')
            ->where('id', '=', $product_id)
            ->get();
        } catch (exception $e) {
            echo 'Caught exception';
        }
    }

    public static function select_products_in_warehouse(){
        try {
            return  DB::table('tbl_products')
            ->select( 'tbl_products.*')
            ->join('tbl_warehouse', 'tbl_warehouse.product_id', '=', 'tbl_products.id')
            ->get();
        } catch (exception $e) {
            echo 'Caught exception';
        }
    }

    public static function select_products_in_retail(){
        try {
            return  DB::table('tbl_products')
            ->select( 'tbl_products.*')
            ->join('tbl_retail', 'tbl_retail.product_id', '=', 'tbl_products.id')
            ->get();
        } catch (exception $e) {
            echo 'Caught exception';
        }
    }
}
