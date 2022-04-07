@extends('backend.master')
@section('body')
<style>
    table tr td, table tr th{
    background-color: transparent !important;
    border-bottom: 0;
}
.table tfoot th, .table thead th {
    font-size: 13px;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card p-2">
            <h4 class="card-title mb-2 text-center">
              {{-- <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif ><i data-feather='arrow-left'></i></a>  --}}
                EPOS DATA
            </h4>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table">
                      <thead>
                      <tr>
                          <th>Order id</th>
                          <th> {{ $all_data->order_id_rand }} </th>    
                        </tr>
                        <tr>
                          <th>Date</th>
                          <th> {{ datedbu($all_data->datemin) }} </th>    
                        </tr>
                        <tr>
                        <tr>
                          <th>Name</th>
                          <th> {{ $all_data->name }} </th>    
                        </tr>
                        <tr>
                          <th>Phone</th>
                          <th> {{ $all_data->phone }} </th>    
                        </tr>
                        <tr>
                          <th>Email</th>
                          <th> {{ $all_data->email }} </th>    
                        </tr>
                        <tr>
                          <th>Amount</th>                          
                          <th> {{ $all_data->amount }} </th>    
                        </tr>
                        <tr>
                          <th>Payment Option Name</th>
                          <th> {{ payment_link_option_name($all_data->pey_option) }} </th>    
                        </tr>
                        <tr>
                          <th>Note</th>
                          <th> {{ $all_data->note }} </th>    
                        </tr>
                        <tr>
                          <th>Link</th>
                          <th> {{ $all_data->link }} <br>  <button style="margin-top:10px" onclick="copy_url()" class="btn btn-success waves-effect waves-float waves-light">Copy Link</button> <input style="visibility:hidden" type="text" id="url_id" value="{{ $all_data->link }}"></th>    
                        </tr>
                      </thead>
                     
                    </table>
                  </div>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function copy_url() {
  /* Get the text field */
  var copyText = document.getElementById("url_id");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

   /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}

</script>