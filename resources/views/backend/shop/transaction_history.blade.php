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
              <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif><i data-feather='arrow-left'></i></a> 
                Lein wallet transaction 
                <a target="_blank" href="{{ url('print_transaction_history') }}" class="btn btn-success">Export to PDF</a>
                <a href="{{ url('export_transaction_history') }}" class="btn btn-success ml-2">Export to Excel</a>
            </h4>
            <div class="row">
                <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>SL. no.</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>By User</th>
                          <th>Amount</th>
                          <th>Remark</th>
                          <th>Balance</th>
                          <th>Type</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($q as $index => $list)
                        <tr>
                            <td>{{$index + $q->firstItem()}}</td>
                            <td>{{ $list->date }}</td>
                            <td>{{ $list->time }}</td>
                            <td> @if(!empty($list->commission_by_id)) {{get_user_name($list->commission_by_id)}} @endif</td>
                            <td>{{ number_format($list->ammount,0) }}</td>
                            <td>{{ $list->remark }}</td>
                            <td>
                              {{ $list->bal }}
                            </td>
                            <td>
                              @if ($list->type == 1)
                              <span class='badge badge-glow bg-danger'>Debit</span>
                              @else
                              <span class='badge badge-glow bg-success'>Credit</span>
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