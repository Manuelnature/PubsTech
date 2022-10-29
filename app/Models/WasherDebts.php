<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class WasherDebts extends Model
{
    protected $table = 'tbl_washer_debts';
    public $timestamps = false;

    public static function get_all_debts(){
        try{
            return  DB::table('tbl_washer_debts')
            ->select( 'tbl_washer_debts.*', 'tbl_car_washers.*', 'tbl_washer_debts.id AS debt_id', 'tbl_car_washers.id AS washer_id', 'tbl_washer_debts.created_at AS created_at')
            ->join('tbl_car_washers', 'tbl_car_washers.id', '=', 'tbl_washer_debts.washer_id')
            ->get();
        }catch(exception $e){
            echo 'Caught exception';
        }
    }

}
