@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách bài đăng/ <a href="admin/Blog/addBlogs">Add new</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layouts.alert')
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>HashTag</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Images</th>
                            <th>Files</th>
                            <th class="text-center">Publish</th>
                            <th class="text-center">Reject</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Post as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>
                                {{ $post->type }}
                            </td>
                            <td>
                                {!! trimText($post->hash_tag, 100) !!}
                            </td>
                            <td>
                                {!!  trimText($post->title, 255) !!}
                            </td>
                            <td>
                                {{ $post->content }}
                            </td>
                            <td>
                                <img src="upload/Post/{{$post->image_enclose}}" height="100px" width="100px" alt="">
                            </td>
                            <td>
                                {{ $post->files}}
                            </td>
                            <td class="text-center"><a href="admin/Post/publicPost/{{$post->id}}" class="btn-warning padding510510">Publish</a></td>
                            <td class="text-center"><a href="admin/Post/rejectPost/{{$post->id}}" class="btn-danger padding510510">Reject</a></td>
                        </tr>
                        @endforeach
                        </tfoot>
                    </table>
                    {!! $Post->render() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </section>
    <!-- /.content -->
@endsection
