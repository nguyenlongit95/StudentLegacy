@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List orders / <a href="admin/Order/addOrder">Add new</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layouts.alert')
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Users</th>
                            <th>Name users</th>
                            <th>Address ship</th>
                            <th>Phone</th>
                            <th>Total</th>
                            <th>Code order</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                {{ $order->idUser }}
                            </td>
                            <td>
                                {{ $order->name }}
                            </td>
                            <td>{!! $order->address !!}</td>
                            <td>
                                {{ $order->phone }}
                            </td>
                            <td>
                                {{ $order->total }}
                            </td>
                            <td>
                                {{ $order->code_order }}
                            </td>
                            <td class="text-center"><a href="admin/Order/updateOrder/{{$order->id}}" class="btn-warning padding510510">Update</a></td>
                            <td class="text-center"><a href="admin/Order/deleteOrder/{{$order->id}}" class="btn-danger padding510510">Delete</a></td>
                        </tr>
                        @endforeach
                        </tfoot>
                    </table>
                    {{ $Orders->render() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </section>
    <!-- /.content -->
@endsection
