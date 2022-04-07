@extends('backend.master')
@section('body')
<div class="row">
    {{-- <div class="col-md-12">
        <div class="card p-2">
            <h4 class="cart-title">
                Lein Wallet
            </h4>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="alert alert-success mt-1 alert-validation-msg" role="alert">
                                <div class="alert-body d-flex align-items-center">
                                  <span>Lein Wallet balance - <span><i class="fas fa-rupee-sign"></i> {{get_lein_wallet_bal()}}</span></span>
                                </div>
                              </div>
                        </div>
                        <div class="col-md-8">
                            <form action="{{ url('leinwallet_to_main_form') }}" method="post" onsubmit="validbtn()">
                                @csrf
                                <div class="mb-1">
                                    <label for="">Enter amount</label>
                                <input type="number" class="form-control" required name="lein_amount" id="">
                                </div>
                                <div class="mb-2">
                                    <button type="submit" id="submit_btn" class="btn btn-success">Send to Wallet</button>
                            <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif><i data-feather='arrow-left'></i></a> 
                Lein Translation
            </h4>
            <div class="row">
                <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Sl. No</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Amount</th>
                          <th>Remark</th>
                          <th>Balance</th>
                          <th>Type</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        @foreach ($q as $index => $list)
                            <td>{{$index + $q->firstItem()}}</td>
                            <td>{{ $list->date }}</td>
                            <td>{{ $list->time }}</td>
                            <td>{{ $list->ammount }}</td>
                            <td>{{ $list->remark }}</td>
                            <td>
                              {{ $list->bal }}
                            </td>
                            <td>
                              @if ($list->type == 1)
                              Debit
                              @else
                              Credit
                              @endif
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
</div>
@endsection