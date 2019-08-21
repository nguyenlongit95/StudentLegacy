@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Roles / <a href="admin/RoleAndPermission/addRole">Add Roles</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layouts.alert')
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Guard name</th>
                            <th>Time create</th>
                            <th>Time update</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($role as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    {{ $role->guard_name }}
                                </td>
                                <td>
                                    {{ $role->created_at }}
                                </td>
                                <td>
                                    {{ $role->updated_at }}
                                </td>
                                <td class="text-center"><a href="admin/RoleAndPermission/updateRole/{{ $role->id }}" class="btn-warning padding510510">Update</a></td>
                                <td class="text-center"><a href="admin/RoleAndPermission/deleteRole/{{ $role->id }}" class="btn-danger padding510510">Delete</a></td>
                            </tr>
                            @endforeach
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>

            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Permission / <a href="admin/RoleAndPermission/addPermission">Add Permission</a></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('admin.layouts.alert')
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Guard name</th>
                                <th>Create time</th>
                                <th>Update time</th>
                                <th class="text-center">Update</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permission as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>
                                    {{ $permission->name }}
                                </td>
                                <td>
                                    {{ $permission->guard_name }}
                                </td>
                                <td>{{ $permission->created_at }}</td>
                                <td>{{ $permission->updated_at }}</td>
                                <td class="text-center"><a href="admin/RoleAndPermission/updatePermission/{{$permission->id}}" class="btn-warning padding510510">Update</a></td>
                                <td class="text-center"><a href="admin/RoleAndPermission/deletePermission/{{$permission->id}}" class="btn-danger padding510510">Delete</a></td>
                            </tr>
                            @endforeach
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
