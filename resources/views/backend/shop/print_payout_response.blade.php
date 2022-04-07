<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  @php
    $amount = "";
    $date = "";
    $time_is = "";
    $transferid = "";
    $uti = "";
    $referenceId = "";
    $from = "";
    $to_name = "";
    $to_account = "";
    $ifsc = "";
    $type = "";
    $remark = "";
    $id = "";
    $sender_name = "";
    $bank_name = "";
    $mobile_number = "";
    $status_text = "";
    $name = "";
    if(isset($q)){
        $bankq = DB::table('merchant_bank_accounts')->where('id',$q->bankid)->first();
        $amount = number_format($q->amount,0);
        $mobile_number = $bankq->mobile_number;
        $name = $bankq->name;
        $from = get_user_name($q->uid);
        $to_name = $bankq->name;
        $to_account = $q->account_no;
        $ifsc = $q->ifsc;
        $type = get_pay_type($q->type);
        $remark = $q->remark;
        $id = $q->id;
        $sender_name = $q->sender_name;
        $bank_name = $q->bank_name;
        $date = $q->date;
        $transferid = $q->transferid;
        $referenceId = $q->referenceId;
        $uti = $q->uti;
        $time_is = $q->time_is;
        $status_text = $q->status_text;
    }
@endphp
  <body id="okk" onload="window.print()">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                <div class="row justify-content-center">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="row c_css_style">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sender Name</th>
                                        <th>{{ $sender_name }} </th>
                                    </tr>
                                    <tr>
                                        <th>Recipient Name</th>
                                        <th>{{ $name }}</th>
                                    </tr>
                                    <tr>
                                        <th>Sender Mobile Number</th>
                                        <th>{{ get_user_number(session()->get('userid')) }}</th>
                                    </tr>
                                    <tr>
                                        <th>Bank Name</th>
                                        <th>{{$bank_name}}</th>
                                    </tr>
                                    <tr>
                                        <th>Account No</th>
                                        <th>{{$to_account}}</th>
                                    </tr>
                                    <tr>
                                        <th>Txn. Amount</th>
                                        <th> {{$amount}}</th>
                                    </tr>
                                    <tr>
                                        <th>Transaction Date</th>
                                        <th> {{$date}}</th>
                                    </tr>
                                    <tr>
                                        <th>Transaction Time</th>
                                        <th> {{$time_is}}</th>
                                    </tr>
                                    <tr>
                                        <th>Service Delivery Id</th>
                                        <th> {{$uti}}</th>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <th>{{$status_text}}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
          </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>
    <script>
        function okk(){
			    
				// 			event.preventDefault();
				
							//credit : https://ekoopmans.github.io/html2pdf.js
							
							var element = document.getElementById('okk'); 
				
							//easy
				// 			html2pdf().from(element).save();
				
							//custom file name
							//html2pdf().set({filename: 'code_with_mark_'+js.AutoCode()+'.pdf'}).from(element).save();
				
				
							//more custom settings
							var opt = 
							{
							  margin:       0,
							  filename:     'Transaction.pdf',
							  image:        { type: 'jpeg', quality: 0.98 },
							  html2canvas:  { scale: 1 },
							  jsPDF:        { unit: 'in', format: 'a3', orientation: 'portrait' }
							};
				
							// New Promise-based usage:
							html2pdf().set(opt).from(element).save();
              
							}
    </script>
  </body>
</html>