@extends('backend.master')

@section('coupon')
Coupons
@endsection

@section('couponActive')
active
@endsection

@section('couponOpen')
menu-is-opening menu-open active
@endsection

@section('couponIndexactive')
bg-success
@endsection

@section("content")
<div class="content-wrapper" style="min-height: 1299.69px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Coupon Tables</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('coupon.index')}}">Coupons</a></li>
                        <li class="breadcrumb-item active">Coupons</li>
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
                            <h3 class="card-title">Coupon Table</h3>
                            <a class="float-right" href="{{ route('coupon.create') }}">
                                <i class="fa fa-plus"> Coupon</i>
                            </a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">

                            <table class="table table-striped table-bordered">

                                <thead>
                                    <tr>
                                        <th style="width: 10px">SL</th>
                                        <th>Coupon Name</th>
                                        <th>Coupon Amount %</th>
                                        <th>Coupon Validity</th>
                                        <th>Coupon Limit</th>
                                        <th>Created At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($Coupons as $key => $Coupon)
                                    <tr>
                                        <td>{{ $Coupons->firstitem() + $key }}</td>
                                        <td>{{ $Coupon->coupon_name}}</td>
                                        <td>{{ $Coupon->coupon_amount }}%</td>
                                        <td>{{ $Coupon->coupon_validity }}</td>
                                        <td>{{ $Coupon->coupon_limit }}</td>
                                        <td>{{ $Coupon->created_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-info" href="{{ route('coupon.show',$Coupon)}}">Details</a>
                                            <a class="btn btn-danger" href="{{route('coupon.edit',$Coupon)}}">Edit</a>

                                            <form method="POST" action="{{ route('coupon.destroy',$Coupon) }}"
                                                style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure?')"
                                                    class="btn btn-warning">Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="50" class="text-center">No Data Avilable</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        {{ $Coupons->links() }}

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





</script>
@endsection
