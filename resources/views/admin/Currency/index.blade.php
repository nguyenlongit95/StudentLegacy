@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="box">
                <div class="box-body">
                    @include('admin.layouts.alert')
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Vname</th>
                            <th>Symbol</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($Currency) > 0)
                        @foreach($Currency as $currency)
                        <tr>
                            <td>{{ $currency->id }}</td>
                            <td>{{ $currency->code }}</td>
                            <td>{{ $currency->name }}</td>
                            <td>@if($currency->vname)
                                    {{ $currency->vname }}
                                @else
                                    -
                                @endif

                            </td>
                            <td>@if($currency->symbol)
                                    {!! $currency->symbol !!}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @else
                            Chưa có đồng ngoại tệ nào được cài đặt!
                        @endif
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
