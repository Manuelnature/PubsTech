<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Login;
use App\Models\SalesAudit;
use App\Models\Warehouse;
use App\Models\Sales;
use App\Models\Retail;
use Session;
use Carbon\Carbon;
use Log;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function user_login(Request $request)
    {
        try {
            $request->validate([
                'txt_username' => 'required',
                // 'txt_email' => 'required|email',
                // 'txt_password' => 'required'
            ], [
                'txt_username.required' => 'Username is required',
                // 'txt_email.email' => 'Email field must have a valid email address',
                // 'txt_password.required' => 'Password field cnnot be empty',
            ]);

            // $email = $request->get('txt_email');
            $username = $request->get('txt_username');
            $password = $request->get('txt_password');

            if(!empty($password)){
                $login_data = Login::where('username', '=', $username)->first();

                if($login_data){
                    if (Hash::check($password, $login_data->password)) {

                        //=== Setting up a session ==//
                        Session::put('user_session', $login_data);

                        Alert::toast('Log In Successfully','success');

                        $user_session = Session::get('user_session');

                        if ($user_session->role == 'Retailer') {
                             $this->get_sales_audit();
                            return redirect('retailer_dashboard');
                        }
                        else {
                            $this->get_sales_audit();
                            return redirect('home');
                        }
                    }
                    else{
                        Alert::toast('Password Incorrect','warning');
                        return back();
                    }
                }
                else {
                    Alert::toast('Username not found','warning');
                        return back();
                }
            }
            else {
                $set_password_user_details = Login::where('username', $username)->get();

                if ($set_password_user_details){
                    if($set_password_user_details[0]->password == "" || $set_password_user_details[0]->password == NULL){
                        // dd($set_password_email_details);
                        Alert::toast('New user! Set up Password','success');
                        return view('auth.set_password', compact('set_password_user_details'));
                    }
                    else{
                        Alert::toast('Enter Password to Login','warning');
                       return back();
                    }
                }
                else{
                    Alert::toast('Username not found! Enter Again','warning');
                    return back();
                }
            }

        } catch (exception $e) {
            echo 'Caught exception';
        }
    }



    public function get_sales_audit (){

        $user_session = Session::get('user_session');
        $current_user_id = $user_session->id;
        $active_user = $user_session->first_name." ".$user_session->last_name;
        $sales_audit_records = array();
        $date_and_time_now = Carbon::now()->toDateTimeString();
        $today_date = Carbon::now()->format('Y-m-d');


        // $all_sales_records_for_audit = Sales::get_sales_details_in_group();
        // if (count($all_sales_records_for_audit) > 0) {
        //     foreach ($all_sales_records_for_audit as $sales_record) {
        //         $product_id = $sales_record->product_id;

        //         $last_sale_under_each_product_id = Sales::select_last_sale_under_each_product_id($product_id, $date_and_time_now);
        //         if(count($last_sale_under_each_product_id) > 0){
        //             foreach ($last_sale_under_each_product_id as $last_sale) {
        //                 $main_product_id = $last_sale->product_id;
        //                 $product_name = $last_sale->name;
        //                 $price_per_item = $last_sale->price_per_item;
        //                 $stock_left = $last_sale->stock_after;


        //                     $sales_audit = new SalesAudit();
        //                     $sales_audit->user_id = $current_user_id;
        //                     $sales_audit->product_id = $main_product_id;
        //                     $sales_audit->starting_stock = $stock_left;
        //                     $sales_audit->sales_date = $today_date;
        //                     // $sales_audit->created_by = $today_date;
        //                     $sales_audit->save();
        //                 // array_push( $sales_audit_records, ['product_name' => $product_name, 'price_per_item'=> $price_per_item, 'stock_left'=>$stock_left]);
        //             }
        //         }

        //     }
        // }

        $get_all_from_warehouse = Retail::all();

        if (count($get_all_from_warehouse) > 0) {
            foreach ($get_all_from_warehouse as $warehouse_details) {
                $product_id = $warehouse_details->product_id;
                // $product_name = $warehouse_details->name;
                $price_per_item = $warehouse_details->price_per_piece;
                // $stock_left = $warehouse_details->total_items;
                $stock_left = $warehouse_details->total_quantity;


                $sales_audit = new SalesAudit();
                $sales_audit->user_id = $current_user_id;
                $sales_audit->product_id = $product_id;
                $sales_audit->starting_stock = $stock_left;
                $sales_audit->sales_date = $today_date;
                $sales_audit->created_by = $active_user;
                $sales_audit->save();
            }
        }


    }



    public function logout_user(Request $request){


        $date_and_time_now = Carbon::now()->toDateTimeString();
        // $all_sales_records_for_audit = Sales::get_sales_details_in_group();
        // if (count($all_sales_records_for_audit) > 0) {
        //     foreach ($all_sales_records_for_audit as $sales_record) {
        //         $product_id = $sales_record->product_id;

        //         $last_sale_under_each_product_id = Sales::select_last_sale_under_each_product_id($product_id, $date_and_time_now);
        //         if(count($last_sale_under_each_product_id) > 0){
        //             foreach ($last_sale_under_each_product_id as $last_sale) {
        //                 $main_product_id = $last_sale->product_id;
        //                 $product_name = $last_sale->name;
        //                 $price_per_item = $last_sale->price_per_item;
        //                 $stock_left = $last_sale->stock_after;

        //                 $sales_audit = SalesAudit::find($main_product_id);


        //                 $starting_stock = $sales_audit->starting_stock;
        //                 $difference_in_stock = (int)$starting_stock - (int)$stock_left;
        //                 $expected_amount = (double)($price_per_item) * (double)$difference_in_stock;

        //                 $sales_audit->ending_stock = $stock_left;
        //                 $sales_audit->expected_amount = $expected_amount;
        //                 $sales_audit->save();
        //             }
        //         }

        //     }
        // }


        $user_session = Session::get('user_session');
        Log::channel('my_logs')->info('SESSION FOUND ');
        Log::channel('my_logs')->info($user_session );
        $current_user_id = $user_session->id;

        Log::channel('my_logs')->info('SESSION assigned ');
        Log::channel('my_logs')->info($current_user_id);

        $date_and_time_now = Carbon::now()->toDateTimeString();
        $today_date = Carbon::now()->format('Y-m-d');

        // $get_all_from_warehouse = Warehouse::all();
        $get_all_from_retail = Retail::all();
        Log::channel('my_logs')->info('RETAIL ARRAY FOUND ');
        Log::channel('my_logs')->info(count($get_all_from_retail));
        $my_variable = 0;
        if (count($get_all_from_retail) > 0) {
            Log::channel('my_logs')->info('EEEEEEEEEEEEEEEE IN IF STATEMENT');
            foreach ($get_all_from_retail as $retail_details) {
                $my_variable = $my_variable + 1;

                $product_id = $retail_details->product_id;
                // $product_name = $retail_details->name;
                $price_per_item = $retail_details->price_per_piece;
                $stock_left = $retail_details->total_quantity;


                $get_sales_records = SalesAudit::sales_audit_record_for_user($current_user_id, $product_id);
                // dd($get_sales_records);
                $audit_id = $get_sales_records[0]->id;
                // dd($audit_id);

                $sales_audit = SalesAudit::find($audit_id);

                $starting_stock = $sales_audit->starting_stock;
                $difference_in_stock = (int)$starting_stock - (int)$stock_left;
                $expected_amount = (double)($price_per_item) * (double)$difference_in_stock;

                $sales_audit->ending_stock = $stock_left;
                $sales_audit->expected_amount = $expected_amount;
                $sales_audit->save();
            }
            Log::channel('my_logs')->info('My variable is : '.$my_variable);
        }
        Log::channel('my_logs')->info('LLLLLLLASSSSSSSSSSST ALLLLLLLLLLL');
        $request->session()->forget('user_session');
        Log::channel('my_logs')->info('LASSSSSSSSST CODEEEEEEEEEEEEE');
        return redirect('/');
    }




     // $get_all_from_sales_audit = SalesAudit::find($main_product_id);

    //  $get_all_from_sales_audit = SalesAudit::where('product_id', $main_product_id)->get()[0];
    //  if($get_all_from_sales_audit){
    //      $sales_audit = SalesAudit::where('product_id', $main_product_id)->get()[0];
    //      $sales_audit->user_id = $current_user_id;
    //      // $sales_audit->product_id = $main_product_id;
    //      $sales_audit->starting_stock = $stock_left;
    //      $sales_audit->sales_date = $today_date;
    //      $sales_audit->save();
    //  }
    //  else{
    //      $sales_audit = new SalesAudit();
    //      $sales_audit->user_id = $current_user_id;
    //      $sales_audit->product_id = $main_product_id;
    //      $sales_audit->starting_stock = $stock_left;
    //      $sales_audit->sales_date = $today_date;
    //      $sales_audit->save();
    //  }



    public function get_sales_audit_old_old (){

        $user_session = Session::get('user_session');
        $current_user_id = $user_session->id;
        $sales_audit_records = array();
        $date_and_time_now = Carbon::now()->toDateTimeString();
        $today_date = Carbon::now()->format('Y-m-d');


        $all_sales_records_for_audit = Sales::get_sales_details_in_group();
        if (count($all_sales_records_for_audit) > 0) {
            foreach ($all_sales_records_for_audit as $sales_record) {
                $product_id = $sales_record->product_id;

                $last_sale_under_each_product_id = Sales::select_last_sale_under_each_product_id($product_id, $date_and_time_now);
                if(count($last_sale_under_each_product_id) > 0){
                    foreach ($last_sale_under_each_product_id as $last_sale) {
                        $main_product_id = $last_sale->product_id;
                        $product_name = $last_sale->name;
                        $price_per_item = $last_sale->price_per_item;
                        $stock_left = $last_sale->stock_after;

                        // $get_all_from_sales_audit = SalesAudit::find($main_product_id);
                        $get_all_from_sales_audit = SalesAudit::where('product_id', $main_product_id)->get()[0];
                        if($get_all_from_sales_audit){
                            $sales_audit = SalesAudit::where('product_id', $main_product_id)->get()[0];
                            $sales_audit->user_id = $current_user_id;
                            // $sales_audit->product_id = $main_product_id;
                            $sales_audit->starting_stock = $stock_left;
                            $sales_audit->sales_date = $today_date;
                            $sales_audit->save();
                        }
                        else{
                            $sales_audit = new SalesAudit();
                            $sales_audit->user_id = $current_user_id;
                            $sales_audit->product_id = $main_product_id;
                            $sales_audit->starting_stock = $stock_left;
                            $sales_audit->sales_date = $today_date;
                            $sales_audit->save();
                        }
                        // array_push( $sales_audit_records, ['product_name' => $product_name, 'price_per_item'=> $price_per_item, 'stock_left'=>$stock_left]);
                    }
                }

            }
        }
    }


    public function logout_user_old(Request $request){


        $date_and_time_now = Carbon::now()->toDateTimeString();
        $all_sales_records_for_audit = Sales::get_sales_details_in_group();
        if (count($all_sales_records_for_audit) > 0) {
            foreach ($all_sales_records_for_audit as $sales_record) {
                $product_id = $sales_record->product_id;

                $last_sale_under_each_product_id = Sales::select_last_sale_under_each_product_id($product_id, $date_and_time_now);
                if(count($last_sale_under_each_product_id) > 0){
                    foreach ($last_sale_under_each_product_id as $last_sale) {
                        $main_product_id = $last_sale->product_id;
                        $product_name = $last_sale->name;
                        $price_per_item = $last_sale->price_per_item;
                        $stock_left = $last_sale->stock_after;

                        $sales_audit = SalesAudit::find($main_product_id);


                        $starting_stock = $sales_audit->starting_stock;
                        $difference_in_stock = (int)$starting_stock - (int)$stock_left;
                        $expected_amount = (double)($price_per_item) * (double)$difference_in_stock;

                        $sales_audit->ending_stock = $stock_left;
                        $sales_audit->expected_amount = $expected_amount;
                        $sales_audit->save();
                    }
                }

            }
        }

        $request->session()->forget('user_session');

        return redirect('/');
    }


}
