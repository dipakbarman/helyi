@extends('backend.master')
@section('body')
<div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
      <!-- User Card -->
      <div class="card">
        <div class="card-body">
          <div class="user-avatar-section">
            <div class="d-flex align-items-center flex-column">
              <img
                class="img-fluid rounded mt-3 mb-2"
                src="{{ url('storage/app/'.$userq->store_logo) }}"
                height="110"
                width="110"
                alt="User avatar"
              />
              <div class="user-info text-center">
                <h4 style="text-transform: uppercase">{{ $userq->name }}</h4>
                <span class="badge bg-light-secondary">
                    {{get_user_type($userq->type)}}
                </span>
              </div>
            </div>
          </div>
          {{-- <div class="d-flex justify-content-around my-2 pt-75">
            <div class="d-flex align-items-start me-2">
              <span class="badge bg-light-primary p-75 rounded">
                <i data-feather="check" class="font-medium-2"></i>
              </span>
              <div class="ms-75">
                <h4 class="mb-0">1.23k</h4>
                <small>Tasks Done</small>
              </div>
            </div>
            <div class="d-flex align-items-start">
              <span class="badge bg-light-primary p-75 rounded">
                <i data-feather="briefcase" class="font-medium-2"></i>
              </span>
              <div class="ms-75">
                <h4 class="mb-0">568</h4>
                <small>Projects Done</small>
              </div>
            </div>
          </div> --}}
          <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
          <div class="info-container">
            <ul class="list-unstyled">
              <li class="mb-75">
                <span class="fw-bolder me-25">Username:</span>
                <span>{{$userq->name}}</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Billing Email:</span>
                <span>{{$userq->email}}</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Status:</span>
                @if($userq->is_active == 1)<span class="badge bg-light-success"> Active </span> @else <span class="badge bg-light-danger"> Block </span> @endif
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Role:</span>
                <span>{{get_user_type($userq->type)}}</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Shop ID:</span>
                <span>{{ $userq->shop_id }}</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Contact:</span>
                <span>{{ $userq->mobile }}</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Shop Phone:</span>
                <span>{{ $userq->shop_phone }}</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Shop Name:</span>
                <span>{{ $userq->shop_name }}</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">City:</span>
                <span>{{ $userq->city }}</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">State:</span>
                <span>{{ $userq->state }}</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Pincode:</span>
                <span>{{ $userq->pincode }}</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">GST:</span>
                <span>{{ $userq->gst }}</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Fssai:</span>
                <span>{{ $userq->fssai }}</span>
              </li>
            </ul>
            <div class="d-flex justify-content-center pt-2">
              {{-- <a href="javascript:;" class="btn btn-primary me-1" data-bs-target="#editUser" data-bs-toggle="modal">
                Edit
              </a> --}}
              {{-- <a href="javascript:;" class="btn btn-outline-danger suspend-user">Suspended</a> --}}
            </div>
          </div>
        </div>
      </div>
      <!-- /User Card -->
      <!-- Plan Card -->
      <div class="card border-primary">
        <div class="card-body">
            @if(!empty($c_plan))
          <div class="d-flex justify-content-between align-items-start">
            <span class="badge bg-light-primary">{{$c_plan->package_name}}</span>
            <div class="d-flex justify-content-center">
              <sup class="h5 pricing-currency text-primary mt-1 mb-0"><i class="fas fa-rupee-sign"></i></sup>
              <span class="fw-bolder display-5 mb-0 text-primary">{{$c_plan->price}}</span>
              <sub class="pricing-duration font-small-4 ms-25 mt-auto mb-2">/month</sub>
            </div>
          </div>
          <ul class="ps-1 mb-2">
            <li class="mb-50">Monthly limit {{$c_plan->monthly_limit}}</li>
            <li class="mb-50">Limit per day {{ $c_plan->limit_per_day }}</li>
          </ul>
          @endif
          <div class="d-flex justify-content-between align-items-center fw-bolder mb-50">
          </div>
          <div class="d-grid w-100 mt-2">
            <!--@if (check_is_reffer_user(session()->get('userid')) == 0)-->
            <!--<a href="{{ url('plan_purchase') }}" class="btn btn-success">-->
            <!--  Upgrade Plan-->
            <!--</a>-->
            <!--@endif-->
          </div>
        </div>
      </div>
      <!-- /Plan Card -->
    </div>
    <!--/ User Sidebar -->

    <!-- User Content -->
    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
      <!-- User Pills -->
      <ul class="nav nav-pills mb-2">
        <li class="nav-item">
          <a class="nav-link active" href="{{ url('profile') }}">
            <i data-feather="user" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Account</span></a
          >
        </li>

      </ul>
      <!--/ User Pills -->

      <!-- Project table -->
      <div class="card">
        <h4 class="card-header">Document</h4>
        <div class="card-body pt-1">
          <div class="row doc_img_area">
              <div class="col-md-6">
                  <h5 class="mb-1">Id Proof</h5>
                  <a target="_blank" href="{{ url('storage/app/'.$userq->id_proof) }}"> <img src="{{ url('storage/app/'.$userq->id_proof) }}"  alt=""> </a>
              </div>
              <div class="col-md-6">
                <h5 class="mb-1">Bank Doc (Front)</h5>
                      <a target="_blank" href="{{ url('storage/app/'.$userq->bank_doc) }}"> <img src="{{ url('storage/app/'.$userq->bank_doc) }}"  alt=""> </a>
              </div>
              <div class="col-md-6">
                <h5 class="mb-1">Bank Doc (Back)</h5>
                      <a target="_blank" href="{{ url('storage/app/'.$userq->signature_doc) }}"> <img src="{{ url('storage/app/'.$userq->signature_doc) }}"  alt=""> </a>
              </div>
              <div class="col-md-6">
                <h5 class="mb-1">Store logo</h5>
                      <a target="_blank" href="{{ url('storage/app/'.$userq->store_logo) }}"> <img src="{{ url('storage/app/'.$userq->store_logo) }}"  alt=""> </a>
              </div>
              <div class="col-md-6">
                <h5 class="mb-1">Store banner</h5>
                      <a target="_blank" href="{{ url('storage/app/'.$userq->store_banner_logo) }}"> <img src="{{ url('storage/app/'.$userq->store_banner_logo) }}"  alt=""> </a>
              </div>
          </div>
        </div>
      </div>
      <div class="card">
        <h4 class="card-header">KYC Document</h4>
        <div class="card-body pt-1">
          @if($userq->is_kyc_submit == 1)
          <div class="row doc_img_area">
              <div class="col-md-6">
                  <h5 class="mb-1">Font size</h5>
                  <a target="_blank" href="{{ url('storage/app/'.$userq->gov_font_side) }}"> <img src="{{ url('storage/app/'.$userq->id_proof) }}"  alt=""> </a>
              </div>
              <div class="col-md-6">
                <h5 class="mb-1">Back Side</h5>
                      <a target="_blank" href="{{ url('storage/app/'.$userq->gov_back_side) }}"> <img src="{{ url('storage/app/'.$userq->bank_doc) }}"  alt=""> </a>
              </div>
              <div class="col-md-6">
                <h5 class="mb-1">Pancard</h5>
                      <a target="_blank" href="{{ url('storage/app/'.$userq->pancard) }}"> <img src="{{ url('storage/app/'.$userq->signature_doc) }}"  alt=""> </a>
              </div>
              <div class="col-md-6">
                <h5 class="mb-1">Photo</h5>
                      <a target="_blank" href="{{ url('storage/app/'.$userq->kyc_Photo) }}"> <img src="{{ url('storage/app/'.$userq->store_logo) }}"  alt=""> </a>
              </div>
              <div class="col-md-6">
                <h5 class="mb-1">Signature</h5>
                      <a target="_blank" href="{{ url('storage/app/'.$userq->kyc_signature) }}"> <img src="{{ url('storage/app/'.$userq->store_banner_logo) }}"  alt=""> </a>
              </div>
          </div>
          @else
          <a class="btn btn-success" href="{{url('submit_your_kyc')}}">Submit KYC</a>
          @endif
        </div>
      </div>
      @if (isset($tns_q))
      <div class="card">
        <h4 class="card-header">Latest Transaction</h4>
        
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Date/Time</th>
                      <th>Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($tns_q as $list)
                    <tr>
                        <td>{{ $list->time }}-{{ $list->date }}</td>
                        <td>{{ $list->amt }}</td>
                        <td>
                            {{ $list->r }}
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="py-2">
                  {{$tns_q->withQueryString()->links()}}
                </div>
              </div>
        </div>
      </div>    
      @endif
      
      <!-- /Project table -->

      <!-- Activity Timeline -->
      
      <!-- /Activity Timeline -->

      <!-- Invoice table -->
      <!-- /Invoice table -->
    </div>
    <!--/ User Content -->
  </div>
@endsection