<!doctype html>
<html lang="en">

<!-- Mirrored from bootstrap.gallery/le-rouge/design/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 23 Oct 2021 11:40:30 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap4 Dashboard Template">
    <meta name="author" content="ParkerThemes">
    <link rel="shortcut icon" href="img/fav.png" />

    <!-- Title -->
    <title>@yield('title')</title>


    <!-- *************
        ************ Common Css Files *************
    ************ -->
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="{{asset('backend/fonts/style.css')}}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('backend/css/main.css')}}">


    <!-- *************
        ************ Vendor Css Files *************
    ************ -->
    <!-- DateRange css -->
    <link rel="stylesheet" href="{{asset('backend/vendor/daterange/daterange.css')}}" />
    <link rel="stylesheet" href="{{asset('backend/vendor/datepicker/css/classic.css')}}" />
    <link rel="stylesheet" href="{{asset('backend/vendor/datepicker/css/classic.date.css')}}" />
    <link rel="stylesheet" href="{{asset('fontend/toastr.min.css')}}">


    <link rel="stylesheet" href="{{asset('backend/vendor/datatables/dataTables.bs4.css')}}" />
    <link rel="stylesheet" href="{{asset('backend/vendor/datatables/dataTables.bs4-custom.css')}}" />
    <link href="{{asset('backend/vendor/datatables/buttons.bs.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    {{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
</head>

<body>

<!-- Loading starts -->
<div id="loading-wrapper">
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Loading ends -->


<!-- Page wrapper start -->
<div class="page-wrapper">

    <!-- Sidebar wrapper start -->
    <nav id="sidebar" class="sidebar-wrapper">

        <!-- Sidebar brand start  -->
        <div class="sidebar-brand">
            <a href="#" class="logo">
                <img src="{{(@$logo->logo)?url('upload/Admin/Logo/'.$logo->logo):''}}" alt="Le Rouge Admin Dashboard" />
            </a>
        </div>
        <!-- Sidebar brand end  -->

        <!-- Sidebar content start -->
        <div class="sidebar-content">

            <!-- sidebar menu start -->
            <div class="sidebar-menu">
                <ul>
                    <li class="header-menu">General</li>


                    <li {{ Request::routeIs('AdminDashboard') ? 'active' : '' }}>
                        <a class="{{ Request::routeIs('AdminDashboard') ? 'current-page' : '' }}" href="{{route('AdminDashboard')}}">
                            <i class="icon-devices_other"></i>
                            <span class="menu-text">Dashboards</span>
                        </a>
                    </li>



                    <li class="sidebar-dropdown {{ Request::routeIs('MenuCreate') ? 'active' : '' }} {{ Request::routeIs('MenuIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-layout"></i>
                            <span class="menu-text">Menu Builder</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a class="{{ Request::routeIs('MenuCreate') ? 'current-page' : '' }}" href="{{route('MenuCreate')}}">Create Menu</a>
                                </li>
                                <li>
                                    <a class="{{ Request::routeIs('MenuIndex') ? 'current-page' : '' }}" href="{{route('MenuIndex')}}">All Menu</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="sidebar-dropdown {{ Request::routeIs('PageCreate') ? 'active' : '' }} {{ Request::routeIs('PageIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-layout"></i>
                            <span class="menu-text">Page Builder</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a class="{{ Request::routeIs('PageCreate') ? 'current-page' : '' }}" href="{{route('PageCreate')}}">Create Page</a>
                                </li>
                                <li>
                                    <a class="{{ Request::routeIs('PageIndex') ? 'current-page' : '' }}" href="{{route('PageIndex')}}">All Page</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="sidebar-dropdown {{ Request::routeIs('SliderCreate') ? 'active' : '' }} {{ Request::routeIs('SliderIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-list2"></i>
                            <span class="menu-text">Slider Manage</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>

                                <li>
                                    <a class="{{ Request::routeIs('SliderCreate') ? 'current-page' : '' }}" href="{{route('SliderCreate')}}">Create Slider</a>
                                </li>

                                <li>
                                    <a class="{{ Request::routeIs('SliderIndex') ? 'current-page' : '' }}" href="{{route('SliderIndex')}}">All Slider</a>
                                </li>

                            </ul>
                        </div>
                    </li>



                    <li class="sidebar-dropdown {{ Request::routeIs('LogoIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-file-text"></i>
                            <span class="menu-text">Logo Manage</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>

                                <li>
                                    <a class="{{ Request::routeIs('LogoIndex') ? 'current-page' : '' }}" href="{{route('LogoIndex')}}">View Logo</a>
                                </li>

                            </ul>
                        </div>
                    </li>




                    <li class="header-menu">Fontend Section</li>


                    <li class="sidebar-dropdown {{ Request::routeIs('SectionCreate') ? 'active' : '' }} {{ Request::routeIs('SectionIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-file-text"></i>
                            <span class="menu-text">Section</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a class="{{ Request::routeIs('SectionCreate') ? 'current-page' : '' }}" href="{{route('SectionCreate')}}">Add Section</a>
                                </li>
                                <li>
                                    <a class="{{ Request::routeIs('SectionIndex') ? 'current-page' : '' }}" href="{{route('SectionIndex')}}">All Section</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="header-menu">Product Section</li>

                    <li class="sidebar-dropdown {{ Request::routeIs('CategoryCreate') ? 'active' : '' }} {{ Request::routeIs('CategoryIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-triangle"></i>
                            <span class="menu-text">Category Manage</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>

                                <li>
                                    <a class="{{ Request::routeIs('CategoryCreate') ? 'current-page' : '' }}" href="{{route('CategoryCreate')}}">Create Category</a>
                                </li>

                                <li>
                                    <a class="{{ Request::routeIs('CategoryIndex') ? 'current-page' : '' }}" href="{{route('CategoryIndex')}}">All Category</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="sidebar-dropdown {{ Request::routeIs('ColorCreate') ? 'active' : '' }} {{ Request::routeIs('ColorIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-tonality"></i>
                            <span class="menu-text">Color Manage</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>

                                <li>
                                    <a class="{{ Request::routeIs('ColorCreate') ? 'current-page' : '' }}" href="{{route('ColorCreate')}}">Create Color</a>
                                </li>

                                <li>
                                    <a class="{{ Request::routeIs('ColorIndex') ? 'current-page' : '' }}" href="{{route('ColorIndex')}}">All Color</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="sidebar-dropdown {{ Request::routeIs('TagIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-line-graph"></i>
                            <span class="menu-text">Tag Manage</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>


                                <li>
                                    <a class="{{ Request::routeIs('TagIndex') ? 'current-page' : '' }}" href="{{route('TagIndex')}}">All Tag</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="sidebar-dropdown {{ Request::routeIs('PlatingIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-circular-graph"></i>
                            <span class="menu-text">Plating/Polish Manage</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>


                                <li>
                                    <a class="{{ Request::routeIs('PlatingIndex') ? 'current-page' : '' }}" href="{{route('PlatingIndex')}}">All Plating</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="sidebar-dropdown {{ Request::routeIs('ProductCreate') ? 'active' : '' }} {{ Request::routeIs('ProductIndex') ? 'active' : '' }} {{ Request::routeIs('ProductApprove') ? 'active' : '' }} {{ Request::routeIs('ProductPanding') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-file-text"></i>
                            <span class="menu-text">Product Manage</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a class="{{ Request::routeIs('ProductCreate') ? 'current-page' : '' }}" href="{{route('ProductCreate')}}">Product Add</a>
                                </li>

                                <li>
                                    <a class="{{ Request::routeIs('ProductIndex') ? 'current-page' : '' }}" href="{{route('ProductIndex')}}">All Product</a>
                                </li>

                                <li>
                                    <a class="{{ Request::routeIs('ProductApprove') ? 'current-page' : '' }}" href="{{route('ProductApprove')}}">Approve Product</a>
                                </li>

                                <li>
                                    <a class="{{ Request::routeIs('ProductPanding') ? 'current-page' : '' }}" href="{{route('ProductPanding')}}">Panding Product</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="header-menu">Customer Section</li>
                    <li class="sidebar-dropdown {{ Request::routeIs('AllCustomerList') ? 'active' : '' }} {{ Request::routeIs('CustomerView') ? 'active' : '' }} {{ Request::routeIs('AllRegisterCustomerList') ? 'active' : '' }}{{ Request::routeIs('RegisterCustomerView') ? 'active' : '' }}{{ Request::routeIs('AllGestCustomerList') ? 'active' : '' }}{{ Request::routeIs('GestCustomerView') ? 'active' : '' }} ">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span class="menu-text">Customer Manage</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>


                                <li>
                                    <a class="{{ Request::routeIs('AllCustomerList') ? 'current-page' : '' }} {{ Request::routeIs('CustomerView') ? 'current-page' : '' }}" href="{{route('AllCustomerList')}}">All Customer List</a>
                                </li>

                                <li>
                                    <a class="{{ Request::routeIs('AllRegisterCustomerList') ? 'current-page' : '' }} {{ Request::routeIs('RegisterCustomerView') ? 'current-page' : '' }}" href="{{route('AllRegisterCustomerList')}}">All Register Customer List</a>
                                </li>

                                <li>
                                    <a class="{{ Request::routeIs('AllGestCustomerList') ? 'current-page' : '' }} {{ Request::routeIs('GestCustomerView') ? 'current-page' : '' }}" href="{{route('AllGestCustomerList')}}">All Gest Customer List</a>
                                </li>


                            </ul>
                        </div>
                    </li>



                    <li class="header-menu">Order Section</li>
                    <li class="sidebar-dropdown {{ Request::routeIs('AllCustomerOrder') ? 'active' : '' }} {{ Request::routeIs('AllCustomerPandingOrder') ? 'active' : '' }} {{ Request::routeIs('AllCompleteOrderList') ? 'active' : '' }} {{ Request::routeIs('AllCustomerOrderDetails') ? 'active' : '' }}  ">
                        <a href="#">
                            <i class="icon-circular-graph"></i>
                            <span class="menu-text">Order Manage</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>


                                <li>
                                    <a class="{{ Request::routeIs('AllCustomerOrder') ? 'current-page' : '' }}" href="{{route('AllCustomerOrder')}}">All Order List</a>
                                </li>


                                <li>
                                    <a class="{{ Request::routeIs('AllCustomerPandingOrder') ? 'current-page' : '' }}" href="{{route('AllCustomerPandingOrder')}}">Panding Order List</a>
                                </li>

                                <li>
                                    <a class="{{ Request::routeIs('AllCompleteOrderList') ? 'current-page' : '' }}" href="{{route('AllCompleteOrderList')}}">Complete Order List</a>
                                </li>

                            </ul>
                        </div>
                    </li>




                    <li class="header-menu">Inventory Section</li>

                    <li class="sidebar-dropdown {{ Request::routeIs('purshesadd') ? 'active' : '' }} {{ Request::routeIs('purshesadd_view') ? 'active' : '' }} {{ Request::routeIs('panding_purshes') ? 'active' : '' }} {{ Request::routeIs('purshesadd_dailyreport') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-circular-graph"></i>
                            <span class="menu-text">Purchase Manage</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>


                                <li>
                                    <a class="{{ Request::routeIs('purshesadd') ? 'current-page' : '' }}" href="{{route('purshesadd')}}">Add Purchase</a>
                                </li>

                                <li>
                                    <a class="{{ Request::routeIs('purshesadd_view') ? 'current-page' : '' }}" href="{{route('purshesadd_view')}}">View Purchase</a>
                                </li>

                                <li>
                                    <a class="{{ Request::routeIs('panding_purshes') ? 'current-page' : '' }}" href="{{route('panding_purshes')}}">Panding Purchase</a>
                                </li>

                                <li>
                                    <a class="{{ Request::routeIs('purshesadd_dailyreport') ? 'current-page' : '' }}" href="{{route('purshesadd_dailyreport')}}">Daily Purchase Report</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="header-menu">Report Section</li>

                    <li class="sidebar-dropdown {{ Request::routeIs('Report_Genarator') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-file-text"></i>
                            <span class="menu-text">Sales Report</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>


                                <li>
                                    <a class="{{ Request::routeIs('Report_Genarator') ? 'current-page' : '' }}" href="{{route('Report_Genarator')}}">Selling Report</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="icon-file-text"></i>
                            <span class="menu-text">Stock Report</span>
                        </a>
                        <div class="sidebar-submenu {{ Request::routeIs('StockGenaratorPage') ? 'active' : '' }}">
                            <ul>


                                <li>
                                    <a class="{{ Request::routeIs('StockGenaratorPage') ? 'current-page' : '' }}" href="{{ route('StockGenaratorPage') }}">Stock Report</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="header-menu">User Role Manage</li>

                    <li class="sidebar-dropdown {{ Request::routeIs('RoleIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-tasks"></i>
                            <span class="menu-text">Role Manage</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>


                                <li>
                                    <a class="{{ Request::routeIs('RoleIndex') ? 'current-page' : '' }}" href="{{ route('RoleIndex') }}">Role View</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="sidebar-dropdown {{ Request::routeIs('PermissionIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-tasks"></i>
                            <span class="menu-text">Permission Manage</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>


                                <li>
                                    <a class="{{ Request::routeIs('PermissionIndex') ? 'current-page' : '' }}" href="{{ route('PermissionIndex') }}">Permission View</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="sidebar-dropdown {{ Request::routeIs('CustomUserCreate') ? 'active' : '' }} {{ Request::routeIs('CustomUserIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span class="menu-text">Users Manage</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>


                                <li>
                                    <a class="{{ Request::routeIs('CustomUserCreate') ? 'current-page' : '' }}" href="{{ route('CustomUserCreate') }}">User Create</a>
                                </li>

                                <li>
                                    <a class="{{ Request::routeIs('CustomUserIndex') ? 'current-page' : '' }}" href="{{ route('CustomUserIndex') }}">User List</a>
                                </li>

                            </ul>
                        </div>
                    </li>



                    <li class="header-menu">Other Section</li>


                    <li class="sidebar-dropdown {{ Request::routeIs('CouponIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-file-text"></i>
                            <span class="menu-text">Coupon Manage</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>


                                <li>
                                    <a class="{{ Request::routeIs('CouponIndex') ? 'current-page' : '' }}" href="{{ route('CouponIndex') }}">All Coupon</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="sidebar-dropdown {{ Request::routeIs('ShippingIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-pocket"></i>
                            <span class="menu-text">Shipping Charge</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>


                                <li>
                                    <a  class="{{ Request::routeIs('ShippingIndex') ? 'current-page' : '' }}" href="{{ route('ShippingIndex') }}">Shipping Charge</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="sidebar-dropdown {{ Request::routeIs('PdfInfoIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-triangle"></i>
                            <span class="menu-text">Pdf Information</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>


                                <li>
                                    <a class="{{ Request::routeIs('PdfInfoIndex') ? 'current-page' : '' }}" href="{{ route('PdfInfoIndex') }}">Pdf Information</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="sidebar-dropdown {{ Request::routeIs('ContactInfoIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-file-text"></i>
                            <span class="menu-text">Contact Info</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>


                                <li>
                                    <a {{ Request::routeIs('ContactInfoIndex') ? 'current-page' : '' }} href="{{ route('ContactInfoIndex') }}">Information</a>
                                </li>

                            </ul>
                        </div>
                    </li>



                    <li class="sidebar-dropdown {{ Request::routeIs('AboutUsIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-star2"></i>
                            <span class="menu-text">About Us</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>


                                <li>
                                    <a class="{{ Request::routeIs('AboutUsIndex') ? 'current-page' : '' }}" href="{{ route('AboutUsIndex') }}">About Us</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="sidebar-dropdown {{ Request::routeIs('OurClientThinkUsIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-box"></i>
                            <span class="menu-text">Our Client Think Of Us</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>


                                <li>
                                    <a class="{{ Request::routeIs('OurClientThinkUsIndex') ? 'current-page' : '' }}" href="{{ route('OurClientThinkUsIndex') }}">View All</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="sidebar-dropdown {{ Request::routeIs('SocialIconIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-border_all"></i>
                            <span class="menu-text">Social Icon</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>


                                <li>
                                    <a class="{{ Request::routeIs('SocialIconIndex') ? 'current-page' : '' }}" href="{{ route('SocialIconIndex') }}">All Icon</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="header-menu">Seo Tools</li>


                    <li class="sidebar-dropdown {{ Request::routeIs('SeoToolsIndex') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-search"></i>
                            <span class="menu-text">Seo Tools</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>


                                <li>
                                    <a class="{{ Request::routeIs('SeoToolsIndex') ? 'current-page' : '' }}" href="{{ route('SeoToolsIndex') }}">All View</a>
                                </li>

                            </ul>
                        </div>
                    </li>



                </ul>
            </div>
            <!-- sidebar menu end -->

        </div>
        <!-- Sidebar content end -->

    </nav>
    <!-- Sidebar wrapper end -->

    <!-- Page content start  -->
    <div class="page-content">

        <!-- Header start -->
        <header class="header">
            <div class="toggle-btns">
                <a id="toggle-sidebar" href="#">
                    <i class="icon-list"></i>
                </a>
                <a id="pin-sidebar" href="#">
                    <i class="icon-list"></i>
                </a>
            </div>
            <div class="header-items">
                <!-- Custom search start -->
                <div class="custom-search">
                    <input type="text" class="search-query" placeholder="Search here ...">
                    <i class="icon-search1"></i>
                </div>
                <!-- Custom search end -->

                <!-- Header actions start -->
                <ul class="header-actions">
                    <li class="dropdown">
                        <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                            <i class="icon-box"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">
                            <div class="dropdown-menu-header">
                                Tasks (05)
                            </div>
                            <ul class="header-tasks">
                                <li>
                                    <p>#20 - Dashboard UI<span>90%</span></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                                            <span class="sr-only">90% Complete (success)</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <p>#35 - Alignment Fix<span>60%</span></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (success)</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <p>#50 - Broken Button<span>40%</span></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                            <i class="icon-bell"></i>
                            <span class="count-label">8</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">
                            <div class="dropdown-menu-header">
                                Notifications (40)
                            </div>
                            <ul class="header-notifications">
                                <li>
                                    <a href="#">
                                        <div class="user-img away">
                                            <img src="img/user21.png" alt="User">
                                        </div>
                                        <div class="details">
                                            <div class="user-title">Abbott</div>
                                            <div class="noti-details">Membership has been ended.</div>
                                            <div class="noti-date">Oct 20, 07:30 pm</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="user-img busy">
                                            <img src="img/user10.png" alt="User">
                                        </div>
                                        <div class="details">
                                            <div class="user-title">Braxten</div>
                                            <div class="noti-details">Approved new design.</div>
                                            <div class="noti-date">Oct 10, 12:00 am</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="user-img online">
                                            <img src="img/user6.png" alt="User">
                                        </div>
                                        <div class="details">
                                            <div class="user-title">Larkyn</div>
                                            <div class="noti-details">Check out every table in detail.</div>
                                            <div class="noti-date">Oct 15, 04:00 pm</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                            <span class="user-name">{{@$info->name}}</span>
                            <span class="avatar">
										<img src="{{(@$info->profile)?url('upload/Admin/Profile/'.$info->profile):''}}" alt="avatar">
										<span class="status busy"></span>
									</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
                            <div class="header-profile-actions">
                                <div class="header-user-profile">
                                    <div class="header-user">
                                        <img src="{{(@$info->profile)?url('upload/Admin/Profile/'.$info->profile):''}}" alt="Admin Template">
                                    </div>
                                    <h5>{{@$info->name}}</h5>
                                    <p>SuperAdmin</p>
                                </div>
                                <a href="{{route('SettingView')}}"><i class="icon-user1"></i> My Profile</a>
                                <a href="{{route('SettingLogoView')}}"><i class="icon-settings1"></i> Account Settings</a>
                                <a href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="icon-log-out1"></i> Sign Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- Header actions end -->
            </div>
        </header>
        <!-- Header end -->

        <!-- Page header start -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item">e-Commerce Design by: <span style="color:red">e-Soft</span></li>
            </ol>

            <ul class="app-actions">
                <li>
                    <a href="#" id="reportrange">
                        <span class="range-text"></span>
                        <i class="icon-chevron-down"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-export"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Page header end -->

        <!-- Main container start -->
        <div class="main-container">

            @yield('admin-content')




        </div>
        <!-- Main container end -->

    </div>
    <!-- Page content end -->

</div>
<!-- Page wrapper end -->

<!--**************************
    **************************
        **************************
                    Required JavaScript Files
        **************************
    **************************
**************************-->
<!-- Required jQuery first, then Bootstrap Bundle JS -->

<script src="{{asset('backend/js/jquery.min.js')}}"></script>
<script src="{{asset('backend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('backend/js/moment.js')}}"></script>
<script type="text/javascript" src="{{ asset('backend/js/handlebars.min.js') }}"></script>

<!-- *************
    ************ Vendor Js Files *************
************* -->
<!-- Slimscroll JS -->
<script src="{{asset('backend/vendor/slimscroll/slimscroll.min.js')}}"></script>
<script src="{{asset('backend/vendor/slimscroll/custom-scrollbar.js')}}"></script>

<!-- Daterange -->
<script src="{{asset('backend/vendor/daterange/daterange.js')}}"></script>
<script src="{{asset('backend/vendor/daterange/custom-daterange.js')}}"></script>

<!-- Polyfill JS -->
<script src="{{asset('backend/vendor/polyfill/polyfill.min.js')}}"></script>

<!-- Apex Charts -->
<script src="{{asset('backend/vendor/apex/apexcharts.min.js')}}"></script>
<script src="{{asset('backend/vendor/apex/admin/visitors.js')}}"></script>
<script src="{{asset('backend/vendor/apex/admin/deals.js')}}"></script>
<script src="{{asset('backend/vendor/apex/admin/income.js')}}"></script>
<script src="{{asset('backend/vendor/apex/admin/customers.js')}}"></script>


<!-- Data Tables -->
<script src="{{asset('backend/vendor/datatables/dataTables.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/dataTables.bootstrap.min.js')}}"></script>

<!-- Custom Data tables -->
<script src="{{asset('backend/vendor/datatables/custom/custom-datatables.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/custom/fixedHeader.js')}}"></script>

<!-- Download / CSV / Copy / Print -->
<script src="{{asset('backend/vendor/datatables/buttons.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/jszip.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/vfs_fonts.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/html5.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/buttons.print.min.js')}}"></script>
<!-- Main JS -->
<script src="{{asset('backend/js/main.js')}}"></script>
<script src="{{asset('fontend/toastr.min..js')}}"></script>



<script src="{{ asset('files/assets/js/custom.js')}}"></script>
<script src="{{ asset('files/assets/ckeditor/ckeditor.js')}}"></script>



<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


@yield('footer')



<script>
    $select2 = $(".js-example-basic-multiple").select2({
        placeholder: "Select"});
</script>


<script>
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr('href');

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to Delete This Item!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {


            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
            window.location.href = link;
        }else{
            Swal('Safe Data');
        }
    })

    })
</script>


<script>
            @if(Session::has('message'))

    var type ="{{ Session::get('alert-type','success') }}";

    switch(type){
        case "success":
            toastr.success("{{ Session::get('message') }}");
            break;
        case "error":
            toastr.error("{{ Session::get('message') }}");
            break;
    }

    @endif
</script>




</body>

<!-- Mirrored from bootstrap.gallery/le-rouge/design/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 23 Oct 2021 11:42:19 GMT -->
</html>