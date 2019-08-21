@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Comment</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layouts.alert')
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Author</th>
                            <th>Comment</th>
                            <th>State</th>
                            <th class="text-center">Details</th>
                            <th class="text-center">Reply</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Comment as $comment)
                            <?php if($comment->parent_id == 0){ ?>
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>
                                {{ $comment->author }}
                            </td>
                            <td>
                                {{ $comment->comment }}
                            </td>
                            <td>
                                <?php if($comment->state == 1){
                                    echo "Approved";
                                }else{
                                    echo "Un Approved";
                                } ?>
                            </td>
                            <td class="text-center"><a href="admin/Comment/Comments/{{$comment->id}}" class="btn-warning padding510510">Details</a></td>
                            <td class="text-center"><a href="admin/Comment/addComment/{{$comment->id}}" class="btn-success padding510510">Reply</a></td>
                        </tr>
                        <?php }else{} ?>
                        @endforeach
                        </tfoot>
                    </table>
                </div>
                {!! $Comment->render() !!}
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </section>
    <!-- /.content -->
@endsection
