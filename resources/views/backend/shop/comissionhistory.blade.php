@extends('backend.master')
@section('body')
<div class="row mb-2">
    <div class="col-md-12">
        @include('backend.shop.tpage_menu')
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title mb-2 pdf_btn_al">
              <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif ><i data-feather='arrow-left'></i></a>comission history <a target="_blank" href="{{ url('printcomissionhistory') }}" class="btn btn-success ml-1">Export to PDF</a>
                <a href="{{ url('export_comissionhistory') }}" class="btn btn-success ml-2">Export to Excel</a>
            </h4>
            <div class="row">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Sl. No.</th>
                      <th>Date</th>
                      <th>By User</th>
                      <th>User Number</th>
                      <th>Commission</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($listq as $index => $list)
                    @php
                        $addmoneyq = DB::table('add_money_log')->where('id',$list->add_money_id)->first();
                    @endphp
                    <tr>
                      <td>{{$index + $listq->firstItem()}}</td>
                        <td>{{ $addmoneyq->time }}-{{ $addmoneyq->view_date }}</td>
                        <td>{{ $list->user_name }}</td>
                        <td>{{ $list->user_phone }}</td>
                        @if (session()->get('type') == 3)
                        <td>{{ number_format($list->distributor,0) }}</td>
                        @endif
                        @if (session()->get('type') == 4)
                        <td>{{ number_format($list->master_distributor,0) }}</td>
                        @endif
                        <td>{{ $addmoneyq->action }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection