@extends('backend.master')
@section('body')

<div class="row match-height">
    <!-- Greetings Card starts -->
        <!-- Subscribers Chart Card starts -->
        <div class="col-lg-4 col-6">
            <div class="card">
              <div class="card-body pb-50">
                <h6>Payouts</h6>
                <h2 class="fw-bolder mb-1">2,76k</h2>
                <div id="line-area-chart-3"></div>
              </div>
            </div>
          </div>
        <div class="col-lg-4 col-6">
      <div class="card">
        <div class="card-body pb-50">
          <h6>PG</h6>
          <h2 class="fw-bolder mb-1">2,14k</h2>
          <div id="line-area-chart-4"></div>
        </div>
      </div>
    </div>
    <!-- Subscribers Chart Card ends -->
    <!-- Subscribers Chart Card starts -->
    <div class="col-lg-4 col-6">
      <div class="card card-tiny-line-stats">
        <div class="card-body pb-50">
          <h6>Wallet balance</h6>
          <h2 class="fw-bolder mb-1">6,78k</h2>
          <div id="line-area-chart-2"></div>
        </div>
      </div>
    </div>
    <!-- Subscribers Chart Card ends -->
    <!-- Greetings Card ends -->

  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-baseline flex-sm-row flex-column">
          <h4 class="card-title">Reports</h4>
          <div class="header-right d-flex align-items-center mt-sm-0 mt-1">
            <i data-feather="calendar"></i>
            <input
              type="text"
              class="form-control flat-picker border-0 shadow-none bg-transparent pe-0"
              placeholder="YYYY-MM-DD"
            />
          </div>
        </div>
        <div class="card-body">
          <canvas class="line-area-chart-ex chartjs" data-height="450"></canvas>
        </div>
      </div>
    </div>
  </div>
  

   
@endsection