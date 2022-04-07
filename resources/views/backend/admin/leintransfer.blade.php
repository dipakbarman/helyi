@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="cart-title">
                <div class="row">
                    <div class="col-md-3">Lein Wallet Transfer</div>
                    <div class="col-md-4">
                        <form action="{{ url('admin_lein_filter') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-9">
                                    <input type="text" placeholder="Enter number" name="filte" id="filte" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-success" type="submit"  >
                                        <i data-feather='filter'></i>
                                    </button>
                                </div>
                            </div>
                    </div>
                </form>
                    <div class="col-md-5">
                        <form action="{{ url('multy_lein_tranfer_form') }}" method="post" id="multy_admin_lein_transfer">
                            @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" id="lein_t_remark_text" name="remark">
                                <input type="hidden" id="lein_t_remark_price" name="t_amount">
                                <select name="ttype" id="ttype" required class="form-control form-select">
                                    <option value="">Select Transfer Type</option>
                                    <option value="1">Wallet Transfer</option>
                                    <option value="2">Add Lein Wallet</option>
                                    <option value="3">Deduct Money</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <button type="button" onclick="multy_lein_tranfer_form_btn()" class="btn btn-block btn-success">Proceed</button>
                            </div>
                        </div>
                    </div>
                </div>
            </h4>
            <div class="row justify-content-center">
                {{-- <div class="col-md-4">
                    @if (isset($account_data))
                    <form action="{{ url('leintransfer_form') }}" method="post" id="admin_leintransfer_form" onsubmit="validbtn()">
                        @csrf
                        <div class="mb-2" id="number_field">
                            <label for="">Enter Phone Number</label>
                            <input type="number" readonly name="phone_number" value="{{$account_data->mobile}}" id="phone_number" class="form-control">
                        </div>
                        <div class="mb-1 text-center user_info_style">
                            <p>Name - {{$account_data->name}} - {{$account_data->mobile}}</p>
                            <p>Company Name - {{$account_data->shop_name}}</p> 
                            <p>Wallet Balance - Rs. {{$account_data->wallet}}</p>
                            <p>Lein Wallet Balance - Rs. {{$account_data->lein_wallet}}</p>
                        </div>
                        <div class="mb-2" id="amount_field">
                            <label for="">Enter Amount</label>
                            <input type="hidden" name="leinwallet" value="{{$account_data->lein_wallet}}" id="m_wallet_bal">
                            <input type="hidden" name="uid" value="{{$account_data->id}}" id="">
                            <input type="number" name="amount" id="amount" class="form-control">
                            <span class="mb-2 mt-1" id="ammount_in_word" style="text-transform: capitalized;color:hotpink;"></span><span id="nhide" style="color:hotpink;display:none;"> rupees only</span>
                        </div>
                        <div class="mb-2" id="remark_field">
                            <label for="">Enter Remark</label>
                            <input type="text" name="remark" id="remark" class="form-control">
                        </div>
                        <div class="mb-2">
                            <button type="button" onclick="admin_send_lein_fund()" class="btn btn-success">Submit</button>
                            <a href="{{ url('leintransfer') }}" id="submit_btn" class="btn btn-success">Cancel</a>
                        </div>
                       
                    </form>
                    @else
                        <form action="{{ url('leintransfer_find_user_data') }}" method="post" id="account_find_form" onsubmit="validbtn()">
                            @csrf
                            
                            <div class="mb-2" id="number_field">
                            <label for="">Enter Phone Number</label>
                            <input type="number" name="phone_number" id="phone_number" class="form-control" required>
                            <label class="text-danger" id="phone_number_error" style="display: none;" for="">Phone number should be 10 digit</label>
                        </div>
                        <div class="mb-2">
                            <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                            <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                        </div>
                        </form>
                    @endif
                </div> --}}
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Company Name</th>
                                    <th>Lein Wallet</th>
                                    <th>Main Wallet</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($qlist as $list)
                                <tr>
                                    <td>
                                        <input type="checkbox" id="inlineCheckbox{{ $list->id }}" value="{{ $list->id }}" name="users[]" class="form-check-input">
                                    </td>
                                    <td>{{$list->name}}</td>
                                    <td>{{$list->mobile}}</td>
                                    <td>{{$list->shop_name}}</td>
                                    <td>{{$list->lein_wallet}}</td>
                                    <td>{{$list->wallet}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="py-2">
                            {{$qlist->withQueryString()->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection