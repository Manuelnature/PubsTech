<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Session;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    public function index(){
        $all_products = Products::all();
        return view('pages.product', compact('all_products'));
    }


    public function add_product(Request $request){
        $request->validate([
            'txt_product_name' => 'required|unique:tbl_products,name',
            'txt_price_per_item' => 'required|numeric',
            'txt_quantity_per_crate' => 'required|numeric',
            'txt_stock_threshold' => 'required|numeric'
            ], [
            'txt_product_name.required' => 'Product Name is required',
            'txt_product_name.unique' => 'Product Already Exist',
            'txt_price_per_item.required' => 'Price per Item is required',
            'txt_price_per_item.numeric' => 'Enter only numeric values',
            'txt_quantity_per_crate.required' => 'Quantity per Crate is required',
            'txt_quantity_per_crate.numeric' => 'Enter only numeric values',
            'txt_stock_threshold.required' => 'Product Threshold is required to notify us when running out of stock',
            'txt_stock_threshold.numeric' => 'Enter only numeric values'
        ]);

        // dd($request->all());
        $user_session = Session::get('user_session');
        // $active_user = $user_session->first_name." ".$user_session->last_name;
        $active_user = $user_session->username;

        $data = new Products();
        $data->name = ucwords($request->get('txt_product_name'));
        $data->description = Str::ucfirst($request->get('txt_description'));
        $data->price_per_item= $request->get('txt_price_per_item');
        $data->quantity_per_crate = $request->get('txt_quantity_per_crate');
        $data->stock_threshold = $request->get('txt_stock_threshold');
        $price_per_crate = (double)($request->get('txt_price_per_item')) * (double)($request->get('txt_quantity_per_crate'));
        $data->price_per_crate = $price_per_crate;
        $data->status = "Active";
        $data->created_by = $active_user;
        $data->save();

        Alert::toast('Product Entered Successfully','success');
        return redirect()->back();
    }

    public function add_most_purchased(Request $request){

        $request->validate([
            'txt_modal_product_id' => 'required',
            'txt_modal_product_photo' => 'required|mimes:jpeg,png,jpg',
            ], [
            'txt_modal_product_id.required' => 'Product Name is required',
            'txt_modal_product_photo.required' => 'Event Photo is required',
            'txt_modal_product_photo.mimes' => 'Photo must be a file of type: jpeg,png,jpg',
        ]);


        // $user_session = Session::get('user_session');
        // $active_user = $user_session->first_name." ".$user_session->last_name;

        if($request->hasFile('txt_modal_product_photo')){

            $image = $request->file('txt_modal_product_photo');

            $img_ext = $image->getClientOriginalExtension();
            $timestamp = 'ProductPhoto'.rand(100,999).'-'.str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $file_name = $timestamp.'.'.$img_ext;

            Image::make($image)->resize(100,100)->save('assets/img/products/'. $file_name);


            // $imagePath = $image->move('assets/img/products', $file_name);

            $product_id = $request->get('txt_modal_product_id');

            $update_product = Products::find($product_id);
            $update_product->photo = $file_name;
            $update_product->is_most_purchased = 1;
            $update_product->save();

            Alert::toast('Product Updated Successfully','success');
            return redirect()->back();
        }

    }

    public function update_product(Request $request){
        $request->validate([
            'txt_edit_product_name' => 'required',
            'txt_edit_price_per_item' => 'required|numeric',
            'txt_edit_quantity_per_crate' => 'required|numeric',
            'txt_edit_stock_threshold' => 'required|numeric',
            'txt_edit_status' => 'required'
            ], [
            'txt_edit_product_name.required' => 'Product Name is required',
            'txt_edit_price_per_item.required' => 'Price per Item is required',
            'txt_edit_price_per_item.numeric' => 'Enter only numeric values',
            'txt_edit_quantity_per_crate.required' => 'Price per Item is required',
            'txt_edit_quantity_per_crate.numeric' => 'Enter only numeric values',
            'txt_edit_stock_threshold.required' => 'Price per Item is required',
            'txt_edit_stock_threshold.numeric' => 'Enter only numeric values',
            'txt_edit_status.required' => 'Status is required'
        ]);

         $user_session = Session::get('user_session');
        //  $active_user = $user_session->first_name.' '.$user_session->last_name;
        $active_user = $user_session->username;

        $product_id = $request->get('product_id');
        $update_product = Products::find($product_id);

        $today_date = Carbon::now()->toDateTimeString();
        // dd($today_date->toDateTimeString());

        $current_date_and_time = Carbon::now()->toDateTimeString();

        $price_per_crate = (double)($request->get('txt_edit_price_per_item')) * (double)($request->get('txt_edit_quantity_per_crate'));

        $update_product->name = ucwords($request->get('txt_edit_product_name'));
        $update_product->price_per_item = $request->get('txt_edit_price_per_item');
        $update_product->quantity_per_crate = $request->get('txt_edit_quantity_per_crate');
        $update_product->price_per_crate = $price_per_crate;
        $update_product->stock_threshold = $request->get('txt_edit_stock_threshold');
        $update_product->status = $request->get('txt_edit_status');
        $update_product->description = Str::ucfirst($request->get('txt_edit_description'));
        $update_product->updated_by = $active_user;
        $update_product->updated_at = $current_date_and_time;
        $update_product->save();

        Alert::toast('Product Details Updated','success');
        return redirect()->back();
    }


    public function delete_product(Request $request){
        $product_id = $request->get('product_id');
        Products::where('id', $product_id)->delete();

        Alert::toast('Product Deleted','warning');
        return back();
    }
}
