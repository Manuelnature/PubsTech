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
}
