<script>
        function admin_count_notification(){
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
                });
                $.ajax({
                    type:"POST",
                    url:"{{ url('count_admin_notification') }}",
                    data: ({categoryid:1}),
                    success: function(response){
                        $("#check_notification_count").html(response);
                    }
                });
            }	
        setInterval(admin_count_notification, 1000);
        function change_isview_admin_notification(){
				$.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
				});
				$.ajax({
					type:"POST",
					url:"{{ url('change_admin_notification') }}",
					data: ({categoryid:1}),
					success: function(response){
						$("#check_notification_count").html(response);
					}
				});
			}
            function admin_filter_type(type){
                if(type == 5){
                    $(".admin_date_filed").attr("required", true);
                }else{
                    $(".admin_date_filed").removeAttr("required");
                }
            }
</script>