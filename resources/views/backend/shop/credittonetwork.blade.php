@extends('backend.master')
@section('body')
<input type="hidden" name="" id="distibutor_wallet_bal" value="{{ get_wallet_bal() }}">
<div class="row match-height">
    <div class="col-md-6">
        <div class="card p-2">
            <h4 class="card-title">
                <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif ><i data-feather='arrow-left'></i></a> 
                Network Credit
            </h4>
            <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                        <th>Details</th>
                        <th>Mobile Number</th>
                        <th>Wallet balance</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($qlist as $list)
                      <tr>
                          <td>
                            <input type="hidden" name="" value="{{ $list->name }}" id="username{{$list->id}}">
                            <input type="hidden" name="" value="{{ $list->mobile }}" id="mobile{{$list->id}}">
                            <input type="hidden" name="" value="{{ $list->shop_name }}" id="company_name{{$list->id}}">
                            <input type="hidden" name="" value="{{ $list->wallet }}" id="wallet_bal{{$list->id}}">
                            <input type="hidden" name="" value="{{ $list->id }}" id="suid{{$list->id}}">
                              {{ $list->p_address }},({{$list->shop_name}})</td>
                          <td>{{ $list->mobile }}</td>
                          <td>{{ $list->wallet }}</td>
                          <td>
                              <button onclick="network_credit({{$list->id}})" type="button" class="btn btn-success">Transfer</button>
                          </td>
                            </tr>
                      @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-2">
            <h4 class="card-title">
                Network Credit History
            </h4>
            <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                        <th>Transaction Id</th>
                        <th>Date</th>
                        <th>Transaction Details</th>
                        <th>Debit Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($q as $list)
                        <tr>
                            <td>#{{ $list->id }}</td>
                            <td> {{ $list->date }} {{ $list->time }} </td>
                            <td>{{ $list->remark }}</td>
                            <td>{{ $list->amount }}</td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection