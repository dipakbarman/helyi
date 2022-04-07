<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Type $var = null)
    { 
        return view('site.index');
    }
    public function about()
    {
        return view('site.about');
    }
    public function b()
    {
        return view('site.b');
    }
    public function bill_payment()
    {
        return view('site.bill_payment');
    }
    public function business()
    {
        return view('site.business');
    }
    public function contact()
    {
        return view('site.contact');
    }
    public function distributor()
    {
        return view('site.distributor');
    }
    public function masterdistributor()
    {
        return view('site.masterdistributor');
    }
    public function partner()
    {
        return view('site.partner');
    }
    public function privacy_policy()
    {
        return view('site.privacy_policy');
    }
    public function retailer()
    {
        return view('site.retailer');
    }
    public function retutn_refundpolicy()
    {
        return view('site.retutn_refundpolicy');
    }
    public function terms_conditions()
    {
        return view('site.terms_conditions');
    }
}
