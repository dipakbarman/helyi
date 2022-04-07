@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif><i data-feather='arrow-left'></i></a> 
                @if (session()->get('type') == 3)
                Distributor Network List
                @endif
                @if (session()->get('type') == 4)
                @if(isset($listtype))
                @if($listtype == 1)
                My Merchant Network List
                @endif
                @if($listtype == 3)
                My Distributor Network List
                @endif
                @endif
                @endif
            </h4>
            @if (session()->get('type') == 3)
            <form action="{{ url('searchnetwork') }}" method="post">
                @csrf
            <div class="row mb-2">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label  for="">Select Type</label>
                    <select name="filter_type" class="form-control form-select" id="">
                        <option value="">Select Type</option>
                        <option value="1">Top Earners</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="hidden" name="utype" value="1">
                    <label for="">Enter Name</label>
                    <input type="name" class="form-control" placeholder="Search mearchant" name="username" id="">
                </div>
                <div class="col-md-3">
                    <label for=""> </label>
                    <button type="submit" class="btn btn-success btn-block">Search</button>
                </div>
            </div>
        </form>
        @endif
        @if (session()->get('type') == 4)
                @if(isset($listtype))
                @if($listtype == 1)
                <form action="{{ url('searchnetwork') }}" method="post">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label  for="">Select Type</label>
                    <select name="filter_type" class="form-control form-select" id="">
                        <option value="">Select Type</option>
                        <option value="1">Top Earners</option>
                    </select>
                </div>
                        <div class="col-md-3">
                            <input type="hidden" name="utype" value="1">
                            <label for="">Enter Name</label>
                            <input type="name" class="form-control" placeholder="Search mearchant" name="username" id="">
                        </div>
                        <div class="col-md-3">
                            <label for=""> </label>
                            <button type="submit" class="btn btn-success btn-block">Search</button>
                        </div>
                    </div>
                </form>
                @endif
                @if($listtype == 3)
                <form action="{{ url('searchnetwork') }}" method="post">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label for="">Select Type</label>
                    <select name="filter_type" class="form-control form-select" id="">
                        <option value="">Select Type</option>
                        <option value="1">Top Earners</option>
                    </select>
                </div>
                        <div class="col-md-3">
                            <input type="hidden" name="utype" value="3">
                            <label for="">Enter Name</label>
                            <input type="name" class="form-control" placeholder="Search distibutor" name="username" id="">
                        </div>
                        <div class="col-md-3">
                            <label for=""> </label>
                            <button type="submit" class="btn btn-success btn-block">Search</button>
                        </div>
                    </div>
                </form>
                @endif
                @endif
                @endif
            <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                        <th>SL. No.</th>
                        <th>Mobile Number</th>
                        <th>Name</th>
                        <th>Company name</th>
                        <th>Details</th>
                        <th>Type</th>
                        <th>Wallet balance</th>
                        @if (session()->get('type') == 4)
                        @if(isset($listtype))
                        @if($listtype == 3)
                        <th>Balance in network</th>
                        
                        @endif
                        @endif
                        @endif
                        <th>Curent Plan</th>  
                        <th class="px-5">Plan</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($qlist as $index => $list)
                      <tr>
                        <td>{{$index + $qlist->firstItem()}}</td>
                          <td>{{ $list->mobile }}</td>
                          <td>{{ $list->name }}</td>
                          <td>{{ $list->shop_name }}</td>
                          <td>{{ $list->p_address }},{{ $list->landmark }},{{ $list->city }},{{ $list->state }},{{ $list->pincode }}</td>
                          <td>
                            Merchant
                        </td>
                          <td>{{ $list->wallet }}</td>
                          @if (session()->get('type') == 4)
                        @if(isset($listtype))
                        @if($listtype == 3)
                        <td>{{ count_total_wallet($list->id) }}</td>
                        @endif
                        @endif
                        @endif
                        <td>
                            {{get_plan_name($list->plan_id)}}
                            </td>
                          <td>
                              @if ($list->is_kyc == 1)
                              <select name="distibutor_change_network_plan" id="distibutor_change_network_plan" onchange="change_network_plan_tpin_valid({{$list->id}})" class="form-select form-control">
                                  <option value="">Select Plan</option>
                                  @php
                                    $get_user_curent_plan_price = get_plan_price($list->plan_id);
                                  @endphp
                                  @foreach ($plan as $item)
                                  @if($item->price != $get_user_curent_plan_price)
                                  <option value='{{ $item->id }}'>{{ $item->package_name }}</option>
                                  @endif
                                  @endforeach
                              </select>
                              @else
                                  KYC Pending 
                              @endif
                          </td>
                          <td>
                              @if ($list->is_kyc == 1)
                                <input type="hidden" name="" value="{{ $list->name }}" id="username{{$list->id}}">
                                <input type="hidden" name="" value="{{ $list->mobile }}" id="mobile{{$list->id}}">
                                <input type="hidden" name="" value="{{ $list->shop_name }}" id="company_name{{$list->id}}">
                                <input type="hidden" name="" value="{{ $list->wallet }}" id="wallet_bal{{$list->id}}">
                                <input type="hidden" name="" value="{{ $list->id }}" id="suid{{$list->id}}">
                                <button onclick="network_credit({{$list->id}})" type="button" class="btn btn-success">Transfer</button>
                              @else
                              KYC Pending 
                              @endif
                          </td>
                            </tr>
                      @endforeach
                      {{-- <tr>
                          <td colspan="6">
                              <h3 style="float: right;font-weight: 800;">Total</h3>
                          </td>
                          <td colspan="2">
                              @if (session()->get('type') == 3)
                                  
                              <h3 style="font-weight: 800;float: left;">Rs. {{ count_total_wallet(session()->get('userid')); }}</h3>
                              @endif
                              @if (session()->get('type') == 4)
                              @if(isset($listtype))
                            @if($listtype == 1)
                            <h3 style="font-weight: 800;float: left;">Rs. {{ count_total_wallet_of_mearchant_for_masterd_distibutor(session()->get('userid')); }}</h3>
                            @endif
                            @if($listtype == 3)
                            <h3 style="font-weight: 800;float: left;">Rs. {{ count_total_wallet_of_distibutor_for_masterd_distibutor(session()->get('userid')); }}</h3>
                            @endif
                            @endif
                              @endif
                          </td>
                      </tr> --}}
                  </tbody>
                </table>
            </div>
            <div class="mt-2">
                {{$qlist->withQueryString()->links()}}
            </div>
        </div>
    </div>
</div>
@endsection