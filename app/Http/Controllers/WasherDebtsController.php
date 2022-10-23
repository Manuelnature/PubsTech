<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Service;
use App\Models\CarWasher;
use App\Models\WasherDebts;
use App\Models\Vehicle;
use Session;
use Carbon\Carbon;
use Log;

class WasherDebtsController extends Controller
{
    public function index(){
        $all_washers = CarWasher::all();
        $all_services = Service::all();
        $all_vehicles = Vehicle::all();
        return view('car_wash.washer_debt', compact('all_washers', 'all_services', 'all_vehicles'));
    }
}
