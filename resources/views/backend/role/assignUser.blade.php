@extends('backend.master');

@section('title')
Coupon Create
@endsection
@section('roleActive')
active
@endsection

@section('roleOpen')
menu-is-opening menu-open active
@endsection
@section('assignUseractive')
bg-success
@endsection


@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Assign User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('assignuser.index') }}">Coupons</a></li>
                        <li class="breadcrumb-item active">Assign User</li>
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
                    <h3 class="card-title">Edit Form Assign User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('assignuser.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="user_name">Assign User Name</label>
                            <select class="form-control" name="user_name">
                                <option value="">select</option>
                                @forelse ($users as $user)

                                <option value="{{$user->id}}">{{$user->name}}({{$user->email}})</option>
                                @empty

                                @endforelse
                            </select>
                        </div>
                        @error('user_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="role_name">Assign Role</label>
                            <select class="form-control" name="role_name">
                                <option value="">select</option>
                                @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('role_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
            <!-- /.card -->

        </div>
    </section>
    <section class="content">
        <div class="col-md mx-auto">
            <!-- general form elements -->
            <div class="card card-Warning">
                <div class="card-header">
                    <h3 class="card-title">User Roles</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <table class=" mt-3 table table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th>User</th>
                                <th>Role & Permissions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td scope="row">{{$user->name}}</td>
                                <td>
                                    @forelse ($user->roles as $role)
                                    @if ($loop->index > 0)
                                    <br>
                                    @endif
                                    <h4 class="display text-info"><i class="fas fa-user"> {{ $role->name }}</i></h4>
                                    @forelse ($role->permissions as $permission)
                                    @if ($loop->index == 0)
                                    <h6 class="text-red"><i class="fas fa-lock"> Permissions: </i></h6>
                                    @endif
                                    @if ((($loop->index + 1) % 10) == 0)
                                    <br>
                                    @endif
                                    {{ $permission->name }}
                                    @empty

                                    @endforelse
                                    @empty
                                    <h4>N/A</h4>
                                    @endforelse
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td scope="row"></td>
                                <td scope="row"></td>
                            </tr>
                            @endforelse


                        </tbody>
                    </table>
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
