@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List email / <a href="admin/Email/Create">New Email</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layouts.alert')
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email address</th>
                            <th>Status</th>
                            <th class="text-center">Active</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($email))
                        @foreach($email as $email)
                        <tr>
                            <td>{{ $email->id }}</td>
                            <td>{{ $email->name }}</td>
                            <td>
                                {{ $email->email }}
                            </td>
                            <td>
                                @if($email->status == 1)
                                    <span style="color:green;">Active</span>
                                @else
                                    <span style="color:red;">DeActive</span>
                                @endif
                            </td>
                            <td class="text-center"><a href="admin/Email/Setting/{{$email->id}}" class="btn btn-primary padding510510">Active</a></td>
                            <td class="text-center"><a href="admin/Email/Update/{{$email->id}}" class="btn btn-warning padding510510">Update</a></td>
                            <td class="text-center"><a href="admin/Email/Delete/{{$email->id}}" class="btn btn-danger padding510510">Delete</a></td>
                        </tr>
                        @endforeach
                        @else
                            Chưa có email nào được thêm
                        @endif
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </section>
    <!-- /.content -->
@endsection
