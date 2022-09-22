<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use App\Models\Login;
use Session;

class SetPasswordController extends Controller
{
    public function index(){
        return view('auth.set_password');
    }


    public function set_password(Request $request){
        try {
            $request->validate([
                'txt_set_password' => 'required',
                'txt_confirm_set_password' => 'required'
            ], [
                'txt_set_password.required' => 'Password is required',
                'txt_confirm_set_password.required' => 'Confirm Password field is required',
            ]);

            $id = $request->get('txt_set_password_id');
            $email = $request->get('txt_set_password_email');
            $username = $request->get('txt_set_password_username');
            $new_password= Hash::make($request->get('txt_set_password'));
            $confirm_new_password= $request->get('txt_confirm_set_password');

            if(Hash::check($confirm_new_password, $new_password)){
                $update_password = Login::find($id);
                $update_password->password =  $new_password;
                $update_password->save();
                // SetPassword::set_user_password($id, $new_password);
                Alert::toast('Password Set Successfully! Please Login.','success');
                return redirect('/');
            }
            else{
                Alert::toast('Passwords do not match, Reset!','warning');
                return back();
            }

        } catch (exception $e) {
            echo 'Caught exception';
        }
    }
}
