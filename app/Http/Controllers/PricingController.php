<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Service;
use App\Models\Vehicle;
use App\Models\Pricing;
use App\Models\VehicleType;
use Session;
use Carbon\Carbon;
use Log;

class PricingController extends Controller
{
    public function index(){
        // $all_vehicles = Vehicle::all();
        // $all_vehicles = Vehicle::select_all_vehicles();
        // $all_services = Service::get_all_services();
        $all_services = Service::all();
        $all_pricing = Pricing::select_all_pricing();
        // dd($all_pricing);
        $all_vehicles_types = VehicleType::all();
        return view('car_wash.pricing', compact('all_services', 'all_pricing', 'all_vehicles_types'));
    }


    public function set_price(Request $request){
        try {
            $request->validate([
                'txt_service_id' => 'required',
                'txt_vehicle_id' => 'required',
                'txt_service_price' => 'required',
            ], [
                'txt_service_id.required' => 'Service Name is required',
                'txt_vehicle_id.required' => 'Vehicle Type is required',
                'txt_service_price.required' => 'Service Price is required',
            ]);
            $service_id= $request->get('txt_service_id');
            $vehicle_type_id= $request->get('txt_vehicle_id');
            $price = $request->get('txt_service_price');
            $description = Str::ucfirst($request->get('txt_pricing_description'));
            $user_session = Session::get('user_session');
            // $active_user = $user_session->first_name." ".$user_session->last_name;
            $active_user = $user_session->username;

            $add_pricing = new Pricing();
            $add_pricing->service_id = $service_id;
            $add_pricing->vehicle_type_id = $vehicle_type_id;
            $add_pricing->price = $price;
            $add_pricing->description = $description;
            $add_pricing->created_by = $active_user;
            $add_pricing->save();

            Alert::toast('Service Pricing set successfully','success');
            return back();

        } catch (exception $e) {
            echo 'Caught exception';
        }
    }

    public function update_price(Request $request){
        try {
            $request->validate([
                'txt_edit_service_id' => 'required',
                'txt_edit_vehicle_id' => 'required',
                'txt_edit_sevice_price' => 'required',
            ], [
                'txt_edit_service_id.required' => 'Service Name is required',
                'txt_edit_vehicle_id.required' => 'Vehicle Type is required',
                'txt_edit_sevice_price.required' => 'Service Price is required',
            ]);
            $pricing_id= $request->get('pricing_id');
            $service_id= $request->get('txt_edit_service_id');
            $vehicle_type_id= $request->get('txt_edit_vehicle_id');
            $price = $request->get('txt_edit_sevice_price');
            $description = Str::ucfirst($request->get('txt_edit_pricing_description'));
            $user_session = Session::get('user_session');
            // $active_user = $user_session->first_name." ".$user_session->last_name;
            $active_user = $user_session->username;
            $current_date_and_time = Carbon::now()->toDateTimeString();

            $update_pricing = Pricing::find($pricing_id);
            $update_pricing->service_id = $service_id;
            $update_pricing->vehicle_type_id = $vehicle_type_id;
            $update_pricing->price = $price;
            $update_pricing->description = $description;
            $update_pricing->updated_by = $active_user;
            $update_pricing->updated_at = $current_date_and_time;
            $update_pricing->save();

            Alert::toast('Service pricing updated successfully','success');
            return back();

        } catch (exception $e) {
            echo 'Caught exception';
        }
    }
}
