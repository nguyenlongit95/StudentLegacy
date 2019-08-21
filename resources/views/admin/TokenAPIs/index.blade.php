@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List categories / <a href="#">Add new</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layouts.alert')
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name API</th>
                            <th>Token API</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>1</td>
                            <td>
                                FacebookAPI
                            </td>
                            <td>
                                Token API
                            </td>
                            <td class="text-center"><a href="admin/APIs/updateAPIs/" class="btn-warning padding510510">Update</a></td>
                            <td class="text-center"><a href="admin/APIs/deleteAPIs/" class="btn-danger padding510510">Delete</a></td>
                        </tr>

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
