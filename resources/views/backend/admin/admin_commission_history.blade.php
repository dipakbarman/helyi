@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                
                Commission List
            </h4>
            <div class="row">
                <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>By User</th>
                          <th>User Number</th>
                          <th>Total Commission</th>
                          <th>Commission</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($q as $list)
                        @php
                            $addmoneyq = DB::table('add_money_log')->where('id',$list->add_money_id)->first();
                        @endphp
                        <tr>
                            <td>{{ $addmoneyq->time }}-{{ $addmoneyq->view_date }}</td>
                            <td>{{ get_user_name($addmoneyq->userid) }}</td>
                            <td>{{get_user_number($addmoneyq->userid)}}</td>
                            <td>{{ $list->admin_total }}</td>
                            <td>{{ $list->admin }}</td>
                            <td>{{ $addmoneyq->action }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="mt-2">
                      {{$q->withQueryString()->links()}}
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection