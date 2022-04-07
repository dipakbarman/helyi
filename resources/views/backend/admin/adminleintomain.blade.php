@extends('backend.master')
@section('body')
<div class="row">
    <div class="content-body"><!-- users list start -->
        <!-- Row grouping -->
        <section id="">
          <div class="row">
              <div class="col-12">
                  <div class="card p-2">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4"></div>
                          <div class="col-md-4">
                            <form action="{{ url('adminleintomain_form') }}" method="post" onsubmit="validbtn()">
                              @csrf
                              <div class="form-group mb-2">
                                  <label for="">Amount</label>
                                  <input required type="number" name="amount" class="form-control" id="">
                              </div>
                              <button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
                              <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                            </form>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                    </div>
                  </div>
              </div>
            <div class="col-12">
              <div class="card p-2">
                <div class="card-header border-bottom">
                  <h4 class="card-title">Lein to main history </h4>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Sl. No</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Lein wallet</th>
                        <th>Main wallet</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($qlist as $index => $list)
                    <tr>
                        <td>{{$index + $qlist->firstItem()}}</td>                        
                        <td>{{ $list->date }}</td>
                        <td>{{ number_format($list->amount,2) }}</td>
                        <td>{{ number_format($list->lein,2) }}</td>
                        <td>{{ number_format($list->main,2) }}</td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  {{ $qlist->withQueryString()->links() }}
                </div>
              </div>
            </div>
          </div>
        </section>
<!--/ Row grouping -->
        
                </div>    
</div>
@endsection