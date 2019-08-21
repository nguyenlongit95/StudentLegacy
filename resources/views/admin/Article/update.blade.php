@extends('admin.master')

@section('content')

    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Article update</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('admin.layouts.alert')
                <div class="row">
                    <form action="admin/Article/updateArticle/{{ $Article->id }}" method="POST" enctype="multipart/form-data">
                        <div class="col-md-9">
                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Update form data element</h3>
                                </div>
                                <div class="box-body">
                                    <!-- Date mm/dd/yyyy -->
                                    <div class="form-group">
                                        <label for="">Title of article <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-edit fa-pen-alt"></i>
                                            </div>
                                            <input type="text" id="TitleArticle" name="title" class="form-control" value="{{ $Article->title }}">
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
                                            <textarea class="ckeditor" name="info" id="" cols="30" rows="10">{{ $Article->info }}</textarea>
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
                                            <textarea class="form-control ckeditor" name="details" id="Details" cols="30" rows="30">{{ $Article->details }}</textarea>
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
                                        <input type="text" id="Slug" name="slug" class="form-control" value="{{ $Article->slug }}">
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
                                        <input type="text" name="author" class="form-control" value="{{ $Article->author }}">
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
                                        <input type="text" name="linked" class="form-control" value="{{ $Article->linked }}">
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
                                        Public: <input <?php if($Article->status == 1){ echo "checked"; } ?> type="radio" name="status" value="1">
                                        Private: <input <?php if($Article->status == 0){ echo "checked"; } ?> type="radio" name="status" value="0">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->

                                <!-- phone mask -->
                                <div class="form-group">
                                    <label>Representative of the article <span style="color:red;">*</span></label>
                                    <img src="upload/Articles/{{ $Article->images }}" height="250px" width="100%" alt="{{ $Article->Title }}">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-image"></i>
                                        </div>
                                        <input type="file" name="images" class="form-control" value="{{ $Article->images }}">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->
                                <p>
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore quibusdam odit culpa aspernatur ex voluptas soluta doloremque exercitationem deserunt dicta vel nemo.
                                </p>
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
