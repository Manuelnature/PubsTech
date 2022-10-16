<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Service;
use App\Models\Vehicle;
use Session;
use Carbon\Carbon;
use Log;

class ServicesController extends Controller
{
    public function index(){
        $all_vehicles = Vehicle::all();
        $all_services = Service::get_all_services();
        // dd( $all_services);
        return view('car_wash.services', compact('all_vehicles','all_services'));
    }

    public function add_service(Request $request){
        try {
            $request->validate([
                'txt_service_name' => 'required',
                'txt_vehicle_type' => 'required',
                'txt_service_price' => 'required',
                'txt_washer_percentage' => 'required',
            ], [
                'txt_service_name.required' => 'Service Name is required',
                'txt_vehicle_type.required' => 'Vehicle Type is required',
                'txt_service_price.required' => 'Service Price is required',
                'txt_washer_percentage.required' => 'Washer Percentage is required',
            ]);
            $service_name = ucwords($request->get('txt_service_name'));
            $vehicle_type = ucwords($request->get('txt_vehicle_type'));
            $price = $request->get('txt_service_price');
            $washer_percentage = $request->get('txt_washer_percentage');
            $description = Str::ucfirst($request->get('txt_service_description'));
            $user_session = Session::get('user_session');
            $active_user = $user_session->first_name." ".$user_session->last_name;

            $add_service = new Service();
            $add_service->name = $service_name;
            $add_service->vehicle_id = $vehicle_type;
            $add_service->price = $price;
            $add_service->washer_percentage = $washer_percentage;
            $add_service->description = $description;
            $add_service->created_by = $active_user;
            $add_service->save();

            Alert::toast('New Service Added','success');
            return back();

        } catch (exception $e) {
            echo 'Caught exception';
        }

    }

    public function update_service(Request $request){
        try {
            $request->validate([
                'txt_edit_service_name' => 'required',
                'txt_edit_vehicle_type' => 'required',
                'txt_edit_sevice_price' => 'required',
                'txt_edit_washer_percentage' => 'required',
            ], [
                'txt_edit_service_name.required' => 'Service Name is required',
                'txt_edit_vehicle_type.required' => 'Vehicle Type is required',
                'txt_edit_sevice_price.required' => 'Service Price is required',
                'txt_edit_washer_percentage.required' => 'Washer Percentage is required',
            ]);
            $service_id = $request->get('service_id');
            // $vehicle_id = $request->get('vehicle_id');
            // dd($vehicle_id);
            $service_name = ucwords($request->get('txt_edit_service_name'));
            $vehicle_id = ucwords($request->get('txt_edit_vehicle_type'));
            $price = $request->get('txt_edit_sevice_price');
            $washer_percentage = $request->get('txt_edit_washer_percentage');
            $description = Str::ucfirst($request->get('txt_edit_service_description'));
            $user_session = Session::get('user_session');
            $active_user = $user_session->first_name." ".$user_session->last_name;
            $current_date_and_time = Carbon::now()->toDateTimeString();

            // Log::channel('my_logs')->info('AAAAAAAAAAAAAAAAAAAAAAAAAA');
            $update_service = Service::find($service_id);
            $update_service->name = $service_name;
            $update_service->vehicle_id = $vehicle_id;
            $update_service->price = $price;
            $update_service->washer_percentage = $washer_percentage;
            $update_service->description = $description;
            $update_service->updated_by = $active_user;
            $update_service->updated_at = $current_date_and_time;
            $update_service->save();

            Alert::toast('Service Info Updated','success');
            return back();

        } catch (exception $e) {
            echo 'Caught exception';
        }

    }
}
