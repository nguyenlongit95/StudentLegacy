@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5">
                    <h4 style="margin-bottom: 15px;" class="pull-left">Widgets the page settings controll / <button class="btn btn-primary" id="btnAddWidgets" onclick="openForm()" class="pull-right">Add new</button>
                    </h4>
                </div>
                <div class="col-md-7">
                    <form action="admin/Widgets/addWidgets" method="post" id="formAddNewWidgets" style="display:none;">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <div class="col-md-4">
                            <input name="key" class="form-control" type="text" value="key...">
                        </div>
                        <div class="col-md-4">
                        <input name="value" class="form-control" type="text" value="value...">
                        </div>
                        <div class="col-md-4">
                        <input name="submit" class="btn btn-primary"  type="submit" value="Add">
                        <input name="submit" class="btn btn-danger" type="button" onclick="closeForm()" value="Close">
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            @if(count($Widgets) > 0)
            @foreach($Widgets as $key=>$value)
            <div class="col-md-6 pull-left">
                <div class="col-md-12" style="margin-top:10px;">
                    <form action="" method="POST">
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <div class="col-md-3 pull-left">{{ $value->key }}</div>
                        <div class="col-md-7 pull-left">
                            <input type="text" class="form-control" value="{!! $value->value !!}" id="{{ $value->key }}" name="value">
                        </div>
                        <div class="col-md-2 pull-left">
                            <a onclick="updateWidgets({{ $value->id }},{{ $value->key }})"><i class="fa fa-edit"></i></a> |
                            <a href="admin/Widgets/delete/{{ $value->id }}"><i class="fa fa-trash"></i></a>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        </div>
    </section>
    <!-- /.content -->
    <script src="admin/asset/js/jquery/dist/jquery.min.js"></script>
    <script>

    </script>
    <script>
        function updateWidgets(id, key){
            var value = $(key).val();
            var _token = $('#_token').val();
            $.ajax({
                url: 'admin/Widgets/update/' + id,
                type: 'post',
                data: {
                    _token: _token,
                    id : id,
                    value : value
                },
                success: function(result){
                    if(result == "success"){
                        window.location.reload();
                    }else{
                        alert('The request has errors, please check again!');
                    }
                }
            });
        }
        function closeForm(){
            $('#formAddNewWidgets').fadeOut(500);
        }
        function openForm(){
            $('#formAddNewWidgets').fadeIn(500);
        }
    </script>
@endsection
