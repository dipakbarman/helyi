@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
              <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @else href="{{ url('linkgen') }}" @endif ><i data-feather='arrow-left'></i></a> 
              Epos Payment Link
            </h4>
            @if (check_epos_active() == 1)
            <div class="row">
              <div class="col-md-12">
                  <form action="{{ url('peyment_link_generate') }}" method="post" onsubmit="valid_form()">
                      @csrf
                      <div class="row" id="firstpart">
                           <div class="col-md-4 mb-1">
                            <label class="form-label" for="">Payment method</label>
                            <select name="optionname" id="state" class="form-control form-select" required>
                              <option value="">Select Payment method</option>
                              <?php
                                  echo payment_link_option();
                              ?>
                            </select>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label" for="">Top-Up Options</label>
                            <select name="topupoption" id="" class="form-control form-select" required>
                              <option value="">Select Top-up Options</option>
                              @php
                                  $option_q = DB::table('topup_options')->where('type',0)->get();
                              @endphp
                              @foreach ($option_q as $list)
                                <option value="{{$list->type}}">{{ $list->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label" for="">Link Expiry</label>
                            <input name="exdate"  id="exp_date" type="text"  class="form-control" required>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label" for="username">User Name</label>
                            <input type="text" name="firstname" id="uname"  class="form-control" placeholder="Name" required/>
                          </div>                     
                          <input type="hidden" name="uid" value="{{ session()->get('userid') }}">      
                          <div class="col-md-4 mb-1">
                            <label class="form-label" for="ph">Phone</label>
                            <input type="number" name="phone" id="ph" class="form-control" placeholder="Phone Number" required />
                            <label class="text-danger error_l" id="shop_mobile_number_error" style="display: none;" for="">Phone number should be 10 digit</label>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label" for="amt">Amount</label>
                            <input type="number" name="amount" id="amt" onkeyup="check_valid_pertial(this.value)" class="form-control" placeholder="amount"  required/>
                          </div>                                                                              
                          <div class="col-md-4 mb-1">
                            <label class="form-label" for="">Email Id</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required />
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label" for="nt">Note</label>
                            <input type="text" name="note" id="nt" class="form-control" placeholder="Note"  required/>
                          </div>
                          <div class="col-md-12 mb-1" id="ispertial" style="display: none;">
                            <div class="form-group form-check mb-2">
                              <input type="checkbox" class="form-check-input" name="is_partial_payment" id="exampleCheck1">
                              <label class="form-label" for="exampleCheck1">Partial payment</label>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label" for="amt">Minimum Amount</label>
                            <input type="number" name="minimum_amount" id="amt"  class="form-control" placeholder="amount"/>
                          </div>
                          </div>
                          <div class="mb-2">
                          <button type="submit" id="submit_btn" class="btn btn-success waves-effect waves-float waves-light">Generate Now</button>
                          <button style="display: none;" id="wait_btn" type="button" class="btn btn-success waves-effect waves-float waves-light">Please Wait</button>
                              </div>                                                                                                                                                                                                    
                  </form>                  
              </div>
          </div>
            @endif
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>SL.No.</th>
                        <th>Payment Link To</th>
                        <th>Note</th>
                        <th>Amount</th>      
                        <th>Phone Number</th>                    
                        <th>Link</th>                                                   
                        <th>Order Id</th>                    
                        <th>Date</th>                                              
                      </tr>
                    </thead>
                    <tbody>                        
                      @foreach ($peyment_request_link as $index => $list)
                      <tr>
                        <td>{{$index + $peyment_request_link->firstItem()}}</td>
                          <td>{{ $list->name }}</td>
                          <td>{{ $list->note }}</td>                            
                          <td>{{ $list->total }}</td>                                                                                                     
                          <td>{{ $list->phone }}</td>
                          <td>{{ $list->link }}</td>
                          @if ($list->gateway == 1)
                          <td>{{ $list->rez_order_id }}</td>
                          @else
                          <td>{{ $list->order_id_rand }}</td>
                          @endif
                          <td>{{ datedbu($list->datemin) }}</td>
                      </tr>
                      @endforeach                         
                    </tbody>
                  </table>
                  <div class="py-2">
                    {{$peyment_request_link->withQueryString()->links()}}
                  </div>
                </div>
              </div>
            </div>
        </div>       
    </div>
</div>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
@endsection
<script>
    function valid_form(){
        $("#submit_btn").hide();
        $("#wait_btn").show();
    }
    function check_valid_pertial(value){
        if(value >= 500){
          $("#ispertial").show();
        }else{
          $("#ispertial").hide();
        }
    }
</script>