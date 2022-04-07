@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">Mapping Request</h4>        
        <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                <th>SL. no</th>
                  <th>Name</th> 
                  <th>Phone Number</th>
                  <th>Reasone</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($q as $index => $list)
                <tr>
                  <td>{{$index + $q->firstItem()}}</td>
                  <td>{{get_user_name($list->uid)}}</td>
                  <td>{{ get_user_number($list->uid) }}</td>
                  <td>{{ $list->reason }}</td>
                  <td>
                      @if ($list->ustatus == 1)
                      Accepted
                      @elseif($list->ustatus == 2)
                      Rejected
                      @else
                      Pending
                      @endif
                  </td>
                  <td>
                    @if ($list->ustatus == 0)
                    <a class="btn btn-success mx-1" onclick="return confirm('Are you sure?');" href="{{ url('mapping_accept/'.$list->id) }}">Accept</a>
                    <a class="btn btn-danger mx-1" onclick="return confirm('Are you sure?');" href="{{ url('mapping_reject/'.$list->id) }}">Reject</a>
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
@endsection