@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List article / <a href="admin/Article/addArticle">Add new</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layouts.alert')
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Information</th>
                            <th>Author</th>
                            <th>Representative</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Articles as $article)
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>
                                {{ $article->title }}
                            </td>
                            <td>
                                {{ $article->slug }}
                            </td>
                            <td>
                                {!! $article->info !!}
                            </td>
                            <td>
                                {{ $article->author }}
                            </td>
                            <td>
                                <img height="100px" width="100px" src="upload/Articles/{{ $article->images }}" alt="{{ $article->title }}">
                            </td>
                            <td class="text-center"><a href="admin/Article/updateArticle/{{$article->id}}" class="btn-warning padding510510">Update</a></td>
                            <td class="text-center"><a href="admin/Article/deleteArticle/{{$article->id}}" class="btn-danger padding510510">Delete</a></td>
                        </tr>
                        @endforeach
                        </tfoot>
                    </table>
                    {!! $Articles->render() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </section>
    <!-- /.content -->
@endsection
