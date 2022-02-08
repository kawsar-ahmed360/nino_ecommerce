@extends('AdminDashboard.master')
@section('title') All Section @endsection
@section('admin-content')

    <div class="table-container">
        <div class="t-header">All Section  <a href="{{route('SectionCreate')}}"><span style="float: right;cursor:pointer" class="btn btn-success btn-sm">Add Section</span></a></div>
        <div class="table-responsive">
            <table id="copy-print-csv" class="table custom-table">
                <thead>
                <tr>
                    <th>SL.</th>
                    <th>Name</th>
                    <th>Add(1)</th>
                    <th>Add(2)</th>
                    <th>Highlight</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($index as $key=>$sec)
                    <tr class="odd gradeX">
                        <td>{{ @$key + 1 }}</td>
                        <td>{{ @$sec->section_name }}</td>

                        <td><img src="{{ asset('upload/Client/first_add_image/'.$sec->first_add_image) }}" class="img-thumbnail" width="100" height="100" /></td>
                        <td><img src="{{ asset('upload/Client/second_add_image/'.$sec->second_add_image) }}" class="img-thumbnail" width="100" height="100" /></td>
                        <td>
                            @if(@$sec->highlight=='1')
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                        <td style="text-align: center;">


                            <a href="{{route('SectionEdite',$sec->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                            <a  href="{{route('SectionDelete',$sec->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

                        </td>
                    </tr>

                @endforeach


                </tbody>
            </table>
        </div>
    </div>


@endsection