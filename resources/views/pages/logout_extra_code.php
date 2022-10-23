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



==================================== GET SALES AUDIT FUNCTION IN LOGOUT CONTROLLER EXTRA CODE ===================

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
