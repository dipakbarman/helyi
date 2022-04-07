@extends('backend.master')
@section('body')

<div class="row match-height">
  <!-- Medal Card -->
  
  <div class="col-xl-4 col-md-6 col-12">
    <div class="card card-congratulation-medal">
      <div class="card-body">
        <h5>Congratulations Admin 🎉 !</h5>
        <p class="card-text font-small-3">You have won gold medal</p>
        <h3 class="mb-75 mt-2 pt-50">
          <a href="#">$48.9k</a>
        </h3>
        <button type="button" class="btn btn-success">View Sales</button>
        <img src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Pic" />
      </div>
    </div>
  </div>
  <!--/ Medal Card -->

  <!-- Statistics Card -->
  <div class="col-xl-8 col-md-6 col-12">
    <div class="card card-statistics">
      <div class="card-header">
        <h4 class="card-title">Statistics</h4>
        <div class="d-flex align-items-center">
          {{-- <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p> --}}
        </div>
      </div>
      <div class="card-body statistics-body">
        <div class="row">
          <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <div class="d-flex flex-row">
              <div class="avatar bg-light-primary me-2">
                <div class="avatar-content">
                  <i data-feather="trending-up" class="avatar-icon"></i>
                </div>
              </div>
              <div class="my-auto">
                <h4 class="fw-bolder mb-0">0</h4>
                <p class="card-text font-small-3 mb-0">Sales</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <div class="d-flex flex-row">
              <div class="avatar bg-light-info me-2">
                <div class="avatar-content">
                  <i data-feather="user" class="avatar-icon"></i>
                </div>
              </div>
              <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ count_total_customers() }}</h4>
                <p class="card-text font-small-3 mb-0">Customers</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
            <div class="d-flex flex-row">
              <div class="avatar bg-light-danger me-2">
                <div class="avatar-content">
                  <i data-feather="box" class="avatar-icon"></i>
                </div>
              </div>
              <div class="my-auto">
                <h4 class="fw-bolder mb-0">0</h4>
                <p class="card-text font-small-3 mb-0">Products</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12">
            <div class="d-flex flex-row">
              <div class="avatar bg-light-success me-2">
                <div class="avatar-content">
                  <i data-feather="dollar-sign" class="avatar-icon"></i>
                </div>
              </div>
              <div class="my-auto">
                <h4 class="fw-bolder mb-0">0</h4>
                <p class="card-text font-small-3 mb-0">Revenue</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Statistics Card -->
</div>
<div class="row match-height">
  <div class="row match-height" id="info_box_h">
    <div class="col-md-4">
      <div class="col-lg-12 col-md-6 col-12">
        <div class="card earnings-card">
          <div class="card-body">
            <div class="row">
              <div class="col-6" style="border-right: 1px solid #eee;">
                <h4 class="card-title mb-1">Sales</h4>
                <div class="font-small-2">This Month</div>
                <h5 class="mb-1">0</h5>
                <p class="card-text text-muted font-small-2">
                  {{-- <span class="fw-bolder">68.2%</span><span> more earnings than last month.</span> --}}
                </p>
              </div>
              <div class="col-6">
                <h4 class="card-title mb-1" style="visibility: hidden">..</h4>
                <div class="font-small-2">This Month</div>
                <h5 class="mb-1">0</h5>
                <p class="card-text text-muted font-small-2">
                  {{-- <span class="fw-bolder">68.2%</span><span> more earnings than last month.</span> --}}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="col-lg-12 col-md-6 col-12">
        <div class="card earnings-card">
          <div class="card-body">
            <div class="row">
              <div class="col-6" style="border-right: 1px solid #eee;">
                <h4 class="card-title mb-1">customers</h4>
                <div class="font-small-2">This Month</div>
                <h5 class="mb-1">{{count_total_user_this_month()}}</h5>
                <p class="card-text text-muted font-small-2">
                  {{-- <span class="fw-bolder">68.2%</span><span> more earnings than last month.</span> --}}
                </p>
              </div>
              <div class="col-6">
                <h4 class="card-title mb-1" style="visibility: hidden">..</h4>
                <div class="font-small-2">Today</div>
                <h5 class="mb-1">{{count_total_user_today()}}</h5>
                <p class="card-text text-muted font-small-2">
                  {{-- <span class="fw-bolder">68.2%</span><span> more earnings than last month.</span> --}}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="col-lg-12 col-md-6 col-12">
        <div class="card earnings-card">
          <div class="card-body">
            <div class="row">
              <div class="col-6" style="border-right: 1px solid #eee;">
                <h4 class="card-title mb-1">Stores</h4>
                <div class="font-small-2">This Month</div>
                <h5 class="mb-1">{{count_total_store_this_month()}}</h5>
                <p class="card-text text-muted font-small-2">
                  {{-- <span class="fw-bolder">68.2%</span><span> more earnings than last month.</span> --}}
                </p>
              </div>
              <div class="col-6">
                <h4 class="card-title mb-1" style="visibility: hidden">..</h4>
                <div class="font-small-2">Today</div>
                <h5 class="mb-1">{{count_total_store_today()}}</h5>
                <p class="card-text text-muted font-small-2">
                  {{-- <span class="fw-bolder">68.2%</span><span> more earnings than last month.</span> --}}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-1 col-6"></div>
    <!-- Subscribers Chart Card starts -->
  <div class="col-lg-2 col-6">
      <div class="card">
        <div class="card-body pb-50">
          <h6>Dummy</h6>
          <h2 class="fw-bolder mb-1">9,76k</h2>
          <div id="line-area-chart-3"></div>
        </div>
      </div>
    </div>
  <div class="col-lg-2 col-6">
      <div class="card card-tiny-line-stats">
        <div class="card-body pb-50">
          <h6>Cancelled</h6>
          <h2 class="fw-bolder mb-1">6,24k</h2>
          <div id="statistics-line-chart"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-2 col-6">
      <div class="card">
        <div class="card-body pb-50">
          <h6>Completed</h6>
          <h2 class="fw-bolder mb-1">9,76k</h2>
          <div id="line-area-chart-2"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-2 col-6">
      <div class="card">
        <div class="card-body pb-50">
          <h6>Pending</h6>
          <h2 class="fw-bolder mb-1">2,76k</h2>
          <div id="statistics-bar-chart"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-2 col-6">
      <div class="card">
        <div class="card-body pb-50">
          <h6>Dispatched</h6>
          <h2 class="fw-bolder mb-1">2,76k</h2>
          <div id="line-area-chart-1"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-1 col-6"></div>
    {{-- <div class="col-lg-2 col-6">
      <div class="card">
        <div class="card-body pb-50">
          <h6>Payment</h6>
          <h2 class="fw-bolder mb-1">3,78k</h2>
          <div id="line-area-chart-4"></div>
        </div>
      </div>
    </div> --}}

</div>

<!-- ChartJS section start -->
  
</div>
<section id="chartjs-chart">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-baseline flex-sm-row flex-column">
          <h4 class="card-title">Data Science</h4>
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
  </section>
@endsection