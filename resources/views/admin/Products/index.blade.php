@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List categories / <a href="admin/Product/addProducts">Add new</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layouts.alert')
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name Products</th>
                            <th>Price</th>
                            <th>Sales</th>
                            <th>Info</th>
                            <th>Quantity</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Products as $products)
                        <tr>
                            <td>{{ $products->id }}</td>
                            <td>
                                {{ $products->product_name }}
                            </td>
                            <td>
                                {{ $products->price }}
                            </td>
                            <td>
                                {{ $products->sales }}
                            </td>
                            <td>
                                {!! trimText($products->info,255) !!}
                            </td>
                            <td>
                                {{ $products->quantity }}
                            </td>
                            <td class="text-center"><a href="admin/Product/updateProduct/{{$products->id}}" class="btn-warning padding510510">Update</a></td>
                            <td class="text-center"><a href="admin/Product/deleteProduct/{{$products->id}}" class="btn-danger padding510510">Delete</a></td>
                        </tr>
                        @endforeach
                        </tfoot>
                    </table>
                    {{ $Products->render() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </section>
    <!-- /.content -->
@endsection
