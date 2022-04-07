<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;


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
//     \Artisan::call('cache:clear');
//     \Artisan::call('config:clear');
//     \Artisan::call('view:clear');
// });
Route::get("pub",[AdminController::class,'pub']);
Route::get("sd",[AdminController::class,'sd']);
// under maintains
// Route::get("constraction",[MerchantController::class,'constraction']);
//  Route::get("undermaintain",[AdminController::class,'undermaintain']);
// admin
Route::group(['middleware'=>["adminlogin"]],function(){
    Route::get("dashboard",[AdminController::class,'dashboard']);
    Route::get("adminlogin",[AdminController::class,'adminlogin']);
    Route::post("adminlogincheck",[AdminController::class,'adminlogincheck']);
    Route::get("adminlogout",[AdminController::class,'adminlogout']);
    Route::get("userlist",[AdminController::class,'userlist']);
    // admin lein to wallet
    Route::get("adminleintomain",[AdminController::class,'adminleintomain']);
    Route::post("adminleintomain_form",[AdminController::class,'adminleintomain_form']);
    // createplan
    Route::get("createplan",[AdminController::class,'createplan']);
    Route::get("createplan/{id}",[AdminController::class,'createplan']);
    Route::post("createplan_from",[AdminController::class,'createplan_from']);
    Route::get("plan_delete/{id}",[AdminController::class,'plan_delete']);
    Route::get("paymentslist",[AdminController::class,'paymentslist']);
    Route::get("set_plan_base_price",[AdminController::class,'set_plan_base_price']);
    Route::post("set_plan_base_price_form",[AdminController::class,'set_plan_base_price_form']);
    // admincreateuser
    Route::get("admincreateuser",[AdminController::class,'admincreateuser']);
    // commission
    Route::get("commission",[AdminController::class,'commission']);
    Route::post("commission_form",[AdminController::class,'commission_form']);
    Route::post("commission_settings_form",[AdminController::class,'commission_settings_form']);
    Route::get("paymentandutilities",[AdminController::class,'paymentandutilities']);
    Route::get("epos",[AdminController::class,'epos']);
    Route::get("recentsettlements",[AdminController::class,'recentsettlements']);
    // store
    Route::get("storelist",[AdminController::class,'storelist']);
    Route::get("networkstorelist/{id}",[AdminController::class,'networkstorelist']);
    Route::get("storelist_bynumber",[AdminController::class,'storelist_bynumber']);
    Route::get("storependinglist",[AdminController::class,'storependinglist']);
    Route::post("change_shop_stats",[AdminController::class,'change_shop_stats']);
    Route::post("change_instant_stats",[AdminController::class,'change_instant_stats']);
    Route::post("change_send_money_stats",[AdminController::class,'change_send_money_stats']);
    Route::post("add_money_form",[AdminController::class,'add_money_form']);
    Route::post("admin_plan_upgrade",[AdminController::class,'admin_plan_upgrade']);
    Route::post("deduct_money_form",[AdminController::class,'deduct_money_form']);
    Route::post("shop_service_form",[AdminController::class,'shop_service_form']);
    Route::post("store_paymentoptions_form",[AdminController::class,'store_paymentoptions_form']);
    Route::get("viewshop/{id}",[AdminController::class,'viewshop']);
    Route::get("deleteshop/{id}",[AdminController::class,'deleteshop']);
    Route::get("blockshop/{id}",[AdminController::class,'blockshop']);
    Route::get("unblockshop/{id}",[AdminController::class,'unblockshop']);
    Route::get("peyment_link_setting",[AdminController::class,'peyment_link_setting']);
    Route::post("payment_link_getway_form",[AdminController::class,'payment_link_getway_form']);
    // offerpopup
    Route::get("offerpopup",[AdminController::class,'offerpopup']);
    Route::post("offerpopup_form",[AdminController::class,'offerpopup_form']);
    // lein transfer 
    Route::get("leintransfer",[AdminController::class,'leintransfer']);
    Route::post("admin_lein_filter",[AdminController::class,'admin_lein_filter']);
    Route::post("leintransfer_find_user_data",[AdminController::class,'leintransfer_find_user_data']);
    Route::post("multy_lein_tranfer_form",[AdminController::class,'multy_lein_tranfer_form']);
    Route::post("leintransfer_form",[AdminController::class,'leintransfer_form']);
    // distributor
    Route::get("distributorlist",[AdminController::class,'distributorlist']);
    Route::get("networkdistributorlist/{id}",[AdminController::class,'networkdistributorlist']);
    Route::post("distributorlist_bynumber",[AdminController::class,'distributorlist_bynumber']);
    Route::get("distributorpendinglist",[AdminController::class,'distributorpendinglist']);
    // master distributor
    Route::get("masterdistributorlist",[AdminController::class,'masterdistributorlist']);
    Route::post("masterdistributorlist_bynumber",[AdminController::class,'masterdistributorlist_bynumber']);
    Route::get("masterdistributorpendinglist",[AdminController::class,'masterdistributorpendinglist']);
    // admin kyc 
    Route::post("change_kyc_stats",[AdminController::class,'change_kyc_stats']);
    Route::get("view_kyc_document/{id}",[AdminController::class,'view_kyc_document']);
    // add account charges
    Route::get("add_account_charges",[AdminController::class,'add_account_charges']);
    Route::post("add_account_charges_form",[AdminController::class,'add_account_charges_form']);
    // marque text
    Route::get("marquetext",[AdminController::class,'marquetext']);
    Route::post("marquetext_form",[AdminController::class,'marquetext_form']);
    //peymentlink setting
    Route::get("peyment_link_setting",[AdminController::class,'peyment_link_setting']);
    Route::post("payment_link_getway_form",[AdminController::class,'payment_link_getway_form']);
    Route::post("update_payment_link_option",[AdminController::class,'update_payment_link_option']);
    // payment getway settings
    Route::get("select_payment_getway",[AdminController::class,'select_payment_getway']);
    Route::post("select_payment_getway_form",[AdminController::class,'select_payment_getway_form']);
    Route::get("payment_gateway_key",[AdminController::class,'payment_gateway_key']);
    Route::post("payment_gateway_key_form",[AdminController::class,'payment_gateway_key_form']);
    Route::post("update_payment_option",[AdminController::class,'update_payment_option']);
    Route::get("paymentgetwaysettings",[AdminController::class,'paymentgetwaysettings']);
    Route::post("paymentgetwaysettings_form",[AdminController::class,'paymentgetwaysettings_form']);
    // Top-Up Option
    Route::get("topupoption",[AdminController::class,'topupoption']);
    Route::post("topupoption_form",[AdminController::class,'topupoption_form']);
    // tranfer list admin
    Route::get("leintransition",[AdminController::class,'leintransition']);
    Route::get("addwallettransitionlist",[AdminController::class,'addwallettransitionlist']);
    Route::get("admin_internaltransitionlist",[AdminController::class,'admin_internaltransitionlist']);
    Route::get("admin_internaltransitionlist_filter",[AdminController::class,'admin_internaltransitionlist_filter']);
    Route::get("admin_leinwallet_history",[AdminController::class,'admin_leinwallet_history']);
    Route::get("admin_leinwallet_history_filter",[AdminController::class,'admin_leinwallet_history_filter']);
    Route::get("admin_payout_history",[AdminController::class,'admin_payout_history']);
    Route::get("admin_payout_filter",[AdminController::class,'admin_payout_filter']);
    Route::get("admin_commition_all_history",[AdminController::class,'admin_commition_all_history']);
    Route::get("admin_commition_all_history_filter",[AdminController::class,'admin_commition_all_history_filter']);
    Route::get("admin_add_wallet_history",[AdminController::class,'admin_add_wallet_history']);
    Route::get("admin_all_transaction",[AdminController::class,'admin_all_transaction']);
    Route::get("admin_tally",[AdminController::class,'admin_tally']);
    Route::get('/tasks', 'AdminController@tallyexport');
    Route::get("admin_add_wallet_history_filter",[AdminController::class,'admin_add_wallet_history_filter']);
    Route::get("admin_deduct_money_history",[AdminController::class,'admin_deduct_money_history']);
    Route::get("admin_deduct_money_history_filter",[AdminController::class,'admin_deduct_money_history_filter']);
    Route::get("razorpaytransitionhistory",[AdminController::class,'razorpaytransitionhistory']);
    Route::get("cashfreetransitionhistory",[AdminController::class,'cashfreetransitionhistory']);
    Route::get("admin_commission_history",[AdminController::class,'admin_commission_history']);
    // cashbackdiscount
    Route::get("cashbackdiscount",[AdminController::class,'cashbackdiscount']);
    Route::post("cashbackdiscount_form",[AdminController::class,'cashbackdiscount_form']);
    // bank details
    Route::get("bankdetailsupdate",[AdminController::class,'bankdetailsupdate']);
    Route::get("bankdetailsdelete/{id}",[AdminController::class,'bankdetailsdelete']);
    Route::get("bankdetailsupdate/{id}",[AdminController::class,'bankdetailsupdate']);
    Route::post("bankdetailsupdate_form",[AdminController::class,'bankdetailsupdate_form']);
    // bank_transfer_fees
    Route::get("bank_transfer_fees",[AdminController::class,'bank_transfer_fees']);
    Route::post("bank_transfer_fees_form",[AdminController::class,'bank_transfer_fees_form']);
    // notification
    Route::post("count_admin_notification",[AdminController::class,'count_admin_notification']);
    Route::post("change_admin_notification",[AdminController::class,'change_admin_notification']);
    // admin filter
    Route::get("admin_dashboard_filter",[AdminController::class,'admin_dashboard_filter']);
    // admin_total_business
    Route::get("merchant_business",[AdminController::class,'merchant_business']);
    Route::get("distibutor_business",[AdminController::class,'distibutor_business']);
    Route::get("master_distibutor_business",[AdminController::class,'master_distibutor_business']);
    Route::post("ajax_info_filter_admin",[AdminController::class,'ajax_info_filter_admin']);
    // admin mapping
    Route::get("admin_mapping_request",[AdminController::class,'admin_mapping_request']);
    Route::get("accept_mapping_request/{id}",[AdminController::class,'accept_mapping_request']);
    Route::get("rejecte_mapping_request/{id}",[AdminController::class,'rejecte_mapping_request']);
    Route::get("find_mapping_data_form",[AdminController::class,'find_mapping_data_form']);
    // update_credentials
    Route::get("update_credentials",[AdminController::class,'update_credentials']);
    Route::post("update_credentials_post",[AdminController::class,'update_credentials_post']);
    // add to wallet admin
    Route::post("get_user_data",[AdminController::class,'get_user_data']);
    Route::get("errorlog",[AdminController::class,'errorlog']);
    Route::get("cleneerror/{id}",[AdminController::class,'cleneerror']);
    Route::post("errorcount_ajax",[AdminController::class,'errorcount_ajax']);
});
// end admin
// Route::group(['middleware'=>["conspage"]],function(){
// Merchant
Route::get("loginwithpin",[MerchantController::class,'loginwithpin']);
Route::group(['middleware'=>["userislogin"]],function(){
    Route::get("login",[MerchantController::class,'login']);
    Route::get("linkgen",[MerchantController::class,'linkgen']);
    Route::get("peyment_setting_list",[MerchantController::class,'peyment_setting_list']);
    Route::post("peyment_link_generate",[MerchantController::class,'peyment_link_generate']);
    Route::get("home",[MerchantController::class,'home']);
    Route::post("filterinfo",[MerchantController::class,'filterinfo']);
    Route::post("ajax_info_filter",[MerchantController::class,'ajax_info_filter']);
    Route::post("ajax_info_filter_cdate",[MerchantController::class,'ajax_info_filter_cdate']);
    Route::get("businessdetails",[MerchantController::class,'businessdetails']);
    Route::get("wallet",[MerchantController::class,'wallet']);
    // profile
    Route::get("profile",[MerchantController::class,'profile']);
    Route::get("profile/{userid}",[MerchantController::class,'profile']);
    Route::get("profile_doc",[MerchantController::class,'profile_doc']);
    // add money
    // Route::get("addmoney",[MerchantController::class,'addmoney']);
    Route::post("addmoney_rezorpay",[MerchantController::class,'addmoney_rezorpay']);
    Route::post("addmoney_rezorpay_fail",[MerchantController::class,'addmoney_rezorpay_fail']);
    Route::post("check_paymentgetway_by_option",[MerchantController::class,'check_paymentgetway_by_option']);
    Route::post("check_addmoney_conversion_fees",[MerchantController::class,'check_addmoney_conversion_fees']);
    // kyc 
    Route::get("submit_your_kyc",[MerchantController::class,'submit_your_kyc']);
    Route::post("mearchantkycsubmit",[MerchantController::class,'mearchantkycsubmit']);
    // Transaction Pin
    Route::get("transactionpin",[MerchantController::class,'transactionpin']);
    Route::post("transactionpin_update",[MerchantController::class,'transactionpin_update']);
    Route::post("tpin_change_email_otp_send",[MerchantController::class,'tpin_change_email_otp_send']);
    Route::post("transactionpin_create",[MerchantController::class,'transactionpin_create']);
    Route::post("gen_tpin_in_model_form",[MerchantController::class,'gen_tpin_in_model_form']);
    Route::post("tpin_verify_form",[MerchantController::class,'tpin_verify_form']);
    // Wallet transaction
    Route::get("internal_transfer",[MerchantController::class,'internal_transfer']);
    Route::post("funds_transfer_form",[MerchantController::class,'funds_transfer_form']);
    Route::get("leinwallet",[MerchantController::class,'leinwallet']);
    Route::post("leinwallet_to_main_form",[MerchantController::class,'leinwallet_to_main_form']);
    Route::post("find_user_data",[MerchantController::class,'find_user_data']);
    // Add account
    Route::get("add_account",[MerchantController::class,'add_account']);
    Route::post("add_account_form",[MerchantController::class,'add_account_form']);
    Route::post("add_varifyed_paye",[MerchantController::class,'add_varifyed_paye']);
    Route::post("cancel_add_varifyed_paye",[MerchantController::class,'cancel_add_varifyed_paye']);
    Route::post("delete_bankaccount",[MerchantController::class,'delete_bankaccount']);
    Route::get("money_transfer_form",[MerchantController::class,'money_transfer_form']);
    Route::post("money_transfer_form_sub",[MerchantController::class,'money_transfer_form_sub']);
    Route::post("pay_submit_form",[MerchantController::class,'pay_submit_form']);
    Route::post("check_bank_transfer_amount",[MerchantController::class,'check_bank_transfer_amount']);
    Route::get("find_bankacount_search",[MerchantController::class,'find_bankacount_search']);
    Route::get("success_tranfer_page/{id}",[MerchantController::class,'success_tranfer_page']);
    Route::get("print_payout_response/{id}",[MerchantController::class,'print_payout_response']);
    Route::get("print_pdf_payout_response/{id}",[MerchantController::class,'print_pdf_payout_response']);
    Route::post("add_to_favorites_thistory",[MerchantController::class,'add_to_favorites_thistory']);
    Route::post("notification_status_change",[MerchantController::class,'notification_status_change']);
    // notification
    Route::post("notification_status_change",[MerchantController::class,'notification_status_change']);
    // tranfer list
    Route::get("transition_view/{id}",[MerchantController::class,'transition_view']);
    Route::get("transaction_history",[MerchantController::class,'transaction_history']);
    Route::get("export_transaction_history",[MerchantController::class,'export_transaction_history']);
    Route::get("print_transaction_history",[MerchantController::class,'print_transaction_history']);
    Route::get("comissionhistory",[MerchantController::class,'comissionhistory']);
    Route::get("export_comissionhistory",[MerchantController::class,'export_comissionhistory']);
    Route::get("printcomissionhistory",[MerchantController::class,'printcomissionhistory']);
    Route::get("alltransaction",[MerchantController::class,'alltransaction']);
    Route::get("user_alltranaction_search",[MerchantController::class,'user_alltranaction_search']);
    Route::get("export_all_transaction",[MerchantController::class,'export_all_transaction']);
    Route::get("printalltransaction",[MerchantController::class,'printalltransaction']);
    // payout trananstion
    Route::get("payouttransaction",[MerchantController::class,'payouttransaction']);
    Route::get("export_payouttransaction",[MerchantController::class,'export_payouttransaction']);
    Route::get("printpayouttransaction",[MerchantController::class,'printpayouttransaction']);
    Route::get("payoutfilter",[MerchantController::class,'payoutfilter']);
    // Route::get("razorpaytransitionhistory",[MerchantController::class,'razorpaytransitionhistory']);
    // Route::get("cashfreetransitionhistory",[MerchantController::class,'cashfreetransitionhistory']);
    Route::get("leinwallettransition",[MerchantController::class,'leinwallettransition']);
    Route::post("leinwallettransition_date_filter",[MerchantController::class,'leinwallettransition_date_filter']);
    Route::get("addwallettransition",[MerchantController::class,'addwallettransition']);
    Route::get("printaddwallettransition",[MerchantController::class,'printaddwallettransition']);
    Route::get("export_wallet_add_transaction",[MerchantController::class,'export_wallet_add_transaction']);
    Route::post("addwallettransitionfilter",[MerchantController::class,'addwallettransitionfilter']);
    Route::get("internaltransition",[MerchantController::class,'internaltransition']);
    Route::post("internal_transfer_wallet_check",[MerchantController::class,'internal_transfer_wallet_check']);
    Route::get("export_internaltransition",[MerchantController::class,'export_internaltransition']);
    Route::get("printinternaltransition",[MerchantController::class,'printinternaltransition']);
    Route::get("admintransitionhistory",[MerchantController::class,'admintransitionhistory']);
    Route::get("export_admintransitionhistory",[MerchantController::class,'export_admintransitionhistory']);
    Route::get("printadmintransitionhistory",[MerchantController::class,'printadmintransitionhistory']);
    // buy pricing
    Route::get("plan_purchase",[MerchantController::class,'plan_purchase']);
    Route::post("rez_plan_purchase",[MerchantController::class,'rez_plan_purchase']);
    Route::post("upgrade_plan_from_wallet",[MerchantController::class,'upgrade_plan_from_wallet']);
    Route::post("network_upgrade_plan_from_wallet",[MerchantController::class,'network_upgrade_plan_from_wallet']);
    Route::post("cashfree_plan_purchase",[MerchantController::class,'cashfree_plan_purchase']);
    Route::get("plan_purches_form/{id}",[MerchantController::class,'plan_purches_form']);

    // distributor start
    Route::get("my_network",[MerchantController::class,'my_network']);
    Route::post("searchnetwork",[MerchantController::class,'searchnetwork']);
    Route::get("merchant_network_list",[MerchantController::class,'merchant_network_list']);
    Route::get("addnewnetwork",[MerchantController::class,'addnewnetwork']);
    Route::get("credittonetwork",[MerchantController::class,'credittonetwork']);
    Route::post("distibutor_funds_transfer_form",[MerchantController::class,'distibutor_funds_transfer_form']);
    Route::post("distibutor_change_network_plan_form",[MerchantController::class,'distibutor_change_network_plan_form']);
    Route::get("epos_singal_data/{id}",[MerchantController::class,'epos_singal_data']);
    Route::post("notification_is_view",[MerchantController::class,'notification_is_view']);

    // mapping
    Route::get("mapping",[MerchantController::class,'mapping']);
    Route::post("mapping_form",[MerchantController::class,'mapping_form']);
    Route::get("mapping_request",[MerchantController::class,'mapping_request']);
    Route::get("mapping_accept/{id}",[MerchantController::class,'mapping_accept']);
    Route::get("mapping_reject/{id}",[MerchantController::class,'mapping_reject']);
    // total_business
    Route::get("total_business",[MerchantController::class,'total_business']);
    Route::get("total_business_filter",[MerchantController::class,'total_business_filter']);
});
// notification
Route::post("count_notification",[MerchantController::class,'count_notification']);
// with out mdw
Route::post("add_network_form",[MerchantController::class,'add_network_form']);
Route::get("payment_sresponse_url/{id}",[MerchantController::class,'payment_sresponse_url']);
Route::get("payment_fresponse_url/{id}",[MerchantController::class,'payment_fresponse_url']);

Route::get("registration",[MerchantController::class,'registration']);
Route::post("registration_form",[MerchantController::class,'registration_form']);
Route::post("check_fssai_licence",[MerchantController::class,'check_fssai_licence']);
Route::post("check_number_valid",[MerchantController::class,'check_number_valid']);

Route::post("logincheck",[MerchantController::class,'logincheck']);
Route::post("loginwithpincheck",[MerchantController::class,'loginwithpincheck']);
Route::post("check_number_valid_login",[MerchantController::class,'check_number_valid_login']);
Route::post("find_account_by_number",[MerchantController::class,'find_account_by_number']);
Route::post("check_transaction_pin",[MerchantController::class,'check_transaction_pin']);
Route::post("order",[OrderController::class,'create']);
Route::get("text",[OrderController::class,'text']);
Route::post("payments/thankyou",[PaymentController::class,'check_transaction_pin']);
// Cash free
Route::post("addmoney_cashfree",[MerchantController::class,'addmoney_cashfree']);
Route::post("payment_with_payu",[MerchantController::class,'payment_with_payu']);
Route::post("return_url",[MerchantController::class,'return_url']);
Route::get("cashbackdistributated_cron",[MerchantController::class,'cashbackdistributated_cron']);
Route::get("addwalletcronjob",[MerchantController::class,'addwalletcronjob']);
Route::get("addmoney",[MerchantController::class,'addmoney']);
Route::get("utilitiesandpayments",[MerchantController::class,'utilitiesandpayments']);
Route::get("logout",[MerchantController::class,'logout']);
// plan purches
Route::post("cashfree_plan_purchase_returnurl",[MerchantController::class,'cashfree_plan_purchase_returnurl']);
Route::get("plan_success_url/{id}",[MerchantController::class,'plan_success_url']);
Route::get("plan_fail_url/{id}",[MerchantController::class,'plan_fail_url']);
Route::post("on_change_bank",[MerchantController::class,'on_change_bank']);
Route::post("epos_cashfree",[MerchantController::class,'epos_cashfree']);
Route::get("epos_rezorpay",[MerchantController::class,'epos_rezorpay']);
// forget password
Route::get("forgotpassword",[MerchantController::class,'forgotpassword']);
Route::get("otpverify",[MerchantController::class,'otpverify']);
Route::post("forgotpassword_form",[MerchantController::class,'forgotpassword_form']);
Route::post("fchangepassword_form",[MerchantController::class,'fchangepassword_form']);
Route::post("otpverify_form",[MerchantController::class,'otpverify_form']);
Route::post("add_fav_account",[MerchantController::class,'add_fav_account']);
Route::post("remove_fav_account",[MerchantController::class,'remove_fav_account']);
Route::get("comingsoon",[MerchantController::class,'comingsoon']);
// web site
Route::get("/",[SiteController::class,'index']);
Route::get("about",[SiteController::class,'about']);
Route::get("b",[SiteController::class,'b']);
Route::get("bill_payment",[SiteController::class,'bill_payment']);
Route::get("business",[SiteController::class,'business']);
Route::get("contact",[SiteController::class,'contact']);
Route::get("distributor",[SiteController::class,'distributor']);
Route::get("masterdistributor",[SiteController::class,'masterdistributor']);
Route::get("partner",[SiteController::class,'partner']);
Route::get("privacy_policy",[SiteController::class,'privacy_policy']);
Route::get("retailer",[SiteController::class,'retailer']);
Route::get("retutn_refundpolicy",[SiteController::class,'retutn_refundpolicy']);
Route::get("terms_conditions",[SiteController::class,'terms_conditions']);
Route::get("payystatus_check_cronjob",[MerchantController::class,'payystatus_check_cronjob']);
Route::get("tranaction_check_cronjob",[AdminController::class,'tranaction_check_cronjob']);
// });