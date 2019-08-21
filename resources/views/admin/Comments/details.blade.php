@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">
            @include('admin.layouts.alert')
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Comment of: {{ $Comment->Author }}</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Author</th>
                                <th>Comment</th>
                                <th>Comment of blog</th>
                                <th>Status</th>
                                <th class="text-center">Update</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <tr>
                                    <td>{{ $Comment->id }}</td>
                                    <td>
                                        {{ $Comment->author }}
                                    </td>
                                    <td>
                                        <?php echo trimText($Comment->comment,30); ?>
                                    </td>
                                    <td>
                                        {{ $Blog->title }}
                                    </td>

                                    <td>
                                       <?php if($Comment->state == 1){ echo "Approved";}else if($Comment->state == 0){echo "Pending";} ?>
                                    </td>

                                    <td class="text-center">
                                        <a href="admin/Comment/updateComment/{{ $Comment->id }}" class="btn-warning" style="padding:5px 8px 5px 8px;">Update</a>
                                    </td>
                                    <td>
                                        <a href="admin/Comment/deleteComment/{{ $Comment->id }}" class="btn-danger" style="padding:5px 8px 5px 8px;">Delete</a>
                                    </td>
                                </tr>
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
                        <h3 class="box-title">Reply comment of: {{ $Comment->author }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Account</th>
                                <th>Author</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th class="text-center">Update</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($Reply as $reply)
                                <form action="admin/Comment/updateComment/{{$reply->id}}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <tr>
                                <td>{{ $reply->id }}</td>
                                <td>
                                    {{ $User->name }}
                                </td>
                                <td>
                                    {{ $reply->author }}
                                </td>
                                <td>
                                    <?php echo trimText($Comment->comment,30); ?>
                                </td>
                                <td>
                                    <?php if($reply->state == 1){ echo "Approved";}else if($reply->state == 0){echo "Pending";} ?>
                                </td>

                                <td class="text-center">
                                    <a href="admin/Comment/updateComment/{{$reply->id}}" class="btn-warning" style="padding:5px 8px 5px 8px;">Update</a>
                                </td>
                                <td>
                                    <a href="admin/Comment/deleteComment/{{$reply->id}}" class="btn-danger" style="padding:5px 8px 5px 8px;">Delete</a>
                                </td>
                            </tr>
                                </form>
                            @endforeach
                            </tfoot>
                        </table>
                        {!! $Reply->render() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
