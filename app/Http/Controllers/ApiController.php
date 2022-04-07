<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use session;
use Hash;
use DB;

class ApiController extends Controller
{
    // Auth Apis
    public function login(Request $req)
    {
        $user = User::where('mobile',$req->Phone_number)->where('is_deleted',0)->first();
        if (!$user || !Hash::check($req->password, $user->pass)){
            return response([
                'message' => ['error']
            ]);
        }
        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response);
    }
    public function login_with_pin(Request $req)
    {
        $user = User::where('mobile',$req->Phone_number)->where('loginpin',$req->loginpin)->where('is_deleted',0)->first();
        if (!$user){
            return response([
                'message' => ['error']
            ]);
        }
        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response);
    }
    public function registration(Request $req)
    {
        $phone_check = DB::table('merchant')->where('mobile',$req->mobile)->count();
        $email_check = DB::table('merchant')->where('email',$req->email)->count();
        $fssai_check = DB::table('merchant')->where('fssai',$req->fssai)->count();
        if($phone_check > 0){
            return "Phone number alredy exists";
            die();
        } 
        if($email_check > 0){
            return "Email id alredy exists";
            die();
        }
        if($fssai_check > 0){
            return "Email id alredy exists";
            die();
        }
        $data = array();
        if(isset($req->uid)){
            $data['refer_uid'] = $req->uid;
        }
        $data['name'] = $req->firstname." ".$req->lastname;
        $data['firstname'] = $req->firstname;
        $data['lastname'] = $req->lastname;
        $data['dob'] = $req->dob;
        $data['pass'] = Hash::make($req->password);
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
        $data['geo_long'] = $req->geo_long;
        $data['geo_lat'] = $req->geo_lat;
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
        $register_user_type = get_user_type($req->merchant_type);
        $data= array();
        $data['user_id'] = $lastinsert_id;
        $data['msg'] = "New sign up from".$register_user_type;
        $data['type'] = 1;
        $data['time'] = time();
        $data['mindate'] = date('Ymd');
        $data['view'] = 0;
        DB::table('admin_notification')->insert($data);
        return $lastinsert_id;
    }
    // Auth Apis end
    // Get user function
    public function get_user_by_number(Request $req)
    {
        $user = User::where('mobile',$req->Phone_number)->where('is_deleted',0)->first();
        if (!$user){
            return response([
                'message' => ['error']
            ]);
        }
        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = [
            'user' => $user,
        ];
        return response($response);
    }
    public function get_kyc_status(Request $req)
    {
        $count = DB::table('merchant')->where('id',$req->uid)->where('is_kyc_submit',1)->first();
        if(!empty($count)){
            if($count->is_kyc == 1){
                return response([
                    'message' => ['approved']
                ]); 
            }else{
                return response([
                    'message' => ['pending']
                ]); 
            }
        }else{
            return response([
                'message' => ['not_submit']
            ]);  
        }
    }
    public function get_user_by_id($uid)
    {
        return DB::table('merchant')->where('id',$uid)->first();
    }
    public function addmoney_tax_rate(Request $req)
    {
        $udata = DB::table('merchant')->where('id',$req->uid)->first();
        $get_tax_value = get_tax_value($udata->plan_id,$req->payment_method,$req->topup_option);
        $gateway_type_check = DB::table('option_wise_payment_getway')->where('option_id',$req->payment_method)->first();
        $data = array();
        $data['tax'] = $get_tax_value;
        if(!empty($gateway_type_check)){
            $data['gateway_type'] = $gateway_type_check->payment_getway_id;
        }
        return $data;
    }
    public function verify_tpin(Request $req)
    {
        $udata = DB::table('merchant')->where('id',$req->uid)->first();
        if(!empty($udata->transactionpin)){ 
            if($udata->transactionpin == $req->tpin){
                return 1; 
            }else{
                return 2; 
            }
        }else{
            return 0;
        }
    }
    public function user_plan_details(Request $req)
    {
        $udata = get_company_all_data_byid($req->uid);
        $plan_details = DB::table('plans')->where('id',$udata->plan_id)->first();
        return $plan_details;
    }
    public function success_payee_data(Request $req)
    {  
        $data = DB::table('payout')->where('id',$req->id)->get();
        return $data;
    }
    public function find_user_bynumber(Request $req)
    {
        $udata = get_company_all_data_byid($req->uid);
        $data = DB::table('merchant')->where('mobile',$req->phone)->where('mobile','!=',$udata->mobile)->first();
        return $data;
    }
    public function verify_bank_api(Request $req)
    {
        if(bank_account_addfees() > get_wallet_bal_byid($req->uid)){
            return "Insufficient balance";
        }else{
            $data = array();
            $data['name'] = "HELYI";
            $data['phone'] = $req->phone;
            $data['bankAccount'] = $req->bankac_no;
            $data['ifsc'] = $req->ifsc;
            $response = verifyBankAccount($data);
            if(!empty($response['error_msg_id'])){
                return $response['error_msg_id'];
                die();
            }else{
                if(!empty($response['status']) && $response['status'] == "SUCCESS"){
                    if($response['data']['accountExists'] == "YES"){

                    }else{
                        return $response['error_msg_id'];
                        die();
                    }
                }
            }
        }
    }
    public function add_payee_form(Request $req)
    {
        $payout_gatway = get_payout_type();
        $is_register = DB::table('merchant_bank_accounts')->where('is_deleted',0)->where('uid',$req->uid)->where('account_number',$req->bankac_no)->where('gatway_type',$payout_gatway)->first();
        if(!empty($is_register)){
            return "Your payee alredy registered";
            die();   
        }else{
            $check_alredy_exist = DB::table('merchant_bank_accounts')->where('account_number',$req->bankac_no)->where('gatway_type',$payout_gatway)->first();
            if(empty($check_alredy_exist)){
                $permitted_chars = 'ABCDEFGHIJKLMNOPQRST0123456789abcdefghijklmnopqrstuvwxyz';
                $beneId = substr(str_shuffle($permitted_chars), 0, 15).time();
                $data = array();
                $data['beneId'] = $beneId;
                $data['name'] = $req->name;
                $data['bankAccount'] = $req->bankac_no;
                $data['ifsc'] = $req->ifsc;
                $data['email'] = "payextent@hely.in";
                $data['phone'] = $req->phone;
                $data['address1'] = "demo address";
                $add_beneficiary_status = addBeneficiary($data);
                $data = array();
                if($add_beneficiary_status['status'] == "ERROR"){
                    $datas = array();
                    $datas['bankAccount'] = $req->bankac_no;
                    $datas['ifsc'] = $req->ifsc;
                    $getbeneficiarydata = getBeneficiarydata($datas);
                    if($getbeneficiarydata['status'] == "SUCCESS"){
                        $beneId = $getbeneficiarydata['data']['beneId'];
                    }else{
                        return $getbeneficiarydata['error_msg'];
                        die();
                    }
                }
            }
            $data = array();
            $data['uid'] = $req->uid;
            $data['name'] = $req->name;
            $data['nick_name'] = $req->nick_name;
            $data['mobile_number'] = $req->phone;
            $data['emailid'] = "payextent@hely.in";
            $data['address'] = "demo address";
            $data['account_number'] = $req->bankac_no;
            $data['bank_name'] = $req->bankid;
            $data['ifsc'] = $req->ifsc;
            $data['beneid'] = $beneId;
            $data['mindate'] = date('Ymd');
            $data['time'] = date('h:i:s a');
            $data['mintime'] = time();
            $data['gatway_type'] = $payout_gatway;
            $data['is_deleted'] = 0;
            if($req->is_verify == 1){
                $data['bank_varify_id'] = $req->varify_id;
                $data['varify_user_name'] = $req->name;
                $data['bank_varify_status_type'] = 1;
                $data['fee_cut'] = bank_account_addfees();
                $data['bank_verify'] = 1;
            }
            $last_insert_is = DB::table('merchant_bank_accounts')->insertGetId($data);
            return $last_insert_is;
        }
    }
    public function user_money_tns_status($uid)
    {
        $udata = get_company_all_data_byid($uid);
        return $udata->is_send_money;
    }
    public function user_active_status($uid)
    {
        $udata = get_company_all_data_byid($uid);
        return $udata->is_active;
    }
    // Get user function end
    // transaction insert
    public function internal_transfer_form(Request $req)
    {
        $udata = get_company_all_data_byid($req->uid);
        $recv_udata = get_company_all_data_byid($req->recv_uid);
        if($req->amount > $udata->wallet){
            return "Insufficient Balance";
            die();
        }
        $data = array();
        $data['wallet'] = $udata->wallet-$req->amount;
        DB::table('merchant')->where('id',$udata->id)->update($data);
        $data = array();
        $data['wallet'] = $recv_udata->wallet+$req->amount;
        DB::table('merchant')->where('id',$recv_udata->id)->update($data);
        $data = array();
        $data['userid'] = $req->uid;
        $data['received_userid'] = $req->recv_uid;
        $data['sender_id'] = $req->uid;
        $data['amount'] = $req->amount;
        $data['date'] = date('d-m-Y');
        $data['mindate'] = date('Ymd');
        $data['time'] = date('h:i:s a');
        $data['is_view'] = 0;
        $data['type'] = 1;
        $data['action_name'] = "Debit";
        $data['viewd_user_name'] = $recv_udata->name;
        $data['viewd_user_shop_name'] = $recv_udata->shop_name;
        $data['viewd_user_shop_phone'] = $recv_udata->mobile;
        $data['remark'] = $req->remark;
        $send_lastid = DB::table('funds_transfer_log')->insertGetId($data);
        inset_all_t_log(2,$req->amount,"Internal Transfer",$req->uid,$udata->wallet-$req->amount,$recv_udata->name);
        $data = array();
        $data['uid'] = $req->uid;
        $data['opening_balance'] = $udata->wallet;
        $data['ending_balance'] = $udata->wallet-$req->amount;
        $data['recv_uid'] = $req->recv_uid;
        $data['recv_obal'] = $recv_udata->wallet;
        $data['recv_cbal'] = $recv_udata->wallet-$req->amount;
        $data['sender_uid'] = $req->uid;
        $data['type'] = 2;
        $data['action'] = 2;
        $data['amount'] = $req->amount;        
        $data['lastid'] = $send_lastid;
        $data['remark'] = $req->remark;
        insert_history($data);
        $data = array();
        $data['userid'] = $req->recv_uid;
        $data['received_userid'] = $req->recv_uid;
        $data['type'] = 2;
        $data['action_name'] = "Credit";
        $data['viewd_user_name'] = $udata->name;
        $data['viewd_user_shop_name'] = $udata->shop_name;
        $data['viewd_user_shop_phone'] = $udata->mobile;
        $recv_lastid = DB::table('funds_transfer_log')->insertGetId($data);
        inset_all_t_log(1,$req->amount,"Internal Transfer",$req->recv_uid,$recv_udata->wallet+$req->amount,$udata->name);
        $data = array();
        $data['uid'] = $req->recv_uid;
        $data['opening_balance'] = $recv_udata->wallet;
        $data['ending_balance'] = $recv_udata->wallet+$req->amount;
        $data['recv_uid'] = $req->recv_uid;
        $data['recv_obal'] = $recv_udata->wallet;
        $data['recv_cbal'] = $recv_udata->wallet-$req->amount;
        $data['sender_uid'] = $req->uid;
        $data['type'] = 2;
        $data['action'] = 1;
        $data['amount'] = $req->amount;        
        $data['lastid'] = $send_lastid;
        $data['remark'] = $req->remark;
        insert_history($data);
        $data = array();
        $data['remark'] = $req->amount." has been transferred to ".$recv_udata->name;
        $data['uid'] = $req->uid;                
        $data['type'] = 2;
        $data['amount'] = $req->amount;
        insert_notification($data);
        $data = array();
        $data['remark'] = $req->amount." received from ".$udata->name;
        $data['uid'] = $req->recv_uid;                
        $data['type'] = 1;
        $data['amount'] = $req->amount;
        insert_notification($data);
        return $recv_lastid;
    }
    public function plan_upgrade(Request $req)
    {
        $udata = get_company_all_data_byid($req->uid);
        $plandata = DB::table('plans')->where('id',$req->plan_id)->first();
        if($plandata->price > $udata->wallet){
            return "Insufficient Balance";
            die();
        }else{
            DB::table('plan_p_log')->where('uid',$req->uid)->update(['is_expire'=>1]);
            $data = array();
            $data['plan_id'] = $plandata->id;
            $data['price'] = $plandata->price;
            $data['is_expire'] = 0;
            $data['date'] = date('Y-m-d');
            $data['mindate'] = date('Ymd');
            $data['time'] = date("h:i:sa");
            $data['timestamp'] = time();
            $data['ex_date'] = get_plan_expiry_time($plandata->id);
            $data['getway_id'] = $req->payment_type;
            if($req->payment_type == 0){
                $datas = array();
                $datas['wallet'] = $udata->wallet-$plandata->price;
                $datas['plan_id'] = $plandata->id;
                DB::table('merchant')->where('id',$udata->id)->update($datas);
            }
            if($req->payment_type == 1 || $req->payment_type == 2){
                $data['t_id'] = $req->txnid;
                $data['referenceid'] = $req->referenceid;
            }
            $lastid = DB::table('plan_p_log')->insertGetId($data);
            inset_all_t_log(2,$plandata->price,"Plan upgrade",$udata->id,$udata->wallet-$plandata->price,"");
            $data = array();
            $data['uid'] = $udata->id;
            $data['lastid'] = $lastid;
            $data['amount'] = $plandata->price;
            $data['type'] = 6;
            $data['action'] = 2;
            $data['gateway_type'] = $req->payment_type;
            $data['updated_plan_id'] = $plandata->id;
            if($req->payment_type == 1 || $req->payment_type == 1){
                $data['opening_balance'] = $udata->wallet;
                $data['ending_balance'] = $udata->wallet;
            }else{
                $data['opening_balance'] = $udata->wallet;
                $data['ending_balance'] = $udata->wallet-$plandata->price;
            }
            $data['txnid'] =$req->txnid;
            $data['utrid'] = $req->referenceid;
            $historyid = insert_history($data);
            return $lastid;
        }
    }
    public function bank_varify(Request $req)
    {
        $udata = get_company_all_data_byid($req->uid);
        $change = bank_account_addfees();
        if(bank_account_addfees() > $udata->wallet){
            return "Insufficient Balance";
            die();
        }
        $data = array();
        $data['name'] = "HELYI";
        $data['phone'] = $req->phone;
        $data['bankAccount'] = $req->bankac_no;
        $data['ifsc'] = $req->ifsc;
        $bankAccount_response = verifyBankAccount($data);
        if(!empty($bankAccount_response['error_msg_id'])){
            return $bankAccount_response['error_msg_id'];
            die();
        }else{
            if(!empty($bankAccount_response['status']) && $bankAccount_response['status'] == "SUCCESS"){
                if($bankAccount_response['data']['accountExists'] == "YES"){
                    $data = array();
                    if(!empty($bankAccount_response['accountStatus'])){
                        $data['account_status'] = $bankAccount_response['accountStatus'];
                    }
                    if(!empty($bankAccount_response['data']['refId'])){
                        $data['refid'] = $bankAccount_response['data']['refId'];
                    }
                    if(!empty($bankAccount_response['data']['utr'])){
                        $data['utr'] = $bankAccount_response['data']['utr'];
                    }
                    if(!empty($bankAccount_response['data']['nameAtBank'])){
                        $data['nameatbank'] = $bankAccount_response['data']['nameAtBank'];
                    }
                    if(!empty($bankAccount_response['data']['bankName'])){
                        $data['bankname'] = $bankAccount_response['data']['bankName'];
                    }
                    if(!empty($bankAccount_response['accountStatus'])){
                        $data['accountstatus'] = $bankAccount_response['accountStatus'];
                    }
                    $datas = array();
                    $datas['wallet'] = $udata->wallet-bank_account_addfees();
                    DB::table('merchant')->where('id',$udata->id)->update($datas);
                    inset_all_t_log(2,$change,"Bank Account Verification Fees",$udata->id,$udata->wallet-$change,"");
                    $datas = array();
                    $datas['uid'] = $udata->id;
                    $datas['opening_balance'] = $udata->wallet;
                    $datas['ending_balance'] = $udata->wallet-$change;
                    $datas['uid'] = $udata->id;
                    $datas['amount'] = $change;
                    $datas['type'] = 8;
                    $datas['action'] = 2;
                    $datas['gateway_type'] = 0;
                    insert_history($datas);
                    return $data;
                }else{
                    return $bankAccount_response['error_msg_id'];
                    die();    
                }
            }else{
                return $bankAccount_response['error_msg_id'];
                die();
            }
        }
    }
    // transaction insert end
    // Get user function type list
    public function user_payout_banks(Request $req)
    {
        $data = DB::table('merchant_bank_accounts')->where('uid',$req->uid)->where('is_deleted',0)->orderby('id','DESC')->get();
        return $data;
    }
    public function user_payout_banks_filter(Request $req)
    {
        $active_payout  = get_payout_type();
        $query = DB::table('merchant_bank_accounts')->where('uid',$req->uid)->where('is_deleted',0)->orderby('id','DESC')->where('gatway_type',$active_payout); 
        if($req->phone != 0){
            $query = $query->where('mobile_number','like', '%'.$req->phone.'%');
        }
        if($req->name != 0){
            $query = $query->where('varify_user_name','like', '%'.$req->name.'%');
        }
        if($req->accountno != 0){
            $query = $query->where('account_number','like', '%'.$req->accountno.'%');
        }
        $data = $query->get();
        return $data;
    }
    public function payout_tranaction($uid)
    {
        $data = DB::table('payout')->where('uid',$uid)->orderby('id','DESC')->get();
        return $data;
    }
    public function payout_data(Request $req)
    {
        $data = DB::table('payout')->where('id',$req->id)->where('uid',$req->uid)->orderby('id','DESC')->get();
        return $data;
    }
    public function internal_tranaction(Request $req)
    {
        $data = DB::table('history')->where('uid',$req->uid)->where('type',2)->get();
        return $data;
    }
    public function addmoney_tranaction(Request $req)
    {
        $data = DB::table('add_money_log')->where('userid',$req->uid)->get();
        return $data;
    }
    public function get_network_user(Request $req)
    {
        $query = DB::table('merchant')->where('refer_uid',$req->uid)->where('is_deleted',0);
        if($req->type == 1){
            $query = $query->where('type',1);
        }else if($req->type == 3){
            $query = $query->where('type',3);
        }
        $data = $query->get();
        return $data;
    }
    public function get_epos_link_list($uid)
    {
        $data = DB::table('peyment_request_link')->where('uid',$uid)->orderBy('id','DESC')->get();
        return $data;
    }
    // Get user function type list end
    // User data update Apis
    public function login_pin_update(Request $req)
    {
        $user = User::where('loginpin',$req->old_loginpin)->where('id',$req->uid)->first();
        if (!$user){
            return response([
                'message' => ['error']
            ]);
        }
        $data = array();
        $data['loginpin'] = $req->new_loginpin;
        DB::table('merchant')->where('id',$req->uid)->update($data);
        return 1;
    }
    public function forgot_login_pin(Request $req)
    {
        $user = User::where('mobile',$req->Phone_number)->first();
        if (!$user){
            return response([
                'message' => ['error']
            ]);
        }
        $data = array();
        $data['loginpin'] = $req->new_loginpin;
        DB::table('merchant')->where('id',$user->id)->update($data);
        return 1;
    }
    public function generate_tpin(Request $req)
    {
        DB::table('merchant')->where('id',$req->uid)->update(['transactionpin'=>$req->new_tpin]);
        return 1;
    }
    public function change_tpin(Request $req)
    {
        $user = User::where('transactionpin',$req->old_tpin)->where('id',$req->uid)->first();
        if (!$user){
            return response([
                'message' => ['error']
            ]);
        }
        $data = array();
        $data['transactionpin'] = $req->new_tpin;
        DB::table('merchant')->where('id',$req->uid)->update($data);
        return 1;   
    }
    public function kyc_submit(Request $req)
    {
        $data = array();
        $data['gov_font_side'] = $req->file('gov_font_side')->store('merchant');
        $data['gov_back_side'] = $req->file('gov_back_side')->store('merchant');
        $data['pancard'] = $req->file('pancard')->store('merchant');
        $data['kyc_Photo'] = $req->file('kyc_Photo')->store('merchant');
        $data['kyc_signature'] = $req->file('kyc_signature')->store('merchant');
        $data['is_kyc_submit'] = 1;
        DB::table('merchant')->where('id',$req->uid)->update($data);
        return response([
            'message' => ['success']
        ]);
    }
    public function addmoney_form(Request $req)
    {
        $udata = get_company_all_data_byid($req->uid);
        $plandata = get_plan_data($udata->plan_id);
        $t0_hours = $plandata->t0_hours;
        $payment_method = $req->payment_method;
        $payment_option = $req->payment_option;
        $total = $req->total;
        $count_total_taxrate = ($req->tax/100)*$req->total;
        $count_total_amount = $req->total-$count_total_taxrate;
        $data = array();
        $data['userid'] = $req->uid;
        $data['amount'] = $req->total;
        $data['total_amount'] = $count_total_amount;
        $data['balance'] = $udata->wallet+$count_total_amount;
        $data['action'] = "Add";
        $data['bankit_fee'] = $count_total_taxrate;
        $data['time'] = date('h:i:sa');
        $data['date'] = date('Y-m-d');
        $data['min_date'] = date('Ymd');
        $data['view_date'] = date('d-m-Y');
        $data['topuptype'] = $req->payment_option;
        $data['paymentoption'] = $req->payment_method;
        $data['payment_id'] = $req->txnid;
        if($req->payment_option == 0){
            $data['is_added'] = 1;
            $data['timestamp'] = time();
        }else{
            $data['is_added'] = 0;
        }
        if($req->payment_option == 1){
            $data['timestamp'] = time() + (60 * 60 * 48);
        }
        if($req->payment_option == 2){
            $data['timestamp'] = time() + (60 * 60 * 72);
        }
        if($req->payment_option == 3){
            $data['timestamp'] = time() + (60 * 60 * $t0_hours);
        }
        if($req->gateway_type == 1){
            $data['method_type'] = $req->gateway_type;
            $data['method'] = "Rezorpay";
            // $data['status_text'] = $capture_response['status'];
            $data['is_capture'] = 1;   
        }
        if($req->gateway_type == 2 || $req->gateway_type == 3){
            $data['method_type'] = $req->gateway_type;
            $data['method'] = "Cashfree";
            // $data['response_msg'] = $req->response_message;
        }
        $lastid = DB::table('add_money_log')->insertGetid($data);
        $data = array();
        $data['wallet'] = $udata->wallet+$count_total_amount;
        DB::table('merchant')->where('id',$req->uid)->update($data);
        inset_all_t_log(1,$req->total,"Add Wallet",$req->uid,$udata->wallet+$req->total,"");
        inset_all_t_log(2,$count_total_taxrate,"Processing Fee",$req->uid,$udata->wallet+$count_total_amount,"");
        bankit_fee_distributed($req->uid,$req->total,$lastid);
        $data = array();
        $data['uid'] = $req->uid;
        $data['lastid'] = $lastid;
        $data['total'] = $req->total;
        $data['amount'] = $count_total_amount;
        $data['fee'] = $count_total_taxrate;
        $data['type'] = 1;
        $data['action'] = 1;
        $data['opening_balance'] = $udata->wallet;
        $data['ending_balance'] = $udata->wallet+$count_total_amount;
        $data['txnid'] =$req->txnid;
        $data['orderid'] =$req->orderid;
        $data['utrid'] =$req->referenceid;
        $data['gateway_type'] = $req->gateway_type;
        $data['is_fail'] = 0;
        $historyid = insert_history($data);
        return $count_total_amount;
    }
    // User data update Apis end
    // get component data
    public function banks_list()
    {
        $data = DB::table('bank_data')->where('is_deleted',0)->orderby('bank_names','ASC')->get();
        return $data;
    }
    public function purpose_of_payment_list()
    {
        $data = DB::table('purpose_of_payment')->where('is_deleted',0)->get();
        return $data;
    }
    public function bank_verification_fee()
    {
        $data = DB::table('add_account_charges')->first();
        return $data->amount;
    }
    public function payment_methods_list()
    {
        $data = DB::table('payment_options')->get();
        return $data;
    }
    public function payment_methods($uid)
    {
        $q = DB::table('payment_options')->get();
        $typeid = array();
        foreach($q as $list){
            $check = check_is_enabe_pm($list->id,$uid);
            if($check == 1){
                $typeid[] = $list->id;
            }
        }
        $data = DB::table('payment_options')->whereIn('id',$typeid)->get();
        return $data;
    }
    public function plans_list()
    {
        $data = DB::table('plans')->where('is_deleted',0)->get();
        require $data;
    }
    public function get_plan_data($id)
    {
        $data = DB::table('plans')->where('id',$id)->where('is_deleted',0)->get();
        require $data;
    }
    public function get_gatway_key(Request $req)
    {
        $data = DB::table('gateway_key')->where('type',$req->type)->get();
        require $data;
    }
    // get component data end
}