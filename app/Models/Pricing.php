<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pricing extends Model
{
    protected $table = 'tbl_pricing';
    public $timestamps = false;

    public static function select_all_pricing(){
        try{
            return  DB::table('tbl_pricing')
            ->select('tbl_vehicle_type.*', 'tbl_vehicles.*', 'tbl_vehicles.name AS vehicle_name', 'tbl_services.name AS service_name', 'tbl_services.*', 'tbl_pricing.*', 'tbl_vehicle_type.name AS vehicle_type_name')
            ->join('tbl_services', 'tbl_services.id', '=', 'tbl_pricing.service_id')
            ->join('tbl_vehicles', 'tbl_vehicles.id', '=', 'tbl_pricing.vehicle_id')
            ->join('tbl_vehicle_type', 'tbl_vehicle_type.id', '=', 'tbl_vehicles.vehicle_type')
            ->get();
        }catch(exception $e){
            echo 'Caught exception';
        }
    }
}
