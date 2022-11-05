<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WashingTransaction extends Model
{
    protected $table = 'tbl_washing_transactions';
    public $timestamps = false;

    public static function select_all_washing_transactions(){
        try{
            return  DB::table('tbl_washing_transactions')
            ->select( 'tbl_car_washers.*', 'tbl_washing_transactions.*', 'tbl_vehicle_type.*', 'tbl_vehicle_type.name AS vehicle_type_name', 'tbl_washing_transactions.description AS transaction_description', 'tbl_washing_transactions.id AS transaction_id', 'tbl_washing_transactions.created_at AS created_at')
            ->join('tbl_vehicle_type', 'tbl_vehicle_type.id', '=', 'tbl_washing_transactions.vehicle_type_id')
            ->join('tbl_car_washers', 'tbl_car_washers.id', '=', 'tbl_washing_transactions.washer_id')
            ->get();
        }catch(exception $e){
            echo 'Caught exception';
        }
    }

    public static function select_transaction_to_edit($id){
        try{
            return  DB::table('tbl_washing_transactions')
            ->select('tbl_car_washers.*', 'tbl_washing_transactions.*', 'tbl_vehicle_type.*', 'tbl_vehicle_type.name AS vehicle_type_name', 'tbl_washing_transactions.description AS transaction_description', 'tbl_washing_transactions.id AS transaction_id')
            ->join('tbl_vehicle_type', 'tbl_vehicle_type.id', '=', 'tbl_washing_transactions.vehicle_type_id')
            ->join('tbl_car_washers', 'tbl_car_washers.id', '=', 'tbl_washing_transactions.washer_id')
            ->where('tbl_washing_transactions.id', '=', $id)
            ->get();
        }catch(exception $e){
            echo 'Caught exception';
        }
    }

    public static function select_filter_washing_transactions($date_from, $date_to){
        try{
            return  DB::table('tbl_washing_transactions')
            ->select( 'tbl_car_washers.*', 'tbl_washing_transactions.*', 'tbl_vehicle_type.*', 'tbl_vehicle_type.name AS vehicle_type_name', 'tbl_washing_transactions.description AS transaction_description', 'tbl_washing_transactions.id AS transaction_id', 'tbl_washing_transactions.created_at AS created_at')
            ->join('tbl_vehicle_type', 'tbl_vehicle_type.id', '=', 'tbl_washing_transactions.vehicle_type_id')
            ->join('tbl_car_washers', 'tbl_car_washers.id', '=', 'tbl_washing_transactions.washer_id')
            ->whereBetween(DB::raw('CAST(tbl_washing_transactions.created_at as date)'), [$date_from, $date_to])
            ->get();
        }catch(exception $e){
            echo 'Caught exception';
        }
    }



    public static function select_individual_washing_transactions($washer_id){
        try{
            return  DB::table('tbl_washing_transactions')
            ->select( 'tbl_car_washers.*', 'tbl_washing_transactions.*', 'tbl_vehicle_type.*', 'tbl_vehicle_type.name AS vehicle_type_name', 'tbl_washing_transactions.description AS transaction_description', 'tbl_washing_transactions.id AS transaction_id', 'tbl_washing_transactions.created_at AS created_at')
            ->join('tbl_vehicle_type', 'tbl_vehicle_type.id', '=', 'tbl_washing_transactions.vehicle_type_id')
            ->join('tbl_car_washers', 'tbl_car_washers.id', '=', 'tbl_washing_transactions.washer_id')
            ->where('tbl_washing_transactions.washer_id', '=', $washer_id)
            ->get();
        }catch(exception $e){
            echo 'Caught exception';
        }
    }
}
