@extends('backend.master');
@section("content")

@section('productactive')
active
@endsection

@section('productopen')
menu-is-opening menu-open active
@endsection

@section('productviewcatactive')
bg-success
@endsection

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
                        <li class="breadcrumb-item active">All Products</li>
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
                            <h3 class="card-title"><strong>Product Table</strong></h3>
                            <a class="float-right" href="#">
                                <i class="fa fa-plus"> Product</i>
                            </a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th style="width: 10px">SL</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Color</th>
                                        <th>Thumbnail</th>
                                        <th>Created At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $key => $product)

                                    <tr>

                                        <td>{{ $products->firstItem() + $key }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->slug }}</td>
                                        <td>
                                            @php
                                            $unique = $product->Atrribute->unique('color_id');
                                            @endphp
                                            @foreach ($unique as $item)
                                            <div class="row">
                                                <div class="col">
                                                    <ul style="color: {{$item->getColor->color_name}};border-style:dotted; background-color:black;
                                                border-color:{{$item->getColor->color_name}};">
                                                        {{$item->getColor->color_name}}
                                                    </ul>
                                                </div>
                                                <div class="col">
                                                    <img src="{{asset('images/'.$item->image)}}" width="75" height="75"
                                                        alt="{{$item->image}}">
                                                </div>

                                            </div>

                                            @endforeach


                                        </td>
                                        <td>
                                            <img src="{{ asset('thumb/'.$product->thumbnail) }}" width="100" alt="">
                                        </td>
                                        <td>{{ $product->created_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-warning"
                                                href="{{ route('EditProduct', $product->slug) }}">Edit</a>
                                            <a class="btn btn-danger"
                                                href="{{ route('DeleteProduct',$product->slug )}}">Delete</a>
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
                        {{ $products->links() }}
                        {{-- <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div> --}}
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
