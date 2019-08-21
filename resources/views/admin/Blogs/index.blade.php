@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Blogs / <a href="admin/Blog/addBlogs">Add new</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layouts.alert')
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Info</th>
                            <th>Description</th>
                            <th>Author</th>
                            <th>Tags</th>
                            <th>Image Blogs</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Blogs as $blogs)
                        <tr>
                            <td>{{ $blogs->id }}</td>
                            <td>
                                {{ $blogs->title }}
                            </td>
                            <td>
                              {!! trimText($blogs->info, 100) !!}
                            </td>
                            <td>
                                {!!  trimText($blogs->description, 255) !!}
                            </td>
                            <td>
                                {{ $blogs->author }}
                            </td>
                            <td>
                                {{ $blogs->tags }}
                            </td>
                            <td>
                                <img src="upload/Blogs/{{$blogs->image}}" height="100px" width="100px" alt="">
                            </td>
                            <td class="text-center"><a href="admin/Blog/updateBlog/{{$blogs->id}}" class="btn-warning padding510510">Update</a></td>
                            <td class="text-center"><a href="admin/Blog/deleteBlog/{{$blogs->id}}" class="btn-danger padding510510">Delete</a></td>
                        </tr>
                        @endforeach
                        </tfoot>
                    </table>
                    {!! $Blogs->render() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </section>
    <!-- /.content -->
@endsection
