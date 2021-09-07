@extends('backend.master');

@section('title')
Role Details
@endsection
@section('roleActive')
active
@endsection

@section('roleOpen')
menu-is-opening menu-open active
@endsection
@section('roleIndexactive')
bg-success
@endsection


@section('content')

<div class="content-wrapper">
    @can('assign user')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Role Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active">Role Details</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="col-md mx-auto">
            <!-- general form elements -->
            <div class="card card-Warning">
                <div class="card-header">
                    <h3 class="card-title">Users Roles</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <h3 class="text-center">{{ $role->name }} <a href="{{route('role.edit',$role)}}"> <i class=" small fas fa-edit"></i></a> </h3>
                    <h5 class="alert alert-success text-bold"><i class="fas fa-lock"> Permissions: </i></h5>
                    <hr size="10" color="black">
                    <div class="row">
                        @forelse ($role->permissions as $permission)
                        <strong class="col-3">
                             <button class="mb-2 btn btn-block btn-default btn-md">{{ $permission->name }}</button>
                        </strong>
                         @empty

                        @endforelse
                    </div>
                    <hr size="10" color="black">

                     {{-- <div class="row">
                        @forelse ($role->permissions as $permission)
                        <a class="col-2 btn btn-app bg-danger">
                            <i class="fas fa-lock"></i> <strong>{{ $permission->name }}</strong>
                        </a>
                        <button type="button" class="btn btn-outline-primary btn-block col-2 mr-2 ">
                            <i class="fa fa-lock"></i> {{ $permission->name }}
                        </button>
                        @empty
                        <li>
                            N/A
                        </li>
                        @endforelse


                    </div> --}}
                </div>
            </div>
            <!-- /.card -->

        </div>
    </section>
    @else
    <script>
          window.history.back()
      </script>
    @endcan
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
