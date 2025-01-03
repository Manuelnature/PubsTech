<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Service;
use App\Models\CarWasher;
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Models\Pricing;
use App\Models\User;
use App\Models\WashingTransaction;
use Session;
use Carbon\Carbon;
use Log;

class WashingTransactionController extends Controller
{
    public function index(){
        $all_washers = CarWasher::all();
        // $all_vehicles = Vehicle::all();
        $all_vehicles_types = VehicleType::all();
        // dd($all_vehicles_types);
        $all_users = User::all();
        $all_services = Service::all();

        // $all_services = Service::select_all_services();
        // $all_pricing = Pricing::all();
        $all_pricing = Pricing::select_all_pricing();

        $all_washing_transactions = WashingTransaction::select_all_washing_transactions();
        // dd($all_washing_transactions);

        $date_from = '';
        $date_to = '';

        return view('car_wash.washing_transactions', compact('all_washers', 'all_vehicles_types', 'all_services', 'all_pricing', 'all_users', 'all_washing_transactions', 'date_from', 'date_to'));
    }

    public function add_transaction(Request $request){
        // dd($request->all());
        try {
            $request->validate([
                'txt_vehicle_type_id' => 'required',
                'txt_service_id' => 'required',
                'txt_washer_id' => 'required',
                'txt_supervisor' => 'required',
                'txt_total_price' => 'required',
                'txt_washer_commission' => 'required',
            ], [
                'txt_vehicle_type_id.required' => 'Vehicle Name is required',
                'txt_service_id.required' => 'Service Name is required',
                'txt_washer_id.required' => 'Washer Name is required',
                'txt_supervisor.required' => 'Washer Name is required',
                'txt_total_price.required' => 'Total Price is required',
                'txt_washer_commission.required' => 'Total Price is required',
            ]);
            $service_id= $request->get('txt_service_id');
            // $service_ids = str_replace("'", "\'", json_encode($service_id));
            $service_ids = json_encode($service_id);

            // dd($service_ids);
            $vehicle_type_id= $request->get('txt_vehicle_type_id');
            $washer_id= $request->get('txt_washer_id');
            $supervisor= ucwords($request->get('txt_supervisor'));
            $total_amount = $request->get('txt_total_price');
            $washer_commision = $request->get('txt_washer_commission');
            $description = Str::ucfirst($request->get('txt_description'));
            $user_session = Session::get('user_session');
            $active_user = $user_session->first_name." ".$user_session->last_name;

            $add_transaction = new WashingTransaction();
            $add_transaction->vehicle_type_id = $vehicle_type_id;
            $add_transaction->service_ids = $service_ids;
            $add_transaction->washer_id = $washer_id;
            $add_transaction->amount = $total_amount;
            $add_transaction->washer_commission = $washer_commision;
            $add_transaction->supervisor = $supervisor;
            $add_transaction->description = $description;
            $add_transaction->created_by = $active_user;
            $add_transaction->save();

            Alert::toast('Transaction entered successfully','success');
            return back();

        } catch (exception $e) {
            echo 'Caught exception';
        }

    }

    public function edit_transaction($id){
        try {
            $transaction_to_edit= WashingTransaction::select_transaction_to_edit($id);
            $transaction_to_edit = $transaction_to_edit[0];
            // dd($transaction_to_edit);

            $all_washers = CarWasher::all();
            // $all_vehicles = Vehicle::all();

            $all_vehicles_types = VehicleType::all();
            $all_users = User::all();
            $all_services = Service::all();
            // dd($all_services);
            $all_pricing = Pricing::select_all_pricing();

            return view('car_wash.edit_transaction', compact('transaction_to_edit', 'all_users', 'all_vehicles_types', 'all_washers', 'all_services', 'all_pricing'));

        } catch (exception $e) {
            echo 'Caught exception';
        }

    }


    public function update_transaction(Request $request, $id){
        // dd($request->all());
        try {
            $request->validate([
                'txt_edit_vehicle_type_id' => 'required',
                'txt_edit_service_id' => 'required',
                'txt_edit_washer_id' => 'required',
                'txt_edit_supervisor' => 'required',
                'txt_edit_total_price' => 'required',
                'txt_edit_washer_commission' => 'required',
            ], [
                'txt_edit_vehicle_type_id.required' => 'Vehicle Name is required',
                'txt_edit_service_id.required' => 'Service Name is required',
                'txt_edit_washer_id.required' => 'Washer Name is required',
                'txt_edit_supervisor.required' => 'Washer Name is required',
                'txt_edit_total_price.required' => 'Total Price is required',
                'txt_edit_washer_commission.required' => 'Total Price is required',
            ]);
            $transaction_id = $id;
            $service_id= $request->get('txt_edit_service_id');
            // $service_ids = str_replace("'", "\'", json_encode($service_id));
            $service_ids = json_encode($service_id);

            // dd($service_ids);
            $vehicle_type_id= $request->get('txt_edit_vehicle_type_id');
            // dd($vehicle_type_id);
            $washer_id= $request->get('txt_edit_washer_id');
            $supervisor= ucwords($request->get('txt_edit_supervisor'));
            $total_amount = $request->get('txt_edit_total_price');
            $washer_commision = $request->get('txt_edit_washer_commission');
            $description = Str::ucfirst($request->get('txt_edit_description'));
            $user_session = Session::get('user_session');
            $active_user = $user_session->first_name." ".$user_session->last_name;

            $update_transaction = WashingTransaction::find($transaction_id);
            $update_transaction->vehicle_type_id = $vehicle_type_id;
            $update_transaction->service_ids = $service_ids;
            $update_transaction->washer_id = $washer_id;
            $update_transaction->amount = $total_amount;
            $update_transaction->washer_commission = $washer_commision;
            $update_transaction->supervisor = $supervisor;
            $update_transaction->description = $description;
            $update_transaction->created_by = $active_user;
            $update_transaction->save();

            Alert::toast('Transaction updated successfully','success');
            return redirect('washing_transaction');

        } catch (exception $e) {
            echo 'Caught exception';
        }
    }

    public function update_transaction_modal(Request $request){
        // dd($request->all());
        try {
            // $request->validate([
            //     'txt_edit_vehicle_type_id' => 'required',
            //     'txt_edit_service_id' => 'required',
            //     'txt_edit_washer_id' => 'required',
            //     'txt_edit_supervisor' => 'required',
            //     'txt_edit_total_price' => 'required',
            //     'txt_edit_washer_commission' => 'required',
            // ], [
            //     'txt_edit_vehicle_type_id.required' => 'Vehicle Name is required',
            //     'txt_edit_service_id.required' => 'Service Name is required',
            //     'txt_edit_washer_id.required' => 'Washer Name is required',
            //     'txt_edit_supervisor.required' => 'Washer Name is required',
            //     'txt_edit_total_price.required' => 'Total Price is required',
            //     'txt_edit_washer_commission.required' => 'Total Price is required',
            // ]);
            $transaction_id = $request->get('transaction_id');;
            // dd($transaction_id);
            $service_id= $request->get('txt_edit_service_id');
            // $service_ids = str_replace("'", "\'", json_encode($service_id));
            $service_ids = json_encode($service_id);

            dump($service_ids);
            $vehicle_type_id = $request->get('txt_edit_type_vehicle_id');

            dd($vehicle_type_id);
            $washer_id= $request->get('txt_edit_washer_id');
            $supervisor= ucwords($request->get('txt_edit_supervisor'));
            $total_amount = $request->get('txt_edit_total_price');
            $washer_commision = $request->get('txt_edit_washer_commission');
            $description = Str::ucfirst($request->get('txt_edit_description'));
            $user_session = Session::get('user_session');
            $active_user = $user_session->first_name." ".$user_session->last_name;

            $update_transaction = WashingTransaction::find($transaction_id);
            $update_transaction->vehicle_type_id = $vehicle_type_id;
            $update_transaction->service_ids = $service_ids;
            $update_transaction->washer_id = $washer_id;
            $update_transaction->amount = $total_amount;
            $update_transaction->washer_commission = $washer_commision;
            $update_transaction->supervisor = $supervisor;
            $update_transaction->description = $description;
            $update_transaction->created_by = $active_user;
            $update_transaction->save();

            Alert::toast('Transaction updated successfully','success');
            return redirect('washing_transaction');

        } catch (exception $e) {
            echo 'Caught exception';
        }
    }

    public function filter_transaction(Request $request){
         $request->validate([
            'txt_date_from' => 'required|before_or_equal:today',
            'txt_date_to' => 'required|before_or_equal:today',
            ], [
            'txt_date_from.required' => 'Start Date is required for filter',
            'txt_date_to.required' => 'End Date is required for filter',
            'txt_date_from.before_or_equal' => 'Date from cannot be after today',
            'txt_date_to.before_or_equal' => 'Date to cannot be after today',
        ]);

        $date_from = $request->get('txt_date_from');
        $date_to = $request->get('txt_date_to');

        if (($date_from != "" || $date_from != NULL) && ($date_to != "" || $date_to != NULL)) {

            $all_washers = CarWasher::all();
            $all_vehicles_types = VehicleType::all();
            $all_users = User::all();
            $all_services = Service::all();
            $all_pricing = Pricing::select_all_pricing();

            $all_washing_transactions = WashingTransaction::select_filter_washing_transactions($date_from, $date_to);
            // dd($all_washing_transactions);
            if (count($all_washing_transactions) > 0) {
                return view('car_wash.washing_transactions', compact('all_washers', 'all_vehicles_types', 'all_services', 'all_pricing', 'all_users', 'all_washing_transactions', 'date_from', 'date_to'));
            }
            else {
                Alert::warning('No record found within the chosen dates');
                return redirect('washing_transaction');
            }
        }
        else {
            Alert::toast('Select all dates','warning');
            return redirect('washing_transaction');
        }


    }
}
