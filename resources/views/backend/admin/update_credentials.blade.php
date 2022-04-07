@extends('backend.master')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title">
                Update Login details
            </h4>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <form action="{{ url('update_credentials_post') }}" method="post" onsubmit="validbtn()">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="">Email Id</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label for="">New Password</label>
                                <input type="text" name="pass" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Old Password</label>
                                <input type="password" name="oldpass" required class="form-control">
                            </div>
                            <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                            <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection