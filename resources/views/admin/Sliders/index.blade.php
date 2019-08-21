@extends('admin.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Sliders / <a href="admin/Slider/addSlider">Add new</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin.layouts.alert')
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Slogan</th>
                            <th>Image in slider</th>
                            <th class="text-center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Sliders as $slider)
                        <tr>
                            <td>{{ $slider->id }}</td>
                            <td>
                                {{ $slider->slogan }}
                            </td>
                            <td>
                                <img height="100px" width="150px" src="upload/Sliders/{{ $slider->sliders }}" alt="{{ $slider->slogan }}">
                            </td>
                            <td class="text-center"><a href="admin/Slider/deleteSlider/{{$slider->id}}" class="btn-danger padding510510">Delete</a></td>
                        </tr>
                        @endforeach
                        </tfoot>
                    </table>
                    {!! $Sliders->render() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </section>
    <!-- /.content -->
@endsection
