@extends('admin.master')
@section('body')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Board Form</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <form action="{{ url('board_setting_form') }}" method="post" enctype="multipart/form-data" onsubmit="validbtn()">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="">Name</label>
                                    <input class="form-control" type="text" name="name" id="" required>
                                </div>
                                <div class="form-group mt-2">
                                    <button id="submit_btn" class="btn btn-success w-100 waves-effect waves-light" type="submit">Submit</button>
                                    <button id="wait_btn" class="btn btn-primary w-100 waves-effect waves-light" type="submit"><i class="fa fa-spinner fa-spin"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Board List</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead class="bg-success">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach ($board as $list)
                                                @php($i++)
                                                <tr>
                                                    <th scope="row">{{ $i }}</th>
                                                    <td>{{ $list->name }}</td>
                                                    <td>
                                                        {{-- <a class="btn btn-sm m-2 btn-success mb-2 mr-3" href="{{url('categoryupdate/'.$list->id)}}"><i class="fas fa-pen-square"></i></a> --}}
                                                        <a class="btn btn-sm btn-danger m-2" onclick="return confirm('Are you sure?')" href="{{ url('boarddelete/'.$list->id) }}" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>		      
@endsection