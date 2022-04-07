@extends('backend.master')
@section('body')


<div class="row">
    <div class="content-body"><!-- users list start -->
        <section class="app-user-list">
          <div class="row">
            <div class="col-lg-3 col-sm-6">
              <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                  <div>
                    <h3 class="fw-bolder mb-75">21,459</h3>
                    <span>Total Users</span>
                  </div>
                  <div class="avatar bg-light-primary p-50">
                    <span class="avatar-content">
                      <i data-feather="user" class="font-medium-4"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                  <div>
                    <h3 class="fw-bolder mb-75">4,567</h3>
                    <span>Paid Users</span>
                  </div>
                  <div class="avatar bg-light-danger p-50">
                    <span class="avatar-content">
                      <i data-feather="user-plus" class="font-medium-4"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                  <div>
                    <h3 class="fw-bolder mb-75">19,860</h3>
                    <span>Active Users</span>
                  </div>
                  <div class="avatar bg-light-success p-50">
                    <span class="avatar-content">
                      <i data-feather="user-check" class="font-medium-4"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                  <div>
                    <h3 class="fw-bolder mb-75">237</h3>
                    <span>Pending Users</span>
                  </div>
                  <div class="avatar bg-light-warning p-50">
                    <span class="avatar-content">
                      <i data-feather="user-x" class="font-medium-4"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Row grouping -->
        <section id="multilingual-datatable">
          <div class="row">
            <div class="col-12">
              <div class="card p-2">
                <div class="card-header border-bottom">
                  <h4 class="card-title">Multilingual</h4>
                </div>
                <div class="card-datatable">
                  <table class="table" id="check_d">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
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
                        <td>12-12-2021</td>
                        <td>Active</td>
                        <td>
                          <button class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Kumat Das</td>
                        <td>raj@gmail.com</td>
                        <td>12-12-2021</td>
                        <td>Active</td>
                        <td>
                          <button class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Amit Das</td>
                        <td>raj@gmail.com</td>
                        <td>12-12-2021</td>
                        <td>Active</td>
                        <td>
                          <button class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Raj Das</td>
                        <td>gour@gmail.com</td>
                        <td>12-12-2021</td>
                        <td>Active</td>
                        <td>
                          <button class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Isa Das</td>
                        <td>raj@gmail.com</td>
                        <td>12-12-2021</td>
                        <td>Active</td>
                        <td>
                          <button class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Rose Das</td>
                        <td>raj@gmail.com</td>
                        <td>12-12-2021</td>
                        <td>Active</td>
                        <td>
                          <button class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Cap Das</td>
                        <td>jio@gmail.com</td>
                        <td>12-12-2021</td>
                        <td>Active</td>
                        <td>
                          <button class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Raj Das</td>
                        <td>raj@gmail.com</td>
                        <td>12-12-2021</td>
                        <td>Active</td>
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