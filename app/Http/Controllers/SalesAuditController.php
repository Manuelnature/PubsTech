<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Warehouse;
use App\Models\WarehouseLogs;
use App\Models\Sales;
use App\Models\SalesAudit;
use App\Models\Dashboard;
use App\Models\Retail;
use App\Models\CarWasher;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use Carbon\Carbon;
use Log;

class SalesAuditController extends Controller
{
    public function update_sales_audit(){
        $yesterday_date = Carbon::now()->subDays(1)->format('Y-m-d');

       $sales_audit_for_yesterday = SalesAudit::get_yesterday_audit();
        if (count($sales_audit_for_yesterday)) {
            foreach ($sales_audit_for_yesterday as $yesterday_audit) {
                $product_id = $yesterday_audit->product_id;
                $user_id = $yesterday_audit->user_id;
                $sales_id = $yesterday_audit->id;

                $get_user_details = User::where('id', $user_id)->get();
                $username = $get_user_details[0]->username;
             //    dump($product_id);
                //============Get from sales table for this username and product_id
                $get_records_from_sales = SalesAudit::get_records_from_sales($product_id, $username, $yesterday_date);
             //    dump($get_records_from_sales);
                $total_quantity_sold = 0;
                $total_expected_price = 0;
                if (count($get_records_from_sales)> 0) {
                    foreach ($get_records_from_sales as $sales_record) {
                        $total_quantity_sold = (int)$total_quantity_sold + (int)$sales_record->quantity_sold;
                        $total_expected_price = (double)$total_expected_price + (double)$sales_record->expected_price;
                    }
                 //    dump($total_quantity_sold);
                 //    dump($total_expected_price);

                    //========= Updating Sales Audit table
                    $update_audit = SalesAudit::find($sales_id);
                    $starting_stock = $update_audit->starting_stock;
                    $ending_stock = $starting_stock - $total_quantity_sold;
                    $update_audit->status = 'END_STOCK';
                    $update_audit->ending_stock = $ending_stock;
                    $update_audit->expected_amount = $total_expected_price;
                    $update_audit->save();
                }
                else{
                    $update_audit = SalesAudit::find($sales_id);
                    $starting_stock = $update_audit->starting_stock;
                    $update_audit->status = 'END_STOCK';
                    $update_audit->ending_stock = $starting_stock;
                    $update_audit->expected_amount = 0;
                    $update_audit->save();
                }

            }
        }

   }
}
