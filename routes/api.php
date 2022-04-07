<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Auth Apis
Route::post("login",[ApiController::class,'login']);
Route::post("login_with_pin",[ApiController::class,'login_with_pin']);
Route::post("registration",[ApiController::class,'registration']);
// Auth Apis end
// Get user function
Route::post("get_user_by_number",[ApiController::class,'get_user_by_number']);
Route::get("get_user_by_id/{uid}",[ApiController::class,'get_user_by_id']);
Route::get("get_kyc_status/{uid}",[ApiController::class,'get_kyc_status']);
Route::get("addmoney_tax_rate/{uid}/{payment_method}/{topup_option}",[ApiController::class,'addmoney_tax_rate']);
Route::get("verify_tpin/{uid}/{tpin}",[ApiController::class,'verify_tpin']);
Route::get("user_plan_details/{uid}",[ApiController::class,'user_plan_details']);
Route::get("success_payee_data/{id}",[ApiController::class,'success_payee_data']);
Route::get("find_user_bynumber/{uid}/{phone}",[ApiController::class,'find_user_bynumber']);
Route::post("verify_bank_api",[ApiController::class,'verify_bank_api']);
Route::get("user_money_tns_status/{uid}",[ApiController::class,'get_money_tns_status']);
Route::get("user_active_status/{uid}",[ApiController::class,'user_active_status']);
// Get user function end
// transaction insert
Route::post("internal_transfer_form",[ApiController::class,'internal_transfer_form']);
Route::post("addmoney_form",[ApiController::class,'addmoney_form']);
Route::post("plan_upgrade",[ApiController::class,'plan_upgrade']);
Route::post("bank_varify",[ApiController::class,'bank_varify']);
Route::post("add_payee_form",[ApiController::class,'add_payee_form']);
// transaction insert end
// Get user function type list
Route::get("user_payout_banks/{uid}",[ApiController::class,'user_payout_banks']);
Route::get("user_payout_banks_filter/{uid}/{phone}/{name}/{accountno}",[ApiController::class,'user_payout_banks_filter']);
Route::get("payout_tranaction/{uid}",[ApiController::class,'payout_tranaction']);
Route::get("payout_data/{uid}/{id}",[ApiController::class,'payout_data']);
Route::get("internal_tranaction/{uid}",[ApiController::class,'internal_tranaction']);
Route::get("addmoney_tranaction/{uid}",[ApiController::class,'addmoney_tranaction']);
Route::get("get_network_user/{uid}/{type}",[ApiController::class,'get_network_user']);
Route::get("get_epos_link_list/{uid}",[ApiController::class,'get_epos_link_list']);
// Get user function type list end
// User data update Apis
Route::post("login_pin_update",[ApiController::class,'login_pin_update']);
Route::post("forgot_login_pin",[ApiController::class,'forgot_login_pin']);
Route::post("generate_tpin",[ApiController::class,'generate_tpin']);
Route::post("change_tpin",[ApiController::class,'change_tpin']);
Route::post("kyc_submit",[ApiController::class,'kyc_submit']);
// User data update Apis end
// get component data
Route::get("banks_list",[ApiController::class,'banks_list']);
Route::get("purpose_of_payment_list",[ApiController::class,'purpose_of_payment_list']);
Route::get("bank_verification_fee",[ApiController::class,'bank_verification_fee']);
Route::get("payment_methods_list",[ApiController::class,'payment_methods_list']);
Route::get("payment_methods/{uid}",[ApiController::class,'payment_methods']);
Route::get("plans_list",[ApiController::class,'plans_list']);
Route::get("get_plan_data/{id}",[ApiController::class,'get_plan_data']);
Route::get("get_gatway_key/{type}",[ApiController::class,'get_gatway_key']);
// get component data end