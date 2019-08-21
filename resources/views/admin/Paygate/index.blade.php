@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All paygates / <a href="admin/Paygate/config">Config paygate</a> <span style="color:red;">*</span></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layouts.alert')
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Currency</th>
                            <th>Payment</th>
                            <th>Deposit</th>
                            <th>Withdraw</th>
                            <th>Status</th>
                            <th>Created date</th>
                            <th class="text-center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($Paygates) > 0)
                        @foreach($Paygates as $paygates)
                        <tr>
                            <td>{{ $paygates->id }}</td>
                            <td>
                                {{ $paygates->name }}
                            </td>
                            <td>
                               {{ $paygates->code }}
                            </td>
                            <td>
                                @foreach($CurrencyCode as $currencycode)
                                    @if($currencycode->id == $paygates->currency_id)
                                        {{ $currencycode->code }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @if($paygates->payment == 1)
                                    <span style="color:green;">Payment</span>
                                @else
                                    <span style="color:red;">Not payment</span>
                                @endif
                            </td>
                            <td>
                                @if($paygates->deposit == 1)
                                    <span style="color:green;">Deposit</span>
                                @else
                                    <span style="color:red;">Not deposit</span>
                                @endif
                            </td>
                            <td>
                                @if($paygates->withdraw == 1)
                                    <span style="color:green;">Withdraw</span>
                                @else
                                    <span style="color:red;"> Not Withdraw</span>
                                @endif
                            </td>
                            <td>
                                @if($paygates->status == 1)
                                    <span style="color:green;">Active</span>
                                @else
                                    <span style="color:red;"> Not Active</span>
                                @endif
                            </td>
                            <td>
                                @if($paygates->created_at)
                                    {{ $paygates->created_at }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center"><a href="admin/Paygate/deletePaygate/{{$paygates->id}}" class="btn-danger padding510510">Delete</a></td>
                        </tr>
                        @endforeach
                        @else
                            No payment gateway has been installed
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
