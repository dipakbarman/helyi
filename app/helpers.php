<?php
use LoveyCom\CashFree\PaymentGateway\Order;
use Razorpay\Api\Api;
function get_bank_name($id="")
{
    $name = "";
    if(!empty($id)) {
        $data = DB::table('bank_data')->where('id',$id)->first();
        $name = $data->bank_names;
    }
    return $name;
}
function inset_all_t_log($atype="",$amount,$resone="",$uid="",$balance="",$username=""){
    // 1 = C
    // 2 = D
    $data = array();
    $data['amt'] = $amount;
    if(!empty($atype)){
        $data['atype'] = $atype;
    }
    if(!empty($uid)){
        $data['uid'] = $uid;
    }
    if(!empty($resone)){
        $data['r'] = $resone;
    }
    if(!empty($balance)){
        $data['bal'] = $balance;
    }
    if(!empty($username)){
        $data['user_name'] = $username;
    }
    $data['date'] = date('Y-m-d');
    $data['mindate'] = date('Ymd');
    $data['mintime'] = time();
    $data['time'] = date('h:i:s a');
    DB::table('all_t_log')->insert($data);
    // if($resone == "Processing Fee"){
    //     $msg = " has been charged as processing fee";
    //     $data = array();
    //     $data['time'] = time();
    //     $data['date'] = date('Ymd');
    //     $data['uid'] = $uid;
    //     $data['remark'] = $amount.$msg;
    //     $data['view'] = 0;
    //     $data['type'] = $atype;
    //     $data['amount'] = $amount;
    //     DB::table('notification')->insert($data);
    // }
    // if($resone == "Add Wallet" || $resone == "Epos Amount Added To Main Wallet" || $resone == "EPOS Added Wallet"){
    //     if($resone == "Add Wallet" || $resone == "Epos Amount Added To Main Wallet"){
    //         $msg = " added to your wallet";
    //     }
    //     if($resone == "EPOS Added Wallet"){
    //         $msg = " added to your lein wallet";
    //     }
    //     $data = array();
    //     $data['time'] = time();
    //     $data['date'] = date('Ymd');
    //     $data['uid'] = $uid;
    //     $data['remark'] = $amount.$msg;
    //     $data['view'] = 0;
    //     $data['type'] = $atype;
    //     $data['amount'] = $amount;
    //     DB::table('notification')->insert($data);
    // }
    
    // $data = array();
    // $data['time'] = time();
    // $data['date'] = date('Ymd');
    // $data['uid'] = $uid;
    // $data['remark'] = $resone;
    // $data['view'] = 0;
    // $data['type'] = $atype;
    // $data['amount'] = $amount;
    // DB::table('notification')->insert($data);
}
function get_uniq_id($type){
        $typename = "";
        if($type == 1){
            $typename = "M";
        }
        if($type == 3){
            $typename = "D";
        }
        if($type == 4){
            $typename = "MD";
        } 
        $count = DB::table('merchant')->where('type',$type)->count();
        $count_total = $count+1;
        $return = $typename.$count_total;
        return $return;
}
function check_notification_count(){
    $data = DB::table('funds_transfer_log')->where('received_userid',session()->get('userid'))->where('is_view',0)->count();
    $send = DB::table('funds_transfer_log')->where('userid',session()->get('userid'))->where('is_view',0)->count();
    return $data+$send;
}
function get_notification(){
    $data = DB::table('funds_transfer_log')->where('received_userid',session()->get('userid'))->where('userid',session()->get('userid'))->where('is_view',0)->OrderBy('id','DESC')->limit(5)->get();
    return $data;
}
function get_send_notification(){
    $data = DB::table('funds_transfer_log')->where('userid',session()->get('userid'))->where('is_view',0)->OrderBy('id','DESC')->limit(5)->get();
    return $data;
}
function get_wallet_bal(){
    $userq = DB::table('merchant')->where('id',session()->get('userid'))->first();
    return $userq->wallet;
}
function check_epos_active(){
    $userq = DB::table('merchant')->where('id',session()->get('userid'))->first();
    return $userq->epos_services;
    dd($userq->epos_services);
}
function get_wallet_bal_byid($id){
    $userq = DB::table('merchant')->where('id',$id)->first();
    return $userq->wallet;
}
function count_my_curent_wallet($uid,$amount)
{
    $userq = DB::table('merchant')->where('id',$uid)->first();
    if(!empty($userq)){
        $wallet = $userq->wallet;
        $total = $wallet+$amount;
        return $total;
    }
}
function get_lein_wallet_bal(){
    $userq = DB::table('merchant')->where('id',session()->get('userid'))->first();
    return $userq->lein_wallet;
}
function userdataq(){
    $q = DB::table('merchant')->where('id',session()->get('userid'))->first();
    return $q;
}
function get_company_all_data_byid($id=""){
    $result = "";
    if(!empty($id)){
        $data = DB::table('merchant')->where('id',$id)->first();
        if(!empty($data)){
            $result =  $data;    
        }else{
            $result = "";
        }
        
    }
    return $result;
}
function username(){
    $q = DB::table('merchant')->where('id',session()->get('userid'))->first();
    return $q->firstname;
}
function count_total_user(){
    $q = DB::table('merchant')->where('type',2)->where('is_active',1)->where('is_deleted',0)->count();
    return $q;
}
function count_total_pending_user(){
    $q = DB::table('merchant')->where('type',2)->where('is_active',0)->where('is_deleted',0)->count();
    return $q;
}
function count_total_shop(){
    $q = DB::table('merchant')->where('type',1)->where('is_active',1)->where('is_deleted',0)->count();
    return $q;
}
function count_total_pending_shop(){
    $q = DB::table('merchant')->where('type',1)->where('is_active',0)->where('is_deleted',0)->count();
    return $q;
}
function count_total_distributor(){
    $q = DB::table('merchant')->where('type',3)->where('is_active',1)->where('is_deleted',0)->count();
    return $q;
}
function count_total_pending_distributor(){
    $q = DB::table('merchant')->where('type',3)->where('is_active',0)->where('is_deleted',0)->count();
    return $q;
}
function count_total_masterdistri(){
    $q = DB::table('merchant')->where('type',4)->where('is_active',1)->where('is_deleted',0)->count();
    return $q;
}
function count_total_pending_masterdistri(){
    $q = DB::table('merchant')->where('type',4)->where('is_active',0)->where('is_deleted',0)->count();
    return $q;
}

function get_company_name($id=""){
    $result = "";
    if(!empty($id)){
        $data = DB::table('merchant')->where('id',$id)->first();
        if(!empty($data)){
            $result =  $data->shop_name;    
        }else{
            $result = "";
        }
        
    }
    return $result;
}
function get_user_firstname($id=""){
    $result = "";
    if(!empty($id)){
        $data = DB::table('merchant')->where('id',$id)->first();
        if(!empty($data)){
            $result =  $data->firstname;    
        }else{
            $result = "";
        }
        
    }
    return $result;
}
function get_user_name($id=""){
    $result = "";
    if(!empty($id)){
        $data = DB::table('merchant')->where('id',$id)->first();
        if(!empty($data)){
            $result =  $data->name;    
        }else{
            $result = "";
        }
        
    }
    return $result;
}
function get_user_emailid($id=""){
    $result = "";
    if(!empty($id)){
        $data = DB::table('merchant')->where('id',$id)->first();
        if(!empty($data)){
            $result =  $data->email;    
        }else{
            $result = "";
        }
        
    }
    return $result;
}
function get_user_shop_logo($id=""){
    $result = "";
    if(!empty($id)){
        $data = DB::table('merchant')->where('id',$id)->first();
        if(!empty($data)){
            $result =  $data->store_logo;    
        }else{
            $result = "";
        }
        
    }
    return $result;
}
function count_total_customers()
{
    $count = DB::table('merchant')->count(); 
    return $count; 
}
function count_total_user_this_month()
{
    $today = date('Y-m-d');
    $last_day = date("Y-m-t", strtotime($today));
    $firstdate = date('Ym').'1';
    $lastdate = date_min($last_day);
    $count = DB::table('merchant')->whereBetween('mindate',[$firstdate, $lastdate])->count(); 
    return $count; 
}
function count_total_user_today()
{
    $today = date('Ymd');
    $count = DB::table('merchant')->where('mindate',$today)->count(); 
    return $count; 
}
function count_total_store_this_month()
{
    $today = date('Y-m-d');
    $last_day = date("Y-m-t", strtotime($today));
    $firstdate = date('Ym').'1';
    $lastdate = date_min($last_day);
    $count = DB::table('merchant')->whereBetween('mindate',[$firstdate, $lastdate])->where('type',1)->count(); 
    return $count; 
}
function count_total_store_today()
{
    $today = date('Ymd');
    $count = DB::table('merchant')->where('mindate',$today)->where('type',1)->count(); 
    return $count; 
}
// function get_admin_lein()
// {
//     $q = DB::table('admin_users')->
// }
function count_original_admin_lein()
{
    $total = get_admin_total_wallet();
    $main = get_admin_main_wallet();
    $count = $total-$main;
    return $count;
}
function get_admin_total_wallet()
{
    $total = 0;
    $q = DB::table('distribute_logs')->sum('admin');
    if($q > 0){
        $total = $q;
    }
    return $total;
}
function get_admin_main_wallet()
{
    $total = 0;
    $q = DB::table('adminleintomain')->sum('amount');
    if($q > 0){
        $total = $q;
    }
    return $total;
}
function get_total_internal_transfer($uid="")
{
    $total = "";
    if(isset($uid)){
        $total = DB::table('funds_transfer_log')->where('userid',$uid)->sum('amount');
    }
    return $total;
}
function get_marque_text(Type $var = null)
{
    $text_line = "";
      $check = DB::table('mtext')->count(); 
      if ($check > 0) {
          $text_data = DB::table('mtext')->get(); 
          $text_line = $text_data[0]->text;
      }
      return $text_line;
}
function get_user_number($id=""){
    $result = "";
    if(!empty($id)){
        $data = DB::table('merchant')->where('id',$id)->first();
        if(!empty($data)){
            $result =  $data->mobile;    
        }else{
            $result = "";
        }
        
    }
    return $result;
}
function get_plan_name($id=""){
    $result = "";
    if(!empty($id)){
        $data = DB::table('plans')->where('id',$id)->first();
        if(!empty($data)){
            $result =  $data->package_name;    
        }else{
            $result = "";
        }
        
    }
    return $result;
}
function get_plan_price($id){
    $result = "";    
    $data = DB::table('plans')->where('id',$id)->first();
        if(!empty($data)){
            $result = $data->price;    
        }
    return $result;
}
function get_plan_expiry_time($id)
{
    $time = "";
    $cdate = date('Ymd');
    $q = DB::table('plans')->where('id',$id)->first();
    if($q->plan_duration == 1){
        $time = date('Ymd', strtotime($cdate .' +30 day'));
    }
    if($q->plan_duration == 2){
        $time = date('Ymd', strtotime($cdate .' +60 day'));
    }
    if($q->plan_duration == 3){
        $time = date('Ymd', strtotime($cdate .' +90 day'));
    }
    if($q->plan_duration == 4){
        $time = date('Ymd', strtotime($cdate .' +180 day'));
    }
    if($q->plan_duration == 5){
        $time = date('Ymd', strtotime($cdate .' +360 day'));
    }
    return $time;
}
function get_plan_cashback($id=""){
    $result = "";
    if(!empty($id)){
        $data = DB::table('plans')->where('id',$id)->first();
        if(!empty($data)){
            $result =  $data->distibutor_cashback;    
        }else{
            $result = "";
        }
        
    }
    return $result;
}
function current_plan_name()
{
    $name = "";
    if(session()->has('userid')){
        $data = DB::table('merchant')->where('id',session()->get('userid'))->first();
        $name = get_plan_name($data->plan_id);
       }else{
        $name = "";
    }
    return $name;
}
function get_default_plan()
{
    $id = "";
    $data = DB::table('plans')->where('is_active',1)->first();
    if(!empty($data)){
        $id = $data->id;
    }
    return $id;
}

function count_wallet_amount($uid="",$amont="",$type=""){
    // type  1 = plus
    // type  2 = minus
    $total =  get_wallet_bal_byid($uid);
    if(!empty($type) && !empty($uid)){
        $wallet = get_wallet_bal_byid($uid);
        if($type == 1){
            $total = $wallet+$amont;
        }
        if($type == 2){
            $total = $wallet-$amont;   
        }
    }
    return $total;
}
function check_alredy_p($plan_id){
    $result = "";
    if(!empty($plan_id)){
        $data = DB::table('plan_p_log')->where('uid',session()->get('userid'))->where('plan_id',$plan_id)->first();
        if(!empty($data)){
            $result = 1;    
        }else{
            $result = "";
        }
        
    }
    return $result;
}
function check_alredy_p_by_user($plan_id,$uid){
    $result = "";
    if(!empty($plan_id) && !empty($uid)){
        $data = DB::table('plan_p_log')->where('uid',$uid)->where('plan_id',$plan_id)->first();
        if(!empty($data)){
            $result = 1;    
        }else{
            $result = "";
        }
        
    }
    return $result;
}
function get_getway_name($id=""){
    $result = "";
    if(!empty($id)){
        $data = DB::table('payment_getway')->where('id',$id)->first();
        if(!empty($data)){
            $result =  $data->payment_getway_name;    
        }else{
            $result = "";
        }
        
    }
    return $result;
}
function check_active_getway_option_for_link($getway_id="",$option_id="")
{
    $result = 0;
    if(!empty($getway_id) && !empty($option_id)){
        $data = DB::table('link_wise_payment_getway')->where('payment_getway_id',$getway_id)->where('option_id',$option_id)->first();
        if(!empty($data)){
            $result =  1;    
        }else{
            $result = 0;
        }
        
    }
    return $result;
}
function check_alredy_option_exist_for_link($getway_id="",$option_id="")
{
    $result = 0;
    if(!empty(!empty($getway_id) && !empty($option_id))){
        $data = DB::table('link_wise_payment_getway')->whereNotIn('payment_getway_id', [$getway_id])->where('option_id',$option_id)->first();
        if(!empty($data)){
            $result =  1;    
        }else{
            $result = 0;
        }
        
    }
    return $result;
}
function check_active_getway_option($getway_id="",$option_id="")
{
    $result = 0;
    if(!empty($getway_id) && !empty($option_id)){
        $data = DB::table('option_wise_payment_getway')->where('payment_getway_id',$getway_id)->where('option_id',$option_id)->first();
        if(!empty($data)){
            $result =  1;    
        }else{
            $result = 0;
        }
        
    }
    return $result;
}
function check_alredy_option_exist($getway_id="",$option_id="")
{
    $result = 0;
    if(!empty(!empty($getway_id) && !empty($option_id))){
        $data = DB::table('option_wise_payment_getway')->whereNotIn('payment_getway_id', [$getway_id])->where('option_id',$option_id)->first();
        if(!empty($data)){
            $result =  1;    
        }else{
            $result = 0;
        }
        
    }
    return $result;
}
function get_instant_tax_of_p_options($id="")
{
    $tax = "";
    if(!empty($id)){
        $user_q = DB::table('merchant')->where('id',session()->get('userid'))->first();
        $user_current_plan = $user_q->plan_id;
        $tax = get_tax_value($user_current_plan,$id,0);
    }
    return $tax;
}
function get_user_type($type="")
{
    $requrn = "";
    if(!empty($type)){
        if($type == 1){
            $requrn = "Merchant";
        }
        if($type == 2){
            $requrn = "User";
        }
        if($type == 3){
            $requrn = "Distributor";
        }
        if($type == 4){
            $requrn = "Master Distributor";
        }
    }
    return $requrn;
}
function get_curent_planid()
{
    $q = userdataq();
    $plan_id = $q->plan_id;
    return $plan_id;
}
function get_user_curent_planid($uid="")
{
    $q = DB::table('merchant')->where('id',$uid)->first();
    $plan_id = $q->plan_id;
    return $plan_id;
}
function get_curent_plan_type()
{
    $q = userdataq();
    $plan_id = $q->plan_id;
    $plan_type = get_plan_type($plan_id);
    return $plan_type;
}
function get_user_curent_plan_type($uid)
{
    $q = DB::table('merchant')->where('id',$uid)->first();
    $plan_id = $q->plan_id;
    $plan_type = get_plan_type($plan_id);
    return $plan_type;
}
function get_plan_data($plan_id=""){
    $result = "";
    if(!empty($plan_id)){
        $data = DB::table('plans')->where('id',$plan_id)->first();
        $result = $data;    
    }
    return $result;
}
function get_plan_type($id=""){
    $result = "";
    if(!empty($id)){
        $data = DB::table('plans')->where('id',$id)->first();
        if(!empty($data)){
            $result =  $data->plan_type;    
        }else{
            $result = "";
        }
        
    }
    return $result;
}
function count_total_tax($uid="",$amount="",$tax=""){
    $total = "";
    $myplan_id = get_user_curent_planid($uid);
    $plantype = get_plan_type($myplan_id);
    if(!empty($amount) && !empty($tax) && !empty($plantype)){
        if($plantype == 1){
            $total = ($tax/100)*$amount;
        }
        if($plantype == 2){
            $total = $tax;
        }
    }
    return $total;
}
function count_total_after_tax($uid="",$amount="",$tax=""){
    $total = "";
    $myplan_id = get_user_curent_planid($uid);
    $plantype = get_plan_type($myplan_id);
    if(!empty($amount) && !empty($tax) && !empty($plantype)){
        if($plantype == 1){
            $per = ($tax/100)*$amount;
            $total = $amount-$per;
        }
        if($plantype == 2){
            $total = $amount-$tax;
        }
    }
    return $total;
}
function get_tax_value($plan_id="",$option="",$taxtype=""){
    $tax = "";
    if(!empty($option) && !empty($plan_id)){
        $pid = $plan_id;
        $pm = $option;
        $tt = $taxtype;
        $plan_q = DB::table('plans')->where('id',$pid)->first();
        if(!empty($plan_q)){
            if($tt == 0){
                if($pm == 1){
                    $tax = $plan_q->debit_card_instant;
                }
                if($pm == 2){
                    $tax = $plan_q->netbanking_instant;
                }
                if($pm == 3){
                    $tax = $plan_q->upi_instant;
                }
                if($pm == 4 || $pm == 10){
                    $tax = $plan_q->credit_card_instant;
                }
                if($pm == 5){
                    $tax = $plan_q->amex_card_instant;
                }
                if($pm == 6){
                    $tax = $plan_q->diners_card_instant;
                }
                if($pm == 7){
                    $tax = $plan_q->wallet_instant;
                }
                if($pm == 8){
                    $tax = $plan_q->corporate_card_instant;
                }
                if($pm == 9){
                    $tax = $plan_q->prepaid_card_instant;
                }  
            }
            if($tt == 1){
                if($pm == 1){
                    $tax = $plan_q->debit_card_t1;
                }
                if($pm == 2){
                    $tax = $plan_q->netbanking_t1;
                }
                if($pm == 3){
                    $tax = $plan_q->upi_t1;
                }
                if($pm == 4 || $pm == 10){
                    $tax = $plan_q->credit_card_t1;
                }
                if($pm == 5){
                    $tax = $plan_q->amex_card_t1;
                }
                if($pm == 6){
                    $tax = $plan_q->diners_card_t1;
                }
                if($pm == 7){
                    $tax = $plan_q->wallet_t1;
                }
                if($pm == 8){
                    $tax = $plan_q->corporate_card_t1;
                }
                if($pm == 9){
                    $tax = $plan_q->prepaid_card_t1;
                }
            }
            if($tt == 2){
                if($pm == 1){
                    $tax = $plan_q->debit_card_t2;
                }
                if($pm == 2){
                    $tax = $plan_q->netbanking_t2;
                }
                if($pm == 3){
                    $tax = $plan_q->upi_t2;
                }
                if($pm == 4 || $pm == 10){
                    $tax = $plan_q->credit_card_t2;
                }
                if($pm == 5){
                    $tax = $plan_q->amex_card_t2;
                }
                if($pm == 6){
                    $tax = $plan_q->diners_card_t2;
                }
                if($pm == 7){
                    $tax = $plan_q->wallet_t2;
                }
                if($pm == 8){
                    $tax = $plan_q->corporate_card_t2;
                }
                if($pm == 9){
                    $tax = $plan_q->prepaid_card_t2;
                }
            }
            if($tt == 3){
                if($pm == 1){
                    $tax = $plan_q->debit_card_t0;
                }
                if($pm == 2){
                    $tax = $plan_q->netbanking_t0;
                }
                if($pm == 3){
                    $tax = $plan_q->upi_t0;
                }
                if($pm == 4 || $pm == 10){
                    $tax = $plan_q->credit_card_t0;
                }
                if($pm == 5){
                    $tax = $plan_q->amex_card_t0;
                }
                if($pm == 6){
                    $tax = $plan_q->diners_card_t0;
                }
                if($pm == 7){
                    $tax = $plan_q->wallet_t0;
                }
                if($pm == 8){
                    $tax = $plan_q->corporate_card_t0;
                }
                if($pm == 9){
                    $tax = $plan_q->prepaid_card_t0;
                }
            }
        }
    }
    return $tax;
}
function count_total_wallet_filter_cdate($uid,$fdate,$tdate)
{
    $count = 0;
    if(!empty($uid)){
        $total = DB::table('merchant')->where('refer_uid',$uid)->whereBetween('mindate',[$fdate, $tdate])->sum('wallet');
        $count = $total;
    }
    return $count;
}
function count_total_wallet($id = "")
{
    $count = 0;
    if(!empty($id)){
        $total = DB::table('merchant')->where('refer_uid',$id)->sum('wallet');
        return $total;
    }else{
        return $count;
    }
}
function count_network_wallet_today($id = "")
{
    $count = 0;
    if(!empty($id)){
        $total = DB::table('merchant')->where('refer_uid',$id)->where('mindate',date('Ymd'))->sum('wallet');
        return $total;
    }else{
        return $count;
    }
}
function count_network_wallet_sevendays($id = "")
{
    $count = 0;
    if(!empty($id)){
        $date = date('Y-m-d', strtotime('-7 days'));
        $min_date = date_min($date);
        $total = DB::table('merchant')->where('refer_uid',$id)->whereBetween('mindate',[$min_date, date('Ymd')])->sum('wallet');
        return $total;
    }else{
        return $count;
    }
}
function count_network_wallet_thismonth($id = "")
{
    $count = 0;
    if(!empty($id)){
        $fromdate = date('Y-m')."-1";
        $frommin = date_min($fromdate);
        $a_date = date('Y-m-d');
        $todate = date("Y-m-t", strtotime($a_date));
        $tomin = date_min($todate);
        $total = DB::table('merchant')->where('refer_uid',$id)->whereBetween('mindate',[$frommin, $tomin])->sum('wallet');
        return $total;
    }else{
        return $count;
    }
}
function count_total_network_transfer($uid)
{
    $total = 0;
    $q = DB::table('funds_transfer_log')->where('refer_userid',$uid)->sum('amount');
    if($q > 0){
        $total = $q;
    }
    return $total;
}
function count_total_wallet_filter($uid,$ftype){
    $total = 0;
    if($ftype == 1){
        $total = DB::table('merchant')->where('refer_uid',$uid)->sum('wallet');
    }
    if($ftype == 2){
        $total = DB::table('merchant')->where('refer_uid',$uid)->where('mindate',date('Ymd'))->sum('wallet');
    }
    if($ftype == 3){
        $date = date('Y-m-d', strtotime('-7 days'));
        $min_date = date_min($date);
        $total = DB::table('merchant')->where('refer_uid',$uid)->whereBetween('mindate',[$min_date, date('Ymd')])->sum('wallet');
    }
    if($ftype == 4){
        $frommin = date('Ym01');
        $a_date = date('Y-m-d');
        $todate = date("Y-m-t", strtotime($a_date));
        $tomin = date_min($todate);
        $total = DB::table('merchant')->where('refer_uid',$uid)->whereBetween('mindate',[$frommin, $tomin])->sum('wallet');
    }
    return $total;
}
function count_total_bank_added_filter($uid,$ftype)
{
    $count = "";
    if($ftype == 1){
        $q = DB::table('merchant_bank_accounts')->where('uid',$uid)->where('is_deleted',0)->count();
        $count = $q;
    }
    if($ftype == 2){
        $q = DB::table('merchant_bank_accounts')->where('uid',$uid)->where('is_deleted',0)->where('mindate',date('Ymd'))->count();
        $count = $q;
    }
    if($ftype == 3){
        $date = date('Y-m-d', strtotime('-7 days'));
        $min_date = date_min($date);
        $q = DB::table('merchant_bank_accounts')->where('uid',$uid)->where('is_deleted',0)->whereBetween('mindate',[$min_date, date('Ymd')])->count();
        $count = $q;
    }
    if($ftype == 4){
        $frommin = date('Ym01');
        $a_date = date('Y-m-d');
        $todate = date("Y-m-t", strtotime($a_date));
        $tomin = date_min($todate);
        $q = DB::table('merchant_bank_accounts')->where('uid',$uid)->where('is_deleted',0)->whereBetween('mindate',[$frommin, $tomin])->count();
        $count = $q;
    }
    return $count;
}
function count_my_merchant_network_filter($uid,$ftype)
{
    $count = 0;
    if($ftype == 1){
        $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',1)->count();
        $count = $q;
    }
    if($ftype == 2){
        $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',1)->where('mindate',date('Ymd'))->count();
        $count = $q;
    }
    if($ftype == 3){
        $date = date('Y-m-d', strtotime('-7 days'));
        $min_date = date_min($date);
        $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',1)->whereBetween('mindate',[$min_date, date('Ymd')])->count();
        $count = $q;
    }
    if($ftype == 4){
        $frommin = date('Ym01');
        $a_date = date('Y-m-d');
        $todate = date("Y-m-t", strtotime($a_date));
        $tomin = date_min($todate);
        $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',1)->whereBetween('mindate',[$frommin, $tomin])->count();
        $count = $q;
    }
    return $count;
}

function count_total_network_transfer_filter($uid,$ftype)
{
    $total = 0;
    $my_network_q = DB::table('merchant')->where('refer_uid',$uid)->get();
    $network_q = array();
    if(!empty($my_network_q)){
        foreach($my_network_q as $list){
            $network_q[] = $list->id;
        }
    }
    if(!empty($network_q)){
    if($ftype == 1){
        $q = DB::table('funds_transfer_log')->whereIn('userid',$network_q)->sum('amount');
        if($q > 0){
            $total = $q;
        }
    }
    if($ftype == 2){
        $q = DB::table('funds_transfer_log')->whereIn('userid',$network_q)->where('mindate',date('Ymd'))->sum('amount');
        if($q > 0){
            $total = $q;
        }
    }
    if($ftype == 3){
        $date = date('Y-m-d', strtotime('-7 days'));
        $min_date = date_min($date);
        $q = DB::table('funds_transfer_log')->whereIn('userid',$network_q)->whereBetween('mindate',[$min_date, date('Ymd')])->sum('amount');
        if($q > 0){
            $total = $q;
        }
    }
    if($ftype == 4){
        $frommin = date('Ym01');
        $a_date = date('Y-m-d');
        $todate = date("Y-m-t", strtotime($a_date));
        $tomin = date_min($todate);
        $q = DB::table('funds_transfer_log')->whereIn('userid',$network_q)->whereBetween('mindate',[$frommin, $tomin])->sum('amount');
        if($q > 0){
            $total = $q;
        }
    }
}
    return $total;
}
function count_my_distibutor_network_filter($uid,$ftype){
    $count = "";
    if($ftype == 1){
        $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',3)->count();
        $count = $q;
    }
    if($ftype == 2){
        $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',3)->where('mindate',date('Ymd'))->count();
        $count = $q;
    }
    if($ftype == 3){
        $date = date('Y-m-d', strtotime('-7 days'));
        $min_date = date_min($date);
        $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',3)->whereBetween('mindate',[$min_date, date('Ymd')])->count();
        $count = $q;
    }
    if($ftype == 4){
        $frommin = date('Ym01');
        $a_date = date('Y-m-d');
        $todate = date("Y-m-t", strtotime($a_date));
        $tomin = date_min($todate);
        $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',3)->whereBetween('mindate',[$frommin, $tomin])->count();
        $count = $q;
    }
    return $count;
}
function total_transfer_funds_filter($uid,$ftype){
    $total = 0;
    if($ftype == 1){
        $count = DB::table('funds_transfer_log')->where('userid',$uid)->sum('amount');
        if($count > 0){
            $total = $count;
        }
    }
    if($ftype == 2){
        $count = DB::table('funds_transfer_log')->where('userid',$uid)->where('mindate',date('Ymd'))->sum('amount');
        if($count > 0){
            $total = $count;
        }
    }
    if($ftype == 3){
        $date = date('Y-m-d', strtotime('-7 days'));
        $min_date = date_min($date);
        $q = DB::table('funds_transfer_log')->where('userid',$uid)->whereBetween('mindate',[$min_date, date('Ymd')])->sum('amount');
        $total = $q;
    }
    if($ftype == 4){
        $frommin = date('Ym01');
        $a_date = date('Y-m-d');
        $todate = date("Y-m-t", strtotime($a_date));
        $tomin = date_min($todate);
        $q = DB::table('funds_transfer_log')->where('userid',$uid)->whereBetween('mindate',[$frommin, $tomin])->sum('amount');
        $total = $q;
    }
    return $total;
}
function total_addmoney_filter($uid,$ftype){
    $total = 0;
    if($ftype == 1){
        $count = DB::table('add_money_log')->where('userid',$uid)->where('is_fail',0)->whereNotNull('is_added')->where('is_added','!=',3)->sum('total_amount');
        if($count > 0){
            $total = $count;
        }
    }
    if($ftype == 2){
        $count = DB::table('add_money_log')->where('userid',$uid)->where('is_fail',0)->whereNotNull('is_added')->where('is_added','!=',3)->where('min_date',date('Ymd'))->sum('amount');
        if($count > 0){
            $total = $count;
        }
    }
    if($ftype == 3){
        $date = date('Y-m-d', strtotime('-7 days'));
        $min_date = date_min($date);
        $q = DB::table('add_money_log')->where('userid',$uid)->where('is_fail',0)->whereNotNull('is_added')->where('is_added','!=',3)->whereBetween('min_date',[$min_date, date('Ymd')])->sum('amount');
        $total = $q;
    }
    if($ftype == 4){
        $frommin = date('Ym01');
        $a_date = date('Y-m-d');
        $todate = date("Y-m-t", strtotime($a_date));
        $tomin = date_min($todate);
        $q = DB::table('add_money_log')->where('userid',$uid)->where('is_fail',0)->whereNotNull('is_added')->where('is_added','!=',3)->whereBetween('min_date',[$frommin, $tomin])->sum('amount');
        $total = $q;
    }
    return $total;
}
function total_addmoney_filter_cdate($uid,$fdate,$tdate){
    $total = 0;
    $count = DB::table('add_money_log')->where('userid',$uid)->where('is_fail',0)->whereNotNull('is_added')->where('is_added','!=',3)->whereBetween('min_date',[$fdate, $tdate])->sum('amount');
    if($count > 0){
        $total = $count;
    }
    return $total;
}
function count_total_bank_added_filter_cdate($uid,$fdate,$tdate)
{
    $total = 0;
    $count = DB::table('merchant_bank_accounts')->where('uid',$uid)->where('is_deleted',0)->whereBetween('mindate',[$fdate, $tdate])->count();
    if($count > 0){
        $total = $count;
    }
    return $total;
}
function total_transfer_funds_cdate($uid,$fdate,$tdate){
    $total = 0;
    $count = DB::table('funds_transfer_log')->where('userid',$uid)->whereBetween('mindate',[$fdate, $tdate])->sum('amount');
    if($count > 0){
        $total = $count;
    }
    return $total;
}
function count_my_merchant_network_filter_cdate($uid,$fdate,$tdate){
    $count = 0;
    $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',1)->whereBetween('mindate',[$fdate, $tdate])->count();
    $count = $q;
}
function count_total_network_transfer_filter_cdate($uid,$fdate,$tdate)
{

    $count = 0;
    $my_network_q = DB::table('merchant')->where('refer_uid',$uid)->get();
    if(!empty($my_network_q)){
        $network_q = array();
        foreach($my_network_q as $list){
            $network_q[] = $list->id;
        }
    }
    if(!empty($uid)){
        $total = DB::table('funds_transfer_log')->whereIn('userid',$network_q)->whereBetween('mindate',[$fdate, $tdate])->sum('amount');
        $count = $total;
    }
    return $count;
}
function count_total_network_transfer_today($uid)
{
    $total = 0;
    $my_network_q = DB::table('merchant')->where('refer_uid',$uid)->get();
    if(!empty($my_network_q)){
        $network_q = array();
        foreach($my_network_q as $list){
            $network_q[] = $list->id;
        }
    }
    $q = DB::table('funds_transfer_log')->whereIn('userid',[$network_q])->where('mindate',date('Ymd'))->sum('amount');
    if($q > 0){
        $total = $q;
    }
    return $total;
}
function count_total_network_transfer_sevendays($uid)
{
    $total = 0;
    $my_network_q = DB::table('merchant')->where('refer_uid',$uid)->get();
    if(!empty($my_network_q)){
        $network_q = array();
        foreach($my_network_q as $list){
            $network_q[] = $list->id;
        }
    }
    $date = date('Y-m-d', strtotime('-7 days'));
    $min_date = date_min($date);
    $q = DB::table('funds_transfer_log')->whereIn('userid',[$network_q])->whereBetween('mindate',[$min_date, date('Ymd')])->sum('amount');
    if($q > 0){
        $total = $q;
    }
    return $total;
}
function count_total_network_transfer_thismonth($uid)
{
    $total = 0;
    $my_network_q = DB::table('merchant')->where('refer_uid',$uid)->get();
    if(!empty($my_network_q)){
        $network_q = array();
        foreach($my_network_q as $list){
            $network_q[] = $list->id;
        }
    }
    $fromdate = date('Y-m')."-1";
        $frommin = date_min($fromdate);
        $a_date = date('Y-m-d');
        $todate = date("Y-m-t", strtotime($a_date));
        $tomin = date_min($todate);
    $q = DB::table('funds_transfer_log')->whereIn('userid',[$network_q])->whereBetween('mindate',[$frommin, $tomin])->sum('amount');
    if($q > 0){
        $total = $q;
    }
    return $total;
}
function count_total_network_transfer_cdate($uid,$fdate,$tdate)
{
    $total = 0;
    $my_network_q = DB::table('merchant')->where('refer_uid',$uid)->get();
    if(!empty($my_network_q)){
        $network_q = array();
        foreach($my_network_q as $list){
            $network_q[] = $list->id;
        }
    }
    $q = DB::table('funds_transfer_log')->whereIn('userid',[$network_q])->whereBetween('mindate',[$fdate, $tdate])->sum('amount');
    if($q > 0){
        $total = $q;
    }
    return $total;
}
function count_total_wallet_of_distibutor_for_masterd_distibutor($id = "")
{
    $count = 0;
    if(!empty($id)){
        $total = DB::table('merchant')->where('refer_uid',$id)->where('type',3)->sum('wallet');
        return $total;
    }else{
        return $count;
    }
}
function count_total_wallet_of_mearchant_for_masterd_distibutor($id = "")
{
    $count = 0;
    if(!empty($id)){
        $total = DB::table('merchant')->where('refer_uid',session()->get('userid'))->where('type',1)->sum('wallet');
        return $total;
    }else{
        return $count;
    }
}
function payment_link_option(){
    $data = DB::table('payment_link_option')->get();
    foreach($data as $list){?>
        <option value="<?php echo $list->id?>"><?php echo $list->option_name?></option>
    <?php }
}
function topup_option(){
    $data = DB::table('topup_options')->get();
    foreach($data as $list){?>
        <option value="<?php echo $list->type?>"><?php echo $list->name?></option>
    <?php }
}
function get_peymentgetway_name($id){
    $where = array();
    $where['option_id'] = $id;
    $count_peyment_getway_exist = DB::table('link_wise_payment_getway')->where($where)->count();
    if($count_peyment_getway_exist > 0){
        $linkdata = DB::table('link_wise_payment_getway')->where($where)->first();
        return $linkdata->payment_getway_id;
    }else{
        return 5;
    }
}
function get_uniq_order_id(){
    for(;;){
        // $order_id = 'ORDER-'.rand(1000000,9999999);
        $permitted_chars = 'ABCDEFGHIJKLMNOPQRST0123456789abcdefghijklmnopqrstuvwxyz';
        $order_id = substr(str_shuffle($permitted_chars), 0, 12).time();
        $where = array();
        $where['order_id_rand'] = $order_id;
        $peyment_request_link = DB::table('peyment_request_link')->where($where)->count();
        if($peyment_request_link == 0){
            return $order_id;
            break;
            die();
        }
    }
}
function payment_link_option_name($id){
    $where = array();
    $where['id'] = $id;
    $data = DB::table('payment_link_option')->where($where)->get();    
    return  $data[0]->option_name;
}



function csend_sms(){
  
    $url = "https://payout-gamma.cashfree.com/payout/v1/authorize";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
    "X-Client-Id: 12066663e589a49c4559c6879e666021",
    "X-Client-Secret: TEST766102c075f8c63a8aa4ec1a4435c401ca944ab1",
    "cache-control: no-cache",
    "Content-Length: 0",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    var_dump($resp);

}
function lein_wallet($uid,$amount,$commissionuserid=""){
    $where = array();
    $where['id'] = $uid;
    $exwallet = DB::table('merchant')->where($where)->first();
    $data = array();
    $data['lein_wallet'] = $exwallet->lein_wallet+$amount;
    $total_lein = $exwallet->lein_wallet+$amount;
    $where = array();
    $where['id'] = $uid;
    DB::table('merchant')->where($where)->update($data);
    $data = array();
    $data['uid'] = $uid;
    $data['ammount'] = $amount;
    $data['date'] = date('Y-m-d');
    $data['mindate'] = date('Ymd');
    $data['remark'] = "Commission Earned";
    $data['time'] = date('h:i:s a');
    $data['bal'] = $total_lein;
    $data['type'] = 0;
    if(!empty($commissionuserid)){
    $data['commission_by_id'] = $commissionuserid;
    $data['commission_by_name'] = get_user_name($commissionuserid);
    }
    DB::table('lein_to_wallet_log')->insert($data);
    inset_all_t_log(1,$amount,"Commission Earned",$uid,$total_lein);        
}
function is_check_master_distributer($uid){
    $res = 0;
    $where['id'] = $uid;
    $user_data = DB::table('merchant')->where($where)->first();
    if($user_data->type == 4){
        $res = 1;
    }
    return $res;
}
// function get_base_price_value($planid,$method)
// {
//     $return = 0;
//     $planq = DB::table('plans')->where('id',$planid)->first();
//     if($method == 1){
//         $return = $planq->debit_base_per;
//     }
//     if($method == 2){
//         $return = $planq->netbanking_base_per;
//     }
//     if($method == 3){
//         $return = $planq->upi_base_per;
//     }
//     if($method == 4){
//         $return = $planq->credit_card_base_per;
//     }
//     if($method == 5){
//         $return = $planq->amex_card_base_per;
//     }
//     if($method == 6){
//         $return = $planq->diners_card_base_per;
//     }
//     if($method == 7){
//         $return = $planq->wallet_base_per;
//     }
//     if($method == 8){
//         $return = $planq->corporate_card_base_per;
//     }
//     if($method == 9){
//         $return = $planq->prepaid_card_base_per;
//     }
//     return $return;
// }
function get_base_price_value($planid,$method)
{
    $return = 0;
    if($method == 10){
        $method = 4;
    }
    $planq = DB::table('commition_base_price')->where('option_id',$method)->first();
    if(!empty($planq)){
        $return = $planq->percentage;
    }
    return $return;
}
function bankit_fee_distributed($uid,$bankingamount,$add_money_id){
   $userdata = DB::table('merchant')->where('id',$uid)->first();
   $addmoneylog_data = DB::table('add_money_log')->where('id',$add_money_id)->first();
   $userdata_type = $userdata->type;
   $addmoneylog_data_method = $addmoneylog_data->paymentoption;
   $addmoneylog_data_option = $addmoneylog_data->topuptype;
   $uid_count_tax_rate = get_tax_value($userdata->plan_id,$addmoneylog_data_method,$addmoneylog_data_option);
   $uid_count_base_price = get_base_price_value($userdata->plan_id,$addmoneylog_data_method);
   $userdata_plan_price = get_plan_price($userdata->plan_id);
   $admin_profit_tax_different = $uid_count_tax_rate-$uid_count_base_price;
   $actual_amount_calculate = ($uid_count_tax_rate/100)*$bankingamount;
   $admin_profit_calculate = ($admin_profit_tax_different/100)*$bankingamount;
   if($userdata_type == 4){
        admin_commition_insert($add_money_id,$bankingamount,$actual_amount_calculate,$admin_profit_calculate,$uid);
   }
   if($userdata_type == 3 || $userdata_type == 1){
       if($userdata_type == 3){
        if(!empty($userdata->refer_uid)){
            $refer_uid_data = DB::table('merchant')->where('id',$userdata->refer_uid)->first();
            $refer_uid_data_plan_price = get_plan_price($refer_uid_data->plan_id);
            $refer_uid_count_base_price = get_base_price_value($refer_uid_data->plan_id,$addmoneylog_data_method);
            $refer_uid_count_tax_rate = get_tax_value($refer_uid_data->plan_id,$addmoneylog_data_method,$addmoneylog_data_option);
            if($refer_uid_data_plan_price > $userdata_plan_price){
                $count_tax_different = $uid_count_tax_rate-$refer_uid_count_tax_rate;
                $rest_tax_rate = $uid_count_tax_rate-$count_tax_different;
                $admin_profit_tax_different = $rest_tax_rate-$uid_count_base_price;
                $actual_amount_calculate = ($rest_tax_rate/100)*$bankingamount;
                $admin_profit_calculate = ($admin_profit_tax_different/100)*$bankingamount;
                $refer_uid_commition_amount = ($count_tax_different/100)*$bankingamount;
                $data = array();
                $data['add_money_id'] = $add_money_id;
                $data['distribute_amount'] = $bankingamount;
                $data['master_distributor'] = $refer_uid_commition_amount;
                $data['distributor'] = 0;
                $data['admin_total'] = $actual_amount_calculate;
                $data['admin'] = $admin_profit_calculate;
                $data['getdate'] = date('Ymd');
                $data['user_id'] = $uid;
                $data['user_name'] = get_user_name($uid);
                $data['user_phone'] = get_user_number($uid);
                if($refer_uid_commition_amount > 0){
                $data['md_id'] = $refer_uid_data->id;
                }
                $data['time'] = time();
                DB::table('distribute_logs')->insert($data); 
                if($refer_uid_commition_amount > 0){
                    lein_wallet($refer_uid_data->id,$refer_uid_commition_amount,$uid);
                }
            }else{
                admin_commition_insert($add_money_id,$bankingamount,$actual_amount_calculate,$admin_profit_calculate,$uid);
            }
         }else{
            admin_commition_insert($add_money_id,$bankingamount,$actual_amount_calculate,$admin_profit_calculate,$uid);
         }
       }
       if($userdata_type == 1){
        if(!empty($userdata->refer_uid)){
            $refer_uid_data = DB::table('merchant')->where('id',$userdata->refer_uid)->first();
            $refer_uid_data_plan_price = get_plan_price($refer_uid_data->plan_id);
            $refer_uid_count_base_price = get_base_price_value($refer_uid_data->plan_id,$addmoneylog_data_method);
            $refer_uid_count_tax_rate = get_tax_value($refer_uid_data->plan_id,$addmoneylog_data_method,$addmoneylog_data_option);
            if($refer_uid_data->type == 4){
                if($refer_uid_data_plan_price > $userdata_plan_price){
                    $count_tax_different = $uid_count_tax_rate-$refer_uid_count_tax_rate;
                    $rest_tax_rate = $uid_count_tax_rate-$count_tax_different;
                    $admin_profit_tax_different = $rest_tax_rate-$refer_uid_count_base_price;
                    $actual_amount_calculate = ($rest_tax_rate/100)*$bankingamount;
                    $admin_profit_calculate = ($admin_profit_tax_different/100)*$bankingamount;
                    $refer_uid_commition_amount = ($count_tax_different/100)*$bankingamount;
                    $data = array();
                    $data['add_money_id'] = $add_money_id;
                    $data['distribute_amount'] = $bankingamount;
                    $data['master_distributor'] = $refer_uid_commition_amount;
                    $data['distributor'] = 0;
                    $data['admin_total'] = $actual_amount_calculate;
                    $data['admin'] = $admin_profit_calculate;
                    $data['getdate'] = date('Ymd');
                    $data['user_id'] = $uid;
                    $data['user_name'] = get_user_name($uid);
                    $data['user_phone'] = get_user_number($uid);
                    if($refer_uid_commition_amount > 0){
                        $data['md_id'] = $refer_uid_data->id;
                    }
                    $data['time'] = time();
                    DB::table('distribute_logs')->insert($data); 
                    if($refer_uid_commition_amount > 0){
                    lein_wallet($refer_uid_data->id,$refer_uid_commition_amount,$uid);
                    }
                }else{
                    admin_commition_insert($add_money_id,$bankingamount,$actual_amount_calculate,$admin_profit_calculate,$uid);
                }
            }
            if($refer_uid_data->type == 3){
                if($refer_uid_data_plan_price > $userdata_plan_price){
                    $data = array();
                    $count_tax_different = $uid_count_tax_rate-$refer_uid_count_tax_rate;
                    $rest_tax_rate = $uid_count_tax_rate-$count_tax_different;
                    $admin_profit_tax_different = $rest_tax_rate-$refer_uid_count_base_price;
                    $actual_amount_calculate = ($rest_tax_rate/100)*$bankingamount;
                    $admin_profit_calculate = ($admin_profit_tax_different/100)*$bankingamount;
                    $refer_uid_commition_amount = ($count_tax_different/100)*$bankingamount;
                    if($refer_uid_commition_amount > 0){
                        $data['dis_id'] = $refer_uid_data->id;
                        lein_wallet($refer_uid_data->id,$refer_uid_commition_amount,$uid);
                    }
                    $refer_uid_master_commition_amount = 0;
                    if(!empty($refer_uid_data->refer_uid)){
                        $refer_uid_master = DB::table('merchant')->where('id',$refer_uid_data->refer_uid)->first();
                        $refer_uid_master_plan_price = get_plan_price($refer_uid_master->plan_id);
                        $refer_uid_master_count_base_price = get_base_price_value($refer_uid_master->plan_id,$addmoneylog_data_method);
                        $refer_uid_master_count_tax_rate = get_tax_value($refer_uid_master->plan_id,$addmoneylog_data_method,$addmoneylog_data_option);
                        if($refer_uid_master_plan_price > $refer_uid_data_plan_price){
                            $count_tax_different_master = $refer_uid_count_tax_rate-$refer_uid_master_count_tax_rate;
                            $rest_tax_rate = $rest_tax_rate-$count_tax_different_master;
                            $admin_profit_tax_different = $rest_tax_rate-$refer_uid_master_count_base_price;
                            $actual_amount_calculate = ($rest_tax_rate/100)*$bankingamount;
                            $admin_profit_calculate = ($admin_profit_tax_different/100)*$bankingamount;
                            $refer_uid_master_commition_amount = ($count_tax_different_master/100)*$bankingamount;
                            if($refer_uid_master_commition_amount > 0){
                                $data['md_id'] = $refer_uid_master->id;
                                lein_wallet($refer_uid_master->id,$refer_uid_master_commition_amount,$uid);
                            }
                        }
                    }
                    $data['add_money_id'] = $add_money_id;
                    $data['distribute_amount'] = $bankingamount;
                    $data['master_distributor'] = $refer_uid_master_commition_amount;
                    $data['distributor'] = $refer_uid_commition_amount;
                    $data['admin_total'] = $actual_amount_calculate;
                    $data['admin'] = $admin_profit_calculate;
                    $data['getdate'] = date('Ymd');
                    $data['user_id'] = $uid;
                    $data['user_name'] = get_user_name($uid);
                    $data['user_phone'] = get_user_number($uid);
                    $data['time'] = time();
                    DB::table('distribute_logs')->insert($data); 
                }else if(!empty($refer_uid_data->refer_uid)){
                    $refer_uid_master = DB::table('merchant')->where('id',$refer_uid_data->refer_uid)->first();
                    $refer_uid_master_plan_price = get_plan_price($refer_uid_master->plan_id);
                    $refer_uid_master_count_base_price = get_base_price_value($refer_uid_master->plan_id,$addmoneylog_data_method);
                    $refer_uid_master_count_tax_rate = get_tax_value($refer_uid_master->plan_id,$addmoneylog_data_method,$addmoneylog_data_option);
                    if($refer_uid_master_plan_price > $userdata_plan_price){
                        $count_tax_different_master = $refer_uid_count_tax_rate-$refer_uid_master_count_tax_rate;
                        $rest_tax_rate = $rest_tax_rate-$count_tax_different_master;
                        $admin_profit_tax_different = $rest_tax_rate-$refer_uid_master_count_base_price;
                        $actual_amount_calculate = ($rest_tax_rate/100)*$bankingamount;
                        $admin_profit_calculate = ($admin_profit_tax_different/100)*$bankingamount;
                        $refer_uid_master_commition_amount = ($count_tax_different_master/100)*$bankingamount;                    
                        $data = array();
                        $data['add_money_id'] = $add_money_id;
                        $data['distribute_amount'] = $bankingamount;
                        $data['master_distributor'] = $refer_uid_master_commition_amount;
                        $data['distributor'] = 0;
                        $data['admin_total'] = $actual_amount_calculate;
                        $data['admin'] = $admin_profit_calculate;
                        $data['getdate'] = date('Ymd');
                        $data['user_id'] = $uid;
                        $data['user_name'] = get_user_name($uid);
                        $data['user_phone'] = get_user_number($uid);
                        if($refer_uid_master_commition_amount > 0){
                            $data['md_id'] = $refer_uid_master->id;
                        }
                        $data['time'] = time();
                        DB::table('distribute_logs')->insert($data);
                        if($refer_uid_master_commition_amount > 0){ 
                            lein_wallet($refer_uid_master->id,$refer_uid_master_commition_amount,$uid);
                        }
                    }else{
                        admin_commition_insert($add_money_id,$bankingamount,$actual_amount_calculate,$admin_profit_calculate,$uid);     
                    }
                }else{
                    admin_commition_insert($add_money_id,$bankingamount,$actual_amount_calculate,$admin_profit_calculate,$uid);
                }
            }
        }else{
            admin_commition_insert($add_money_id,$bankingamount,$actual_amount_calculate,$admin_profit_calculate,$uid);
         }
       }
   }
}
function admin_commition_insert($add_money_id,$bankingamount,$actual_amount_calculate,$admin_profit_calculate,$uid){
    $data = array();
    $data['add_money_id'] = $add_money_id;
    $data['distribute_amount'] = $bankingamount;
    $data['master_distributor'] = 0;
    $data['distributor'] = 0;
    $data['admin'] = $admin_profit_calculate;
    $data['admin_total'] = $actual_amount_calculate;
    $data['getdate'] = date('Ymd');
    $data['user_id'] = $uid;
    $data['user_name'] = get_user_name($uid);
    $data['user_phone'] = get_user_number($uid);
    $data['time'] = time();
    DB::table('distribute_logs')->insert($data);  
}
function get_plan_price_by_uid($uid){
    $where = array();
    $where['id'] = $uid;
    $merchant = DB::table('merchant')->where($where)->first();
    return $merchant->plan_id;
}
function check_is_enabe_pm($mid,$uid){
    $d = 0;
    $check = DB::table('merchant')->where('id',$uid)->first();
    if($mid == 1){
        $d = $check->debit;
    }
    if($mid == 2){
        $d = $check->netbanking;
    }
    if($mid == 3){
        $d = $check->upi;
    }
    if($mid == 4){
        $d = $check->credit;
    }
    if($mid == 5){
        $d = $check->amex;
    }
    if($mid == 6){
        $d = $check->diners;
    }
    if($mid == 7){
        $d = $check->wallet_option;
    }
    if($mid == 8){
        $d = $check->corporate;
    }
    if($mid == 9){
        $d = $check->prepaid;
    }
    if($mid == 10){
        $d = $check->credit_card1;
    }
    return $d;
}
function check_amount_or_cashback($type,$amount){
    $response = array();
    $where = array();
    $discountcashback = DB::table('discountcashback')->where([
        ['utype', '=', $type],
        ['target_amount', '>',$amount],
    ])->orderBy('target_amount','ASC')->first();
    $where = array();
    $final_discountcashback = DB::table('discountcashback')->where([
        ['utype', '=', $type],
        ['target_amount', '<', $discountcashback->target_amount],
    ])->orderBy('target_amount','DESC')->first();
    $target_amount = $final_discountcashback->target_amount;
    $discount_amount = 0;
    $discount_type = "";
    if($final_discountcashback->flat > 0){
        $discount_amount = $final_discountcashback->flat;    
        $discount_type = 'f';
    }else if($final_discountcashback->discount > 0){
        $discount_amount = $final_discountcashback->discount;    
        $discount_type = 'd';
    }
    if($discount_amount > 0 ){
        $response = array('target_amount'=>$target_amount,'discount_type'=>$discount_type,'discount_amount'=>$discount_amount);    
    }
    return $response;
}
function count_master_distributor_totalcashback($id){
    $where = array();
    $where['refer_uid'] = $id;
    $total = 0;
    $merchants = DB::table('merchant')->where($where)->get();
    foreach($merchants as $list){
        if($list->type == 3){
            $income = DB::table('merchant')->where('refer_uid',$list->id)->where('type',1)->sum('wallet');      
            $total = $total+$income+$list->wallet;
        }
    }
     $where = array();
     $where['refer_uid'] = $id;
     $where['type'] = 1;
     $marchent_total = DB::table('merchant')->where($where)->sum('wallet');
     return $total+$marchent_total;
}
function check_is_already_get($amount,$id){
   $count_td = DB::table('discountcashback')->where([
        ['uid', '=',$id],
        ['target_amount', '>',$amount],
    ])->count();
    return $count_td;
}
function cashbackdistributated(){
    $cdata = date('Ymd');
    $loopdata = DB::table('merchant')->get();
foreach($loopdata as $list){
    $id = $list->id;
    $where = array();
    $where['id'] = $id;
    $get_user_data = DB::table('merchant')->where($where)->first();
    $user_type = $get_user_data->type;
    $final_type = 0;
    if($user_type== 3){
        $final_type = 1;
    }
    if($user_type== 4){
        $final_type = 2;
    }
    $where = array();    
    $where['utype'] = $final_type;
    $discountcashback = DB::table('discountcashback')->where($where)->first();
    if($discountcashback->status ==1){
        if($final_type == 1){
            if($cdata >= $discountcashback->mfd && $cdata <= $discountcashback->mtd){
             $amount_count = count_total_wallet($id);
             if($amount_count > 0){
                 $response_data = check_amount_or_cashback($final_type,$amount_count);
                 $check_is_already_get = check_is_already_get($response_data['target_amount'],$id);
                 if($check_is_already_get < 1){
                 $response_count = count($response_data);
                     if($response_count > 0){
                        $update_amount = 0;
                         if($response_data['discount_type'] == 'f'){
                                $update_amount = $response_data['discount_amount'];
                         }else if($response_data['discount_type'] == 'd'){
                             $discount_amount = $response_data['discount_amount'];
                             $update_amount = $amount_count*$discount_amount/100;
                         }  
                         $data = array();
                         $data['amount'] = $amount_count;
                         $data['getdate'] =   date('Ymd');
                         $data['uid'] = $id;
                         $data['base_amount'] = $response_data['target_amount'];
                         $data['get_amount_type'] = $response_data['discount_type'];
                         DB::table('cashbackincome')->insert($data);
                         lein_wallet($id,$update_amount);
                     }
                 }
             }
             
            }
        }else if($final_type == 2){
            if($cdata >= $discountcashback->mfd && $cdata <= $discountcashback->mtd){
             $amount_count = count_master_distributor_totalcashback($id);
             if($amount_count > 0){
                 $response_data = check_amount_or_cashback($final_type,$amount_count);
                 $response_count = count($response_data);
                 $check_is_already_get = check_is_already_get($response_data['target_amount'],$id);
                 if($check_is_already_get < 1){
                 if($response_count > 0){
                        $update_amount = 0;
                         if($response_data['discount_type'] == 'f'){
                                $update_amount = $response_data['discount_amount'];
                         }else if($response_data['discount_type'] == 'd'){
                             $discount_amount = $response_data['discount_amount'];
                             $update_amount = $amount_count*$discount_amount/100;
                         }  
                         $data = array();
                         $data['amount'] = $update_amount;
                         $data['getdate'] =   date('Ymd');
                         $data['uid'] = $id;
                         $data['base_amount'] = $response_data['target_amount'];
                         $data['get_amount_type'] = $response_data['discount_type'];
                         DB::table('cashbackincome')->insert($data);
                         lein_wallet($id,$update_amount);
                     }
                 }
             }
            }
        }
    }
}
}
function get_plan_day_limit($uid=""){
    $amount = 0;
    if(!empty($uid)){
        $c_plan_id = get_user_curent_planid($uid);
        if(!empty($c_plan_id)){
            $plan_q = get_plan_data($c_plan_id);
            $amount =  $plan_q->limit_per_day;
        }
    }
    return $amount;
}
function get_total_today_amount($uid =""){
    $amount = 0;
    if(!empty($uid)){
        $today = date('Y-m-d');
        $total = DB::table('add_money_log')->where('userid',$uid)->where('date',$today)->where('is_fail',0)->where('is_added','!=',3)->sum('amount');
        $amount = $total;
    }
    return $amount;
}
function get_total_monthly_amount($uid =""){
    $amount = 0;
    if(!empty($uid)){
        $fromdate = date('Y-m')."-1";
        $frommin = date_min($fromdate);
        $a_date = date('Y-m-d');
        $todate = date("Y-m-t", strtotime($a_date));
        $tomin = date_min($todate);
        $total = DB::table('add_money_log')->where('userid',$uid)->where('is_fail',0)->where('is_added','!=',3)->whereBetween('min_date', [$frommin, $tomin])->sum('amount');
        $amount = $total;
    }
    return $amount;
}
function dateu($date){
	$date       =   explode("-",$date);
	$new_date   =   $date[2]."-".$date[1]."-".$date[0];
	return $new_date;
}
function datedbu($datedb){
	$year = substr($datedb, 0,4);
	$month = substr($datedb, 4,2);
	$day  = substr($datedb, 6,2);
	return $day."-".$month."-".$year;
}
function date_min($date){
	$date = explode("-",$date);
	if ($date[1]<9) {
		$date[1] = '0'.(int)($date[1]);
	}
	if($date[2]<9){
		$date[2] = '0'.(int)($date[2]);
	}
	return $date[0].$date[1].$date[2];
}
function get_plan_monthy_limit($uid=""){
    $amount = 0;
    if(!empty($uid)){
        $c_plan_id = get_user_curent_planid($uid);
        if(!empty($c_plan_id)){
            $plan_q = get_plan_data($c_plan_id);
            $amount =  $plan_q->monthly_limit;
        }
    }
    return $amount;
}
function check_is_tpin_genrated($uid="")
{
    $return = 0;
    if(!empty($uid)){
        $check = DB::table('merchant')->where('id',$uid)->first();
        if(!empty($check)){
            $tpin = $check->transactionpin;
            if($tpin != NULL){
                $return = 1;
            }
        }
    }
    return $return;
}
function get_rez_key(){
    $q = DB::table('pay_keys')->first();
    $data = $q->rez_key;
    return $data;
}
function get_rez_sec_key(){
    $q = DB::table('pay_keys')->first();
    $data = $q->rez_sec_key;
    return $data;  
}
function count_my_merchant_network($uid=""){
    $count = "";
    if(!empty($uid)){
        $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',1)->count();
        $count = $q;
    }
    return $count;
}
function count_my_merchant_network_today($uid=""){
    $count = "";
    if(!empty($uid)){
        $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',1)->where('mindate',date('Ymd'))->count();
        $count = $q;
    }
    return $count;
}
function count_my_merchant_network_sevendays($uid=""){
    $count = "";
    if(!empty($uid)){
        $date = date('Y-m-d', strtotime('-7 days'));
        $min_date = date_min($date);
        $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',1)->whereBetween('mindate',[$min_date, date('Ymd')])->count();
        $count = $q;
    }
    return $count;
}
function count_my_merchant_network_thismonth($uid=""){
    $count = "";
    if(!empty($uid)){
        $fromdate = date('Y-m')."-1";
        $frommin = date_min($fromdate);
        $a_date = date('Y-m-d');
        $todate = date("Y-m-t", strtotime($a_date));
        $tomin = date_min($todate);
        $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',1)->whereBetween('mindate',[$frommin, $tomin])->count();
        $count = $q;
    }
    return $count;
}
function count_my_distibutor_network($uid=""){
    $count = "";
    if(!empty($uid)){
        $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',3)->count();
        $count = $q;
    }
    return $count;
}
function count_my_distibutor_network_today($uid=""){
    $count = "";
    if(!empty($uid)){
        $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',3)->where('mindate',date('Ymd'))->count();
        $count = $q;
    }
    return $count;
}
function count_my_distibutor_network_sevendays($uid=""){
    $count = "";
    if(!empty($uid)){
        $date = date('Y-m-d', strtotime('-7 days'));
        $min_date = date_min($date);
        $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',3)->whereBetween('mindate',[$min_date, date('Ymd')])->count();
        $count = $q;
    }
    return $count;
}
function count_my_distibutor_network_thismonth($uid=""){
    $count = "";
    if(!empty($uid)){
        $fromdate = date('Y-m')."-1";
        $frommin = date_min($fromdate);
        $a_date = date('Y-m-d');
        $todate = date("Y-m-t", strtotime($a_date));
        $tomin = date_min($todate);
        $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',3)->whereBetween('mindate',[$frommin, $tomin])->count();
        $count = $q;
    }
    return $count;
}
function count_my_distibutor_network_cdate($uid,$fdate,$tdate){
    $count = "";
    if(!empty($uid)){
        $q = DB::table('merchant')->where('refer_uid',$uid)->where('type',3)->whereBetween('mindate',[$fdate, $tdate])->count();
        $count = $q;
    }
    return $count;
}
function addwalletcronjob()
{
    $q = DB::table('add_money_log')->where('is_added',0)->where('is_fail',0)->where('is_capture',1)->get();
    if(!empty($q)){
        foreach($q as $list){
            $time = time();
            if($time > $list->timestamp){
                $userq = DB::table('merchant')->where('id',$list->userid)->first();
                if(!empty($userq)){
                    $data = array();
                    if($list->is_lein_wallet == 1){
                        $add_array = array();
                        $add_array['txn_id'] = $list->payment_id;
                        $add_array['amount'] = $list->total_amount;
                        $add_array['uid'] = $userq->id;
                        $add_array['per_balance'] = $userq->lein_wallet;
                        $add_array['post_balance'] = $userq->lein_wallet+$list->total_amount;
                        $add_array['type'] = 2;
                        $add_array['error_from'] = 1;
                        insert_wallet_log($add_array);
                        $data['lein_wallet'] = $userq->lein_wallet+$list->total_amount;
                    }else{
                        $add_array = array();
                        $add_array['txn_id'] = $list->payment_id;
                        $add_array['amount'] = $list->total_amount;
                        $add_array['uid'] = $userq->id;
                        $add_array['per_balance'] = $userq->wallet;
                        $add_array['post_balance'] = $userq->wallet+$list->total_amount;
                        $add_array['type'] = 1;
                        $add_array['error_from'] = 1;
                        insert_wallet_log($add_array);
                        $data['wallet'] = $userq->wallet+$list->total_amount;
                        inset_all_t_log(1,$list->amount,"Add Wallet",$userq->id,$userq->wallet+$list->amount,"");
                        inset_all_t_log(2,$list->bankit_fee,"Processing Fee",$userq->id,$userq->wallet+$list->total_amount,"");
                    }
                    DB::table('merchant')->where('id',$userq->id)->update($data);
                    DB::table('add_money_log')->where('id',$list->id)->update(['is_added'=>1]);
                }
            }
        }   
    }
    $cashfree_chek_q = DB::table('add_money_log')->where('method_type',2)->where('is_capture',2)->whereNull('is_added')->get();
    foreach($cashfree_chek_q as $list){
        $now_time = time();
        if($now_time > $list->start_timestamp){
        $get_key = DB::table('gateway_key')->where('type',$list->method_type)->first();
        $udata = get_company_all_data_byid($list->userid);
        if(!empty($get_key)){
            $appkey = $get_key->appkey;
            $secretkey = $get_key->secretkey;
            if(!empty($appkey) && !empty($secretkey)){
                $order = new Order(); 
                $response = $order->getStatus('S9FutADkjPTi1648705940');
                if(!empty($response) && $response->status != "ERROR"){
                    if($response->orderStatus == "PAID"){
                    $data = array();
                    $hdata = array();
                    $data['paymentmode'] = $response->paymentMode;
                    $hdata['addwallet_method'] = $response->paymentMode;
                    $data['status_text'] = $response->txStatus;
                    $data['response_msg'] = $response->txMsg;
                    if($response->txStatus == "SUCCESS"){
                        $data['is_capture'] = 1;
                        $data['is_fail'] = 0;
                        if(!empty($response->referenceId)){
                            $data['referenceid'] = $response->referenceId;   
                        }
                        if($list->topuptype == 0){
                            $data['is_added'] = 0;
                            bankit_fee_distributed($list->userid,$list->amount,$list->id);
                            $data['timestamp'] = time();
                            if(!empty($response->referenceId)){
                                $hdata['utrid'] = $response->referenceId;   
                            }
                            $hdata['txn_status'] = 1;
                        }else{
                            $data['is_added'] = 0;
                            bankit_fee_distributed($list->userid,$list->amount,$list->id);
                            if($list->topuptype == 1){
                                $data['timestamp'] = time() + (60 * 60 * 48);
                            }
                            if($list->topuptype == 2){
                                $data['timestamp'] = time() + (60 * 60 * 72);
                            }
                            if($list->topuptype == 3){
                                $data['timestamp'] = time() + (60 * 60 * $tzero);
                            }
                        }
                        }else if($response->txStatus == "FAILED"){
                            $data['is_capture'] = 1;
                            $data['is_added'] = 3;
                            $data['is_fail'] = 1;
                            if(!empty($response->referenceId)){
                                $data['referenceid'] = $response->referenceId;   
                            }
                            if(!empty($response->referenceId)){
                                $hdata['utrid'] = $response->referenceId;   
                            }
                            $hdata['txn_status'] = 2;
                        }else{
                            $data['status_text'] = $response->txStatus;
                            $data['response_msg'] = $response->txMsg;
                        }
                        DB::table('add_money_log')->where('id',$list->id)->update($data);
                        $where = array();
                        $where['lastid'] = $list->id;
                        $historyid = update_history($hdata,$where);
                    }else if($response->orderStatus == "EXPIRED"){
                        DB::table('add_money_log')->where('id',$list->id)->update(['is_fail'=>1,'is_capture'=>1,'is_added'=>3]);
                        $data = array();
                        $data['txn_status'] = 2;
                        $where = array();
                        $where['lastid'] = $list->id;
                        $historyid = update_history($hdata,$where);
                    }
                }else{
                    DB::table('add_money_log')->where('id',$list->id)->update(['is_fail'=>1,'is_capture'=>1,'is_added'=>3]);
                }
            }
        }
    }
    }
    $rezorpay_chek_q = DB::table('add_money_log')->where('method_type',1)->whereNull('is_capture')->whereNull('is_added')->where('is_fail',0)->get();
    foreach($rezorpay_chek_q as $list){
        $get_key = DB::table('gateway_key')->where('type',$list->method_type)->first();
        $udata = get_company_all_data_byid($list->userid);
        $rezorpay_api_key = get_rezorpay_api_kyes();
        if(($rezorpay_api_key)){
            $appkey = $rezorpay_api_key['appkey'];
            $secretkey = $rezorpay_api_key['secretkey'];
            if(!empty($appkey) && !empty($secretkey)){
                $api = new Api($appkey, $secretkey);
                $response = $api->payment->fetch($list->payment_id);
                if($response){
                    $data = array();
                    if($response['status'] == "failed"){
                        $data['is_fail'] = 1;
                        $data['is_added'] = 3;
                        $data['is_capture'] = 1;
                        if(!empty($response['error_reason'])){
                            $data['response_msg'] = $response['error_reason'];
                        }
                    }else if($response['status'] == "captured"){
                        $data['is_fail'] = 0;
                        $data['is_added'] = 0;
                        $data['is_capture'] = 1;
                        $data['timestamp'] = time();
                    }else if($response['status'] == "authorized"){
                        $capture_response = $api->payment->fetch($list->payment_id)->capture(array('amount'=>$list->amount*100,'currency' => 'INR'));
                        if($capture_response['captured']){
                            $data['is_capture'] = 1;
                            $data['is_fail'] = 0;
                            $data['is_added'] = 0;
                            $data['timestamp'] = time();
                        }
                    }else if($response['status'] == "refunded"){
                        $data['is_capture'] = 1;
                        $data['is_fail'] = 0;
                        $data['is_added'] = 4;
                    }
                    if(!empty($response['status'])){
                        $data['status_text'] = $response['status'];
                    }
                    if(!empty($response['method'])){
                        $data['paymentmode'] = $response['method'];
                    }
                    DB::table('add_money_log')->where('id',$list->id)->update($data);
                }
            }
        }
    }
}
function verifyBankAccount($data){
    try{
        $token = getToken();
        $bankDetails = $data;
        $baseurl = config('global.cashfreeutl');
        $urls = config('global.bankValidation');
        $query_string = "?";

        foreach($bankDetails as $key => $value){
            $query_string = $query_string.$key.'='.$value.'&';
        }

        $finalUrl = $baseurl.$urls.substr($query_string, 0, -1);
        $response = get_helper($finalUrl, $token);
        return $response;
    }
    catch(Exception $ex){
        $data = array();
        $data['error_msg_id'] = $ex->getMessage();
        return $data;
        die();
    }
}
function getBeneficiarydata($data)
{
    $token = getToken();
    $bankDetails = $data;
    try{
        $baseurl = config('global.cashfreeutl');
        $urls = config('global.getBenedata');
        $query_string = "?";

        foreach($bankDetails as $key => $value){
            $query_string = $query_string.$key.'='.$value.'&';
        }

        $finalUrl = $baseurl.$urls.substr($query_string, 0, -1);
        $response = get_helper($finalUrl, $token);
        return $response;
    }
    catch(Exception $ex){
        $data = array();
        $data['status'] = "ERROR";
        $data['error_msg'] = $ex->getMessage();
        $data['error_code'] = $ex->getCode();
        return $data;
        die();
    }
}
function getBeneficiarydata_byid($id)
{
    $token = getToken();
    try{
        $baseurl = config('global.cashfreeutl');
        $urls = config('global.getBene');
        $fullurl = $baseurl.$urls.$id;
        $response = get_helper($fullurl, $token);
        return $response;
    }
    catch(Exception $ex){
        return $ex->getMessage();
        die();
    }
}
function requestTransfer($data){
    try{
        $token = getToken();
        $response = post_helper('requestTransfer', $data, $token);
        return 1;
    }
    catch(Exception $ex){
        $msg = $ex->getCode();
        if($msg == 201 || $msg == 202){
            return $msg; 
        }else{
            return $ex->getMessage();
        }   
        die();
    }
}
function getTransferStatus($transfer){
    $token = getToken();
    $baseurl = config('global.cashfreeutl');
    $urls = config('global.getTransferStatus');
    try{
        $transferId = $transfer['transferId'];
        $finalUrl = $baseurl.$urls.$transferId;
        $response = get_helper($finalUrl, $token);
        return $response;
    }
    catch(Exception $ex){
        $msg = $ex->getCode();
        return $msg; 
        die();
    }
}

function get_helper($finalUrl, $token){
    $headers = create_header($token);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $finalUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
    
    $r = curl_exec($ch);
    
    if(curl_errno($ch)){
        print('error in posting');
        print(curl_error($ch));
        die();
    }
    curl_close($ch);

    $rObj = json_decode($r, true);    
    if($rObj['status'] != 'SUCCESS' || $rObj['subCode'] != '200') throw new Exception($rObj['message'],$rObj['subCode']);
    return $rObj;
}
function addBeneficiary($data){
    $token = getToken();
    try{
        $beneficiary = $data;
        $response = post_helper('addBene', $beneficiary, $token);
        return $response;
    }
    catch(Exception $ex){
        $data = array();
        $data['status'] = "ERROR";
        $data['error_msg'] = $ex->getMessage();
        $data['error_code'] = $ex->getCode();
        return $data;
        die();
    }    
}
function removeBeneficiary($data){
    $token = getToken();
    try{
        $beneficiary = $data;
        $response = post_helper('removeBene', $beneficiary, $token);
        return 1;
    }
    catch(Exception $ex){
        $msg = $ex->getMessage();
        return $msg;
        die();
    }    
}
function getSignature()
{
    $clientId = "CF127611C8GBE22F3KT4N5J3K1OG";
    $publicKey = openssl_pkey_get_public(file_get_contents(asset('accountId_9323_public_key.pem')));
    $encodedData = $clientId.".".strtotime("now");
    return encrypt_RSA($encodedData, $publicKey);
}
function encrypt_RSA($plainData, $publicKey) {
    if (openssl_public_encrypt($plainData, $encrypted, $publicKey,OPENSSL_PKCS1_OAEP_PADDING))
          $encryptedData = base64_encode($encrypted);
        else return NULL;
        return $encryptedData;
    }
function getToken(){
    try{
       $response = post_helper('auth', null, null);
       return $response['data']['token'];
    }
    catch(Exception $ex){
        return $ex->getMessage();
        die();
    }
}
function create_header($token){
    $api_key = DB::table('gateway_key')->where('type',2)->first();
    $sig = getSignature();
    $header = array(
        "X-Client-Id: ".$api_key->payout_appkey,
        "X-Client-Secret: ".$api_key->payout_secretkey, 
        "X-Cf-Signature:".$sig,
        "Content-Type: application/json",
    );
    $headers = $header;
    if(!is_null($token)){
        array_push($headers, 'Authorization: Bearer '.$token);
    }
    return $headers;
}
// function create_header($token){
//     $api_key = DB::table('gateway_key')->where('type',2)->first();
//     // $sig = getSignature();
//     // "X-Cf-Signature:".$sig,
//     $header = array(
//         "X-Client-Id: ".$api_key->payout_appkey,
//         "X-Client-Secret: ".$api_key->payout_secretkey, 
//         "Content-Type: application/json",
//     );
//     $headers = $header;
//     if(!is_null($token)){
//         array_push($headers, 'Authorization: Bearer '.$token);
//     }
//     return $headers;
// }
function post_helper($action, $data, $token){
    $baseurl = config('global.cashfreeutl');
    $url = config('global.'.$action);
    $finalUrl = $baseurl.$url;
    $headers = create_header($token);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $finalUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
    if(!is_null($data)) curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
    
    $r = curl_exec($ch);
    
    if(curl_errno($ch)){
        print('error in posting');
        print(curl_error($ch));
        die();
    }
    curl_close($ch);
    $rObj = json_decode($r, true);    
    if($rObj['status'] != 'SUCCESS' || $rObj['subCode'] != '200') throw new Exception($rObj['message'],$rObj['subCode']);
    return $rObj;
}

function get_payment_methods($id){
    $data = "";
    if(!empty($id)){
         $q = DB::table('payment_options')->where('id',$id)->first();
         if(!empty($q)){
            $data = $q->option_name;
         }
    }
    return $data;

}
function get_payment_options($id){
    $data = "";
    $q = DB::table('topup_options')->where('type',$id)->first();
    $data = $q->name;
    return $data;
}
function bank_account_addfees()
{
    $total = 0;
    $q = DB::table('add_account_charges')->first();
    if(!empty($q)){
        $total = $q->amount;
    }
    return $total;
}
function count_nft($uid){
    $notification = DB::table('notification')->where('uid',$uid)->where('view',0)->orderBy('id','DESC')->count();
    return $notification;
}
function check_is_reffer_user($uid=""){
    $count = "";
    if(!empty($uid)){
        $q = DB::table('merchant')->where('id',$uid)->first();
        if(!empty($q)){
            $count = 0;
            if(!empty($q->refer_uid)){
                $count = 1;     
            }
        }
    }
    return $count;
}
function get_pay_type($id)
{
    $return =  $id;
    if($id == 1){
        $return = "IMPS";
    }
    if($id == 2){
        $return = "NEFT";
    }
    if($id == 3){
        $return = "RTGS";
    }
    return $return;
}
function payystatus_check_cronjob()
{
    $rezorpayq = DB::table('payout')->where('status',0)->where('gatway_type',1)->where('payee_action_proced',0)->get();
    foreach($rezorpayq as $list){
        if(!empty($list->transferid)){
            $all_tranaction_data = rezorpay_paye_details($list->transferid);
            if(empty($all_tranaction_data['error']['description'])){
                $data  = array();
                if(!empty($all_tranaction_data['reference_id'])){
                    $data['referenceId'] = $all_tranaction_data['reference_id'];
                }
                if(!empty($all_tranaction_data['utr'])){
                    $data['uti'] = $all_tranaction_data['utr'];
                }
                if(!empty($all_tranaction_data['status'])){
                    if($all_tranaction_data['status'] == "processed"){
                        $data['status'] = 1;
                        $data['status_text'] = "Success";
                        $data['payee_action_proced'] = 1;
                    }
                    // else if($all_tranaction_data['status'] == "cancelled" || $all_tranaction_data['status'] == "rejected"){
                    //     $insert_data = array();
                    //     $userq = get_company_all_data_byid($list->uid);
                    //     $count_total_amount = $list->tax+$list->amount;
                    //     $count_total_bal = $userq->wallet+$count_total_amount;
                    //     DB::table('merchant')->where('id',$list->uid)->update(['wallet'=>$count_total_bal]);
                    //     inset_all_t_log(1,$count_total_amount,"Payout amount refuned",$list->uid,$count_total_bal,"");
                    //     $data['status'] = 2;
                    //     $data['payee_action_proced'] = 1;
                    //     $data['status_text'] = $all_tranaction_data['status'];
                    // }
                    else{
                        $data['status'] = 0;
                        $data['payee_action_proced'] = 0;
                        $data['status_text'] = $all_tranaction_data['status'];
                    }
                }
                DB::table('payout')->where('id',$list->id)->update($data);
            }
        }
    }
    $q = DB::table('payout')->where('status',0)->where('gatway_type',2)->get();
    foreach($q as $list){
        if(!empty($list->transferid)){
            $transfer = array();
            $transfer = array(
                'transferId' => $list->transferid,
            );
            $all_tranaction_data = getTransferStatus($transfer);
            if($all_tranaction_data['subCode'] == 200){
                $data  = array();
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
                DB::table('payout')->where('id',$list->id)->update($data);
            }
        }
        $data = getTransferStatus($transfer);
    }
}
function count_payout_amount_transfer($uid=""){
    $total = 0;
    if(!empty($uid)){
        $total = DB::table('payout')->where('uid',$uid)->sum('amount');
    }
    return $total; 
}
function count_payout_amount_transfer_today($uid=""){
    $total = 0;
    if(!empty($uid)){
        $total = DB::table('payout')->where('uid',$uid)->where('mindate',date('Ymd'))->where('status',1)->sum('amount');
    }
    return $total; 
}
function count_no_of_payout_today($uid=""){
    $total = 0;
    if(!empty($uid)){
        $total = DB::table('payout')->where('uid',$uid)->where('mindate',date('Ymd'))->where('status',1)->count();
    }
    return $total; 
}
function count_no_of_payout($uid=""){
    $total = 0;
    if(!empty($uid)){
        $total = DB::table('payout')->where('uid',$uid)->count();
    }
    return $total; 
}
function get_payment_gateway_name($id){
    $msg = "";
    $q = DB::table('payment_getway')->where('id',$id)->first();
    if(!empty($q)){
        return $q->payment_getway_name;
    }else{
        return $msg;
    }
}
function get_payout_type(){
    $active_type = 1;
    $active_payout = DB::table('active_payout_type')->first();
    if(!empty($active_payout)){
        $active_type = $active_payout->type;
    }
    return $active_type;
}
function rezorpay_create_contact($data,$action)
{
    $link = "https://api.razorpay.com/v1/";
    $url = $link.$action;
    $response = rezorpay_helper($data,$url);
    return $response;
}
function rezorpay_bankadd($data,$action)
{
    $link = "https://api.razorpay.com/v1/";
    $url = $link.$action;
    $response = rezorpay_helper(http_build_query($data),$url);
    return $response;
}
function rezorpay_bank_validation($data,$action)
{
    $link = "https://api.razorpay.com/v1/";
    $url = $link.$action;
    $response = rezorpay_helper(http_build_query($data),$url);
    return $response;
}
function rezorpay_create_paye($data,$action){
    $link = "https://api.razorpay.com/v1/";
    $url = $link.$action;
    $response = rezorpay_helper(http_build_query($data),$url);
    return $response;
}
function rezorpay_acount_validation_details($id){
    $link = "https://api.razorpay.com/v1/fund_accounts/validations/";
    $url = $link.$id;
    $response = rezorpay_get_helper($url);
    return $response;
}
function rezorpay_paye_details($payid){
    $link = "https://api.razorpay.com/v1/payouts/";
    $url = $link.$payid;
    $response = rezorpay_get_helper($url);
    return $response;
}
function rezorpay_helper($data,$url)
{   
        $my_kye = get_rezorpay_api_kyes();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_USERPWD, $my_kye['appkey'] . ':' . $my_kye['secretkey']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        $server_output = curl_exec($ch);
        $rObj = json_decode($server_output, true);
        return $rObj;
        curl_close ($ch);
}
function rezorpay_get_helper($url){
        $my_kye = get_rezorpay_api_kyes();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $my_kye['appkey'] . ':' . $my_kye['secretkey']);
        curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        $rObj = json_decode($server_output, true);
        return $rObj;
        curl_close ($ch);
}
function bank_acount_varification_status()
{
    $q = DB::table('merchant_bank_accounts')->where('bank_varify_status_type',0)->get();
    foreach($q as $list){
        if(!empty($list->bank_varify_id)){
            $bank_validation_check = rezorpay_acount_validation_details($list->bank_varify_id);
            if(!empty($bank_validation_check)){
                $data = array();
                $data['bank_varify_status'] = $bank_validation_check['status'];
                if($bank_validation_check['status'] == "completed"){
                    $data['bank_varify_status_type'] = 1;
                }
                if(!empty($bank_validation_check['id'])){
                    $data['bank_varify_id'] = $bank_validation_check['id'];
                }
                if(!empty($bank_validation_check['utr'])){
                    $data['bank_varify_uti'] = $bank_validation_check['utr'];
                }
                if(!empty($bank_validation_check['fund_account']['details']['name'])){
                    $data['varify_user_name'] = $bank_validation_check['fund_account']['details']['name'];
                }
                if(!empty($bank_validation_check['fund_account']['details']['bank_name'])){
                    $data['varify_bank_name'] = $bank_validation_check['fund_account']['details']['bank_name'];
                }
                if(!empty($bank_validation_check['results']['account_status'])){
                    $data['bank_account_status'] = $bank_validation_check['results']['account_status'];
                }
                DB::table('merchant_bank_accounts')->where('id',$list->id)->update($data);
            }
        }
    }
}
function get_rezorpay_api_kyes()
{
    $q = DB::table('gateway_key')->where('type',1)->first();
    $data = array();
    $data['appkey'] = $q->appkey;
    $data['secretkey'] = $q->secretkey;
    $data['account_number'] = $q->payout_appkey;
    return $data;
}
function insert_notification($array)
{
    $data = $array;
    $data['time'] = time();
    $data['date'] = date('Ymd');
    $data['real_date'] = date('d-m-Y');
    $data['real_time'] = date('h:i:s a');
    $data['view'] = 0;
    DB::table('notification')->insert($data);
}
function update_history($array,$where)
{
    $data = $array;
    if(!empty($data['txn_status'])){
        $data['txn_status_text'] = get_txn_status($data['txn_status']);
    }
    DB::table('history')->where($where)->update($data);
}
function insert_history($array)
{
    $chars = 'ABefghijklmnoCDEFGHIJKLMNOPQRST0123456789abcdefghijklmnopqrstuvwxyz';
    $helyi_id = substr(str_shuffle($chars), 0, 10).date('His').rand(100,999);
    $data = $array;
    $data['helyiid'] = $helyi_id;
    if(isset($data['is_admin'])){
        $data['is_admin'] = 1;
    }else{
        $data['is_admin'] = 0;
    }
    if(!empty($data['action'])){
        if($data['action'] == 1){
            $data['cr_dr_text'] = "CREDIT";
        }
        if($data['action'] == 2){
            $data['cr_dr_text'] = "DEBIT";       
        }
    }
    if(!empty($data['txn_status'])){
        $data['txn_status_text'] = get_txn_status($data['txn_status']);
    }
    if(!empty($data['uid'])){
        $udata = get_company_all_data_byid($data['uid']);
        if(!empty($udata)){ 
            $data['user_name'] = $udata->name;
            $data['user_phone'] = $udata->mobile;
            $data['user_type'] = $udata->type;
        }
    }
    if(!empty($data['sender_uid'])){
        $sender_data = get_company_all_data_byid($data['sender_uid']);
        if(!empty($udata)){
            $data['sender_name'] = $sender_data->name;       
            $data['sender_phone'] = $sender_data->mobile;       
            $data['sender_type'] = $sender_data->type;       
        }
    }
    if(!empty($data['recv_uid'])){
        $recv_data = get_company_all_data_byid($data['recv_uid']);
        if(!empty($udata)){
            $data['recv_name'] = $recv_data->name;       
            $data['recv_phone'] = $recv_data->mobile;       
            $data['recv_type'] = $recv_data->type;      
        }
    }
    $data['date'] = date('m-d-Y');
    $data['mindate'] = date('Ymd');
    $data['time'] = time();
    $data['mintime'] = date('h:i:s a');
    DB::table('history')->insert($data);
}
function get_txn_status($id="")
{
    $data = "";
    $check = DB::table('satus_table')->where('code',$id)->first();
    if($check){
        if($check->name){
            $data = $check->name;
        }
    }
    return $data;
}
function check_txntime($txnid)
{
    $res = 1;
    $q = DB::table('add_money_log')->where('payment_id',$txnid)->count();
    if($q > 1){
        $res = 2;
    }
    return $res;
}
function ispayecheck($uid){
    $success = 1;
    $q = DB::table('add_money_log')->where('userid',$uid)->where('is_partially_paid',0)->get();
    foreach($q as $list){
        $res = check_txntime($list->payment_id);
        if($res == 2){
            // echo $list->payment_id;
            // die();
            $success = 2;
            break;
        }
    }
    return $success;
}
function count_data($payment_id){
    $count = DB::table('add_money_log')->where('payment_id',$payment_id)->count();
    return $count; 
}
function count_wallet_add_log($payment_id){
    $count = DB::table('wallet_add_log')->where('txn_id',$payment_id)->count();
    return $count; 
}
function count_skip_wallet_add_log($payment_id){
    $count = DB::table('skip_errorslog')->where('payment_id',$payment_id)->count();
    return $count; 
}
function count_skip_data($payment_id){
    $count = DB::table('skip_errorslog')->where('payment_id',$payment_id)->count();
    return $count; 
}
function tranaction_check_cronjob()
{
    $array = array();
    $query = DB::table('add_money_log')->where('payment_id','!=','undefined')->where('is_added',1)->get();
    $new_query = DB::table('wallet_add_log')->get();
    $new_array = array();
    foreach($new_query as $list){
        if(count_wallet_add_log($list->txn_id) > 1){
           $new_array[] = array('id'=>$list->id,'data'=>$list);
        }
        if(empty($list->txn_id)){
            $new_array[] = array('id'=>$list->id,'data'=>$list);
        }
       }
    foreach($new_array as $item){
        if($item['data']->issent != 1){            
            if(count_skip_wallet_add_log($item['data']->txn_id) > 0){
                $udata = array();
                $udata['uid'] = $item['data']->uid;
                $udata['txnid'] = $item['data']->txn_id;
                $udata['add_money_id'] = $item['data']->id;
                $udata['text'] = "Server error duplicate transaction id";
                $udata['isfix'] = 0;
                $udata['date'] = date('d-m-Y');
                $udata['time'] = date('h:i:s a');
                $udata['mindate'] = date('Ymd');
                $udata['type'] = 1;
                $udata['amount'] = $item['data']->amount;
                DB::table('errorlog')->insert($udata);
                if(empty($item['data']->txn_id)){
                    DB::table('wallet_add_log')->where('id',$item['data']->id)->update(['issent'=>1]);
                }else{
                    DB::table('wallet_add_log')->where('txn_id',$item['data']->txn_id)->update(['issent'=>1]);
                }
                DB::table('merchant')->where('id',$item['data']->uid)->update(['is_active'=>0]);
            }else{
                $data = array();
                $data['payment_id'] = $item['data']->txn_id;
                $data['add_log_id'] = $item['data']->id;
                $data['type'] = 1;
                DB::table('wallet_add_log')->where('txn_id',$item['data']->txn_id)->update(['issent'=>1]);
                DB::table('skip_errorslog')->insert($data);
            }
        }
    }
    foreach($query as $list){
     if(count_data($list->payment_id) > 1){
        $array[] = array('id'=>$list->id,'data'=>$list);
     }
    }
    foreach($array as $item){
        if($item['data']->issent != 1){
            if(count_skip_data($item['data']->payment_id) > 0){
                $udata = array();
                $udata['uid'] = $item['data']->userid;
                $udata['txnid'] = $item['data']->payment_id;
                $udata['add_money_id'] = $item['data']->id;
                $udata['text'] = "Server error duplicate transaction id";
                $udata['isfix'] = 0;
                $udata['date'] = date('d-m-Y');
                $udata['time'] = date('h:i:s a');
                $udata['mindate'] = date('Ymd');
                $udata['amount'] = $item['data']->total_amount;
                DB::table('errorlog')->insert($udata);
                DB::table('add_money_log')->where('payment_id',$item['data']->payment_id)->update(['issent'=>1]);
                DB::table('merchant')->where('id',$item['data']->userid)->update(['is_active'=>0]);
            }else{
                $data = array();
                $data['payment_id'] = $item['data']->payment_id;
                $data['add_log_id'] = $item['data']->id;
                DB::table('add_money_log')->where('payment_id',$item['data']->payment_id)->update(['issent'=>1]);
                DB::table('skip_errorslog')->insert($data);
            }
        }
        
    }
    // $array = array();
    // foreach($query as $list){
    //     if(count_data($list->payment_id) > 1){
    //         $array[$list->payment_id] = array('id'=>$list->id,'data'=>$list);
    //     }
    // }
}
function count_error_log($payment_id){
    $count = DB::table('errorlog')->where('txnid',$payment_id)->count();
    return $count; 
}
function count_error()
{
    $q = DB::table('errorlog')->where('isfix',0)->count();
    return $q;
}
function card_type_by_addmoney_id($id="")
{
    $type  = "";
    if($id){
        $q = DB::table('add_money_log')->where('id',$id)->first();
        if($q){
            if($q->paymentoption){
                $type = get_payment_methods($q->paymentoption);
            }   
        }
    }
    return $type;
}
function admin_count_prewallet($id="")
{
    $total = "";
    if($id){
        $q = DB::table('distribute_logs')->where('id','<=',$id)->sum('admin');
        if($q > 0){
            $total = $q;  
        }
    }
    return $total;
}
function insert_wallet_log($array)
{
    if(!empty($array)){
        $data = array();
        $data = $array;
        $data['date'] = date('d-m-Y');
        $data['mindate'] = date('Ymd');
        $data['time'] = date('h:i:s a');
        $data['mintime'] = time();
        DB::table('wallet_add_log')->insert($data);
    }
}
?>