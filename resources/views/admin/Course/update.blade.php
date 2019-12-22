@extends('admin.master')

@section('content')

    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Update Course</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('admin.layouts.alert')
                <div class="row">
                    <form action="admin/Course/updateCourse/{{ $Course->id }}" method="POST" enctype="multipart/form-data">
                    <div class="col-md-9">
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Add form data element</h3>
                                </div>
                                <div class="box-body">
                                    <!-- Date mm/dd/yyyy -->
                                    <div class="form-group">
                                        <label for="">Name Course <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-edit fa-pen-alt"></i>
                                            </div>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="name of course" value="{{$Course->name}}">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->

                                    <!-- Date mm/dd/yyyy -->
                                    <div class="form-group">
                                        <label for="">Purpose<span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-edit fa-pen-alt"></i>
                                            </div>
                                            <input type="text" name="purpose" id="purpose" class="form-control" placeholder="purpose of course" value = "{{$Course->purpose}}">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->

                                    <!-- phone mask -->
                                    <div class="form-group">
                                        <label>Description <span style="color:red;">*</span></label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-align-left"></i>
                                            </div>
                                            <textarea name="description" class="form-control ckeditor" id="description" cols="30" rows="30">{{ $Course->description}}</textarea>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                    </div>

                    <div class="col-md-3">
                        <div class="box box-danger">
                            <div class="box-header">
                                <h3 class="box-title">Orther Info</h3>
                            </div>
                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Fee<span style="color:red;">*</span></label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-align-left"></i>
                                </div>
                                <input type="text" name="fee" class="form-control" placeholder="Adminstator" value="{{$Course->fee}}">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Time <span style="color:red;">*</span></label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-align-left"></i>
                                </div>
                                <input type="text" name="time_limit" class="form-control" placeholder="Time" value="{{$Course->time_limit}}">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Image cover course <span style="color:red;">*</span></label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-align-left"></i>
                                </div>
                                <input type="file" name="image" class="form-control" value="DefaultImage.jpg">
                            </div>
                            <!-- /.input group -->
                        </div>
            
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
                    </div>
                </form>
                </div>
            </div>
            <!-- /.col (right) -->
        </div>
        <!-- /.row -->
        </tbody>
        <script src="admin/asset/js/jquery/dist/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#TitleBlog").keyup(function(){
                    var title = $(this).val();
                    var _token = $("#_token").val();
                    $.ajax({
                        url:"admin/Blog/ajaxSlug",
                        type: "POST",
                        data: {
                          title: title,
                          _token: _token
                        },
                        success: function(result){
                            $("#Slug").val(result);
                        }
                    });
                });
            });
        </script>

@endsection
