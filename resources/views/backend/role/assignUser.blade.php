@extends('backend.master');

@section('title')
Assign User
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
    @can('assign user')
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
                                <option value="">--Select--</option>

                                @forelse ($users as $user)
                                @if (Auth::user()->id == $user->id) @continue
                                @else
                                    <option value="{{$user->id}}">{{$user->name}}({{$user->email}})  {{ $user->roles->first()->name ?? " "}}</option>
                                @endif
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
                                <option value="">--Select--</option>
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
                    <h3 class="card-title">Users Roles</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <table class=" mt-3 table table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th class="col-2">User</th>
                                <th class="col-10">Role & Permissions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            @if(Auth::user()->id == $user->id) @continue
                             @else
                                    <tr>
                                        <td class="bg-info text-center">
                                            <h5>{{$user->name}}</h5>
                                        </td>
                                        <td>
                                            <br>
                                            @forelse ($user->roles as $role)
                                                <a class="text-dark text-bold" href="{{ route('role.show',$role->id)}}">
                                                    <h4 class="display text-info"><i class="fas fa-user" data-toggle="tooltip" data-placement="left" title="Role"></i> {{ $role->name }}
                                                        @if (Auth::user()->hasRole('Super Admin'))
                                                        <a class="small" href="{{ route('revokeuser',[$role,$user]) }}">
                                                            <i class="small fas fa-trash-alt" data-toggle="tooltip" data-placement="right" title="Delete"
                                                            ></i>
                                                        </a>
                                                        @endif
                                                    </h4>
                                                </a>


                                                <div class="text-red">
                                                    <i class="fas fa-lock" data-toggle="tooltip" data-placement="left" title="Permissions"></i>
                                                    <strong> Permissions: </strong>
                                                </div>
                                                <div class="row">
                                                    @forelse ($role->permissions as $permission)
                                                    <span class="col-3"><li class="small">{{ $permission->name }}</li></span>
                                                    @empty
                                                    @endforelse
                                                </div>

                                            @empty
                                            <h4>N/A</h4>
                                            @endforelse
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                     <td colspan="50" class="text-center">No Data Avilable</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>

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
</script>


@endsection
