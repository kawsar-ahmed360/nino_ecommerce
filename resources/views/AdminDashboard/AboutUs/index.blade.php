@extends('AdminDashboard.master')
@section('title') About Us @endsection
@section('admin-content')

    <div class="table-container">
        <div class="t-header">About Us </div>
        <div class="table-responsive">
            <table id="copy-print-csv" class="table custom-table">
                <thead>
                <tr>
                    <th>SL.</th>
                    <th>Title</th>
                    <th>Short</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                    <tr class="odd gradeX">
                        <td>1</td>
                        <td>{{ @$index->title }}</td>
                        <td>{!! @$index->short_title !!}</td>

                        <td><img src="{{ asset('upload/Client/About/'.$index->image) }}" class="img-thumbnail" width="100" height="100" /></td>
                        <td style="text-align: center;">


                            <a href="{{route('AboutUsEdite',$index->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
{{--                            <a  href="{{route('CategoryDelete',$category->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>--}}

                        </td>
                    </tr>




                </tbody>
            </table>
        </div>
    </div>


@endsection