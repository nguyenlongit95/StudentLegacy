@extends('admin.master')

@section('content')

    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Article</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('admin.layouts.alert')
                <div class="row">
                    <form action="admin/Article/addArticle" method="POST" enctype="multipart/form-data">
                    <div class="col-md-9">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <div class="box box-danger">
                            <div class="box-header">
                                <h3 class="box-title">Insert form data element</h3>
                            </div>
                            <div class="box-body">
                                <!-- Date mm/dd/yyyy -->
                                <div class="form-group">
                                    <label for="">Title of article <span style="color:red;">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-edit fa-pen-alt"></i>
                                        </div>
                                        <input type="text" id="TitleArticle" name="title" class="form-control" placeholder="...">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->

                                <!-- phone mask -->
                                <div class="form-group">
                                    <label>Information of article <span style="color:red;">*</span></label>

                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-align-left"></i>
                                        </div>
                                        <textarea class="ckeditor" name="info" id="" cols="30" rows="10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliquam corporis dicta dolor, dolore dolorem eveniet ex facilis magnam molestiae officiis placeat quas quod sapiente sit temporibus velit voluptatibus.</textarea>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->

                                <!-- phone mask -->
                                <div class="form-group">
                                    <label>Description of article <span style="color:red;">*</span></label>

                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-align-left"></i>
                                        </div>
                                        <textarea class="form-control" name="details" id="Details" cols="30" rows="30">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliquam corporis dicta dolor, dolore dolorem eveniet ex facilis magnam molestiae officiis placeat quas quod sapiente sit temporibus velit voluptatibus.</textarea>
                                       ﻿
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
                                <h3 class="box-title">SEO Infomation spiner</h3>
                            </div>
                            <!-- Date mm/dd/yyyy -->
                            <div class="form-group">
                                <label for="">Slug in article <span style="color:red;">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-edit fa-pen-alt"></i>
                                    </div>
                                    <input type="text" id="Slug" name="slug" class="form-control" placeholder="...">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->
                            <!-- phone mask -->
                            <div class="form-group">
                                <label>Author of article <span style="color:red;">*</span></label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input type="text" name="author" class="form-control" placeholder="...">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->

                            <!-- phone mask -->
                            <div class="form-group">
                                <label>Linked this article <span style="color:red;">*</span></label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-compress"></i>
                                    </div>
                                    <input type="text" name="linked" class="form-control" placeholder="...">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->

                            <!-- phone mask -->
                            <div class="form-group">
                                <label>Status of article <span style="color:red;">*</span></label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    Public: <input type="radio" name="status" value="1">
                                    Private: <input checked type="radio" name="status" value="0">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->

                            <!-- phone mask -->
                            <div class="form-group">
                                <label>Representative images of the article <span style="color:red;">*</span></label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-image"></i>
                                    </div>
                                    <input type="file" name="images" class="form-control" value="default.jpg">
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
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum ipsa. accusantium perferendis repudiandae.
                            </p>

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

                        </div>
                    </div>
                </div>
                </form>
            </div>
            <!-- /.col (right) -->
            <!-- /.form group -->
        </div>
        <!-- /.row -->
        </tbody>

        <!-- /.content -->
@endsection
