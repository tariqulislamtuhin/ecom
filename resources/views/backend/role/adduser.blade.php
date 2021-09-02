@extends('backend.master');

@section('title')
Add User
@endsection
@section('roleActive')
active
@endsection

@section('roleOpen')
menu-is-opening menu-open active
@endsection
@section('adduserseractive')
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
                    <h1 class="m-0">New User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active">Add User</li>
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
                    <h3 class="card-title">Create New User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="col-6 mx-auto" method="POST" action="{{ route('add.user.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" placeholder="Name" name="name" value="{{old('name')}}">
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" placeholder="Email" name="email" value="{{old('email')}}">
                        </div>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="form-group">
                            <label for="email">Role</label>
                            <select class="form-control" name="role_name" id="">
                                <option value="">--Select--</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
            <!-- /.card -->

        </div>
    </section>
    @else
    <div class="alert alert-danger">You dont' have the privelege.</div>
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


    $('#checkall').click(function(){
        $('input:checkbox').not(this).prop('checked',this.checked);
        $("#submit").show();
    });
</script>

@endsection
