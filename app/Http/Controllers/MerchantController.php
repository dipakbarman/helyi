<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Session;
use Validator;
use AppOrder;
use App\Models\Addwallet;
use LoveyCom\CashFree\PaymentGateway\Order;
use Maatwebsite\Excel\Facades\Excel;
use Razorpay\Api\Api;
use Mail;
use App\Exports\AddwalletExport;
use App\Exports\Alltransaction;
use App\Exports\Payouttransactionexport;
use App\Exports\Allcomissionhistorytransaction;
use App\Exports\Admintransitionhistory;
use App\Exports\Internaltransitionexport;
use App\Exports\Leinwallettowalletexport;

class MerchantController extends Controller
{
    public function __construct() {
        $keys_q = DB::table('gateway_key')->where('type',2)->first();
        $this->APP_ID = $keys_q->appkey;
        $this->SECRET_KEY = $keys_q->secretkey;

        $this->minimumAmount = 10;
        $this->maximumAmount = 5000;
    }
    // auth
    public function login(Type $var = null)
    {
        session()->forget(['otpis', 'email','otp_varify']);
        return view('auth.merchantlogin');
    }
    public function loginwithpin(Type $var = null)
    {
        if(session()->has('userid')){
            return redirect('utilitiesandpayments');
            die();
        }
        session()->forget(['otpis', 'email','otp_varify']);
        return view('auth.loginwithpin');
    }
    public function forgotpassword()
    {
        session()->forget(['otpis', 'email','otp_varify']);
        return view('auth.forgotpassword');
    }
    public function forgotpassword_form(Request $req)
    {
        if($req->type == 1){
            $check = DB::table('merchant')->where('email',$req->emailid)->where('is_deleted',0)->first();
            if(!empty($check)){
                $otp = rand(100000,999999);
                $data = ['password'=>$otp];
                $user['to']=$req->emailid;
                Mail::send('forgetpasswordmessage',$data,function($messages) use ($user){
                    $messages->to($user['to']);
                    $messages->subject('Forget Password');
                });
                session()->put('otpis',$otp);
                session()->put('otp_type',1);
                session()->put('email',$req->emailid);
                return redirect('otpverify')->with('success','OTP send to your email id');
            }else{
                return back()->with('error','Email id not found');
            }
        }
        if($req->type == 2){

        }
    }
    public function otpverify()
    {
        if(session()->has('otpis') && session()->has('email')){
            return view('auth.otpverify');
        }else{
            return redirect('forgotpassword');
        }
    }
    public function otpverify_form(Request $req)
    {
        $response = 0;
        if($req->otp == session()->get('otpis')){
            session()->put('otp_varify',1);
            $response = 1;
        }else{
            $response = 0;
        }
        return $response;
    }
    public function fchangepassword_form(Request $req)
    {
        if(session()->get('otp_varify') == 1){
            if(session()->get('otp_type') == 1){
                $data = array();
                $data['pass'] = Hash::make($req->pass);
                DB::table('merchant')->where('email',session()->get('email'))->update($data);
                session()->flush();
                return redirect('login')->with('success','Password change successfully');
            }
        }else{
            return redirect('login');
        }
    }
    public function registration(Type $var = null)
    {
        $data['stateq'] = DB::table('state')->OrderBy('name','ASC')->get();
        return view('auth.registration',$data);
    }
    public function check_fssai_licence(Request $req)
    {
        $check = DB::table('merchant')->where('fssai',$req->fssai)->count();
        if($check > 0){
            $success = 1;
        }else{
            $success = 0;
        }
        echo $success;
    }
    public function registration_form(Request $req){
        $data = array();
        // $plan_id = get_default_plan();
        $data['name'] = $req->firstname." ".$req->lastname;
        $data['firstname'] = $req->firstname;
        $data['lastname'] = $req->lastname;
        $data['dob'] = $req->dob;
        $data['pass'] = Hash::make($req->pass);
        $data['view_password'] = $req->pass;
        $data['gender'] = $req->gender;
        $data['mobile'] = $req->mobile;
        $data['email'] = $req->email;
        $data['p_address'] = $req->p_address;
        $data['referral'] = $req->referral;
        $data['is_otp'] = $req->is_otp;
        $data['shop_name'] = $req->shop_name;
        $data['shop_phone'] = $req->shop_phone;
        $data['business_category'] = $req->business_category;
        $data['shop_number'] = $req->shop_number;
        $data['landmark'] = $req->landmark;
        $data['city'] = $req->city;
        $data['pincode'] = $req->pincode;
        $data['state'] = $req->state;
        $data['geolocation'] = $req->geolocation;
        $data['city_of_operation'] = $req->city_of_operation;
        $data['area_of_operation'] = $req->area_of_operation;
        $data['gst'] = $req->gst;
        $data['fssai'] = $req->fssai;
        $data['loginpin'] = $req->loginpin;
        $data['is_deleted'] = 0;
        $data['is_active'] = 0;
        $data['wallet'] = 0;
        $data['lein_wallet'] = 0;
        $data['is_kyc'] = 0;
        $data['is_instant'] = 0;
        $data['type'] = $req->merchant_type;
        $data['is_kyc_submit'] = 0;
        $data['shop_id'] = get_uniq_id($req->merchant_type);
        $data['id_proof'] = $req->file('id_proof')->store('merchant');
        $data['bank_doc'] = $req->file('bank_doc')->store('merchant');
        $data['signature_doc'] = $req->file('signature_doc')->store('merchant');
        $data['store_logo'] = $req->file('store_logo')->store('merchant');
        $data['store_banner_logo'] = $req->file('store_banner_logo')->store('merchant');
        $data['date'] = date('Y-m-d');
        $data['mindate'] = date('Ymd');
        $data['plan_purches_date'] = date('Y-m-d');
        $data['plan_expiry_date'] = date('Y-m-d');
        $data['show_date'] = date('d-m-Y');
        $lastinsert_id = DB::table('merchant')->insertGetId($data);
        // $data = array();
        // $data['uid'] = $lastinsert_id; 
        // $data['plan_id'] = $plan_id; 
        // $data['date'] = date('Y-m-d'); 
        // $data['time'] = date('h:i:sa');
        // $data['ex_date'] = date('Y-m-d'); 
        // $data['price'] = get_plan_price($plan_id); 
        // DB::table('plan_p_log')->insert($data);
        $register_user_type = get_user_type($req->merchant_type);
        $data= array();
        $data['user_id'] = $lastinsert_id;
        $data['msg'] = "New sign up from".$register_user_type;
        $data['type'] = 1;
        $data['time'] = time();
        $data['mindate'] = date('Ymd');
        $data['view'] = 0;
        DB::table('admin_notification')->insert($data);
        $data = array();
        $data['not_active'] = 1;
        return redirect('login')->with('not_active_user_error','not_active');
    }
    public function check_number_valid(Request $req)
    {
        $check = DB::table('merchant')->where('is_deleted',0)->where('mobile',$req->mobile)->first();
        if(!empty($check)){
            return 0;
        }else{
            return 1;
        }
    }
    public function check_number_valid_login(Request $req)
    {
        $check = DB::table('merchant')->where('is_deleted',0)->where('mobile',$req->mobile)->first();
        if(!empty($check)){
            return 1;
        }else{
            return 0;
        }
    }
    public function logincheck(Request $req)
    {
        $req->validate([
            'mobile' => 'required',
            'pass' => 'required',
        ]);
        $where['mobile'] = $req->mobile;
        $check = DB::table('merchant')->where($where)->first();
        if(empty($check)){
            return back()->with('error','It seems like you are not registered with us, please register with us');
        }else{
            if (Hash::check($req->pass,$check->pass)) {
                if(empty($check->view_password)){
                    DB::table('merchant')->where('id',$check->id)->update(['view_password'=>$req->pass]);
                }
                if($check->is_active == 1){
                session()->flush();
                $req->session()->put('userid',$check->id);
                $req->session()->put('type',$check->type);
                $data = array();
                $data['success'] = "Login successful";
                $data['offer'] = "1";
                return redirect('utilitiesandpayments')->with($data);
                }else{
                    return back()->with('not_active_user_error','not_active');
                }
                
            }else{
                return back()->with('error','Incorrect password');
            }
        }
        
    }
    public function loginwithpincheck(Request $req)
    {
        $where['mobile'] = $req->mobile;
        $where['loginpin'] = $req->pin;
        $check = DB::table('merchant')->where($where)->first();
        if(empty($check)){
            return back()->with('error','Incorrect pin');
        }else{
            if($check->is_active == 1){
                session()->flush();
                $req->session()->put('userid',$check->id);
                $req->session()->put('type',$check->type);
                return redirect('utilitiesandpayments')->with('success','Login successful');   
            }else{
                return back()->with('not_active_user_error','not_active');
            }
        }
    }
    public function businessdetails(Type $var = null)
    {
        return view('auth.businessdetails');
    }
    public function logout(Type $var = null)
    {
        session()->flush();
        return redirect('login')->with('success','Successfully logged out');
    }
    public function adminlogout(Type $var = null)
    {
        session()->flush();
        return redirect('adminlogin')->with('success','Successfully logged out');
    }
    // dashboard
    public function home(Type $var = null)
    {
        $data['filtertype'] = 2;
        $data['filtertype_name'] = "Today";
        $data['q'] = DB::table('all_t_log')->where('uid',session()->get('userid'))->orderBy('id','DESC')->limit(10)->paginate(30);
        return view('backend.shop.home',$data);
    }
    public function ajax_info_filter(Request $req)
    {
        
        $t = "";
        if($req->boxid == 1){
                $t = total_addmoney_filter($req->uid,$req->value);
        }
        if($req->boxid == 2){
            if($req->value == 1){
                $t = DB::table('payout')->where('uid',$req->uid)->sum('amount');
            }
            if($req->value == 2){
                $t = DB::table('payout')->where('uid',$req->uid)->where('mindate',date('Ymd'))->sum('amount');
            }    
            if($req->value == 3){
                $t = DB::table('payout')->where('uid',$req->uid)->whereBetween('mindate',[date('Ymd', strtotime('-7 days')),date('Ymd')])->sum('amount');
            }   
            if($req->value == 4){
                $t = DB::table('payout')->where('uid',$req->uid)->whereBetween('mindate',[date('Ym01', strtotime('-7 days')),date('Ymd')])->sum('amount');
            }    
        }
        if($req->boxid == 22){
            if($req->value == 1){
                $t = DB::table('payout')->where('uid',$req->uid)->count();
            }
            if($req->value == 2){
                $t = DB::table('payout')->where('uid',$req->uid)->where('mindate',date('Ymd'))->count();
            }    
            if($req->value == 3){
                $t = DB::table('payout')->where('uid',$req->uid)->whereBetween('mindate',[date('Ymd', strtotime('-7 days')),date('Ymd')])->count();
            }   
            if($req->value == 4){
                $t = DB::table('payout')->where('uid',$req->uid)->whereBetween('mindate',[date('Ym01', strtotime('-7 days')),date('Ymd')])->count();
            }    
        }
        if($req->boxid == 3){
            $t = count_total_bank_added_filter($req->uid,$req->value);
        }
        if($req->boxid == 4){
            $t = total_transfer_funds_filter($req->uid,$req->value);
        }
        if($req->boxid == 5){
            $t = count_my_distibutor_network_filter($req->uid,$req->value);
        }
        if($req->boxid == 6){
            $t = count_my_merchant_network_filter($req->uid,$req->value);
        }
        if($req->boxid == 7){
            $t = count_total_network_transfer_filter($req->uid,$req->value);
        }
        if($req->boxid == 8){
            $t = count_total_wallet_filter($req->uid,$req->value);
        }
        return number_format($t,0);
    }
    public function ajax_info_filter_cdate(Request $req)
    {
        $t = "";
        $fdate = date_min(dateu($req->fdate));
        $tdate = date_min(dateu($req->tdate));
        if($req->boxid == 1){
            $t = total_addmoney_filter_cdate($req->uid,$fdate,$tdate);
        }
        if($req->boxid == 2){
            $t = DB::table('payout')->where('uid',$req->uid)->whereBetween('mindate',[$fdate,$tdate])->where('status',1)->sum('amount');
        }
        if($req->boxid == 22){
            $t = $t = DB::table('payout')->where('uid',$req->uid)->whereBetween('mindate',[$fdate,$tdate])->where('status',1)->count();
        }
        if($req->boxid == 3){
            $t = count_total_bank_added_filter_cdate($req->uid,$fdate,$tdate);
        }
        if($req->boxid == 4){
            $t = total_transfer_funds_cdate($req->uid,$fdate,$tdate);
        }
        if($req->boxid == 5){
            $t = count_my_distibutor_network_cdate($req->uid,$fdate,$tdate);
        }
        if($req->boxid == 6){
            $t = count_my_merchant_network_filter_cdate($req->uid,$fdate,$tdate);
        }
        if($req->boxid == 7){
            $t = count_total_network_transfer_filter_cdate($req->uid,$fdate,$tdate);
        }
        if($req->boxid == 8){
            $t = count_total_wallet_filter_cdate($req->uid,$fdate,$tdate);
        }
        return number_format($t,0);
    }
    public function filterinfo(Request $req)
    {
        $filter_type = 1;
        $filtertype_name = "Total";
        $data['q'] = DB::table('all_t_log')->where('uid',session()->get('userid'))->orderBy('id','DESC')->limit(10)->paginate(30);
        if(isset($req->ftype)){
            $filter_type = $req->ftype;
            if($req->ftype == 1){
                $filtertype_name = "Total";
            }
            if($req->ftype == 2){
                $filtertype_name = "Today";
            }
            if($req->ftype == 3){
                $filtertype_name = "Last 7 days";
            }
            if($req->ftype == 4){
                $filtertype_name = "This Month";
            }
            if($req->ftype == 5){
                $filtertype_name = "";
                $data['iscdate'] = 1;
                if(isset($req->fdate)){
                   $data['fdate'] = date_min(dateu($req->fdate));
                }else{
                    $data['fdate'] = date('Ymd');
                }
                if(isset($req->tdate)){
                    $data['tdate'] = date_min(dateu($req->tdate));
                }else{
                    $data['tdate'] = date('Ymd');
                }
            }
        }
        $data['filtertype_name'] = $filtertype_name;
        $data['filtertype'] = $filter_type;
        return view('backend.shop.home',$data);
    }
    public function wallet(Type $var = null)
    {
        return view('backend.shop.wallet');
    }
    // utilities and payments
    public function utilitiesandpayments(Type $var = null)
    {
        $active_payout  = get_payout_type();
        $data['q'] = DB::table('all_t_log')->where('uid',session()->get('userid'))->orderBy('id','DESC')->limit(10)->paginate(25);
        $data['fav'] = DB::table('payout')->where('uid',session()->get('userid'))->where('is_fav',1)->orderBy('id','DESC')->paginate(10);
        $data['fav_bankq'] = DB::table('merchant_bank_accounts')->where('uid',session()->get('userid'))->where('is_fav',1)->where('is_deleted',0)->orderby('id','DESC')->where('gatway_type',$active_payout)->paginate(5);
        if(session()->has('s_lastuid')){
            
            $udataq = DB::table('merchant')->where('id',session()->get('s_lastuid'))->first();
            session()->put('userid',$udataq->id);
            session()->put('type',$udataq->type);
            $msg = "Plan purchase successful";
            session()->forget('s_lastuid');
            return redirect('utilitiesandpayments')->with('success',$msg);
        }else if(session()->has('f_lastufid')){
            $udataq = DB::table('merchant')->where('id',session()->get('f_lastuid'))->first();
            session()->put('userid',$udataq->id);
            session()->put('type',$udataq->type);
            $msg = "Payment Failed";
            session()->forget('f_lastuid');
            return redirect('utilitiesandpayments')->with('error',$msg);
        }else{
            if(session()->has('userid')){           
            return view('backend.shop.utilitiesandpayments',$data);
            }else{          
            return redirect('login');           
            }           
        }
    }
    // add money
    public function addmoney()
    {
        if(session()->has('lastpaydata')){
            $my_data = DB::table('add_money_log')->where('id',session()->get('lastpaydata'))->first();
            $udataq = DB::table('merchant')->where('id',$my_data->userid)->first();
            session()->put('userid',$udataq->id);
            session()->put('type',$udataq->type);
            $msg = (int) $my_data->total_amount." Added to main wallet";
            session()->forget('lastpaydata');
            return redirect('addwallettransition')->with('success',$msg);
        }else if(session()->has('lastuid')){
            $my_data = DB::table('add_money_log')->where('id',session()->get('lastuid'))->first();
            $udataq = DB::table('merchant')->where('id',$my_data->userid)->first();
            session()->put('userid',$udataq->id);
            session()->put('type',$udataq->type);
            if(!empty($my_data->response_msg)){
                $msg = $my_data->response_msg;
            }else{
                $msg = "Payment Failed";
            }
            session()->forget('lastuid');
            return redirect('addwallettransition')->with('error',$msg);
        }
        else{
            if(session()->has('userid')){
                $data['q'] = DB::table('active_payment_getway')->first();
                $data['transactionq'] = DB::table('add_money_log')->where('userid',session()->get('userid'))->orderBy('id','DESC')->paginate(10);
                $data['userdata'] = DB::table('merchant')->where('id',session()->get('userid'))->first();
                return view('backend.shop.addmoney',$data);
            }else{
                return redirect('login');
            }
        }
        
        
    }
    public function check_paymentgetway_by_option(Request $req)
    {
        $success = 0;
        $check = DB::table('option_wise_payment_getway')->where('option_id',$req->paymentoption)->first();
        if(!empty($check)){
            $success = $check->payment_getway_id;
        }
        echo $success;
    }
    public function check_addmoney_conversion_fees(Request $req)
    {
        $success = 0;
        $userdat = userdataq();
        if(!empty($userdat)){
        $check_plan_data = DB::table('plans')->where('id',$userdat->plan_id)->first();   
        if($req->topupoption == 0){
            if($req->payment_option == 1){
                $success = $check_plan_data->debit_card_instant;
            }
            if($req->payment_option == 2){
                $success = $check_plan_data->netbanking_instant;
            }
            if($req->payment_option == 3){
                $success = $check_plan_data->upi_instant;
            }
            if($req->payment_option == 4 || $req->payment_option == 10){
                $success = $check_plan_data->credit_card_instant;
            }
            if($req->payment_option == 5){
                $success = $check_plan_data->amex_card_instant;
            }
            if($req->payment_option == 6){
                $success = $check_plan_data->diners_card_instant;
            }
            if($req->payment_option == 7){
                $success = $check_plan_data->wallet_instant;
            }
            if($req->payment_option == 8){
                $success = $check_plan_data->corporate_card_instant;
            }
            if($req->payment_option == 9){
                $success = $check_plan_data->prepaid_card_instant;
            }
        }
        if($req->topupoption == 1){
            if($req->payment_option == 1){
                $success = $check_plan_data->debit_card_t1;
            }
            if($req->payment_option == 2){
                $success = $check_plan_data->netbanking_t1;
            }
            if($req->payment_option == 3){
                $success = $check_plan_data->upi_t1;
            }
            if($req->payment_option == 4 || $req->payment_option == 10){
                $success = $check_plan_data->credit_card_t1;
            }
            if($req->payment_option == 5){
                $success = $check_plan_data->amex_card_t1;
            }
            if($req->payment_option == 6){
                $success = $check_plan_data->diners_card_t1;
            }
            if($req->payment_option == 7){
                $success = $check_plan_data->wallet_t1;
            }
            if($req->payment_option == 8){
                $success = $check_plan_data->corporate_card_t1;
            }
            if($req->payment_option == 9){
                $success = $check_plan_data->prepaid_card_t1;
            }
        }
        if($req->topupoption == 2){
            if($req->payment_option == 1){
                $success = $check_plan_data->debit_card_t2;
            }
            if($req->payment_option == 2){
                $success = $check_plan_data->netbanking_t2;
            }
            if($req->payment_option == 3){
                $success = $check_plan_data->upi_t2;
            }
            if($req->payment_option == 4 || $req->payment_option == 10){
                $success = $check_plan_data->credit_card_t2;
            }
            if($req->payment_option == 5){
                $success = $check_plan_data->amex_card_t2;
            }
            if($req->payment_option == 6){
                $success = $check_plan_data->diners_card_t2;
            }
            if($req->payment_option == 7){
                $success = $check_plan_data->wallet_t2;
            }
            if($req->payment_option == 8){
                $success = $check_plan_data->corporate_card_t2;
            }
            if($req->payment_option == 9){
                $success = $check_plan_data->prepaid_card_t2;
            }
        }
        if($req->topupoption == 3){
            if($req->payment_option == 1){
                $success = $check_plan_data->debit_card_t0;
            }
            if($req->payment_option == 2){
                $success = $check_plan_data->netbanking_t0;
            }
            if($req->payment_option == 3){
                $success = $check_plan_data->upi_t0;
            }
            if($req->payment_option == 4 || $req->payment_option == 10){
                $success = $check_plan_data->credit_card_t0;
            }
            if($req->payment_option == 5){
                $success = $check_plan_data->amex_card_t0;
            }
            if($req->payment_option == 6){
                $success = $check_plan_data->diners_card_t0;
            }
            if($req->payment_option == 7){
                $success = $check_plan_data->wallet_t0;
            }
            if($req->payment_option == 8){
                $success = $check_plan_data->corporate_card_t0;
            }
            if($req->payment_option == 9){
                $success = $check_plan_data->prepaid_card_t0;
            }
        }
    }
        echo $success;
    }
    // Add money
    public function addmoney_rezorpay(Request $req)
    {
        $userdat = userdataq();
        $rezorpay_api_key = get_rezorpay_api_kyes();
        $api = new Api($rezorpay_api_key['appkey'], $rezorpay_api_key['secretkey']);
        $capture_response = $api->payment->fetch($req->payment_id)->capture(array('amount'=>$req->amt*100,'currency' => 'INR'));
        $check_plan_data = DB::table('plans')->where('id',$userdat->plan_id)->first();
        $tzero = $check_plan_data->t0_hours;
        $amount = $req->amt;
        $taxrate = get_tax_value($userdat->plan_id,$req->payment_option,$req->topup_type);
        $count_total_taxrate = ($taxrate/100)*$amount;
        $count_total_amount = $amount-$count_total_taxrate;
        $gateway_type = 1;
        $data = array();
        $data['userid'] = $userdat->id;
        $data['amount'] = $req->amt;
        $data['total_amount'] = $count_total_amount;
        $data['balance'] = $userdat->wallet+$count_total_amount;
        $data['action'] = "Add";
        $data['bankit_fee'] = $count_total_taxrate;
        $data['time'] = date('h:i:sa');
        $data['date'] = date('Y-m-d');
        $data['min_date'] = date('Ymd');
        $data['view_date'] = date('d-m-Y');
        $data['topuptype'] = $req->topup_type;
        $data['paymentoption'] = $req->payment_option;
        $data['payment_id'] = $req->payment_id;
        $data['method_type'] = 1;
        $data['method'] = "Rezorpay";
        if(!empty($capture_response['status'])){
            $data['status_text'] = $capture_response['status'];
        }
        if($capture_response['captured']){
            $data['is_capture'] = 1;
        }else{
            $data['is_capture'] = 0;
        }
        if($req->topup_type == 0){
            $data['is_added'] = 1;
            $add_array = array();
            $add_array['txn_id'] = $req->payment_id;
            $add_array['amount'] = $count_total_amount;
            $add_array['uid'] = $userdat->id;
            $add_array['per_balance'] = $userdat->wallet;
            $add_array['post_balance'] = $userdat->wallet+$count_total_amount;
            $add_array['type'] = 1;
            insert_wallet_log($add_array);
            $u_data = array();
            $u_data['wallet'] = $userdat->wallet+$count_total_amount;
            DB::table('merchant')->where('id',$userdat->id)->update($u_data);
        }else{
            $data['is_added'] = 0;
            if($req->topup_type == 1){
                $data['timestamp'] = time() + (60 * 60 * 48);
            }
            if($req->topup_type == 2){
                $data['timestamp'] = time() + (60 * 60 * 72);
            }
            if($req->topup_type == 3){
                $data['timestamp'] = time() + (60 * 60 * $tzero);
            }
        }
        $lastinsertid = DB::table('add_money_log')->insertGetId($data);
        bankit_fee_distributed($userdat->id,$req->amt,$lastinsertid,$userdat->wallet+$amount,"");
        inset_all_t_log(1,$req->amt,"Add Wallet",$userdat->id,$userdat->wallet+$req->amt,"");
        inset_all_t_log(2,$count_total_taxrate,"Processing Fee",$userdat->id,$userdat->wallet+$count_total_amount,"");
        $data = array();
        $data['uid'] = $userdat->id;
        $data['lastid'] = $lastinsertid;
        $data['total'] = $count_total_amount;
        $data['amount'] = $amount;
        $data['fee'] = $count_total_taxrate;
        $data['type'] = 1;
        $data['action'] = 1;
        $data['opening_balance'] = $userdat->wallet;
        $data['ending_balance'] = $userdat->wallet+$count_total_amount;
        $data['txnid'] = $req->payment_id;
        $data['gateway_type'] = 1;
        $data['txn_status'] = 1;
        $historyid = insert_history($data);
        echo (int) $count_total_amount;
    }
     public function addmoney_rezorpay_fail(Request $req)
    {
            $userdat = get_company_all_data_byid(session()->get('userid'));
            $data = array();
            $data['userid'] = session()->get('userid');
            $data['amount'] = $req->amt;
            $data['total_amount'] = $req->amt;
            $data['balance'] = $userdat->wallet;
            $data['action'] = "Add";
            $data['bankit_fee'] = 0;
            $data['time'] = date('h:i:sa');
            $data['topuptype'] = $req->topup_type;
            $data['date'] = date('Y-m-d');
            $data['min_date'] = date('Ymd');
            $data['is_fail'] = 1;
            $data['is_added'] = 3;
            $data['view_date'] = date('d-m-Y');
            $data['method'] = "Rezorpay";
            $data['method_type'] = 1;
            $data['paymentoption'] = $req->payment_option;
            $data['payment_id'] = $req->payment_id;
            $last_add_money_log_id = DB::table('add_money_log')->insertGetId($data);
            inset_all_t_log(1,$req->amt,"Payment failed",session()->get('userid'),$userdat->wallet,"");
            $data = array();
            $data['uid'] = $userdat->id;
            $data['lastid'] = $last_add_money_log_id;
            $data['total'] = $req->amt;
            $data['amount'] = $req->amt;
            $data['fee'] = 0;
            $data['type'] = 1;
            $data['action'] = 1;
            $data['opening_balance'] = $userdat->wallet;
            $data['ending_balance'] = $userdat->wallet;
            $data['txnid'] = $req->payment_id;
            $data['gateway_type'] = 1;
            $data['txn_status'] = 2;
            $historyid = insert_history($data);
    }
    // kyc 
    public function submit_your_kyc(Type $var = null)
    {
        $data['userdata'] = DB::table('merchant')->where('id',session()->get('userid'))->first();
        return view('backend.shop.submit_your_kyc',$data);
    }
    public function mearchantkycsubmit(Request $req)
    {
        $data = array();
        $data['gov_font_side'] = $req->file('gov_font_side')->store('merchant');
        $data['gov_back_side'] = $req->file('gov_back_side')->store('merchant');
        $data['pancard'] = $req->file('pancard')->store('merchant');
        $data['kyc_Photo'] = $req->file('kyc_Photo')->store('merchant');
        $data['kyc_signature'] = $req->file('kyc_signature')->store('merchant');
        $data['is_kyc_submit'] = 1;
        DB::table('merchant')->where('id',session()->get('userid'))->update($data);
        return back()->with('success','Please wait for admin verification');
    }
    // Transaction Pin
    public function transactionpin()
    {
        $data['userdata'] = userdataq();
        return view('backend.shop.transactionpin',$data);
    }
    public function tpin_change_email_otp_send(Request $req)
    {
        if($req->type == 1){
            $where = array();
            $where['email'] = $req->emailid;
            $where['id'] = session()->get('userid');
            $check = DB::table('merchant')->where($where)->first();
            if(!empty($check)){
                session()->forget(['otpis', 'otp_type','otpisvarifyed']);
                $otp = rand(100000,999999);
                $data = ['password'=>$otp];
                $user['to']=$req->emailid;
                Mail::send('forgetpasswordmessage',$data,function($messages) use ($user){
                    $messages->to($user['to']);
                    $messages->subject('Forget Transaction Pin');
                });
                session()->put('otpis',$otp);
                session()->put('otp_type',1);
                return 1;
            }else{
                return 0;
            }
        }
        if($req->type == 2){
            if(session()->has('otpis')){
                if(session()->get('otpis') == $req->tpinotp){
                    session()->put('otpisvarifyed',1);
                    session()->forget(['otpis', 'otp_type']);
                    return 3;
                }else{
                    return 4;
                }
            }else{
                return 2;
            }
        }
        
    }
    public function transactionpin_update(Request $req)
    {
        if(session()->get('otpisvarifyed') == 1){
            $userdata = userdataq();
            $data = array();
            $data['transactionpin'] = $req->transactionpin;
            DB::table('merchant')->where('id',session()->get('userid'))->update($data);
            session()->forget(['otpisvarifyed']);
            return back()->with('success','Transaction pin Updated');
        }else{
            return back();
        }
        
    }
    public function transactionpin_create(Request $req)
    {
        $data = array();
        $data['transactionpin'] = $req->transactionpin;
        DB::table('merchant')->where('id',session()->get('userid'))->update($data);
        return back()->with('success','Transaction pin generated');
    }
    public function gen_tpin_in_model_form(Request $req)
    {
        $data = array();
        $data['transactionpin'] = $req->tpin;
        DB::table('merchant')->where('id',session()->get('userid'))->update($data);
        return 1;
    }
    // Wallet transaction
    public function internal_transfer(){
        $data['userdata'] = userdataq();        
        return view('backend.shop.wallet_transaction',$data);
    }
    public function leinwallet(){
        // $data['userdata'] = userdataq();
        // if(session()->get('type') == 3){
        //     $data['listq'] = DB::table('distribute_logs')->where('dis_id',session()->get('userid'))->orderBy('id','DESC')->paginate(30);
        // }
        // if(session()->get('type') == 4){
        //     $data['listq'] = DB::table('distribute_logs')->where('md_id',session()->get('userid'))->where('master_distributor','!=',NULL)->orderBy('id','DESC')->paginate(30);
        // }
        // if(session()->get('type') == 1){
        //     $data['listq'] = array();
        // }
        $data['q'] = DB::table('lein_to_wallet_log')->where('uid',session()->get('userid'))->orderBy('id','DESC')->paginate(30);
        return view('backend.shop.leinwallet',$data);
    }
    public function find_user_data(Request $req)
    {
        $user_data = userdataq();
        if($user_data->mobile != $req->phone_number){
        $data['userdata'] = userdataq();
        $check = DB::table('merchant')->where('is_deleted',0)->where('mobile',$req->phone_number)->first();
        if(!empty($check)){
            $data['account_data'] = $check;
            return view('backend.shop.wallet_transaction',$data);
        }else{
            return back()->with('error','No account found');
        }
        }else{
            return back()->with('error','No account found');
        }
    }
    public function funds_transfer_form(Request $req)
    {
        $data = array();
        $userq = DB::table('merchant')->where('id',session()->get('userid'))->first();
        $wallet_amount = $userq->wallet-$req->amount;
        $data['wallet'] = $wallet_amount;
        DB::table('merchant')->where('id',$userq->id)->update($data);
        $data = array();
        $sender_user = DB::table('merchant')->where('mobile',$req->phone_number)->first();
        $total = $sender_user->wallet+$req->amount;
        $data['wallet'] = $total;
        DB::table('merchant')->where('id',$sender_user->id)->update($data);
        inset_all_t_log(2,$req->amount,"Internal Transfer",session()->get('userid'),$wallet_amount,get_user_name($sender_user->id));
        inset_all_t_log(1,$req->amount,"Internal Transfer",$sender_user->id,$total,get_user_name(session()->get('userid')));
        $reciver_user_name = get_user_name($sender_user->id);
        $sender_user_name = get_user_name(session()->get('userid'));
        $msg = $req->amount." has been transferred to ".$reciver_user_name;
        $data = array();
        $data['time'] = time();
        $data['date'] = date('Ymd');
        $data['uid'] = session()->get('userid');
        $data['remark'] = $msg;
        $data['view'] = 0;
        $data['type'] = 2;
        $data['amount'] = $req->amount;
        DB::table('notification')->insert($data);
        $msg_user = $req->amount." received from ".$sender_user_name;
        $data = array();
        $data['time'] = time();
        $data['date'] = date('Ymd');
        $data['uid'] = $sender_user->id;
        $data['remark'] = $msg_user;
        $data['view'] = 0;
        $data['type'] = 1;
        $data['amount'] = $req->amount;
        DB::table('notification')->insert($data);
        $reciver_user_details = get_company_all_data_byid($sender_user->id);
        $session_user_details = get_company_all_data_byid(session()->get('userid'));
        $data = array();
        $data['userid'] = session()->get('userid');
        $data['received_userid'] = $sender_user->id;
        $data['sender_id'] = session()->get('userid');
        $data['amount'] = $req->amount;
        $data['date'] = date('Y-m-d');
        $data['mindate'] = date('Ymd');
        $data['is_view'] = 0;
        $data['type'] = 1;
        $data['action_name'] = "Debit";
        $data['viewd_user_name'] = $reciver_user_details->name;
        $data['viewd_user_shop_name'] = $reciver_user_details->shop_name;
        $data['viewd_user_shop_phone'] = $reciver_user_details->mobile;
        $data['remark'] = $req->remark;
        $data['time'] = date('h:i:s a');
        DB::table('funds_transfer_log')->insert($data);
        $data = array();
        $data['userid'] = $sender_user->id;
        $data['received_userid'] = $sender_user->id;
        $data['sender_id'] = session()->get('userid');
        $data['amount'] = $req->amount;
        $data['date'] = date('Y-m-d');
        $data['mindate'] = date('Ymd');
        $data['is_view'] = 0;
        $data['type'] = 2;
        $data['action_name'] = "Credit";
        $data['viewd_user_name'] = $session_user_details->name;
        $data['viewd_user_shop_name'] = $session_user_details->shop_name;
        $data['viewd_user_shop_phone'] = $session_user_details->mobile;
        $data['remark'] = $req->remark;
        $data['time'] = date('h:i:s a');
        DB::table('funds_transfer_log')->insert($data);
        // $sweet_success = array(
        //     "msg" => "Transaction successful",
        //     "link" => url('internal_transfer'),
        // );
        return redirect('utilitiesandpayments')->with('sw_success','Transaction successful');
    }
    public function leinwallet_to_main_form(Request $req)
    {
        $check_lein_wallet = get_lein_wallet_bal();
        if($req->lein_amount < 1){
            return back()->with('error','Enter valid amount');
        }else{
            if($req->lein_amount > $check_lein_wallet){
                return back()->with('error','You have insufficient balance');
            }else{
                $user_q = userdataq();
                $data = array();
                $data['wallet'] = $user_q->wallet+$req->lein_amount;
                $data['lein_wallet'] = $user_q->lein_wallet-$req->lein_amount;
                DB::table('merchant')->where('id',$user_q->id)->update($data);
                $data = array();
                $data['uid'] = $user_q->id;
                $data['ammount'] = $req->lein_amount;
                $data['date'] = date('Y-m-d');
                DB::table('lein_to_wallet_log')->insert($data);
                inset_all_t_log($req->lein_amount,"Lein to wallet",$user_q->id,"");
                return redirect('internal_transfer')->with('success','Process successful');
            }
        }
    }
    public function find_account_by_number(Request $req)
    {
        $check = DB::table('merchant')->where('is_deleted',0)->where('mobile',$req->phone_number)->first();
        if(!empty($check)){
            return 0;
        }else{
            return 1;
        }
    }
    public function check_transaction_pin(Request $req)
    {
        $check = DB::table('merchant')->where('is_deleted',0)->where('id',session()->get('userid'))->first();
        if(empty($check->transactionpin)){
            return 1;
        }else{
            if($req->m_amount > $check->wallet){
                return 4;
            }else{
                if($check->transactionpin == $req->transaction_pin){
                    return 2;
                }else{
                    return 3;
                }
            }
        }
    }
    // Add account
    public function add_account()
    {
        $active_payout  = get_payout_type();
        $data['bankq'] = DB::table('merchant_bank_accounts')->where('uid',session()->get('userid'))->where('is_deleted',0)->orderby('id','DESC')->where('gatway_type',$active_payout)->paginate(5);
        $data['fav_bankq'] = DB::table('merchant_bank_accounts')->where('uid',session()->get('userid'))->where('is_fav',1)->where('is_deleted',0)->orderby('id','DESC')->where('gatway_type',$active_payout)->paginate(5);
        $data['userdata'] = userdataq();
        $data['bank_list']  = DB::table('bank_data')->get();
        $data['q'] = DB::table('payout')->where('uid',session()->get('userid'))->orderby('id','DESC')->paginate(30);
        return view('backend.shop.add_account',$data);
    }
    public function add_account_form(Request $req)
    {
        $payout_type = get_payout_type();
        $is_check_varify = "";
        if(isset($req->verify_accoun_checkbox)){
            $is_check_varify = 1;
        }
        if($is_check_varify == 1){
            if(bank_account_addfees() > get_wallet_bal_byid(session()->get('userid'))){
                return redirect('add_account')->with('error','Insufficient balance');
                die();
            }
        }
        if($req->confirm_account_number == $req->account_number){
            if($payout_type == 2){
            $success_msg = array();
            if($is_check_varify != 1){
                $success_msg['success'] = "Bank account added successfully";
            }
            $permitted_chars = 'ABCDEFGHIJKLMNOPQRST0123456789abcdefghijklmnopqrstuvwxyz';
            $ran_id = rand(10000,99999);
            $beneId = substr(str_shuffle($permitted_chars), 0, 15).time();
            $check_im_alredy_register = DB::table('merchant_bank_accounts')->where('is_deleted',0)->where('uid',session()->get('userid'))->where('account_number',$req->account_number)->where('gatway_type',$payout_type)->first();
            if(!empty($check_im_alredy_register)){
                return redirect('add_account')->with('error',"Your payee alredy registered");
                die();   
            }
            $check_account = DB::table('merchant_bank_accounts')->where('account_number',$req->account_number)->where('gatway_type',$payout_type)->where('is_deleted',5)->first();
            if(empty($check_account) || $check_account->bank_verify == 0 && $is_check_varify == 1){
                    $data = array();
                    $data['name'] = "HELYI";
                    $data['phone'] = $req->mobile_number;
                    $data['bankAccount'] = $req->account_number;
                    $data['ifsc'] = $req->ifsc;
                    $bankAccount_response = verifyBankAccount($data); 
                    if(!empty($bankAccount_response['error_msg_id'])){
                        return redirect('add_account')->with('error',$bankAccount_response['error_msg_id']);
                        die();
                    }
                    $bank_varify_status = "";
                    $bank_varify_id = "";
                    $bank_varify_uti = "";
                    $varify_user_name = "";
                    $varify_bank_name = "";
                    $bank_account_status = "";
                    $bank_varify_status_type = "";
                    if(!empty($bankAccount_response)){
                        if(!empty($bankAccount_response['status']) && $bankAccount_response['status'] == "SUCCESS"){
                            if($bankAccount_response['data']['accountExists'] == "YES"){
                                if(!empty($bankAccount_response['accountStatus'])){
                                    $bank_varify_status = $bankAccount_response['accountStatus'];
                                }
                                if(!empty($bankAccount_response['data']['refId'])){
                                    $bank_varify_id = $bankAccount_response['data']['refId'];
                                }
                                if(!empty($bankAccount_response['data']['utr'])){
                                    $bank_varify_uti = $bankAccount_response['data']['utr'];
                                }
                                if(!empty($bankAccount_response['data']['nameAtBank'])){
                                    $varify_user_name = $bankAccount_response['data']['nameAtBank'];
                                    session()->put('model_ac_no',$varify_user_name);
                                }
                                if(!empty($bankAccount_response['data']['bankName'])){
                                    $varify_bank_name = $bankAccount_response['data']['bankName'];
                                }
                                if(!empty($bankAccount_response['accountStatus'])){
                                    $bank_account_status = $bankAccount_response['accountStatus'];
                                }
                            }else{
                                return back()->with('error',$bankAccount_response['message']);
                                die();    
                            }
                        }else{
                            return back()->with('error',$bankAccount_response['message']);
                            die();
                        }
                    }
            }else{
                $bank_varify_status = $check_account->bank_varify_status;
                $bank_varify_id = $check_account->bank_varify_id;
                $bank_varify_uti = $check_account->bank_varify_uti;
                $varify_user_name = $check_account->varify_user_name;
                $varify_bank_name = $check_account->varify_bank_name;
                $bank_account_status = $check_account->bank_account_status;
                $bank_varify_status_type = $check_account->bank_varify_status_type;
                // session()->put('model_ac_no',$varify_user_name);
            }
            if(empty($check_account)){
                $data = array();
                $data['beneId'] = $beneId;
                if(!empty($varify_user_name)){
                    $data['name'] = $varify_user_name;
                }else{
                    $data['name'] = $req->name;
                }
                $data['bankAccount'] = $req->account_number;
                $data['ifsc'] = $req->ifsc;
                $data['email'] = "payextent@hely.in";
                $data['phone'] = $req->mobile_number;
                $data['address1'] = "demo address";
                $add_beneficiary_status = addBeneficiary($data);
                if($add_beneficiary_status['status'] == "ERROR"){
                    $data = array();
                    $data['bankAccount'] = $req->account_number;
                    $data['ifsc'] = $req->ifsc;
                    $getbeneficiarydata = getBeneficiarydata($data);
                    if($getbeneficiarydata['status'] == "SUCCESS"){
                        $add_beneficiary = 1;
                        $beneId = $getbeneficiarydata['data']['beneId'];
                    }else{
                        return back()->with('error',$getbeneficiarydata['error_msg']);
                        die();
                    }
                }else{
                    $add_beneficiary = 1;
                }
            }else{
                $add_beneficiary = 1;
                $beneId = $check_account->beneid;
            }
            if($add_beneficiary == 1){
                    $data = array();
                    $data['uid'] = session()->get('userid');
                    $data['name'] = $req->name;
                    $data['nick_name'] = $req->nick_name;
                    $data['mobile_number'] = $req->mobile_number;
                    $data['emailid'] = "payextent@hely.in";
                    $data['address'] = "demo address";
                    $data['account_number'] = $req->account_number;
                    $data['bank_name'] = $req->bank_name;
                    $data['ifsc'] = $req->ifsc;
                    $data['beneid'] = $beneId;
                    $data['mindate'] = date('Ymd');
                    $data['time'] = date('h:i:s a');
                    $data['mintime'] = time();
                    $data['gatway_type'] = 2;
                    if($is_check_varify == 1){
                        $data['bank_varify_status'] = $bank_varify_status;
                        $data['bank_varify_id'] = $bank_varify_id;
                        $data['bank_varify_uti'] = $bank_varify_uti;
                        $data['varify_user_name'] = $varify_user_name;
                        $data['varify_bank_name'] = $varify_bank_name;
                        $data['bank_account_status'] = $bank_account_status;
                        $data['bank_varify_status_type'] = 1;
                        $data['fee_cut'] = bank_account_addfees();
                        $data['bank_verify'] = 1;
                    }
                    $data['is_deleted'] = 0;
                    $last_insert_is = DB::table('merchant_bank_accounts')->insertGetId($data);
                    session()->put('lastinser_id',$last_insert_is);
                    if($is_check_varify == 1){
                        $userq = DB::table('merchant')->where('id',session()->get('userid'))->first();
                        $change = bank_account_addfees();
                        $data = array();
                        $my_wallet = $userq->wallet-$change;
                        $data['wallet'] = $my_wallet;
                        DB::table('merchant')->where('id',$userq->id)->update($data);
                        inset_all_t_log(2,$change,"Bank Account Verification Fees",$userq->id,$my_wallet,"");
                    }
                    return back()->with($success_msg);          
            }else{
                return back()->with('error','Something went wrong');      
                die();
            }
        }
        if($payout_type == 1){
                    $data = array();
                    $data['name'] = $req->name;
                    $data['email'] = "payextent@hely.in";
                    $data['contact'] = $req->mobile_number;
                    $data['type'] = "customer";
                    $response = rezorpay_create_contact($data,'contacts');
                    if(!empty($response['error'])){
                        return back()->with('error',$response['error']['description']);
                        die();
                    }else{
                        $contact_id = $response['id'];
                        $data = array();
                        $data['contact_id'] = $contact_id;
                        $data['account_type'] = "bank_account";
                        $data['bank_account']['name'] = $req->name;
                        $data['bank_account']['ifsc'] = $req->ifsc;
                        $data['bank_account']['account_number'] = $req->account_number;
                        $check_bankadd_status = rezorpay_bankadd($data,'fund_accounts');
                        if(!empty($check_bankadd_status['error'])){
                            return back()->with('error',$check_bankadd_status['error']['description']);
                            die();
                        }else{
                            $bnfid = $check_bankadd_status['id'];
                            $contact_id = $check_bankadd_status['contact_id'];
                            $check_account = DB::table('merchant_bank_accounts')->where('beneid',$bnfid)->first();
                            if(!empty($check_account)){
                                if($check_account->uid == session()->get('userid')){
                                    return back()->with('error','Account alredy registered');
                                    die();
                                }else{
                                    $dobul_check = DB::table('merchant_bank_accounts')->where('beneid',$bnfid)->where('uid',session()->get('userid'))->first();
                                    if(!empty($dobul_check)){
                                        return back()->with('error','Account alredy registered');
                                        die();
                                    }
                                    $bnfid = $check_account->beneid;
                                    $contact_id = $check_account->contact_id;
                                }
                            }
                            $success_msg = array();
                            if($is_check_varify != 1){
                                $success_msg['success'] = "Bank account added successfully";
                            }
                            if($is_check_varify == 1){
                                $my_kye = get_rezorpay_api_kyes();
                                $bank_data = array();
                                $bank_data['account_number'] = $my_kye['account_number'];
                                $bank_data['fund_account']['id'] = $bnfid;
                                $bank_data['amount'] = 100;
                                $bank_data['currency'] = "INR";
                                $bank_validation_check = rezorpay_bank_validation($bank_data,'fund_accounts/validations');
                                $bank_varify_status = "";
                                $bank_varify_id = "";
                                $bank_varify_uti = "";
                                $varify_user_name = "";
                                $varify_bank_name = "";
                                $bank_account_status = "";
                                $bank_varify_status_type = "";
                                if(!empty($bank_validation_check)){
                                    if(!empty($bank_validation_check['error'])){
                                    return back()->with('error',$bank_validation_check['error']['description']);
                                    die();
                                    }
                                    if(!empty($bank_validation_check['status'])){
                                        if($bank_validation_check['status'] == "failed"){
                                            return back()->with('error','Bank Account verification failed');
                                            die();    
                                        }else if($bank_validation_check['status'] == "completed" || $bank_validation_check['status'] == "created"){
                                            $bank_varify_status = $bank_validation_check['status'];
                                            if($bank_varify_status == "completed"){
                                                $bank_varify_status_type = 1;
                                                $add_bank_msg = "Your payee account verified successful";
                                            }
                                            if($bank_varify_status == "created"){
                                                $bank_varify_status_type = 0;
                                            }
                                            if(!empty($bank_validation_check['id'])){
                                                $bank_varify_id = $bank_validation_check['id'];
                                            }
                                            if(!empty($bank_validation_check['utr'])){
                                                $bank_varify_uti = $bank_validation_check['utr'];
                                            }
                                            if(!empty($bank_validation_check['fund_account']['details']['name'])){
                                                $varify_user_name = $bank_validation_check['fund_account']['details']['name'];
                                                session()->put('model_ac_no',$varify_user_name);
                                            }
                                            if(!empty($bank_validation_check['fund_account']['details']['bank_name'])){
                                                $varify_bank_name = $bank_validation_check['fund_account']['details']['bank_name'];
                                            }
                                            if(!empty($bank_validation_check['results']['account_status'])){
                                                $bank_account_status = $bank_validation_check['results']['account_status'];
                                            }
                                        }
                                    }else{
                                        return back()->with('error','Something went wrong please try again');
                                        die();    
                                    }
                                }else{
                                    return back()->with('error','Something went wrong please try again');
                                    die();
                                }
                            }
                            $data = array();
                            $data['uid'] = session()->get('userid');
                            $data['name'] = $req->name;
                            $data['nick_name'] = $req->nick_name;
                            $data['mobile_number'] = $req->mobile_number;
                            $data['emailid'] = "payextent@hely.in";
                            $data['address'] = "demo address";
                            $data['account_number'] = $req->account_number;
                            $data['bank_name'] = $req->bank_name;
                            $data['ifsc'] = $req->ifsc;
                            $data['beneid'] = $bnfid;
                            $data['contact_id'] = $contact_id;
                            $data['gatway_type'] = 1;
                            $data['mindate'] = date('Ymd');
                            $data['time'] = date('h:i:s a');
                            $data['mintime'] = time();
                            if($is_check_varify == 1){
                            $data['bank_varify_status'] = $bank_varify_status;
                            $data['bank_varify_id'] = $bank_varify_id;
                            $data['bank_varify_uti'] = $bank_varify_uti;
                            $data['varify_user_name'] = $varify_user_name;
                            $data['varify_bank_name'] = $varify_bank_name;
                            $data['bank_account_status'] = $bank_account_status;
                            $data['bank_varify_status_type'] = $bank_varify_status_type;
                            $data['fee_cut'] = bank_account_addfees();
                            $data['bank_verify'] = 1;
                            }
                            $data['bank_name'] = $req->bank_name;
                            $data['is_deleted'] = 0;
                            $last_inser_id = DB::table('merchant_bank_accounts')->insertGetId($data);
                            session()->put('lastinser_id',$last_inser_id);
                            if($is_check_varify == 1){
                                $userq = DB::table('merchant')->where('id',session()->get('userid'))->first();
                                $change = bank_account_addfees();
                                $data = array();
                                $my_wallet = $userq->wallet-$change;
                                $data['wallet'] = $my_wallet;
                                DB::table('merchant')->where('id',$userq->id)->update($data);
                                inset_all_t_log(2,$change,"Bank Account Verification Fees",$userq->id,$my_wallet,"");
                            }
                            return back()->with($success_msg);   
                        }
                    }       
        }
        }else{
            return back()->with('error','A/c and confirm A/c should be same');
        }
       
    }
    public function add_varifyed_paye(Request $req)
    {
        session()->forget('model_ac_no');
        session()->forget('lastinser_id');
        DB::table('merchant_bank_accounts')->where('id',$req->get_bank_id)->update(['bank_verify'=>1]);
        return 1;
    }
    public function cancel_add_varifyed_paye(Request $req)
    {
        session()->forget('model_ac_no');
        session()->forget('lastinser_id');
        $payout_type = get_payout_type();
        if($payout_type == 1){
            DB::table('merchant_bank_accounts')->where('id',$req->get_bank_id)->delete();
        }else{
            DB::table('merchant_bank_accounts')->where('id',$req->get_bank_id)->update(['uid'=>null]);
        }
        return 1;
    }
    public function check_bank_transfer_amount(Request $req)
    {
        $amount = $req->tamount;
        $tax = 0;
        $lowrange = DB::table('bankaccount_fees')->orderby('from_price','ASC')->first();
        if($amount >= $lowrange->from_price){
            $bankq = DB::table('bankaccount_fees')->where('from_price','>',$amount)->orderBy('from_price','ASC')->first();
            if(!empty($bankq)){
                $tax = $bankq->tax; 
                if($amount < $bankq->from_price){
                    $bankq = DB::table('bankaccount_fees')->where('from_price','<',$bankq->from_price)->orderBy('from_price','DESC')->first();    
                    if(!empty($bankq)){
                        $tax = $bankq->tax;
                    }
                }
            }else{
                $bankq = DB::table('bankaccount_fees')->orderBy('from_price','DESC')->first();
                $tax = $bankq->tax;
            }
               
        }
        $userq = get_company_all_data_byid(session()->get('userid'));
        $total_amount_check = $amount+$tax;
        if($total_amount_check > $userq->wallet){
            return 1;
        }else{
            return $tax;
        }
    }
    public function money_transfer_form(Request $req)
    {
        session()->forget('model_ac_no');
        $udata = get_company_all_data_byid(session()->get('userid'));
        if($udata->is_send_money == 0){
            return redirect('add_account');
            die();
        }
        $q = DB::table('merchant_bank_accounts')->where('id',$req->bankaccountid)->where('uid',session()->get('userid'))->first();
        if(!empty($q)){
            $data['bankq'] = $q;
            return view('backend.shop.bank_transfer',$data);
        }else{
            return back();
        }
    }
    public function tpin_verify_form(Request $req)
    {
        $q = get_company_all_data_byid(session()->get('userid'));
        // $check = ispayecheck(session()->get('userid'));
        // echo $check;
        // die();
        // if($check > 1){
        //     return 2;
        //     die();
        // }
        if($req->tpin == $q->transactionpin){
            return 1;
        }else{
            return 0;
        }
    }
    public function print_pdf_payout_response($id)
    {
        if(isset($id)){
            $q = DB::table('payout')->where('uid',session()->get('userid'))->where('id',$id)->first();
            if(!empty($q)){
                $data['q'] = $q;
                $data['success'] = "ok";
                return view('backend.shop.print_pdf_payout_response',$data);
            }else{
                return redirect('add_account');    
            }
        }else{
            return redirect('add_account');
        }
    }
    public function print_payout_response($id)
    {
        if(isset($id)){
            $q = DB::table('payout')->where('uid',session()->get('userid'))->where('id',$id)->first();
            if(!empty($q)){
                $data['q'] = $q;
                $data['success'] = "ok";
                return view('backend.shop.print_payout_response',$data);
            }else{
                return redirect('add_account');    
            }
        }else{
            return redirect('add_account');
        }
    }
    public function success_tranfer_page($id)
    {
        if(isset($id)){
            $q = DB::table('payout')->where('uid',session()->get('userid'))->where('id',$id)->first();
            if(!empty($q)){
                $data['q'] = $q;
                $data['success'] = "ok";
                return view('backend.shop.success_tranfer_page',$data);
            }else{
                return redirect('add_account');    
            }
        }else{
            return redirect('add_account');
        }
    }
    public function add_to_favorites_thistory(Request $req)
    {
        $q = DB::table('payout')->where('id',$req->tid)->update(['is_fav'=>1]);
        if($q){
            return 1;
        }
    }
    public function find_bankacount_search(Request $req)
    {
        $active_payout  = get_payout_type();
        $q = DB::table('merchant_bank_accounts')->where('uid',session()->get('userid'))->where('gatway_type',$active_payout);
        if(isset($req->smobile)){
            $q = $q->where('mobile_number','like', '%'.$req->smobile.'%');
        }
        if(isset($req->username)){
            // $q = $q->where('varify_user_name','like', '%'.$req->username.'%');
            $q = $q->where('name','like', '%'.$req->username.'%');
        }
        if(isset($req->anumber)){
            $q = $q->where('account_number','like', '%'.$req->anumber.'%');
        }
        $q = $q->where('is_deleted',0)->paginate(30);
        $data['bankq'] = $q;
        $data['userdata'] = userdataq();
        $data['bank_list']  = DB::table('bank_data')->get();
        $data['q'] = DB::table('payout')->where('uid',session()->get('userid'))->orderby('id','DESC')->where('gatway_type',$active_payout)->paginate(30);
        $data['fav_bankq'] = DB::table('merchant_bank_accounts')->where('uid',session()->get('userid'))->where('is_fav',1)->where('is_deleted',0)->orderby('id','DESC')->where('gatway_type',$active_payout)->paginate(5);
        $data['q'] = DB::table('payout')->where('uid',session()->get('userid'))->orderby('id','DESC')->paginate(30);
        return view('backend.shop.add_account',$data);
    }
    public function money_transfer_form_sub(Request $req)
    {
        $udata = get_company_all_data_byid(session()->get('userid'));
        if($udata->is_send_money == 0){
            return redirect('add_account');
            die();
        }
        $bankq = DB::table('merchant_bank_accounts')->where('id',$req->ac_id)->where('uid',session()->get('userid'))->first();
        if(!empty($bankq)){
            $data = array();
            $data['sender_name'] = $req->sender_name;
            $data['amount'] = $req->amount;
            $data['acno'] = $bankq->account_number;             
            $data['bank_name'] = get_bank_name($bankq->bank_name); 
            $data['bankid'] = $bankq->id; 
            $data['to'] = $bankq->name;
            $data['ifsc'] = $bankq->ifsc;
            $data['type'] =  $req->type;
            $data['fee'] = $req->fee;
            $data['remark'] = $req->remark;
            $data['purpose'] = $req->purpose;
            $data['gatway_type'] = $bankq->gatway_type;
            return view('backend.shop.money_transfer_form_sub',$data);
        }else{
            return back()->with('error','Some things went wrong');
        }
    }
    public function pay_submit_form(Request $req)
    {
        $userdata = get_company_all_data_byid(session()->get('userid'));
        if($userdata->wallet > $req->amount){
        $bankq = DB::table('merchant_bank_accounts')->where('id',$req->bankid)->where('uid',session()->get('userid'))->first();
        $typeis = get_pay_type($req->type);
        if($req->gatway_type == 1){
            $amount_is = $req->amount*100;
            $data = array();
            $payout_keys = get_rezorpay_api_kyes();
            $data['account_number'] = $payout_keys['account_number'];
            $data['fund_account_id'] = $bankq->beneid;
            $data['amount'] = $amount_is;
            $data['currency'] = "INR";
            $data['mode'] = $typeis;
            $data['purpose'] = "payout";
            $data['queue_if_low_balance'] = true;
            $data['notes'] = array(
                'notes_key_1' => 'test api',
            );
            $response = rezorpay_create_paye($data,'payouts');
            if(!empty($response['error']['description'])){
                return redirect('add_account')->with('error',$response['error']['description']);
                die();
            }else{
                $data = array();
                $data['uid'] = session()->get('userid');
                $data['gatway_type'] = $req->gatway_type;
                $data['sender_name'] = $req->sender_name;
                $data['bankid'] = $bankq->id; 
                $data['account_no'] = $bankq->account_number;
                $data['ifsc'] = $bankq->ifsc;
                $data['mindate'] =  date('Ymd');
                $data['date'] = date('d-m-Y');
                $data['time'] = time();
                $data['time_is'] = date('h:i:s a');
                // $all_tranaction_data = getTransferStatus($transfer_details);
                if(!empty($response['reference_id'])){
                    $data['referenceId'] = $response['reference_id'];
                }
                if(!empty($response['utr'])){
                    $data['uti'] = $response['utr'];
                }
                $msgs = "Transfer request pending at the bank.";
                if(!empty($response['status'])){
                    if($response['status'] == "processed"){
                        $data['status'] = 1;
                        $data['status_text'] = "Success";
                        $msgs = "Bank transfer successful";
                    }else{
                        $data['status'] = 0;
                        $data['status_text'] = $response['status'];
                        $data['payee_action_proced'] = 0;
                        $msgs = "Transfer request pending at the bank.";
                    }
                }
                $data['sender_name'] = $req->sender_name;
                $data['amount'] = $req->amount;
                $data['bank_name'] = $req->bank_name;
                $data['tax'] = $req->fee;
                $data['transferid'] = $response['id'];
                $data['type'] = $req->type;
                $data['remark'] = $req->remark;
                $data['purpose'] = $req->purpose;
                $lastinsert_id = DB::table('payout')->insertGetId($data);
                $userq = get_company_all_data_byid(session()->get('userid'));
                $total = $req->amount+$req->fee;
                $wallet = $userq->wallet-$total;
                DB::table('merchant')->where('id',$userq->id)->update(['wallet'=>$wallet]);
                inset_all_t_log(2,$req->amount,"Payout bank transfer",session()->get('userid'),$userq->wallet-$req->amount,$bankq->name);
                inset_all_t_log(2,$req->fee,"Payout bank transfer fee",session()->get('userid'),$wallet,$bankq->name);
                $data = array();
                $data['success'] = $msgs;
                $data['paymentdata'] = $lastinsert_id;
                return redirect('success_tranfer_page/'.$lastinsert_id);
            }
        }
        if($req->gatway_type == 2){
        $tid = "TNFXP".rand(10000,99999).time();
        if(!empty($bankq)){
            $transfer = array(
                'beneId' => $bankq->beneid,
                'amount' => $req->amount,
                'transferId' => $tid,
            );
            $is_success = requestTransfer($transfer);
            if($is_success == 1 || $is_success == 202 || $is_success == 201){
                $data = array();
                $data['uid'] = session()->get('userid');
                $data['sender_name'] = $req->sender_name;
                $data['bankid'] = $bankq->id; 
                $data['account_no'] = $bankq->account_number;
                $data['ifsc'] = $bankq->ifsc;
                $data['mindate'] =  date('Ymd');
                $data['date'] = date('d-m-Y');
                $data['time'] = time();
                $data['time_is'] = date('h:i:s');
                $transfer_details = array(
                    'transferId' => $tid,
                );
                $all_tranaction_data = getTransferStatus($transfer_details);
                if(!empty($all_tranaction_data['data']['transfer']['referenceId'])){
                    $data['referenceId'] = $all_tranaction_data['data']['transfer']['referenceId'];
                }
                if(!empty($all_tranaction_data['data']['transfer']['utr'])){
                    $data['uti'] = $all_tranaction_data['data']['transfer']['utr'];
                }
                if(!empty($all_tranaction_data['data']['transfer']['status'])){
                    $data['status_text'] = $all_tranaction_data['data']['transfer']['status'];
                }
                if(!empty($all_tranaction_data['data']['transfer']['acknowledged'])){
                    $data['status'] = $all_tranaction_data['data']['transfer']['acknowledged'];
                }
                $data['sender_name'] = $req->sender_name;
                $data['amount'] = $req->amount;
                $data['bank_name'] = $req->bank_name;
                $data['tax'] = $req->fee;
                $data['transferid'] = $tid;
                $data['type'] = $req->type;
                $data['remark'] = $req->remark;
                $data['purpose'] = $req->purpose;
                $lastinsert_id = DB::table('payout')->insertGetId($data);
                $userq = get_company_all_data_byid(session()->get('userid'));
                $total = $req->amount+$req->fee;
                $wallet = $userq->wallet-$total;
                DB::table('merchant')->where('id',$userq->id)->update(['wallet'=>$wallet]);
                inset_all_t_log(2,$req->amount,"Payout bank transfer",session()->get('userid'),$userq->wallet-$req->amount,$bankq->name);
                inset_all_t_log(2,$req->fee,"Payout bank transfer fee",session()->get('userid'),$wallet,$bankq->name);
                $msgs = "Transfer request pending at the bank";
                if($is_success == 202){
                    $msgs = "Awaiting confirmation from beneficiary bank.";
                }
                if($is_success == 201){
                    $msgs = "Transfer request pending at the bank.";
                }
                if($is_success == 1){
                    $msgs = "Bank transfer successful";
                }
                $data = array();
                $data['success'] = $msgs;
                $data['paymentdata'] = $lastinsert_id;
                return redirect('success_tranfer_page/'.$lastinsert_id);
            }else{
                return redirect('add_account')->with('error',$is_success);
            }
        }else{
            return redirect('add_account')->with('error','Some things went wrong');
        }      
        }
    }else{
        return redirect('login');
        die();
    }
    }
    public function delete_bankaccount(Request $req)
    {
        DB::table('merchant_bank_accounts')->where('id',$req->deletebankid)->where('uid',session()->get('userid'))->update(['is_deleted'=>1]);
        return back()->with('success','Bank account successfully deleted');    
        // $bankid = $req->deletebankid;
        // $check = DB::table('merchant_bank_accounts')->where('id',$bankid)->where('uid',session()->get('userid'))->first();
        // if(!empty($check)){
        //     $data = array();
        //     $data['beneId'] = $check->beneid;
        //     $delete_status = removeBeneficiary($data);
        //     if($delete_status == 1){
        //         DB::table('merchant_bank_accounts')->where('id',$check->id)->where('uid',session()->get('userid'))->update(['is_deleted'=>1]);
        //         return back()->with('success','Bank account successfully deleted');    
        //     }else{
        //         return back()->with('error',$delete_status);    
        //     }
            
        // }else{
        //     return back()->with('error','Bank Account not found');
        // }
        
    }
    // notification
    public function notification_status_change(Request $req)
    {
        DB::table('funds_transfer_log')->where('received_userid',session()->get('userid'))->where('userid',session()->get('userid'))->update(['is_view'=>1]);
        DB::table('funds_transfer_log')->where('userid',session()->get('userid'))->update(['is_view'=>1]);
        
    }
    function addmoney_cashfree (Request $request){
        $udata = get_company_all_data_byid(session()->get('userid'));
        $user_day_limit = get_plan_day_limit(session()->get('userid'));
        $user_today_total = get_total_today_amount(session()->get('userid'));
        $count_total_for_today = $user_today_total+$request->money;
        $monthy_limit = get_plan_monthy_limit(session()->get('userid'));
        $total_addmoney_monthy = get_total_monthly_amount(session()->get('userid'));
        $total_money_monthy = $total_addmoney_monthy+$request->money;
        if($monthy_limit < $total_money_monthy){
            return back()->with('error','Your monthy limit has been completed');
            die();
        }
        if($user_day_limit < $count_total_for_today){
            return back()->with('error','Your daily limit has been completed');
            die();
        }
        $customerName = $udata->firstname." ".$udata->lastname;
        $customerPhone = $udata->mobile;
        $customerEmail = $udata->email;
        $plandata = get_plan_data($udata->plan_id);
        $payment_method = $request->paymentoption;
        $payment_option = $request->topupmen;
        $amount = $request->money;
        $taxrate = get_tax_value($udata->plan_id,$payment_method,$payment_option);
        $count_total_taxrate = ($taxrate/100)*$amount;
        $count_total_amount = $amount-$count_total_taxrate;
        $gateway_type_check = DB::table('option_wise_payment_getway')->where('option_id',$payment_method)->first();
        $gateway_type = $gateway_type_check->payment_getway_id;
        $ctime = date('Y-m-d H:i:s');
        $permitted_chars = 'ABCDEFGHIJKLMNOPQRST0123456789abcdefghijklmnopqrstuvwxyz';
        $orderid = substr(str_shuffle($permitted_chars), 0, 12).time();
        $user_q = userdataq();
        $keys_q = DB::table('gateway_key')->where('type',$request->payment_gateway_type)->first();
        $method_type = $request->payment_gateway_type;
        if(!empty($keys_q)){
            $appid = $keys_q->appkey;
            $secretKey =  $keys_q->secretkey;
        }else{
            return back();
            die();
        }
        $modename = "";
        if($payment_method == 4 || $payment_method == 10 || $payment_method == 8 || $payment_method == 5 || $payment_method == 6){
            $modename = 'cc';
        }
        if($payment_method == 1){
            $modename = 'dc';
        }
        if($payment_method == 2){
            $modename = 'nb';
        }
        if($payment_method == 3){
            $modename = 'upi';
        }
        if($payment_method == 7){
            $modename = 'wallet';
        }
        if($payment_method == 9){
            $modename = 'ppc';
        }
        $data = array();
        $data['userid'] = $udata->id;
        $data['amount'] = $amount;
        $data['total_amount'] = $count_total_amount;
        $data['balance'] = $udata->wallet+$count_total_amount;
        $data['action'] = "Add";
        $data['bankit_fee'] = $count_total_taxrate;
        $data['time'] = date('h:i:sa');
        $data['date'] = date('Y-m-d');
        $data['min_date'] = date('Ymd');
        $data['view_date'] = date('d-m-Y');
        $data['topuptype'] = $payment_option;
        $data['paymentoption'] = $payment_method;
        $data['payment_id'] = $orderid;
        $data['is_capture'] = 2;
        $data['method_type'] = $request->payment_gateway_type;
        $data['method'] = "Cashfree";
        $data['start_timestamp'] = time() + 900;
        $lastinsertid = DB::table('add_money_log')->insertGetId($data);
        $data = array();
        $data['uid'] = $udata->id;
        $data['lastid'] = $lastinsertid;
        $data['total'] = $count_total_amount;
        $data['amount'] = $amount;
        $data['fee'] = $count_total_taxrate;
        $data['type'] = 1;
        $data['action'] = 1;
        $data['opening_balance'] = $udata->wallet;
        $data['ending_balance'] = $udata->wallet;
        $data['txnid'] = $orderid;
        $data['gateway_type'] = $request->payment_gateway_type;
        $data['txn_status'] = 3;
        $paymentModes = $modename;
        $historyid = insert_history($data);
        $postData = array(
            "appId" => $appid,
            "orderId" => $orderid,
            "orderAmount" => $amount,
            "orderCurrency" => 'INR',
            "orderNote" => 'Wallet',
            "customerName" => $customerName,
            "customerPhone" => $customerPhone,
            "customerEmail" => $customerEmail,
            "returnUrl" => url('return_url'),
            "notifyUrl" => '',
            'secretKey' => $secretKey,
            'paymentModes' => $paymentModes,
        );
        return view('cashfree_confirmation')->with($postData);
    }
    function return_url (Request $request){
        $orderId = $request->orderId;
        $orderAmount = $request->orderAmount;
        $referenceId = $request->referenceId;
        $txStatus = $request->txStatus;
        $paymentMode = $request->paymentMode;
        $txMsg = $request->txMsg;
        $txTime = $request->txTime;
        $signature = $request->signature;
        $secretkey = $this->SECRET_KEY;
        $data = $orderId . $orderAmount . $referenceId . $txStatus . $paymentMode . $txMsg . $txTime;
        $hash_hmac = hash_hmac('sha256', $data, $secretkey, true);
        $computedSignature = base64_encode($hash_hmac);
        if ($signature == $computedSignature) {
            $check_add_money_count = DB::table('add_money_log')->where('payment_id',$orderId)->where('is_capture',2)->count();
            if($check_add_money_count == 1){
            $add_money_data = DB::table('add_money_log')->where('payment_id',$orderId)->where('is_capture',2)->first();
            $udata = get_company_all_data_byid($add_money_data->userid);
            if ($txStatus == 'SUCCESS'){
                $data = array();
                $check_plan_data = DB::table('plans')->where('id',$udata->plan_id)->first();                
                $tzero = $check_plan_data->t0_hours;
                $success = 0;

                $data = array();
                $data['is_capture'] = 1;
                $data['paymentmode'] = $paymentMode;
                if($referenceId){
                    $data['referenceid'] = $referenceId;   
                }
                if($add_money_data->topuptype == 0){
                    $data['is_added'] = 1;
                    $add_array = array();
                    $add_array['txn_id'] = $add_money_data->payment_id;
                    $add_array['amount'] = $add_money_data->total_amount;
                    $add_array['uid'] = $udata->id;
                    $add_array['per_balance'] = $udata->wallet;
                    $add_array['post_balance'] = $udata->wallet+$add_money_data->total_amount;
                    $add_array['type'] = 1;
                    $add_array['error_from'] = 2;
                    insert_wallet_log($add_array);
                    inset_all_t_log(1,$orderAmount,"Add Wallet",$udata->id,$udata->wallet+$add_money_data->amount,"");
                    inset_all_t_log(2,$add_money_data->bankit_fee,"Processing Fee",$udata->id,$udata->wallet+$add_money_data->total_amount,"");
                    bankit_fee_distributed($udata->id,$add_money_data->amount,$add_money_data->id);
                    $u_data = array();
                    $u_data['wallet'] = $udata->wallet+$add_money_data->total_amount;
                    DB::table('merchant')->where('id',$udata->id)->update($u_data);
                }else{
                    $data['is_added'] = 0;
                    inset_all_t_log(1,$orderAmount,"Amount Will Be Credit To Wallet",$udata->id,$udata->wallet,"");
                    bankit_fee_distributed($udata->id,$add_money_data->amount,$add_money_data->id);
                    if($add_money_data->topuptype == 1){
                        $data['timestamp'] = time() + (60 * 60 * 48);
                        // $data['timestamp'] = time();
                    }
                    if($add_money_data->topuptype == 2){
                        $data['timestamp'] = time() + (60 * 60 * 72);
                    }
                    if($add_money_data->topuptype == 3){
                        $data['timestamp'] = time() + (60 * 60 * $tzero);
                    }
                }
                
                DB::table('add_money_log')->where('id',$add_money_data->id)->update($data);
                $data = array();
                $data['ending_balance'] = $udata->wallet+$add_money_data->amount;
                $data['utrid'] = $referenceId;
                $data['addwallet_method'] = $paymentMode;
                $data['txn_status'] = 1;
                $where = array();
                $where['lastid'] = $add_money_data->id;
                $historyid = update_history($data,$where);
                return redirect('payment_sresponse_url/'.$add_money_data->id);
            }else if($txStatus == 'FAILED'){
                $data = array();
                $data['response_msg'] = $txMsg;
                $data['is_added'] = 3;
                $data['is_capture'] = 1;
                DB::table('add_money_log')->where('id',$add_money_data->id)->update($data);
                inset_all_t_log(2,$add_money_data->total_amount,"Payment failed",$udata->id,$udata->wallet,"");
                $data = array();
                $data['ending_balance'] = $udata->wallet;
                $data['utrid'] = $referenceId;
                $data['addwallet_method'] = $paymentMode;
                $data['txn_status'] = 2;
                $where = array();
                $where['lastid'] = $add_money_data->id;
                $historyid = update_history($data,$where);
                return redirect('payment_fresponse_url/'.$add_money_data->id);
            }else{
                $data = array();
                $data['response_msg'] = $txMsg;
                $data['is_capture'] = 2;
                DB::table('add_money_log')->where('id',$add_money_data->id)->update($data);
                inset_all_t_log(2,$add_money_data->total_amount,"Payment failed",$udata->id,$udata->wallet,"");
                $data = array();
                $data['ending_balance'] = $udata->wallet;
                $data['utrid'] = $referenceId;
                $data['addwallet_method'] = $paymentMode;
                $data['txn_status'] = 2;
                $where = array();
                $where['lastid'] = $add_money_data->id;
                $historyid = update_history($data,$where);
                return redirect('payment_fresponse_url/'.$add_money_data->id);
            }
        }else{
            return redirect('addmoney');
        }
        }else{
            return redirect('addmoney');
        }
    }
    public function payment_sresponse_url($id)
    {
        $userdata = DB::table('add_money_log')->where('id',$id)->first();
        // $my_data = DB::table('merchant')->where('id',$userdata->userid)->first();
        // session()->put('userid',1);
        // session()->put('type',1);
        if(!empty($userdata)){
            $msg = $userdata->amount." Added to current wallet";
            return redirect('addmoney')->with('lastpaydata',$id);
        }else{
            return redirect('addmoney');    
        }
    }
    public function payment_fresponse_url($id)
    {
        return redirect('addmoney')->with('lastuid',$id);
    }
    public function payment_with_payu(Request $request)
    {
        $userdata = userdataq();
        $customerName = $userdata->firstname." ".$userdata->lastname;
        $customerPhone = $userdata->mobile;
        $customerEmail = $userdata->email;
        $amount = $request->money;
        // // $now = new DateTime();
        // $ctime = date('Y-m-d H:i:s');

        // $orderId = Order::insertGetId([
        //     'customerName' => $customerName,
        //     'customerPhone' => $customerPhone,
        //     'customerEmail' => $customerEmail,
        //     'amount' => $amount,
        //     'created_at' => $ctime,
        //     'status_id' => 3,
        // ]);

        // $rand = rand(00000,99999);
        // $user_q = userdataq();
        // $secretKey =  $this->SECRET_KEY;
        $userdata = array(
            "orderAmount" => $request->money,
            "customerName" => $customerName,            
            "customerEmail" => $customerEmail,
            "returnUrl" => url('peyu_response'),
        );
        // return view('payuconfirm')->with($postData);
        return view('pay-with-Payumoney')->with($userdata);
    }
    public function peyu_response(Request $req)
    {
        print_r($request->all());
    }
    // tranfer list
    public function transition_view($id)
    {
        $check = DB::table('add_money_log')->where('id',$id)->where('userid',session()->get('userid'))->first();
        $data['t_details'] = $check;
        if(!empty($check)){
            return view('backend.shop.transition_view',$data);
        }else{
            return back();
        }
    }
    public function transaction_history()
    {
        $data['q'] = DB::table('lein_to_wallet_log')->where('uid',session()->get('userid'))->orderBy('id','DESC')->paginate(30);
        return view('backend.shop.transaction_history',$data);
    }
    public function export_transaction_history()
    {
        return Excel::download(new Leinwallettowalletexport, 'alltransaction.csv');
        return back(); 
    }
    public function print_transaction_history()
    {
        $data['q'] = DB::table('lein_to_wallet_log')->where('uid',session()->get('userid'))->orderBy('id','DESC')->get();
        return view('backend.shop.printtransaction_history',$data);
    }
    public function alltransaction()
    {
        $data['q'] = DB::table('all_t_log')->where('uid',session()->get('userid'))->orderBy('id','DESC')->paginate(30);
        return view('backend.shop.alltransaction',$data);
    }
    public function user_alltranaction_search(Request $req)
    {
        $q = DB::table('all_t_log')->where('uid',session()->get('userid'))->orderBy('id','DESC');
        if(isset($req->user_name)){
            $q  = $q->where('user_name', 'like', '%'.$req->user_name.'%');
        }
        if(isset($req->action)){
            $q  = $q->where('r', 'like', '%'.$req->action.'%');
        }
        $q = $q->paginate(30);
        $data['q'] = $q;
        return view('backend.shop.alltransaction',$data);
    }
    public function printalltransaction()
    {
        $data['q'] = DB::table('all_t_log')->where('uid',session()->get('userid'))->orderBy('id','DESC')->get();
        return view('backend.shop.printalltransaction',$data);
    }
    public function export_all_transaction(Type $var = null)
    {
        return Excel::download(new Alltransaction, 'alltransaction.csv');
        return back();
    }
    public function comissionhistory()
    {
        $data['userdata'] = userdataq();
        if(session()->get('type') == 3){
            $data['listq'] = DB::table('distribute_logs')->where('dis_id',session()->get('userid'))->orderBy('id','DESC')->paginate(30);
        }
        if(session()->get('type') == 4){
            $data['listq'] = DB::table('distribute_logs')->where('md_id',session()->get('userid'))->where('master_distributor','!=',NULL)->orderBy('id','DESC')->paginate(30);
        }
        if(session()->get('type') == 1){
            $data['listq'] = array();
        }
        // $data['q'] = DB::table('all_t_log')->where('uid',session()->get('userid'))->whereIn('r',['Cashback','Commission Added'])->orderBy('id','DESC')->paginate(30);
        return view('backend.shop.comissionhistory',$data);
    }
    public function export_comissionhistory()
    {
        return Excel::download(new Allcomissionhistorytransaction, 'alltransaction.csv');
        return back(); 
    }
    public function printcomissionhistory()
    {
        if(session()->get('type') == 3){
            $data['listq'] = DB::table('distribute_logs')->where('dis_id',session()->get('userid'))->orderBy('id','DESC')->get();
        }
        if(session()->get('type') == 4){
            $data['listq'] = DB::table('distribute_logs')->where('md_id',session()->get('userid'))->where('master_distributor','!=',NULL)->orderBy('id','DESC')->get();
        }
        if(session()->get('type') == 1){
            $data['listq'] = array();
        }
        return view('backend.shop.printcomissionhistory',$data);
    }
    public function leinwallettransition()
    {
        $data['q'] = DB::table('lein_to_wallet_log')->where('uid',session()->get('userid'))->orderBy('id','DESC')->get();
        return view('backend.shop.leinwallettransition',$data);
    }
    public function leinwallettransition_date_filter(Request $req)
    {
        // $data['q'] = 
    }
    public function addwallettransition()
    {
        $data['q'] = DB::table('add_money_log')->where('userid',session()->get('userid'))->orderBy('id','DESC')->paginate(30);
        return view('backend.shop.addwallettransition',$data);
    }
    public function printaddwallettransition()
    {
        $data['q'] = DB::table('add_money_log')->where('userid',session()->get('userid'))->orderBy('id','DESC')->get();
        return view('backend.shop.printaddwallettransition',$data);

    }
    public function export_wallet_add_transaction(){
        return Excel::download(new AddwalletExport, 'wallettransaction.csv');
        return back();
    }
    public function addwallettransitionfilter(Request $req)
    {
        $sq = DB::table('add_money_log')->where('userid',session()->get('userid'));
        if(!empty($req->filter_type)){
            if($req->filter_type == 2){
                $today = date('Ymd');
                $last_sev_date = date('Y-m-d', strtotime('-7 days'));
                $last_sev_date_min = date_min($last_sev_date);
                $sq = $sq->whereBetween('min_date',[$last_sev_date_min, $today]);
            }
            if($req->filter_type == 3){
                $fromdate = date('Y-m')."-1";
                $frommin = date_min($fromdate);
                $a_date = date('Y-m-d');
                $todate = date("Y-m-t", strtotime($a_date));
                $tomin = date_min($todate);
                $sq = $sq->whereBetween('min_date',[$frommin, $tomin]);
            }
            if($req->filter_type == 1){
                $today = date('Ymd');
                $sq = $sq->where('min_date',$today);
            }
            if($req->filter_type == 5){
                if(isset($req->order_id_f)){
                    $sq = $sq->where('payment_id', 'like', '%'.$req->order_id_f.'%');
                }else{
                    return redirect('addwallettransition')->with('error','Enter order id');
                    die();
                }
            }
            if($req->filter_type == 6){
                if(isset($req->payment_options)){
                    $sq = $sq->where('paymentoption', $req->payment_options);
                }
                if(isset($req->toup_options)){
                    $sq = $sq->where('topuptype', $req->toup_options);
                }
                if(isset($req->pay_status)){
                    if($req->pay_status == 0){
                        $sq = $sq->where('is_added', 1)->where('is_fail', 0);
                    }else if($req->pay_status == 1){
                        $sq = $sq->where('is_added', 0)->where('is_fail', 0);
                    }else if($req->pay_status == 2){
                        $sq = $sq->where('is_fail', 1);
                    }
                }
            }
            if($req->filter_type == 4){
                if(isset($req->from_date)){
                    if(isset($req->to_date)){
                        $frommin = date_min($req->from_date);
                        $tomin = date_min($req->to_date);
                        $sq = $sq->whereBetween('min_date',[$frommin,$tomin]);
                    }else{
                        return redirect('addwallettransition')->with('error','Select to date');
                        die();
                    }
                }else{
                    return redirect('addwallettransition')->with('error','Select from date');
                    die();
                }
            }
        }
        $sq = $sq->orderBy('id','DESC')->paginate(30);
        $data['q'] = $sq;
        return view('backend.shop.addwallettransition',$data);
    }
    // payout trananstion
    public function payouttransaction()
    {
        $data['q'] = DB::table('payout')->where('uid',session()->get('userid'))->orderby('id','DESC')->paginate(30);
        return view('backend.shop.payouttransaction',$data);
    }
    public function printpayouttransaction()
    {
        $data['q'] = DB::table('payout')->where('uid',session()->get('userid'))->orderby('id','DESC')->get();
        return view('backend.shop.printpayouttransaction',$data);
    }
    public function payoutfilter(Request $req)
    {
        $q = DB::table('payout')->where('uid',session()->get('userid'));
        if($req->filter_type == 1){
            $q = $q->where('mindate',date('Ymd'));
        }
        if($req->filter_type == 2){
            $last_sev_date = date('Ymd', strtotime('-7 days'));
            $q = $q->whereBetween('mindate',[$last_sev_date, date('Ymd')]);
        }
        if($req->filter_type == 3){
            $q = $q->whereBetween('mindate',[date('Ym01'), date('Ymd')]);
        }
        if($req->filter_type == 6){
            if(isset($req->payment_status)){
                $q = $q->where('status',$req->payment_status);
            }
        }
        if($req->filter_type == 4){
            if(isset($req->from_date)){
                if(isset($req->to_date)){
                    $frommin = date_min(dateu($req->from_date));
                    $tomin = date_min(dateu($req->to_date));
                    $q = $q->whereBetween('mindate',[$frommin,$tomin]);
                }
            }
        }
        $q = $q->orderby('id','DESC')->paginate(30);
        $data['q'] = $q;
        return view('backend.shop.payouttransaction',$data);
    }
    public function export_payouttransaction()
    {
        return Excel::download(new Payouttransactionexport, 'payouttransaction.csv');
        return back();
    }
    public function razorpaytransitionhistory()
    {
        $data['title'] = 1;
        $data['q'] = DB::table('add_money_log')->where('userid',session()->get('userid'))->where('method_type',1)->orderBy('id','DESC')->get();
        return view('backend.shop.addwallettransition',$data);
    }
    public function cashfreetransitionhistory()
    {
        $data['title'] = 2;
        $data['q'] = DB::table('add_money_log')->where('userid',session()->get('userid'))->where('method_type',2)->orderBy('id','DESC')->get();
        return view('backend.shop.addwallettransition',$data);
    }
    public function internaltransition()
    {
        $data['q'] = DB::table('funds_transfer_log')->where('userid',session()->get('userid'))->orderBy('id','DESC')->paginate(30);
        return view('backend.shop.internaltransition',$data);
    }
    public function export_internaltransition()
    {
        return Excel::download(new Internaltransitionexport, 'transaction.csv');
        return back(); 
    }
    public function printinternaltransition()
    {
        $data['q'] = DB::table('funds_transfer_log')->where('userid',session()->get('userid'))->orderBy('id','DESC')->get();
        return view('backend.shop.printinternaltransition',$data);
    }
    public function internal_transfer_wallet_check(Request $req)
    {
        $response = "";
        $userq = userdataq();
        if($req->amount > $userq->wallet){
            $response = 0;
        }else{
            $response = 1;
        }
        return $response;
    }
    public function admintransitionhistory()
    {
        $data['q'] = DB::table('admin_add_money')->where('uid',session()->get('userid'))->orderBy('id','DESC')->paginate(30);
        return view('backend.shop.admintransitionhistory',$data);
    }
    public function export_admintransitionhistory()
    {
        return Excel::download(new Admintransitionhistory, 'transaction.csv');
        return back(); 
    }
    public function printadmintransitionhistory()
    {
        $data['q'] = DB::table('admin_add_money')->where('uid',session()->get('userid'))->orderBy('id','DESC')->get();
        return view('backend.shop.printadmintransitionhistory',$data);
    }
    // buy pricing
    public function plan_purchase(Type $var = null)
    {
        return redirect('home');
        die();
        if(check_is_reffer_user(session()->get('userid')) == 1){
            return redirect('utilitiesandpayments');
            die();
        }
        $data['payment_getway'] = DB::table('active_payment_getway')->first();
        $data['q'] = DB::table('plans')->where('is_deleted',0)->get();
        return view('backend.shop.plan_purchase',$data);
    }
    public function rez_plan_purchase(Request $req)
    {
        DB::table('plan_p_log')->where('uid',session()->get('userid'))->update(['is_expire'=>1]);
        $data = array();
            $data['uid'] = session()->get('userid');
            $data['plan_id'] = $req->planid;
            $data['price'] = get_plan_price($req->planid);
            $data['t_id'] = $req->payment_id;
            $data['getway_id'] = 1;
            $data['is_expire'] = 0;
            $data['date'] = date('Y-m-d');
            $data['time'] = date("h:i:sa");
            $data['timestamp'] = time();
            $cdate = date('Y-m-d');
            $ex_date = date('d-m-Y', strtotime($cdate .' +30 day'));
            $data['ex_date'] = get_plan_expiry_time($req->planid);
            DB::table('plan_p_log')->insert($data);
            $plan_price = get_plan_price($req->planid);
            inset_all_t_log(2,$plan_price,"Plan upgrade",session()->get('userid'),"");
            DB::table('merchant')->where('id',session()->get('userid'))->update(['plan_id'=>$req->planid]);
            return 1;
    }
    public function network_upgrade_plan_from_wallet(Request $req)
    {
        $response = "";
        $check_tpin = DB::table('merchant')->where('id',session()->get('userid'))->where('transactionpin',$req->tpin)->first();
        if(empty($check_tpin)){
            $response = 0;
        }else{
            $response = 1;
        }
        return $response;
    }
    public function upgrade_plan_from_wallet(Request $req)
    {
        $response = "";
        $check_tpin = DB::table('merchant')->where('id',session()->get('userid'))->where('transactionpin',$req->tpin)->first();
        if(empty($check_tpin)){
            $response = 0;
        }else{
            DB::table('plan_p_log')->where('uid',session()->get('userid'))->update(['is_expire'=>1]);
        $data = array();
            $data['uid'] = session()->get('userid');
            $data['plan_id'] = $req->planid;
            $data['price'] = get_plan_price($req->planid);
            $data['getway_id'] = 5;
            $data['is_expire'] = 0;
            $data['date'] = date('d-m-Y');
            $data['time'] = date("h:i:s a");
            $data['timestamp'] = time();
            $cdate = date('Y-m-d');
            $ex_date = date('d-m-Y', strtotime($cdate .' +30 day'));
            $data['ex_date'] = get_plan_expiry_time($req->planid);
            DB::table('plan_p_log')->insert($data);
            $data = array();
            $plan_price = get_plan_price($req->planid);
            inset_all_t_log(2,$plan_price,"Plan upgrade",session()->get('userid'),"");
            $data['wallet'] = count_wallet_amount(session()->get('userid'),$plan_price,2);
            $data['plan_id'] = $req->planid;
            DB::table('merchant')->where('id',session()->get('userid'))->update($data);
            $response = 1;
        }
        return $response;
        
    }
    function cashfree_plan_purchase (Request $request){
        // $this->validate($request, [
        //     'customerName' => 'required',
        //     'customerPhone' => 'required',
        //     'customerEmail' => 'required|email',
        //     'amount' => 'required|numeric|between:'.$this->minimumAmount.','.$this->maximumAmount.'',
        // ]);
        $userdata = userdataq();
        $customerName = $userdata->firstname." ".$userdata->lastname;
        $customerPhone = $userdata->mobile;
        $customerEmail = $userdata->email;
        $plan_id = $request->plan_id;
        $amount = get_plan_price($request->plan_id);
        // $now = new DateTime();
        $ctime = date('Y-m-d H:i:s');

        // $orderId = Order::insertGetId([
        //     'customerName' => $customerName,
        //     'customerPhone' => $customerPhone,
        //     'customerEmail' => $customerEmail,
        //     'amount' => $amount,
        //     'created_at' => $ctime,
        //     'status_id' => 3,
        // ]);

        $rand = rand(10000,99999);
        $user_q = userdataq();
        $secretKey =  $this->SECRET_KEY;
        $postData = array(
            "appId" => $this->APP_ID,
            "orderId" => "order_".$rand."_".$user_q->id."_".$plan_id,
            "orderAmount" => $amount,
            "orderCurrency" => 'INR',
            "orderNote" => 'Wallet',
            "customerName" => $customerName,
            "customerPhone" => $customerPhone,
            "customerEmail" => $customerEmail,
            "returnUrl" => url('cashfree_plan_purchase_returnurl'),
            "notifyUrl" => '',
            'secretKey' => $secretKey,
        );
        return view('cashfree_confirmation')->with($postData);
    }
    function cashfree_plan_purchase_returnurl (Request $request){
        // print_r($request->all());
        $orderId = $request->orderId;
        $orderAmount = $request->orderAmount;
        $referenceId = $request->referenceId;
        $txStatus = $request->txStatus;
        $paymentMode = $request->paymentMode;
        $txMsg = $request->txMsg;
        $txTime = $request->txTime;
        $signature = $request->signature;
        $secretkey = $this->SECRET_KEY;
        $data = $orderId . $orderAmount . $referenceId . $txStatus . $paymentMode . $txMsg . $txTime;
        $hash_hmac = hash_hmac('sha256', $data, $secretkey, true);
        $computedSignature = base64_encode($hash_hmac);
        $cash_orderid = $request->orderId;
        $get_userid = explode("_",$cash_orderid);
        $lastid = $get_userid[2];
        $plan_id = $get_userid[3];
        if ($signature == $computedSignature) {
            if ($txStatus == 'SUCCESS'){
                DB::table('plan_p_log')->where('uid',$lastid)->update(['is_expire'=>1]);
                $data = array();
                $data['uid'] = $lastid;
                $data['plan_id'] = $plan_id;
                $data['price'] = $orderAmount;
                $data['t_id'] = $orderId;
                $data['is_expire'] = 0;
                $data['getway_id'] = 2;
                $data['date'] = date('Y-m-d');
                $data['time'] = date("h:i:sa");
                $data['timestamp'] = time();
                $cdate = date('Y-m-d');
                $ex_date = date('d-m-Y', strtotime($cdate .' +30 day'));
                $data['ex_date'] = get_plan_expiry_time($plan_id);
                DB::table('plan_p_log')->insert($data);
                inset_all_t_log(2,$orderAmount,"Plan upgrade",$lastid,"");
                DB::table('merchant')->where('id',$lastid)->update(['plan_id'=>$plan_id]);
                return redirect('plan_success_url/'.$lastid);
            }else{
                return redirect('plan_fail_url/'.$lastid);
            }
        }else{
            return redirect('plan_purchase');
        }
    }
    public function plan_success_url($id)
    {
        return redirect('utilitiesandpayments')->with('s_lastuid',$id);
    }
    public function plan_fail_url($id)
    {
        return redirect('utilitiesandpayments')->with('f_lastuid',$id);
    }
    public function plan_purches_form($id)
    {
        $check = DB::table('plan_p_log')->where('uid',session()->get('userid'))->where('plan_id',$id)->first();
        if(!empty($check)){
            return back()->with('error','Something went wrong');
        }else{
            $data = array();
            $data['uid'] = session()->get('userid');
            $data['plan_id'] = $id;
            $data['date'] = date('Y-m-d');
            $data['time'] = date('Y-m-d');
            $data['ex_date'] = get_plan_expiry_time($id);
            $data['timestamp'] = time();
            DB::table('plan_p_log')->insert($data);
            DB::table('merchant')->where('id',session()->get('userid'))->update(['plan_id'=>$id]);
            return redirect('utilitiesandpayments')->with('success','Plan purchase successful');
        }
        return view('backend.shop.plan_purchase',$data);
    }
    // distributor start
    public function my_network(Type $var = null)
    {
        if(session()->get('type') == 3){
            $userdata = userdataq();
            $my_curent_plan_price = get_plan_price($userdata->plan_id);
            $data['plan'] = DB::table('plans')->where('is_deleted',0)->where('is_active',NULL)->where('price','<=',$my_curent_plan_price)->get();
            $data['qlist'] = DB::table('merchant')->where('refer_uid',session()->get('userid'))->orderBy('id','DESC')->where('is_deleted',0)->paginate(30);
            return view('backend.shop.my_network',$data);
        }
        if(session()->get('type') == 4){
            $userdata = userdataq();
            $my_curent_plan_price = get_plan_price($userdata->plan_id);
            $data['listtype'] = 3;
            $data['plan'] = DB::table('plans')->where('is_deleted',0)->where('is_active',NULL)->where('price','<=',$my_curent_plan_price)->get();
            $data['qlist'] = DB::table('merchant')->where('refer_uid',session()->get('userid'))->where('type',3)->orderBy('id','DESC')->where('is_deleted',0)->paginate(30);
            return view('backend.shop.my_network',$data);
        }
        
    }
    public function searchnetwork(Request $req)
    {
        $final = DB::table('merchant')->where('is_deleted',0);
        if(isset($req->filter_type)){
            if($req->filter_type == 1){
                $final = $final->orderBy('wallet','DESC');
            }else{
                $final = $final->orderBy('id','DESC');
            }
        }
        if(isset($req->username)){
            $final = $final->where('name', 'like', '%'.$req->username.'%');
        }
        if($req->utype == 1){
            if(session()->get('type') == 3){
                $userdata = userdataq();
                $my_curent_plan_price = get_plan_price($userdata->plan_id);
                $data['plan'] = DB::table('plans')->where('is_deleted',0)->where('is_active',NULL)->where('price','<',$my_curent_plan_price)->get();
                $final = $final->where('type',1)->where('refer_uid',session()->get('userid'))->paginate(30);
                $data['qlist'] = $final;
                return view('backend.shop.my_network',$data);
            }
            if(session()->get('type') == 4){
                $userdata = userdataq();
                $my_curent_plan_price = get_plan_price($userdata->plan_id);
                $data['listtype'] = 1;
                $data['plan'] = DB::table('plans')->where('is_deleted',0)->where('is_active',NULL)->where('price','<',$my_curent_plan_price)->get();
                $final = $final->where('refer_uid',session()->get('userid'))->where('type',1)->paginate(30);
                $data['qlist'] = $final;
                return view('backend.shop.my_network',$data);
            }
        }else if($req->utype == 3){
            if(session()->get('type') == 4){
                $userdata = userdataq();
                $my_curent_plan_price = get_plan_price($userdata->plan_id);
                $data['listtype'] = 3;
                $data['plan'] = DB::table('plans')->where('is_deleted',0)->where('is_active',NULL)->where('price','<',$my_curent_plan_price)->get();
                $final = $final->where('refer_uid',session()->get('userid'))->where('type',3)->paginate(30);
                $data['qlist'] = $final;
                return view('backend.shop.my_network',$data);
            }
        }else{
            return back();
        }
    }
    public function merchant_network_list(Type $var = null)
    {
        
        if(session()->get('type') == 4){
            $userdata = userdataq();
            $data['listtype'] = 1;
            $my_curent_plan_price = get_plan_price($userdata->plan_id);
            $data['plan'] = DB::table('plans')->where('is_deleted',0)->where('price','<=',$my_curent_plan_price)->get();
            $data['qlist'] = DB::table('merchant')->where('refer_uid',session()->get('userid'))->where('is_deleted',0)->where('type',1)->orderBy('id','DESC')->paginate(30);
            return view('backend.shop.my_network',$data);
        }
        
    }
    public function credittonetwork(Type $var = null)
    {
        $data['q'] = DB::table('funds_transfer_log')->where('refer_userid',session()->get('userid'))->where('userid',session()->get('userid'))->orderBy('id','DESC')->get();   
        $data['qlist'] = DB::table('merchant')->where('refer_uid',session()->get('userid'))->orderBy('id','DESC')->where('is_deleted',0)->get();
        return view('backend.shop.credittonetwork',$data);
    }
    public function addnewnetwork(Type $var = null)
    {
        $data['stateq'] = DB::table('state')->OrderBy('name','ASC')->get();
        return view('backend.shop.addnewnetwork',$data);
    }    
    public function add_network_form(Request $req)
    {
        $data = array();
        // $plan_id = get_default_plan();
        $data['name'] = $req->firstname." ".$req->lastname;
        if(isset($req->create_by_admin)){
            $data['is_create_admin'] = 1;
        }else{
            $data['refer_uid'] = session()->get('userid');
        }        
        $data['firstname'] = $req->firstname;
        $data['lastname'] = $req->lastname;
        $data['dob'] = $req->dob;
        $data['pass'] = Hash::make($req->pass);
        $data['view_password'] = $req->pass;
        $data['gender'] = $req->gender;
        $data['mobile'] = $req->mobile;
        $data['email'] = $req->email;
        $data['p_address'] = $req->p_address;
        $data['is_otp'] = $req->is_otp;
        $data['shop_name'] = $req->shop_name;
        $data['shop_phone'] = $req->shop_phone;
        $data['business_category'] = $req->business_category;
        $data['shop_number'] = $req->shop_number;
        $data['landmark'] = $req->landmark;
        $data['city'] = $req->city;
        $data['pincode'] = $req->pincode;
        $data['state'] = $req->state;
        $data['geolocation'] = $req->geolocation;
        $data['city_of_operation'] = $req->city_of_operation;
        $data['area_of_operation'] = $req->area_of_operation;
        $data['gst'] = $req->gst;
        $data['fssai'] = $req->fssai;
        $data['loginpin'] = $req->loginpin;
        $data['is_deleted'] = 0;
        $data['is_active'] = 0;
        $data['wallet'] = 0;
        $data['lein_wallet'] = 0;
        $data['is_kyc'] = 0;
        $data['is_instant'] = 0;
        $data['type'] = $req->merchant_type;
        $data['is_kyc_submit'] = 0;
        $data['shop_id'] = get_uniq_id($req->merchant_type);
        $data['id_proof'] = $req->file('id_proof')->store('merchant');
        $data['bank_doc'] = $req->file('bank_doc')->store('merchant');
        $data['signature_doc'] = $req->file('signature_doc')->store('merchant');
        $data['store_logo'] = $req->file('store_logo')->store('merchant');
        $data['store_banner_logo'] = $req->file('store_banner_logo')->store('merchant');
        $data['date'] = date('Y-m-d');
        $data['mindate'] = date('Ymd');
        $data['plan_purches_date'] = date('Y-m-d');
        $data['plan_expiry_date'] = date('Y-m-d');
        $data['show_date'] = date('d-m-Y');
        $lastinsert_id = DB::table('merchant')->insertGetId($data);
        // $data = array();
        // $data['uid'] = $lastinsert_id; 
        // $data['plan_id'] = $plan_id; 
        // $data['date'] = date('Y-m-d'); 
        // $data['time'] = date('h:i:sa');
        // $data['ex_date'] = date('Y-m-d'); 
        // $data['price'] = get_plan_price($plan_id); 
        // DB::table('plan_p_log')->insert($data);
        $register_user_type = get_user_type($req->merchant_type);
        $data= array();
        $data['user_id'] = $lastinsert_id;
        $data['msg'] = "New sign up from".$register_user_type;
        $data['type'] = 1;
        $data['time'] = time();
        $data['mindate'] = date('Ymd');
        $data['view'] = 0;
        DB::table('admin_notification')->insert($data);
        $data = array();
        $data['not_active'] = 1;
        if(isset($req->create_by_admin)){
            return back()->with('success','User created successfully');        
        }else{
            return back()->with('success','Merchant successfully added to your network please wait for admin approval');        
        }
        
    }
    public function distibutor_funds_transfer_form(Request $req)
    {
        $data = array();
        $userq = DB::table('merchant')->where('id',session()->get('userid'))->first();
        $wallet_amount = $userq->wallet-$req->amount;
        $data['wallet'] = $wallet_amount;
        DB::table('merchant')->where('id',$userq->id)->update($data);
        inset_all_t_log(2,$req->amount,"Fund Transfer",session()->get('userid'),$wallet_amount,get_user_name($sender_user->id));
        $data = array();
        $sender_user = DB::table('merchant')->where('id',$req->suid)->first();
        $total = $sender_user->wallet+$req->amount;
        $data['wallet'] = $total;
        DB::table('merchant')->where('id',$sender_user->id)->update($data);
        inset_all_t_log(1,$req->amount,"Fund Transfer",$sender_user->id,$total,get_user_name(session()->get('userid')));
        $user_role = get_user_type($userq->type);
        $msg = $req->amount." received from ".$user_role;
        $data = array();
        $data['time'] = time();
        $data['date'] = date('Ymd');
        $data['uid'] = $sender_user->id;
        $data['remark'] = $msg;
        $data['view'] = 0;
        $data['type'] = 1;
        $data['amount'] = $req->amount;
        DB::table('notification')->insert($data);
        $data = array();
        $data['userid'] = session()->get('userid');
        $data['received_userid'] = $sender_user->id;
        $data['sender_id'] = session()->get('userid');
        $data['amount'] = $req->amount;
        $data['date'] = date('Y-m-d');
        $data['mindate'] = date('Ymd');
        $data['time'] = date('h:i:s a');
        $data['is_view'] = 0;
        $data['type'] = 1;
        $data['refer_userid'] = $userq->id;
        $data['remark'] = $req->remark;
        DB::table('funds_transfer_log')->insert($data);
        $data = array();
        $data['userid'] = $sender_user->id;
        $data['received_userid'] = $sender_user->id;
        $data['sender_id'] = session()->get('userid');
        $data['amount'] = $req->amount;
        $data['date'] = date('Y-m-d');
        $data['mindate'] = date('Ymd');
        $data['time'] = date('h:i:s a');
        $data['is_view'] = 0;
        $data['type'] = 2;
        $data['refer_userid'] = $userq->id;
        $data['remark'] = $req->remark;
        DB::table('funds_transfer_log')->insert($data);
        // $sweet_success = array(
        //     "msg" => "Transaction successful",
        //     "link" => url('internal_transfer'),
        // );
        return redirect('credittonetwork')->with('success','Transaction successful');        
    }
    public function distibutor_change_network_plan_form(Request $req)
    {
        $success = "";
        $get_distibutor_q = userdataq();
        $req_plan_id = $req->value;
        $req_userid = $req->userid;
        $plan_price = get_plan_price($req_plan_id);
        $count_plan_expiry_time = get_plan_expiry_time($req_plan_id);
        $user_wallet = $get_distibutor_q->wallet;
        // $plan_price_cashback = get_plan_cashback($req_plan_id);
        $distibutor_id = session()->get('userid');
        if($user_wallet >= $plan_price){
            DB::table('plan_p_log')->where('uid',$req_userid)->update(['is_expire'=>1]);
            $data = array();
            $data['uid'] = $req_userid;
            $data['plan_id'] = $req_plan_id;
            $data['price'] = $plan_price;
            $data['is_expire'] = 0;
            $data['distibutor_id'] = $distibutor_id;
            $data['date'] = date('Y-m-d');
            $cdate = date('Y-m-d');
            $data['time'] = date("h:i:sa");
            $data['timestamp'] = time();
            $ex_date = date('d-m-Y', strtotime($cdate .' +30 day'));
            $data['ex_date'] = $count_plan_expiry_time;
            DB::table('plan_p_log')->insert($data);
            DB::table('merchant')->where('id',$req_userid)->update(['plan_id'=>$req_plan_id]);
            // $data  = array();
            // $data['distibutor_id'] = $distibutor_id;
            // $data['merchant_id'] = $req_userid;
            // $data['date'] = date('Y-m-d');
            // $data['mindate'] = date('Ymd');
            // $data['timestmp'] = time();
            // $data['plan_id'] = $req_plan_id;
            // $data['Plan_price'] = $plan_price;
            // $data['cashback'] = $plan_price_cashback;
            // DB::table('distibutor_update_plan_log')->insert($data);   
            $distibutor_total_wallet = $user_wallet-$plan_price;
            DB::table('merchant')->where('id',$get_distibutor_q->id)->update(['wallet'=>$distibutor_total_wallet]);
            inset_all_t_log(2,$plan_price,"Network Plan Upgrade",$distibutor_id,$user_wallet-$plan_price,"");
            // inset_all_t_log(1,$plan_price_cashback,"Cashback",$distibutor_id,$distibutor_total_wallet);
            $success = 1;
        }else{
            $success = 2;
        }
        return $success;
    }
    public function linkgen()
    {        
        $data['peyment_request_link'] = DB::table('peyment_request_link')->where('uid',session()->get('userid'))->orderBy('id','DESC')->paginate(10);
        return view('backend.shop.linkgen',$data);
    }   
    // public function peyment_setting_list(){
    //     $data['peyment_request_link'] = DB::table('peyment_request_link')->where('uid',session()->get('userid'))->orderBy('id','DESC')->paginate(30);
    //     return view('backend.shop.peyment_setting_list',$data);
    // }
    public function peyment_link_generate(Request $req){
        if(!isset($req->exdate)){
            return back()->with('error','All field are required');
        }
        if(isset($req->minimum_amount)){
            if($req->minimum_amount < 2){
                return back()->with('error','Enter valid minimum amount');
                die();
            }
        }
        $optionname = $req->optionname;
        $topupoption = $req->topupoption;
        $firstname = $req->firstname;
        $timestamp = "";
        if(isset($req->exdate)){
            $timestamp = strtotime($req->exdate);
        }
        $phone = $req->phone;
        $amount = $req->amount;
        $is_partial_payment = 0;
        $accept_partial = false;
        $accept_partial_amount = 0;
        if(isset($req->is_partial_payment) && $amount >= 500){
            $is_partial_payment = 1;
            $accept_partial = true;
            if(isset($req->minimum_amount)){
            $accept_partial_amount = $req->minimum_amount;
            }else{
            $accept_partial_amount = 500;
            }
        }
        $email = $req->email;
        $uid = $req->uid;
        $note = $req->note;
        // limit check
        $monthy_limit = get_plan_monthy_limit($uid);
        $total_addmoney_monthy = get_total_monthly_amount($uid);
        $user_today_total = get_total_today_amount($uid);
        $count_total_for_today = $user_today_total+$amount;
        $total_money_monthy = $total_addmoney_monthy+$amount;
        $user_day_limit = get_plan_day_limit($uid);
        if($monthy_limit < $total_money_monthy){
            return back()->with('error','Your monthy limit has been completed');
            die();
        }
        if($user_day_limit < $count_total_for_today){
            return back()->with('error','Your daily limit has been completed');
            die();
        }
        // $user_curent_plan_id = get_user_curent_planid($uid);
        // $plan_type = get_plan_type($user_curent_plan_id);
        $get_way_name = get_peymentgetway_name($optionname);
        // $instanttax = get_instant_tax_of_p_options($optionname);
        // $tax = count_total_tax($uid,$amount,$instanttax);
        // $total = count_total_after_tax($uid,$amount,$instanttax);
        $rezorpay_key_q = DB::table('gateway_key')->where('type',1)->first();
        $rez_key = get_rez_key();
        $rez_sec_key = get_rez_sec_key();
        if($get_way_name==1){
            $order_id = get_uniq_order_id();
            $api = new Api($rezorpay_key_q->appkey,$rezorpay_key_q->secretkey);
            $data = $api->paymentLink->create(array('amount'=>$amount*100, 'currency'=>'INR', 'accept_partial'=>$accept_partial,
            'first_min_partial_amount'=>$accept_partial_amount*100,'expire_by' => $timestamp , 'description' => $note,'customer' => array('name'=>$firstname,
            'email' =>$email, 'contact'=>'+91'.$phone),  'notify'=>array('sms'=>true, 'email'=>true) ,
            'reminder_enable'=>true ,'notes'=>array('policy_name'=> 'heyli'),'callback_url' => url('epos_rezorpay'),
            'callback_method'=>'get'));
            $link = $data->short_url;
            $rez_order_id = $data->id;
            $datas = array();
            $datas['link'] = $link;
            $datas['rez_order_id'] = $rez_order_id;
            $datas['amount'] = $amount;
            $datas['name'] = $firstname;
            // $datas['plan_type'] = $plan_type;
            $datas['uid'] = $uid;
            $datas['due'] = $amount;
            $datas['timestamp'] = $timestamp;
            // $datas['tax'] = $tax;
            $datas['gateway'] = 1;
            $datas['total'] = $amount;
            $datas['is_link_partial'] = $is_partial_payment;
            $datas['pey_option'] = $optionname;
            $datas['topup_option'] = $topupoption;
            $datas['phone'] = $phone;
            $datas['email'] = $email;
            $datas['note'] = $note;
            $datas['datemin'] = date('Ymd');
            $datas['order_id_rand'] = $order_id;
            $last_insert_id = DB::table('peyment_request_link')->insertGetId($datas);
            return redirect('epos_singal_data/'.$last_insert_id)->with('message', 'Link Generate Successfully');    
        }else if($get_way_name == 2 || $get_way_name == 3){
            $order = new Order(); 
            $order_id = get_uniq_order_id();
            $od["orderId"] = $order_id;
            $od["orderAmount"] = $amount;
            $od["orderNote"] = $note;
            $od["customerPhone"] = $phone;
            $od["customerName"] = $firstname;
            $od["customerEmail"] = $email;           
            $od["linkpartialPayments"] = true;
            $od["linkminimumpartialAmount"] = 10;
            $od["send_sms"] = true;
            $od["returnUrl"] = url('epos_cashfree');
            $od["notifyUrl"] = "";
            $order->create($od);
            $link = $order->getLink($od['orderId']);                         
            $data = array();         
            $data['link'] = $link->paymentLink;
            $data['amount'] = $amount;
            // $data['plan_type'] = $plan_type;
            // $data['tax'] = $tax;
            $data['gateway'] = $get_way_name;
            $data['uid'] = $uid;
            $data['due'] = $amount;
            $data['timestamp'] = $timestamp;
            $data['total'] = $amount;
            $data['is_link_partial'] = $is_partial_payment;
            $data['topup_option'] = $topupoption;
            $data['datemin'] = date('Ymd');
            $data['name'] = $firstname;
            $data['pey_option'] = $optionname;
            $data['phone'] = $phone;
            $data['email'] = $email;
            $data['note'] = $note;
            $data['order_id_rand'] = $order_id;
            $last_insert_id = DB::table('peyment_request_link')->insertGetId($data);
            return redirect('epos_singal_data/'.$last_insert_id)->with('message', 'Link Generate Successfully');              
        }else{
            return back()->with('error','Sorry somthing went wrong');
        }
    }  
    public function epos_rezorpay(Request $req)
    {
        // $req->razorpay_payment_link_id
        // $req->razorpay_payment_link_status
        // paid
        // partially_paid
        $rezorpay_key_q = DB::table('gateway_key')->where('type',1)->first();
        $paymentid = $req->razorpay_payment_link_id;
        $api = new Api($rezorpay_key_q->appkey, $rezorpay_key_q->secretkey);
        $payment_data = $api->payment->fetch($req->razorpay_payment_id);
        if($payment_data['status']){
            if($payment_data['status'] == 'captured'){
                $is_capture = 1;
            }else{
                $is_capture = 2;
            }
        }
        // important code
        $get_data = DB::table('peyment_request_link')->where('rez_order_id',$paymentid)->first();
        $p_amount = ($payment_data->amount/100);
        $userq = DB::table('merchant')->where('id',$get_data->uid)->first(); 
        $plan_query = DB::table('plans')->where('id',$userq->plan_id)->first();                
        $tzero = $plan_query->t0_hours;
        // calculate tax
        $count_tax_rate = get_tax_value($userq->plan_id,$get_data->pey_option,$get_data->topup_option);
        $count_taxable_amount = count_total_tax($get_data->uid,$p_amount,$count_tax_rate);
        $total_amount_after_taxs = $p_amount-$count_taxable_amount;
        $user_total_count = $userq->lein_wallet+$total_amount_after_taxs;
        // end
        if($req->razorpay_payment_link_status == "partially_paid"){
                    if($get_data->is_partial_payment == 1){
                        $due = $get_data->due-$p_amount;
                    }else{
                        $due = $get_data->total-$p_amount;
                    }
                    $data = array();
                    $data['userid'] = $get_data->uid;
                    $data['amount'] = $p_amount;
                    $data['total_amount'] = $total_amount_after_taxs;
                    $data['balance'] = $user_total_count;
                    $data['action'] = "Add";
                    $data['bankit_fee'] = $count_taxable_amount;
                    $data['time'] = date('h:i:sa');
                    $data['date'] = date('Y-m-d');
                    $data['min_date'] = date('Ymd');
                    $data['view_date'] = date('d-m-Y');
                    $data['method'] = "Rezorpay";
                    $data['method_type'] = 1;
                    $data['topuptype'] = $get_data->topup_option;
                    $data['paymentoption'] = $get_data->pey_option;
                    $data['is_partially_paid'] = 1;
                    if($get_data->topup_option == 0){
                        $data['is_added'] = 1;
                    }else{
                        $data['is_added'] = 0;
                        $data['is_lein_wallet'] = 1;
                    }
                    if($get_data->topup_option == 1){
                        $data['timestamp'] = time() + (60 * 60 * 48);
                    }
                    if($get_data->topup_option == 2){
                        $data['timestamp'] = time() + (60 * 60 * 72);
                    }
                    if($get_data->topup_option == 3){
                        $data['timestamp'] = time() + (60 * 60 * $tzero);
                    }
                    $data['payment_id'] = $req->razorpay_payment_id;
                    $data['orderid'] = $get_data->order_id_rand;
                    $data['is_epos'] = 1;
                    $data['is_capture'] = $is_capture;
                    $lastinsertid = DB::table('add_money_log')->insertGetId($data);
                    $data = array();
                    $data['payment_id'] = $get_data->rez_order_id;
                    $data['total_paymant'] = $p_amount;
                    $data['paid_amount'] = $total_amount_after_taxs;
                    $data['tax'] = $count_taxable_amount;
                    $data['total_amount'] = $get_data->total;
                    $data['add_money_log_id'] = $lastinsertid;
                    $data['mindate'] = date('Ymd');
                    $data['due'] = $due;
                    $data['is_complete'] = 0;
                    DB::table('partially_paid_log')->insert($data);
                    bankit_fee_distributed($get_data->uid,$p_amount,$lastinsertid);
                        $data = array();
                        $userwalletnow = $userq->lein_wallet+$total_amount_after_taxs;
                        if($get_data->topup_option == 0){
                            $add_array = array();
                            $add_array['txn_id'] = $req->razorpay_payment_id;
                            $add_array['amount'] = $total_amount_after_taxs;
                            $add_array['uid'] = $get_data->uid;
                            $add_array['per_balance'] = $userq->lein_wallet;
                            $add_array['post_balance'] = $userwalletnow;
                            $add_array['type'] = 2;
                            insert_wallet_log($add_array);
                            $data['lein_wallet'] = $userwalletnow;
                            DB::table('merchant')->where('id',$get_data->uid)->update($data);
                        }
                        $data = array();
                        $data['uid'] = $get_data->uid;
                        $data['ammount'] = $total_amount_after_taxs;
                        $data['date'] = date('Y-m-d');
                        $data['mindate'] = date('Ymd');
                        $data['time'] = date("h:i:s a");
                        $data['remark'] = "Partial Add Money";
                        $data['bal'] = $userq->lein_wallet+$p_amount;
                        DB::table('lein_to_wallet_log')->insert($data);
                        $data = array();
                        $data['uid'] = $get_data->uid;
                        $data['ammount'] = $count_taxable_amount;
                        $data['date'] = date('Y-m-d');
                        $data['mindate'] = date('Ymd');
                        $data['time'] = date("h:i:s a");
                        $data['remark'] = "Processing Fee";
                        $data['type'] = 1;
                        $data['bal'] = $userwalletnow;
                        DB::table('lein_to_wallet_log')->insert($data);
                        DB::table('peyment_request_link')->where('rez_order_id',$paymentid)->update(['due'=>$due,'is_partial_payment'=>1]);
                        $tax_amount_log = $userwalletnow;
                        $total_amount_log = $userq->lein_wallet+$p_amount;
                        inset_all_t_log(1,$p_amount,"EPOS Added Main Wallet",$get_data->uid,$total_amount_log,"");    
                        inset_all_t_log(2,$count_taxable_amount,"Processing Fee",$get_data->uid,$tax_amount_log,"");
                    return redirect('linkgen')->with('success','Payment Successfull');
        }
        if($req->razorpay_payment_link_status == "paid"){
            if($get_data->is_partial_payment == 1){
                    $due = $get_data->due-$p_amount;
                    $data = array();
                    $data['userid'] = $get_data->uid;
                    $data['amount'] = $p_amount;
                    $data['total_amount'] = $total_amount_after_taxs;
                    $data['balance'] = $user_total_count;
                    $data['action'] = "Add";
                    $data['bankit_fee'] = $count_taxable_amount;
                    $data['time'] = date('h:i:sa');
                    $data['date'] = date('Y-m-d');
                    $data['min_date'] = date('Ymd');
                    $data['view_date'] = date('d-m-Y');
                    $data['method'] = "Rezorpay";
                    $data['method_type'] = 1;
                    $data['topuptype'] = $get_data->topup_option;
                    $data['paymentoption'] = $get_data->pey_option;
                    $data['is_partially_paid'] = 1;
                    if($get_data->topup_option == 0){
                        $data['is_added'] = 1;
                    }else{
                        $data['is_added'] = 0;
                        $data['is_lein_wallet'] = 1;
                    }
                    if($get_data->topup_option == 1){
                        $data['timestamp'] = time() + (60 * 60 * 48);
                    }
                    if($get_data->topup_option == 2){
                        $data['timestamp'] = time() + (60 * 60 * 72);
                    }
                    if($get_data->topup_option == 3){
                        $data['timestamp'] = time() + (60 * 60 * $tzero);
                    }
                    $data['payment_id'] = $req->razorpay_payment_id;
                    $data['orderid'] = $get_data->order_id_rand;
                    $data['is_epos'] = 1;
                    $data['is_capture'] = $is_capture;
                    $lastinsertid = DB::table('add_money_log')->insertGetId($data);
                    $data = array();
                    $data['payment_id'] = $get_data->rez_order_id;
                    $data['total_paymant'] = $p_amount;
                    $data['paid_amount'] = $total_amount_after_taxs;
                    $data['tax'] = $count_taxable_amount;
                    $data['total_amount'] = $get_data->total;
                    $data['add_money_log_id'] = $lastinsertid;
                    $data['mindate'] = date('Ymd');
                    $data['due'] = $due;
                    $data['is_complete'] = 0;
                    DB::table('partially_paid_log')->insert($data);
                    bankit_fee_distributed($get_data->uid,$p_amount,$lastinsertid);
                        $data = array();
                        $userwalletnow = $userq->lein_wallet+$total_amount_after_taxs;
                        if($get_data->topup_option == 0){
                            $add_array = array();
                            $add_array['txn_id'] = $req->razorpay_payment_id;
                            $add_array['amount'] = $total_amount_after_taxs;
                            $add_array['uid'] = $get_data->uid;
                            $add_array['per_balance'] = $userq->lein_wallet;
                            $add_array['post_balance'] = $userwalletnow;
                            $add_array['type'] = 2;
                            insert_wallet_log($add_array);
                            $data['lein_wallet'] = $userwalletnow;
                            DB::table('merchant')->where('id',$get_data->uid)->update($data);
                        }
                        $data = array();
                        $data['uid'] = $get_data->uid;
                        $data['ammount'] = $total_amount_after_taxs;
                        $data['date'] = date('Y-m-d');
                        $data['mindate'] = date('Ymd');
                        $data['time'] = date("h:i:s a");
                        $data['remark'] = "Partial Add Money";
                        $data['bal'] = $userq->lein_wallet+$p_amount;
                        DB::table('lein_to_wallet_log')->insert($data);
                        $data = array();
                        $data['uid'] = $get_data->uid;
                        $data['ammount'] = $count_taxable_amount;
                        $data['date'] = date('Y-m-d');
                        $data['mindate'] = date('Ymd');
                        $data['time'] = date("h:i:s a");
                        $data['remark'] = "Processing Fee";
                        $data['type'] = 1;
                        $data['bal'] = $userwalletnow;
                        DB::table('lein_to_wallet_log')->insert($data);
                        DB::table('peyment_request_link')->where('rez_order_id',$paymentid)->update(['due'=>$due,'is_partial_payment'=>1]);
                        $tax_amount_log = $userwalletnow;
                        $total_amount_log = $userq->lein_wallet+$p_amount;
                        inset_all_t_log(1,$p_amount,"EPOS Added Wallet",$get_data->uid,$total_amount_log,"");    
                        inset_all_t_log(2,$count_taxable_amount,"Processing Fee",$get_data->uid,$tax_amount_log,"");
                        DB::table('partially_paid_log')->where('payment_id',$get_data->rez_order_id)->update(['is_complete'=>1]);
                        $total_hold_amount = DB::table('partially_paid_log')->where('payment_id',$get_data->rez_order_id)->where('is_complete',1)->sum('paid_amount');
                        $curent_user_q = DB::table('merchant')->where('id',$userq->id)->first();
                        $curent_wallet = $curent_user_q->wallet+$total_hold_amount;
                        $curent_lein_wallet = $curent_user_q->lein_wallet-$total_hold_amount;
                        $data = array();
                        $data['wallet'] = $curent_wallet;
                        $data['lein_wallet'] = $curent_lein_wallet;
                        $add_array = array();
                        $add_array['txn_id'] = $req->razorpay_payment_id;
                        $add_array['amount'] = $total_hold_amount;
                        $add_array['uid'] = $curent_user_q->id;
                        $add_array['per_balance'] = $curent_user_q->wallet;
                        $add_array['post_balance'] = $curent_wallet;
                        $add_array['type'] = 1;
                        insert_wallet_log($add_array);
                        DB::table('merchant')->where('id',$curent_user_q->id)->update($data);
                        $data = array();
                        $data['uid'] = $get_data->uid;
                        $data['ammount'] = $total_hold_amount;
                        $data['date'] = date('Y-m-d');
                        $data['mindate'] = date('Ymd');
                        $data['time'] = date("h:i:s a");
                        $data['remark'] = "Epos Added To Main Wallet";
                        $data['type'] = 1;
                        $data['bal'] = $curent_lein_wallet;
                        DB::table('lein_to_wallet_log')->insert($data);
                        inset_all_t_log(2,$total_hold_amount,"Epos lein to main wallet",$userq->id,$curent_lein_wallet,"");
                        inset_all_t_log(1,$total_hold_amount,"Epos Amount Added To Main Wallet",$userq->id,$curent_wallet,"");
                    }else{
                        $user_total_count = $userq->wallet+$p_amount;
                        $data['userid'] = $get_data->uid;
                        $data['amount'] = $p_amount;
                        $data['total_amount'] = $total_amount_after_taxs;
                        $data['balance'] = $user_total_count;
                        $data['action'] = "Add";
                        $data['bankit_fee'] = $count_taxable_amount;
                        $data['time'] = date('h:i:sa');
                        $data['date'] = date('Y-m-d');
                        $data['min_date'] = date('Ymd');
                        $data['view_date'] = date('d-m-Y');
                        $data['method'] = "Rezorpay";
                        $data['method_type'] = 1;
                        $data['topuptype'] = $get_data->topup_option;
                        $data['paymentoption'] = $get_data->pey_option;
                        if($get_data->topup_option == 0){
                            $data['is_added'] = 1;
                        }else{
                            $data['is_added'] = 0;
                            $data['is_lein_wallet'] = 0;
                        }
                        if($get_data->topup_option == 1){
                            $data['timestamp'] = time() + (60 * 60 * 48);
                        }
                        if($get_data->topup_option == 2){
                            $data['timestamp'] = time() + (60 * 60 * 72);
                        }
                        if($get_data->topup_option == 3){
                            $data['timestamp'] = time() + (60 * 60 * $tzero);
                        }
                        $data['payment_id'] = $req->razorpay_payment_id;
                        $data['orderid'] = $get_data->order_id_rand;
                        $data['is_epos'] = 1;
                        $data['is_capture'] = $is_capture;
                        $lastinsertid = DB::table('add_money_log')->insertGetId($data);
                        bankit_fee_distributed($get_data->uid,$p_amount,$lastinsertid);
                        $data = array();
                        $userwalletnow = $userq->wallet+$total_amount_after_taxs;
                        if($get_data->topup_option == 0){
                            $add_array = array();
                            $add_array['txn_id'] = $req->razorpay_payment_id;
                            $add_array['amount'] = $total_amount_after_taxs;
                            $add_array['uid'] = $get_data->uid;
                            $add_array['per_balance'] = $userq->wallet;
                            $add_array['post_balance'] = $total_amount_after_taxs;
                            $add_array['type'] = 1;
                            insert_wallet_log($add_array);
                            $data['wallet'] = $userwalletnow;
                            DB::table('merchant')->where('id',$get_data->uid)->update($data);
                        }
                        $tax_amount_log = $userwalletnow;
                        $total_amount_log = $userq->wallet+$p_amount;
                        inset_all_t_log(1,$p_amount,"EPOS Added Main Wallet",$get_data->uid,$total_amount_log,"");    
                        inset_all_t_log(2,$count_taxable_amount,"Processing Fee",$get_data->uid,$tax_amount_log,"");
                    }
                    return redirect('linkgen')->with('success','Payment Successfull');
        }

    }
    function epos_cashfree (Request $request){
        $orderId = $request->orderId;
        $orderAmount = $request->orderAmount;
        $referenceId = $request->referenceId;
        $txStatus = $request->txStatus;
        $paymentMode = $request->paymentMode;
        $txMsg = $request->txMsg;
        $txTime = $request->txTime;
        $signature = $request->signature;
        $secretkey = $this->SECRET_KEY;
        $data = $orderId . $orderAmount . $referenceId . $txStatus . $paymentMode . $txMsg . $txTime;
        $hash_hmac = hash_hmac('sha256', $data, $secretkey, true);
        $computedSignature = base64_encode($hash_hmac);
        if ($signature == $computedSignature) {
            // Important
            $get_data = DB::table('peyment_request_link')->where('order_id_rand',$orderId)->first();
            $p_amount = $orderAmount;
            $userq = DB::table('merchant')->where('id',$get_data->uid)->first(); 
            $plan_query = DB::table('plans')->where('id',$userq->plan_id)->first();                
            $tzero = $plan_query->t0_hours;
            // calculate tax
            $count_tax_rate = get_tax_value($userq->plan_id,$get_data->pey_option,$get_data->topup_option);
            $count_taxable_amount = count_total_tax($get_data->uid,$p_amount,$count_tax_rate);
            $total_amount_after_taxs = $p_amount-$count_taxable_amount;
            $user_total_count = $userq->lein_wallet+$total_amount_after_taxs;
            // end
            if ($txStatus == 'SUCCESS'){
                    $check = DB::table('add_money_log')->where('payment_id',$orderId)->count();
                    if($check > 0){
                        return redirect('login');
                        die();
                    }
                    $user_total_count = $userq->wallet+$p_amount;
                        $data = array();
                        $data['userid'] = $get_data->uid;
                        $data['amount'] = $p_amount;
                        $data['total_amount'] = $total_amount_after_taxs;
                        $data['balance'] = $user_total_count;
                        $data['action'] = "Add";
                        $data['bankit_fee'] = $count_taxable_amount;
                        $data['time'] = date('h:i:sa');
                        $data['date'] = date('Y-m-d');
                        $data['min_date'] = date('Ymd');
                        $data['view_date'] = date('d-m-Y');
                        $data['method'] = "Cash free";
                        $data['method_type'] = 2;
                        $data['topuptype'] = $get_data->topup_option;
                        $data['paymentoption'] = $get_data->pey_option;
                        if($get_data->topup_option == 0){
                            $data['is_added'] = 1;
                        }else{
                            $data['is_added'] = 0;
                            $data['is_lein_wallet'] = 0;
                        }
                        if($get_data->topup_option == 1){
                            $data['timestamp'] = time() + (60 * 60 * 48);
                        }
                        if($get_data->topup_option == 2){
                            $data['timestamp'] = time() + (60 * 60 * 72);
                        }
                        if($get_data->topup_option == 3){
                            $data['timestamp'] = time() + (60 * 60 * $tzero);
                        }
                        $data['payment_id'] = $get_data->order_id_rand;
                        $data['is_epos'] = 1;
                        $lastinsertid = DB::table('add_money_log')->insertGetId($data);
                        bankit_fee_distributed($get_data->uid,$p_amount,$lastinsertid);
                        $data = array();
                        $userwalletnow = $userq->wallet+$total_amount_after_taxs;
                        if($get_data->topup_option == 0){
                            $add_array = array();
                            $add_array['txn_id'] = $get_data->order_id_rand;
                            $add_array['amount'] = $total_amount_after_taxs;
                            $add_array['uid'] = $get_data->uid;
                            $add_array['per_balance'] = $userq->wallet;
                            $add_array['post_balance'] = $userwalletnow;
                            $add_array['type'] = 1;
                            insert_wallet_log($add_array);
                            $data['wallet'] = $userwalletnow;
                            DB::table('merchant')->where('id',$get_data->uid)->update($data);
                        }
                        $tax_amount_log = $userwalletnow;
                        $total_amount_log = $userq->wallet+$p_amount;
                        inset_all_t_log(1,$p_amount,"EPOS Added Wallet",$get_data->uid,$total_amount_log,"");    
                        inset_all_t_log(2,$count_taxable_amount,"Processing Fee",$get_data->uid,$tax_amount_log,"");
                        return redirect('/')->with('success','Payment success');
                }
                // else{
                //     $data = array();
                //     $get_data = DB::table('peyment_request_link')->where('order_id_rand',$orderId)->first();
                //     $userq = get_company_all_data_byid($get_data->uid);
                //     $user_total_count = $userq->wallet+$get_data->amount;
                //     $data['userid'] = $get_data->uid;
                //     $data['amount'] = $get_data->amount;
                //     $data['total_amount'] = $get_data->total;
                //     $data['balance'] = $userq->wallet+$get_data->amount;
                //     $data['action'] = "Add";
                //     $data['bankit_fee'] = $get_data->tax;
                //     $data['time'] = date('h:i:sa');
                //     $data['date'] = date('Y-m-d');
                //     $data['min_date'] = date('Ymd');
                //     $data['view_date'] = date('d-m-Y');
                //     $data['method'] = "Cash free";
                //     $data['method_type'] = 2;
                //     $data['topuptype'] = $get_data->topup_option;
                //     $data['paymentoption'] = $get_data->pey_option;
                //     $data['is_added'] = 0;
                //     $data['payment_id'] = $get_data->order_id_rand;
                //     $lastinsertid = DB::table('add_money_log')->insertGetId($data);
                //     return redirect('payment_fresponse_url/'.$get_data->uid);
                // }
                }else{
                    return redirect('peyment_setting_list')->with('error','Something went wrong');
                }
    }
    public function epos_singal_data($id)
    {   
        $where = array();
        $where['id'] = $id;
        $data['success_msg'] = "link generated successfully";
        $data['all_data'] = DB::table('peyment_request_link')->where($where)->first();        
        return view('backend.shop.epos_singal_data',$data);       
    }
    // profile
    public function profile(Request $req)
    {
        if($req->userid){
            $check = DB::table('merchant')->where('id',$req->userid)->where('refer_uid',session()->get('userid'))->first();
            if(!empty($check)){
                // $data['tns_q'] = DB::table('all_t_log')->where('uid',session()->get('userid'))->orderBy('id','DESC')->limit(10)->get();
                $data['userq'] = $check;
                $data['c_plan'] = DB::table('plans')->where('id',$data['userq']->plan_id)->first();
                return view('backend.shop.profile',$data);
            }else{
                return back();
            }
        }else{
            $data['tns_q'] = DB::table('all_t_log')->where('uid',session()->get('userid'))->orderBy('id','DESC')->limit(10)->paginate(25);
            $data['userq'] = userdataq();
            $data['c_plan'] = DB::table('plans')->where('id',$data['userq']->plan_id)->first();
            return view('backend.shop.profile',$data);
        }
        
    }
    public function cashbackdistributated_cron()
    {
        DB::table('cc')->insert(['t'=>1]);
        // cashbackdistributated();
    }
    public function on_change_bank(Request $req)
    {
        $retuen = "";
        $q = DB::table('bank_data')->where('id',$req->get_bank_id)->first();
        if(!empty($q)){
           $retuen =  $q->ifsc_code;
        }
        return $retuen;
    }
    public function addwalletcronjob()
    {
        addwalletcronjob();
        tranaction_check_cronjob();
    }
    public function count_notification(Request $req)
    {
        if(!empty(session()->get('userid'))){
            $udata = get_company_all_data_byid(session()->get('userid'));
            if($udata->is_active == 0){
                session()->forget(['userid', 'type']);
                return "error";
                die();
            }else{
                $notification = count_nft(session()->get('userid'));
                return $notification;
            }
        }
    }    
    public function notification_is_view(Request $req)
    {
        DB::table('notification')->where('uid',session()->get('userid'))->update(['view'=>1]);
        return 0;
    }
    public function comingsoon()
    {
        return view('backend.comingsoon');
    }
    // mapping
    public function mapping(Type $var = null)
    {
        if(session()->get('type') != 4){
            $data['q'] = DB::table('mapping')->where('uid',session()->get('userid'))->paginate(15);
            return view('backend.shop.mapping',$data);
        }
    }
    public function mapping_form(Request $req)
    {
        $check = DB::table('merchant')->where('mobile',$req->phone_number)->first();
        if(!empty($check)){
            if(session()->get('type') == 1){
                if($check->type == 3 || $check->type == 4){
                    $data = array();
                    $data['mindate'] = date('Ymd');
                    $data['uid'] = session()->get('userid');
                    $data['refferid'] = $check->id;
                    $data['reason'] = $req->reason;
                    $data['ustatus'] = 0;
                    $data['admin_status'] = 0;
                    DB::table('mapping')->insert($data);
                    return back()->with('success','Request successfull');
                }else{
                    return back()->with('error','Phone number not found');
                }
            }else if(session()->get('type') == 3){
                if($check->type == 4){
                    $data = array();
                    $data['mindate'] = date('Ymd');
                    $data['uid'] = session()->get('userid');
                    $data['refferid'] = $check->id;
                    $data['reason'] = $req->reason;
                    $data['ustatus'] = 0;
                    $data['admin_status'] = 0;
                    DB::table('mapping')->insert($data);
                    return back()->with('success','Request successfull');
                }else{
                    return back()->with('error','Phone number not found');
                }
            }else{
                return view('backend.shop.mapping');
            }
        }else{
            return back()->with('error','Phone number not found');
        }
    }
    public function mapping_request()
    {
        $data['q'] = DB::table('mapping')->where('refferid',session()->get('userid'))->paginate(15);
        return view('backend.shop.mapping_request',$data);
    }
    public function mapping_accept($id)
    {
        $check = DB::table('mapping')->where('id',$id)->where('refferid',session()->get('userid'))->first();
        if(!empty($check)){
            DB::table('mapping')->where('id',$id)->where('refferid',session()->get('userid'))->update(['ustatus'=>1]);
            return back()->with('success','Request accepted');
        }else{
            return back();
        }
    }
    public function mapping_reject($id)
    {
        $check = DB::table('mapping')->where('id',$id)->where('refferid',session()->get('userid'))->first();
        if(!empty($check)){
            DB::table('mapping')->where('id',$id)->where('refferid',session()->get('userid'))->update(['ustatus'=>2]);
            return back()->with('success','Request rejected');
        }else{
            return back();
        }
    }
    public function payystatus_check_cronjob()
    {
        payystatus_check_cronjob();
        bank_acount_varification_status();
    }
    // total_business
    public function total_business()
    {
    $my_user_q = DB::table('merchant')->where('refer_uid',session()->get('userid'))->where('is_deleted',0)->get();
    $userarray = array();
    foreach ($my_user_q as $list) {
        $userarray[] = $list->id;
    }
    $data['wallet_added'] = DB::table('add_money_log')->whereIn('userid',$userarray)->orderBy('id','DESC')->where('is_fail',0)->paginate(10);
    $data['wallet_added_total'] = DB::table('add_money_log')->whereIn('userid',$userarray)->orderBy('id','DESC')->where('is_fail',0)->sum('amount');
    $data['total_payout_done'] = DB::table('payout')->whereIn('uid',$userarray)->orderby('id','DESC')->paginate(10);
    $data['total_payout_done_total'] = DB::table('payout')->whereIn('uid',$userarray)->orderby('id','DESC')->sum('amount');
    $data['total_account_verified'] = DB::table('merchant_bank_accounts')->whereIn('uid',$userarray)->where('bank_verify',1)->orderby('id','DESC')->paginate(10);
    $data['total_account_verified_total'] = DB::table('merchant_bank_accounts')->whereIn('uid',$userarray)->where('bank_verify',1)->orderby('id','DESC')->count();
    return view('backend.shop.total_business',$data);
    }
    public function total_business_filter(Request $req)
    {
    $today = date('Ymd');
    if(isset($req->from_date)){
        $fromdate = date_min(dateu($req->from_date));
    }    
    if(isset($req->to_date)){
        $todate = date_min(dateu($req->to_date));
    }    
    $last_saven = date('Ymd', strtotime('-7 days'));
    $my_user_q = DB::table('merchant')->where('refer_uid',session()->get('userid'))->where('is_deleted',0);
    if(isset($req->user_name)){
        $my_user_q = $my_user_q->where('name','like', '%'.$req->user_name.'%');
    }
    $my_user_q = $my_user_q->get();
    $userarray = array();
    foreach ($my_user_q as $list) {
        $userarray[] = $list->id;
    }
    if($req->filter_type == ""){
        $data['wallet_added'] = DB::table('add_money_log')->whereIn('userid',$userarray)->orderBy('id','DESC')->where('is_fail',0)->paginate(10);
        $data['wallet_added_total'] = DB::table('add_money_log')->whereIn('userid',$userarray)->orderBy('id','DESC')->where('is_fail',0)->sum('amount');
        $data['total_payout_done'] = DB::table('payout')->whereIn('uid',$userarray)->orderby('id','DESC')->paginate(10);
        $data['total_payout_done_total'] = DB::table('payout')->whereIn('uid',$userarray)->orderby('id','DESC')->sum('amount');
        $data['total_account_verified'] = DB::table('merchant_bank_accounts')->whereIn('uid',$userarray)->where('bank_verify',1)->orderby('id','DESC')->paginate(10);
        $data['total_account_verified_total'] = DB::table('merchant_bank_accounts')->whereIn('uid',$userarray)->where('bank_verify',1)->orderby('id','DESC')->count();
    }    
    if($req->filter_type == 1){
            $data['wallet_added'] = DB::table('add_money_log')->where('min_date',$today)->whereIn('userid',$userarray)->orderBy('id','DESC')->where('is_fail',0)->paginate(10);
            $data['wallet_added_total'] = DB::table('add_money_log')->where('min_date',$today)->whereIn('userid',$userarray)->orderBy('id','DESC')->where('is_fail',0)->sum('amount');
            $data['total_payout_done'] = DB::table('payout')->where('mindate',$today)->whereIn('uid',$userarray)->orderby('id','DESC')->paginate(10);
            $data['total_payout_done_total'] = DB::table('payout')->where('mindate',$today)->whereIn('uid',$userarray)->orderby('id','DESC')->sum('amount');
            $data['total_account_verified'] = DB::table('merchant_bank_accounts')->where('mindate',$today)->whereIn('uid',$userarray)->where('bank_verify',1)->orderby('id','DESC')->paginate(10);
            $data['total_account_verified_total'] = DB::table('merchant_bank_accounts')->where('mindate',$today)->whereIn('uid',$userarray)->where('bank_verify',1)->orderby('id','DESC')->count();
        }
        if($req->filter_type == 2){
            $data['wallet_added'] = DB::table('add_money_log')->whereBetween('min_date',[$last_saven,$today])->whereIn('userid',$userarray)->orderBy('id','DESC')->where('is_fail',0)->paginate(10);
            $data['wallet_added_total'] = DB::table('add_money_log')->whereBetween('min_date',[$last_saven,$today])->whereIn('userid',$userarray)->orderBy('id','DESC')->where('is_fail',0)->sum('amount');
            $data['total_payout_done'] = DB::table('payout')->whereBetween('mindate',[$last_saven,$today])->whereIn('uid',$userarray)->orderby('id','DESC')->paginate(10);
            $data['total_payout_done_total'] = DB::table('payout')->whereBetween('mindate',[$last_saven,$today])->whereIn('uid',$userarray)->orderby('id','DESC')->sum('amount');
            $data['total_account_verified'] = DB::table('merchant_bank_accounts')->whereBetween('mindate',[$last_saven,$today])->whereIn('uid',$userarray)->where('bank_verify',1)->orderby('id','DESC')->paginate(10);
            $data['total_account_verified_total'] = DB::table('merchant_bank_accounts')->whereBetween('mindate',[$last_saven,$today])->whereIn('uid',$userarray)->where('bank_verify',1)->orderby('id','DESC')->count();
        }
        if($req->filter_type == 3){
            $data['wallet_added'] = DB::table('add_money_log')->whereBetween('min_date',[date('Ym01'),$today])->whereIn('userid',$userarray)->orderBy('id','DESC')->where('is_fail',0)->paginate(10);
            $data['wallet_added_total'] = DB::table('add_money_log')->whereBetween('min_date',[date('Ym01'),$today])->whereIn('userid',$userarray)->orderBy('id','DESC')->where('is_fail',0)->sum('amount');
            $data['total_payout_done'] = DB::table('payout')->whereBetween('mindate',[date('Ym01'),$today])->whereIn('uid',$userarray)->orderby('id','DESC')->paginate(10);
            $data['total_payout_done_total'] = DB::table('payout')->whereBetween('mindate',[date('Ym01'),$today])->whereIn('uid',$userarray)->orderby('id','DESC')->sum('amount');
            $data['total_account_verified'] = DB::table('merchant_bank_accounts')->whereBetween('mindate',[date('Ym01'),$today])->whereIn('uid',$userarray)->where('bank_verify',1)->orderby('id','DESC')->paginate(10);
            $data['total_account_verified_total'] = DB::table('merchant_bank_accounts')->whereBetween('mindate',[date('Ym01'),$today])->whereIn('uid',$userarray)->where('bank_verify',1)->orderby('id','DESC')->count();
        }
        if($req->filter_type == 4){
            $data['wallet_added'] = DB::table('add_money_log')->whereBetween('min_date',[$fromdate,$todate])->whereIn('userid',$userarray)->orderBy('id','DESC')->where('is_fail',0)->paginate(10);
            $data['wallet_added_total'] = DB::table('add_money_log')->whereBetween('min_date',[$fromdate,$todate])->whereIn('userid',$userarray)->orderBy('id','DESC')->where('is_fail',0)->sum('amount');
            $data['total_payout_done'] = DB::table('payout')->whereBetween('mindate',[$fromdate,$todate])->whereIn('uid',$userarray)->orderby('id','DESC')->paginate(10);
            $data['total_payout_done_total'] = DB::table('payout')->whereBetween('mindate',[$fromdate,$todate])->whereIn('uid',$userarray)->orderby('id','DESC')->sum('amount');
            $data['total_account_verified'] = DB::table('merchant_bank_accounts')->whereBetween('mindate',[$fromdate,$todate])->whereIn('uid',$userarray)->where('bank_verify',1)->orderby('id','DESC')->paginate(10);
            $data['total_account_verified_total'] = DB::table('merchant_bank_accounts')->whereBetween('mindate',[$fromdate,$todate])->whereIn('uid',$userarray)->where('bank_verify',1)->orderby('id','DESC')->count();
        }
        if($req->filter_type == 7){
            $data['wallet_added'] = DB::table('add_money_log')->whereIn('userid',$userarray)->orderBy('amount','DESC')->where('is_fail',0)->paginate(10);
            $data['wallet_added_total'] = DB::table('add_money_log')->whereIn('userid',$userarray)->orderBy('id','DESC')->where('is_fail',0)->sum('amount');
            $data['total_payout_done'] = DB::table('payout')->whereIn('uid',$userarray)->orderby('amount','DESC')->paginate(10);
            $data['total_payout_done_total'] = DB::table('payout')->whereIn('uid',$userarray)->orderby('id','DESC')->sum('amount');
            $data['total_account_verified'] = DB::table('merchant_bank_accounts')->whereIn('uid',$userarray)->where('bank_verify',1)->orderby('id','DESC')->paginate(10);
            $data['total_account_verified_total'] = DB::table('merchant_bank_accounts')->whereIn('uid',$userarray)->where('bank_verify',1)->orderby('id','DESC')->count();
        }
        return view('backend.shop.total_business',$data);
    }
    public function add_fav_account(Request $req)
    {
        if($req->status == 1){
            DB::table('merchant_bank_accounts')->where('id',$req->id)->update(['is_fav'=>1]);
            return 1;   
        }else if($req->status == 2){
            DB::table('merchant_bank_accounts')->where('id',$req->id)->update(['is_fav'=>0]);
            return 2;
        }
    }
    public function constraction()
    {
        return view('constraction');
    }
}
