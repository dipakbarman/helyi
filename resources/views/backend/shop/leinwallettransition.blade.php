@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title mb-2">
              <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif ><i data-feather='arrow-left'></i></a> 
                Lein wallet to wallet transfer
            </h4>
            <div class="row">
              {{-- <div class="col-md-12">
              <div class="row justify-content-center mb-2">
                <div class="col-md-12 pt-4">
                  <form action="{{ url('leinwallettransition_date_filter') }}" method="post">
                      <div class="row">
                        <div class="col-md-2"></div>
                          <div class="col-md-3 col-12">
                             <input type="date" class="form-control" name="from_date" required>  
                          </div>
                          <div class="col-md-3 col-12">
                              <input type="date" class="form-control" name="to_date" required>  
                          </div>
                          <div class="col-md-2 col-4">
                              <button type="submit" class="btn btn-primary btn-block">Filter</button>
                          </div>
                      </div>
                  </form>
              </div>
              </div>
            </div> --}}
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th>Amount</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                            @foreach ($q as $list)
                                <td>{{ $list->date }}</td>
                                <td>{{ $list->ammount }}</td>
                                <td>
                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            @endforeach
                              </tr>
                          </tbody>
                        </table>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection