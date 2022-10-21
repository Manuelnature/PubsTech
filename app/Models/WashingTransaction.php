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
            ->select( 'tbl_vehicles.*', 'tbl_car_washers.*', 'tbl_washing_transactions.*', 'tbl_vehicle_type.*', 'tbl_vehicle_type.name AS vehicle_type_name', 'tbl_vehicles.name AS vehicle_name','tbl_washing_transactions.description AS transaction_description' )
            ->join('tbl_vehicles', 'tbl_vehicles.id', '=', 'tbl_washing_transactions.vehicle_id')
            ->join('tbl_car_washers', 'tbl_car_washers.id', '=', 'tbl_washing_transactions.washer_id')
            ->join('tbl_vehicle_type', 'tbl_vehicle_type.id', '=', 'tbl_vehicles.vehicle_type')
            ->get();
        }catch(exception $e){
            echo 'Caught exception';
        }
    }

    public static function select_transaction_to_edit($id){
        try{
            return  DB::table('tbl_washing_transactions')
            ->select( 'tbl_vehicles.*', 'tbl_car_washers.*', 'tbl_washing_transactions.*', 'tbl_vehicle_type.*', 'tbl_vehicle_type.name AS vehicle_type_name', 'tbl_vehicles.name AS vehicle_name', 'tbl_washing_transactions.description AS transaction_description')
            ->join('tbl_vehicles', 'tbl_vehicles.id', '=', 'tbl_washing_transactions.vehicle_id')
            ->join('tbl_car_washers', 'tbl_car_washers.id', '=', 'tbl_washing_transactions.washer_id')
            ->join('tbl_vehicle_type', 'tbl_vehicle_type.id', '=', 'tbl_vehicles.vehicle_type')
            ->where('tbl_washing_transactions.id', '=', $id)
            ->get();
        }catch(exception $e){
            echo 'Caught exception';
        }
    }
}
