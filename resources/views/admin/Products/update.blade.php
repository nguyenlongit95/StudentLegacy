@extends('admin.master')

@section('content')
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Products details</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('admin.layouts.alert')
                <div class="row">
                    <div class="col-md-8 pull-left">
                        <form action="admin/Product/updateProduct/{{ $Product->id }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Update form data element</h3>
                                </div>
                                <div class="box-body">
                                    <!-- Date mm/dd/yyyy -->
                                    <div class="form-group">
                                        <label for="">Name of Product <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-edit fa-pen-alt"></i>
                                            </div>
                                            <input type="text" name="product_name" class="form-control" value="{{ $Product->product_name }}">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->

                                    <!-- Date mm/dd/yyyy -->
                                    <div class="form-group">
                                        <label for="">Price <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-edit fa-pen-alt"></i>
                                            </div>
                                            <input type="text" name="price" class="form-control" value="{{ $Product->price }}">
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
                                            <input type="number" name="sales" class="form-control" value="{{ $Product->sales }}">
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
                                            <input type="number" name="quantity" class="form-control" value="{{ $Product->quantity }}">
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
                                                @foreach($Category as $category)
                                                    <OPTION <?php if($category->id == $Product->idCategories){echo "selected";} else{} ?> value="{{ $category->id }}">{{ $category->nameCategory }}</OPTION>
                                                @endforeach
                                            </SELECT>
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
                                            <textarea class="form-control ckeditor" name="info" id="info" cols="30" rows="5">{!! $Product->info !!}</textarea>
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
                                            <textarea class="form-control ckeditor" name="description" id="DescriptionProduct" cols="30" rows="30">{!! $Product->description !!}</textarea>
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
                                            <input type="submit" class="form-control btn btn-primary" value="Submit">
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

                    <div class="col-md-4 pull-right">
                        <div class="box box-danger">
                            <div class="box-header">
                                <h3 class="box-title">Extension components</h3>
                            </div>
                            <p>
                                Images of product <span style="color:red;">*</span>
                            </p>
                        <form action="admin/Product/addImage/{{$Product->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="file" name="ImageProduct" value="Add Image" class="form-control">
                            <input type="submit" value="Add Image" class="form-control btn btn-primary">
                        </form>
                        <table id="example2" style="margin-top:15px;" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ImageProduct as $imageProduct)
                                <tr>
                                    <td class="text-center" style="padding-top:15%;">{{ $imageProduct->id }}</td>
                                    <td class="text-center">
                                        <img width="100px" height="100px" class="reposive-image" src="upload/Product/{{$imageProduct->imageproduct}}" alt="{{ $Product->product_name }}">
                                    </td>
                                    <td style="padding-top:15%;" class="text-center"><a href="admin/Product/deleteImage/{{$imageProduct->id}}" class="btn-danger padding510510">Delete</a></td>
                                </tr>
                            @endforeach
                            </tfoot>
                        </table>
                            {!! $ImageProduct->appends(Request::all())->links() !!}
                        <h5>Mumber average this product: <span class="btn <?php if($StarProduct >= 3){ echo "btn-success";}else if($StarProduct<3){echo "btn-danger";} ?>"><?php $StarAVG = number_format($StarProduct); for($i=1; $i<=$StarAVG;$i++){ ?> <i class="fa fa-star"></i><?php } ?></span></h5>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Number star</th>
                                <th>Product evaluation</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($RattingProduct) > 0)
                            @foreach($RattingProduct as $rattingProduct)
                                <tr>
                                    <td>{{ $rattingProduct->id }}</td>
                                    <td class="text-center">
                                        <?php
                                        for($i=1; $i<=$rattingProduct->ratting; $i++){
                                            ?><i class="fa fa-star"></i><?php
                                        }
                                        ?>
                                    </td>
                                    <td>{!! $rattingProduct->info !!}</td>
                                </tr>
                            @endforeach
                            @else
                                <p>There are no rattings yet.<span style="color:red;">*<span></p>
                            @endif
                            </tfoot>
                        </table>
                            {!! $RattingProduct->appends(Request::all())->links() !!}

                            <!-- Form update custom properties -->
                        <div class="box-header">
                            <h3 class="box-title">Custom properties of product <span style="color:red;">*</span></h3>
                        </div>

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">Properties</th>
                                    <th>Values</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($CustomProperties as $customProperty)
                                    @foreach($CustomPropertiesValue as $customPropertyValue)
                                    @if($customProperty->attribute_value_id == $customPropertyValue->id)
                                        @foreach ($getAttribute as $attribute)
                                        @if($attribute->id == $customPropertyValue->idAttribute)
                                    <form action="admin/Product/updateCustomproperties/{{ $customPropertyValue->id }}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <tr>
                                        <td class="text-center">
                                            <span>{{ $attribute->attribute }}</span>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="Value" value="{{ $customPropertyValue->value }}">
                                        </td>
                                        <td>
                                            <input type="submit" class="btn btn-warning form-control" value="Update">
                                        </td>
                                        <td>
                                            <a href="admin/Product/deleteCustomProperties/{{ $customProperty->id }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    </form>
                                        @endif
                                    @endforeach
                                    @endif
                                    @endforeach
                                @endforeach
                                </tfoot>
                            </table>
                            {{ $CustomProperties->appends(Request::all())->links() }}
                            <p>Add a new existing attribute for this product <span style="color:red;">*</span></p>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">Properties</th>
                                    <th>Value</th>
                                    <th>Values</th>
                                    <th>Method</th>
                                </tr>
                                </thead>
                                <tbody>
                                <form action="admin/Product/addCustomProperties/{{ $Product->id }}" method="POST">
                                    <input type="hidden" id="_token"  name="_token" value="{{ csrf_token() }}">
                                    <tr>
                                        <td>
                                            <select name="idAttribute" class="form-control" id="idAttribute">
                                                <option selected value="">----------</option>
                                                @foreach($getAttribute as $attrubute)
                                                <option value="{{ $attrubute->id }}">{{ $attrubute->attribute }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="idAttributeValue" class="form-control" id="tdAttributeValue">

                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="value" placeholder="Values">
                                        </td>
                                        <td>
                                            <input type="submit" class="btn btn-primary" value="Add">
                                        </td>
                                    </tr>
                                </form>
                                </tfoot>
                            </table>
                            <p>Add a new attribute to both the system and this product <span style="color:red;">*</span></p>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>The child of</th>
                                    <th class="text-center">Attribute</th>
                                    <th>Values</th>
                                    <th>Method</th>
                                </tr>
                                </thead>
                                <tbody>
                                <form action="admin/Product/addAttribute/{{ $Product->id }}" method="POST">
                                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                                    <tr>
                                        <td>
                                            <select name="parent_id" class="form-control" id="">
                                                <option value="0">---------</option>
                                                @foreach($getAttribute as $attrubute)
                                                <option value="{{ $attrubute->id }}">{{ $attrubute->attribute }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="attribute" placeholder="Attribute">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="value" placeholder="values">
                                        </td>
                                        <td>
                                            <input type="submit" class="btn btn-primary" value="Add">
                                        </td>
                                    </tr>
                                </form>
                                </tfoot>
                            </table>
                    </div>
                    </div>
                        </div>
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
