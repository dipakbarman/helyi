@extends('backend.master')
@section('body')


<div class="row">
    <div class="content-body"><!-- users list start -->
        
        <!-- Row grouping -->
        <section id="multilingual-datatable">
          <div class="row">
            <div class="col-12">
              <div class="card p-2">
                <div class="card-header border-bottom">
                  <h4 class="card-title">Payments list</h4>
                </div>
                <div class="card-datatable">
                  <table class="table" id="check_d">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>01</td>
                        <td>Raj Das</td>
                        <td>raj@gmail.com</td>
                        <td>255</td>
                        <td>12-12-2021</td>
                        <td>Completed</td>
                        <td>
                          <button class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Kumat Das</td>
                        <td>raj@gmail.com</td>
                        <td>58</td>
                        <td>12-12-2021</td>
                        <td>Completed</td>
                        <td>
                          <button class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Amit Das</td>
                        <td>raj@gmail.com</td>
                        <td>489</td>
                        <td>12-12-2021</td>
                        <td>Completed</td>
                        <td>
                          <button class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Raj Das</td>
                        <td>gour@gmail.com</td>
                        <td>1000</td>
                        <td>12-12-2021</td>
                        <td>Completed</td>
                        <td>
                          <button class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Isa Das</td>
                        <td>raj@gmail.com</td>
                        <td>4586</td>
                        <td>12-12-2021</td>
                        <td>Completed</td>
                        <td>
                          <button class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Rose Das</td>
                        <td>raj@gmail.com</td>
                        <td>800</td>
                        <td>12-12-2021</td>
                        <td>Completed</td>
                        <td>
                          <button class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Cap Das</td>
                        <td>jio@gmail.com</td>
                        <td>459</td>
                        <td>12-12-2021</td>
                        <td>Completed</td>
                        <td>
                          <button class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Raj Das</td>
                        <td>raj@gmail.com</td>
                        <td>1258</td>
                        <td>12-12-2021</td>
                        <td>Completed</td>
                        <td>
                          <button class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
<!--/ Row grouping -->
        
                </div>    
</div>  
@endsection