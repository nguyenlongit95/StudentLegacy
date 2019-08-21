@extends('admin.master')

@section('content')
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Products</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('admin.layouts.alert')
                <div class="row">
                    <form action="admin/Product/addProduct" method="POST" enctype="multipart/form-data">
                    <div class="col-md-9 pull-left">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box box-danger">
                            <div class="box-header">
                                <h3 class="box-title">Create a new product</h3>
                            </div>
                            <div class="box-body">
                                <!-- Date mm/dd/yyyy -->
                                <div class="form-group">
                                    <label for="">Name of Product <span style="color:red;">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-edit fa-pen-alt"></i>
                                        </div>
                                        <input type="text" name="product_name" class="form-control" value="Name of product">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->

                                <!-- Date mm/dd/yyyy -->
                                <div class="form-group">
                                    <label for="">Info of product <span style="color:red;">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-edit fa-pen-alt"></i>
                                        </div>
                                        <textarea class="form-control ckeditor" name="info" id="info" cols="30" rows="5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis magnam, saepe! Consectetur consequatur, cumque deserunt ducimus ea earum eligendi eveniet excepturi fugit illum molestiae nam, porro quis sint voluptatem voluptates?</textarea>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->

                                <!-- Date mm/dd/yyyy -->
                                <div class="form-group">
                                    <label for="">Descriptions <span style="color:red;">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-edit fa-pen-alt"></i>
                                        </div>
                                        <textarea class="form-control ckeditor" name="description" id="DescriptionProduct" cols="30" rows="10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut itaque quaerat qui repudiandae? Commodi debitis delectus eum illum, ipsam, laborum magnam minima non porro provident quod reprehenderit tempore vero voluptatibus!</textarea>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->

                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>

                    <div class="col-md-3 pull-right">
                        <div class="box box-danger">
                            <div class="box-header">
                                <h3 class="box-title">The basic properties</h3>
                            </div>
                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <label for="">Price($) <span style="color:red;">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-edit fa-pen-alt"></i>
                                </div>
                                <input type="text" name="price" class="form-control" placeholder="10$">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <label for="">Sales(%) <span style="color:red;">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-edit fa-pen-alt"></i>
                                </div>
                                <input type="number" name="sales" class="form-control" placeholder="10%">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <label for="">Quantity <span style="color:red;">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-edit fa-pen-alt"></i>
                                </div>
                                <input type="number" name="quantity" class="form-control" placeholder="10">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Info of category <span style="color:red;">*</span></label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-align-left"></i>
                                </div>
                                <SELECT class="form-control" name="idCategories">
                                    @foreach($Categories as $category)
                                        <OPTION value="{{ $category->id }}">{{ $category->nameCategory }}</OPTION>
                                    @endforeach
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

                        <p>
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore quibusdam odit culpa aspernatur ex voluptas soluta doloremque exercitationem deserunt dicta vel nemo, et enim fugit expedita ullam laudantium minus quam.
                        </p>

                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam eveniet maxime neque accusantium perferendis repudiandae magni sint amet tempora repellendus recusandae eligendi temporibus cupiditate atque, porro consectetur voluptas cum incidunt.
                        </p>

                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum ipsa repellat accusamus nemo fuga, neque asperiores consectetur tempora necessitatibus minima rem aspernatur. Beatae eius aliquam maxime distinctio id reprehenderit repudiandae.
                        </p>
                    </div>
                    </div>
                </div>

                </form>
            </div>
        </div>
        </div>
        <!-- /.col (right) -->
        </div>
        <!-- /.row -->
        <!-- /.content -->
        </div>
    </section>
@endsection
