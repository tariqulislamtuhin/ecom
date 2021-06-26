@extends('backend.master');

@section('productactive')
active
@endsection

@section('productopen')
menu-is-opening menu-open active
@endsection

@section('productaddcatactive')
bg-success
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">New Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Sell All Categories</a></li>
              <li class="breadcrumb-item active">New Product Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="col-md mx-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title ">Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('product.post') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Product name" name="title">
                  </div>
                  @error('title')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

                  {{-- <div class="form-group">
                    <label for="slug"> Slug </label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" placeholder="Slug"name="slug">
                  </div>
                  @error('slug')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror --}}

                  <div class="form-group">
                    <label for="thumbnail">Product Thumbnail </label>
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnailid" placeholder="thumbnail" name="thumbnail">
                  </div>
                  @error('thumbnail')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="row">
                      <div class="form-group col-6">
                        <label for="category"> Category</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                          <option value="">Select</option>
                          @foreach ($cats as $cat)
                              <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('category')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                      <div class="form-group col-6">
                        <label for="subcategory_id"> Subcategory</label>
                        <select class="form-control @error('subcategory_id') is-invalid @enderror" name="subcategory_id" id="subcategory_id">
                          <option value="">Select</option>

                        </select>
                      </div>
                      @error('subcategory_id')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                </div>

                  <div class="form-group">
                    <label for="summery"> Summery </label>
                    <input type="text" class="form-control @error('summery') is-invalid @enderror" id="summery" placeholder="Summery"name="summery">
                  </div>
                  @error('summery')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

                  <div class="form-group">
                    <label for="slug"> Description </label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Description"></textarea>
                  </div>
                  @error('description')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
    </section>
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
    $('#title').keyup(function() {
      $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
    });

    $('#category_id').change(function(){
      var category_id = $(this).val();
      if (category_id) {
        $.ajax({
          type:"Get",
          url:"{{ ('api/get-subcat-list') }}/"+category_id,
          success:function(res){
            if (res) {
              $("#subcategory_id").empty();
              $("#subcategory_id").append('<option>Select</option>');
              $.each(res,function(key,value){
                $("#subcategory_id").append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');

              });
              
              
            }else{
              $("#subcategory_id").empty();
            }

          }
        });
        
      }else{

      }
    });
</script>
@endsection