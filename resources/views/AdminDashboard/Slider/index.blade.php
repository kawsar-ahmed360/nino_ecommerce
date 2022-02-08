@extends('AdminDashboard.master')
@section('title') All Slider @endsection
@section('admin-content')

    <div class="table-container">
        <div class="t-header">All Slider  <a href="{{route('SliderCreate')}}"><span style="float: right;cursor:pointer" class="btn btn-success btn-sm">Add Slider</span></a></div>
        <div class="table-responsive">
            <table id="copy-print-csv" class="table custom-table">
                <thead>
                <tr>
                    <th>SL.</th>

                    <th>Image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($slider as $key=>$slider)
                    <tr class="odd gradeX">
                        <td>{{ @$key + 1 }}</td>


                        <td><img src="{{ asset('upload/Client/Slider/'.$slider->image) }}" class="img-thumbnail" width="100" height="100" /></td>
                        <td style="text-align: center;">


                            <a href="{{route('SliderEdite',$slider->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                            <a  href="{{route('SliderDelete',$slider->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

                        </td>
                    </tr>

                @endforeach


                </tbody>
            </table>
        </div>
    </div>


@endsection