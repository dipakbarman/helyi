$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
    });
$.ajax({
        type:"POST",
        url:"{{ url('find_account_by_number') }}",
        data: ({
        phone_number:phone_number,
        }),
        success: function(response){
            
        }
});
