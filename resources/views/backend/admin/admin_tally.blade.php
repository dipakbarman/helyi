@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title mb-2 pdf_btn_al">              
                Tally 
            </h4>
            <div class="row">
                <div class="py-2">
                    <form action="{{ url('admin_tally') }}" method="get">
                      @csrf
                      <style>
                        #fdiv .col-md-2{
                          margin-bottom: 10px;
                        }
                      </style>
                      <div class="row" id="fdiv">
                        <div class="col-md-2">
                          <select onchange="tally_datefilter(this.value)" name="filtertype" id="filtertype" class="form-control">
                            <option value="1">Today</option>
                            <option value="2">Last 7 days</option>
                            <option value="3">This Month</option>
                            <option value="4">Custom Date</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <input type="text" class="form-control" name="uname" placeholder="User name">
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control" name="mobile" placeholder="Phone number">
                        </div>
                        <div class="col-md-2 tallydate" style="display: none;">
                            <input type="text"  id="home_filter_from_date" name="fromdate" value="{{ date('d-m-Y') }}" class="form-control" placeholder="From date">
                        </div>
                        <div class="col-md-2 tallydate" style="display: none;">
                            <input type="text" id="home_filter_to_date" name="todate" value="{{ date('d-m-Y') }}" class="form-control" placeholder="To date">
                        </div>
                        {{-- <div class="col-md-2">
                          <input type="text" class="form-control" name="addwallet_txnid" placeholder="Addwallet Txn id">
                        </div>
                        <div class="col-md-2">
                          <input type="text" class="form-control" name="payouttxnid" placeholder="Paye Txn id">
                        </div> --}}
                        <div class="col-md-1">
                          <button type="submit" class="btn btn-success btn-block"><i data-feather='filter'></i></button>
                        </div>
                        <div class="col-md-1">
                          <button type="button" id="download-button"  class="btn btn-success btn-block"><i data-feather='download'></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <h4>Add wallet ledger</h4>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-bordered" id="addtable">
                        <thead>
                          <tr>
                            <th>Sl. No.</th> 
                            <th>User Details</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Txn. Id</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php
                              $i = 1;
                          @endphp
                          @foreach ($addmoney as $list)
                          <tr>
                            <td>{{$i}}</td>
                            <td> <span style="text-transform: capitalize;font-size:13px;"> <a href="{{ url('viewshop/'.$list->shop_id) }}">{{$list->name}}</a> </span> </td>
                            <td> <span>{{$list->view_date}}</span></td>
                            <td>{{number_format($list->total_amount,2,'.', '')}}</td>
                            <td>{{$list->payment_id}}</td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                          @endforeach
                          <tr>
                            <td></td>
                            <td></td>
                            <td> <span class="tally_css">Total</span> </td>
                            <td> <span class="tally_css">{{number_format($addmoney_total,2,'.', '')}}</span> </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <h4>Payout ledger</h4>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-bordered" id="payouttable">
                        <thead>
                          <tr>
                            <th>Sl. No.</th> 
                            <th>User Details</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Txn. Id</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php
                              $j = 1;
                          @endphp
                          @foreach ($payout as $list)
                          <tr>
                            <td>{{$j}}</td>
                            <td> <span style="text-transform: capitalize;font-size:13px;"><a href="{{ url('viewshop/'.$list->shop_id) }}">{{$list->name}}</a></span> </td>
                            <td> <span>{{$list->payoutdate}}</span></td>
                            <td>{{number_format($list->amount,2,'.', '')}}</td>
                            <td>{{$list->transferid}}</td>
                        </tr>
                        @php
                            $j++;
                        @endphp
                          @endforeach
                          <tr>
                            <td></td>
                            <td></td>
                            <td> <span class="tally_css">Total</span> </td>
                            <td> <span class="tally_css">{{number_format($payout_total,2,'.', '')}}</span> </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection