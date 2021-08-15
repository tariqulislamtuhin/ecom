@extends('backend.master');

@section('couponActive')
active
@endsection
@section('title')
Trash Coupon
@endsection
@section('couponOpen')
menu-is-opening menu-open active
@endsection

@section('couponDestroyactive')
bg-success
@endsection
@section("content")
<div class="content-wrapper" style="min-height: 1299.69px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 block red">
                    <h1>Trash Table</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Categories</a></li>
                        <li class="breadcrumb-item active">Trashed Data</li>
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
                            <h3 class="card-title"><strong>Trash</strong></h3>
                            <a class="float-right" href="{{ route('category.index') }}">
                                <i class="fa fa-list"> All Categories</i>
                            </a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">

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
                                    @forelse ($trashcoupons as $key => $tcoupon)
                                    <tr>

                                        <td>{{ $trashcoupons->firstItem() + $key }}</td>
                                        <td>{{ $tcoupon->coupon_name }}</td>
                                        <td>{{ $tcoupon->coupon_amount }}%</td>
                                        <td>{{ $tcoupon->coupon_validity }}</td>
                                        <td>{{ $tcoupon->coupon_limit }}</td>
                                        <td>{{ $tcoupon->created_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-Success"
                                                href="{{ route('coupon.restore',$tcoupon)}}">Restore</a>
                                            <a class="btn btn-danger"
                                                href="{{ route('coupon.clean',$tcoupon->id)}}">Delete</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No Data Avaibable</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        {{ $trashcoupons->links() }}
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
