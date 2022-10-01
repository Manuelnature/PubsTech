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

    public static function sales_audit_record_for_user($current_user_id, $product_id){
        try{
            return  DB::table('tbl_sales_audit')
            ->select('tbl_sales_audit.*')
            ->where('user_id', $current_user_id)
            ->where('product_id', $product_id)
            // ->where(DB::raw('CAST(created_at as date)'), '=',  $today_date)
            ->orderBy('created_at', 'desc')
            ->limit(1)
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }


    public static function select_audit(){
        return  DB::table('tbl_sales_audit')
        ->select('created_at')
        ->orderBy('created_at', 'desc')
        ->limit(1)
        ->get();
    }

    public static function get_all_product_audit_records($last_audit_time){
        try{
            return  DB::table('tbl_products')
            ->select('tbl_products.*', 'tbl_sales_audit.*', 'tbl_users.*')
            ->join('tbl_sales_audit', 'tbl_sales_audit.product_id', '=', 'tbl_products.id')
            ->join('tbl_users', 'tbl_sales_audit.user_id', '=', 'tbl_users.id')
            ->where('tbl_sales_audit.created_at', '=', $last_audit_time)
            ->get();

        }catch(exception $e){
            echo 'Caught exception';
        }
    }
}
