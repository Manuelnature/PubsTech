<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesAudit;
use App\Models\Dashboard;
use App\Models\Retail;
use App\Models\LoginStock;
use Session;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;


class LoginStockController extends Controller
{
    public function index(){

        $date = Carbon::now()->format('Y-m-d');
        $last_audit_time = SalesAudit::select_audit();
        if(count($last_audit_time) > 0){

            $last_audit_time = $last_audit_time[0]->created_at;
            $all_sales_audit_records = SalesAudit::get_all_product_audit_records($last_audit_time);
            // dd($all_sales_audit_records);
        }
        else{
            // $all_sales_audit_records = Retail::get_each_product_details();
            $all_sales_audit_records = array();
            // $get_warehouse_records  = array();
        }

        $get_retail_records = Retail::get_each_product_details();

        return view('pages.login_stock', compact('all_sales_audit_records', 'date'));
    }


    public function filter_login_stock(Request $request){
        $user_session = Session::get('user_session');
        $active_user_id = $user_session->id;

        $date = $request->get('txt_stock_date');

        $get_filter_login_stock = LoginStock::filter_login_stock($date, $active_user_id);
        // dd($get_filter_login_stock);
        if (count($get_filter_login_stock) > 0) {
            $all_sales_audit_records = $get_filter_login_stock;
        }
        else
        {
            $all_sales_audit_records = array();
            // $all_sales_audit_records = Retail::get_each_product_details();
            Alert::toast('No records found on the selected date','warning');
            return redirect('login_stock');
        }
        // dd($all_sales_audit_records);

        return view('pages.login_stock', compact('all_sales_audit_records', 'date'));
    }

}
