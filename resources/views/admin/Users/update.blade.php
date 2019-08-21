@extends('admin.master')

@section('content')
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Categories</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('admin.layouts.alert')
                <div class="row">
                    <div class="col-md-6">
                        <form action="admin/User/updateUser/{{ $User->id }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Update form data element</h3>
                                </div>
                                <div class="box-body">
                                    <!-- Date mm/dd/yyyy -->
                                    <div class="form-group">
                                        <label for="">Your name <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-edit fa-pen-alt"></i>
                                            </div>
                                            <input type="text" name="name" class="form-control" value="{{ $User->name }}">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->

                                    <!-- phone mask -->
                                    <div class="form-group">
                                        <label>Your Email <span style="color:red;">*</span></label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-align-left"></i>
                                            </div>
                                            <input type="email" name="email" class="form-control" value="{{ $User->email }}">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->

                                    <!-- phone mask -->
                                    <div class="form-group">
                                        <label>Your password <span style="color:red;">*</span></label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-align-left"></i>
                                            </div>
                                            <input disabled type="password" name="password" class="form-control" value="{{ $User->password }}">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->

                                    <!-- phone mask -->
                                    <div class="form-group">
                                        <label>Your avatar <span style="color:red;">*</span></label>
                                        <img src="upload/Avatar/{{ $User->avatar }}" height="100px" width="100px" alt="{{ $User->name }}">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-align-left"></i>
                                            </div>
                                            <input type="file" name="avatar" class="form-control" value="{{ $User->avatar }}">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->

                                    <!-- phone mask -->
                                    <div class="form-group">
                                        <label>Authentication this user <span style="color:red;">*</span></label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-compress"></i>
                                            </div>
                                            <SELECT class="form-control" name="Level">
                                                <option <?php if($User->level == 0 ){echo "selected";} ?> value="0">Customer</option>
                                                <option <?php if($User->level == 1 ){echo "selected";} ?> value="1">Adminstator</option>
                                            </SELECT>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->


                                    <!-- IP mask -->
                                    <div class="form-group">
                                        <label>Submit data:</label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-paper-plane"></i>
                                            </div>
                                            <input type="submit" class="form-control" value="Submit">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->

                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </form>
                    </div>

                    <div class="col-md-6">
                        <!-- Upload avatar tại đây -->
                        <?php //var_dump($roles); ?>
                        <?php //var_dump($userRole); ?>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Roles</th>
                                <th>Authentication</th>
                                <th class="text-center">Give</th>
                                <th class="text-center">Revoke</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $roles)
                                <form action="admin/RoleAndPermission/GiveRoleUser/{{ $User->id }}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <tr>
                                        <td>{{ $roles->name }}</td>
                                        <td>{{ $roles->guard_name }}</td>
                                        <!-- Tiếp tục code ở đây -->

                                        <?php foreach($userRole as $u){?>
                                        <td><input type="radio" onclick="GiveUser({{$User->id}},{{$roles->id}},1)" <?php if($u->id == $roles->id){echo "checked";}else{} ?> name="Give" value="1">Give</td>
                                        <td><input type="radio" onclick="GiveUser(0)" <?php if($u->id != $roles->id){echo "checked";}else{} ?> name="Give" value="0">Revoke</td>
                                        <?php } ?>
                                    </tr>
                                </form>
                                @endforeach
                            </tbody>
                        </table>

                        <p>
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore quibusdam odit culpa aspernatur ex voluptas soluta doloremque exercitationem deserunt dicta vel nemo, et enim fugit expedita ullam laudantium minus quam.
                        </p>
                    </div>
                </div>
            </div>
            <!-- /.col (right) -->
        </div>
        <!-- /.row -->
        <!-- /.content -->
        </div>

        <script>
            /*
            * Function này sẽ nhận vào 3 tham số
            * Giá trị của radio để xác định xem phân chức danh hay thu hồi chức danh của người dùng này
            * id của user
            * id của chức danh
            * sử dụng ajax để gửi dữ liệu và thay đổi chức danh của tài khoản.
            * */
            function GiveUser(id_user,idRole,value){
                $(document).ready(function(){
                   var check = confirm("Would you like to change this user's permissions?");
                   if(check == true){
                       // sử dụng ajax ở đây
                       alert(value);
                       alert(idRole);
                       alert(id_user);
                   }else{

                   }
                });
            }
        </script>
    </section>
@endsection
