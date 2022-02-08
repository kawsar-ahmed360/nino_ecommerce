@extends('AdminDashboard.master')
@section('title') All Category @endsection
@section('admin-content')

    <div class="table-container">
        <div class="t-header">All Category  <a href="{{route('CategoryCreate')}}"><span style="float: right;cursor:pointer" class="btn btn-success btn-sm">Add Category</span></a></div>
        <div class="table-responsive">
            <table id="copy-print-csv" class="table custom-table">
                <thead>
                <tr>
                    <th>SL.</th>
                    <th>Category Name</th>
                    <th>Highlight</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($category as $key=>$category)
                    <tr class="odd gradeX">
                        <td>{{ @$key + 1 }}</td>
                        <td>{{ @$category->category_name }}</td>
                        <td>
                            @if(@$category->highlight=='1')
                                <span class="badge badge-success">Yes</span>
                                @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        </td>

                        <td><img src="{{ asset('upload/Client/Category/'.$category->image) }}" class="img-thumbnail" width="100" height="100" /></td>
                        <td style="text-align: center;">


                            <a href="{{route('CategoryEdite',$category->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                            <a  href="{{route('CategoryDelete',$category->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

                        </td>
                    </tr>

                @endforeach


                </tbody>
            </table>
        </div>
    </div>


@endsection