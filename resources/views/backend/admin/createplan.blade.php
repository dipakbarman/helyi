@extends('backend.master')
@section('body')
@php
$plan_type = "";
$planlogo = "";
$is_active = "";
$monthly_limit = "";
$limit_per_day = "";
$t0_hours = "";
$package_name = "";
$price = "";
$debit_card_instant = "";
$debit_card_t0 = "";
$debit_card_t1 = "";
$debit_card_t2 = "";
$netbanking_instant = "";
$netbanking_t0 = "";
$netbanking_t1 = "";
$netbanking_t2 = "";
$upi_instant = "";
$upi_t0 = "";
$upi_t1 = "";
$upi_t2 = "";
$credit_Card_instant = "";
$credit_card_t0 = "";
$credit_card_t1 = "";
$credit_card_t2 = "";
$amex_card_instant = "";
$amex_card_t0 = "";
$amex_card_t1 = "";
$amex_card_t2 = "";
$diners_card_instant = "";
$diners_card_t0 = "";
$diners_card_t1 = "";
$diners_card_t2 = "";
$wallet_instant = "";
$wallet_t0 = "";
$wallet_t1 = "";
$wallet_t2 = "";
$corporate_card_instant = "";
$corporate_card_t0 = "";
$corporate_card_t1 = "";
$corporate_card_t2 = "";
$prepaid_card_instant = "";
$prepaid_card_t0 = "";
$prepaid_card_t1 = "";
$prepaid_card_t2 = "";
// $debit_base_per = "";
// $netbanking_base_per = "";
// $upi_base_per = "";
// $credit_card_base_per = "";
// $amex_card_base_per = "";
// $diners_card_base_per = "";
// $wallet_base_per = "";
// $corporate_card_base_per = "";
// $prepaid_card_base_per = "";
$id_edit = "";
$distibutor_cashback = "";
$plan_duration = "";
$master_limit_per_day = "";
if(isset($edit_q)){
$id_edit = 1;
$distibutor_cashback = $edit_q->distibutor_cashback;
$master_limit_per_day = $edit_q->master_limit_per_day;
$edit_id = $edit_q->id; 
$planlogo = $edit_q->planlogo; 
$is_active = $edit_q->is_active;
$plan_type = $edit_q->plan_type;
$monthly_limit = $edit_q->monthly_limit;
$limit_per_day = $edit_q->limit_per_day;
$t0_hours = $edit_q->t0_hours;
$package_name = $edit_q->package_name;
$price = $edit_q->price;
$debit_card_instant = $edit_q->debit_card_instant;
$debit_card_t0 = $edit_q->debit_card_t0;
$debit_card_t1 = $edit_q->debit_card_t1;
$debit_card_t2 = $edit_q->debit_card_t2;
$netbanking_instant = $edit_q->netbanking_instant;
$netbanking_t0 = $edit_q->netbanking_t0;
$netbanking_t1 = $edit_q->netbanking_t1;
$netbanking_t2 = $edit_q->netbanking_t2;
$upi_instant = $edit_q->upi_instant;
$upi_t0 = $edit_q->upi_t0;
$upi_t1 = $edit_q->upi_t1;
$upi_t2 = $edit_q->upi_t2;
$credit_Card_instant = $edit_q->credit_card_instant;
$credit_card_t0 = $edit_q->credit_card_t0;
$credit_card_t1 = $edit_q->credit_card_t1;
$credit_card_t2 = $edit_q->credit_card_t2;
$amex_card_instant = $edit_q->amex_card_instant;
$amex_card_t0 = $edit_q->amex_card_t0;
$amex_card_t1 = $edit_q->amex_card_t1;
$amex_card_t2 = $edit_q->amex_card_t2;
$diners_card_instant = $edit_q->diners_card_instant;
$diners_card_t0 = $edit_q->diners_card_t0;
$diners_card_t1 = $edit_q->diners_card_t1;
$diners_card_t2 = $edit_q->diners_card_t2;
$wallet_instant = $edit_q->wallet_instant;
$wallet_t0 = $edit_q->wallet_t0;
$wallet_t1 = $edit_q->wallet_t1;
$wallet_t2 = $edit_q->wallet_t2;
$corporate_card_instant = $edit_q->corporate_card_instant;
$corporate_card_t0 = $edit_q->corporate_card_t0;
$corporate_card_t1 = $edit_q->corporate_card_t1;
$corporate_card_t2 = $edit_q->corporate_card_t2;
$prepaid_card_instant = $edit_q->prepaid_card_instant;
$prepaid_card_t0 = $edit_q->prepaid_card_t0;
$prepaid_card_t1 = $edit_q->prepaid_card_t1;
$prepaid_card_t2 = $edit_q->prepaid_card_t2;
// $debit_base_per = $edit_q->debit_base_per;
// $netbanking_base_per = $edit_q->netbanking_base_per;
// $upi_base_per = $edit_q->upi_base_per;
// $credit_card_base_per = $edit_q->credit_card_base_per;
// $amex_card_base_per = $edit_q->amex_card_base_per;
// $diners_card_base_per = $edit_q->diners_card_base_per;
// $wallet_base_per = $edit_q->wallet_base_per;
// $corporate_card_base_per = $edit_q->corporate_card_base_per;
// $prepaid_card_base_per = $edit_q->prepaid_card_base_per;
$plan_duration = $edit_q->plan_duration;
}
@endphp
<style>
  .nav-pills {
    border: none;
}
.nav-pills.nav-justified .nav-link {
    text-align: center;
    margin-bottom: 5px;
    font-size: 10px;
    margin-right: 0;
    border-radius: .357rem;
    display: block;
}
</style>
<div class="row">
    <div class="content-body">
        <section class="app-user-list">
            <div class="row">
                <div class="col-md-12">
                    <!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row">
      <div class="col-md-12 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Create plan</h4>
          </div>
          <div class="row">
              
              <div class="col-md-12">
                <div class="card-body">
                    <form class="form form-vertical" id="plan_create_form" method="post" action="{{ url('createplan_from') }}" onsubmit="validbtn()" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-3">
                          <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">Type</label>
                            <select name="plan_type" class="form-control form-select" id="plan_type" required>
                            <option @if($plan_type == 1) selected @endif value="1">Percentage</option>
                            <option @if($plan_type == 3) selected @endif value="2">Flat</option>
                            </select>
                          </div>
                        </div>
                        @if ($id_edit == 1)
                        <input type="hidden" name="edit_id" value="{{ $edit_id }}" id="edit_id">
                        @endif
                        <div class="col-3">
                          <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">Package name</label>
                            <input type="text" id="package_name" class="form-control" name="package_name" value="{{$package_name}}"/>
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">Buying Price</label>
                            <input type="number" id="price" class="form-control" name="price" value="{{$price}}"/>
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="mb-1">
                            <label class="form-label" name="plan_duration" for="first-name-vertical">Plan Duration</label>
                            <select name="plan_duration" class="form-select" id="plan_duration">
                              <option value="">Select duration</option>
                              <option @if($plan_duration == 1) selected @endif value="1">1 Month</option>
                              <option @if($plan_duration == 2) selected @endif value="2">2 Month</option>
                              <option @if($plan_duration == 3) selected @endif value="3">3 Month</option>
                              <option @if($plan_duration == 4) selected @endif value="4">6 Month</option>
                              <option @if($plan_duration == 5) selected @endif value="5">1 Year</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <h4>Payment methods</h4>
                        </div>
                        <div class="col-md-12">
                          <div class="card">
                            <div class="card-body">
                              <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                  <a
                                    class="Debit_Card nav-link active"
                                    id="home-tab-justified"
                                    data-bs-toggle="pill"
                                    href="#Debit_Card"
                                    aria-expanded="true"
                                    >Debit Card</a
                                  >
                                </li>
                                <li class="nav-item">
                                  <a
                                    class="Netbanking nav-link"
                                    id="home-tab-justified"
                                    data-bs-toggle="pill"
                                    href="#Netbanking"
                                    aria-expanded="true"
                                    >Netbanking</a
                                  >
                                </li>
                                <li class="nav-item">
                                  <a
                                    class="upi nav-link"
                                    id="home-tab-justified"
                                    data-bs-toggle="pill"
                                    href="#upi"
                                    aria-expanded="true"
                                    >UPI</a
                                  >
                                </li>
                                <li class="nav-item">
                                  <a
                                    class="Credit_Card nav-link"
                                    id="home-tab-justified"
                                    data-bs-toggle="pill"
                                    href="#Credit_Card"
                                    aria-expanded="true"
                                    >Credit Card</a
                                  >
                                </li>
                                <li class="nav-item">
                                  <a
                                    class="AMEX_Card nav-link"
                                    id="home-tab-justified"
                                    data-bs-toggle="pill"
                                    href="#AMEX_Card"
                                    aria-expanded="true"
                                    >AMEX Card</a
                                  >
                                </li>
                                <li class="nav-item">
                                  <a
                                    class="Diners_Card nav-link"
                                    id="home-tab-justified"
                                    data-bs-toggle="pill"
                                    href="#Diners_Card"
                                    aria-expanded="true"
                                    >Diners Card</a
                                  >
                                </li>
                                <li class="nav-item">
                                  <a
                                    class="Wallet nav-link"
                                    id="home-tab-justified"
                                    data-bs-toggle="pill"
                                    href="#Wallet"
                                    aria-expanded="true"
                                    >Wallet</a
                                  >
                                </li>
                                <li class="nav-item">
                                  <a
                                    class="Corporate_Card nav-link"
                                    id="home-tab-justified"
                                    data-bs-toggle="pill"
                                    href="#Corporate_Card"
                                    aria-expanded="true"
                                    >Corporate Card</a
                                  >
                                </li>
                                <li class="nav-item">
                                  <a
                                    class="Prepaid_Card nav-link"
                                    id="home-tab-justified"
                                    data-bs-toggle="pill"
                                    href="#Prepaid_Card"
                                    aria-expanded="true"
                                    >Prepaid Card</a
                                  >
                                </li>
                              </ul>
                              <div class="tab-content">
                                <div
                                  role="tabpanel"
                                  class="Debit_Card tab-pane active"
                                  id="Debit_Card"
                                  aria-labelledby="home-tab-justified"
                                  aria-expanded="true"
                                >
                                  <div class="row">
                                    <div class="col-md-3">
                                      <label for="">Instant</label>
                                      <input type="number" name="debit_card_instant" id="debit_card_instant" value="{{$debit_card_instant}}" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                      <label for="">T0</label>
                                      <input type="number" name="debit_card_t0" id="debit_card_t0" value="{{$debit_card_t0}}" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                      <label for="">T+1</label>
                                      <input type="number" name="debit_card_t1" id="debit_card_t1" value="{{$debit_card_t1}}" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                      <label for="">T+2</label>
                                      <input type="number" name="debit_card_t2" id="debit_card_t2" value="{{$debit_card_t2}}" class="form-control">
                                    </div>
                                    {{-- <div class="col-md-3 mt-1">
                                      <label for="">Debit Base percentage</label>
                                      <input type="number" name="debit_base_per" id="debit_base_per" value="{{$debit_base_per}}" class="form-control">
                                    </div> --}}
                                  </div>
                                </div>
                                <div
                                  class="Netbanking tab-pane"
                                  id="Netbanking"
                                  role="tabpanel"
                                  aria-labelledby="profile-tab-justified"
                                  aria-expanded="false"
                                >
                                <div class="row">
                                  <div class="col-md-3">
                                    <label for="">Instant</label>
                                    <input type="number" name="netbanking_instant" id="netbanking_instant" value="{{$netbanking_instant}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T0</label>
                                    <input type="number" name="netbanking_t0" id="netbanking_t0" value="{{$netbanking_t0}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T+1</label>
                                    <input type="number" name="netbanking_t1" id="netbanking_t1" value="{{$netbanking_t1}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T+2</label>
                                    <input type="number" name="netbanking_t2" id="netbanking_t2" value="{{$netbanking_t2}}" class="form-control">
                                  </div>
                                  {{-- <div class="col-md-3 mt-1">
                                    <label for="">Netbanking Base percentage</label>
                                    <input type="number" name="netbanking_base_per" id="netbanking_base_per" value="{{$netbanking_base_per}}" class="form-control">
                                  </div> --}}
                                </div>
                                </div>
                                <div
                                  class="upi tab-pane"
                                  id="upi"
                                  role="tabpanel"
                                  aria-labelledby="about-tab-justified"
                                  aria-expanded="false"
                                >
                                <div class="row">
                                  <div class="col-md-3">
                                    <label for="">Instant</label>
                                    <input type="number" name="upi_instant" id="upi_instant" value="{{$upi_instant}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T0</label>
                                    <input type="number" name="upi_t0" id="upi_t0" value="{{$upi_t0}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T+1</label>
                                    <input type="number" name="upi_t1" id="upi_t1" value="{{$upi_t1}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T+2</label>
                                    <input type="number" name="upi_t2" id="upi_t2" value="{{$upi_t2}}" class="form-control">
                                  </div>
                                  {{-- <div class="col-md-3 mt-1">
                                    <label for="">Upi Base percentage</label>
                                    <input type="number" name="upi_base_per" id="upi_base_per" value="{{$upi_base_per}}" class="form-control">
                                  </div> --}}
                                </div>
                                </div>
                                <div
                                  class="Credit_Card tab-pane"
                                  id="Credit_Card"
                                  role="tabpanel"
                                  aria-labelledby="about-tab-justified"
                                  aria-expanded="false"
                                >
                                <div class="row">
                                  <div class="col-md-3">
                                    <label for="">Instant</label>
                                    <input type="number" name="credit_card_instant" id="credit_Card_instant" value="{{$credit_Card_instant}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T0</label>
                                    <input type="number" name="credit_card_t0" id="credit_card_t0" value="{{$credit_card_t0}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T+1</label>
                                    <input type="number" name="credit_card_t1" id="credit_card_t1" value="{{$credit_card_t1}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T+2</label>
                                    <input type="number" name="credit_card_t2" id="credit_card_t2" value="{{$credit_card_t2}}" class="form-control">
                                  </div>
                                  {{-- <div class="col-md-3 mt-1">
                                    <label for="">Credit Base percentage</label>
                                    <input type="number" name="credit_card_base_per" id="credit_card_base_per" value="{{$credit_card_base_per}}" class="form-control">
                                  </div> --}}
                                </div>
                                </div>
                                <div
                                  class="AMEX_Card tab-pane"
                                  id="AMEX_Card"
                                  role="tabpanel"
                                  aria-labelledby="about-tab-justified"
                                  aria-expanded="false"
                                >
                                <div class="row">
                                  <div class="col-md-3">
                                    <label for="">Instant</label>
                                    <input type="number" name="amex_card_instant" id="amex_card_instant" value="{{$amex_card_instant}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T0</label>
                                    <input type="number" name="amex_card_t0" id="amex_card_t0" value="{{$amex_card_t0}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T+1</label>
                                    <input type="number" name="amex_card_t1" id="amex_card_t1" value="{{$amex_card_t1}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T+2</label>
                                    <input type="number" name="amex_card_t2" id="amex_card_t2" value="{{$amex_card_t2}}" class="form-control">
                                  </div>
                                  {{-- <div class="col-md-3 mt-1">
                                    <label for="">Amex Base percentage</label>
                                    <input type="number" name="amex_card_base_per" id="amex_card_base_per" value="{{$amex_card_base_per}}" class="form-control">
                                  </div> --}}
                                </div>
                                </div>
                                <div
                                  class="Diners_Card tab-pane"
                                  id="Diners_Card"
                                  role="tabpanel"
                                  aria-labelledby="about-tab-justified"
                                  aria-expanded="false"
                                >
                                <div class="row">
                                  <div class="col-md-3">
                                    <label for="">Instant</label>
                                    <input type="number" name="diners_card_instant" id="diners_card_instant" value="{{$diners_card_instant}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T0</label>
                                    <input type="number" name="diners_card_t0" id="diners_card_t0" value="{{$diners_card_t0}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T+1</label>
                                    <input type="number" name="diners_card_t1" id="diners_card_t1" value="{{$diners_card_t1}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T+2</label>
                                    <input type="number" name="diners_card_t2" id="diners_card_t2" value="{{$diners_card_t2}}" class="form-control">
                                  </div>
                                  {{-- <div class="col-md-3 mt-1">
                                    <label for="">Diners Base percentage</label>
                                    <input type="number" name="diners_card_base_per" id="diners_card_base_per" value="{{$diners_card_base_per}}" class="form-control">
                                  </div> --}}
                                </div>
                                </div>
                                <div
                                  class="Wallet tab-pane"
                                  id="Wallet"
                                  role="tabpanel"
                                  aria-labelledby="about-tab-justified"
                                  aria-expanded="false"
                                >
                                <div class="row">
                                  <div class="col-md-3">
                                    <label for="">Instant</label>
                                    <input type="number" name="wallet_instant" id="wallet_instant" value="{{$wallet_instant}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T0</label>
                                    <input type="number" name="wallet_t0" id="wallet_t0" value="{{$wallet_t0}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T+1</label>
                                    <input type="number" name="wallet_t1" id="wallet_t1" value="{{$wallet_t1}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T+2</label>
                                    <input type="number" name="wallet_t2" id="wallet_t2" value="{{$wallet_t2}}" class="form-control">
                                  </div>
                                  {{-- <div class="col-md-3 mt-1">
                                    <label for="">Wallet Base percentage</label>
                                    <input type="number" name="wallet_base_per" id="wallet_base_per" value="{{$wallet_base_per}}" class="form-control">
                                  </div> --}}
                                </div>
                                </div>
                                <div
                                  class="Corporate_Card tab-pane"
                                  id="Corporate_Card"
                                  role="tabpanel"
                                  aria-labelledby="about-tab-justified"
                                  aria-expanded="false"
                                >
                                <div class="row">
                                  <div class="col-md-3">
                                    <label for="">Instant</label>
                                    <input type="number" name="corporate_card_instant" id="corporate_card_instant" value="{{$corporate_card_instant}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T0</label>
                                    <input type="number" name="corporate_card_t0" id="corporate_card_t0" value="{{$corporate_card_t0}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T+1</label>
                                    <input type="number" name="corporate_card_t1" id="corporate_card_t1" value="{{$corporate_card_t1}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T+2</label>
                                    <input type="number" name="corporate_card_t2" id="corporate_card_t2" value="{{$corporate_card_t2}}" class="form-control">
                                  </div>
                                  {{-- <div class="col-md-3 mt-1">
                                    <label for="">corporate Base percentage</label>
                                    <input type="number" name="corporate_card_base_per" id="corporate_card_base_per" value="{{$corporate_card_base_per}}" class="form-control">
                                  </div> --}}
                                </div>
                                </div>
                                <div
                                  class="Prepaid_Card tab-pane"
                                  id="Prepaid_Card"
                                  role="tabpanel"
                                  aria-labelledby="about-tab-justified"
                                  aria-expanded="false"
                                >
                                <div class="row">
                                  <div class="col-md-3">
                                    <label for="">Instant</label>
                                    <input type="number" name="prepaid_card_instant" id="prepaid_card_instant" value="{{$prepaid_card_instant}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T0</label>
                                    <input type="number" name="prepaid_card_t0" id="prepaid_card_t0" value="{{$prepaid_card_t0}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T+1</label>
                                    <input type="number" name="prepaid_card_t1" id="prepaid_card_t1" value="{{$prepaid_card_t1}}" class="form-control">
                                  </div>
                                  <div class="col-md-3">
                                    <label for="">T+2</label>
                                    <input type="number" name="prepaid_card_t2" id="prepaid_card_t2" value="{{$prepaid_card_t2}}" class="form-control">
                                  </div>
                                  {{-- <div class="col-md-3 mt-1">
                                    <label for="">Prepaid Base percentage</label>
                                    <input type="number" name="prepaid_card_base_per" id="prepaid_card_base_per" value="{{$prepaid_card_base_per}}" class="form-control">
                                  </div> --}}
                                </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-8">
                          <h4>Limit</h4>
                        </div>
                        <div class="col-4">
                          <h4>T-0 Time</h4>
                        </div>
                        <div class="col-4">
                          <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">Monthly limit</label>
                            <input type="number" id="monthly_limit" class="form-control" name="monthly_limit" value="{{$monthly_limit}}" required/>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">Limit per day</label>
                            <input type="number" id="limit_per_day" class="form-control" name="limit_per_day" value="{{$limit_per_day}}" required/>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">T+0 Execute Time (Hours)</label>
                            <input type="number" id="t0_hours" class="form-control" name="t0_hours" value="{{$t0_hours}}" required/>
                          </div>
                        </div>
                        <div class="col-12">
                          <h4>Cashback Amount</h4>
                        </div>
                        {{-- <div class="col-4">
                          <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">Distibutor Cashback</label>
                            <input type="number" id="distibutor_cashback" class="form-control" name="distibutor_cashback" value="{{$distibutor_cashback}}" required/>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">Master Distibutor Cashback</label>
                            <input type="number" id="master_limit_per_day" class="form-control" name="master_limit_per_day" value="{{$master_limit_per_day}}" required/>
                          </div>
                        </div> --}}
                        <div class="col-md-4">
                          <div class="mb-1">
                            <label class="form-label" for="first-name-vertical">Plan Image</label>
                            <input type="hidden" name="oldplanlogo" id="oldplanlogo" value="{{$planlogo}}">
                            <input type="file" class="form-control" name="planlogo"  id="planlogo" @if(empty($planlogo)) required @endif/>
                          </div>
                        </div>
                        @php
                            if($is_active == 1){
                              $check_alredy_default = 0;  
                            }else{
                              $check_alredy_default = DB::table('plans')->where('is_active',1)->count();
                            }
                        @endphp
                        @if ($check_alredy_default == 0)
                        <div class="col-md-12">
                          <div class="form-group form-check mb-2">
                            <input type="checkbox" class="form-check-input" @if($is_active == 1) checked @endif name="is_active" id="tt">
                            <label class="form-label" for="tt">Default Plan</label>
                        </div>
                        </div>
                        @endif
                      <div class="col-12">
                        <div class="col-12">
                          <button type="button" id="submit_btn" onclick="check_plan()" class="btn btn-success"> @if ($id_edit == 1) Update @else Submit @endif </button>
                          <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                        </div>
                      </div>
                    </form>
                  </div>
              </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- Basic Vertical form layout section end -->    
                </div>    
            </div>      
        </section>
    </div>    
</div>  
<div class="row">
  <div class="content-body">
    <div class="row">
      <div class="col-md-12">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Plans</h4>
            </div>
            <div class="card-body">
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Create date</th>
                    <th>Type</th>
                    <th>Package name</th>
                    <th>Package Price</th>
<th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($qlist as $list)
                  <tr>
                    <td>{{ $list->date }}</td>
                    <td>
                      @if ($list->plan_type == 1)
                          Percentage
                      @else
                          Flat
                      @endif
                    </td>
                    <td>{{ $list->package_name }}</td>
                    <td>{{ $list->price }}</td>
                    <td>
                      <a href="{{ url('plan_delete/'.$list->id) }}" type="button" class="btn btn-danger m-1">Delete</a>
                      <a href="{{ url('createplan/'.$list->id) }}" type="button" class="btn btn-success m-1">Edit</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection