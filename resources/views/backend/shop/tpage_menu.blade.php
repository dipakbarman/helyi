<div class="card p-2">
    <style>
        .row.match-height.btn-header.sss a {
            font-size: 12px;
        }
    </style>
    <div class="row justify-content-center match-height btn-header sss">
        <div class="col-2">
            <a href="{{url('alltransaction')}}" class="btn btn-success waves-effect waves-float waves-light">All Transaction</a>
        </div>
        @if(session()->get('type') != 1)
        <div class="col-2">
<a href="{{url('comissionhistory')}}" class="btn btn-success waves-effect waves-float waves-light">Commission</a>
        </div>
        @endif
        
        <div class="col-2">
            <a href="{{url('transaction_history')}}" class="btn btn-success waves-effect waves-float waves-light">Lein wallet</a>
        </div>
        <div class="col-2">
            <a href="{{url('addwallettransition')}}" class="btn btn-success waves-effect waves-float waves-light">Add Wallet</a>
        </div>
        <div class="col-2">
            <a href="{{url('payouttransaction')}}" class="btn btn-success waves-effect waves-float waves-light">Payout</a>
        </div>
        <div class="col-2">
            <a href="{{url('internaltransition')}}" class="btn btn-success waves-effect waves-float waves-light">Internal</a>
        </div>
        {{-- <div class="col-2">
            <a href="{{url('admintransitionhistory')}}" class="btn btn-success waves-effect waves-float waves-light">Admin</a>
        </div> --}}
        {{-- <div class="col-2">
            <a href="{{url('razorpaytransitionhistory')}}" class="btn btn-success waves-effect waves-float waves-light">Razorpay Transaction</a>
        </div>
        <div class="col-2">
            <a href="{{url('cashfreetransitionhistory')}}" class="btn btn-success waves-effect waves-float waves-light">Cashfree Transaction</a>
        </div> --}}
    </div>
</div>