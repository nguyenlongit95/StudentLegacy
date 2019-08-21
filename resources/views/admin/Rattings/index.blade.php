@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List ratting</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layouts.alert')
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Star number</th>
                            <th>Info</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Rattings as $rattings)
                        <tr>
                            <td>{{ $rattings->id }}</td>
                            <td>
                                <?php
                                for ($i=1; $i <= $rattings->Ratting; $i++){
                                    echo '<i class="fa fa-star"></i>';
                                }
                                ?>
                            </td>
                            <td>
                                {{ $rattings->Info }}
                            </td>
                            <td class="text-center"><a href="admin/Ratting/updateRattings/{{$rattings->id}}" class="btn-warning padding510510">Update</a></td>
                            <td class="text-center"><a href="admin/Ratting/deleteRattings/{{$rattings->id}}" class="btn-danger padding510510">Delete</a></td>
                        </tr>
                        @endforeach
                        </tfoot>
                    </table>
                    {!! $Rattings->render() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </section>
    <!-- /.content -->
@endsection
