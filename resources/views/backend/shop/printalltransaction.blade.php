<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body id="okk" onload="okk()">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SL No</th>
                            <th>Date/Time</th>
                            <th>Amount</th>
                            <th>Action</th>
                            <th>Balance</th>
                        </tr> 
                    </thead>   
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                      @foreach ($q as $list)
                      <tr>
                          <td>{{ $i }}</td>
                          <td>{{ $list->time }}-{{ $list->date }}</td>
                            <td>{{ number_format($list->amt,0) }}</td>
                            <td>
                                {{ $list->r }}
                            </td>
                            <td>{{number_format($list->bal,0)}}</td>
                        </tr>

                      @php
                          $i++;
                      @endphp
                      @endforeach
                    </tbody>
                    </table>
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