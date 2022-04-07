<script>
    $(".paymentoption").click(function(){
        $('input[name="topupmen"]:checked').prop('checked', false);
        $("#fee_view_sec").hide();
        var paymentoption = $('input[name="paymentoption"]:checked').val();
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
		$.ajax({
                type:"POST",
                url:"{{ url('check_paymentgetway_by_option') }}",
                data: ({
                paymentoption:paymentoption,
                }),
                success: function(response){
                $("#payment_gateway_type").val(response);
                if(response == 1){
                    $("#rezpay_js_btn").show();
                    $("#cashfree_sub_btn").hide();
                }
                if(response == 2 || response == 3){
                    $("#rezpay_js_btn").hide();
                    $("#cashfree_sub_btn").show();
                }
                if(response == 0){
                    $("#rezpay_js_btn").hide();
                    $("#cashfree_sub_btn").hide();
                }
                }
        });
    });
    $(".topupoption_selecteor").click(function(){
        var amount = $("#money_value").val();
        var payment_option = $('input[name="paymentoption"]:checked').val();
        if(payment_option == undefined){
            Swal.fire({
            icon: 'error',
            title: "Please Select Payment Method",
            confirmButtonText: 'Confirm'
            })
        }
        if(amount > 0){
        var topupoption = $('input[name="topupmen"]:checked').val();
        if(topupoption != undefined){
            $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
		$.ajax({
                type:"POST",
                url:"{{ url('check_addmoney_conversion_fees') }}",
                data: ({
                    topupoption:topupoption,payment_option:payment_option,
                }),
                success: function(response){
                    if(response == 0){
                        $("#fee_view_sec").hide();
                    }else{
                        var plan_type_get = Number({{get_user_curent_plan_type(session()->get('userid'))}});
                        if(plan_type_get == 1){
                            var percent = (response/100)*amount;
                            $("#per_s").show();
                            $("#rup_s").hide();
                        }
                        if(plan_type_get == 2){
                            var percent = response;
                            $("#rup_s").show();
                            $("#per_s").hide();
                        }
                        var total = amount-percent;
                        $("#fee_view_sec").show();
                        $("#top_up_balence").html(amount);
                        $("#conversion_fees").html(percent.toFixed(2));
                        $("#how_percentahe").html(response);
                        $('#total_top_up_balence').html(Math.trunc(total));
                        $('.btn_pe_ammount').html(amount);
                    }
                }
        });
        }
    }else{
        // toastr.error("invalid amount!");
        Swal.fire({
      icon: 'error',
      title: "Please enter amount!",
      confirmButtonText: 'Confirm'
    })
        return false;
    }
    });
</script>