@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Link Seo / <a href="admin/Seo/addSeo">Add new</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layouts.alert')
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Link</th>
                            <th>Title</th>
                            <th>Keywords</th>
                            <th>Description</th>
                            <th>Heading</th>
                            <th>Avatar</th>
                            <th>Language</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Seo as $seo)
                        <tr>
                            <td>{{ $seo->id }}</td>
                            <td>
                                {{ $seo->link }}
                            </td>
                            <td>
                                {{ $seo->title }}
                            </td>
                            <td>{{ $seo->keywords }}</td>
                            <td>
                                {!! trim($seo->description, 255) !!}
                            </td>
                            <td>
                                {{ $seo->h1 }}
                            </td>
                            <td>
                                <img width="100px" src="{{ asset('upload/Seo/'.$seo->avatar) }}" alt="">
                            </td>
                            <td>
                                {{ $seo->language }}
                            </td>
                            <td class="text-center"><a href="admin/Seo/updateSeo/{{$seo->id}}" class="btn-warning padding510510">Update</a></td>
                            <td class="text-center"><a href="admin/Seo/deleteSeo/{{$seo->id}}" class="btn-danger padding510510">Delete</a></td>
                        </tr>
                        @endforeach
                        </tfoot>
                    </table>
                    {!! $Seo->render() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </section>
    <!-- /.content -->
@endsection
