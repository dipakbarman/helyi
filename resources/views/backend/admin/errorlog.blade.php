@extends('backend.master')
@section('body')
@php
    $allplanq = DB::table('plans')->where('is_deleted',0)->get();
@endphp

<div class="row">
    <div class="content-body"><!-- users list start -->
        <!-- Row grouping -->
        <section id="">
          <div class="row">
            <div class="col-12">
              <div class="card p-2">
                <div class="card-header border-bottom">
                  <h4 class="card-title">Error log </h4>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Sl. No</th>
                        <th>User Name</th>
                        <th>Phone</th>
                        <th>Reasone</th>
                        <th>Txn Id</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Clean</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($qlist as $index => $list)
                    <tr>
                        <td>{{$index + $qlist->firstItem()}}</td>
                        <td> <a class="shop_id_css" href="{{ url('viewshop') }}/{{$list->shop_id}}">{{ $list->name }}</a></td>
                        <td>{{ $list->mobile }}</td>
                        <td>{{ $list->text }}</td>
                        <td>{{ $list->txnid }}</td>
                        <td>{{ $list->amount }}</td>
                        <td>{{ $list->errordate }}</td>
                        <td>{{ $list->time }}</td>
                        <td>
                          <a onclick="return confirm('Are you sure?');" class="btn btn-success btn-sm" href="{{ url('cleneerror/'.$list->errorid) }}">Clean</a>
                        </td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  {{ $qlist->withQueryString()->links() }}
                </div>
              </div>
            </div>
          </div>
        </section>
<!--/ Row grouping -->
        
                </div>    
</div>
@endsection