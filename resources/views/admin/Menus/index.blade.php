@extends('admin.master')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box">
                <section class="sidebar col-md-6 pull-left">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header" style="background: none; font-size: 18px;">System menu</li>
                        @if(count($menu) > 0)
                            @foreach($menu as $key=>$value)
                                @if($value->parent_id == 0)
                                <li class="treeview">
                                    <a href="admin/Menu/menus/{{$value->id}}">
                                        <i class="fa fa-bars"></i>
                                        <span onclick="editItems({{$value->id}})">{{ $value->name }}</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-trash" onclick="deleteItems({{$value->id}})"></i> |
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    @if($value->count_child >= 1)
                                    <ul class="treeview-menu">
                                        @foreach($menu as $child)
                                        @if($child->parent_id == $value->id)
                                            <li>
                                                <a onclick="editItems({{$child->id}})"><i class="fa fa-trash" onclick="deleteItems({{$child->id}})"></i> {{$child->name}}</a>
                                            </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                    @else
                                    @endif
                                </li>
                                @endif
                            @endforeach
                        @else
                        <h4>There are no menus!</h4>
                        @endif
                    </ul>
                </section>
                <section class="sidebar col-md-6 pull-right" id="menu-form">
                    <h3>Add new menu items</h3>
                    <form action="admin/Menu/create" method="POST" class="form-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
                        <label for="name">Name of items</label>
                        <input type="text" name="name" id="nameItems" class="form-control" placeholder="Name of menu items...">
                        <label for="name">Slug this items</label>
                        <input type="text" name="slug" id="slugItems" class="form-control" value="">
                        <label for="name">Parent menu items</label>
                        <select name="parent_id" class="form-control" id="parent_id">
                            <option value="0">-----------------------------------------------------------------</option>
                            @foreach($menu as $key=>$value)
                            <option value="{{ $value->id }}">{{$value->name}}</option>
                            @endforeach
                        </select>
                        <label for="name">Level of menu(1.Header; 2.footer; 3.Sidebar)</label>
                        <select name="level" class="form-control" id="">
                            <option value="1">Headers</option>
                            <option value="2">Footers</option>
                            <option value="3">Sidebar</option>
                        </select>
                        <label for="name">Status</label>
                        <select name="status" class="form-control" id="">
                            <option value="1">Active</option>
                            <option value="0">De Active</option>
                        </select>
                        <label for="name">Sort number</label>
                        <input type="number" name="sort" class="form-control" value="1">
                        <label for="name">Info items</label>
                        <textarea name="info" id="info" class="form-control" cols="30" rows="10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt quam nobis dolorem, tenetur et aspernatur minus quo alias voluptates. Voluptatem magni veniam, nemo est quod recusandae tempore exercitationem quisquam ipsa?</textarea>
                        <input type="submit" name="submit" value="Add items" class="btn btn-success">
                    </form>
                </section>
            </div>
            <!-- /.box -->
        </div>
    </section>
    <!-- /.content -->
    <script src="admin/asset/js/jquery/dist/jquery.min.js"></script>
    <script>
        $('#nameItems').keyup(function(){
            var value = $(this).val();
            var _token = $('#_token').val();
            $.ajax({
                url: 'admin/Menu/changeTitle',
                type: 'post',
                data: {
                    _token : _token,
                    value : value
                },
                success: function(result){
                    $('#slugItems').val(result);
                }
            });
        });
    </script>
    <script>
        function editItems(id){
            $.get('admin/Menu/menus/'+id, function(result){
                $('#menu-form').html(result);
            });
        }
        function deleteItems(id){
            $.get('admin/Menu/menus/delete/'+id, function(result){
                if(result == "deleted"){
                    window.location.reload();
                }else{
                    alert('Errors, please check again system');
                }
            });
        }
    </script>
@endsection
