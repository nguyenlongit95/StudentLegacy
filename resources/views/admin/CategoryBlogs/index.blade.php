@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List categories / <a href="admin/Categories/addCategoriesBlog">Add new</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layouts.alert')
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name Categories</th>
                            <th>Info</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($CategoryBlogs as $categoryBlog)
                        <tr>
                            <td>{{ $categoryBlog->id }}</td>
                            <td>
                                {{ $categoryBlog->nameCategory }}
                            </td>
                            <td>
                                {{ $categoryBlog->info }}
                            </td>
                            <td class="text-center"><a href="admin/Categories/updateCategoriesBlog/{{$categoryBlog->id}}" class="btn-warning padding510510">Update</a></td>
                            <td class="text-center"><a href="admin/Categories/deleteCategoriesBlog/{{$categoryBlog->id}}" class="btn-danger padding510510">Delete</a></td>
                        </tr>
                        @endforeach
                        </tfoot>
                    </table>
                    {!! $CategoryBlogs->render() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </section>
    <!-- /.content -->
@endsection
