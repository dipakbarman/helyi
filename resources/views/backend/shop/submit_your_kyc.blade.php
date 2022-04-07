@extends('backend.master')
@section('body')

<div class="row match-height">
    <div class="col-md-12">
        <div class="card p-2">
            <div class="card-title">
                <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif><i data-feather='arrow-left'></i></a> 
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 align-middle">
                    @if ($userdata->is_kyc_submit == 0)
                    <form action="{{url('mearchantkycsubmit')}}" method="post" enctype="multipart/form-data" onsubmit="validbtn()">
                    @csrf
                    <h4 class="card-title mb-3">
                        KYC Documents <span class="float-right"><button type="button" class="btn btn-danger">Pending Submission</button></span>
                    </h4>
                    <p class="kyc_p">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                    <h4 class="label_title">Govt Id</h4>
                    <p class="kyc_p">It is a long established fact that a reader will be distracted by the readable content of.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group kyc_field">
                                <label for="">Font Side</label>
                                <input required type="file" name="gov_font_side" class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group kyc_field">
                                <label for="">Back Side</label>
                                <input required type="file" name="gov_back_side" class="form-control" id="">
                            </div>
                        </div>
                    </div>
                    <h4 class="label_title">PAN</h4>
                    <p class="kyc_p">It is a long established fact that a reader will be distracted by the readable content of.</p>
                    <div class="form-group kyc_field">
                        <label for="">Pan Card</label>
                        <input required type="file" name="pancard" class="form-control" id="">
                    </div>
                    <h4 class="label_title">Passport size photo / selfie</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group kyc_field">
                                <label for="">Upload Photo</label>
                                <input required type="file" name="kyc_Photo" class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group kyc_field">
                                <label for="">Upload signature</label>
                                <input required type="file" name="kyc_signature" class="form-control" id="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-check mb-3">
                        <input required type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-label" for="exampleCheck1">Terms and Conditions of the pay extent are accepted</label>
                    </div>
                    <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                    <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                </form>
                @else
                @if ($userdata->is_kyc == 0)
                <h4 class="card-title mb-1 text-center">KYC Documents</h4>
                <div class="row justify-content-center">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <img src="{{ asset('Group 7019.png') }}" height="auto" width="200px" alt="">
                    </div>
                </div>
                <div class="alert alert-warning mt-1 alert-validation-msg" role="alert">
                    <div class="alert-body d-flex align-items-center">
                      <span><i data-feather='watch'></i> Please wait for admin verification</span>
                    </div>
                  </div> 
                @else
                <h4 class="card-title mb-1 text-center">KYC Documents</h4>
                <div class="alert alert-success mt-1 alert-validation-msg" role="alert">
                    <div class="alert-body d-flex align-items-center">
                      <span><i data-feather='check-circle'></i> KYC Verified</span>
                    </div>
                  </div> 
                @endif
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection