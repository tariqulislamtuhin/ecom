@extends('backend.master');

@section('title')
Coupon Details
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
                        <li class="breadcrumb-item"><a href="{{ route('coupon.index') }}">Coupons</a></li>
                        <li class="breadcrumb-item active">Coupon Details</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="col-md mx-auto">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header text-center">
                    <h3 class="card-title text-center">Coupon Details</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <table class="table table-striped table-success table-bordered">
                    <thead>

                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Coupon Name</th>
                            <th>{{$coupon->coupon_name}}</th>
                        </tr>
                        <tr>
                            <th scope="row">Coupon Amount</th>
                            <th>{{$coupon->coupon_amount}}%</th>
                        </tr>
                        <tr>
                            <th scope="row">Coupon Validity</th>
                            <th>{{$coupon->coupon_validity}}</th>
                        </tr>
                        <tr>
                            <th scope="row">Coupon limit</th>
                            <th>{{$coupon->coupon_limit}}</th>
                        </tr>
                        <tr>
                            <th scope="row">Created At</th>
                            <td>
                                {{$coupon->created_at->diffForHumans()}}&nbsp{{$coupon->created_at->format('<d-M-Y></d-M-Y> ( h: i a)')}}
                            </td>
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

    @if (session('error'))
    Command: toastr["error"]("{{ session('error') }}")

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
