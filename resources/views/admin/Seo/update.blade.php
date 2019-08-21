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
                        <form action="admin/Seo/updateSeo/{{ $Seo->id }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Update form data element</h3>
                                </div>
                                <div class="box-body">
                                    <!-- Date mm/dd/yyyy -->
                                    <div class="form-group">
                                        <label for="">Link Seo<span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-edit fa-pen-alt"></i>
                                            </div>
                                            <input type="text" disabled name="link" class="form-control" value="{{ $Seo->link }}">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->

                                    <!-- phone mask -->
                                    <div class="form-group">
                                        <label>Title seo</label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-align-left"></i>
                                            </div>
                                            <input type="text" name="title" class="form-control" value="{{ $Seo->title }}">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->

                                    <!-- phone mask -->
                                    <div class="form-group">
                                        <label>Keywords</label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-align-left"></i>
                                            </div>
                                            <input type="text" name="keywords" class="form-control" value="{{ $Seo->keywords }}">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->

                                    <!-- phone mask -->
                                    <div class="form-group">
                                        <label>Description<span style="color:red;">*</span></label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-compress"></i>
                                            </div>
                                            <textarea name="description" class="ckeditor form-control" id="description" cols="30" rows="10">{{ $Seo->description }}</textarea>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->

                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                    </div>

                    <div class="col-md-6">

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Heading 1 the link page</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-align-left"></i>
                                </div>
                                <input type="text" name="h1" class="form-control" value="{{ $Seo->h1 }}">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Noindex</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-align-left"></i>
                                </div>
                                No: <input type="radio" name="noindex" value="0">
                                Yes: <input type="radio" name="noindex" value="1">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Avatar</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-image"></i>
                                </div>
                                <img style="margin-left: 15px;" width="150" height="150" src="{{ asset('upload/Seo/'.$Seo->avatar) }}" alt="{{ $Seo->title }}">
                                <input type="file" name="avatar" class="form-control" value="default.jpg">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Language</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-align-left"></i>
                                </div>
                                <select name="language" class="form-control" id="language">
                                    <option @if($Seo->language == 'vi') selected @endif value="vi">Vietnamese</option>
                                    <option @if($Seo->language == 'en') selected @endif value="en">English</option>
                                    <option @if($Seo->language == 'cn') selected @endif value="cn">Chinese</option>
                                    <option @if($Seo->language == 'jp') selected @endif value="jp">Japanses</option>
                                    <option @if($Seo->language == 'kr') selected @endif value="kr">South Korea</option>
                                </select>
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
                                <input type="submit" class="form-control btn-primary" value="Submit">
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
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum ipsa repellat accusamus nemo fuga, neque asperiores consectetur tempora necessitatibus minima rem aspernatur.
                        </p>

                    </div>
                </div>
                </form>
            </div>
            <!-- /.col (right) -->
        </div>
        <!-- /.row -->
        </tbody>

        <!-- /.content -->


@endsection
