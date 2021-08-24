@extends('backend.master');

@section('title')
Role Create
@endsection
@section('roleActive')
active
@endsection

@section('roleOpen')
menu-is-opening menu-open active
@endsection
@section('roleCreateActive')
bg-success
@endsection


@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New Role</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active">Add Role</li>
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
                    <h3 class="card-title">Create New Role</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('role.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="role_name">Role Name</label>
                            <input type="text" class="form-control @error('role_name') is-invalid @enderror"
                                id="role_name" placeholder="Role Name" name="role_name" value="{{old('role_name')}}">
                        </div>
                        @error('role_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="text-bold">
                            <label class="custom-label">Choose Permission from Here.</label>
                            <span class="ml-5">
                                <input class="custom-control-input" type="checkbox" id="checkall">
                                <label for="checkall" class="custom-control-label mb-3">Check All</label>
                            </span>
                            @if (session()->has('per_error'))
                            <div class="alert alert-danger">
                                {{session()->get('per_error')}}</div>
                            @endif
                        </div>

                        @error('permissions')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        @foreach ($permissions as $permission)
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox"
                                    id="customCheckbox{{$permission->id}}" value="{{$permission->name}}"
                                    name="permissions[]">
                                <label for="customCheckbox{{$permission->id}}"
                                    class="custom-control-label">{{$permission->name}}</label>
                            </div>
                        </div>
                        @endforeach


                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
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


    $('#checkall').click(function(){
        $('input:checkbox').not(this).prop('checked',this.checked);
        $("#submit").show();
    });
</script>

@endsection
