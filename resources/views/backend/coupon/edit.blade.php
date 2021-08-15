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
                    <h1 class="m-0">New SubCategory</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('subcategories') }}">Subcategories</a></li>
                        <li class="breadcrumb-item active">Add SubCategory</li>
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
                    <h3 class="card-title">Sub-category Form</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('coupon.update',$coupon) }}">
                    @csrf
                    @method("PUT")
                    <div class="card-body">
                        <div class="form-group">
                            <label for="coupon_name">Coupon Name</label>
                            <input type="text" class="form-control @error('coupon_name') is-invalid @enderror"
                                id="coupon_name" placeholder="Coupon Name" name="coupon_name"
                                value="{{$coupon->coupon_name}}">
                        </div>
                        @error('coupon_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="coupon_amount">Coupon Ammount %</label>
                            <input type="number" class="form-control @error('coupon_amount') is-invalid @enderror"
                                id="coupon_amount" placeholder="Enter Coupon Amount %" name="coupon_amount"
                                value="{{$coupon->coupon_amount}}">
                        </div>
                        @error('coupon_amount')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="coupon_validity">Coupon Validity </label>
                            <input type="date" class="form-control @error('coupon_validity') is-invalid @enderror"
                                id="coupon_validity" placeholder="Enter Coupon Amount %" name="coupon_validity"
                                value="{{$coupon->coupon_validity}}">
                        </div>
                        @error('coupon_validity')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="coupon_limit"> Coupon Limit </label>
                            <input type="number" class="form-control" @error('coupon_limit') is-invalid @enderror"
                                id="coupon_limit" placeholder="Coupon Limit" name="coupon_limit"
                                value="{{$coupon->coupon_limit}}">
                        </div>
                        @error('coupon_limit')
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
    $('#subcategory_name').keyup(function() {
      $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
    });
</script>
@endsection
