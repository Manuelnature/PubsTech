<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Service;
use App\Models\CarWasher;
use App\Models\WasherDebts;
use App\Models\Vehicle;
use App\Models\User;
use Session;
use Carbon\Carbon;
use Log;

class WasherDebtsController extends Controller
{
    public function index(){
        $all_washers = CarWasher::all();
        $all_services = Service::all();
        $all_vehicles = Vehicle::all();
        $all_users = User::all();
        return view('car_wash.washer_debt', compact('all_washers', 'all_services', 'all_vehicles', 'all_users'));
    }

    public function add_washer_debt(Request $request){
        dd($request->all());
        try {
            $request->validate([
                'txt_firstname' => 'required|regex:/^[a-zA-Z-\s]+$/',
                'txt_lastname' => 'required|regex:/^[a-zA-Z-\s]+$/',
                'txt_phone_number' => 'required|regex:/^\+?\d+$/',
                'txt_nickname' => 'unique:tbl_car_washers,nickname',
            ], [
                'txt_firstname.required' => 'First Name is required',
                'txt_lastname.required' => 'Last Name is required',
                'txt_firstname.regex' => 'First Name is must be in letters only',
                'txt_lastname.regex' => 'Last Name is must be in letters only',
                'txt_phone_number.required' => 'Phone Number is required',
                'txt_phone_number.regex' => 'Phone Number is not valid',
                'txt_nickname.unique' => 'Nickname already exist',
            ]);
            $firstname = ucwords($request->get('txt_firstname'));
            $lastname = ucwords($request->get('txt_lastname'));
            $nickname = ucwords($request->get('txt_nickname'));
            $phone_number = $request->get('txt_phone_number');
            $bio = Str::ucfirst($request->get('txt_bio'));

            $user_session = Session::get('user_session');
            $active_user = $user_session->first_name." ".$user_session->last_name;

            $add_washer = new CarWasher();
            $add_washer->firstname = $firstname;
            $add_washer->lastname = $lastname;
            $add_washer->nickname = $nickname;
            $add_washer->phone_number = $phone_number;
            $add_washer->bio = $bio;
            $add_washer->created_by = $active_user;
            $add_washer->save();

            Alert::toast('Car Washer Registered','success');
            return back();

        } catch (exception $e) {
            echo 'Caught exception';
        }
    }
}
