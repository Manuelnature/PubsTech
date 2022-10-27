<?php

use Illuminate\Support\Facades\Route;

// ======= BAR
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RetailingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginStockController;
use App\Http\Controllers\WasherDebtsController;


// ========= CAR WASH
use App\Http\Controllers\VehiclesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\WashersController;
use App\Http\Controllers\WashingTransactionController;
use App\Http\Controllers\PricingController;


// ==========AUTH
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => 'disable_back_button'], function () {

    Route::get('/', [LoginController::class, 'index'])->middleware('alreadyLoggedIn');
    // Route::get('/', [LoginController::class, 'index']);
    Route::post('user_login', [LoginController::class, 'user_login'])->name('login_user');

    Route::get('register', [RegisterController::class, 'index']);
    Route::post('register', [RegisterController::class, 'user_register'])->name('register_user');

        Route::get('set_password', [SetPasswordController::class, 'index']);
        Route::post('set_user_password', [SetPasswordController::class, 'set_password'])->name('set_user_password');


    Route::group(['middleware' => 'isLoggedIn'], function () {

        // DASHBOARD ======================
        Route::get('home', [HomeController::class, 'index']);
        Route::get('dashboard', [HomeController::class, 'dashboard_view'])->name('dashboard');
        Route::post('filter_sales', [HomeController::class, 'filter_records'])->name('filter_sales');
        // Route::get('dashboard', [DashboardController::class, 'index']);
        Route::get('retailer_dashboard', [DashboardController::class, 'retailer_dashboard'])->name('retailer_dashboard');

        // PROFILE ======================
        Route::get('profile', [ProfileController::class, 'index']);
        Route::post('update_user_profile', [ProfileController::class, 'update_user_profile'])->name('update_user_profile');

        // PRODUCT ======================
        Route::get('product', [ProductController::class, 'index']);
        Route::post('add_product', [ProductController::class, 'add_product'])->name('add_product');
        Route::post('add_most_purchased', [ProductController::class, 'add_most_purchased'])->name('add_most_purchased');
        Route::post('update_product', [ProductController::class, 'update_product'])->name('update_product');
        Route::post('delete_product', [ProductController::class, 'delete_product'])->name('delete_product');

         // SALES ======================
         Route::get('retailing', [RetailingController::class, 'index']);
         Route::post('add_sale', [RetailingController::class, 'add_sale'])->name('add_sale');
         Route::post('add_sale_from_modal', [RetailingController::class, 'add_sale_from_modal'])->name('add_sale_from_modal');
         Route::post('update_sale', [RetailingController::class, 'update_sale'])->name('update_sale');
         Route::post('filter_sale', [RetailingController::class, 'filter_sale'])->name('filter_sale');

         // WAREHOUSE ======================
         Route::get('warehouse', [WarehouseController::class, 'index']);
         Route::post('add_stock', [WarehouseController::class, 'add_stock'])->name('add_stock');
         Route::post('update_stock', [WarehouseController::class, 'update_stock'])->name('update_stock');
         Route::post('delete_stock', [WarehouseController::class, 'delete_stock'])->name('delete_stock');

         // TRANSFERs ======================
         Route::get('transfer', [TransferController::class, 'index']);
         Route::post('transfer_stock', [TransferController::class, 'transfer_stock'])->name('transfer_stock');
         Route::post('update_transfer', [TransferController::class, 'update_transfer'])->name('update_transfer');
         Route::post('filter_transfer', [TransferController::class, 'filter_transfer'])->name('filter_transfer');

         // USERS ======================
         Route::get('users', [UserController::class, 'index']);
         Route::post('add_user', [UserController::class, 'add_user'])->name('add_user');
         Route::post('update_user', [UserController::class, 'update_user'])->name('update_user');
         Route::post('delete_user', [UserController::class, 'delete_user'])->name('delete_user');

         // USERS ======================
         Route::get('login_stock', [LoginStockController::class, 'index']);
         Route::post('filter_login_stock', [LoginStockController::class, 'filter_login_stock'])->name('filter_login_stock');


        // ======================================= CAR WASH ========================================
         // VEHICLES ======================
         Route::get('vehicles', [VehiclesController::class, 'index']);
         Route::post('add_vehicle', [VehiclesController::class, 'add_vehicle'])->name('add_vehicle');
         Route::post('update_vehicle', [VehiclesController::class, 'update_vehicle'])->name('update_vehicle');

         Route::post('add_vehicle_type', [VehiclesController::class, 'add_vehicle_type'])->name('add_vehicle_type');
         Route::post('update_vehicle_type', [VehiclesController::class, 'update_vehicle_type'])->name('update_vehicle_type');

         // CAR WASH SERVICES ======================
         Route::get('services', [ServicesController::class, 'index']);
         Route::post('add_service', [ServicesController::class, 'add_service'])->name('add_service');
         Route::post('update_service', [ServicesController::class, 'update_service'])->name('update_service');

         // CAR WASH PRICING ======================
         Route::get('pricing', [PricingController::class, 'index']);
         Route::post('set_price', [PricingController::class, 'set_price'])->name('set_price');
         Route::post('update_price', [PricingController::class, 'update_price'])->name('update_price');



         // CAR WASHERS ======================
         Route::get('washers', [WashersController::class, 'index']);
         Route::post('add_washer', [WashersController::class, 'add_car_washer'])->name('add_washer');
         Route::post('update_washer', [WashersController::class, 'update_car_washer'])->name('update_washer');


         // CAR WASHER DEBT ======================
         Route::get('washer_debt', [WasherDebtsController::class, 'index']);
         Route::post('add_washer_debt', [WasherDebtsController::class, 'add_washer_debt'])->name('add_washer_debt');
         Route::post('update_washer_debt', [WasherDebtsController::class, 'update_washer_debt'])->name('update_washer_debt');


         // CAR WASHING TRANSACTION ======================
         Route::get('washing_transaction', [WashingTransactionController::class, 'index']);
         Route::post('add_transaction', [WashingTransactionController::class, 'add_transaction'])->name('add_transaction');
         Route::get('edit_transaction/{id}', [WashingTransactionController::class, 'edit_transaction'])->name('edit_transaction');
         Route::post('update_transaction/{id}', [WashingTransactionController::class, 'update_transaction'])->name('update_transaction');
         Route::post('filter_transaction', [WashingTransactionController::class, 'filter_transaction'])->name('filter_transaction');



         // LOGOUT ======================
         Route::get('logout', [LoginController::class, 'logout_user'])->name('logout');
    });
});
