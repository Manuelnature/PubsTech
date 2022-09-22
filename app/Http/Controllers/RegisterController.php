<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Register;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function user_register(Request $request){
        try {
            $request->validate([
                'txt_first_name' => 'required',
                'txt_last_name' => 'required',
                'txt_email' => 'required|email|unique:tbl_users,email',
                'txt_password' => 'required',
                'txt_confirm_password' => 'required'
            ], [
                'txt_first_name.required' => 'Firstname is required',
                'txt_last_name.required' => 'Lastname is required',
                'txt_email.required' => 'Email is required',
                'txt_email.email' => 'Email field must have a valid email address',
                'txt_email.unique' => 'Email already exist',
                'txt_password.required' => 'Password is required',
                'txt_confirm_password.required' => 'Password Confirmation is required'
            ]);
            $first_name = $request->get('txt_first_name');
            $last_name = $request->get('txt_last_name');
            $email = $request->get('txt_email');
            $password = Hash::make($request->get('txt_password'));
            $confirm_password = $request->get('txt_confirm_password');

            if (Hash::check($confirm_password, $password)){
                Register::register_user($first_name, $last_name, $email, $password);
                Alert::toast('New user registered','success');
                return back();
            }
            else{
                Alert::toast('Passwords do not match! Enter Again','warning');
                return back();
            }
        } catch (exception $e) {
            echo 'Caught exception';
        }
    }
}
