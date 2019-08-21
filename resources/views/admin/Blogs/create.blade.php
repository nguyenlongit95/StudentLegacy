@extends('admin.master')

@section('content')

    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Blogs</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('admin.layouts.alert')
                <div class="row">
                    <form action="admin/Blog/addBlogs" method="POST" enctype="multipart/form-data">
                    <div class="col-md-9">
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Add form data element</h3>
                                </div>
                                <div class="box-body">
                                    <!-- Date mm/dd/yyyy -->
                                    <div class="form-group">
                                        <label for="">Title this blog <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-edit fa-pen-alt"></i>
                                            </div>
                                            <input type="text" name="title" id="TitleBlog" class="form-control" placeholder="Title this blog">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->

                                    <!-- Date mm/dd/yyyy -->
                                    <div class="form-group">
                                        <label for="">Slug <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-edit fa-pen-alt"></i>
                                            </div>
                                            <input type="text" name="slug" id="Slug" class="form-control" placeholder="Slug this blog">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->

                                    <!-- phone mask -->
                                    <div class="form-group">
                                        <label>Info blog <span style="color:red;">*</span></label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-align-left"></i>
                                            </div>
                                            <textarea name="info" class="form-control ckeditor" id="" cols="30" rows="10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores consequatur corporis, dignissimos dolorum eaque enim expedita facere, hic magnam necessitatibus numquam odit quidem similique sint, tempore. Deleniti itaque perspiciatis vero.</textarea>
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
                                            <textarea name="description" class="form-control ckeditor" id="Descriptions" cols="30" rows="30">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores consequatur corporis, dignissimos dolorum eaque enim expedita facere, hic magnam necessitatibus numquam odit quidem similique sint, tempore. Deleniti itaque perspiciatis vero.</textarea>
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
                                <h3 class="box-title">SEO elements spiner</h3>
                            </div>
                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Author <span style="color:red;">*</span></label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-align-left"></i>
                                </div>
                                <input type="text" name="author" class="form-control" placeholder="Adminstator">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Tags <span style="color:red;">*</span></label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-align-left"></i>
                                </div>
                                <input type="text" name="tags" class="form-control" placeholder="Blog">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Image blog <span style="color:red;">*</span></label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-align-left"></i>
                                </div>
                                <input type="file" name="image" class="form-control" value="DefaultImage.jpg">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Blog categories <span style="color:red;">*</span></label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-compress"></i>
                                </div>
                                <SELECT class="form-control" name="idCategoryBlog">
                                    @foreach($CategoryBlogs as $categoryBlogs)
                                        <OPTION value="{{ $categoryBlogs->id }}">{{ $categoryBlogs->nameCategory }}</OPTION>
                                    @endforeach
                                </SELECT>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <p>
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore quibusdam odit culpa aspernatur ex voluptas soluta doloremque exercitationem deserunt dicta vel nemo, et enim fugit expedita ullam laudantium minus quam.
                        </p>

                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam eveniet maxime neque accusantium perferendis repudiandae magni sint amet tempora repellendus recusandae eligendi temporibus cupiditate atque, porro consectetur voluptas cum incidunt.
                        </p>

                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum ipsa repellat accusamus nemo fuga, neque asperiores consectetur tempora necessitatibus minima rem aspernatur. Beatae eius aliquam maxime distinctio id reprehenderit repudiandae.
                        </p>

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
