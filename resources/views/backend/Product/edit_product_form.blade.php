@extends('backend.master');


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">New Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('products.view') }}">Products</a></li>
              <li class="breadcrumb-item active">Add a Product</li>
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
                <h3 class="card-title">New Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('UpdateProduct') }}"enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Product name" value="{{ $product->title }}" name="title">
                  </div>
                  @error('title')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="thumbnail">Product Thumbnail </label>
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" value="value="{{ asset('thumb'.$product->title) }}"" id="thumbnailid" placeholder="thumbnail" name="thumbnail">
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

                        <option @if ($product->category_id == $cat->id) selected @endif value="{{ $cat->id }}">{{ $cat->category_name }}</option>    
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
                        @foreach ($scat as $scat)
                        <option @if ($product->subcategory_id == $scat->id) selected @endif value="{{ $scat->id }}">{{ $scat->subcategory_name }}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('subcategory_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="summery"> Summery </label>
                    <input type="text" class="form-control @error('summery') is-invalid @enderror" value="{{ $product->summery }}" id="summery" placeholder="Summery"name="summery">
                  </div>
                  @error('summery')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

                  <div class="form-group">
                    <label for="slug"> Description </label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Description">{{ $product->description }}</textarea>
                  </div>
                  @error('description')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

                  {{-- <div class="form-group">
                    <label for="slug"> Slug </label>
                    <input type="text" class="form-control" id="slug" placeholder="Slug"name="slug">
                  </div> --}}
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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
</script>
@endsection