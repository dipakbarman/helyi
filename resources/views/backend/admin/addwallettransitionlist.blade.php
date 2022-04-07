@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                Add Wallet Transaction History @if(isset($title)) @if ($title == 1) (Razorpay) @endif @if ($title == 2) (Cashfree) @endif @endif
            </h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th>Company Name</th>
                              <th>Company Number</th>
                              <th>Amount</th>
                              <th>Method</th>
                              <th>Payment Id</th>
                              <th>Topup Type</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($q as $list)
                            <tr>
                                <td>{{ $list->view_date }}</td>
                                <td>{{ get_company_name($list->userid) }}</td>
                                <td>{{ get_user_number($list->userid) }}</td>
                                <td>{{ $list->amount }}</td>
                                <td>{{ $list->method }}</td>
                                <td>{{ $list->payment_id }}</td>
                                <td>
                                    @php
                                        if($list->topuptype == 0){
                                            echo "Instant";
                                        }
                                        if($list->topuptype == 1){
echo "T+1";
                                        }
                                        if($list->topuptype == 2){
                                            echo "T+2";
                                        }
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        if($list->is_added == 0){
echo "<span class='badge badge-glow bg-warning'>Processing</span>";
                                        }
                                        if($list->is_added == 1){
                                            echo "<span class='badge badge-glow bg-success'>Successful</span>";                       
                                        }
                                    @endphp
                                </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection