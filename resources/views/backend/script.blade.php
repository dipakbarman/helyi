<script>
	function transfer_pin_m_open(){
        var tamount = $("#tamount").val();
		var sender_name = $("#sender_name").val();
		if(sender_name == ""){
			Swal.fire({
            icon: 'error',
            title: "All field are required",
            confirmButtonText: 'Confirm'
            })
            return false;
		}
        if(tamount < 1 || tamount == ""){
            Swal.fire({
            icon: 'error',
            title: "Insufficient balance",
            confirmButtonText: 'Confirm'
            })
            return false;
        }else{
		if(tamount > 200000){
			Swal.fire({
            icon: 'error',
            title: "Max 2 lakh per transaction",
            confirmButtonText: 'Confirm'
            })
            return false;
		}
        $.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
	       	$.ajax({
	            type:"POST",
	            url:"{{ url('check_bank_transfer_amount') }}",
	            data: ({tamount:tamount}),
	            success: function(response){
	                if(response == 1){
						Swal.fire({
                        icon: 'error',
                        title: "Insufficient balance",
                        confirmButtonText: 'Confirm'
                        })
                        return false;
                    }else{
						$("#fee").val(response);
						$('#send_money_model').modal('show');
                    }
	            }
	        });        
        }
    }
	function bank_transfer_tpin_verify(){
        var tpin = $("#send_transactionpin").val();
        if(tpin == "" || tpin.length != 6){
            Swal.fire({
            icon: 'error',
            title: "Invalid Pin",
            confirmButtonText: 'Confirm'
            })
            return false;
        }
        $.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
	       	$.ajax({
	            type:"POST",
	            url:"{{ url('tpin_verify_form') }}",
	            data: ({tpin:tpin}),
	            success: function(response){
	                if(response == 1){
                        $("#payee_form_id").submit();
                    }
					if(response == 0){
                        Swal.fire({
                        icon: 'error',
                        title: "Invalid Pin",
                        confirmButtonText: 'Confirm'
                        })
                        return false;
                    }
					if(response == 2){
                        Swal.fire({
                        icon: 'error',
                        title: "Server Error",
                        confirmButtonText: 'Confirm'
                        })
                        return false;
                    }
	            }
	        });  
    }
	@if (session()->get('type') != 0)
			function count_n(){
				$.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
				});
				$.ajax({
					type:"POST",
					url:"{{ url('count_notification') }}",
					data: ({categoryid:1}),
					success: function(response){
						if(response == "error"){
							window.location.replace("{{ url('login') }}");
						}else{
							$("#check_notification_count").html(response);
						}
					}
				});
			}
			setInterval(count_n, 1000);
	@endif
			function count_zero(){
				$.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
				});
				$.ajax({
					type:"POST",
					url:"{{ url('notification_is_view') }}",
					data: ({categoryid:1}),
					success: function(response){
						$("#n_count").html(response);
					}
				});
			}
	@if (Session::has('offer')) 
		$(window).on('load', function() {
			$("#popup_model").modal('show');
		});
	@endif
	function ajax_info_filter(value,uid,boxid){
		if(value == 5){
			$("#yes_not_viewuser").show();
			$("#not_viewuser").hide();
			$(".is_view_user_div").show();
			$(".not_view_user_div").hide();
			$("#customdateinfobox_value").val(value);
			$("#filter_uid").val(uid);
			$("#customdateinfobox_boxid").val(boxid);
			$("#customdateinfobox").modal('show');
		}else{
			if(value != "" && boxid != ""){
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
					}
				});
				$.ajax({
					type:"POST",
					url:"{{ url('ajax_info_filter') }}",
					data: ({value:value,boxid:boxid,uid:uid}),
					success: function(response){
						$("#amount"+boxid).html(response);
					}
				});
				if(boxid == 2 && value != 5){
					ajax_info_filter(value,uid,22);
				}else{
					$("#info_filter"+boxid).val("");
				}
			}
		}
	}
	function ajax_info_filter_admin(value,boxid){
		if(value == 5){
			$("#customdateinfobox_value").val(value);
			$("#customdateinfobox_boxid").val(boxid);
			$("#customdateinfobox").modal('show');
		}else{
			if(value != "" && boxid != ""){
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
					}
				});
				$.ajax({
					type:"POST",
					url:"{{ url('ajax_info_filter_admin') }}",
					data: ({value:value,boxid:boxid}),
					success: function(response){
						$("#amount"+boxid).html(response);
					}
				});
			}
		}
		if(boxid == 8 && value != 5){
			ajax_info_filter_admin(value,9);
		}else if(boxid == 10 && value != 5){
			ajax_info_filter_admin(value,11);
		}else{
			$("#info_filter"+boxid).val("");
		}
	}
	function admin_utilities_date_filter(){
	var customdateinfobox_value = $("#customdateinfobox_value").val();
	var customdateinfobox_boxid = $("#customdateinfobox_boxid").val();
	var home_filter_from_date = $("#admin_filter_from_date").val();
	var home_filter_to_date = $("#admin_filter_to_date").val();
	if(home_filter_from_date != "" && home_filter_to_date != ""){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
		$.ajax({
			type:"POST",
			url:"{{ url('ajax_info_filter_admin') }}",
			data: ({value:customdateinfobox_value,boxid:customdateinfobox_boxid,fdate:home_filter_from_date,tdate:home_filter_to_date}),
			success: function(response){
				$("#customdateinfobox").modal('hide');
				$("#amount"+customdateinfobox_boxid).html(response);
				if(customdateinfobox_boxid == 8){
					$("#customdateinfobox_boxid").val(9);
					admin_utilities_date_filter();
				}else if(customdateinfobox_boxid == 10){
					$("#customdateinfobox_boxid").val(11);
					admin_utilities_date_filter();
				}
				else{
					$("#admin_filter_from_date").val(" ");
					$("#admin_filter_to_date").val(" ");
				}
			}
		});
		
	}else{
		Swal.fire({
		icon: 'error',
		title: "All date field are required !",
		confirmButtonText: 'Confirm'
		})
		return false;
	}
	}
	function home_date_filter(){
	var uid = $("#filter_uid").val();
	var customdateinfobox_value = $("#customdateinfobox_value").val();
	var customdateinfobox_boxid = $("#customdateinfobox_boxid").val();
	var home_filter_from_date = $("#home_filter_from_date").val();
	var home_filter_to_date = $("#home_filter_to_date").val();
	if(home_filter_from_date != "" && home_filter_to_date != ""){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
		$.ajax({
			type:"POST",
			url:"{{ url('ajax_info_filter_cdate') }}",
			data: ({uid:uid,value:customdateinfobox_value,boxid:customdateinfobox_boxid,fdate:home_filter_from_date,tdate:home_filter_to_date}),
			success: function(response){
				$("#customdateinfobox").modal('hide');
				$("#amount"+customdateinfobox_boxid).html(response);
				if(customdateinfobox_boxid == 2){
					$("#customdateinfobox_boxid").val(22);
					home_date_filter();
				}else{
					$("#home_filter_from_date").val(" ");
					$("#home_filter_to_date").val(" ");
				}
			}
		});
	}else{
		Swal.fire({
		icon: 'error',
		title: "All date field are required !",
		confirmButtonText: 'Confirm'
		})
		return false;
	}
	}
function multy_lein_tranfer_form_btn_submit(){
	var admin_lein_t_remark = $("#admin_lein_t_remark").val();
	var admin_lein_t_amount = $("#admin_lein_t_amount").val();
	if(admin_lein_t_amount > 0){
	if(admin_lein_t_remark != ""){
		$("#lein_t_remark_text").val(admin_lein_t_remark);
		$("#lein_t_remark_price").val(admin_lein_t_amount);
		$("#multy_admin_lein_transfer").submit();
	}else{
		Swal.fire({
		icon: 'error',
		title: "Please enter remark",
		confirmButtonText: 'Confirm'
		})
		return false;
	}
	}else{
		Swal.fire({
		icon: 'error',
		title: "Enter amount",
		confirmButtonText: 'Confirm'
		})
		return false;
	}
}
function multy_lein_tranfer_form_btn(){
	var ttype = $("#ttype").val();
	var atLeastOneIsChecked = $('input[name="users[]"]:checked').length > 0;
	if(ttype != ""){
		if(atLeastOneIsChecked == true){
			$('#admin_lein_wallet_t_model').modal('show');			
		}else{
			Swal.fire({
			icon: 'error',	
			title: "Please select user",
			confirmButtonText: 'Confirm'
			})
			return false;	
		}
	}else{
		Swal.fire({
		icon: 'error',
		title: "Please select transactions type",
		confirmButtonText: 'Confirm'
		})
		return false;
	}
	
}
function infofilter(){
	var val = $("#info_filter").val();
	if(val != undefined){
		if(val == 5){
			$(".datefilter").show();
		}else{
			$(".datefilter").hide();
		}
	}
}
	function  on_change_bank(){
		var get_bank_id =  $(".bank_names").val();
		$.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
	       	$.ajax({
	            type:"POST",
	            url:"{{ url('on_change_bank') }}",
	            data: ({get_bank_id:get_bank_id}),
	            success: function(response){
	                $("#cifsc").val(response);
	            }
	        });
	}
	$("#exp_date").flatpickr({
		dateFormat: "d-m-Y",
		allowInput:true,
		minDate: new Date().fp_incr(1),
    	maxDate: new Date().fp_incr(100), // 14 days from now
	});
	$("#from_date").flatpickr({
		dateFormat: "d-m-Y",
	});
	$("#home_filter_from_date").flatpickr({
		dateFormat: "d-m-Y",
		allowInput:true,
	});
	$("#home_filter_to_date").flatpickr({
		dateFormat: "d-m-Y",
		allowInput:true,
	});
	$("#admin_filter_from_date").flatpickr({
		dateFormat: "d-m-Y",
		allowInput:true,
	});
	$("#admin_filter_to_date").flatpickr({
		dateFormat: "d-m-Y",
		allowInput:true,
	});
	$("#to_date").flatpickr({
		dateFormat: "d-m-Y",
	});
	$("#mfrom_date").flatpickr({
		dateFormat: "d-m-Y",
	});
	$("#mto_date").flatpickr({
		dateFormat: "d-m-Y",
	});
@if(Request::url() == url('add_account') || Request::url() == url('find_bankacount_search'))
function add_a_btn(){
    var caccount_mobile_number = $("#caccount_mobile_number").val();
    var bank_nameis = $("#bank_nameis").val();
    var cifsc = $("#cifsc").val();
    var a_no = $("#a_no").val();
    var ca_no = $("#ca_no").val();
    var name_of_user = $("#name_of_user").val();
    var nickname = $("#nickname").val();
    if(bank_nameis != "" && cifsc != "" && a_no != "" && ca_no != "" && name_of_user != "" && nickname != ""){
        if(a_no == ca_no){
            $('#add_bankacount_model').modal('show');
        }else{
			Swal.fire({
            icon: 'error',
			title: "A/c and confirm A/c should be same",
			confirmButtonText: 'Confirm'
			})
			return false;
        }
    }else{
        Swal.fire({
			icon: 'error',
			title: "All fields are required",
			confirmButtonText: 'Confirm'
			})
            return false;
    }

    }
    function submit_add_account(){
        $("#add_account_form").submit();
    }
	@endif
	function set_filter_type(type){
		if(type == 11){
			$("#hpart").show();
			$("#gpart").hide();
			$("#fpart").hide();
			$("#epart").hide();
			$("#dpart").hide();
			$("#bpart").hide();
			$("#cpart").hide();
			$("#apart").hide();
		}
		if(type == 10){
			$("#hpart").hide();
			$("#gpart").show();
			$("#fpart").hide();
			$("#epart").hide();
			$("#dpart").hide();
			$("#bpart").hide();
			$("#cpart").hide();
			$("#apart").hide();
		}
		if(type == 9){
			$("#hpart").hide();
			$("#fpart").show();
			$("#gpart").hide();
			$("#epart").hide();
			$("#dpart").hide();
			$("#bpart").hide();
			$("#cpart").hide();
			$("#apart").hide();
		}
		if(type == 8){
			$("#hpart").hide();
			$("#epart").show();
			$("#fpart").hide();
			$("#gpart").hide();
			$("#dpart").hide();
			$("#bpart").hide();
			$("#cpart").hide();
			$("#apart").hide();
		}
		if(type == 7){
			$("#hpart").hide();
			$("#dpart").show();
			$("#fpart").hide();
			$("#gpart").hide();
			$("#bpart").hide();
			$("#epart").hide();
			$("#cpart").hide();
			$("#apart").hide();
		}
		if(type == 6){
			$("#hpart").hide();
			$("#dpart").hide();
			$("#fpart").hide();
			$("#gpart").hide();
			$("#bpart").show();
			$("#cpart").hide();
			$("#apart").hide();
			$("#epart").hide();
		}else{
		if(type == 4){
			$("#hpart").hide();
			$("#dpart").hide();
			$("#fpart").hide();
			$("#gpart").hide();
			$("#apart").show();
			$("#bpart").hide();
			$("#cpart").hide();
			$("#epart").hide();
			$(".date_range").show();
		}else{
			$(".date_range").hide();
		}
		if(type == 5){
			$("#hpart").hide();
			$("#dpart").hide();
			$("#apart").show();
			$("#fpart").hide();
			$("#bpart").hide();
			$("#cpart").hide();
			$("#epart").hide();
			$(".oder_id_fild").show();
		}else{
			$(".oder_id_fild").hide();
		}
		}
	}
	function open_plan_purchec_model(id){
	$("#upgrad_plan_id").val(id);
	$('#planpurchesmodel').modal('show');
}
	function check_plan(){
	// var	distibutor_cashback = $("#distibutor_cashback").val();
	// var	master_limit_per_day = $("#master_limit_per_day").val();
	var plan_type = $("#plan_type").val();
	var monthly_limit = $("#monthly_limit").val();
	var limit_per_day = $("#limit_per_day").val();
	var t0_hours = $("#t0_hours").val();
	var package_name = $("#package_name").val();
	var price = $("#price").val();
	var debit_card_instant = $("#debit_card_instant").val();
	var debit_card_t0 = $("#debit_card_t0").val();
	var debit_card_t1 = $("#debit_card_t1").val();
	var debit_card_t2 = $("#debit_card_t2").val();
	var netbanking_instant = $("#netbanking_instant").val();
	var netbanking_t0 = $("#netbanking_t0").val();
	var netbanking_t1 = $("#netbanking_t1").val();
	var netbanking_t2 = $("#netbanking_t2").val();
	var upi_instant = $("#upi_instant").val();
	var upi_t0 = $("#upi_t0").val();
	var upi_t1 = $("#upi_t1").val();
	var upi_t2 = $("#upi_t2").val();
	var credit_Card_instant = $("#credit_Card_instant").val();
	var credit_card_t0 = $("#credit_card_t0").val();
	var credit_card_t1 = $("#credit_card_t1").val();
	var credit_card_t2 = $("#credit_card_t2").val();
	var amex_card_instant = $("#amex_card_instant").val();
	var amex_card_t0 = $("#amex_card_t0").val();
	var amex_card_t1 = $("#amex_card_t1").val();
	var amex_card_t2 = $("#amex_card_t2").val();
	var diners_card_instant = $("#diners_card_instant").val();
	var diners_card_t0 = $("#diners_card_t0").val();
	var diners_card_t1 = $("#diners_card_t1").val();
	var diners_card_t2 = $("#diners_card_t2").val();
	var wallet_instant = $("#wallet_instant").val();
	var wallet_t0 = $("#wallet_t0").val();
	var wallet_t1 = $("#wallet_t1").val();
	var wallet_t2 = $("#wallet_t2").val();
	var corporate_card_instant = $("#corporate_card_instant").val();
	var corporate_card_t0 = $("#corporate_card_t0").val();
	var corporate_card_t1 = $("#corporate_card_t1").val();
	var corporate_card_t2 = $("#corporate_card_t2").val();
	var prepaid_card_instant = $("#prepaid_card_instant").val();
	var prepaid_card_t0 = $("#prepaid_card_t0").val();
	var prepaid_card_t1 = $("#prepaid_card_t1").val();
	var prepaid_card_t2 = $("#prepaid_card_t2").val();

	// var debit_base_per = $("#debit_base_per").val();
	// var netbanking_base_per = $("#netbanking_base_per").val();
	// var upi_base_per = $("#upi_base_per").val();
	// var credit_card_base_per = $("#credit_card_base_per").val();
	// var amex_card_base_per = $("#amex_card_base_per").val();
	// var diners_card_base_per = $("#diners_card_base_per").val();
	// var wallet_base_per = $("#wallet_base_per").val();
	// var corporate_card_base_per = $("#corporate_card_base_per").val();
	// var prepaid_card_base_per = $("#prepaid_card_base_per").val();
	var plan_duration = $("#plan_duration").val();
	var imgcheck = "";
	var oldplanlogo = $("#oldplanlogo").val();
	var planlogo = $("#planlogo").val();
	if(oldplanlogo != ""){
		imgcheck = 1;
	}
	if(planlogo != ""){
		imgcheck = 1;
	}
	if(imgcheck == ""){
		Swal.fire({
		icon: 'error',
		title: "Image field is required!",
		confirmButtonText: 'Confirm'
		})
		return false;
	}
	// if(price < 1){
	// 	Swal.fire({
	// 	icon: 'error',
	// 	title: "Invalid Amount",
	// 	confirmButtonText: 'Confirm'
	// 	})
	// 	return false;
	// }
	if(plan_duration != "" && plan_type != "" && package_name != "" && price != "" && monthly_limit != "" && limit_per_day != "" && t0_hours != ""){
	if(debit_card_instant != "" && debit_card_t0 != "" && debit_card_t1 != "" && debit_card_t2 != ""){
		if(netbanking_instant != "" && netbanking_t0 != "" && netbanking_t1 != "" && netbanking_t2 != "" ){
			if(upi_instant != "" || upi_t0 != "" || upi_t1 != "" || upi_t2 != "" ){
				if(credit_Card_instant != "" && credit_card_t0 != "" && credit_card_t1 != "" && credit_card_t2 != ""){
					if(amex_card_instant != "" && amex_card_t0 != "" && amex_card_t1 != "" && amex_card_t2 != ""){
						if(diners_card_instant != "" && diners_card_t0 != "" && diners_card_t1 != "" && diners_card_t2 != "" ){
							if(wallet_instant != "" && wallet_t0 != "" && wallet_t1 != "" && wallet_t2 != ""){
								if(corporate_card_instant != "" && corporate_card_t0 != "" && corporate_card_t1 != "" && corporate_card_t2 != "" ){
									if(prepaid_card_instant != "" && prepaid_card_t0 != "" && prepaid_card_t1 != "" && prepaid_card_t2 != ""){
										if(monthly_limit > 0 && limit_per_day > 0 && t0_hours > 0){
	if(debit_card_instant > 0 && debit_card_t0 > 0 && debit_card_t1 > 0 && debit_card_t2 > 0){
		if(netbanking_instant > 0 && netbanking_t0 > 0 && netbanking_t1 > 0 && netbanking_t2 > 0 ){
			if(upi_instant > 0 || upi_t0 > 0 || upi_t1 > 0 || upi_t2 > 0 ){
				if(credit_Card_instant > 0 && credit_card_t0 > 0 && credit_card_t1 > 0 && credit_card_t2 > 0){
					if(amex_card_instant > 0 && amex_card_t0 > 0 && amex_card_t1 > 0 && amex_card_t2 > 0 ){
						if(diners_card_instant > 0 && diners_card_t0 > 0 && diners_card_t1 > 0 && diners_card_t2 > 0 ){
							if(wallet_instant > 0 && wallet_t0 > 0 && wallet_t1 > 0 && wallet_t2 > 0){
								if(corporate_card_instant > 0 && corporate_card_t0 > 0 && corporate_card_t1 > 0 && corporate_card_t2 > 0){
									if(prepaid_card_instant > 0 && prepaid_card_t0 > 0 && prepaid_card_t1 > 0 && prepaid_card_t2 > 0){
										$("#plan_create_form").submit();
									}else{
					Swal.fire({
					icon: 'error',
					title: "Invalid Amount",
					confirmButtonText: 'Confirm'
					})
					$(".nav-link").removeClass("active");
					$(".tab-pane").removeClass("active");
					$(".Prepaid_Card").addClass("active");
				}
				}else{
					Swal.fire({
					icon: 'error',
					title: "Invalid Amount",
					confirmButtonText: 'Confirm'
					})
					$(".nav-link").removeClass("active");
					$(".tab-pane").removeClass("active");
					$(".Corporate_Card").addClass("active");
				}
				}else{
					Swal.fire({
					icon: 'error',
					title: "Invalid Amount",
					confirmButtonText: 'Confirm'
					})
					$(".nav-link").removeClass("active");
					$(".tab-pane").removeClass("active");
					$(".Wallet").addClass("active");
				}
				}else{
					Swal.fire({
					icon: 'error',
					title: "Invalid Amount",
					confirmButtonText: 'Confirm'
					})
					$(".nav-link").removeClass("active");
					$(".tab-pane").removeClass("active");
					$(".Diners_Card").addClass("active");
				}
				}else{
					Swal.fire({
					icon: 'error',
					title: "Invalid Amount",
					confirmButtonText: 'Confirm'
					})
					$(".nav-link").removeClass("active");
					$(".tab-pane").removeClass("active");
					$(".AMEX_Card").addClass("active");
				}
				}else{
					Swal.fire({
					icon: 'error',
					title: "Invalid Amount",
					confirmButtonText: 'Confirm'
					})
					$(".nav-link").removeClass("active");
					$(".tab-pane").removeClass("active");
					$(".Credit_Card").addClass("active");
				}
				}else{
					Swal.fire({
					icon: 'error',
					title: "Invalid Amount",
					confirmButtonText: 'Confirm'
					})
					$(".nav-link").removeClass("active");
					$(".tab-pane").removeClass("active");
					$(".upi").addClass("active");
				}
				}else{
					Swal.fire({
					icon: 'error',
					title: "Invalid Amount",
					confirmButtonText: 'Confirm'
					})
					$(".nav-link").removeClass("active");
					$(".tab-pane").removeClass("active");
					$(".Netbanking").addClass("active");
				}	
				}else{
					Swal.fire({
					icon: 'error',
					title: "Invalid Amount",
					confirmButtonText: 'Confirm'
					})
					$(".nav-link").removeClass("active");
					$(".tab-pane").removeClass("active");
					$(".Debit_Card").addClass("active");
				}
				}else{
				Swal.fire({
				icon: 'error',
				title: "Invalid Amount",
				confirmButtonText: 'Confirm'
				})
				}
		}else{
			Swal.fire({
			icon: 'error',
			title: "All fields are required",
			confirmButtonText: 'Confirm'
			})
			$(".nav-link").removeClass("active");
			$(".tab-pane").removeClass("active");
			$(".Prepaid_Card").addClass("active");
		}
		}else{
			Swal.fire({
			icon: 'error',
			title: "All fields are required",
			confirmButtonText: 'Confirm'
			})
			$(".nav-link").removeClass("active");
			$(".tab-pane").removeClass("active");
			$(".Corporate_Card").addClass("active");
		}
		}else{
			Swal.fire({
			icon: 'error',
			title: "All fields are required",
			confirmButtonText: 'Confirm'
			})
			$(".nav-link").removeClass("active");
			$(".tab-pane").removeClass("active");
			$(".Wallet").addClass("active");
		}
		}else{
			Swal.fire({
			icon: 'error',
			title: "All fields are required",
			confirmButtonText: 'Confirm'
			})
			$(".nav-link").removeClass("active");
			$(".tab-pane").removeClass("active");
			$(".Diners_Card").addClass("active");
		}
		}else{
			Swal.fire({
			icon: 'error',
			title: "All fields are required",
			confirmButtonText: 'Confirm'
			})
			$(".nav-link").removeClass("active");
			$(".tab-pane").removeClass("active");
			$(".AMEX_Card").addClass("active");
		}
		}else{
			Swal.fire({
			icon: 'error',
			title: "All fields are required",
			confirmButtonText: 'Confirm'
			})
			$(".nav-link").removeClass("active");
			$(".tab-pane").removeClass("active");
			$(".Credit_Card").addClass("active");
		}
		}else{
			Swal.fire({
			icon: 'error',
			title: "All fields are required",
			confirmButtonText: 'Confirm'
			})
			$(".nav-link").removeClass("active");
			$(".tab-pane").removeClass("active");
			$(".upi").addClass("active");
		}
		}else{
			Swal.fire({
			icon: 'error',
			title: "All fields are required",
			confirmButtonText: 'Confirm'
			})
			$(".nav-link").removeClass("active");
			$(".tab-pane").removeClass("active");
			$(".Netbanking").addClass("active");
		}	
		}else{
			Swal.fire({
			icon: 'error',
			title: "All fields are required",
			confirmButtonText: 'Confirm'
			})
			$(".nav-link").removeClass("active");
			$(".tab-pane").removeClass("active");
			$(".Debit_Card").addClass("active");
		}
	}else{
		Swal.fire({
		icon: 'error',
		title: "All fields are required",
		confirmButtonText: 'Confirm'
		})
	}
  	}
	  function change_network_plan_tpin_valid(uid){
		var value = $("#distibutor_change_network_plan").val();
		if(value == ""){

		}else{
			if (confirm('Are you sure ?')) {
				$("#change_network_plan_uid").val(uid);
				$("#change_network_plan_id").val(value);
				$('#plan_purches_tpin_verify_model').modal('show');
			}else
			{
				$('select[name^="distibutor_change_network_plan"] option[value=""]').attr("selected","selected");
			}
		}
		
	  }
	  function network_upgrade_plan_from_wallet_pin_check(){
	var uid =  $("#change_network_plan_uid").val();
	var planid = $("#change_network_plan_id").val();
    var tpin = $("#send_transactionpin").val();
    if(tpin == "" || tpin.length != 6){
      Swal.fire({
      icon: 'error',
      title: "Invalid transaction pin",
      confirmButtonText: 'Confirm'
      })
      return false;
    }
    $.ajaxSetup({
            headers:{
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
            $.ajax({
                type:"POST",
                url:"{{ url('network_upgrade_plan_from_wallet') }}",
                data: ({tpin:tpin}),
                success: function(response){
                  if(response == 0){
                    Swal.fire({
                    icon: 'error',
                    title: "Invalid Transaction pin",
                    confirmButtonText: 'Confirm'
                    })
                    return false;
                  }
                  if(response == 1){
					distibutor_change_network_plan(uid,planid);
                  }  
                }
            });
  }
	  function distibutor_change_network_plan(uid,planid){
		var value = planid;
		var userid = uid;
		if(value == ""){
			
		}else{
				$.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
	       	$.ajax({
	            type:"POST",
	            url:"{{ url('distibutor_change_network_plan_form') }}",
	            data: ({value:value,userid:userid}),
	            success: function(response){
	                if(response == 1){
						Swal.fire({
						icon: 'success',
						title: "Plan upgrade successful",
							allowEscapeKey: false,
						allowOutsideClick: false,
						confirmButtonText: 'Confirm'
						}).then((result) => {
							if (result.isConfirmed) {
								window.location.href = "{{ Request::url() }}";
							}
						})
					}
					if(response == 2){
						Swal.fire({
					icon: 'error',
					title: "Insufficient balance",
					confirmButtonText: 'Confirm'
					})
					}
	            }
	        });
			
		}
	  }
	  function admin_change_plan(uid){
		var value = $("#admin_change_plan"+uid).val();
		var userid = uid;
		if(value == ""){
			
		}else{
			if (confirm('Are you sure ?')) {
				$.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
	       	$.ajax({
	            type:"POST",
	            url:"{{ url('admin_plan_upgrade') }}",
	            data: ({plan_id:value,userid:userid}),
	            success: function(response){
	                if(response == 1){
						Swal.fire({
						icon: 'success',
						title: "User Plan Changed Successful",
						allowEscapeKey: false,
						allowOutsideClick: false,
						confirmButtonText: 'Confirm'
						})
					}
	            }
	        });
			}else
			{
				$('select[name^="admin_change_plan"] option[value=""]').attr("selected","selected");
			}
		}
	  }
	function payidcopy(id) {
		var copyText = document.getElementById("pey_id_copy"+id);
		copyText.select();
		document.execCommand("copy");
	}
	function numbercopy(id) {
		var copyText = document.getElementById("number_copy"+id);
		copyText.select();
		document.execCommand("copy");
	}
	$("#opin_eye").click(function(){
            
            var x = document.getElementById("oldtransactionpin");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        });
		$("#npin_eye").click(function(){
            var x = document.getElementById("transactionpin");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        });
	$("#notification_sec").click(function(){
		$.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
	       	$.ajax({
	            type:"POST",
	            url:"{{ url('notification_status_change') }}",
	            data: ({st:0}),
	            success: function(response){
	                $("#check_notification_count").html(0);
	            }
	        });
	});
	
            function validbtn(){
                $("#wait_btn").show();
                $("#submit_btn").hide();
            }

            
            function category_change(){
                var categoryid = $("#category_id").val();
                $.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
	       	$.ajax({
	            type:"POST",
	            url:"{{ url('on_category_change') }}",
	            data: ({categoryid:categoryid}),
	            success: function(response){
	                $("#sub_category_id").html(response);
	            }
	        });
		}
		function sub_category_change(){
                var subcategoryid = $("#sub_category_id").val();
                $.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
	       	$.ajax({
	            type:"POST",
	            url:"{{ url('sub_category_change') }}",
	            data: ({subcategoryid:subcategoryid}),
	            success: function(response){
	                $("#child_category_id").html(response);
	            }
	        });
		}
		function country_change(){
                var country_id = $("#country_id").val();
                $.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
	       	$.ajax({
	            type:"POST",
	            url:"{{ url('on_country_change') }}",
	            data: ({country_id:country_id}),
	            success: function(response){
	                $("#state_id").html(response);
	            }
	        });
		}
		function state_change(){
                var state_id = $("#state_id").val();
                $.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
	       	$.ajax({
	            type:"POST",
	            url:"{{ url('on_state_change') }}",
	            data: ({state_id:state_id}),
	            success: function(response){
	                $("#city_id").html(response);
	            }
	        });
		}
		function city_change(){
                var city_id = $("#city_id").val();
                $.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
	       	$.ajax({
	            type:"POST",
	            url:"{{ url('on_city_change') }}",
	            data: ({city_id:city_id}),
	            success: function(response){
	                $("#subcity_id").html(response);
	            }
	        });
		}
        function semester_change(){
                var semesterid = $("#semester_id").val();
               $.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
	       	$.ajax({
	            type:"POST",
	            url:"{{ url('semester_change') }}",
	            data: ({semesterid:semesterid}),
	            success: function(response){
	                $("#category_id").html(response);
	            }
	        });
		}
		$("#packone_features_btn").click(function(){
			$("#packone_features_div").append("<input  name='packone_features[]' placeholder='Enter Package 1 features' type='text' class='form-control form-group' >");
		});
		$("#packtwo_features_btn").click(function(){
			$("#packtwo_features_div").append("<input  name='packtwo_features[]' placeholder='Enter Package 2 features' type='text' class='form-control form-group' >");
		});
		$("#packthree_features_btn").click(function(){
			$("#packthree_features_div").append("<input  name='packthree_features[]' placeholder='Enter Package 3 features' type='text' class='form-control form-group' >");
		});

		$(document).ready(function() {
    $('#check_d').DataTable( {
    } );
} );
	$("#Add_money_to_wallet").click(function(){
		$(".addmoney_cls").show();
	});
	$("#deduct_money_to_wallet").click(function(){
		$(".deductmoney_cls").show();
	});
	$("#add_money_model_cancel").click(function(){
		$("#shop_id_fild").val("");
		$("#add_amount_field").val("");
		$("#remark_field").val("");
		$(".addmoney_cls").hide();
	});
	$("#deduct_money_model_cancel").click(function(){
		$("#de_shop_id_fild").val("");
		$("#de_remark_field").val("");
		$("#deduct_amount_field").val("");
		$(".deductmoney_cls").hide();
	});
	function send_to_wallet(id){
		var shop_id = id;
		$.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
		$.ajax({
			type:"POST",
			url:"{{ url('get_user_data') }}",
			data: ({
			uid:shop_id,
			}),
			success: function(response){
				var text = jQuery.parseJSON(response);
				$(".uname").html(text.name);
				$(".shopname").html(text.shop_name);
			}
        });
		$('#add_money_model').modal('show');
		$("#shop_id_fild").val(id);
		$("#add_amount_field").val("");
	}
	function deduct_to_wallet(id){
		var shop_id = id;
		$.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
		$.ajax({
			type:"POST",
			url:"{{ url('get_user_data') }}",
			data: ({
			uid:shop_id,
			}),
			success: function(response){
				var text = jQuery.parseJSON(response);
				$(".uname").html(text.name);
				$(".shopname").html(text.shop_name);
			}
        });
		$("#de_shop_id_fild").val(shop_id);
		$("#deduct_amount_field").val("");
		$('#deduct_money_model').modal('show');
	}
	deduct_to_wallet
	function change_shop_stats(id){
		$.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
		$.ajax({
                type:"POST",
                url:"{{ url('change_shop_stats') }}",
                data: ({
                id:id,
                }),
                success: function(response){
                if(response == 1){
                    //  toastr.error('Account Deactivate');
					Swal.fire({
      icon: 'error',
      title: "Account Deactivate",
      confirmButtonText: 'Confirm'
    })
                }
                if(response == 2){
                    // toastr.success('Account Active');
					Swal.fire({
      icon: 'success',
      title: "Account Active",
      confirmButtonText: 'Confirm'
    })
                }
                }
        });
	}
	function change_send_money_stats(id){
		$.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
		$.ajax({
                type:"POST",
                url:"{{ url('change_send_money_stats') }}",
                data: ({
                id:id,
                }),
                success: function(response){
                if(response == 1){
                    //  toastr.error('Deactivate');
					Swal.fire({
      icon: 'error',
      title: "Deactivate",
      confirmButtonText: 'Confirm'
    })
                }
                if(response == 2){
                    // toastr.success('Active');
					Swal.fire({
      icon: 'success',
      title: "Active",
      confirmButtonText: 'Confirm'
    })
                }
                }
        });
	}
	function change_instant_stats(id){
		$.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
		$.ajax({
                type:"POST",
                url:"{{ url('change_instant_stats') }}",
                data: ({
                id:id,
                }),
                success: function(response){
                if(response == 1){
                    //  toastr.error('Deactivate');
					Swal.fire({
      icon: 'error',
      title: "Deactivate",
      confirmButtonText: 'Confirm'
    })
                }
                if(response == 2){
                    // toastr.success('Active');
					Swal.fire({
      icon: 'success',
      title: "Active",
      confirmButtonText: 'Confirm'
    })
                }
                }
        });
	}
	function change_kyc_stats(id){
		$.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
		$.ajax({
                type:"POST",
                url:"{{ url('change_kyc_stats') }}",
                data: ({
                id:id,
                }),
                success: function(response){
                if(response == 1){
                    //  toastr.error('kyc status changed');
					Swal.fire({
      icon: 'error',
      title: "kyc status changed",
      confirmButtonText: 'Confirm'
    })
                }
                if(response == 2){
                    // toastr.success('Kyc verified');
					Swal.fire({
      icon: 'success',
      title: "Kyc verified",
      confirmButtonText: 'Confirm'
    })
                }
                }
        });
	}
	$("#change_transactionpin_btn").click(function(){
		$("#change_transactionpin_div").show();
	});
	function change_tpin_form(){
		var transactionpin = $("#transactionpin").val();
		if(transactionpin.length != 6 || transactionpin == ""){
			Swal.fire({
			icon: 'error',
			title: "Invalid Pin",
			confirmButtonText: 'Confirm'
			})
			return false;
		}else{
			$("#transactionpin_update").submit();
		}
	}
	// $("#transactionpin").keyup(function(){
	// 	var transactionpin = $("#transactionpin").val();
	// 	// var oldtransactionpin = $("#oldtransactionpin").val();
	// 	if(transactionpin.length != 6 || oldtransactionpin.length != 6){
	// 		$('#submit_btn').attr("disabled", true);
	// 		$(".Transaction_pin_error").show();
	// 		return false;
	// 	}else{
	// 		$('#submit_btn').attr("disabled", false);	
	// 		$(".Transaction_pin_error").hide();
	// 	}
	// });
	$("#pin_check_modeal").click(function(){
		var amount = $("#amount").val();
		var remark = $("#remark").val();
		var phone_number = $("#phone_number").val();
		if(amount < 1){
			// toastr.error("invalid amount!");
			Swal.fire({
      icon: 'error',
      title: "Insufficient Blance",
      confirmButtonText: 'Confirm'
    })
            return false;
		}
		if(remark == ""){
			// toastr.error("All fields are required");
			Swal.fire({
      icon: 'error',
      title: "All fields are required",
      confirmButtonText: 'Confirm'
    })
            return false;
		}
		$.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
		$.ajax({
                type:"POST",
                url:"{{ url('internal_transfer_wallet_check') }}",
                data: ({
					amount:amount,
                }),
                success: function(response){
					if(response == 1){
						$("#m_amount").val(amount);
						$("#m_remark").val(remark);
						$("#m_phone_number").val(phone_number)
						$('#send_money_model').modal('show');
					}
					if(response == 0){
						Swal.fire({
						icon: 'error',
						title: "Insufficient balance",
						confirmButtonText: 'Confirm'
						})
						return false;
					}	
                }
        });
	});
	@if(Request::url() == url('money_transfer_form'))
	$("#tpin_check_btn").click(function(){
		var transaction_pin = $("#send_transactionpin").val();
		var m_amount = $("#tamount").val();
		if(transaction_pin.length == 6){
			$.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
		$.ajax({
                type:"POST",
                url:"{{ url('check_transaction_pin') }}",
                data: ({
					transaction_pin:transaction_pin,m_amount:m_amount,
                }),
                success: function(response){
					if(response == 2){
                        // $("#pin_check_btn").hide();
						// $("#wait_btn").show();
						$("#aaa").submit();
                    }
					if(response == 1){
                        window.location.href = "{{ url('money_transfer_form_sub') }}";
                    }
					if(response == 3){
						// toastr.error("invalid Transaction pin !");
						Swal.fire({
      icon: 'error',
      title: "Insufficient balance !",
      confirmButtonText: 'Confirm'
    })
                        return false;
                    }
					if(response == 4){
						// toastr.error("Enter valid amount");
						Swal.fire({
      icon: 'error',
      title: "Insufficient balance",
      confirmButtonText: 'Confirm'
    })
                        return false;
                    }
                }
        });
		}else{
			// toastr.error('Transaction pin should be 6 digit');
			Swal.fire({
      icon: 'error',
      title: "Transaction pin should be 6 digit",
      confirmButtonText: 'Confirm'
    })
			return false;
		}

	});
	@endif
	$("#pin_check_btn").click(function(){
		var transaction_pin = $("#send_transactionpin").val();
		var m_amount = $("#m_amount").val();
		if(transaction_pin.length == 6){
			$.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
		$.ajax({
                type:"POST",
                url:"{{ url('check_transaction_pin') }}",
                data: ({
					transaction_pin:transaction_pin,m_amount:m_amount,
                }),
                success: function(response){
					if(response == 2){
                        // $("#pin_check_btn").hide();
						// $("#wait_btn").show();
						$("#funds_transfer_form").submit();
                    }
					if(response == 1){
                        window.location.href = "{{ url('transactionpin') }}";
                    }
					if(response == 3){
						// toastr.error("invalid Transaction pin !");
						Swal.fire({
      icon: 'error',
      title: "Invalid Transaction pin !",
      confirmButtonText: 'Confirm'
    })
                        return false;
                    }
					if(response == 4){
						// toastr.error("Enter valid amount");
						Swal.fire({
      icon: 'error',
      title: "Insufficient balance",
      confirmButtonText: 'Confirm'
    })
                        return false;
                    }
                }
        });
		}else{
			// toastr.error('Transaction pin should be 6 digit');
			Swal.fire({
      icon: 'error',
      title: "Transaction pin should be 6 digit",
      confirmButtonText: 'Confirm'
    })
			return false;
		}

	});
	$("#find_account").click(function(){
		var phone_number = $("#phone_number").val();
		if(phone_number.length < 9){
			// toastr.error('Phone number should be 10 digit');
			Swal.fire({
      icon: 'error',
      title: "Phone number should be 10 digit",
      confirmButtonText: 'Confirm'
    })
			return false;
		}else{
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
					if(response == 0){
                        toastr.success("Phone number verified");
						$("#amount_field").show();
						// $("#number_field").hide();
						$('#phone_number').prop('readonly', true);
						$("#find_account").hide();
						$("#transfer_funds").show();
                    }
					if(response == 1){
                        // toastr.error("Account not found !");
						Swal.fire({
      icon: 'error',
      title: "Account not found !",
      confirmButtonText: 'Confirm'
    })
                        return false;
                    }
                }
        });
		}
	});
	@if (Request::url() == url('addmoney'))
//   document.querySelector(".send_transactionpin_valid")
// .addEventListener("keypress", function(e) {
//     e.preventDefault();
// 	console.log(e.key);
//     var ph = $(".send_transactionpin_valid").val();
//     if(ph.length < 5){
//         $("#Transaction_pin_error").show();
		
//     }else{
//         $("#Transaction_pin_error").hide();
// 		// $('#pin_check_btn').attr("disabled", true);
//     }
//     var input = e.target;
//     var value = Number(input.value);
//     var key = Number(e.key);
//     if (Number.isInteger(key)) {
//       value = Number("" + value + key);
//       if (value > 999999) {
//         return false;
//       }
//       input.value = value;
//     }
//   });
  @endif
  @if (Request::url() == url('credittonetwork') || Request::url() == url('my_network') || Request::url() == url('merchant_network_list'))
  document.querySelector("#distibutor_send_transactionpin_valid")
.addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#distibutor_send_transactionpin_valid").val();
    if(ph.length < 5){
        $("#distibutor_Transaction_pin_error").show();
		
    }else{
        $("#distibutor_Transaction_pin_error").hide();
		// $('#pin_check_btn').attr("disabled", true);
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 999999) {
        return false;
      }
      input.value = value;
    }
  });
  @endif
  $("#tpin_eye").click(function(){
            var x = document.getElementById("send_transactionpin");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        });

		$("#distibutor_tpin_eye").click(function(){
            var x = document.getElementById("distibutor_send_transactionpin_valid");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        });

	function network_credit(id){
        var username = $("#username"+id).val();
        var mobile = $("#mobile"+id).val();
        var company_name = $("#company_name"+id).val();
        var wallet_bal = $("#wallet_bal"+id).val();
		var suid = $("#suid"+id).val();
		$("#d_username").html(username);
		$("#suid").val(suid);
		$("#d_mobile").html(mobile);
		$("#d_companyname").html(company_name);
		$("#d_wallet_bal").html(wallet_bal);
		$('#distibutor_send_money_model').modal('show');
    }
		function check_mywallet(){
			var distibutor_m_amount = $("#distibutor_m_amount").val();
			var distibutor_m_remark = $("#distibutor_m_remark").val();
			var my_wallet_bal = $("#distibutor_wallet_bal").val();;
			if(distibutor_m_amount == "" || distibutor_m_remark == ""){
				Swal.fire({
				icon: 'error',
				title: "All fields are required",
				confirmButtonText: 'Confirm'
				})
			return false;
			}
			if(distibutor_m_amount < 1){
			// toastr.error("invalid amount!");
			Swal.fire({
      icon: 'error',
      title: "Insufficient balance!",
      confirmButtonText: 'Confirm'
    })
            return false;
		}
		if(distibutor_m_amount > my_wallet_bal){
			// toastr.error("invalid amount!");
			Swal.fire({
      icon: 'error',
      title: "Insufficient balance!",
      confirmButtonText: 'Confirm'
    })
            return false;
		}
		$("#distibutor_amount").hide();
		$("#distibutor_tpin_enter").show();
		$("#distibutor_check_mywallet").hide();
		$("#distibutor_pincheck").show();
		}
	$("#distibutor_pincheck").click(function(){
		var transaction_pin = $("#distibutor_send_transactionpin_valid").val();
		var m_amount = $("#distibutor_m_amount").val();
		if(transaction_pin.length == 6){
			$.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            });
		$.ajax({
                type:"POST",
                url:"{{ url('check_transaction_pin') }}",
                data: ({
					transaction_pin:transaction_pin,m_amount:m_amount,
                }),
                success: function(response){
					if(response == 2){
                        // $("#pin_check_btn").hide();
						// $("#wait_btn").show();
						$("#distibutor_funds_transfer_form").submit();
                    }
					if(response == 1){
                        window.location.href = "{{ url('transactionpin') }}";
                    }
					if(response == 3){
						// toastr.error("invalid Transaction pin !");
						Swal.fire({
      icon: 'error',
      title: "invalid Transaction pin !",
      confirmButtonText: 'Confirm'
    })
                        return false;
                    }
					if(response == 4){
						// toastr.error("Enter valid amount");
						Swal.fire({
      icon: 'error',
      title: "Insufficient balance",
      confirmButtonText: 'Confirm'
    })
                        return false;
                    }
                }
        });
		}else{
			// toastr.error('Transaction pin should be 6 digit');
			Swal.fire({
      icon: 'error',
      title: "Transaction pin should be 6 digit",
      confirmButtonText: 'Confirm'
    })
			return false;
		}

	});
	var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];
@if (Request::url() == url('credittonetwork')  || Request::url() == url('my_network') || Request::url() == url('merchant_network_list'))
function inWords (num) {
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return; var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + '' : '';
    $("#nhide").show();
    return str;
}

document.getElementById('distibutor_m_amount').onkeyup = function () {
    $('input[name="topupmen"]:checked').prop('checked', false);
    $("#fee_view_sec").hide();
    document.getElementById('ammount_in_word').innerHTML = inWords(document.getElementById('distibutor_m_amount').value);
};
@endif
function admin_send_lein_fund(){
	var leinamount = Number($("#m_wallet_bal").val());
	var amount = Number($("#amount").val());
	var remark = $("#remark").val();
	if(amount < 0){
		Swal.fire({
			icon: 'error',
			title: "Enter Amount",
			confirmButtonText: 'Confirm'
			})
			return false;
	}
	if(amount != "" && remark != ""){
		if(amount > leinamount){
			Swal.fire({
			icon: 'error',
			title: "Insufficient balance",
			confirmButtonText: 'Confirm'
			})
			return false;
		}else{
			$("#admin_leintransfer_form").submit();
		}
	}else{
		Swal.fire({
		icon: 'error',
		title: "All fields required",
		confirmButtonText: 'Confirm'
		})
		return false;
	}
}
@if (Request::url() == url('linkgen')) {
	function setInputFilter(textbox, inputFilter){
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  });
}
setInputFilter(document.getElementById("uname"), function(value) {
  return /^[a-z \s]*$/i.test(value); });
}
document.querySelector("#ph")
  .addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#ph").val();
    if(ph.length < 9){
        $("#shop_mobile_number_error").show();
    }else{
        $("#shop_mobile_number_error").hide();
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 9999999999) {
        return false;
      }
      input.value = value;
    }
  });
@endif
$(document).ready(function() {
    $('.bank_names').select2();
});
function check_verify_btn(){
	if($("#is_bank_verify_checkbox").prop('checked') == true){
		$("#verify_submit_btn").show();
		$("#submit_btn").hide();
	}else{
		$("#verify_submit_btn").hide();
		$("#submit_btn").show();
	}
}
function select_forgot_password_type(type){
        if(type == 1){
          $("#email_field").show();
          $("#tpin_change_send_otp_btn").show();
          $("#phone_field").hide();
          $("#emailid").attr("required", true);
          $("#mobile_number").removeAttr('required');
        }else if(type == 2){
          $("#email_field").hide();
		  $("#tpin_change_send_otp_btn").show();
          $("#phone_field").show();
          $("#emailid").removeAttr("required");
          $("#mobile_number").attr('required',true);
        }else{
          $("#email_field").hide();
          $("#phone_field").hide();
		  $("#tpin_change_send_otp_btn").hide();
        }
      }
	function tpin_change_sendotp(type){
		var emailid = $("#emailid").val();
		var tpinotp = $("#tpinotp").val();
		if(type == 1){
			if(emailid == ""){
				Swal.fire({
				icon: 'error',
				title: "Enter your email Id",
				confirmButtonText: 'Confirm'
				})
				return false;
			}	
			$("#send_btn").hide();
			$("#tpin_wait_btn").show();
		}
		if(type == 2){
			if(tpinotp == ""){
				Swal.fire({
				icon: 'error',
				title: "Invalid OTP",
				confirmButtonText: 'Confirm'
				})
				return false;
			}
		}		
			$.ajaxSetup({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
				});
			$.ajax({
					type:"POST",
					url:"{{ url('tpin_change_email_otp_send') }}",
					data: ({
						emailid:emailid,type:type,tpinotp:tpinotp,
					}),
					success: function(response){
						if(response == 0){
							$("#tpin_wait_btn").hide();
							$("#send_btn").show();
							Swal.fire({
							icon: 'error',
							title: "Email id not match",
							confirmButtonText: 'Confirm'
							})
							return false;
						}
						if(response == 2){
							Swal.fire({
							icon: 'error',
							title: "Something went wrong",
							confirmButtonText: 'Confirm'
							})
							return false;
						}
						if(response == 3){
							$("#email_opt_section").hide();
							$("#tpin_change_form").show();
							Swal.fire({
							icon: 'success',
							title: "OTP verified successfully",
							confirmButtonText: 'Confirm'
							})
							return false;
						}
						if(response == 4){
							Swal.fire({
							icon: 'error',
							title: "Invalid OTP",
							confirmButtonText: 'Confirm'
							})
							return false;
						}
						if(response == 1){
							$("#verify_btn").show();
							$("#email_otp_field").show();
							$("#send_btn").hide();
							$("#tpin_wait_btn").hide();
							Swal.fire({
							icon: 'success',
							title: "OTP send to your email",
							confirmButtonText: 'Confirm'
							})
						}
					}
			});
		
	}
	
	@if (Request::url() == url('mapping')) 
document.querySelector("#mapping_mobile_no").addEventListener("keypress", function(e) {
    e.preventDefault();
	console.log(e.key);
    var ph = $("#mapping_mobile_no").val();
    if(ph.length < 9){
        $("#phone_number_error").show();
		
    }else{
        $("#phone_number_error").hide();
    }
    var input = e.target;
    var value = Number(input.value);
    var key = Number(e.key);
    if (Number.isInteger(key)) {
      value = Number("" + value + key);
      if (value > 9999999999) {
        return false;
      }
      input.value = value;
    }
  });
	@endif
	function fetchbankidfordelete(id){
		$('html,body').animate({
        scrollTop: $("#payeebtn_div").height()},
			'slow');
		$("#paybank_id").val(id);
	}
	function delete_payee(){
		var bankid = $("#paybank_id").val();
		if(bankid == ""){
			Swal.fire({
			icon: 'error',
			title: "Select bank account",
			confirmButtonText: 'Confirm'
			})	
			return false;
		}else{
			if (confirm('Are you sure ?')) {
				$("#delete_bankaccount").submit();
			}
		}
	}
	function add_to_favorites_thistory(){
		var tid = $("#tid").val();
		$.ajaxSetup({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
				});
			$.ajax({
					type:"POST",
					url:"{{ url('add_to_favorites_thistory') }}",
					data: ({
						tid:tid,
					}),
					success: function(response){
						if(response == 1){
						Swal.fire({
						icon: 'success',
						title: "Added to favorites",
						confirmButtonText: 'Confirm'
						})	
						$("#favbtn").hide();
					}else{
						Swal.fire({
						icon: 'error',
						title: "Something wrong",
						confirmButtonText: 'Confirm'
						})
					}
					}
			});
	}
	function confirm_fee_model(){
		var fee = $("#fee").val();
		$("#fee_amount").html(fee);
		$('#confirm_fee_model').modal('show');
	}
	function continue_payout_form(){
		$("#confirm_fee_wait_btn").show();
		$("#confirm_fee_btn").hide();
		$("#pay_submit_form").submit();
	}
	function favorite_function(id){
		var status = $(".favorite_status"+id).val();
		$.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
	       	$.ajax({
	            type:"POST",
	            url:"{{ url('add_fav_account') }}",
	            data: ({id:id,status:status}),
	            success: function(response){
	                if(response == 1){
						$(".addtofav"+id).css("color", "#EA5455");
						$(".favorite_status"+id).val(2);
						Swal.fire({
                        icon: 'success',
                        title: "Added to favorite",
                        confirmButtonText: 'Confirm'
                        })
                        return false;
                    }
					if(response == 2){
						$(".addtofav"+id).css("color", "#82868B");
						$(".favorite_status"+id).val(1);
						Swal.fire({
                        icon: 'success',
                        title: "Remove from favorite",
                        confirmButtonText: 'Confirm'
                        })
                        return false;
					}
	            }
	        });	
	}
	
	function  add_varifyed_paye(id){
		var get_bank_id =  id;
		$.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
	       	$.ajax({
	            type:"POST",
	            url:"{{ url('add_varifyed_paye') }}",
	            data: ({get_bank_id:get_bank_id}),
	            success: function(response){
	                if(response == 1){
						Swal.fire({
                        icon: 'success',
                        title: "Account added successfully",
                        confirmButtonText: 'Confirm'
					});
						window.location.replace('{{url('add_account')}}');
                        return false;
					}
	            }
	        });
	}
	function  cancel_add_varifyed_paye(id){
		var get_bank_id =  id;
		$.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
	       	$.ajax({
	            type:"POST",
	            url:"{{ url('cancel_add_varifyed_paye') }}",
	            data: ({get_bank_id:get_bank_id}),
	            success: function(response){
	                if(response == 1){
						Swal.fire({
                        icon: 'success',
                        title: "Cancelled",
                        confirmButtonText: 'Confirm'
                        });
						window.location.replace('{{url('add_account')}}');
                        return false;
					}
	            }
	        });
	}
	function submit_home_payye(){
		
		$("#money_transfer_form").submit();
	}
	function tally_datefilter(value){
		if(value == 4){
			$(".tallydate").show();
		}else{
			$(".tallydate").hide();
		}
	}
	function payouthtmlToCSV(html, filename) {
	var data = [];
	var rows = document.querySelectorAll("#payouttable tr");
			
	for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");
				
		for (var j = 0; j < cols.length; j++) {
		        row.push(cols[j].innerText);
        }
		        
		data.push(row.join(",")); 		
	}

	downloadCSVFile(data.join("\n"), filename);
}
	function htmlToCSV(html, filename) {
	var data = [];
	var rows = document.querySelectorAll("#addtable tr");
			
	for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");
				
		for (var j = 0; j < cols.length; j++) {
		        row.push(cols[j].innerText);
        }
		        
		data.push(row.join(",")); 		
	}

	downloadCSVFile(data.join("\n"), filename);
}
function downloadCSVFile(csv, filename) {
	var csv_file, download_link;

	csv_file = new Blob([csv], {type: "text/csv"});

	download_link = document.createElement("a");

	download_link.download = filename;

	download_link.href = window.URL.createObjectURL(csv_file);

	download_link.style.display = "none";

	document.body.appendChild(download_link);

	download_link.click();
}
	$("#download-button").click(function(){
		var html = $("#addtable").outerHTML;
		var payouttable = $("#payouttable").outerHTML;
		htmlToCSV(html, "addwallet.csv");
		payouthtmlToCSV(payouttable, "payouttable.csv");
		});
	function playsound(){
		$.ajaxSetup({
			  headers: {
			      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
	       	$.ajax({
	            type:"POST",
	            url:"{{ url('errorcount_ajax') }}",
	            data: ({id:1}),
	            success: function(response){
					var text = jQuery.parseJSON(response);
					if(text.sound == 1){
						Swal.fire({
                        icon: 'error',
                        title: "New error found !!",
                        confirmButtonText: 'Confirm'
                        });
						var myAudio = new Audio('{{asset('e.mp3')}}');
						myAudio.play();
					}
	                $("#errorcountdiv").html(text.no);
	            }
	        });
	}
	setInterval(playsound,10000);
        </script>