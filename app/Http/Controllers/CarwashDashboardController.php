<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Service;
use App\Models\CarWasher;
use App\Models\VehicleType;
use App\Models\WashingTransaction;
use Session;
use Carbon\Carbon;

class CarwashDashboardController extends Controller
{
   public function index(){
        $get_all_washers = CarWasher::all();
        if (count($get_all_washers) > 0) {
            $total_number_of_car_washers = count($get_all_washers);
        } else {
            $total_number_of_car_washers = 0;
        }

        $get_all_services = Service::all();
        if (count($get_all_services) > 0) {
            $total_number_of_services = count($get_all_services);
        } else {
            $total_number_of_services = 0;
        }

        $get_all_vehicle_types = VehicleType::all();
        if (count($get_all_vehicle_types) > 0) {
            $total_number_of_vehicle_type = count($get_all_vehicle_types);
        } else {
            $total_number_of_vehicle_type = 0;
        }


        $get_all_washing_transaction = WashingTransaction::all();
        $total_washing_amount = 0;
        $total_washers_commision = 0;

        if (count($get_all_washing_transaction) > 0) {
            $total_vehicles_washed = count($get_all_washing_transaction);
            foreach ($get_all_washing_transaction as $washing_transaction) {
                $amount = $washing_transaction->amount;
                $washer_commision = $washing_transaction->washer_commission;

                $total_washing_amount = (double)$total_washing_amount + (double)$amount;
                $total_washers_commision = (double)$total_washers_commision + (double)$washer_commision;
            }
        }
        else{
            $total_vehicles_washed = 0;
        }

        //========= Calling individual washing transaction function ==============
        $all_individual_washing_transaction = $this->individual_washers();


        return view('car_wash.carwash_dashboard', compact('total_number_of_car_washers', 'total_number_of_services', 'total_number_of_vehicle_type', 'total_vehicles_washed', 'total_washing_amount', 'total_washers_commision', 'all_individual_washing_transaction'));
    }

    public function individual_washers(){

        $all_individual_washing_transaction = array();

        $get_all_washers = CarWasher::all();

        if (count($get_all_washers) > 0){
            foreach ($get_all_washers as $all_washers) {
                $washer_id = $all_washers->id;
                // $get_individual_transaction = WashingTransaction::where('washer_id', $washer_id)->get();
                $get_individual_transaction = WashingTransaction::select_individual_washing_transactions($washer_id);


                if (count($get_individual_transaction) > 0) {
                    $count_individual_transactions = count($get_individual_transaction);

                    // dump($get_individual_transaction);
                    $nickname = $get_individual_transaction[0]->nickname;

                    $amount_made = 0;
                    $commission_received = 0;

                    for ($i=0; $i < $count_individual_transactions; $i++) {
                        $amount_made = (double)$amount_made + (double)$get_individual_transaction[$i]->amount;
                        $commission_received = (double)$commission_received + (double)$get_individual_transaction[$i]->washer_commission;
                    }
                    // dump($amount_made);
                    // dump($commission_received);


                    array_push($all_individual_washing_transaction, ['nickname' => $nickname, 'amount_made'=> $amount_made, 'commission_received'=>$commission_received, 'total_cars_washed'=>$count_individual_transactions]);

                }
                else {
                    array_push($all_individual_washing_transaction, ['nickname' => '', 'amount_made'=> 0, 'commission_received'=>0, 'total_cars_washed'=>0]);
                }
            }
        }
        else {
            array_push($all_individual_washing_transaction, ['nickname' => '', 'amount_made'=> 0, 'commission_received'=>0, 'total_cars_washed'=>0]);
        }

        $individual_washing_transaction_data = json_encode($all_individual_washing_transaction);
        return $individual_washing_transaction_data;
    }

}


