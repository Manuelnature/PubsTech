<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Vehicle;
use Session;
use Carbon\Carbon;

class VehiclesController extends Controller
{
    public function index(){
        $all_vehicles = Vehicle::all();
        return view('car_wash.vehicles', compact('all_vehicles'));
    }

    public function add_vehicle(Request $request){
        try {
            $request->validate([
                'txt_vehicle_name' => 'required',
                'txt_vehicle_type' => 'required',
            ], [
                'txt_vehicle_name.required' => 'Vehicle Name is required',
                'txt_vehicle_type.required' => 'Vehicle Type is required',
            ]);
            $vehicle_name = ucwords($request->get('txt_vehicle_name'));
            $vehicle_type = ucwords($request->get('txt_vehicle_type'));
            $description = Str::ucfirst($request->get('txt_vehicle_description'));
            $user_session = Session::get('user_session');
            $active_user = $user_session->first_name." ".$user_session->last_name;

            $add_new_vehicle = new Vehicle();
            $add_new_vehicle->name = $vehicle_name;
            $add_new_vehicle->type = $vehicle_type;
            $add_new_vehicle->description = $description;
            $add_new_vehicle->created_by = $active_user;
            $add_new_vehicle->save();

            Alert::toast('New Vehicle Added','success');
            return back();

        } catch (exception $e) {
            echo 'Caught exception';
        }

    }

    public function update_vehicle(Request $request){
        try {
            $request->validate([
                'txt_edit_vehice_name' => 'required',
                'txt_edit_vehicle_type' => 'required',
            ], [
                'txt_edit_vehice_name.required' => 'Vehicle Name is required',
                'txt_edit_vehicle_type.required' => 'Vehicle Type is required',
            ]);
            $vehicle_id = $request->get('vehicle_id');
            $vehicle_name = ucwords($request->get('txt_edit_vehice_name'));
            $vehicle_type = ucwords($request->get('txt_edit_vehicle_type'));
            $description = Str::ucfirst($request->get('txt_edit_vehicle_description'));

            $user_session = Session::get('user_session');
            $active_user = $user_session->first_name." ".$user_session->last_name;
            $current_date_and_time = Carbon::now()->toDateTimeString();

            $update_vehicle =  Vehicle::find($vehicle_id);
            $update_vehicle->name = $vehicle_name;
            $update_vehicle->type = $vehicle_type;
            $update_vehicle->description = $description;
            $update_vehicle->updated_by = $active_user;
            $update_vehicle->updated_at = $current_date_and_time;
            $update_vehicle->save();

            Alert::toast('Vehicle Info Updated','success');
            return back();

        } catch (exception $e) {
            echo 'Caught exception';
        }

    }

}
