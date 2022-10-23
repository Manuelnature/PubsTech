<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Service;
use App\Models\CarWasher;
use Session;
use Carbon\Carbon;
use Log;

class WashersController extends Controller
{
    public function index(){
        $all_washers = CarWasher::all();
        return view('car_wash.washers', compact('all_washers'));
    }

    public function add_car_washer(Request $request){
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

    public function update_car_washer(Request $request){
        try {
            $request->validate([
                'txt_washer_id' => 'required|regex:/^[a-zA-Z-\s]+$/',
                'txt_debt_amount' => 'required|regex:/^[a-zA-Z-\s]+$/',
                'txt_amount_paid' => 'required|regex:/^\+?\d+$/',
                'txt_amount_left' => 'unique:tbl_car_washers,nickname',
                'txt_payment_status' => 'unique:tbl_car_washers,nickname',
                'txt_paid_to' => 'unique:tbl_car_washers,nickname',
                'txt_paid_on' => 'unique:tbl_car_washers,nickname',
                'txt_paid_to' => 'unique:tbl_car_washers,nickname',
                'txt_paid_on' => 'unique:tbl_car_washers,nickname',
            ], [
                'txt_washer_id.required' => 'First Name is required',
                'txt_debt_amount.required' => 'Last Name is required',
                'txt_amount_paid.regex' => 'First Name is must be in letters only',
                'txt_amount_left.regex' => 'Last Name is must be in letters only',
                'txt_payment_status.required' => 'Phone Number is required',
                'txt_paid_to.regex' => 'Phone Number is not valid',
                'txt_paid_on.unique' => 'Nickname already exist',
            ]);
            $washer_id = $request->get('washer_id');
            $firstname = ucwords($request->get('txt_edit_firstname'));
            $lastname = ucwords($request->get('txt_edit_lastname'));
            $nickname =  ucwords($request->get('txt_edit_nickname'));
            $phone_number = $request->get('txt_edit_phone_number');
            $bio = Str::ucfirst($request->get('txt_edit_bio'));

            $user_session = Session::get('user_session');
            $active_user = $user_session->first_name." ".$user_session->last_name;
            $current_date_and_time = Carbon::now()->toDateTimeString();

            $update_washer = CarWasher::find($washer_id);
            $update_washer->firstname = $firstname;
            $update_washer->lastname = $lastname;
            $update_washer->nickname = $nickname;
            $update_washer->phone_number = $phone_number;
            $update_washer->bio = $bio;
            $update_washer->updated_by = $active_user;
            $update_washer->updated_at = $current_date_and_time;
            $update_washer->save();

            Alert::toast('Car Washer Details Updated','success');
            return back();

        } catch (exception $e) {
            echo 'Caught exception';
        }
    }
}
