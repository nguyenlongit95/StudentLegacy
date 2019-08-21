@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List contact</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layouts.alert')
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>
                                {{ $contact->name }}
                            </td>
                            <td>
                                {{ $contact->email }}
                            </td>
                            <td>
                                {{ $contact->address }}
                            </td>
                            <td>
                                {!! $contact->message !!}
                            </td>
                            <td>
                                <select onchange="changeState({{ $contact->id }})" name="State" class="form-control" id="StateContact">
                                    <option <?php if($contact->state == 1){echo "selected";} ?> value="1">Approvide</option>
                                    <option <?php if($contact->state == 0){echo "selected";} ?> value="0">Un Approvide</option>
                                </select>
                            </td>
                            <td>
                                <a href="admin/Contact/deleteContact" class="btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                        </tfoot>
                    </table>
                    {!! $Contacts->render() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </section>
    <!-- /.content -->

    <!--
    code JS thay đổi trạng thái của phản hồi
    Dữ liệu truyền đi bao gồm: id của phản hồi và trạng thái muốn thay đổi
    Sử dụng Ajax để truyền dữ liệu đi
    -->
    <script>
        function changeState(id){
            var State = $("#StateContact").val();
            var _token = $("#token").val();
            //alert(State);
            $.ajax({
                url: "admin/Contact/ChangeStatus/" + id,
                type: "POST",
                data: {
                    _token: _token
                },
                success: function (result) {
                    if(result == 1){
                        alert("Change contact success");
                    }else{
                        alert("Change contact fail");
                    }
                }
            });
        }
    </script>

@endsection
