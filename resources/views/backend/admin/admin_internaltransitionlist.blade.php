@extends('backend.master')
@section('body')
<div class="row">
  @include('backend.admin.tpage_menu')
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                Internal Transaction History
            </h4>
            <form action="{{ url('admin_leinwallet_history_filter') }}" method="get">
              @csrf
          <div class="row mb-2">
              <div class="col-md-2">
                  <label for="">Filter Type</label>
                  <select name="filter_type" onchange="set_filter_type(this.value)" id="add_wallet_filter_type" class="form-control" required>
                      <option value="">Type</option>
                      <option value="1">Today</option>
                      <option value="2">Last 7 days</option>
                      <option value="3">This month</option>
                      <option value="4">Custom Date</option>
                  </select>
              </div>
              <div class="col-md-6" id="cpart"></div>
              <div class="col-md-6" id="bpart" style="display: none;">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="payment_options" id="payment_options" >
                              <label for="">Payment Options</label>
                              @php
                                  $payment_optionsq = DB::table('payment_options')->get();
                                  $topup_optionsq = DB::table('topup_options')->get();
                              @endphp
                                  <select name="payment_options" class="form-control form-select">
                                  @foreach ($payment_optionsq as $list)
                                      <option value="{{$list->id}}">{{$list->option_name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class=""  id="toup_options">
                              <label for="">To-up Options</label>
                              <select name="toup_options" class="form-control form-select">
                                  <option value="">Select Option</option>
                                  @foreach ($topup_optionsq as $list)
                                      <option value="{{ $list->type }}">{{ $list->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-6" id="apart" style="display: none;">
                  <div class="row">
                      <div class="col-md-4">
                          <div class="date_range"  style="display:none;">
                              <label for="">From Date</label>
                              <input type="text"  name="from_date" id="home_filter_from_date" class="form-control">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="date_range"  style="display:none;">
                              <label for="">To Date</label>
                              <input type="text" name="to_date" id="home_filter_to_date" class="form-control">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="oder_id_fild" id="order_id" style="display:none;">
                              <label for="">Transaction Id</label>
                              <input type="text" name="order_id_f" class="form-control">
                          </div>
                      </div>
                  </div>
              </div>
              
              <div class="col-md-2" >
                  <label for=""> </label>
                  <button type="submit" class="btn btn-success btn-block">Filter</button>
              </div>
              <div class="col-md-2">
                  <label for=""> </label>
                  <a href="{{ url('admin_internaltransitionlist') }}" type="submit" class="btn btn-success btn-block">Reset</a>
              </div>
          </div>
      </form>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Sl. No</th>
                              <th>Date</th>
                              <th>Time</th>
                              <th>Sender Name</th>
                              <th>Receiver Name</th>
                              <th>Txn. Amount</th>
                              <th>Action</th>
                              <th>Remarks</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($q as $index => $list)
                            <tr>
                              <td>{{$index + $q->firstItem()}}</td>
                                <td>{{ $list->date }}</td>
                                <td>{{ $list->time }}</td>
                                <td>{{ get_user_name($list->received_userid) }}</td>
                                <td>{{ get_user_name($list->sender_id) }}</td>
                                <td>{{ number_format($list->amount,2) }}</td>
                                <td>
                                @if ($list->type == 1)
                                Debit
                                @endif
                                @if ($list->type == 2)
                                Credit
                                @endif
                                </td>
                                <td>
                                    {{ $list->remark }}
                                </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <div class="py-2">
                        {{$q->withQueryString()->links()}}
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection