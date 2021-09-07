@extends('backend.master')

@section('role')
roles
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

@section("content")
<div class="content-wrapper" style="min-height: 1299.69px;">
    <!-- Content Header (Page header) -->
    @can('assign user')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>role Tables</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('role.index')}}">Roles</a></li>
                        <li class="breadcrumb-item active">roles</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            {{-- @can()

            @endcan --}}
            <div class="row">
                <div class="col-md">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">role Table</h3>
                            <a class="float-right" href="{{ route('role.create') }}">
                                <i class="fa fa-plus"> Add Role</i>
                            </a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">

                            <table class="table table-striped table-bordered">

                                <thead>
                                    <tr>
                                        <th style="width: 10px">SL</th>
                                        <th>Role Name</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <a class="text-dark text-bold" href="{{ route('role.show',$role->id)}}">{{ $role->name}}</a>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-info" href="{{ route('role.show',$role->id)}}">Details</a>
                                            <a class="btn btn-danger" href="{{route('role.edit',$role->id)}}">Edit</a>

                                            <form method="POST" action="{{ route('role.destroy',$role) }}"
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
                        {{-- {{ $roles->links() }} --}}

                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <!-- /.col -->
            </div>


        </div><!-- /.container-fluid -->
    </section>
    @else
      <script>
          window.history.back()
      </script>
 @endcan
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


