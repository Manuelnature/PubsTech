<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SalesAudit extends Model
{
    protected $table = 'tbl_sales_audit';
    public $timestamps = false;

    public static function get_all_sales_audit_records(){
        try{
            return  DB::table('tbl_products')
            ->select('tbl_products.*', 'tbl_sales_audit.*', 'tbl_users.*')
            ->join('tbl_sales_audit', 'tbl_sales_audit.product_id', '=', 'tbl_products.id')
            ->join('tbl_users', 'tbl_sales_audit.user_id', '=', 'tbl_users.id')
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }
}
