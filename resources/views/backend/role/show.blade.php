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
                    <h3 class="display-4 text-center">{{ $role->name }}</h3>
                    <h6 class="text-red"><i class="fas fa-lock"> Permissions: </i></h6>
                    <div class="row text-center">
                        @forelse ($role->permissions as $permission)
                        <div class="col-2 m-2 p-2 bg-success text-center">
                            <span>
                                {{ $permission->name }}
                            </span>
                        </div>
                        @empty
                        <li>
                            N/A
                        </li>
                        @endforelse


                    </div>
                </div>
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
