@extends('AdminDashboard.master')
@section('title') Custom User Manage @endsection
@section('admin-content')

    <div class="table-container">
        <div class="t-header">Custom User Manage </div>
        <div class="">





                <div class="table-responsive">



                    <table id="copy-print-csv" class="table custom-table">
                        <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Name</th>
                            <th>Permission</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($index as $key=>$index)
                            <tr class="odd gradeX">
                                <td>{{ @$key + 1 }}</td>
                                <td>{{ @$index->name }}</td>

                                <td>
                                    @if(@$index->Menu_Builder=='Menu Builder')
                                        <span style="margin-bottom: 3px;" class="badge badge-success">Menu Builder</span>
                                        @else
                                    @endif

                                        @if(@$index->Slider_Manage=='Slider Manage')
                                        <span style="margin-bottom: 3px;" class="badge badge-info">Slider Manage</span>
                                        @else
                                    @endif

                                        @if(@$index->Section_Manage=='Section Manage')
                                            <span style="margin-bottom: 3px;" class="badge badge-orange">Section Manage</span>
                                        @else
                                        @endif

                                        @if(@$index->Color_Manage=='Color Manage')
                                            <span style="margin-bottom: 3px;" class="badge badge-secondary">Color Manage</span>
                                        @else
                                        @endif

                                        @if(@$index->Plating_Manage=='Plating Manage')
                                            <span style="margin-bottom: 3px;" class="badge badge-danger">Plating Manage</span>
                                        @else
                                        @endif


                                        @if(@$index->Purchase_Section=='Purchase Section')
                                            <span style="margin-bottom: 3px;" class="badge badge-dark">Purchase Manage</span>
                                        @else
                                        @endif

                                        @if(@$index->Stock_Report=='Stock Report')
                                            <span style="margin-bottom: 3px;" class="badge badge-orange">Stock Report</span>
                                        @else
                                        @endif


                                        @if(@$index->Pdf_Information=='Pdf Information')
                                            <span style="margin-bottom: 3px;" class="badge badge-light">Pdf Information</span>
                                        @else
                                        @endif

                                        @if(@$index->Page_Builder=='Page Builder')
                                            <span style="margin-bottom: 3px;" class="badge badge-info">Page Builder</span>
                                        @else
                                        @endif

                                        @if(@$index->Logo_Manage=='Logo Manage')
                                            <span style="margin-bottom: 3px;" class="badge badge-success">logo Manage</span>
                                        @else
                                        @endif

                                        @if(@$index->Category_Manage=='Category Manage')
                                            <span style="margin-bottom: 3px;" class="badge badge-danger">Category Manage</span>
                                        @else
                                        @endif

                                        @if(@$index->Tag_Manage=='Tag Manage')
                                            <span style="margin-bottom: 3px;" class="badge badge-success">Tag Manage</span>
                                        @else
                                        @endif

                                        @if(@$index->Product_Manage=='Product Manage')
                                            <span style="margin-bottom: 3px;" class="badge badge-secondary">Product Manage</span>
                                        @else
                                        @endif


                                        @if(@$index->Sale_Report=='Sale Report')
                                            <span style="margin-bottom: 3px;" class="badge badge-orange">Sales Report</span>
                                        @else
                                        @endif

                                        @if(@$index->Shipment_Charge=='Shipment Charge')
                                            <span style="margin-bottom: 3px;" class="badge badge-info">Shipment Charge</span>
                                        @else
                                        @endif

                                        @if(@$index->Order_Manage=='Order Manage')
                                            <span style="margin-bottom: 3px;" class="badge badge-info">Order Manage</span>
                                        @else
                                        @endif

                                        @if(@$index->Coupon_Manage=='Coupon Manage')
                                            <span style="margin-bottom: 3px;" class="badge badge-warning">Coupon Manage</span>
                                        @else
                                        @endif

                                        @if(@$index->Contact_Information=='Contact Information')
                                            <span style="margin-bottom: 3px;" class="badge badge-info">Contact Information</span>
                                        @else
                                        @endif


                                        @if(@$index->About_Us=='About Us')
                                            <span style="margin-bottom: 3px;" class="badge badge-danger">About Us</span>
                                        @else
                                        @endif


                                        @if(@$index->Social_Icon=='Social Icon')
                                            <span style="margin-bottom: 3px;" class="badge badge-primary">Social Icon</span>
                                        @else
                                        @endif


                                        @if(@$index->Our_Client_Think_Of=='Our Client Think Of')
                                            <span style="margin-bottom: 3px;" class="badge badge-info">Our Client Think Of</span>
                                        @else
                                        @endif

                                        @if(@$index->Customer_Manage=='Customer Manage')
                                            <span style="margin-bottom: 3px;" class="badge badge-warning">Customer Manage</span>
                                        @else
                                        @endif


                                </td>
                                <td>{{ @$index->email }}</td>
                                @if(empty($index->role))
                                    <td><span class="badge badge-secondary">Default</span></td>
                                    @else
                                <td>@if(@$index->role%2==0) <span class="badge badge-success">{{ @$index->Role->role_name }}</span> @else  <span class="badge badge-primary">{{ @$index->Role->role_name }}</span> @endif</td>
                                @endif
                                {{--<td>--}}
                                {{--@if(@$index->status=='1')--}}
                                {{--<span class="badge badge-success">Active</span>--}}
                                {{--@else--}}
                                {{--<span class="badge badge-danger">Deactive</span>--}}
                                {{--@endif--}}
                                {{--</td>--}}

                                {{--                        <td><img src="{{ asset('upload/Client/Category/'.$category->image) }}" class="img-thumbnail" width="100" height="100" /></td>--}}
                                <td style="text-align: center;">

                                    <div class="btn-group">
                                        <button class="btn btn-primary btn-sm" type="button">
                                            Action
                                        </button>
                                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a style="display: inherit;margin: 5px;border-radius:3px"  href="{{route('CustomUserEdite',$index->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                            <a style="display: inherit;margin: 5px;border-radius:3px"   href="{{route('CustomUsernDelete',$index->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                                        </div>
                                    </div>




                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                </div>








        </div>
    </div>


@endsection