@extends('backend.master');
@section("content")
<div class="content-wrapper" style="min-height: 1299.69px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Simple Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  
                  <thead>
                    <tr>
                      <th style="width: 10px">SL</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Created At</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $sdata)
                    <tr>
                       
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $sdata->category_name }}</td>
                      <td>{{ $sdata->slug }}</td>
                      <td>{{ $sdata->created_at->format('d-M-Y h:i:s a') }} ({{ $sdata->created_at->diffForHumans() }})</td>
                      <td class="text-center">
                            <a class="btn btn-warning" href="">Edit</a>
                            <a class="btn btn-danger" href="">Delete</a>
                      </td>
                    </tr>
                    @endforeach                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card -->

            
            <!-- /.card -->
          </div>
          <!-- /.col -->
          
          <!-- /.col -->
        </div>
       

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
@endsection