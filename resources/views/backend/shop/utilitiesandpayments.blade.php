@extends('backend.master')
@section('body')


<div class="row">
    <div class="content-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card py-2 px-2">
                    <div class="row match-height btn-header">
                        <div class="col-md-2">
                            <a href="{{url('addmoney')}}" class="btn btn-success waves-effect waves-float waves-light">Add Wallet</a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ url('add_account') }}" class="btn btn-success waves-effect waves-float waves-light">Settlement</a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ url('internal_transfer') }}" class="btn btn-success waves-effect waves-float waves-light">Internal transfer</a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ url('linkgen') }}" type="button" class="btn btn-success waves-effect waves-float waves-light">EPOS</a>
                        </div>
                        <div class="col-md-2">
                          <button type="button" class="btn btn-success waves-effect waves-float waves-light">Recharge</button>
                      </div>
                      <div class="col-md-2">
                        <button type="button" class="btn btn-success waves-effect waves-float waves-light">Credit request</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-xl-12 col-md-12 col-12 mb-2" id="mtext">
            <marquee>{{ get_marque_text() }}</marquee>
          </div>
        </div>
    </div>    
</div>  
<div class="row">
    <div class="content-body"><!-- users list start -->
        <!-- Row grouping -->
        <section id="multilingual-datatable">
          <div class="row match-height">
            <div class="col-8">
              <div class="card p-2">
                <div class="card-header border-bottom">
                  <h4 class="card-title">
                    <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @else href="#" @endif><i data-feather='arrow-left'></i></a> 
                    Latest Transaction</h4>
                </div>
                <div class="">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Sl. No</th>
                          <th>Date/Time</th>
                          <th>User Name</th>
                          <th>Amount</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($q as $index => $list)
                        <tr>
                          <td>{{$index + $q->firstItem()}}</td>
                            <td>{{ $list->time }}-{{ $list->date }}</td>
                            <td>{{ $list->user_name }}</td>
                            <td>{{ number_format($list->amt) }}</td>
                            <td>
                                {{ $list->r }}
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="py-2">
                      {{$q->withQueryString()->links()}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
                <div class="card p-1">
                  <button type="button" class="btn btn-success btn-block ">Favorite banks</button>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table>
                          <tbody>
                            <form action="{{ url('money_transfer_form') }}" method="get" id="money_transfer_form">
                              @csrf
                            @foreach ($fav_bankq as $list)
                            <tr style="">
                              <td class="fav_box">
                                <div class="row">
                                  <div class="col-1">
                                    <input required class="form-check-input" onchange="submit_home_payye()" type="radio" name="bankaccountid" id="inlineRadiofav{{$list->id}}" value="{{$list->id}}" />
                                  </div>
                                  <div class="col-10">
                                    <label class="form-check-label" for="inlineRadiofav{{$list->id}}"> @if(!empty($list->varify_user_name)) {{$list->varify_user_name}} @else {{$list->name}} @endif
                                      <br>
                                      Account Number : {{$list->account_number}} <br>
                                      IFSC : {{$list->ifsc}} <br>
                                      {{get_bank_name($list->bank_name)}}
                                      </label> 
                                  </div>
                                </div>
                              </td>
                            </tr>
                            @endforeach
                          </form>
                          </tbody>
                        </table>
                        <div class="py-1">
                          {{$fav_bankq->withQueryString()->links()}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </section>
        
                </div>    
</div>

@endsection