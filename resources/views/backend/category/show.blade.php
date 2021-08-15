@extends('backend.master');

@section('title')
Coupon Create
@endsection
@section('couponActive')
active
@endsection

@section('couponOpen')
menu-is-opening menu-open active
@endsection
@section('couponCreateActive')
bg-success
@endsection


@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Coupon Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
                        <li class="breadcrumb-item active">Caregory Details</li>
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
                    <h3 class="card-title">Caregory Details</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <table class=" table border">
                    <thead>

                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">Category Name:</td>
                            <td>{{$category->category_name}}</td>
                        </tr>
                        <tr>
                            <td scope="row">Slug:</td>
                            <td>{{$category->slug}}</td>
                        </tr>

                        <tr>
                            <td scope="row">Created At:</td>
                            <td>{{$category->created_at->diffForHumans()}}</td>
                        </tr>
                    </tbody>
                </table>
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
    $('#subcategory_name').keyup(function() {
      $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
    });
</script>
@endsection
