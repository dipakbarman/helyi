@extends('backend.master')
@section('body')
@php
    $editid = "";
    $bank_names = "";
    $ifsc_code = "";
    if(isset($editq)){
        $editid = $editq->id;
        $bank_names = $editq->bank_names;
        $ifsc_code = $editq->ifsc_code;
    }
@endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card p-2">
                <h4 class="card-title">
                    Banks 
                </h4>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <form action="{{url('bankdetailsupdate_form')}}" method="post" onsubmit="validbtn()">
                            @csrf
                            <input type="hidden" name="editid" value="{{$editid}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label class="mb-1" for="">Enter bank name</label>
                                        <input type="text" required class="form-control" placeholder="" name="bank_names" value="{{$bank_names}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label class="mb-1" for="">IFSC code</label>
                                        <input type="text" required class="form-control" placeholder="" name="ifsc_code" value="{{$ifsc_code}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                                        <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                                </div>
                            </div>
                        </form>
                    </div>
                                </div>
            </div>
           
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 card p-2">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                      <tr>
                        <th>Sl. No</th>
                        <th>Name</th>
                        <th>IFSC</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($qlist as $list)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$list->bank_names}}</td>
                            <td>{{$list->ifsc_code}}</td>
                            <td>
                                <a href="{{ url('bankdetailsdelete/'.$list->id) }}" class="btn btn-danger m-1" >Delete</a>
                                <a href="{{ url('bankdetailsupdate/'.$list->id) }}" class="btn btn-success m-1" >Edit</a>
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="peginate">
                {{$qlist->withQueryString()->links()}}
            </div>
        </div>
    </div>
@endsection