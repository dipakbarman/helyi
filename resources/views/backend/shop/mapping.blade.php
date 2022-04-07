@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="cart-title">
                Mapping Request
            </h4>
            <form action="{{ url('mapping_form') }}" method="post" >
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="">Enter Phone Number</label>
                            <input type="number" id="mapping_mobile_no" name="phone_number" class="form-control" required >
                            <label class="text-danger" id="phone_number_error" style="display: none;" for="">Phone number should be 10 digit</label>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Reason</label>
                            <input type="text" name="reason" class="form-control" required >
                        </div>
                        <div class="form-group">
                            <button type="submit"  class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                Request History
            </h4>
            <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                    <th>SL. no</th>
                      <th>Name</th> 
                      <th>Phone Number</th>
                      <th>Reasone</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($q as $index => $list)
                    <tr>
                      <td>{{$index + $q->firstItem()}}</td>
                      <td>{{get_user_name($list->refferid)}}</td>
                      <td>{{ get_user_number($list->refferid) }}</td>
                      <td>{{ $list->reason }}</td>
                      <td>
                        @if ($list->ustatus == 1 && $list->admin_status == 1)
                        Accepted
                        @elseif($list->ustatus == 2 && $list->admin_status == 2)
                        Rejected
                        @else
                        Pending
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