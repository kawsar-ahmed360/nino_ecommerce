
<div class="user-profile-header">
    <img alt="logo" src="{{(@$customer_info->image)?url('upload/Client/Customer_Profile/'.$customer_info->image):asset('fontend/demo.jpg')}}">
    <h5 class="mb-1 text-secondary">
        <strong>Hi </strong> @if(@$customer_info->name) {{@$customer_info->name}} @else Gagan @endif
    </h5>
    <p> @if(@$customer_info->mobile){{@$customer_info->mobile}} @else +9999999999 @endif</p>
    <p>
        <a  class="__cf_email__" >@if(@$customer_info->email) {{@$customer_info->email}} @else demo@gmail.com @endif</a>
    </p>
</div>


<div class="list-group">
<a href="{{route('CustomerDashboard')}}" class="list-group-item list-group-item-action">
    <i aria-hidden="true" class="mdi mdi-home-outline"></i> My Dashboard </a>
<a href="{{route('CustomerDashboard')}}" class="list-group-item list-group-item-action {{ Request::routeIs('CustomerDashboard') ? 'active' : '' }}">
    <i aria-hidden="true" class="mdi mdi-account-outline"></i> My Profile </a>
<a href="{{route('CustomerPasswordPage')}}" class="list-group-item list-group-item-action {{ Request::routeIs('CustomerPasswordPage') ? 'active' : '' }}">
    <i aria-hidden="true" class="mdi mdi-key"></i> Password Change </a>
<a href="{{route('customerOrderList')}}" class="list-group-item list-group-item-action {{ Request::routeIs('customerOrderList') ? 'active' : '' }}  {{ Request::routeIs('customerOrderDetails') ? 'active' : '' }} ">
    <i aria-hidden="true" class="mdi mdi-format-list-bulleted"></i> Order List </a>
    <a href="{{route('customerWishList')}}" class="list-group-item list-group-item-action {{ Request::routeIs('customerWishList') ? 'active' : '' }}  {{ Request::routeIs('customerOrderDetails') ? 'active' : '' }} ">
    <i aria-hidden="true" class="mdi mdi-heart"></i> WishList </a>
<a href="{{route('CustomerLogout',base64_encode(\Illuminate\Support\Facades\Session::get('customer_id')))}}" class="list-group-item list-group-item-action">
    <i aria-hidden="true" class="mdi mdi-lock"></i> Logout </a>
</div>