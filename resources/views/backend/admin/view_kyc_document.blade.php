@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-3">
            <h4 class="card-title">
                Merchant KYC Data
            </h4>
            @if ($q->is_kyc_submit == 1)
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="form-check form-switch form-check-success">
                            <input onclick="change_kyc_stats({{$q->id}})" @if($q->is_kyc == 1) checked @endif type="checkbox" class="form-check-input" id="kyc_swech{{$q->id}}" />
                            <label class="form-check-label" for="kyc_swech{{$q->id}}">
                              <span class="switch-icon-left"><i data-feather="check"></i></span>
                              <span class="switch-icon-right"><i data-feather="x"></i></span>
                            </label>
                          </div>
                </div>
                <div class="col-md-12 mb-3">
                    <h4 class="label_title">Govt Id</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Font Side</p>
                            @if(!empty($q->gov_font_side))
                             <a target="_blank" href="{{ url('storage/app/'.$q->gov_font_side) }}"><img class="kyc_doc_image" src="{{ url('storage/app/'.$q->gov_font_side) }}" alt=""></a>
                             @endif
                        </div>
                        <div class="col-md-6">
                            <p >Back Side</p>
                            @if(!empty($q->gov_back_side))
                            <a target="_blank" href="{{ url('storage/app/'.$q->gov_back_side) }}"><img class="kyc_doc_image" src="{{ url('storage/app/'.$q->gov_back_side) }}" alt=""></a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <h4 class="label_title">PAN</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Font Side</p>
                            @if(!empty($q->pancard))
                             <a target="_blank" href="{{ url('storage/app/'.$q->pancard) }}"><img class="kyc_doc_image" src="{{ url('storage/app/'.$q->pancard) }}" alt=""></a>
                             @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <h4 class="label_title">Passport size photo / selfie</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Font Side</p>
                            @if(!empty($q->kyc_Photo))
                             <a target="_blank" href="{{ url('storage/app/'.$q->kyc_Photo) }}"><img class="kyc_doc_image" src="{{ url('storage/app/'.$q->kyc_Photo) }}" alt=""></a>
                             @endif
                        </div>
                        <div class="col-md-6">
                            <p >Back Side</p>
                            @if(!empty($q->kyc_signature))
                            <a target="_blank" href="{{ url('storage/app/'.$q->kyc_signature) }}"><img class="kyc_doc_image" src="{{ url('storage/app/'.$q->kyc_signature) }}" alt=""></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>          
            @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-warning mt-1 alert-validation-msg" role="alert">
                            <div class="alert-body d-flex align-items-center">
                              <span><i data-feather='watch'></i>KYC not submited !</span>
                            </div>
                          </div> 
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection