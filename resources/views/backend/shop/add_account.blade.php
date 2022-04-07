@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif><i data-feather='arrow-left'></i></a> 
                Make Payments
            </h4>
            <div class="row Make_Payments_info justify-content-center">
                <div class="col-md-3 text-center">
                    <i class="fas fa-mobile-alt"></i>
                    <p>Enter a mobile number to find related accounts</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-university"></i>
                    <p>You can add new account after entering mobile
                        number</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-credit-card"></i>
                    <p>Charges applicable for IMPS transfer.</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fas fa-user-shield"></i>
                    <p>Bank Account verification is available. You can
                        choose to skip it.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card p-2">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    
                    <form action="{{ url('find_bankacount_search') }}" method="get">
                        @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="">Mobile Number</label>
                                <input type="number" placeholder="Mobile Number" name="smobile" class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="">User Name</label>
                                <input type="text" placeholder="Username" name="username" class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="">Account Number</label>
                                <input type="number"  placeholder="Account Number" name="anumber" class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-md-3 mb-2 text-center">
                            <label for=""> </label>
                            <button class="btn btn-block btn-success" type="submit">Search</button>
                        </div>
                    </div>
                </form>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link active" id="storysummary-tab-fill" data-bs-toggle="pill" href="#storysummary-fill" aria-expanded="false"
                              >Payee List</a
                            >
                          </li>
                        <li class="nav-item">
                          <a class="nav-link" id="stores-tab-fill" data-bs-toggle="pill" href="#stores-fill" aria-expanded="false"
                            >Add New Payee</a
                          >
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="addfav-tab-fill" data-bs-toggle="pill" href="#addfav-fill" aria-expanded="false"
                              >Add To Favorites</a
                            >
                          </li>
                      </ul>
                    <div class="row" id="payeebtn_div">
                        <div class="col-md-12">
                            <div class="tab-content">
                                <div
                                  role="tabpanel"
                                  class="tab-pane active"
                                  id="storysummary-fill"
                                  aria-labelledby="storysummary-tab-fill"
                                  aria-expanded="true"
                                >
                                <form action="{{ url('find_bankacount_search') }}" method="get">
                                    @csrf
                                <div class="mb-2">
                                    <label for="">Enter Payee details</label>
                                    <input type="text" name="anumber" placeholder="Enter Payee details" class="form-control" id="">
                                </div>
                            </form>
                                <form action="{{ url('money_transfer_form') }}" method="get" onsubmit="validbtn()">
                                    @csrf
                                @foreach ($bankq as $list)
                                <div class="row mb-3">
                                    <div class="col-md-1">
                                        <input required class="form-check-input" onchange="fetchbankidfordelete(this.value)" type="radio" name="bankaccountid" id="inlineRadio{{$list->id}}" value="{{$list->id}}" />
                                    </div>
                                    <div class="col-md-10">
                                        <label class="form-check-label" for="inlineRadio{{$list->id}}"> @if(!empty($list->varify_user_name)) {{$list->varify_user_name}} @else {{$list->name}} @endif
                                             <br> 
                                            Account Number : {{$list->account_number}} <br>
                                            IFSC : {{$list->ifsc}} <br>
                                            {{get_bank_name($list->bank_name)}}
                                            </label> 
                                    </div>
                                    <div class="col-md-1">
                                        {{-- 1 = want to add
                                        2 = want to remove --}}
                                        <input type="hidden" class="favorite_status{{$list->id}}" value="@if($list->is_fav == 1) 2 @else 1 @endif">
                                        <a onclick="favorite_function({{$list->id}})" @if($list->is_fav == 1) style="color:#EA5455" @else style="color:#82868B" @endif class="addtofav{{$list->id}}"><i class="fas fa-heart"></i></a> 
                                    </div>
                                </div>
                                @endforeach
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="py-2">
                                            {{$bankq->withQueryString()->links()}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button onclick="money_transfer_btn()" type="submit" class="btn btn-outline-success waves-effect">Transfer Funds</button>
                                    </div>
                                </form>
                                    <div class="col-md-6">
                                        <form action="{{ url('delete_bankaccount') }}" id="delete_bankaccount" method="post">
                                            @csrf
                                        <input type="hidden" id="paybank_id" name="deletebankid">
                                            <button onclick="delete_payee()" type="button" id="submit_btan" class="btn btn-success">Delete Payee</button>
                                        </form>
                                            {{-- <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button> --}}
                                    </div>
                                </div>
                                </div>
                                <div
                                  class="tab-pane"
                                  id="addfav-fill"
                                  role="tabpanel"
                                  aria-labelledby="addfav-tab-fill"
                                  aria-expanded="false"
                                >
                                <form action="{{ url('money_transfer_form') }}" method="get" onsubmit="validbtn()">
                                    @csrf
                                @foreach ($fav_bankq as $list)
                                <div class="row mb-3">
                                    <div class="col-md-1">
                                        <input required class="form-check-input" onchange="fetchbankidfordelete(this.value)" type="radio" name="bankaccountid" id="inlineRadiofav{{$list->id}}" value="{{$list->id}}" />
                                    </div>
                                    <div class="col-md-10">
                                        <label class="form-check-label" for="inlineRadiofav{{$list->id}}"> @if(!empty($list->varify_user_name)) {{$list->varify_user_name}} @else {{$list->name}} @endif
                                            <br>
                                            Account Number : {{$list->account_number}} <br>
                                            IFSC : {{$list->ifsc}} <br>
                                            {{get_bank_name($list->bank_name)}}
                                            </label> 
                                    </div>
                                    <div class="col-md-1">
                                        <input type="hidden" class="favorite_status{{$list->id}}" value="@if($list->is_fav == 1) 2 @else 1 @endif">
                                        <a onclick="favorite_function({{$list->id}})" @if($list->is_fav == 1) style="color:#EA5455" @else style="color:#82868B" @endif class="addtofav{{$list->id}}"><i class="fas fa-heart"></i></a> 
                                    </div>
                                </div>
                                @endforeach
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="py-2">
                                            {{$fav_bankq->withQueryString()->links()}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button onclick="money_transfer_btn()" type="submit" class="btn btn-outline-success waves-effect">Transfer Funds</button>
                                    </div>
                                </form>
                                    <div class="col-md-6">
                                        <form action="{{ url('delete_bankaccount') }}" id="delete_bankaccount" method="post">
                                            @csrf
                                        <input type="hidden" id="paybank_id" name="deletebankid">
                                            <button onclick="delete_payee()" type="button" id="submit_btan" class="btn btn-success">Delete Payee</button>
                                        </form>
                                            {{-- <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button> --}}
                                    </div>
                                </div>
                                </div>
                                <div
                                  class="tab-pane"
                                  id="stores-fill"
                                  role="tabpanel"
                                  aria-labelledby="stores-tab-fill"
                                  aria-expanded="false"
                                >
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{ url('add_account_form') }}" id="add_account_form" method="post" onsubmit="validbtn()">
                                            @csrf
                                            <div class="mb-2">
                                                <label for="">Receiver mobile number</label>
                                                <input type="number" name="mobile_number" required id="caccount_mobile_number" class="form-control">
                                                <label class="text-danger" id="phone_number_error" style="display: none;" for="">Phone number should be 10 digit</label>
                                            </div>
                                            <div class="mb-2">
                                                <label for="">Bank Name</label>
                                                <select onchange="on_change_bank()" name="bank_name" class="bank_names select2 form-select" id="select2-basic get_bank_id" required>  
                                                    <option value="">Select bank name</option>
                                                    @foreach ($bank_list as $bank)
                                                    <option value="{{ $bank->id }}">{{ $bank->bank_names }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <label for="">IFSC code</label>
                                                <input type="text" name="ifsc" class="form-control" id="cifsc" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="">Account Number</label>
                                                <input type="number" name="account_number" class="form-control" id="a_no" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="">Confirm account number</label>
                                                <input type="number" name="confirm_account_number" class="form-control" id="ca_no" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="">Name as per bank A/C</label>
                                                <input type="text" id="name_of_user" name="name" class="form-control" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="">Nick Name</label>
                                                <input type="text" name="nick_name" id="nickname" class="form-control" required>
                                            </div>
                                            <div class="form-group form-check mb-2">
                                                <input type="checkbox" class="form-check-input" onchange="check_verify_btn()" id="is_bank_verify_checkbox" name="verify_accoun_checkbox" >
                                                <label class="form-label" for="is_bank_verify_checkbox">Tap to verify account</label>
                                            </div>
                                            <div class="mb-2">
                                                <button type="button" style="display: none;" id="verify_submit_btn" onclick="add_a_btn()" class="btn btn-success">Submit</button>
                                                <button type="submit"  id="submit_btn" class="btn btn-success">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                              </div>
                        </div>
                    </div>

                </div>
            </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card p-2">
                <h4 class="card-title">
                    Payee History
                </h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                      <th>Sl. No.</th> 
                                      <th>Date</th>
                                      <th>Amount</th>
                                      <th>Tax</th>
                                      <th>Transaction Id</th>
                                      <th>UTI</th>
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
                                        <td>{{ $list->amount }}</td>
                                        <td>{{ $list->tax }}</td>
                                        <td>{{ $list->transferid }}</td>
                                        <td>{{ $list->uti }}</td>
                                        <td>{{ $list->account_no }}</td>
                                        <td>{{ $list->ifsc }}</td>
                                        <td>
                                            @if($list->status == 1)
                                            <span class='badge badge-glow bg-success'>{{ $list->status_text }}</span>
                                            @endif
                                            @if($list->status == 2)
                                            <span class='badge badge-glow bg-danger'>{{$list->status_text}}</span>
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
</div>
<script>
      document.querySelector("#caccount_mobile_number")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#caccount_mobile_number").val();
    if(ph.length < 9){
        $("#phone_number_error").show();
    }else{
        $("#phone_number_error").hide();
		// $('#pin_check_btn').attr("disabled", true);
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
    function setInputFilter(textbox, inputFilter){
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  });
}
  setInputFilter(document.getElementById("name_of_user"), function(value) {
  return /^[a-z \s]*$/i.test(value); });
  setInputFilter(document.getElementById("nickname"), function(value) {
  return /^[a-z \s]*$/i.test(value); });
</script>
@endsection