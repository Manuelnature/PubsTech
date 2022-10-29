<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Session;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index(){
        $all_users = User::all();
        return view('pages.users', compact('all_users'));
    }

    public function add_user(Request $request){
        try {
            $request->validate([
                'txt_first_name' => 'required',
                'txt_last_name' => 'required',
                'txt_email' => 'email|unique:tbl_users,email',
                'txt_username' => 'required|unique:tbl_users,username',
                'txt_phone_number' => 'required|numeric',
                'txt_role' => 'required',
            ], [
                'txt_first_name.required' => 'Firstname is required',
                'txt_last_name.required' => 'Lastname is required',
                // 'txt_email.required' => 'Email is required',
                'txt_email.email' => 'Email field must have a valid email address',
                'txt_email.unique' => 'Email already exist',
                'txt_username.required' => 'Username is required',
                'txt_username.unique' => 'Username already exist',
                'txt_phone_number.required' => 'Password is required',
                'txt_phone_number.numeric' => 'Phone Number must be in only numbers',
                'txt_role.required' => 'Password Confirmation is required'
            ]);
            $first_name = ucwords($request->get('txt_first_name'));
            $last_name = ucwords($request->get('txt_last_name'));
            $email = $request->get('txt_email');
            $username = ucwords($request->get('txt_username'));
            $phone_number = $request->get('txt_phone_number');
            $role = $request->get('txt_role');
            $date_employed = $request->get('txt_date_employed');

            $user_session = Session::get('user_session');
            // $active_user = $user_session->first_name." ".$user_session->last_name;
            $active_user = $user_session->username;

            $add_user = new User();
            $add_user->first_name = $first_name;
            $add_user->last_name = $last_name;
            $add_user->email = $email;
            $add_user->username = $username;
            $add_user->phone_number = $phone_number;
            $add_user->role = $role;
            $add_user->date_employed = $date_employed;
            $add_user->registered_by = $active_user;
            $add_user->save();

            Alert::toast('New user registered','success');
            return back();

        } catch (exception $e) {
            echo 'Caught exception';
        }
    }


    public function update_user(Request $request){
        $user_id = $request->get('user_id');
        $user_session = Session::get('user_session');
        // $active_user = $user_session->first_name." ".$user_session->last_name;
        $active_user = $user_session->username;

        $current_date_and_time = Carbon::now()->toDateTimeString();

        $update_user = User::find($user_id);

        $update_user->first_name = ucwords($request->get('txt_edit_first_name'));
        $update_user->last_name = ucwords($request->get('txt_edit_last_name'));
        $update_user->email = $request->get('txt_edit_email');
        $update_user->username = ucwords($request->get('txt_edit_username'));
        $update_user->phone_number = $request->get('txt_edit_phone_number');
        $update_user->role = $request->get('txt_edit_role');
        $update_user->updated_by =$active_user;
        $update_user->updated_at =$current_date_and_time;
        $update_user->save();
        Alert::toast('User Info Updated','success');
            return back();
    }

    public static function delete_user(Request $request){
        $user_id = $request->get('user_id');
        User::delete_user($user_id);

        Alert::toast('User Deleted','warning');
            return back();
    }

}
