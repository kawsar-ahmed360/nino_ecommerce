@extends('UserDashboard.master')
@section('title') All Category @endsection
@section('user-content')

    <div class="table-container">
        <div class="t-header">All Category  <a href="{{route('UserCategoryCreate')}}"><span style="float: right;cursor:pointer" class="btn btn-success btn-sm">Add Category</span></a></div>
        <div class="table-responsive">
            <table id="copy-print-csv" class="table custom-table">
                <thead>
                <tr>
                    <th>SL.</th>
                    <th>Category Name</th>
                    <th>Highlight</th>
                    <th>Created By</th>
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

                        <td class="center">
                            @if(@$category->user_id=='')
                                <span class="badge badge-success">SuperAdmin</span>
                            @else
                                <span class="badge badge-warning">{{@$info->Role->role_name}} ({{@$info->name}})</span>
                            @endif
                        </td>

                        <td><img src="{{ asset('upload/Client/Category/'.$category->image) }}" class="img-thumbnail" width="100" height="100" /></td>
                        <td style="text-align: center;">


                            <a href="{{route('UserCategoryEdite',$category->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                            <a  href="{{route('UserCategoryDelete',$category->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

                        </td>
                    </tr>

                @endforeach


                </tbody>
            </table>
        </div>
    </div>


@endsection