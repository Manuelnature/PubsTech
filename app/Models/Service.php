<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Service extends Model
{
    protected $table = 'tbl_services';
    public $timestamps = false;

    public static function get_all_services(){
        try{
            return  DB::table('tbl_vehicles')
            ->select( 'tbl_vehicles.*', 'tbl_services.*')
            ->join('tbl_services', 'tbl_services.vehicle_id', '=', 'tbl_vehicles.id')
            ->get();
        }catch(exception $e){
            echo 'Caught exception';
        }
    }

    // public static function get_all_services(){
    //     try{
    //         return  DB::table('tbl_services')
    //         ->select( 'tbl_services.vehicle_id')
    //         // ->join('tbl_services', 'tbl_services.vehicle_id', '=', 'tbl_vehicles.id')
    //         ->groupBy('vehicle_id')
    //         ->get();

    //     }catch(exception $e){
    //         echo 'Caught exception';
    //     }
    // }
}
