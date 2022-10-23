<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Retail extends Model
{
    protected $table = 'tbl_retail';
    public $timestamps = false;

    public static function get_each_product_details(){
        try{
            return  DB::table('tbl_products')
            ->select( 'tbl_products.*', 'tbl_retail.*')
            ->join('tbl_retail', 'tbl_retail.product_id', '=', 'tbl_products.id')
            // ->where('tbl_products.id', '=', $product_id)
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }

}
