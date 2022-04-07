@extends('backend.master')
@section('body')
<div class="row">
  @include('backend.admin.tpage_menu')
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                Payout Transaction History
            </h4>
            <form action="{{ url('admin_payout_filter') }}" method="get">
              @csrf
          <div class="row mb-2">
              <div class="col-md-2">
                  <label for="">Filter Type</label>
                  <select name="filter_type" onchange="set_filter_type(this.value)" id="add_wallet_filter_type" class="form-control" required>
                      <option value="">Type</option>
                      <option value="1">Today</option>
                      <option value="2">Last 7 days</option>
                      <option value="3">This month</option>
                      <option value="4">Custom date</option>
                      <option value="9">Transaction Id</option>\
                      <option value="7">Status</option>
                      {{-- <option value="10">User Data</option> --}}
                  </select>
              </div>
              {{-- <div class="col-md-6" id="gpart" style="display: none;">
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <label for="">User Name</label>
                            <input type="text" name="transaction_id" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="">UTR Id</label>
                            <input type="text" name="utr_id" class="form-control">
                        </div>
                    </div>
                </div>
            </div> --}}
              <div class="col-md-6" id="fpart" style="display: none;">
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <label for="">Transaction Id</label>
                            <input type="text" name="transaction_id" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="">UTR Id</label>
                            <input type="text" name="utr_id" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" id="dpart" style="display: none;">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Select Status</label>
                        <select name="status_type" class="form-control" id="">
                            <option value="1">Success</option>
                            <option value="0">Pending</option>
                            <option value="2">Failed</option>
                            <option value="0">Processing</option>
                            <option value="2">Rejected</option>
                            <option value="2">Reversed</option>
                        </select>
                    </div>
                </div>
            </div>
              <div class="col-md-6" id="apart" style="display: none;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="date_range" style="display:none;">
                            <label for="">From Date</label>
                            <input type="text"  id="home_filter_from_date" name="from_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="date_range"  style="display:none;">
                            <label for="">To Date</label>
                            <input type="text" id="home_filter_to_date" name="to_date" class="form-control">
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
              <div class="col-md-6" id="cpart"></div>
              <div class="col-md-6" id="bpart" style="display: none;">
                  <div class="row">
                      <div class="col-md-6">
                          
                      </div>
                      <div class="col-md-6">
                          
                      </div>
                  </div>
              </div>
              <div class="col-md-6" id="apart" style="display: none;">
                  <div class="row">
                      <div class="col-md-4">
                          <div class="date_range"  style="display:none;">
                              <label for="">From Date</label>
                              <input type="text" id="home_filter_from_date" name="from_date" class="form-control">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="date_range"   style="display:none;">
                              <label for="">To Date</label>
                              <input type="text" id="home_filter_to_date" name="to_date" class="form-control">
                          </div>
                      </div>
                      <div class="col-md-4">
                          {{-- <div class="oder_id_fild" id="order_id" style="display:none;">
                              <label for="">Transaction Id</label>
                              <input type="text" name="order_id_f" class="form-control">
                          </div> --}}
                      </div>
                  </div>
              </div>
              
              <div class="col-md-2" >
                  <label for=""> </label>
                  <button type="submit" class="btn btn-success btn-block">Filter</button>
              </div>
              <div class="col-md-2">
                  <label for=""> </label>
                  <a href="{{ url('admin_payout_history') }}" type="submit" class="btn btn-success btn-block">Reset</a>
              </div>
          </div>
      </form>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                                <th>Sl. No.</th> 
                                  <th>Date</th>
                                  <th>Time</th>
                                  <th>User Name</th>
                                  <th>Phone</th>
                                  <th>Amount</th>
                                  <th>Transaction Id</th>
                                  <th>UTR</th>
                                  <th>Account Number</th>
                                  <th>IFSC</th>
                                  <th>Status</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($q as $index => $list)
                                    <tr>
                                    <td>{{$index + $q->firstItem()}}</td>
                                    <td>{{ $list->date }}</td>
                                    <td>{{ $list->time_is }}</td>
                                    <td>{{ get_user_name($list->uid) }}</td>
                                    <td>{{ get_user_number($list->uid) }}</td>
                                    <td>{{ number_format($list->amount,2) }}</td>
                                    <td>{{ $list->transferid }}</td>
                                    <td>{{ $list->uti }}</td>
                                    <td>{{ $list->account_no }}</td>
                                    <td>{{ $list->ifsc }}</td>
                                    <td>
                                        @if($list->status == 1)
                                        <span class='badge badge-glow bg-success'>{{ $list->status_text }}</span>
                                        @endif
                                        @if($list->status == 0)
                                        <span class='badge badge-glow bg-warning'>
                                            @if ($list->status_text == "SUCCESS")
                                            PENDING
                                            @else
                                                {{$list->status_text}}
                                            @endif
                                        </span>
                                        @endif
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