@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách khoá học/ <a href="admin/Course/createCourse">Thêm mới</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layouts.alert')
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Purpose</th>
                            <th>Fee</th>
                            <th>Time Study</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Course as $course)
                        <tr>
                            <td>{{ $course->id }}</td>
                            <td>
                                <img src="upload/Course/{{$course->avatar}}" height="100px" width="100px" alt="">
                            </td>
                            <td>
                                {{ $course->name }}
                            </td>
                            <td>
                                {{ $course->description }}}
                            </td>
                            <td>
                                {{ $course->purpose}}
                            </td>
                            <td>
                                {{ $course->fee }}
                            </td>
                            <td>
                                {{ $course->time_limit}}
                            </td>
                            <td class="text-center"><a href="admin/Course/updateCourse/{{$course->id}}" class="btn-warning padding510510">Update</a></td>
                            <td class="text-center"><a href="admin/Course/deleteCourse/{{$course->id}}" class="btn-danger padding510510">Delete</a></td>
                        </tr>
                        @endforeach
                        </tfoot>
                    </table>
                    {!! $Course->render() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </section>
    <!-- /.content -->
@endsection
