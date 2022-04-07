@extends('backend.master')
@section('body')
@php
    $uq = get_company_all_data_byid($t_details->userid);
@endphp
<div class="row">
    <div class="col-xl-12 col-md-12 col-12">
        <div class="card invoice-preview-card p-2">
          <div class="card-header">
            <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif><i data-feather='arrow-left'></i></a> 
          </div>
          <div class="card-body invoice-padding pb-0">
            <!-- Header starts -->
            <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
              <div>
                <p class="card-text mb-25">
                    @php
                    if($t_details->is_added == 0){
    echo "<span class='badge badge-glow bg-warning'>Processing</span>";
                    }
                    if($t_details->is_added == 1){
                        echo "<span class='badge badge-glow bg-success'>Successful</span>";                       
                    }
                @endphp
                </p>
                <p class="card-text mb-25 mb-1"></p>
                <p class="card-text mb-0"><i class="fas fa-rupee-sign"></i> {{ $t_details->amount }}</p>
              </div>
              <div class="mt-md-0 mt-2">
                <h4 class="invoice-title">
                ORDER ID
                  <span class="invoice-number">#{{$t_details->id}}</span>
                </h4>
                <div class="invoice-date-wrapper">
                  <p class="invoice-date-title">Date Issued:</p>
                  <p class="invoice-date">{{ $t_details->view_date }}</p>
                </div>
              </div>
            </div>
            <!-- Header ends -->
          </div>
  
          <hr class="invoice-spacing" />
  
          <!-- Address and Contact starts -->
          <div class="card-body invoice-padding pt-0">
            <div class="row invoice-spacing">
              <div class="col-xl-8 p-0">
                <h6 class="mb-2">Invoice To:</h6>
                <h6 class="mb-25">Name : {{$uq->firstname}} {{$uq->lastname}}</h6>
                <p class="card-text mb-25">Company name : {{$uq->shop_name}}</p>
                <p class="card-text mb-25">Address : {{$uq->p_address}}</p>
                <p class="card-text mb-25">Mobile Number : {{$uq->mobile}}</p>
                <p class="card-text mb-0">Email ID : {{$uq->email}}</p>
              </div>
              <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                <h6 class="mb-2">Payment Details:</h6>
                <table>
                  <tbody>
                    <tr>
                      <td class="pe-1">Total Amount:</td>
                      <td><span class="fw-bold"><i class="fas fa-rupee-sign"></i> {{ $t_details->amount }}</span></td>
                    </tr>
                    {{-- <tr>
                      <td class="pe-1">Bank name:</td>
                      <td>American Bank</td>
                    </tr>
                    <tr>
                      <td class="pe-1">Country:</td>
                      <td>United States</td>
                    </tr>
                    <tr>
                      <td class="pe-1">IBAN:</td>
                      <td>ETD95476213874685</td>
                    </tr>
                    <tr>
                      <td class="pe-1">SWIFT code:</td>
                      <td>BR91905</td>
                    </tr> --}}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- Address and Contact ends -->

          <hr class="invoice-spacing" />
  
          <!-- Invoice Note starts -->
          <div class="card-body invoice-padding pt-0">
            <div class="row">
              <div class="col-12">
                <span class="fw-bold">Note:</span>
                <span
                  >It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
                  projects. Thank You!</span
                >
              </div>
            </div>
          </div>
          <!-- Invoice Note ends -->
        </div>
      </div>
</div>
@endsection