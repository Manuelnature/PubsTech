<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Session;

class ProfileController extends Controller
{
    public function index(){
        return view('pages.profile');
    }

    public function update_user_profile(Request $request){

        $user_id = $request->get('user_id');

        $update_user = User::find($user_id);
        $update_user->first_name = $request->get('txt_edit_first_name');
        $update_user->last_name = $request->get('txt_edit_last_name');
        $update_user->email = $request->get('txt_edit_email');
        $update_user->phone_number = $request->get('txt_edit_phone_number');
        $update_user->save();


        $update_user_session = Session::get('user_session');

        if($update_user_session->id == $user_id){
            $update_user_session->first_name = $request->get('txt_edit_first_name');
            $update_user_session->last_name = $request->get('txt_edit_last_name');
            $update_user_session->email = $request->get('txt_edit_email');
            $update_user_session->phone_number = $request->get('txt_edit_phone_number');
        }

        Session::put('user_session', $update_user_session);


        Alert::toast('Profile Updated','success');
        return back();
    }
}
