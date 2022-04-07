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
        <h4 class="card-title pdf_btn_al">
          <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif ><i data-feather='arrow-left'></i></a> 
            Internal/Network Transaction History 
            <a target="_blank" href="{{ url('printinternaltransition') }}" class="btn btn-success">Export to PDF</a>
            <a href="{{ url('export_internaltransition') }}" class="btn btn-success ml-2">Export to Excel</a>
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Sl. No</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>User Name</th>
                          <th>Company Name</th>
                          <th>Company Number</th>
                          <th>Txn. Amount</th>
                          <th>Action</th>
                          <th>Remarks</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($q as $index => $list)
                        <tr>
                          <td>{{$index + $q->firstItem()}}</td>
                            <td>{{ $list->date }}</td>
                            <td>{{ $list->time }}</td>
                            @if ($list->type == 1)
                            <td>{{ get_user_name($list->received_userid) }}</td>
                            <td>{{ get_company_name($list->received_userid) }}</td>
                            <td>{{ get_user_number($list->received_userid) }}</td>
                            @endif
                            @if ($list->type == 2)
                            <td>{{ get_user_name($list->sender_id) }}</td>
                            <td>{{ get_company_name($list->sender_id) }}</td>
                            <td>{{ get_user_number($list->sender_id) }}</td>
                            @endif
                            <td>{{ number_format($list->amount,0) }}</td>
                            <td>
                            @if ($list->type == 1)
                            Debit
                            @endif
                            @if ($list->type == 2)
                            Credit
                            @endif
                            </td>
                            <td>
                                {{ $list->remark }}
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
</div>
@endsection