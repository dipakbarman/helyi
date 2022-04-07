<form action="{{ url('admin_add_wallet_history_filter') }}" method="get">
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
            <option value="5">Transaction Id</option>
            <option value="7">Status</option>
            <option value="6">Payment Methods</option>
            <option value="8">Order Amount</option>
            <option value="11">User Data</option>
        </select>
    </div>
    <div class="col-md-6" id="epart" style="display: none;">
        <div class="row">
            <div class="col-md-6">
                <label for="">Order Amount Type</label>
                <select name="order_amount_type" class="form-control" id="">
                    <option value="1">Is less than equal to</option>
                    <option value="3">Is equal to</option>
                    <option value="4">Is greater than equal to</option>
                    <option value="5">Is less than</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="">Enter Amount</label>
                <input type="number" name="order_amount" class="form-control" id="">
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
                    <option value="3">Failed</option>
                    <option value="3">Incomplete</option>
                    <option value="3">Cancelled</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-6" id="hpart" style="display: none;">
        <div class="row">
            <div class="col-md-6">
                <label for="">User Name</label>
                <input type="text" name="username" class="form-control" id="">
            </div>
            <div class="col-md-6">
                <label for="">Phone number</label>
                <input type="number" name="phone_number" class="form-control" id="">
            </div>
        </div>
    </div>
    <div class="col-md-6" id="cpart">
    </div>
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
    
    <div class="col-md-2" >
        <label for=""> </label>
        <button type="submit" class="btn btn-success btn-block">Filter</button>
    </div>
    <div class="col-md-2">
        <label for=""> </label>
        <a href="{{ url('admin_add_wallet_history') }}" type="submit" class="btn btn-success btn-block">Reset</a>
    </div>
</div>
</form>