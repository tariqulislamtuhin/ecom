@extends('backend.master');

@section('scategoryactive')
active
@endsection

@section('scatopen')
menu-is-opening menu-open active
@endsection

@section('sviewcatactive')
active
@endsection

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
              <li class="breadcrumb-item"><a href="{{'dashboard'}}">Dashboard</a></li>
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
                <h3 class="card-title"><strong>Bordered Table</strong></h3>
                <a class="float-right" href="{{ url('add-subcategory') }}">
                  <i class="fa fa-plus"> Add SubCategory</i>
                </a>
              </div>
             
              <!-- /.card-header -->
              <div class="card-body">
                
                <table class="table table-bordered">
                  
                  <thead>
                    <tr>
                      <th ><input type="checkbox" id="checkall"> All</th>
                      <th style="width: 10px">SL</th>
                      <th>Sub Category</th>
                      <th>Category</th>
                      <th>Slug</th>
                      <th>Created At</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @forelse ($subcats as $key => $data)
                    <tr>
                       <td> <input type="checkbox" id="checkbox" name="delete[]" value="{{ $data->id }}"></td>
                      <td>{{ $subcats->firstItem() + $key }}</td>
                      <td>{{ $data->subcategory_name }}</td>
                      <td>{{ $data->Category->category_name }}</td>
                      <td>{{ $data->slug }}</td>
                      <td>{{ $data->created_at->format('d-M-Y h:i:s a') }} ({{ $data->created_at->diffForHumans() }})</td>
                      <td class="text-center">
                            <a class="btn btn-warning" href="{{ route('editsubcategories',$data->slug) }}">Edit</a>
                            <a class="btn btn-danger" href="{{ route('editsubcategories',$data->slug)}}">Delete</a>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="10" class="text-center">No Data Avilable</td>
                    </tr>
                    @endforelse
                                 
                  </tbody> 
                </table>

                
              </div>
              <!-- /.card-body -->
              {{ $subcats->links() }}
              
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

  @section("toastr_js")
  <script>
    @if (session('success'))
    Command: toastr["success"]("{{ session('success') }}")

      toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      @endif

      
      
      
      
  </script>
  @endsection