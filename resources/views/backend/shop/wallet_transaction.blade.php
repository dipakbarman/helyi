@extends('backend.master')
@section('body')
    @if (isset($sweet_success)) 
    dd($sweet_success);
    @endif
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif><i data-feather='arrow-left'></i></a> 
                Internal/Network Transfer
            </h4>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    @if (isset($account_data))
                    <form action="" method="post" id="" onsubmit="validbtn()">
                        @csrf
                        <div class="mb-2" id="number_field">
                            <label for="">Enter Phone Number</label>
                            <input type="number" readonly name="phone_number" value="{{$account_data->mobile}}" id="phone_number" class="form-control">
                        </div>
                        <div class="mb-1 text-center user_info_style">
                            <p>Name - {{$account_data->name}} - {{$account_data->mobile}}</p>
                            <p>Company Name - {{$account_data->shop_name}}</p> 
                            <p>Wallet Balance - Rs. {{$account_data->wallet}}</p>
                        </div>
                        <div class="mb-2" id="amount_field">
                            <label for="">Enter Amount</label>
                            <input type="hidden" name="" value="{{get_wallet_bal()}}" id="m_wallet_bal">
                            <input type="number" name="amount" id="amount" class="form-control">
                            <span class="mb-2 mt-1" id="ammount_in_word" style="text-transform: capitalized;color:hotpink;"></span><span id="nhide" style="color:hotpink;display:none;"> rupees only</span>
                        </div>
                        <div class="mb-2" id="remark_field">
                            <label for="">Enter Remark</label>
                            <input type="text" name="remark" id="remark" class="form-control">
                        </div>
                        
                        <div class="mb-2">
                            <button type="button" id="pin_check_modeal" class="btn btn-success">Submit</button>
                            <a href="{{ url('internal_transfer') }}" id="submit_btn" class="btn btn-success">Cancel</a>
                        </div>
                       
                    </form>
                    @else
                        <form action="{{ url('find_user_data') }}" method="post" id="account_find_form" onsubmit="validbtn()">
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
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="my_waler" value="{{get_wallet_bal()}}">
<script>
    var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];
    function inWords (num) {
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return; var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + ' ' : '';
    $("#nhide").show();
    return str;
}

document.getElementById('amount').onkeyup = function () {
    document.getElementById('ammount_in_word').innerHTML = inWords(document.getElementById('amount').value);
};
	
document.querySelector("#phone_number")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#phone_number").val();
    if(ph.length != 10){
        $("#phone_number_error").show();
    }else{
        $("#phone_number_error").hide();
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 9999999999) {
        return false;
      }
      input.value = value;
    }
  });
</script>
@endsection