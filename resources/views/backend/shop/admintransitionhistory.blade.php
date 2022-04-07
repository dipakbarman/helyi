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
          <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif><i data-feather='arrow-left'></i></a> 
          
            Admin Transaction History 
            <a href="{{ url('export_admintransitionhistory') }}" class="btn btn-success ml-2">Export to Excel</a>
            <a target="_blank" href="{{ url('printadmintransitionhistory') }}" class="btn btn-success">Export to PDF</a>
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>SL. No.</th>
                          <th>Date</th>
                          <th>Company Name</th>
                          <th>Company Number</th>
                          <th>Amount</th>
                          <th>Remark</th>
                          <th>Type</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($q as $index => $list)
                        <tr>
                          <td>{{$index + $q->firstItem()}}</td>
                            <td>{{ $list->date }}</td>
                            <td>{{ get_company_name($list->uid) }}</td>
                            <td>{{ get_user_number($list->uid) }}</td>
                            <td>{{ $list->amount }}</td>
                            <td>{{ $list->remark }}</td>
                            <td>
                                @if ($list->type == 1)
                                <span class='badge badge-glow bg-success'>Added</span>    
                                @endif
                                @if ($list->type == 2)
                                <span class='badge badge-glow bg-danger'>Deduct</span>    
                                @endif
                            </td>
                            <td><span class='badge badge-glow bg-success'>Successful</span></td>  
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