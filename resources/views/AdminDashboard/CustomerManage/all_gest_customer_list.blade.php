@extends('AdminDashboard.master')
@section('title') All Guest Customer List @endsection
@section('admin-content')

    <div class="table-container">
        <div class="t-header">All Guest Customer List </div>
        <div class="table-responsive">
            <table id="copy-print-csv" class="table custom-table">
                <thead>
                <tr>
                    <th>SL.</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($index as $key=>$index)
                    <tr class="odd gradeX">
                        <td>{{ @$key + 1 }}</td>
                        <td>{{ @$index->name }}</td>
                        <td>{{ @$index->mobile }}</td>
                        <td>{{ @$index->email }}</td>
                        <td>
                            @if(@$index->password==null)
                                <span class="badge badge-success">Guest</span>
                            @else
                                <span class="badge badge-danger">Register</span>
                            @endif
                        </td>

                        {{--                        <td><img src="{{ asset('upload/Client/Category/'.$category->image) }}" class="img-thumbnail" width="100" height="100" /></td>--}}
                        <td style="text-align: center;">

                            <a  href="{{route('GestCustomerView',$index->id)}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</a>
                            <a  href="{{route('GestCustomerDelete',$index->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

                        </td>
                    </tr>

                @endforeach


                </tbody>
            </table>
        </div>
    </div>


@endsection