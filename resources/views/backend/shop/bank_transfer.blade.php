@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif><i data-feather='arrow-left'></i></a> 
                Transfer Funds
            </h4>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="bank_details text-center mb-1">
                        <h4>
                            @if(!empty($bankq->varify_user_name))
                                {{$name = $bankq->varify_user_name}}
                            @else
                                {{$name = $bankq->name}}
                            @endif
                        </h4>
                        <h6>{{ get_bank_name($bankq->bank_name) }} ({{ $bankq->account_number }})</h6>
                        <h6>{{ $bankq->ifsc }}</h6>
                    </div>
                    <form action="{{ url('money_transfer_form_sub') }}" id="payee_form_id" method="post" onsubmit="validbtn()">
                        @csrf
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label for="">Sender name</label>
                            <input type="text" required class="form-control" name="sender_name" id="sender_name">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="">Amount</label>
                            <input type="number" required class="form-control" name="amount" id="tamount">
                            <span class="mb-2 mt-1" id="ammount_in_word" style="text-transform: capitalized;color:hotpink;"></span><span id="nhide" style="color:hotpink;display:none;"> rupees only</span>
                        </div>
                        <input type="hidden" name="ac_id" value="{{$bankq->id}}">
                        <input type="hidden" name="fee" id="fee" value="">
                        <div class="col-md-12">
                            <label for="">Purpose of the payment</label>
                            <select required name="purpose" class="form-select mb-2" id="select2-basic">
                                @php
                                    $purpose_of_payment = DB::table('purpose_of_payment')->get();
                                @endphp
                                @foreach ($purpose_of_payment as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                                {{-- <option value="1">Tuition fees</option>
                                supplier payment
                                <option value="2">Taxes</option>
                                <option value="3">Rent/Leaser</option>
                                <option value="4">Contactors</option>
                                <option value="5">Home Supplies</option>
                                <option value="6">Office Supplies</option>
                                <option value="7">Freelancers</option>
                                <option value="8">Employees</option>
                                <option value="9">Legal Services</option> --}}
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-check form-check-inline">
                                <input
                                class="form-check-input form-check-css type paymentoption"
                                type="radio"
                                checked
                                name="type"
                                id="type1"
                                value="1"
                              />
                              <label class="form-check-label" style="font-size:12px;" for="type1">IMPS</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-check-inline">
                                <input
                                class="form-check-input form-check-css type paymentoption"
                                type="radio"
                                name="type"
                                id="type2"
                                value="2"
                              />
                              <label class="form-check-label" style="font-size:12px;" for="type2">NEFT</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-check-inline">
                                <input
                                class="form-check-input form-check-css type paymentoption"
                                type="radio"
                                name="type"
                                id="type3"
                                value="3"
                              />
                              <label class="form-check-label" style="font-size:12px;" for="type3">RTGS</label>
                            </div>
                        </div>
                        {{-- <div class="col-md-12">
                            <select required name="type" class="form-control form-select mb-2" id="">
                                <option value="1">IMPS</option>
                                <option value="2">NEFT</option>
                                <option value="3">RTGS</option>
                            </select>
                        </div> --}}
                        <div class="col-md-12 mb-2">
                            <label for="">Remark</label>
                            <input type="text" name="remark" class="form-control" id="">
                        </div>
                        <span class="text-danger mb-2">Max 2 lakh per trans. Real time works 24X7</span>
                        <h4 class="mb-1">From</h4>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Main Wallet</h5>                                    
                                    <p>{{ get_user_number(session()->get('userid')) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Available Balance</h5>
                                    <p>Rs. {{get_wallet_bal()}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" onclick="transfer_pin_m_open()" class="btn btn-success btn-block">Proceed</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
    function inWords (num) {
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return; var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + '' : '';
    $("#nhide").show();
    return str;
}

document.getElementById('tamount').onkeyup = function () {
    $('input[name="topupmen"]:checked').prop('checked', false);
    $("#fee_view_sec").hide();
    document.getElementById('ammount_in_word').innerHTML = inWords(document.getElementById('tamount').value);
};
</script>
@endsection