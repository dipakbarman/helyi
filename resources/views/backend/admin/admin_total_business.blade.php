@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12 card p-1">
        <form action="{{ url($filter_url) }}" method="get">
            @csrf
            <div class="col-md-12">
                <h4 class="card-title">
                    {{$title}} Business
                </h4>
            </div>
        <div class="row mb-2">
            <div class="col-md-2">
                <label for="">Filter Type</label>
                <select name="filter_type" onchange="set_filter_type(this.value)" id="add_wallet_filter_type" class="form-control" >
                    <option value="">Type</option>
                    <option value="1">Today</option>
                    <option value="2">Last 7 days</option>
                    <option value="3">This month</option>
                    <option value="4">Custom Date</option>
                    <option value="7">Top Rank</option>
                </select>
            </div>
            <div class="col-md-4" id="cpart"></div>
            <div class="col-md-6" id="bpart" style="display: none;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="payment_options" id="payment_options" >
                            <label for="">Payment Status</label>
                                <select name="payment_status" class="form-control form-select">
                                    <option value="1">Complete</option>
                                    <option value="0">Pending</option>
                                    <option value="2">Failed</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="apart" style="display: none;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="date_range"  style="display:none;">
                            <label for="">From Date</label>
                            <input type="text" id="from_date" name="from_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="date_range"   style="display:none;">
                            <label for="">To Date</label>
                            <input type="text" id="to_date" name="to_date" class="form-control">
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
            <div class="col-md-2">
                <label for="">User Name</label>
                <input type="text" class="form-control" name="user_name">
            </div>
            <div class="col-md-4" >
                <label for=""> </label>
                <button type="submit" class="btn btn-success btn-block">Filter</button>
            </div>
        </div>
    </form>
</div>
    </div>
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                Total Wallet Added
            </h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                          <th>Sl. No.</th> 
                          <th>Date</th>
                          <th>User Name</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                              @foreach($wallet_added as $index => $list)
                                <tr>
                                    <td>{{$index + $wallet_added->firstItem()}}</td>
                                    <td>{{ $list->date }}</td>
                                    <td>{{ get_user_name($list->userid) }}</td>
                                    <td>{{ number_format($list->amount,2) }}</td>
                                </tr>
                              @endforeach
                              <tr>
                                  <td></td>
                                  <td></td>
                                  <td id="total_css">Total</td>
                                  <td id="total_css">{{number_format($wallet_added_total,2)}}</td>
                              </tr>
                      </tbody>
                </table>
                <div class="py-2">
                    {{ $wallet_added->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                Total Accounts Verified
            </h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                          <th>Sl. No.</th> 
                          <th>Date</th>
                          <th>User Name</th>
                          <th>Bank Account No</th>
                          <th>Bank IFSC</th>
                        </tr>
                      </thead>
                      <tbody>
                              @foreach($total_account_verified as $index => $list)
                                <tr>
                                    <td>{{$index + $total_account_verified->firstItem()}}</td>
                                    <td>{{ datedbu($list->mindate) }}</td>
                                    <td>{{ get_user_name($list->uid) }}</td>
                                    <td>{{ $list->account_number }}</td>
                                    <td>{{ $list->ifsc }}</td>
                                </tr>
                              @endforeach
                              <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td id="total_css">Total</td>
                                  <td id="total_css">{{$total_account_verified_total}}</td>
                              </tr>
                      </tbody>
                </table>
                <div class="py-2">
                    {{ $total_account_verified->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                Total Payout Done
            </h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                          <th>Sl. No.</th> 
                          <th>Date</th>
                          <th>User Name</th>
                          <th>Tnx. Amount</th>
                          <th>Bank Account No</th>
                          <th>Bank IFSC</th>
                        </tr>
                      </thead>
                      <tbody>
                              @foreach($total_payout_done as $index => $list)
                                <tr>
                                    <td>{{$index + $total_payout_done->firstItem()}}</td>
                                    <td>{{ datedbu($list->mindate) }}</td>
                                    <td>{{ get_user_name($list->uid) }}</td>
                                    <td>{{ number_format($list->amount,2) }}</td>
                                    <td>{{ $list->account_no }}</td>
                                    <td>{{ $list->ifsc }}</td>
                                </tr>
                              @endforeach
                              <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td id="total_css">Total</td>
                                  <td id="total_css">{{$total_payout_done_total}}</td>
                              </tr>
                      </tbody>
                </table>
                <div class="py-2">
                    {{ $total_payout_done->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection