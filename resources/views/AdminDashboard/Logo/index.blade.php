@extends('AdminDashboard.master')
@section('title') Logo View @endsection
@section('admin-content')

    <div class="table-container">
        <div class="t-header">Logo View</div>
        <div class="table-responsive">
            <table id="copy-print-csv" class="table custom-table">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Logo</th>
                    <th>Footer Logo</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                    <tr class="odd gradeX">
                        <td>1</td>
                        <td><img src="{{(@$logo_font->logo)?url('upload/Client/Logo/'.$logo_font->logo):''}}" style=" width: 100px"></td>
                        <td><img src="{{(@$logo_font->footer_logo)?url('upload/Client/FooterLogo/'.$logo_font->footer_logo):''}}" style=" width: 100px"></td>
                        <td style="text-align: center;">


                            <a href="{{route('LogoEdite',$logo_font->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                            {{--<a href="{{route('MenuDelete',$menu->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>--}}

                        </td>
                    </tr>



                </tbody>
            </table>
        </div>
    </div>


@endsection