<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vehicle extends Model
{
    protected $table = 'tbl_vehicles';
    public $timestamps = false;


    public static function select_all_vehicles(){
        try{
            return  DB::table('tbl_vehicles')
            ->select( 'tbl_vehicles.*','tbl_vehicles.description AS vehicle_description', 'tbl_vehicles.name AS vehicle_name', 'tbl_vehicle_type.*', 'tbl_vehicle_type.name AS vehicle_type_name','tbl_vehicle_type.id AS vehicle_type_id', 'tbl_vehicles.id AS vehicle_id',)
            ->join('tbl_vehicle_type', 'tbl_vehicle_type.id', '=', 'tbl_vehicles.vehicle_type')
            ->get();
        }catch(exception $e){
            echo 'Caught exception';
        }
    }
}
