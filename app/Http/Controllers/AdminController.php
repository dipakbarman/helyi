<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Session;
use Razorpay\Api\Api;
use LoveyCom\CashFree\PaymentGateway\Order;

class AdminController extends Controller
{
    public function sd(){
        // session()->put('adminid',1);
        // session()->put('type',0);
    }
    public function pub(Type $var = null)
    {
        // $order = new Order(); 
        // $response = $order->getStatus("9u6D8ghQabw31648794674");
        // dd($response);
        // $bank_data = array();
        // $bank_data['account_number'] = "4564564889229966";
        // $bank_data['fund_account']['id'] = "fa_J3pg8IlnSB52ux";
        // $bank_data['amount'] = 100;
        // $bank_data['currency'] = "INR";
        // $bank_validation_check = rezorpay_bank_validation($bank_data,'fund_accounts/validations');
        // dd($bank_validation_check);
        // session()->put('adminid',1);
        // session()->put('type',0);
        // session()->put('userid',1);
        // session()->put('type',4);
    }
    public function undermaintain()
    {
    return view('maintain');   
    }
    // auth
    public function adminlogin(Type $var = null)
    {
        return view('auth.login');
    }
    public function adminlogincheck(Request $req)
    {
        $req->validate([
            'email' => 'required',
            'pass' => 'required',
        ]);
        $where = array();
        $where['email'] = $req->email;
        $check = DB::table('admin_users')->where($where)->first();
        if(empty($check)){
            return back()->with('error','Email not found');
        }else{
            if (Hash::check($req->pass,$check->password)) {
                session()->flush();
                $req->session()->put('adminid',$check->id);
                $req->session()->put('type',0);
                return redirect('dashboard')->with('success','Login successful');
            }else{
                return back()->with('error','Password not match');
            }
        }
    }
    public function adminlogout(Type $var = null)
    {
        session()->flush();
        return redirect('adminlogin')->with('success','Account Logout successfull');
    }
    // dashboard
    public function dashboard(Type $var = null)
    {
        return view('backend.admin.dashboard');
    }
    // category
    public function category(Request $req)
    {
        if(check_access('category') == 0){
            return redirect('dashboard')->with('error','Access denied !!');
            die();
        }
        if(isset($req->id)){
            $check = DB::table('category')->where('id',$req->id)->where('is_deleted',0)->count();
            if($check > 0){
                $data['editq'] = DB::table('category')->where('id',$req->id)->where('is_deleted',0)->first();
            }else{
                return redirect('category');
            }
        }
        $data['qlist'] = DB::table('category')->where('is_deleted',0)->paginate(20);
        return view('backend.category',$data);
    }
    public function categoryform(Request $req)
    {
        $data = array();
        $data['name'] = $req->name;
        $data['is_deleted'] = 0;
        $data['is_recommended'] = 0;
        $data['image'] = $req->file('image')->store('category');
        DB::table('category')->insert($data);
        return redirect('category')->with('success','Insert successfull');
    }
    public function categoryeditfrom(Request $req)
    {
        $data = array();
        $data['name'] = $req->name;
        $data['is_deleted'] = 0;
        $data['is_recommended'] = 0;
        if(isset($req->image)){
            $data['image'] = $req->file('image')->store('category');
        }
        DB::table('category')->where('id',$req->id)->update($data);
        return redirect('category')->with('success','Insert successfull');        
    }
    public function categorydelete($id)
    {
        if(check_access('category') == 0){
            return redirect('dashboard')->with('error','Access denied !!');
            die();
        }
        DB::table('category')->where('id',$id)->update(['is_deleted'=>1]);
        return redirect('category')->with('success','Deleted successfull');        
    }
    // franchise category
    public function franchise_category(Request $req)
    {
        if(check_access('franchise_category') == 0){
            return redirect('dashboard')->with('error','Access denied !!');
            die();
        }
        if(isset($req->id)){
            $check = DB::table('franchise_category')->where('id',$req->id)->where('is_deleted',0)->count();
            if($check > 0){
                $data['editq'] = DB::table('franchise_category')->where('id',$req->id)->where('is_deleted',0)->first();
            }else{
                return redirect('franchise_category');
            }
        }
        $data['qlist'] = DB::table('franchise_category')->where('is_deleted',0)->get();
        return view('backend.franchise_category',$data);
    }
    public function franchise_categoryform(Request $req)
    {
        $data = array();
        $data['name'] = $req->name;
        $data['is_deleted'] = 0;
        $data['image'] = $req->file('image')->store('category');
        DB::table('franchise_category')->insert($data);
        return redirect('franchise_category')->with('success','Insert successfull');
    }
    public function franchise_category_editfrom(Request $req)
    {
        $data = array();
        $data['name'] = $req->name;
        $data['is_deleted'] = 0;
        if(isset($req->image)){
            $data['image'] = $req->file('image')->store('category');
        }
        DB::table('franchise_category')->where('id',$req->id)->update($data);
        return redirect('franchise_category')->with('success','Insert successfull');        
    }
    public function franchise_categorydelete($id)
    {
        if(check_access('franchise_category') == 0){
            return redirect('dashboard')->with('error','Access denied !!');
            die();
        }
        DB::table('franchise_category')->where('id',$id)->update(['is_deleted'=>1]);
        return redirect('franchise_category')->with('success','Deleted successfull');        
    }
    // banner
    public function banner(Request $req)
    {
        if(check_access('banner') == 0){
            return redirect('dashboard')->with('error','Access denied !!');
            die();
        }
        $data['qlist'] = DB::table('banner')->where('is_deleted',0)->get();
        return view('backend.banner',$data);
    }
    public function bannerform(Request $req)
    {
        $data = array();
        $data['is_deleted'] = 0;
        $data['banner'] = $req->file('banner')->store('banner');
        DB::table('banner')->insert($data);
        return redirect('banner')->with('success','Insert successfull');
    }
    public function bannerdelete($id)
    {
        if(check_access('banner') == 0){
            return redirect('dashboard')->with('error','Access denied !!');
            die();
        }
        DB::table('banner')->where('id',$id)->update(['is_deleted'=>1]);
        return redirect('banner')->with('success','Deleted successfull');        
    }
    // company_setting
    public function company_setting(Request $req)
    {
        if(check_access('company_setting') == 0){
            return redirect('dashboard')->with('error','Access denied !!');
            die();
        }
        $data['qlist'] = DB::table('company_setting')->first();
        $data['qlist_check'] = DB::table('company_setting')->count();
        return view('backend.company_setting',$data);
    }
    public function company_setting_form(Request $req)
    {
        $data = array();
        $data['amount'] = $req->amount;
        $data['commission'] = $req->commission;
        $check = DB::table('company_setting')->count();
        if($check > 0){
            $company_setting = DB::table('company_setting')->first();
            DB::table('company_setting')->where('id',$company_setting->id)->update($data);
        }else{
            DB::table('company_setting')->insert($data);
        }
        return redirect('company_setting')->with('success','Insert successfull');
    }    
    // shop
    public function shop()
    {
        
        $data['category'] = DB::table('category')->where('is_deleted',0)->get();
        return view('backend.shop',$data);
    }
    public function shopform(Request $req)
    {
        $data = array();
        $data['username'] = $req->name;
        $data['email'] = $req->email;
        $data['mobile_no'] = $req->number;
        $data['address'] = $req->address;
        $data['password'] = Hash::make($req->passowrd);
        $userid = DB::table('merchant')->insertGetId($data);
        $data = array();
        $data['name'] = $req->name;
        $data['userid'] = $userid;
        $data['image'] = $req->file('image')->store('shop');
        $data['long_data'] = $req->long_data;
        $data['lat'] = $req->lat;
        $data['address'] = $req->address;
        $data['is_deleted'] = 0;
        $data['category_id'] = $req->category_id;
        $lastshop = DB::table('shop')->insertGetId($data);
        DB::table('merchant')->where('id',$userid)->update(['shopid'=>$lastshop]);
        return redirect('shop')->with('success','Inserted');
    }
    public function shoplist()
    {
        if(check_access('shoplist') == 0){
            return redirect('dashboard')->with('error','Access denied !!');
            die();
        }
        $data['qlist'] = DB::table('shop')->where('is_deleted',0)->orderBy('id','DESC')->paginate(30);
        return view('backend.shoplist',$data);
    }
    public function shopedit($id)
    {
        if(check_access('shoplist') == 0){
            return redirect('dashboard')->with('error','Access denied !!');
            die();
        }
        if(!empty($id)){
            $check = DB::table('shop')->where('id',$id)->where('is_deleted',0)->count();
            if($check > 0){
                $data['editq'] = DB::table('shop')->where('id',$id)->where('is_deleted',0)->first();
                $data['category'] = DB::table('category')->where('is_deleted',0)->get();
                return view('backend.shop',$data);
            }else{
                return redirect('shoplist');
            }
        }else{
            return redirect('shoplist');
        }
    }
    public function shopeditfrom(Request $req)
    {
        $data = array();
        $data['name'] = $req->name;
        if(isset($req->image)){
            $data['image'] = $req->file('image')->store('shop');
        }
        $data['long_data'] = $req->long_data;
        $data['lat'] = $req->lat;
        $data['address'] = $req->address;
        $data['is_deleted'] = 0;
        $data['category_id'] = $req->category_id;
        DB::table('shop')->where('id',$req->id)->update($data);
        return redirect('shoplist')->with('success','Updated');
    }
    public function shopdelete($id)
    {
        if(check_access('shoplist') == 0){
            return redirect('dashboard')->with('error','Access denied !!');
            die();
        }
        DB::table('shop')->where('id',$id)->update(['is_deleted'=>1]);
        return redirect('shoplist')->with('success','Deleted successfull');
    }
    // user kyc
    public function userlist(Type $var = null)
    {
        // $data['qlist'] = DB::table('users')->where('type',1)->orderBy('id','DESC')->paginate(25);
        return view('backend.admin.userlist');
    }
    public function kycvarify($id)
    {
        if(check_access('userlist') == 0){
            return redirect('dashboard')->with('error','Access denied !!');
            die();
        }
        DB::table('users')->where('id',$id)->update(['kyc_varified'=>1]);
        return back()->with('success','kyc verified');
    }
    public function kycreject(Request $req)
    {
        if(check_access('userlist') == 0){
            return redirect('dashboard')->with('error','Access denied !!');
            die();
        }
        $data = array();
        $data['kyc_varified'] = 2;
        $data['reject_resone'] = $req->reject_resone;
        DB::table('users')->where('id',$req->id)->update($data);
        return back()->with('success','kyc rejected');
    }
    public function franchiserlist()
    {
        if(check_access('franchiserlist') == 0){
            return redirect('dashboard')->with('error','Access denied !!');
            die();
        }
        $data['qlist'] = DB::table('users')->where('type',2)->orderBy('id','DESC')->paginate(25);
        return view('backend.franchiserlist',$data);
    }
    // sub admin create
    public function subadmincreate(Type $var = null)
    {
        if(check_access('subadmincreate') == 0){
            return redirect('dashboard')->with('error','Access denied !!');
            die();
        }
        $data['qlist'] = DB::table('admin_users')->where('type',1)->orderBy('id','DESC')->paginate(20);
        return view('backend.subadmincreate',$data);
    }
    public function subadmincreate_form(Request $req)
    {
        $check = DB::table('admin_users')->where('email',$req->email)->count();
        if($check > 0){
            return redirect('subadmincreate')->with('error','Email Id alredy exist');
            die();
        }
        $data = array();
        $data['email'] = $req->email;
        $data['type'] = 1;
        $data['date'] = date('d-m-Y');
        $data['password'] = Hash::make($req->password);
        if(isset($req->category)){
            $data['category'] = 1;
        }else{
            $data['category'] = 0;
        }
        if(isset($req->franchise_category)){
            $data['franchise_category'] = 1;
        }else{
            $data['franchise_category'] = 0;
        }
        if(isset($req->banner)){
            $data['banner'] = 1;
        }else{
            $data['banner'] = 0;
        }
        if(isset($req->company_setting)){
            $data['company_setting'] = 1;
        }else{
            $data['company_setting'] = 0;
        }
        if(isset($req->subadmincreate)){
            $data['subadmincreate'] = 1;
        }else{
            $data['subadmincreate'] = 0;
        }
        if(isset($req->userlist)){
            $data['userlist'] = 1;
        }else{
            $data['userlist'] = 0;
        }
        if(isset($req->franchiserlist)){
            $data['franchiserlist'] = 1;
        }else{
            $data['franchiserlist'] = 0;
        }
        if(isset($req->franchisertransactionhistory)){
            $data['franchisertransactionhistory'] = 1;
        }else{
            $data['franchisertransactionhistory'] = 0;
        }
        if(isset($req->userstransactionhistory)){
            $data['userstransactionhistory'] = 1;
        }else{
            $data['userstransactionhistory'] = 0;
        }
        if(isset($req->usersordershistory)){
            $data['usersordershistory'] = 1;
        }else{
            $data['usersordershistory'] = 0;
        }
        if(isset($req->topearners)){
            $data['topearners'] = 1;
        }else{
            $data['topearners'] = 0;
        }
        if(isset($req->shoplist)){
            $data['shoplist'] = 1;
        }else{
            $data['shoplist'] = 0;
        }
        DB::table('admin_users')->insert($data);
        return redirect('subadmincreate')->with('success','Process successful ');
    }
    public function subadminedit($id)
    {
        if(isset($id)){
            $check = DB::table('admin_users')->where('type',1)->where('id',$id)->count();
            if($check > 0){
                $data['qlist'] = DB::table('admin_users')->where('type',1)->orderBy('id','DESC')->paginate(20);
                $data['editq'] = DB::table('admin_users')->where('type',1)->where('id',$id)->first();
                return view('backend.subadmincreate',$data);
            }else{
                return back();    
            }
        }else{
            return back()->with('success','Process successful ');
        }
    }
    public function subadmindelete($id)
    {
        if(check_access('subadmincreate') == 0){
            return redirect('dashboard')->with('error','Access denied !!');
            die();
        }
        if(isset($id)){
            $check = DB::table('admin_users')->where('type',1)->where('id',$id)->count();
            if($check > 0){
                DB::table('admin_users')->where('type',1)->where('id',$id)->delete();
                return back()->with('success','Deleted');
            }else{
                return back();    
            }
        }else{
            return back();
        }
    }
    public function subadminupdate_form(Request $req)
    {
        $checkid = array();
        $checkid['id'] = $req->editid;
        $check = DB::table('admin_users')->where('email',$req->email)->whereNotIn('id',$checkid)->count();
        if($check > 0){
            return back()->with('error','Email Id alredy exist');
            die();
        }
        $data = array();
        $data['email'] = $req->email;
        if(isset($req->category)){
            $data['category'] = 1;
        }else{
            $data['category'] = 0;
        }
        if(isset($req->franchise_category)){
            $data['franchise_category'] = 1;
        }else{
            $data['franchise_category'] = 0;
        }
        if(isset($req->banner)){
            $data['banner'] = 1;
        }else{
            $data['banner'] = 0;
        }
        if(isset($req->company_setting)){
            $data['company_setting'] = 1;
        }else{
            $data['company_setting'] = 0;
        }
        if(isset($req->subadmincreate)){
            $data['subadmincreate'] = 1;
        }else{
            $data['subadmincreate'] = 0;
        }
        if(isset($req->userlist)){
            $data['userlist'] = 1;
        }else{
            $data['userlist'] = 0;
        }
        if(isset($req->franchiserlist)){
            $data['franchiserlist'] = 1;
        }else{
            $data['franchiserlist'] = 0;
        }
        if(isset($req->franchisertransactionhistory)){
            $data['franchisertransactionhistory'] = 1;
        }else{
            $data['franchisertransactionhistory'] = 0;
        }
        if(isset($req->userstransactionhistory)){
            $data['userstransactionhistory'] = 1;
        }else{
            $data['userstransactionhistory'] = 0;
        }
        if(isset($req->usersordershistory)){
            $data['usersordershistory'] = 1;
        }else{
            $data['usersordershistory'] = 0;
        }
        if(isset($req->topearners)){
            $data['topearners'] = 1;
        }else{
            $data['topearners'] = 0;
        }
        if(isset($req->shoplist)){
            $data['shoplist'] = 1;
        }else{
            $data['shoplist'] = 0;
        }
        DB::table('admin_users')->where('id',$req->editid)->update($data);
        return redirect('subadmincreate')->with('success','process successful');
    }
    // franchiser transaction
    public function franchisertransactionhistory(Type $var = null)
    {
        $data['qlist'] = DB::table('orders')->orderBy('id','DESC')->paginate(25);
        return view('backend.franchisertransactionhistory',$data);
    }
    public function topearners(Type $var = null)
    {
        $data['qlist'] = DB::table('orders')->orderBy('commission','DESC')->limit(50)->paginate(50);
        return view('backend.topearners',$data);
    }
    public function userstransactionhistory(Type $var = null)
    {
        $data['qlist'] = DB::table('orders')->orderBy('id','DESC')->paginate(25);
        return view('backend.userstransactionhistory',$data);
    }
    public function usersordershistory(Type $var = null)
    {
        $data['qlist'] = DB::table('orders')->orderBy('id','DESC')->paginate(25);
        return view('backend.usersordershistory',$data);
    }
    // payout
    public function payout(Type $var = null)
    {
        $data['qlist'] = DB::table('payout')->orderBy('id','DESC')->where('status',0)->paginate(25);
        return view('backend.payout',$data);
    }
    public function payouthistory(Type $var = null)
    {
        $data['qlist'] = DB::table('payout')->orderBy('id','DESC')->where('status',1)->paginate(25);
        return view('backend.payouthistory',$data);
    }
    public function payoutaccept($id)
    {
        DB::table('payout')->where('id',$id)->update(['status'=>1,'a_date'=>date('d-m-Y'),'a_datefilter'=>date('Ymd')]);
        return back()->with('success','Process successful');
    }
    public function payoutreject($id)
    {
        $q = DB::table('payout')->where('id',$id)->first();
        $userq = DB::table('users')->where('id',$q->userid)->first();
        $total = $userq->wallet+$q->amount;
        DB::table('users')->where('id',$q->userid)->update(['wallet'=>$total]);
        DB::table('payout')->where('id',$id)->update(['status'=>2]);
        return back()->with('success','Process successful');
    }
    // distributor
    public function distributorlist(Type $var = null)
    {
        $data['qist_type'] = 3;
        $data['pgtitle'] = "Distributors";
        $data['searchlink'] = "distributorlist_bynumber";
        $data['qlist'] = DB::table('merchant')->where('type',3)->where('is_deleted',0)->orderBy('id','DESC')->paginate(25);
        return view('backend.admin.storelist',$data);
    }
    public function networkdistributorlist($id)
    {
        $data['qist_type'] = 3;
        $data['pgtitle'] = "Distributors";
        $data['searchlink'] = "distributorlist_bynumber";
        $data['qlist'] = DB::table('merchant')->where('type',3)->where('refer_uid',$id)->where('is_deleted',0)->orderBy('id','DESC')->paginate(25);
        return view('backend.admin.storelist',$data);
    }
    public function distributorlist_bynumber(Request $req)
    {
        $data['qist_type'] = 3;
        $data['pgtitle'] = "Distributors";
        $data['searchlink'] = "distributorlist_bynumber";
        $data['qlist'] = DB::table('merchant')->where('mobile', 'like', '%'.$req->number.'%')->where('type',3)->where('is_deleted',0)->orderBy('id','DESC')->paginate(25);
        return view('backend.admin.storelist',$data);
    }
    public function distributorpendinglist(Type $var = null)
    {
        $data['qist_type'] = 3;
        $data['pgtitle'] = "Distributors";
        $data['searchlink'] = "distributorlist_bynumber";
        $data['qlist'] = DB::table('merchant')->where('type',3)->where('is_deleted',0)->where('is_active',0)->orderBy('id','DESC')->paginate(25);
        return view('backend.admin.storelist',$data);
    }
    // master distributor
    public function masterdistributorlist(Type $var = null)
    {
        $data['qist_type'] = 4;
        $data['pgtitle'] = "Master Distributors";
        $data['searchlink'] = "masterdistributorlist_bynumber";
        $data['qlist'] = DB::table('merchant')->where('type',4)->where('is_deleted',0)->orderBy('id','DESC')->paginate(25);
        return view('backend.admin.storelist',$data);
    }
    public function masterdistributorlist_bynumber(Request $req)
    {
        $data['qist_type'] = 4;
        $data['pgtitle'] = "Master Distributors";
        $data['searchlink'] = "masterdistributorlist_bynumber";
        $data['qlist'] = DB::table('merchant')->where('mobile', 'like', '%'.$req->number.'%')->where('type',4)->where('is_deleted',0)->orderBy('id','DESC')->paginate(25);
        return view('backend.admin.storelist',$data);
    }
    public function masterdistributorpendinglist(Type $var = null)
    {
        $data['qist_type'] = 4;
        $data['pgtitle'] = "Master Distributors";
        $data['searchlink'] = "masterdistributorlist_bynumber";
        $data['qlist'] = DB::table('merchant')->where('type',4)->where('is_active',0)->where('is_deleted',0)->orderBy('id','DESC')->paginate(25);
        return view('backend.admin.storelist',$data);
    }
    // store
    public function storelist(Type $var = null)
    {
        $data['pgtitle'] = "Store";
        $data['qist_type'] = 1;
        $data['searchlink'] = "storelist_bynumber";
        $data['qlist'] = DB::table('merchant')->where('type',1)->where('is_deleted',0)->orderBy('id','DESC')->paginate(25);
        return view('backend.admin.storelist',$data);
    }
    public function networkstorelist($id)
    {
        $data['pgtitle'] = "Store";
        $data['qist_type'] = 1;
        $data['searchlink'] = "storelist_bynumber";
        $data['qlist'] = DB::table('merchant')->where('refer_uid',$id)->where('type',1)->where('is_deleted',0)->orderBy('id','DESC')->paginate(25);
        return view('backend.admin.storelist',$data);
    }
    public function storelist_bynumber(Request $req)
    {
        $data['pgtitle'] = "Store";
        $data['qist_type'] = 1;
        $data['searchlink'] = "storelist_bynumber";
        $data['qlist'] = DB::table('merchant')->where('mobile', 'like', '%'.$req->number.'%')->where('type',1)->where('is_deleted',0)->orderBy('id','DESC')->paginate(25);
        return view('backend.admin.storelist',$data);
    }
    public function admin_plan_upgrade(Request $req)
    {
        $success = "";
        $pid = $req->plan_id; 
        $uid = $req->userid; 
        $plan_price = get_plan_price($pid);
        $user_data = get_company_all_data_byid($uid);
            DB::table('plan_p_log')->where('uid',$uid)->update(['is_expire'=>1]);
            $data = array();
            $data['uid'] = $uid;
            $data['plan_id'] = $pid;
            $data['price'] = $plan_price;
            $data['is_expire'] = 0;
            $data['date'] = date('Y-m-d');
            $cdate = date('Y-m-d');
            $data['time'] = date("h:i:s a");
            $ex_date = date('d-m-Y', strtotime($cdate .' +30 day'));
            $data['ex_date'] = get_plan_expiry_time($pid);
            DB::table('plan_p_log')->insert($data);
            DB::table('merchant')->where('id',$uid)->update(['plan_id'=>$pid]);   
            $data = array();
            $data['time'] = time();
            $data['date'] = date('Ymd');
            $data['uid'] = $uid;
            $data['remark'] = "Admin Change Your Plan";
            $data['view'] = 0;
            $data['type'] = 1;
            DB::table('notification')->insert($data);
            $success = 1;
        return $success;
    }
    public function storependinglist(Type $var = null)
    {
        $data['pgtitle'] = "Store";
        $data['qist_type'] = 1;
        $data['searchlink'] = "storelist_bynumber";
        $data['qlist'] = DB::table('merchant')->where('type',1)->where('is_active',0)->where('is_deleted',0)->orderBy('id','DESC')->paginate(25);
        return view('backend.admin.storelist',$data);
    }
    public function shop_service_form(Request $req)
    {
        $data = array();
        $data['recharge_services'] = $req->recharge_services;
        $data['money_services'] = $req->money_services;
        $data['aeps_services'] = $req->aeps_services;
        $data['epos_services'] = $req->epos_services;
        $data['pancard_services'] = $req->pancard_services;
        DB::table('merchant')->where('id',$req->userid)->update($data);
        return back()->with('success','Services Updated');
    }
    public function store_paymentoptions_form(Request $req)
    {
        $data = array();
        $data['debit'] = $req->debit;
        $data['netbanking'] = $req->netbanking;
        $data['upi'] = $req->upi;
        $data['credit'] = $req->credit;
        $data['amex'] = $req->amex;
        $data['diners'] = $req->diners;
        $data['wallet_option'] = $req->wallet_option;
        $data['corporate'] = $req->corporate;
        $data['prepaid'] = $req->prepaid;
        $data['credit_card1'] = $req->credit_card1;
        DB::table('merchant')->where('id',$req->userid)->update($data);
        return back()->with('success','Updated');
    }
    public function add_money_form(Request $req)
    {
        $getq = DB::table('merchant')->where('id',$req->shop_id)->first();
        $data = array();
        $total_amount = $getq->wallet+$req->amount;
        $data['wallet'] = $total_amount;
        DB::table('merchant')->where('id',$req->shop_id)->update($data);
        $data = array();
        $data['amount'] = $req->amount;
        $data['date'] = date('Y-m-d');
        $data['uid'] = $getq->id;
        $data['remark'] = $req->remark;
        $data['type'] = 1;
        $data['time'] = date('h:i:s a');
        $data['mindate'] = date('Ymd');
        DB::table('admin_add_money')->insert($data);
        inset_all_t_log(1,$req->amount,"Admin add money",$getq->id,$total_amount,"");
        $msg_user = $req->amount." received from admin";
        $data = array();
        $data['time'] = time();
        $data['date'] = date('Ymd');
        $data['uid'] = $getq->id;
        $data['remark'] = $msg_user;
        $data['view'] = 0;
        $data['type'] = 1;
        $data['amount'] = $req->amount;
        DB::table('notification')->insert($data);
        return back()->with('success','Transfer successful');
    }
    public function deduct_money_form(Request $req)
    {
        $getq = DB::table('merchant')->where('id',$req->shop_id)->first();
        if($getq->wallet < $req->amount){
            return back()->with('error','insufficient balance');
        }else{
        $data = array();
        $data['wallet'] = $getq->wallet-$req->amount;
        DB::table('merchant')->where('id',$req->shop_id)->update($data);
        $data = array();
        $data['amount'] = $req->amount;
        $data['date'] = date('Y-m-d');
        $data['time'] = date('h:i:s a');
        $data['mindate'] = date('Ymd');
        $data['uid'] = $getq->id;
        $data['remark'] = $req->remark;
        $data['type'] = 2;
        DB::table('admin_add_money')->insert($data);
        inset_all_t_log(2,$req->amount,"Admin deduct money",$getq->id,$getq->wallet-$req->amount,"");
        $msg_user = $req->amount." Admin deduct from main wallet";
        $data = array();
        $data['time'] = time();
        $data['date'] = date('Ymd');
        $data['uid'] = $getq->id;
        $data['remark'] = $msg_user;
        $data['view'] = 0;
        $data['type'] = 2;
        $data['amount'] = $req->amount;
        DB::table('notification')->insert($data);
        return back()->with('success','Done');
    }
}
    public function change_shop_stats(Request $req)
    {
        $success = "";
        $where = array();
        $where['id'] = $req->id;
        $where['is_active'] = 0;
        $count = DB::table('merchant')->where($where)->count();
        if ($count > 0) {
            $where = array();
            $data = array();
            $data['is_active'] = 1;
            $where['id'] = $req->id;
            DB::table('merchant')->where($where)->update($data);
            $success = 2;
        }else{
            $where = array();
            $data = array();
            $data['is_active'] = 0;
            $where['id'] = $req->id;
            DB::table('merchant')->where($where)->update($data);
            $success = 1;
        }
        echo $success;
    }
    public function change_send_money_stats(Request $req)
    {
        $success = "";
        $where = array();
        $where['id'] = $req->id;
        $where['is_send_money'] = 0;
        $count = DB::table('merchant')->where($where)->count();
        if ($count > 0) {
            $where = array();
            $data = array();
            $data['is_send_money'] = 1;
            $where['id'] = $req->id;
            DB::table('merchant')->where($where)->update($data);
            $success = 2;
        }else{
            $where = array();
            $data = array();
            $data['is_send_money'] = 0;
            $where['id'] = $req->id;
            DB::table('merchant')->where($where)->update($data);
            $success = 1;
        }
        echo $success;
    }
    public function change_instant_stats(Request $req)
    {
        $success = "";
        $where = array();
        $where['id'] = $req->id;
        $where['is_instant'] = 0;
        $count = DB::table('merchant')->where($where)->count();
        if ($count > 0) {
            $where = array();
            $data = array();
            $data['is_instant'] = 1;
            $where['id'] = $req->id;
            DB::table('merchant')->where($where)->update($data);
            $success = 2;
        }else{
            $where = array();
            $data = array();
            $data['is_instant'] = 0;
            $where['id'] = $req->id;
            DB::table('merchant')->where($where)->update($data);
            $success = 1;
        }
        echo $success;
    }
    public function viewshop($id)
    {
        $data['q'] = DB::table('merchant')->where('shop_id',$id)->first();
        if(!empty($data['q'])){
            $data['all_tranaction'] = DB::table('all_t_log')->where('uid',$data['q']->id)->orderBy('id','DESC')->paginate(30);    
            $data['filtertype'] = 2;
            $data['filtertype_name'] = "Today";
            return view('backend.admin.viewshop',$data);
        }else{
            return back()->with('error','Data not found');
        }
    }
    public function deleteshop($id)
    {
        DB::table('merchant')->where('id',$id)->update(['is_deleted'=>1]);
        return back()->with('success','Deleted');
    }
    public function blockshop($id)
    {
        DB::table('merchant')->where('id',$id)->update(['is_deleted'=>1]);
        return back()->with('success','Deleted');
    }
    public function unblockshop($id)
    {
        DB::table('merchant')->where('id',$id)->update(['is_deleted'=>0]);
        return back()->with('success','Deleted');
    }
    // createplan
    public function createplan(Request $req)
    {
        if(isset($req->id)){
            $data['qlist'] = DB::table('plans')->where('is_deleted',0)->orderBy('id','DESC')->get();
            $data['edit_q'] = DB::table('plans')->where('is_deleted',0)->where('id',$req->id)->first();
            if(!empty($data['edit_q'])){
                return view('backend.admin.createplan',$data);
            }else{
                return redirect('createplan'); 
            }
        }else{
            $data['qlist'] = DB::table('plans')->where('is_deleted',0)->orderBy('id','DESC')->get();
            return view('backend.admin.createplan',$data);
        }
        
    }
    public function createplan_from(Request $req)
    {
        if(isset($req->edit_id)){
            $data = array();
            $data['date'] = date('Y-m-d');
            if(isset($req->is_active)){
                $data['is_active'] = 1;
            }else{
                $data['is_active'] = null;
            }       
            if(isset($req->planlogo)){
                $data['planlogo'] = $req->file('planlogo')->store('plans');     
            }
            // $data['distibutor_cashback'] = $req->distibutor_cashback;
            // $data['master_limit_per_day'] = $req->master_limit_per_day;     
            $data['plan_type'] = $req->plan_type;
            $data['package_name'] = $req->package_name;
            $data['price'] = $req->price;
            $data['monthly_limit'] = $req->monthly_limit;
            $data['limit_per_day'] = $req->limit_per_day;
            $data['t0_hours'] = $req->t0_hours;
            $data['debit_base_per'] = $req->debit_base_per;
            $data['debit_card_instant'] = $req->debit_card_instant;
            $data['debit_card_t0'] = $req->debit_card_t0;
            $data['debit_card_t1'] = $req->debit_card_t1;
            $data['debit_card_t2'] = $req->debit_card_t2;
            $data['netbanking_base_per'] = $req->netbanking_base_per;
            $data['netbanking_instant'] = $req->netbanking_instant;
            $data['netbanking_t0'] = $req->netbanking_t0;
            $data['netbanking_t1'] = $req->netbanking_t1;
            $data['netbanking_t2'] = $req->netbanking_t2;
            $data['upi_base_per'] = $req->upi_base_per;
            $data['upi_instant'] = $req->upi_instant;
            $data['upi_t0'] = $req->upi_t0;
            $data['upi_t1'] = $req->upi_t1;
            $data['upi_t2'] = $req->upi_t2;
            $data['credit_card_base_per'] = $req->credit_card_base_per;
            $data['credit_Card_instant'] = $req->credit_card_instant;
            $data['credit_card_t0'] = $req->credit_card_t0;
            $data['credit_card_t1'] = $req->credit_card_t1;
            $data['credit_card_t2'] = $req->credit_card_t2;
            $data['amex_card_base_per'] = $req->amex_card_base_per;
            $data['amex_card_instant'] = $req->amex_card_instant;
            $data['amex_card_t0'] = $req->amex_card_t0;
            $data['amex_card_t1'] = $req->amex_card_t1;
            $data['amex_card_t2'] = $req->amex_card_t2;
            $data['diners_card_base_per'] = $req->diners_card_base_per;
            $data['diners_card_instant'] = $req->diners_card_instant;
            $data['diners_card_t0'] = $req->diners_card_t0;
            $data['diners_card_t1'] = $req->diners_card_t1;
            $data['diners_card_t2'] = $req->diners_card_t2;
            $data['wallet_base_per'] = $req->wallet_base_per;
            $data['wallet_instant'] = $req->wallet_instant;
            $data['wallet_t0'] = $req->wallet_t0;
            $data['wallet_t1'] = $req->wallet_t1;
            $data['wallet_t2'] = $req->wallet_t2;
            $data['corporate_card_base_per'] = $req->corporate_card_base_per;
            $data['corporate_card_instant'] = $req->corporate_card_instant;
            $data['corporate_card_t0'] = $req->corporate_card_t0;
            $data['corporate_card_t1'] = $req->corporate_card_t1;
            $data['corporate_card_t2'] = $req->corporate_card_t2;
            $data['prepaid_card_base_per'] = $req->prepaid_card_base_per;
            $data['prepaid_card_instant'] = $req->prepaid_card_instant;
            $data['prepaid_card_t0'] = $req->prepaid_card_t0;
            $data['prepaid_card_t1'] = $req->prepaid_card_t1;
            $data['prepaid_card_t2'] = $req->prepaid_card_t2;
            $data['is_deleted'] = 0;
            $data['plan_duration'] = $req->plan_duration;
            DB::table('plans')->where('id',$req->edit_id)->update($data);
            return redirect('createplan')->with('success','Plan Updated');
        }else{
            $data = array();
            $data['date'] = date('Y-m-d');
            if(isset($req->is_active)){
                $data['is_active'] = 1;
            }else{
                $data['is_active'] = null;
            }
            $data['planlogo'] = $req->file('planlogo')->store('plans');     
            $data['distibutor_cashback'] = $req->distibutor_cashback;
            $data['master_limit_per_day'] = $req->master_limit_per_day;            
            $data['plan_type'] = $req->plan_type;
            $data['package_name'] = $req->package_name;
            $data['price'] = $req->price;
            $data['monthly_limit'] = $req->monthly_limit;
            $data['limit_per_day'] = $req->limit_per_day;
            $data['t0_hours'] = $req->t0_hours;
            $data['debit_card_instant'] = $req->debit_card_instant;
            $data['debit_card_t0'] = $req->debit_card_t0;
            $data['debit_card_t1'] = $req->debit_card_t1;
            $data['debit_card_t2'] = $req->debit_card_t2;
            $data['netbanking_instant'] = $req->netbanking_instant;
            $data['netbanking_t0'] = $req->netbanking_t0;
            $data['netbanking_t1'] = $req->netbanking_t1;
            $data['netbanking_t2'] = $req->netbanking_t2;
            $data['upi_instant'] = $req->upi_instant;
            $data['upi_t0'] = $req->upi_t0;
            $data['upi_t1'] = $req->upi_t1;
            $data['upi_t2'] = $req->upi_t2;
            $data['credit_card_instant'] = $req->credit_card_instant;
            $data['credit_card_t0'] = $req->credit_card_t0;
            $data['credit_card_t1'] = $req->credit_card_t1;
            $data['credit_card_t2'] = $req->credit_card_t2;
            $data['amex_card_instant'] = $req->amex_card_instant;
            $data['amex_card_t0'] = $req->amex_card_t0;
            $data['amex_card_t1'] = $req->amex_card_t1;
            $data['amex_card_t2'] = $req->amex_card_t2;
            $data['diners_card_instant'] = $req->diners_card_instant;
            $data['diners_card_t0'] = $req->diners_card_t0;
            $data['diners_card_t1'] = $req->diners_card_t1;
            $data['diners_card_t2'] = $req->diners_card_t2;
            $data['wallet_instant'] = $req->wallet_instant;
            $data['wallet_t0'] = $req->wallet_t0;
            $data['wallet_t1'] = $req->wallet_t1;
            $data['wallet_t2'] = $req->wallet_t2;
            $data['corporate_card_instant'] = $req->corporate_card_instant;
            $data['corporate_card_t0'] = $req->corporate_card_t0;
            $data['corporate_card_t1'] = $req->corporate_card_t1;
            $data['corporate_card_t2'] = $req->corporate_card_t2;
            $data['prepaid_card_instant'] = $req->prepaid_card_instant;
            $data['prepaid_card_t0'] = $req->prepaid_card_t0;
            $data['prepaid_card_t1'] = $req->prepaid_card_t1;
            $data['prepaid_card_t2'] = $req->prepaid_card_t2;
            $data['is_deleted'] = 0;
            DB::table('plans')->insert($data);
            return back()->with('success','Plan created');
        }
        return back();
    }
    public function plan_delete($id)
    {
        DB::table('plans')->where('id',$id)->update(['is_deleted'=>1]);
        return back()->with('success','plan deleted');
    }
    public function paymentslist(Type $var = null)
    {
        return view('backend.admin.paymentslist');
    }
    public function set_plan_base_price()
    {
        $data['base_table'] = DB::table('commition_base_price')->get();
        $data['payment_options'] = DB::table('payment_options')->get();
        return view('backend.admin.set_plan_base_price',$data);
    }
    public function set_plan_base_price_form(Request $req)
    {
        DB::table('commition_base_price')->delete();
        $i = 0;
        foreach($req->option_id as $list){
            $data = array();
            $data['option_id'] = $list;
            $data['base_price'] = $req->base_price[$i];
            $data['percentage'] = $req->percentage[$i];
            DB::table('commition_base_price')->insert($data);
            // update_plan_base_price($list,$req->percentage[$i]);
            $i++;  
        }
        return back()->with('success','Base price updated');
    }
    // commission
    public function commission(Type $var = null)
    {
        return view('backend.admin.commission');
    }
    public function commission_settings_form(Request $req)
    {
        $data = array();
        $data['admin'] = $req->admin;
        $data['master_distributor'] = $req->master_distributor;
        $data['distributor'] = $req->distributor;
        $check = DB::table('commission_distribute')->first();
        if(!empty($check)){
            DB::table('commission_distribute')->update($data);
        }else{
            DB::table('commission_distribute')->insert($data);
        }
        return back()->with('success','Updated successfully');
    }
    public function commission_form(Request $req)
    {
        $per_check = DB::table('commission')->where('type',1)->count();
        if(!empty($per_check)){
            $data = array();
            $data['master_distributor'] = $req->master_distributor_per;
            $data['distributor'] = $req->distributor_per;
            if($req->commission_type == 1){
                $data['active'] = 1;
            }else{
                $data['active'] = 0;
            }
            DB::table('commission')->where('type',1)->update($data);
        }else{
            $data = array();
            $data['type'] = 1;
            $data['master_distributor'] = $req->master_distributor_per;
            $data['distributor'] = $req->distributor_per;
            if($req->commission_type == 1){
                $data['active'] = 1;
            }else{
                $data['active'] = 0;
            }
            DB::table('commission')->insert($data);
        }
        $flat_check = DB::table('commission')->where('type',2)->count();
        if(!empty($flat_check)){
            $data = array();
            $data['master_distributor'] = $req->master_distributor_flat;
            $data['distributor'] = $req->distributor_flat;
            if($req->commission_type == 2){
                $data['active'] = 1;
            }else{
                $data['active'] = 0;
            }
            DB::table('commission')->where('type',2)->update($data);
        }else{
            $data = array();
            $data['type'] = 2;
            $data['master_distributor'] = $req->master_distributor_flat;
            $data['distributor'] = $req->distributor_flat;
            if($req->commission_type == 2){
                $data['active'] = 1;
            }else{
                $data['active'] = 0;
            }
            DB::table('commission')->insert($data);
        }
        return back()->with('success','commission updated');
    }
    public function paymentandutilities()
    {
        $data['filter_type'] = 2;
        return view('backend.admin.paymentandutilities',$data);
    }
    public function admin_dashboard_filter(Request $req)
    {
        $data['filter_type'] = $req->filter_type;
        if (isset($req->from_date)) {
            $data['from_date'] = date_min(dateu($req->from_date));
        }
        if (isset($req->to_date)) {
            $data['to_date'] = date_min(dateu($req->to_date));
        }
        return view('backend.admin.paymentandutilities',$data);
    }
    public function epos()
    {
        return view('backend.admin.epos');
    }
    public function recentsettlements()
    {
        return view('backend.admin.recentsettlements');
    }
    // kyc
    public function change_kyc_stats(Request $req)
    {
        $success = "";
        $where = array();
        $where['id'] = $req->id;
        $where['is_kyc'] = 0;
        $plan_id = get_default_plan();
        $count = DB::table('merchant')->where($where)->count();
        if ($count > 0) {
            if(check_alredy_p_by_user($plan_id,$req->id) != 1){
                $data = array();
                $data['uid'] = $req->id; 
                $data['plan_id'] = $plan_id; 
                $data['date'] = date('Y-m-d'); 
                $data['time'] = date('h:i:sa');
                $data['price'] = get_plan_price($plan_id); 
                DB::table('plan_p_log')->insert($data);
            }
            $where = array();
            $data = array();
            $data['is_kyc'] = 1;
            $data['is_kyc_submit'] = 1;
            if(check_alredy_p($plan_id) != 1){
                $data['plan_id'] = $plan_id;
                $data['plan_purches_date'] = date('Y-m-d');
            }
            $where['id'] = $req->id;
            DB::table('merchant')->where($where)->update($data);
            $success = 2;
        }else{
            $where = array();
            $data = array();
            $data['is_kyc'] = 0;
            $where['id'] = $req->id;
            DB::table('merchant')->where($where)->update($data);
            $success = 1;
        }
        echo $success;
    }
    public function view_kyc_document($id)
    {
        $data['q'] = DB::table('merchant')->where('id',$id)->first();
        if(!empty($data['q'])){
            return view('backend.admin.view_kyc_document',$data);
        }else{
            return back()->with('error','Data not found');
        }        
    }
    // marque text
    public function marquetext(Type $var = null)
    {
        return view('backend.admin.marquetext');   
    }
    public function marquetext_form(Request $req)
    {
        $check = DB::table('mtext')->count(); 
        if ($check > 0) {
            $data = array();
            $data['text'] = $req->text;
            DB::table('mtext')->where('id',1)->update($data); 
            return back()->with('success','Updated');
        } else {
            $data = array();
            $data['text'] = $req->text;
            DB::table('mtext')->insert($data); 
            return back()->with('success','Updated');
        }
    }
    // add account charges
    public function add_account_charges(Type $var = null)
    {
        return view('backend.admin.add_account_charges');   
    }
    public function add_account_charges_form(Request $req)
    {
        $check = DB::table('add_account_charges')->first(); 
        if (!empty($check)) {
            $data = array();
            $data['amount'] = $req->amount;
            DB::table('add_account_charges')->where('id',$check->id)->update($data); 
            return back()->with('success','Updated');
        } else {
            $data = array();
            $data['amount'] = $req->amount;
            DB::table('add_account_charges')->insert($data); 
            return back()->with('success','Inserted');
        }
    }
    // payment getway settings
    public function select_payment_getway()
    {
        $data['q'] = DB::table('payment_getway')->get();
        return view('backend.admin.select_payment_getway',$data);
    }
    public function select_payment_getway_form(Request $req)
    {
        $data['getway_id'] = $req->payment_getway;
        $data['getway_name'] = get_getway_name($req->payment_getway);
        $data['q'] = DB::table('payment_options')->get();
        return view('backend.admin.select_payment_getway_form',$data);
    }
    public function payment_gateway_key()
    {
        $data['gateway'] = DB::table('payment_getway')->get();
        return view('backend.admin.payment_gateway_key',$data);
    }
    public function payment_gateway_key_form(Request $req)
    {
        DB::table('gateway_key')->delete();
        $i = 0;
        foreach($req->type as $list){
            $data = array();
            $data['type'] = $list;
            $data['appkey'] = $req->appkey[$i];
            $data['secretkey'] = $req->secretkey[$i];
            $data['payout_appkey'] = $req->payout_appkey[$i];
            $data['payout_secretkey'] = $req->payout_secretkey[$i];
            DB::table('gateway_key')->insert($data);
            if($list == 1){
                $data = array();
                $data['rez_key'] = $req->appkey[$i];
                $data['rez_sec_key'] = $req->secretkey[$i];
                DB::table('pay_keys')->where('id',1)->update($data);
            }
            $i++;
        }
        return back()->with('success','All keys updated');
    }
    public function peyment_link_setting()
    {
        $data['q'] = DB::table('payment_getway')->get();
        return view('backend.admin.peyment_link_setting',$data);
    }
    public function payment_link_getway_form(Request $req)
    {
        $data['getway_id'] = $req->payment_getway;
        $data['getway_name'] = get_getway_name($req->payment_getway);
        $data['q'] = DB::table('payment_link_option')->get();
        return view('backend.admin.payment_link_getway_form',$data);
    }
    
    public function update_payment_option(Request $req)
    {
        DB::table('option_wise_payment_getway')->where('payment_getway_id',$req->getway_id)->delete();
        if(!empty($req->option_select)){
        foreach($req->option_select as $list){
            $data = array();
            $data['payment_getway_id'] = $req->getway_id;
            $data['option_id'] = $list;
            DB::table('option_wise_payment_getway')->insert($data);
        }
        }
        return redirect('select_payment_getway')->with('success','Successfully updated');
    }
    public function update_payment_link_option(Request $req)
    {
        DB::table('link_wise_payment_getway')->where('payment_getway_id',$req->getway_id)->delete();
        if(isset($req->option_select)){
        foreach($req->option_select as $list){
            $data = array();
            $data['payment_getway_id'] = $req->getway_id;
            $data['option_id'] = $list;
            DB::table('link_wise_payment_getway')->insert($data);
        }
        }
        return redirect('peyment_link_setting')->with('success','Successfully updated');
    }
    public function paymentgetwaysettings()
    {
        $data['q'] = DB::table('active_payment_getway')->first();
        return view('backend.admin.paymentgetwaysettings',$data);        
    }
    public function paymentgetwaysettings_form(Request $req)
    {
        $data = array();
        $data['type'] = $req->type;
        $check = DB::table('active_payment_getway')->first();
        if(!empty($check)){
        DB::table('active_payment_getway')->where('id',$check->id)->update($data);
        }else{
            DB::table('active_payment_getway')->insert($data);
        }
        return back()->with('success','Updated');
    }
    // Top-Up Option
    public function topupoption()
    {
        return view('backend.admin.topupoption');        
    }
    public function topupoption_form(Request $req)
    {
        $per_check = DB::table('topupoption')->where('type',1)->count();
        if(!empty($per_check)){
            $data = array();
            $data['t1'] = $req->t1_per;
            $data['t2'] = $req->t2_per;
            if($req->commission_type == 1){
                $data['active'] = 1;
            }else{
                $data['active'] = 0;
            }
            DB::table('topupoption')->where('type',1)->update($data);
        }else{
            $data = array();
            $data['type'] = 1;
            $data['t1'] = $req->t1_per;
            $data['t2'] = $req->t2_per;
            if($req->commission_type == 1){
                $data['active'] = 1;
            }else{
                $data['active'] = 0;
            }
            DB::table('topupoption')->insert($data);
        }
        $flat_check = DB::table('topupoption')->where('type',2)->count();
        if(!empty($flat_check)){
            $data = array();
            $data['t1'] = $req->t1_flat;
            $data['t2'] = $req->t2_flat;
            if($req->commission_type == 2){
                $data['active'] = 1;
            }else{
                $data['active'] = 0;
            }
            DB::table('topupoption')->where('type',2)->update($data);
        }else{
            $data = array();
            $data['type'] = 2;
            $data['t1'] = $req->t1_flat;
            $data['t2'] = $req->t2_flat;
            if($req->commission_type == 2){
                $data['active'] = 1;
            }else{
                $data['active'] = 0;
            }
            DB::table('topupoption')->insert($data);
        }
        return back()->with('success','Updated');
    }
    // tranfer list admin
    public function razorpaytransitionhistory()
    {
        $data['title'] = 1;
        $data['q'] = DB::table('add_money_log')->where('method_type',1)->orderBy('id','DESC')->get();
        return view('backend.admin.addwallettransitionlist',$data);
    }
    public function admin_commission_history()
    {
        $data['q'] = DB::table('distribute_logs')->where('admin','>',0)->orderBy('id','DESC')->paginate(30);
        return view('backend.admin.admin_commission_history',$data);
    }
    public function cashfreetransitionhistory()
    {
        $data['title'] = 2;
        $data['q'] = DB::table('add_money_log')->where('method_type',2)->orderBy('id','DESC')->get();
        return view('backend.admin.addwallettransitionlist',$data);
    }
    public function leintransition()
    {
        $data['q'] = DB::table('lein_to_wallet_log')->orderBy('id','DESC')->get();
        return view('backend.admin.leintransition',$data);
    }
    public function addwallettransitionlist()
    {
        $data['q'] = DB::table('add_money_log')->orderBy('id','DESC')->get();
        return view('backend.admin.addwallettransitionlist',$data);
    }
    public function admin_payout_history()
    {
        $data['q'] = DB::table('payout')->orderBy('id','DESC')->paginate(30);
        return view('backend.admin.admin_payout_history',$data);
    }
    public function admin_payout_filter(Request $req)
    {
        $sq = DB::table('payout');
        if(!empty($req->filter_type)){
            if($req->filter_type == 2){
                $today = date('Ymd');
                $last_sev_date = date('Y-m-d', strtotime('-7 days'));
                $last_sev_date_min = date_min($last_sev_date);
                $sq = $sq->whereBetween('mindate',[$last_sev_date_min, $today]);
            }
            if($req->filter_type == 3){
                $fromdate = date('Y-m')."-1";
                $frommin = date_min($fromdate);
                $a_date = date('Y-m-d');
                $todate = date("Y-m-t", strtotime($a_date));
                $tomin = date_min($todate);
                $sq = $sq->whereBetween('mindate',[$frommin, $tomin]);
            }
            if($req->filter_type == 1){
                $today = date('Ymd');
                $sq = $sq->where('mindate',$today);
            }
            if(isset($req->transaction_id)){
                $sq = $sq->where('transferid','like', '%'.$req->transaction_id.'%');
            }
            if(isset($req->status_type)){
                    $sq = $sq->where('status',$req->status_type);
            }
            if(isset($req->utr_id)){
                $sq = $sq->where('uti','like', '%'.$req->utr_id.'%');
            }
            if($req->filter_type == 4){
                if(isset($req->from_date)){
                    if(isset($req->to_date)){
                        $frommin = date_min(dateu($req->from_date));
                        $tomin = date_min(dateu($req->to_date));
                        $sq = $sq->whereBetween('mindate',[$frommin,$tomin]);
                    }
                }
            }
        }
        $sq = $sq->orderBy('id','DESC')->paginate(30);
        $data['q'] = $sq;
        return view('backend.admin.admin_payout_history',$data);
    }
    public function admin_leinwallet_history()
    {
        $data['q'] = DB::table('lein_to_wallet_log')->orderBy('id','DESC')->paginate(30);
        return view('backend.admin.admin_leinwallet_history',$data);
    }
    public function admin_leinwallet_history_filter(Request $req)
    {
        $sq = DB::table('lein_to_wallet_log');
        if(!empty($req->filter_type)){
            if($req->filter_type == 2){
                $today = date('Ymd');
                $last_sev_date = date('Y-m-d', strtotime('-7 days'));
                $last_sev_date_min = date_min($last_sev_date);
                $sq = $sq->whereBetween('mindate',[$last_sev_date_min, $today]);
            }
            if($req->filter_type == 3){
                $fromdate = date('Y-m')."-1";
                $frommin = date_min($fromdate);
                $a_date = date('Y-m-d');
                $todate = date("Y-m-t", strtotime($a_date));
                $tomin = date_min($todate);
                $sq = $sq->whereBetween('mindate',[$frommin, $tomin]);
            }
            if($req->filter_type == 1){
                $today = date('Ymd');
                $sq = $sq->where('mindate',$today);
            }
            if($req->filter_type == 4){
                if(isset($req->from_date)){
                    if(isset($req->to_date)){
                        $frommin = date_min(dateu($req->from_date));
                        $tomin = date_min(dateu($req->to_date));
                        $sq = $sq->whereBetween('mindate',[$frommin,$tomin]);
                    }
                }
            }
        }
        $sq = $sq->orderBy('id','DESC')->paginate(30);
        $data['q'] = $sq;
        return view('backend.admin.admin_leinwallet_history',$data);
    }
    public function admin_add_wallet_history(Request $req){
        $data['q'] = DB::table('add_money_log')->orderBy('id','DESC')->paginate(30);
        return view('backend.admin.admin_add_wallet_history',$data);
    }
    public function admin_tally(Request $req)
    {
        $addmoney = DB::table('add_money_log')->join('merchant', 'add_money_log.userid', '=', 'merchant.id')->where('add_money_log.is_fail',0)->where('add_money_log.is_added',1)->orderBy('add_money_log.id','DESC');
        $payout = DB::table('payout')->join('merchant', 'payout.uid', '=', 'merchant.id')->where('status',1)->orderBy('payout.id','DESC');
        if(isset($req->uname)){
            $addmoney = $addmoney->where('merchant.name','like', '%'.$req->uname.'%');
            $payout = $payout->where('merchant.name','like', '%'.$req->uname.'%');
        }
        if(isset($req->mobile)){
            $addmoney = $addmoney->where('merchant.mobile','like', '%'.$req->mobile.'%');
            $payout = $payout->where('merchant.mobile','like','%'.$req->mobile.'%');
        }
        if($req->filtertype == 1){
            $addmoney = $addmoney->where('add_money_log.min_date',date('Ymd'));
            $payout = $payout->where('payout.mindate',date('Ymd'));
        }else if($req->filtertype == 2){
            $addmoney = $addmoney->whereBetween('add_money_log.min_date',[date('Ymd', strtotime('-7 days')), date('Ymd')]);
            $payout = $payout->whereBetween('payout.mindate',[date('Ymd', strtotime('-7 days')), date('Ymd')]);
        }else if($req->filtertype == 3){
            $addmoney = $addmoney->whereBetween('add_money_log.min_date',[date('Ym01'), date('Ymd')]);
            $payout = $payout->whereBetween('payout.mindate',[date('Ym01'), date('Ymd')]);
        }else if($req->filtertype == 4){
            if(isset($req->fromdate) && isset($req->todate)){
                $fromdate = date_min(dateu($req->fromdate));
                $todate = date_min(dateu($req->todate));
                $addmoney = $addmoney->whereBetween('add_money_log.min_date',[$fromdate, $todate]);
                $payout = $payout->whereBetween('payout.mindate',[$fromdate, $todate]);
            }
        }else if($req->filtertype == 5){
            if(isset($req->addwallet_txnid)){
                $addmoney = $addmoney->where('add_money_log.payment_id','like', '%'.$req->addwallet_txnid.'%');
            }else{
                $addmoney = $addmoney->where('add_money_log.min_date',date('Ymd'));
            }
            if(isset($req->payouttxnid)){
                $payout = $payout->where('payout.transferid','like', '%'.$req->payouttxnid.'%');
            }else{
                $payout = $payout->where('payout.mindate',date('Ymd'));
            }
        }else{
            $addmoney = $addmoney->where('add_money_log.min_date',date('Ymd'));
            $payout = $payout->where('payout.mindate',date('Ymd'));
        }
        $data['addmoney'] = $addmoney->get();
        $data['addmoney_total'] = $addmoney->sum('total_amount');
        $data['payout'] = $payout->get(['payout.date AS payoutdate','payout.*','merchant.*']);
        $data['payout_total'] = $payout->sum('amount');
        return view('backend.admin.admin_tally',$data);
    }
    public function admin_all_transaction(Request $req){
        $q = DB::table('all_t_log')->join('merchant', 'all_t_log.uid', '=', 'merchant.id')->select('all_t_log.*', 'merchant.*','all_t_log.date AS viewdate')->orderBy('all_t_log.id','DESC');
        if(isset($req->user_name)){
            $q = $q->where('merchant.name','like', '%'.$req->user_name.'%');
        }
        if(isset($req->user_phone_number)){
            $q = $q->where('merchant.mobile','like', '%'.$req->user_phone_number.'%');
        }
        if(isset($req->from_date) || isset($req->to_date)){
            if(isset($req->from_date)){
                $fdate = date_min(dateu($req->from_date));
            }else{
                $fdate = date('Ymd');
            }
            if(isset($req->to_date)){
                $tdate = date_min(dateu($req->to_date));
            }else{
                $tdate = date('Ymd');
            }
            $q = $q->whereBetween('all_t_log.mindate',[$fdate,$tdate]);
        }
        $data['q'] = $q->paginate(30);
        return view('backend.admin.admin_all_transaction',$data);
    }
    public function admin_add_wallet_history_filter(Request $req){
        $sq = DB::table('add_money_log');
            $user_query = DB::table('merchant');
            if(isset($req->username)){
                $user_query = $user_query->where('name','like', '%'.$req->username.'%');
            }
            if(isset($req->phone_number)){
                $user_query = $user_query->where('mobile','like', '%'.$req->phone_number.'%');
            }
            $user_query = $user_query->get();
            $uid_array = array();
            foreach($user_query as $item){
                $uid_array[] = $item->id;
            }
            if(isset($req->username) || isset($req->phone_number)){   
                $sq = $sq->whereIn('userid',$uid_array);
            }
        if($req->filter_type == 1){
            $today = date('Ymd');
            $sq = $sq->where('min_date',$today);
        }
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
        if($req->filter_type == 4){
            if(isset($req->from_date)){
                if(isset($req->to_date)){
                    $frommin = date_min(dateu($req->from_date));
                    $tomin = date_min(dateu($req->to_date));
                    $sq = $sq->whereBetween('min_date',[$frommin,$tomin]);
                }else{
                    return redirect('admin_add_wallet_history')->with('error','Select to date');
                    die();
                }
            }else{
                return redirect('admin_add_wallet_history')->with('error','Select from date');
                die();
            }
        }
                if(isset($req->order_id_f)){
                    $sq = $sq->where('payment_id', 'like', '%'.$req->order_id_f.'%');
                }
                if(isset($req->order_amount_type) && isset($req->order_amount)){
                    if($req->order_amount_type == 1){
                        $sq = $sq->where('amount','<=',$req->order_amount);
                    }
                    if($req->order_amount_type == 3){
                        $sq = $sq->where('amount','=',$req->order_amount);
                    }
                    if($req->order_amount_type == 4){
                        $sq = $sq->where('amount','>=',$req->order_amount);
                    }
                    if($req->order_amount_type == 5){
                        $sq = $sq->where('amount','<',$req->order_amount);
                    }
                }
                if(isset($req->status_type)){
                    $sq = $sq->where('is_added', $req->status_type);
                }
                if(isset($req->payment_options)){
                    $sq = $sq->where('paymentoption', $req->payment_options);
                }
                if(isset($req->toup_options)){
                    $sq = $sq->where('topuptype', $req->toup_options);
                }
        $sq = $sq->orderBy('id','DESC')->paginate(30);
        $data['q'] = $sq;
        return view('backend.admin.admin_add_wallet_history',$data);
    }
    public function admin_internaltransitionlist()
    {
        $data['q'] = DB::table('funds_transfer_log')->orderBy('id','DESC')->paginate(30);
        return view('backend.admin.admin_internaltransitionlist',$data);
    }
    public function admin_internaltransitionlist_filter(Request $req)
    {
        $sq = DB::table('funds_transfer_log');
        if(!empty($req->filter_type)){
            if($req->filter_type == 2){
                $today = date('Ymd');
                $last_sev_date = date('Y-m-d', strtotime('-7 days'));
                $last_sev_date_min = date_min($last_sev_date);
                $sq = $sq->whereBetween('mindate',[$last_sev_date_min, $today]);
            }
            if($req->filter_type == 3){
                $fromdate = date('Y-m')."-1";
                $frommin = date_min($fromdate);
                $a_date = date('Y-m-d');
                $todate = date("Y-m-t", strtotime($a_date));
                $tomin = date_min($todate);
                $sq = $sq->whereBetween('mindate',[$frommin, $tomin]);
            }
            if($req->filter_type == 1){
                $today = date('Ymd');
                $sq = $sq->where('mindate',$today);
            }
            if($req->filter_type == 4){
                if(isset($req->from_date)){
                    if(isset($req->to_date)){
                        $frommin = date_min(dateu($req->from_date));
                        $tomin = date_min(dateu($req->to_date));
                        $sq = $sq->whereBetween('mindate',[$frommin,$tomin]);
                    }
                }
            }
        }
        $sq = $sq->orderBy('id','DESC')->paginate(30);
        $data['q'] = $sq;
        return view('backend.admin.admin_internaltransitionlist',$data);
    }
    public function admin_commition_all_history()
    {
        $data['q'] = DB::table('distribute_logs')->orderBy('id','DESC')->paginate(100);
        return view('backend.admin.admin_commition_all_history',$data);
    }
    public function admin_commition_all_history_filter(Request $req)
    {
        $sq = DB::table('distribute_logs');
        if(!empty($req->filter_type)){
            if($req->filter_type == 2){
                $today = date('Ymd');
                $last_sev_date = date('Y-m-d', strtotime('-7 days'));
                $last_sev_date_min = date_min($last_sev_date);
                $sq = $sq->whereBetween('getdate',[$last_sev_date_min, $today]);
            }
            if($req->filter_type == 3){
                $fromdate = date('Y-m')."-1";
                $frommin = date_min($fromdate);
                $a_date = date('Y-m-d');
                $todate = date("Y-m-t", strtotime($a_date));
                $tomin = date_min($todate);
                $sq = $sq->whereBetween('getdate',[$frommin, $tomin]);
            }
            if($req->filter_type == 1){
                $today = date('Ymd');
                $sq = $sq->where('getdate',$today);
            }
            if($req->filter_type == 4){
                if(isset($req->from_date)){
                    if(isset($req->to_date)){
                        $frommin = date_min(dateu($req->from_date));
                        $tomin = date_min(dateu($req->to_date));
                        $sq = $sq->whereBetween('getdate',[$frommin,$tomin]);
                    }
                }
            }
        }
        $sq = $sq->orderBy('id','DESC')->paginate(30);
        $data['q'] = $sq;
        return view('backend.admin.admin_commition_all_history',$data);
    }
    public function admin_deduct_money_history(){
        $data['q'] = DB::table('admin_add_money')->orderBy('id','DESC')->paginate(30);
        return view('backend.admin.admin_deduct_money_history',$data);
    }
    public function admin_deduct_money_history_filter(Request $req){
        $sq = DB::table('admin_add_money');
        if(!empty($req->filter_type)){
            if($req->filter_type == 2){
                $today = date('Ymd');
                $last_sev_date = date('Y-m-d', strtotime('-7 days'));
                $last_sev_date_min = date_min($last_sev_date);
                $sq = $sq->whereBetween('mindate',[$last_sev_date_min, $today]);
            }
            if($req->filter_type == 3){
                $fromdate = date('Y-m')."-1";
                $frommin = date_min($fromdate);
                $a_date = date('Y-m-d');
                $todate = date("Y-m-t", strtotime($a_date));
                $tomin = date_min($todate);
                $sq = $sq->whereBetween('mindate',[$frommin, $tomin]);
            }
            if($req->filter_type == 1){
                $today = date('Ymd');
                $sq = $sq->where('mindate',$today);
            }
            if($req->filter_type == 4){
                if(isset($req->from_date)){
                    if(isset($req->to_date)){
                        $frommin = date_min(dateu($req->from_date));
                        $tomin = date_min(dateu($req->to_date));
                        $sq = $sq->whereBetween('mindate',[$frommin,$tomin]);
                    }
                }
            }
        }
        $sq = $sq->orderBy('id','DESC')->paginate(30);
        $data['q'] = $sq;
        return view('backend.admin.admin_deduct_money_history',$data);
    }
    // cashbackdiscount
    public function cashbackdiscount(Type $var = null)
    {
        $data['count'] = DB::table('discountcashback')->count();
        return view('backend.admin.cashbackdiscount',$data);
    }    
    public function cashbackdiscount_form(Request $req){
        DB::table('discountcashback')->delete();
        $i=0;
        if(isset($req->d_status)){
            $d_status = 1;
        }else{
            $d_status = 0;
        }
        if(isset($req->md_status)){
            $md_status = 1;
        }else{
            $md_status = 0;
        }
        foreach($req->target as $list){    
            $data = array();
            $data['utype'] = 1;
            $data['mfd'] = date_min(dateu($req->d_from_date));
            $data['mtd'] = date_min(dateu($req->d_to_date));
            $data['fd'] = $req->d_from_date;
            $data['td'] = $req->d_to_date;
            $data['target_amount'] = $list;
            if($req->flat[$i] != null){
                $data['flat'] = $req->flat[$i];
            }
            if($req->per[$i]  != null){
                $data['discount'] = $req->per[$i];   
            }
            $data['status'] = $d_status;
            DB::table('discountcashback')->insert($data);
            $i++;
        }
        $j=0;
        foreach($req->mtarget as $list){            
            $data = array();
            $data['utype'] = 2;
            $data['mfd'] = date_min(dateu($req->m_from_date));
            $data['mtd'] = date_min(dateu($req->m_to_date));
            $data['fd'] = $req->m_from_date;
            $data['td'] = $req->m_to_date;
            $data['target_amount'] = $list;
            if($req->mflat[$j]  != null){
                $data['flat'] = $req->mflat[$j];
            }
            if($req->mper[$j]  != null){
                $data['discount'] = $req->mper[$j];
            }
            $data['status'] = $md_status;
            DB::table('discountcashback')->insert($data);
            $j++;
        }
        return back()->with('success','Updated');
    }
    // lein transfer 
    public function leintransfer()
    {
        $data['qlist'] = DB::table('merchant')->where('lein_wallet','>',0)->paginate(30);
        return view('backend.admin.leintransfer',$data);
    }
    public function admin_lein_filter(Request $req)
    {
        $q = DB::table('merchant')->where('lein_wallet','>',0);
        if(isset($req->filte)){
            $q = $q->where('mobile','like', '%'.$req->filte.'%');
        }
        $q = $q->paginate(30);
        $data['qlist'] = $q;
        return view('backend.admin.leintransfer',$data);
    }
    public function leintransfer_find_user_data(Request $req)
    {
        $check = DB::table('merchant')->where('is_deleted',0)->where('mobile',$req->phone_number)->first();
        if(!empty($check)){
            $data['account_data'] = $check;
            return view('backend.admin.leintransfer',$data);
        }else{
            return back()->with('error','No account found');
        }
    }
    public function multy_lein_tranfer_form(Request $req)
    {
        $remark = $req->remark;
        $amount = $req->t_amount;
        $type = $req->ttype;
        $is_success = 0;
        if($type == 1){
            foreach($req->users as $list){
                $q = DB::table('merchant')->where('id',$list)->first();
                $lein_wallet = $q->lein_wallet;
                if($lein_wallet >= $amount){
                    $curent_amount = $lein_wallet-$amount;
                    $data = array();
                    $data['uid'] = $q->id;
                    $data['ammount'] = $amount;
                    $data['date'] = date('Y-m-d');
                    $data['mindate'] =  date('Ymd');
                    $data['remark'] = $remark;
                    $data['time'] =  date('H:i:s a');
                    $data['bal'] = $curent_amount; 
                    $data['type'] = 1; 
                    DB::table('lein_to_wallet_log')->insert($data);
                    $data = array();
                    $data['lein_wallet'] = $curent_amount;
                    $user_wallet = $q->wallet+$amount;
                    $data['wallet'] = $user_wallet;
                    DB::table('merchant')->where('id',$q->id)->update($data);
                    inset_all_t_log(2,$amount,"Admin Transfer From Lein Wallet",$q->id,$curent_amount,"");
                    inset_all_t_log(1,$amount,"Add Main Wallet From Lein Wallet",$q->id,$user_wallet,"");
                    $is_success = 1;
                }
            }
        }
        if($type == 2){
            foreach($req->users as $list){
                $q = DB::table('merchant')->where('id',$list)->first();
                    $lein_wallet = $q->lein_wallet;
                    $curent_amount = $lein_wallet+$amount;
                    $data = array();
                    $data['uid'] = $q->id;
                    $data['ammount'] = $amount;
                    $data['date'] = date('Y-m-d');
                    $data['mindate'] =  date('Ymd');
                    $data['remark'] = $remark;
                    $data['time'] =  date('H:i:s a');
                    $data['bal'] = $curent_amount; 
                    DB::table('lein_to_wallet_log')->insert($data);
                    $data = array();
                    $data['lein_wallet'] = $curent_amount;
                    DB::table('merchant')->where('id',$q->id)->update($data);
                    inset_all_t_log(1,$amount,"Admin Add Money To Lein Wallet",$q->id,$curent_amount,"");
                    $msg_user = $amount." admin Add to lein wallet";
                    $data = array();
                    $data['time'] = time();
                    $data['date'] = date('Ymd');
                    $data['uid'] = $q->id;
                    $data['remark'] = $msg_user;
                    $data['view'] = 0;
                    $data['type'] = 1;
                    $data['amount'] = $amount;
                    DB::table('notification')->insert($data);
                    $is_success = 1;
            }
        }
        if($type == 3){
            foreach($req->users as $list){
                $q = DB::table('merchant')->where('id',$list)->first();
                $lein_wallet = $q->lein_wallet;
                if($lein_wallet >= $amount){
                    $curent_amount = $lein_wallet-$amount;
                    $data = array();
                    $data['uid'] = $q->id;
                    $data['ammount'] = $amount;
                    $data['date'] = date('Y-m-d');
                    $data['mindate'] =  date('Ymd');
                    $data['remark'] = $remark;
                    $data['time'] =  date('H:i:s a');
                    $data['bal'] = $curent_amount; 
                    DB::table('lein_to_wallet_log')->insert($data);
                    $data = array();
                    $data['lein_wallet'] = $curent_amount;
                    DB::table('merchant')->where('id',$q->id)->update($data);
                    $data = array();
                    $data['amount'] = $amount;
                    $data['date'] = date('Y-m-d');
                    $data['time'] = date('h:i:s a');
                    $data['mindate'] = date('Ymd');
                    $data['uid'] = $q->id;
                    $data['remark'] = $remark;
                    $data['type'] = 2;
                    DB::table('admin_add_money')->insert($data);
                    inset_all_t_log(2,$amount,"Admin Debuct From Lein Wallet",$q->id,$curent_amount,"");
                    $msg_user = $amount." admin debuct from lein wallet";
                    $data = array();
                    $data['time'] = time();
                    $data['date'] = date('Ymd');
                    $data['uid'] = $q->id;
                    $data['remark'] = $msg_user;
                    $data['view'] = 0;
                    $data['type'] = 2;
                    $data['amount'] = $amount;
                    DB::table('notification')->insert($data);
                    $is_success = 1;
                }
            }
        }
        if($is_success == 0){
            return redirect('leintransfer')->with('error','Insufficient balance');
        }
        if($is_success == 1){
            return redirect('leintransfer')->with('success','Transfer successful');
        }
    }
    public function leintransfer_form(Request $req)
    {
        $curent_amount = $req->leinwallet-$req->amount;
        $data = array();
        $data['uid'] = $req->uid;
        $data['ammount'] = $req->amount;
        $data['date'] = date('Y-m-d');
        $data['mindate'] =  date('Ymd');
        $data['remark'] = $req->remark;
        $data['time'] =  date('H:i:s a');
        $data['bal'] = $curent_amount; 
        DB::table('lein_to_wallet_log')->insert($data);
        $data = array();
        $data['lein_wallet'] = $curent_amount;
        DB::table('merchant')->where('id',$req->uid)->update($data);
        inset_all_t_log(1,$req->amount,"Admin Transfer",$req->uid,$curent_amount,"");
        return redirect('leintransfer')->with('success','Transfer successful');
     }
     // bank details
     public function bankdetailsupdate(Request $req)
     {
        $data['qlist'] = DB::table('bank_data')->where('is_deleted',0)->orderBy('id','DESC')->paginate(50);
         if(isset($req->id)){
            $data['editq'] = DB::table('bank_data')->where('id',$req->id)->first();
         }
        return view('backend.admin.bankdetailsupdate',$data);
     }
     public function bankdetailsupdate_form(Request $req)
     {
         $data = array();
         $data['bank_names'] = $req->bank_names;
         $data['ifsc_code'] = $req->ifsc_code;
         if(isset($req->editid)){
             DB::table('bank_data')->where('id',$req->editid)->update($data);
             return redirect('bankdetailsupdate')->with('success','Updated');
         }else{
            DB::table('bank_data')->insert($data);
            return back()->with('success','Inserted');
         }
     }
     public function bankdetailsdelete($id)
     {
         DB::table('bank_data')->where('id',$id)->update(['is_deleted'=>1]);
         return back()->with('success','Deleted');
     }
     // bank_transfer_fees
     public function bank_transfer_fees(Type $var = null)
     {
         $data['count'] = DB::table('bankaccount_fees')->count();
         return view('backend.admin.bank_transfer_fees',$data);
     }
     public function bank_transfer_fees_form(Request $req)
     {
         DB::table('active_payout_type')->delete();
         DB::table('active_payout_type')->insert(['type'=>$req->active_payout]);
         $i = 0;
         DB::table('bankaccount_fees')->delete();
         foreach($req->fromprice as $list){
            $data = array();
            $data['from_price'] = $list;
            $data['to_price'] = $req->toprice[$i];
            $data['tax'] = $req->tax[$i];
            DB::table('bankaccount_fees')->insert($data);
            $i++;
         }
         return redirect('bank_transfer_fees')->with('success','Price update');
     }
     // offerpopup
     public function offerpopup()
     {         
         return view('backend.admin.offerpopup');
     }
     public function offerpopup_form(Request $req)
     {
         $check = DB::table('offer_popup')->first();
         $data = array();
         $data['link'] = $req->link;
         $data['is_active'] = 0;
         if(isset($req->image)){
             $data['image'] = $req->file('image')->store('offers');
         }
         if(empty($check)){
             DB::table('offer_popup')->insert($data);
         }else{
            DB::table('offer_popup')->where('id',$check->id)->update($data);
         }
         return back()->with('success','Updated');
     }
     // admincreateuser
     public function admincreateuser(Type $var = null)
     {
        $data['stateq'] = DB::table('state')->OrderBy('name','ASC')->get();
        return view('backend.admin.admincreateuser',$data);
     }
     // notification
     public function count_admin_notification(Request $req)
     {
        $notification = DB::table('admin_notification')->where('view',0)->count();
        return $notification;
     }
     public function change_admin_notification(Request $req)
     {
        DB::table('admin_notification')->update(['view'=>1]);
        return 0;
     }
     public function merchant_business(Request $req)
     {
        $last_saven = date('Ymd', strtotime('-7 days'));
        if(isset($req->from_date)){
            $fromdate = date_min(dateu($req->from_date));
        }    
        if(isset($req->to_date)){
            $todate = date_min(dateu($req->to_date));
        }
        $distibutor = DB::table('merchant')->where('type',1);
        if(isset($req->user_name)){
            $distibutor = $distibutor->where('name','like', '%'.$req->user_name.'%');
        }    
        $distibutor = $distibutor->get();
        $distibutor_id = array();
        foreach($distibutor as $list){
            $distibutor_id[] = $list->id;
        }
        $user_query = DB::table('merchant')->where('type',1)->where('is_deleted',0)->get();
        $userarray = array();
        foreach ($user_query as $list) {
            $userarray[] = $list->id;
        }
        $wallet_add_q = DB::table('add_money_log')->whereIn('userid',$userarray)->where('is_fail',0);
        $payout_q = DB::table('payout')->whereIn('uid',$userarray);
        $account_verify_q = DB::table('merchant_bank_accounts')->whereIn('uid',$userarray)->where('bank_verify',1);
        if($req->filter_type == 1){
            $wallet_add_q = $wallet_add_q->where('min_date',date('Ymd'));
            $wallet_add_count = $wallet_add_q->where('min_date',date('Ymd'));
            $payout_q = $payout_q->where('mindate',date('Ymd'));
            $payout_q_count = $payout_q->where('mindate',date('Ymd'));
            $account_verify_q = $account_verify_q->where('mindate',date('Ymd'));
            $account_verify_count = $account_verify_q->where('mindate',date('Ymd'));
        }
        if($req->filter_type == 2){
            $wallet_add_q = $wallet_add_q->whereBetween('min_date',[$last_saven,date('Ymd')]);
            $wallet_add_count = $wallet_add_q->whereBetween('min_date',[$last_saven,date('Ymd')]);
            $payout_q = $payout_q->whereBetween('mindate',[$last_saven,date('Ymd')]);
            $payout_q_count = $payout_q->whereBetween('mindate',[$last_saven,date('Ymd')]);
            $account_verify_q = $account_verify_q->whereBetween('mindate',[$last_saven,date('Ymd')]);
            $account_verify_count = $account_verify_q->whereBetween('mindate',[$last_saven,date('Ymd')]);
        }
        if($req->filter_type == 3){
            $wallet_add_q = $wallet_add_q->whereBetween('min_date',[date('Ym01'),date('Ymd')]);
            $wallet_add_count = $wallet_add_q->whereBetween('min_date',[date('Ym01'),date('Ymd')]);
            $payout_q = $payout_q->whereBetween('mindate',[date('Ym01'),date('Ymd')]);
            $payout_q_count = $payout_q->whereBetween('mindate',[date('Ym01'),date('Ymd')]);
            $account_verify_q = $account_verify_q->whereBetween('mindate',[date('Ym01'),date('Ymd')]);
            $account_verify_count = $account_verify_q->whereBetween('mindate',[date('Ym01'),date('Ymd')]);
        }
        if($req->filter_type == 4){
            $wallet_add_q = $wallet_add_q->whereBetween('min_date',[$fromdate,$todate]);
            $wallet_add_count = $wallet_add_q->whereBetween('min_date',[$fromdate,$todate]);
            $payout_q = $payout_q->whereBetween('mindate',[$fromdate,$todate]);
            $payout_q_count = $payout_q->whereBetween('mindate',[$fromdate,$todate]);
            $account_verify_q = $account_verify_q->whereBetween('mindate',[$fromdate,$todate]);
            $account_verify_count = $account_verify_q->whereBetween('mindate',[$fromdate,$todate]);
        }
        if($req->filter_type == 7){
            $wallet_add_q = $wallet_add_q->orderBy('amount','DESC')->paginate(10);
            $wallet_add_count = $wallet_add_q->sum('amount');
            $payout_q = $payout_q->orderby('amount','DESC')->paginate(10);
            $payout_q_count = $payout_q->sum('amount');
            $account_verify_q = $account_verify_q->orderby('id','DESC')->paginate(10);
            $account_verify_count = $account_verify_q->count();
        }else{
            $wallet_add_q = $wallet_add_q->orderBy('id','DESC')->paginate(10);
            
            $wallet_add_count = $wallet_add_q->sum('amount');
            $payout_q = $payout_q->orderby('id','DESC')->paginate(10);
            $payout_q_count = $payout_q->sum('amount');
            $account_verify_q = $account_verify_q->orderby('id','DESC')->paginate(10);
            $account_verify_count = $account_verify_q->count();
        }
        $data['wallet_added'] = $wallet_add_q;
        $data['wallet_added_total'] = $wallet_add_count;
        $data['total_payout_done'] = $payout_q;
        $data['total_payout_done_total'] = $payout_q_count;
        $data['total_account_verified'] = $account_verify_q;
        $data['total_account_verified_total'] = $account_verify_count;
         $data['title'] = "Merchant";
         $data['filter_url'] = "merchant_business";
         return view('backend.admin.admin_total_business',$data);
     }
     
     public function distibutor_business(Request $req)
     {
        $last_saven = date('Ymd', strtotime('-7 days'));
        if(isset($req->from_date)){
            $fromdate = date_min(dateu($req->from_date));
        }    
        if(isset($req->to_date)){
            $todate = date_min(dateu($req->to_date));
        }
        $distibutor = DB::table('merchant')->where('type',3)->where('is_deleted',0);
        if(isset($req->user_name)){
            $distibutor = $distibutor->where('name','like', '%'.$req->user_name.'%');
        }    
        $distibutor = $distibutor->get();
        $distibutor_id = array();
        foreach($distibutor as $list){
            $distibutor_id[] = $list->id;
        }
        $user_query = DB::table('merchant')->whereIn('refer_uid',$distibutor_id)->where('is_deleted',0)->get();
        $userarray = array();
        foreach ($user_query as $list) {
            $userarray[] = $list->id;
        }
        $wallet_add_q = DB::table('add_money_log')->whereIn('userid',$userarray)->where('is_fail',0);
        $payout_q = DB::table('payout')->whereIn('uid',$userarray);
        $account_verify_q = DB::table('merchant_bank_accounts')->whereIn('uid',$userarray)->where('bank_verify',1);
        if($req->filter_type == 1){
            $wallet_add_q = $wallet_add_q->where('min_date',date('Ymd'));
            $wallet_add_count = $wallet_add_q->where('min_date',date('Ymd'));
            $payout_q = $payout_q->where('mindate',date('Ymd'));
            $payout_q_count = $payout_q->where('mindate',date('Ymd'));
            $account_verify_q = $account_verify_q->where('mindate',date('Ymd'));
            $account_verify_count = $account_verify_q->where('mindate',date('Ymd'));
        }
        if($req->filter_type == 2){
            $wallet_add_q = $wallet_add_q->whereBetween('min_date',[$last_saven,date('Ymd')]);
            $wallet_add_count = $wallet_add_q->whereBetween('min_date',[$last_saven,date('Ymd')]);
            $payout_q = $payout_q->whereBetween('mindate',[$last_saven,date('Ymd')]);
            $payout_q_count = $payout_q->whereBetween('mindate',[$last_saven,date('Ymd')]);
            $account_verify_q = $account_verify_q->whereBetween('mindate',[$last_saven,date('Ymd')]);
            $account_verify_count = $account_verify_q->whereBetween('mindate',[$last_saven,date('Ymd')]);
        }
        if($req->filter_type == 3){
            $wallet_add_q = $wallet_add_q->whereBetween('min_date',[date('Ym01'),date('Ymd')]);
            $wallet_add_count = $wallet_add_q->whereBetween('min_date',[date('Ym01'),date('Ymd')]);
            $payout_q = $payout_q->whereBetween('mindate',[date('Ym01'),date('Ymd')]);
            $payout_q_count = $payout_q->whereBetween('mindate',[date('Ym01'),date('Ymd')]);
            $account_verify_q = $account_verify_q->whereBetween('mindate',[date('Ym01'),date('Ymd')]);
            $account_verify_count = $account_verify_q->whereBetween('mindate',[date('Ym01'),date('Ymd')]);
        }
        if($req->filter_type == 4){
            $wallet_add_q = $wallet_add_q->whereBetween('min_date',[$fromdate,$todate]);
            $wallet_add_count = $wallet_add_q->whereBetween('min_date',[$fromdate,$todate]);
            $payout_q = $payout_q->whereBetween('mindate',[$fromdate,$todate]);
            $payout_q_count = $payout_q->whereBetween('mindate',[$fromdate,$todate]);
            $account_verify_q = $account_verify_q->whereBetween('mindate',[$fromdate,$todate]);
            $account_verify_count = $account_verify_q->whereBetween('mindate',[$fromdate,$todate]);
        }
        if($req->filter_type == 7){
            $wallet_add_q = $wallet_add_q->orderBy('amount','DESC')->paginate(10);
            $wallet_add_count = $wallet_add_q->sum('amount');
            $payout_q = $payout_q->orderby('amount','DESC')->paginate(10);
            $payout_q_count = $payout_q->sum('amount');
            $account_verify_q = $account_verify_q->orderby('id','DESC')->paginate(10);
            $account_verify_count = $account_verify_q->count();
        }else{
            $wallet_add_q = $wallet_add_q->orderBy('id','DESC')->paginate(10);
            
            $wallet_add_count = $wallet_add_q->sum('amount');
            $payout_q = $payout_q->orderby('id','DESC')->paginate(10);
            $payout_q_count = $payout_q->sum('amount');
            $account_verify_q = $account_verify_q->orderby('id','DESC')->paginate(10);
            $account_verify_count = $account_verify_q->count();
        }
        $data['wallet_added'] = $wallet_add_q;
        $data['wallet_added_total'] = $wallet_add_count;
        $data['total_payout_done'] = $payout_q;
        $data['total_payout_done_total'] = $payout_q_count;
        $data['total_account_verified'] = $account_verify_q;
        $data['total_account_verified_total'] = $account_verify_count;
         $data['title'] = "Distibutor";
         $data['filter_url'] = "distibutor_business";
         return view('backend.admin.admin_total_business',$data);
     }
     public function master_distibutor_business(Request $req)
     {
        $last_saven = date('Ymd', strtotime('-7 days'));
        if(isset($req->from_date)){
            $fromdate = date_min(dateu($req->from_date));
        }    
        if(isset($req->to_date)){
            $todate = date_min(dateu($req->to_date));
        }
        $distibutor = DB::table('merchant')->where('type',4)->where('is_deleted',0);
        if(isset($req->user_name)){
            $distibutor = $distibutor->where('name','like', '%'.$req->user_name.'%');
        }    
        $distibutor = $distibutor->get();
        $distibutor_id = array();
        foreach($distibutor as $list){
            $distibutor_id[] = $list->id;
        }
        $user_query = DB::table('merchant')->whereIn('refer_uid',$distibutor_id)->where('is_deleted',0)->get();
        $userarray = array();
        foreach ($user_query as $list) {
            $userarray[] = $list->id;
        }
        $wallet_add_q = DB::table('add_money_log')->whereIn('userid',$userarray)->where('is_fail',0);
        $payout_q = DB::table('payout')->whereIn('uid',$userarray);
        $account_verify_q = DB::table('merchant_bank_accounts')->whereIn('uid',$userarray)->where('bank_verify',1);
        if($req->filter_type == 1){
            $wallet_add_q = $wallet_add_q->where('min_date',date('Ymd'));
            $wallet_add_count = $wallet_add_q->where('min_date',date('Ymd'));
            $payout_q = $payout_q->where('mindate',date('Ymd'));
            $payout_q_count = $payout_q->where('mindate',date('Ymd'));
            $account_verify_q = $account_verify_q->where('mindate',date('Ymd'));
            $account_verify_count = $account_verify_q->where('mindate',date('Ymd'));
        }
        if($req->filter_type == 2){
            $wallet_add_q = $wallet_add_q->whereBetween('min_date',[$last_saven,date('Ymd')]);
            $wallet_add_count = $wallet_add_q->whereBetween('min_date',[$last_saven,date('Ymd')]);
            $payout_q = $payout_q->whereBetween('mindate',[$last_saven,date('Ymd')]);
            $payout_q_count = $payout_q->whereBetween('mindate',[$last_saven,date('Ymd')]);
            $account_verify_q = $account_verify_q->whereBetween('mindate',[$last_saven,date('Ymd')]);
            $account_verify_count = $account_verify_q->whereBetween('mindate',[$last_saven,date('Ymd')]);
        }
        if($req->filter_type == 3){
            $wallet_add_q = $wallet_add_q->whereBetween('min_date',[date('Ym01'),date('Ymd')]);
            $wallet_add_count = $wallet_add_q->whereBetween('min_date',[date('Ym01'),date('Ymd')]);
            $payout_q = $payout_q->whereBetween('mindate',[date('Ym01'),date('Ymd')]);
            $payout_q_count = $payout_q->whereBetween('mindate',[date('Ym01'),date('Ymd')]);
            $account_verify_q = $account_verify_q->whereBetween('mindate',[date('Ym01'),date('Ymd')]);
            $account_verify_count = $account_verify_q->whereBetween('mindate',[date('Ym01'),date('Ymd')]);
        }
        if($req->filter_type == 4){
            $wallet_add_q = $wallet_add_q->whereBetween('min_date',[$fromdate,$todate]);
            $wallet_add_count = $wallet_add_q->whereBetween('min_date',[$fromdate,$todate]);
            $payout_q = $payout_q->whereBetween('mindate',[$fromdate,$todate]);
            $payout_q_count = $payout_q->whereBetween('mindate',[$fromdate,$todate]);
            $account_verify_q = $account_verify_q->whereBetween('mindate',[$fromdate,$todate]);
            $account_verify_count = $account_verify_q->whereBetween('mindate',[$fromdate,$todate]);
        }
        if($req->filter_type == 7){
            $wallet_add_q = $wallet_add_q->orderBy('amount','DESC')->paginate(10);
            $wallet_add_count = $wallet_add_q->sum('amount');
            $payout_q = $payout_q->orderby('amount','DESC')->paginate(10);
            $payout_q_count = $payout_q->sum('amount');
            $account_verify_q = $account_verify_q->orderby('id','DESC')->paginate(10);
            $account_verify_count = $account_verify_q->count();
        }else{
            $wallet_add_q = $wallet_add_q->orderBy('id','DESC')->paginate(10);
            $wallet_add_count = $wallet_add_q->sum('amount');
            $payout_q = $payout_q->orderby('id','DESC')->paginate(10);
            $payout_q_count = $payout_q->sum('amount');
            $account_verify_q = $account_verify_q->orderby('id','DESC')->paginate(10);
            $account_verify_count = $account_verify_q->count();
        }
        $data['wallet_added'] = $wallet_add_q;
        $data['wallet_added_total'] = $wallet_add_count;
        $data['total_payout_done'] = $payout_q;
        $data['total_payout_done_total'] = $payout_q_count;
        $data['total_account_verified'] = $account_verify_q;
        $data['total_account_verified_total'] = $account_verify_count;
         $data['title'] = "Master Distibutor";
         $data['filter_url'] = "master_distibutor_business";
         return view('backend.admin.admin_total_business',$data);
     }
     public function ajax_info_filter_admin(Request $req)
     {
        $t = "";
        if($req->value == 5){
            $fdate = date_min(dateu($req->fdate));
            $tdate = date_min(dateu($req->tdate));
        }
        if($req->boxid == 1){
            if($req->value == 1){
                $t = DB::table('add_money_log')->where('is_added',1)->sum('total_amount');
            }
            if($req->value == 2){
                $t = DB::table('add_money_log')->where('min_date',date('Ymd'))->where('is_added',1)->sum('total_amount');
            }
            if($req->value == 3){
                $t = DB::table('add_money_log')->whereBetween('min_date',[date('Ymd', strtotime('-7 days')),date('Ymd')])->where('is_added',1)->sum('total_amount');
            }
            if($req->value == 4){
                $t = DB::table('add_money_log')->whereBetween('min_date',[date('Ym01'), date('Ymd')])->where('is_added',1)->sum('total_amount');
            }
            if($req->value == 5){
                $t = DB::table('add_money_log')->whereBetween('min_date',[$fdate, $tdate])->where('is_added',1)->sum('total_amount');
            }
        }
        if($req->boxid == 2){
            if($req->value == 1){
                $t = DB::table('add_money_log')->where('is_added',0)->count();
            }
            if($req->value == 2){
                $t = DB::table('add_money_log')->where('min_date',date('Ymd'))->where('is_added',0)->count();
            }
            if($req->value == 3){
                $t = DB::table('add_money_log')->whereBetween('min_date',[date('Ymd', strtotime('-7 days')),date('Ymd')])->where('is_added',0)->count();
            }
            if($req->value == 4){
                $t = DB::table('add_money_log')->whereBetween('min_date',[date('Ym01'), date('Ymd')])->where('is_added',0)->count();
            }
            if($req->value == 5){
                $t = DB::table('add_money_log')->whereBetween('min_date',[$fdate, $tdate])->where('is_added',0)->count();
            }
        }
        if($req->boxid == 3){
            if($req->value == 1){
                $t = DB::table('add_money_log')->where('is_added',1)->count();
            }
            if($req->value == 2){
                $t = DB::table('add_money_log')->where('min_date',date('Ymd'))->where('is_added',1)->count();
            }
            if($req->value == 3){
                $t = DB::table('add_money_log')->whereBetween('min_date',[date('Ymd', strtotime('-7 days')),date('Ymd')])->where('is_added',1)->count();
            }
            if($req->value == 4){
                $t = DB::table('add_money_log')->whereBetween('min_date',[date('Ym01'), date('Ymd')])->where('is_added',1)->count();
            }
            if($req->value == 5){
                $t = DB::table('add_money_log')->whereBetween('min_date',[$fdate, $tdate])->where('is_added',1)->count();
            }
        }
        if($req->boxid == 4){
            if($req->value == 1){
                $t = DB::table('add_money_log')->where('is_added',3)->count();
            }
            if($req->value == 2){
                $t = DB::table('add_money_log')->where('min_date',date('Ymd'))->where('is_added',3)->count();
            }
            if($req->value == 3){
                $t = DB::table('add_money_log')->whereBetween('min_date',[date('Ymd', strtotime('-7 days')),date('Ymd')])->where('is_added',3)->count();
            }
            if($req->value == 4){
                $t = DB::table('add_money_log')->whereBetween('min_date',[date('Ym01'), date('Ymd')])->where('is_added',3)->count();
            }
            if($req->value == 5){
                $t = DB::table('add_money_log')->whereBetween('min_date',[$fdate, $tdate])->where('is_added',3)->count();
            }
        }
        if($req->boxid == 5){
            if($req->value == 1){
                $t = DB::table('payout')->where('status',0)->count();
            }
            if($req->value == 2){
                $t = DB::table('payout')->where('mindate',date('Ymd'))->where('status',0)->count();
            }
            if($req->value == 3){
                $t = DB::table('payout')->whereBetween('mindate',[date('Ymd', strtotime('-7 days')),date('Ymd')])->where('status',0)->count();
            }
            if($req->value == 4){
                $t = DB::table('payout')->whereBetween('mindate',[date('Ym01'), date('Ymd')])->where('status',0)->count();
            }
            if($req->value == 5){
                $t = DB::table('payout')->whereBetween('mindate',[$fdate, $tdate])->where('status',0)->count();
            }
        }
        if($req->boxid == 6){
            if($req->value == 1){
                $t = DB::table('payout')->where('status',1)->count();
            }
            if($req->value == 2){
                $t = DB::table('payout')->where('mindate',date('Ymd'))->where('status',1)->count();
            }
            if($req->value == 3){
                $t = DB::table('payout')->whereBetween('mindate',[date('Ymd', strtotime('-7 days')),date('Ymd')])->where('status',1)->count();
            }
            if($req->value == 4){
                $t = DB::table('payout')->whereBetween('mindate',[date('Ym01'), date('Ymd')])->where('status',1)->count();
            }
            if($req->value == 5){
                $t = DB::table('payout')->whereBetween('mindate',[$fdate, $tdate])->where('status',1)->count();
            }
        }
        if($req->boxid == 7){
            if($req->value == 1){
                $t = DB::table('payout')->where('status',2)->count();
            }
            if($req->value == 2){
                $t = DB::table('payout')->where('mindate',date('Ymd'))->where('status',2)->count();
            }
            if($req->value == 3){
                $t = DB::table('payout')->whereBetween('mindate',[date('Ymd', strtotime('-7 days')),date('Ymd')])->where('status',2)->count();
            }
            if($req->value == 4){
                $t = DB::table('payout')->whereBetween('mindate',[date('Ym01'), date('Ymd')])->where('status',2)->count();
            }
            if($req->value == 5){
                $t = DB::table('payout')->whereBetween('mindate',[$fdate, $tdate])->where('status',2)->count();
            }
        }
        if($req->boxid == 8){
            if($req->value == 1){
                $t = DB::table('funds_transfer_log')->where('type',1)->sum('amount');
            }
            if($req->value == 2){
                $t = DB::table('funds_transfer_log')->where('mindate',date('Ymd'))->where('type',1)->sum('amount');
            }
            if($req->value == 3){
                $t = DB::table('funds_transfer_log')->whereBetween('mindate',[date('Ymd', strtotime('-7 days')),date('Ymd')])->where('type',1)->sum('amount');
            }
            if($req->value == 4){
                $t = DB::table('funds_transfer_log')->whereBetween('mindate',[date('Ym01'), date('Ymd')])->where('type',1)->sum('amount');
            }
            if($req->value == 5){
                $t = DB::table('funds_transfer_log')->whereBetween('mindate',[$fdate, $tdate])->where('type',1)->sum('amount');
            }
        }
        if($req->boxid == 9){
            if($req->value == 1){
                $t = DB::table('funds_transfer_log')->where('type',1)->count();
            }
            if($req->value == 2){
                $t = DB::table('funds_transfer_log')->where('mindate',date('Ymd'))->where('type',1)->count();
            }
            if($req->value == 3){
                $t = DB::table('funds_transfer_log')->whereBetween('mindate',[date('Ymd', strtotime('-7 days')),date('Ymd')])->where('type',1)->count();
            }
            if($req->value == 4){
                $t = DB::table('funds_transfer_log')->whereBetween('mindate',[date('Ym01'), date('Ymd')])->where('type',1)->count();
            }
            if($req->value == 5){
                $t = DB::table('funds_transfer_log')->whereBetween('mindate',[$fdate, $tdate])->where('type',1)->count();
            }
        }
        if($req->boxid == 10){
            if($req->value == 1){
                $t = DB::table('payout')->count();
            }
            if($req->value == 2){
                $t = DB::table('payout')->where('mindate',date('Ymd'))->count();
            }
            if($req->value == 3){
                $t = DB::table('payout')->whereBetween('mindate',[date('Ymd', strtotime('-7 days')),date('Ymd')])->count();
            }
            if($req->value == 4){
                $t = DB::table('payout')->whereBetween('mindate',[date('Ym01'), date('Ymd')])->count();
            }
            if($req->value == 5){
                $t = DB::table('payout')->whereBetween('mindate',[$fdate, $tdate])->count();
            }
        }
        if($req->boxid == 11){
            if($req->value == 1){
                $t = DB::table('payout')->sum('amount');
            }
            if($req->value == 2){
                $t = DB::table('payout')->where('mindate',date('Ymd'))->sum('amount');
            }
            if($req->value == 3){
                $t = DB::table('payout')->whereBetween('mindate',[date('Ymd', strtotime('-7 days')),date('Ymd')])->sum('amount');
            }
            if($req->value == 4){
                $t = DB::table('payout')->whereBetween('mindate',[date('Ym01'), date('Ymd')])->sum('amount');
            }
            if($req->value == 5){
                $t = DB::table('payout')->whereBetween('mindate',[$fdate, $tdate])->sum('amount');
            }
        }
        return $t;
     }
      // admin mapping
     public function admin_mapping_request()
     {
        $data['q'] = DB::table('mapping')->orderby('admin_status','ASC')->paginate(15);
        return view('backend.admin.admin_mapping_request',$data);
     }
     public function accept_mapping_request($id)
    {
        $check = DB::table('mapping')->where('id',$id)->first();
        if(!empty($check)){
            DB::table('mapping')->where('id',$id)->update(['admin_status'=>1]);
            DB::table('merchant')->where('id',$check->uid)->update(['refer_uid'=>$check->refferid]);
            return back()->with('success','Request accepted');
        }else{
            return back();
        }
    }
    public function rejecte_mapping_request($id)
    {
        $check = DB::table('mapping')->where('id',$id)->first();
        if(!empty($check)){
            DB::table('mapping')->where('id',$id)->update(['admin_status'=>2]);
            return back()->with('success','Request rejected');
        }else{
            return back();
        }
    }
    public function find_mapping_data_form(Request $req)
    {
        if(isset($req->reffer_user_id)){
            if(!empty($req->reffer_user_id)){
                DB::table('merchant')->where('id',$req->main_user_id)->update(['refer_uid'=>$req->reffer_user_id]);
                return back()->with('success','User mapping successful');
            }else{
                require back()->with('error','Try again');
            }
        }else{
            $user_data = DB::table('merchant')->where('id',$req->main_user_id)->first();
            $find_q = DB::table('merchant')->where('type',$req->reffer_user_type)->where('mobile',$req->phone_number)->first();
            if(!empty($find_q)){
                if($user_data->refer_uid == $find_q->id){
                    return back()->with('error','User alredy under this '.get_user_type($find_q->type));
                }else{
                session()->put('find_q',$find_q->id);
                return back();
                }
            }else{
                return back()->with('error','User not found');
            }
        }

    }
    // update_credentials
    public function update_credentials()
    {
        $data['update_credentials'] = DB::table('admin_users')->first();
        return view('backend.admin.update_credentials',$data);
    }
    public function update_credentials_post(Request $req)
    {
        $admin = DB::table('admin_users')->first();
        if(Hash::check($req->oldpass,$admin->password)){
            if(!empty($req->username) || !empty($req->pass)){
            $data = array();
            if(isset($req->username)){
                $data['email'] = $req->username;
            }
            if(isset($req->pass)){
                $data['password'] = Hash::make($req->pass);
            }
            DB::table('admin_users')->where('id',$admin->id)->update($data);
            return back()->with('success','Login details updated');
           }else{
            return back()->with('error','Field are empty');   
           }
        }else{
            return back()->with('error','Old password not match');
        }
    }
    public function get_user_data(Request $req)
    {
        $data = get_company_all_data_byid($req->uid);
        return json_encode($data);
    }
    public function errorlog()
    {
        $q =  DB::table('errorlog')->join('merchant', 'errorlog.uid', '=', 'merchant.id')->where('errorlog.isfix',0)->select('errorlog.*', 'merchant.*','errorlog.mindate AS errordate','errorlog.id AS errorid','errorlog.date AS errordate');
        $q = $q->paginate(10);
        $data['qlist'] = $q;
        return view('backend.admin.errorlog',$data);
    }
    public function tranaction_check_cronjob()
    {
        tranaction_check_cronjob();
    }
    public function cleneerror($id)
    {
        $q = DB::table('errorlog')->where('id',$id)->where('isfix',0)->count();
        if($q > 0){
            $qdata = DB::table('errorlog')->where('id',$id)->where('isfix',0)->first();
            $udata = get_company_all_data_byid($qdata->uid);
            if($qdata->type == 1){
                $wallet_log_q = DB::table('wallet_add_log')->where('id',$qdata->add_money_id)->first();
                DB::table('merchant')->where('id',$udata->id)->update(['wallet'=>$udata->wallet-$wallet_log_q->amount]);
                DB::table('errorlog')->where('id',$id)->where('isfix',0)->update(['isfix'=>1]);
                DB::table('wallet_add_log')->where('id',$wallet_log_q->id)->delete();    
                $count_is_exist_wallet_log = DB::table('errorlog')->where('uid',$qdata->uid)->where('isfix',0)->count();
                if($count_is_exist_wallet_log < 1){
                    DB::table('merchant')->where('id',$udata->id)->update(['is_active'=>1]);
                }
            }else{
            $add_wallet_q = DB::table('add_money_log')->where('id',$qdata->add_money_id)->first();
            DB::table('merchant')->where('id',$udata->id)->update(['wallet'=>$udata->wallet-$add_wallet_q->total_amount]);
            DB::table('add_money_log')->where('id',$qdata->add_money_id)->delete();
            DB::table('errorlog')->where('id',$id)->where('isfix',0)->update(['isfix'=>1]);
            $count_is_exist_wallet_log = DB::table('errorlog')->where('uid',$qdata->uid)->where('isfix',0)->count();
            if($count_is_exist_wallet_log < 1){
                DB::table('merchant')->where('id',$udata->id)->update(['is_active'=>1]);
            }
        }
        }
        return back()->with('success','Cleaned');
    }
    public function errorcount_ajax(Request $req)
    {
        $array = array();
        $check_cound = DB::table('errorlog')->where('isfix',0)->where('is_view',0)->count();
        $check = DB::table('errorlog')->where('isfix',0)->count();
        if($check_cound > 0){
            DB::table('errorlog')->where('isfix',0)->update(['is_view'=>1]);
            $array['sound'] = 1;
        }
        $array['no'] = $check;
        return json_encode($array);
    }
    public function adminleintomain()
    {
        $data['qlist'] = DB::table('adminleintomain')->orderBy('id','DESC')->paginate(10);
        return view('backend.admin.adminleintomain',$data);
    }
    public function adminleintomain_form(Request $req)
    {
        $total = get_admin_total_wallet();
        $main = get_admin_main_wallet();
        $count = $total-$main;
        if($count >= $req->amount){
            $data = array();
            $data['amount'] = $req->amount;
            $data['lein'] = $count-$req->amount;
            $data['main'] = $main+$req->amount;
            $data['mindate'] = date('Ymd');
            $data['date'] = date('d-m-Y');
            DB::table('adminleintomain')->insert($data);
            return back()->with('success','Successful');
        }else{
            return back()->with('error','Insufficient balance');
        }
    }
}
