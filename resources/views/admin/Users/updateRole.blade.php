@extends('admin.master')

@section('content')
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Role</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('admin.layouts.alert')

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Change Roles:</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="admin/RoleAndPermission/updateRole/{{$role->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body row">
                        <div class="form-group col-md-6">
                            <label for="name">Name: </label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Enter Name" value="{{ $role->name or old('name') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="guard_name">Guard Name:</label>
                            <input name="guard_name" type="text" class="form-control" id="guard_name" placeholder="Guard Name" value="{{ $role->guard_name or old('guard_name', 'web') }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="Permissions">Permissions:</label>
                            <select name="permission[]" class="form-control select2" multiple="multiple" data-placeholder="Select Permissions"
                                    style="width: 100%;">
                                @foreach($permission as $value)
                                    @if( in_array($value->id, $rolePermissions) )
                                        <option value="{{ $value->id }}" selected="selected">{{ $value->name }}</option>
                                    @else
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        </div>
            </div>
            <!-- /.col (right) -->
        </div>
        <!-- /.row -->
        <!-- /.content -->
        </div>
    </section>
@endsection
