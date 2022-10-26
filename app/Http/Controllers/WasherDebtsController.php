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
        $all_washer_debts = WasherDebts::get_all_debts();
        // dd($all_washer_debts);
        return view('car_wash.washer_debt', compact('all_washers', 'all_services', 'all_vehicles', 'all_users', 'all_washer_debts'));
    }

    public function add_washer_debt(Request $request){
        // dd($request->all());
        try {
            $request->validate([
                'txt_washer_id' => 'required',
                'txt_debt_amount' => 'required',
                'txt_payment_status' => 'required'

            ], [
                'txt_washer_id.required' => 'Vehicle Name is required',
                'txt_debt_amount.required' => 'Service Name is required',
                'txt_payment_status.required' => 'Washer Name is required'
            ]);
            $washer_id = $request->get('txt_washer_id');
            $debt_amount = $request->get('txt_debt_amount');
            $amount_paid = $request->get('txt_amount_paid');
            $amount_left = $request->get('txt_amount_left');
            $payment_status = $request->get('txt_payment_status');
            $paid_to = $request->get('txt_paid_to');
            $paid_on = $request->get('txt_paid_on');
            $remark = Str::ucfirst($request->get('txt_debt_description'));

            $user_session = Session::get('user_session');
            $active_user = $user_session->first_name." ".$user_session->last_name;

            $add_debts = new WasherDebts();
            $add_debts->washer_id = $washer_id;
            $add_debts->debt_amount = $debt_amount;
            $add_debts->amount_paid = $amount_paid;
            $add_debts->amount_left = $amount_left;
            $add_debts->payment_status = $payment_status;
            $add_debts->paid_to = $paid_to;
            $add_debts->paid_on = $paid_on;
            $add_debts->remark = $remark;
            $add_debts->save();

            Alert::toast('Washer debts recorded','success');
            return back();

        } catch (exception $e) {
            echo 'Caught exception';
        }
    }



    public function update_washer_debt(Request $request){
        try {
            $request->validate([
                'txt_edit_washer_id' => 'required',
                'txt_edit_debt_amount' => 'required',
                'txt_edit_payment_status' => 'required'

            ], [
                'txt_edit_washer_id.required' => 'Vehicle Name is required',
                'txt_edit_debt_amount.required' => 'Service Name is required',
                'txt_edit_payment_status.required' => 'Washer Name is required'
            ]);
            $debt_id = $request->get('debt_id');
            $washer_id = $request->get('txt_edit_washer_id');
            $debt_amount = $request->get('txt_edit_debt_amount');
            $amount_paid = $request->get('txt_edit_amount_paid');
            $amount_left = $request->get('txt_edit_amount_left');
            $payment_status = $request->get('txt_edit_payment_status');
            $paid_to = $request->get('txt_edit_paid_to');
            $paid_on = $request->get('txt_edit_paid_on');
            $remark = Str::ucfirst($request->get('txt_edit_debt_description'));

            $user_session = Session::get('user_session');
            $active_user = $user_session->first_name." ".$user_session->last_name;
            $active_username = $user_session->username;
            $current_date_and_time = Carbon::now()->toDateTimeString();

            $add_debts = WasherDebts::find($debt_id);
            $add_debts->washer_id = $washer_id;
            $add_debts->debt_amount = $debt_amount;
            $add_debts->amount_paid = $amount_paid;
            $add_debts->amount_left = $amount_left;
            $add_debts->payment_status = $payment_status;
            $add_debts->paid_to = $paid_to;
            $add_debts->paid_on = $paid_on;
            $add_debts->remark = $remark;
            $add_debts->updated_by = $active_username;
            $add_debts->updated_at = $current_date_and_time;
            $add_debts->save();

            Alert::toast('Washer debts Updated','success');
            return back();

        } catch (exception $e) {
            echo 'Caught exception';
        }
    }
}
