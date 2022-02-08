<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\LogoManageController;
use App\Http\Controllers\Admin\CategoryManageController;
use App\Http\Controllers\Admin\SliderManageController;
use App\Http\Controllers\Admin\SectionManageController;
use App\Http\Controllers\Admin\ColorManageController;
use App\Http\Controllers\Admin\TagManageController;
use App\Http\Controllers\Admin\PlatingManageController;
use App\Http\Controllers\Admin\ProductManageController;
use App\Http\Controllers\Admin\PurshasController;
use App\Http\Controllers\Admin\DefaultController;
use App\Http\Controllers\Admin\ReportGenarate;
use App\Http\Controllers\Admin\StockReportController;
use App\Http\Controllers\Admin\ShippingChargeController;
use App\Http\Controllers\Admin\PDFInformation;
use App\Http\Controllers\Admin\UserRoleManagement;
use App\Http\Controllers\Admin\SocialIconController;
use App\Http\Controllers\Admin\ContactInformationController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\CouponManageController;
use App\Http\Controllers\Admin\OrderManageAdmin;
use App\Http\Controllers\Admin\MultiOrderPrintController;
use App\Http\Controllers\Admin\OurClientThinkOfUsController;
use App\Http\Controllers\Admin\CustomerManageController;
use App\Http\Controllers\Admin\MultipleUserSendMail;
use App\Http\Controllers\Admin\SeoToolsController;



//Route::get('/mailsend',function(){
//    return view('OrderMail.order_approve_mail');
//});

Auth::routes();

Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
//Route::get('/register/admin', [RegisterController::class,'showAdminRegisterForm']);

Route::post('/login/admin', [LoginController::class,'adminLogin']);
//Route::post('/register/admin', [RegisterController::class,'createAdmin']);

//..........................Default Controller....................
route::get('SuperAdmin/getcategory',[DefaultController::class,'category_id'])->name('category_id');
route::get('SuperAdmin/getproduct',[DefaultController::class,'getPorudct'])->name('getPorudct');


Route::group(['middleware' => 'auth:admin'], function () {

    Route::get('/SuperAdmin/admin-dashboard', [AdminDashboardController::class,'AdminDashboard'])->name('AdminDashboard');

    //................................Admin Profile View And Setting...........................
    Route::get('/SuperAdmin/Setting-view',[SettingController::class,'SettingView'])->name('SettingView');
    Route::post('/SuperAdmin/Setting-update',[SettingController::class,'SettingUpdate'])->name('SettingUpdate');

    //................................Admin Dashboard Logo ...........................
    Route::get('/SuperAdmin/Setting-logo-view',[SettingController::class,'SettingLogoView'])->name('SettingLogoView');
    Route::post('/SuperAdmin/Setting-logo-update',[SettingController::class,'SettingLogoUpdate'])->name('SettingLogoUpdate');

    //................................Menu Section...............................
    route::get('SuperAdmin/Menu/menu-create',[MenuController::class,'MenuCreate'])->name('MenuCreate');
    route::post('SuperAdmin/Menu/menu-store',[MenuController::class,'MenuStore'])->name('MenuStore');
    route::get('SuperAdmin/Menu/menu-index',[MenuController::class,'MenuIndex'])->name('MenuIndex');
    route::get('SuperAdmin/Menu/menu-ajax-search',[MenuController::class,'Menusearchajax'])->name('Menusearchajax');
    route::get('SuperAdmin/Menu/menu-edite/{id}',[MenuController::class,'MenuEdite'])->name('MenuEdite');
    route::post('SuperAdmin/Menu/menu-update/{id}',[MenuController::class,'MenuUpdate'])->name('MenuUpdate');
    route::get('SuperAdmin/Menu/menu-delete/{id}',[MenuController::class,'MenuDelete'])->name('MenuDelete');

    //................................Page Section...............................
    route::get('SuperAdmin/Page/page-create',[PageController::class,'PageCreate'])->name('PageCreate');
    route::post('SuperAdmin/Page/page-store',[PageController::class,'PageStore'])->name('PageStore');
    route::get('SuperAdmin/Page/page-index',[PageController::class,'PageIndex'])->name('PageIndex');
    route::get('SuperAdmin/Page/page-edite/{id}',[PageController::class,'PageEdite'])->name('PageEdite');
    route::post('SuperAdmin/Page/page-update/{id}',[PageController::class,'PageUpdate'])->name('PageUpdate');
    route::get('SuperAdmin/Page/page-delete/{id}',[PageController::class,'PageDelete'])->name('PageDelete');

    //...................................Logo Section.......................
    route::get('SuperAdmin/Logo/logo-index',[LogoManageController::class,'LogoIndex'])->name('LogoIndex');
    route::get('SuperAdmin/Logo/logo-edite/{id}',[LogoManageController::class,'LogoEdite'])->name('LogoEdite');
    route::post('SuperAdmin/Logo/logo-update/{id}',[LogoManageController::class,'LogoUpdate'])->name('LogoUpdate');

    //......................Category Management..............................
    route::get('SuperAdmin/category-index',[CategoryManageController::class,'CategoryIndex'])->name('CategoryIndex');
    route::get('SuperAdmin/categoryCreate',[CategoryManageController::class,'CategoryCreate'])->name('CategoryCreate');
    route::post('SuperAdmin/category-store',[CategoryManageController::class,'CategoryStore'])->name('CategoryStore');
    route::get('SuperAdmin/category_edite/{id}',[CategoryManageController::class,'CategoryEdite'])->name('CategoryEdite');
    route::post('SuperAdmin/category_update',[CategoryManageController::class,'CategoryUpdate'])->name('CategoryUpdate');
    route::get('SuperAdmin/category_delete/{id}',[CategoryManageController::class,'CategoryDelete'])->name('CategoryDelete');
    route::get('SuperAdmin/categoryactive/{id}',[CategoryManageController::class,'Category_active'])->name('Category_active');
    route::get('SuperAdmin/categoryDeactive/{id}',[CategoryManageController::class,'Category_Deactive'])->name('Category_Deactive');

    //.................................Slider Section......................
    route::get('SuperAdmin/Slider/slider-create',[SliderManageController::class,'SliderCreate'])->name('SliderCreate');
    route::post('SuperAdmin/Slider/slider-store',[SliderManageController::class,'SliderStore'])->name('SliderStore');
    route::get('SuperAdmin/Slider/slider-index',[SliderManageController::class,'SliderIndex'])->name('SliderIndex');
    route::get('SuperAdmin/Slider/slider-edite/{id}',[SliderManageController::class,'SliderEdite'])->name('SliderEdite');
    route::post('SuperAdmin/Slider/slider-update',[SliderManageController::class,'SliderUpdate'])->name('SliderUpdate');
    route::get('SuperAdmin/Slider/slider-delete/{id}',[SliderManageController::class,'SliderDelete'])->name('SliderDelete');

    //.................................Section Manage......................
    route::get('SuperAdmin/Section/section-create',[SectionManageController::class,'SectionCreate'])->name('SectionCreate');
    route::post('SuperAdmin/Section/section-store',[SectionManageController::class,'SectionStore'])->name('SectionStore');
    route::get('SuperAdmin/Section/section-index',[SectionManageController::class,'SectionIndex'])->name('SectionIndex');
    route::get('SuperAdmin/Section/section-edite/{id}',[SectionManageController::class,'SectionEdite'])->name('SectionEdite');
    route::post('SuperAdmin/Section/section-update',[SectionManageController::class,'SectionUpdate'])->name('SectionUpdate');
    route::get('SuperAdmin/Section/section-delete/{id}',[SectionManageController::class,'SectionDelete'])->name('SectionDelete');

    //.................................Color Manage......................
    route::get('SuperAdmin/Color/color-create',[ColorManageController::class,'ColorCreate'])->name('ColorCreate');
    route::post('SuperAdmin/Color/color-store',[ColorManageController::class,'ColorStore'])->name('ColorStore');
    route::get('SuperAdmin/Color/color-index',[ColorManageController::class,'ColorIndex'])->name('ColorIndex');
    route::get('SuperAdmin/Color/color-edite/{id}',[ColorManageController::class,'ColorEdite'])->name('ColorEdite');
    route::post('SuperAdmin/Color/color-update',[ColorManageController::class,'ColorUpdate'])->name('ColorUpdate');
    route::get('SuperAdmin/Color/color-delete/{id}',[ColorManageController::class,'ColorDelete'])->name('ColorDelete');

    //.................................Tag Manage......................
    route::post('SuperAdmin/Tag/tag-store',[TagManageController::class,'TagStore'])->name('TagStore');
    route::get('SuperAdmin/Tag/tag-index',[TagManageController::class,'TagIndex'])->name('TagIndex');
    route::get('SuperAdmin/Tag/tag-edite/{id}',[TagManageController::class,'TagEdite'])->name('TagEdite');
    route::post('SuperAdmin/Tag/tag-update',[TagManageController::class,'TagUpdate'])->name('TagUpdate');
    route::get('SuperAdmin/Tag/tag-delete/{id}',[TagManageController::class,'TagDelete'])->name('TagDelete');

    //.................................Plating/Polish Manage......................
    route::post('SuperAdmin/Plating/plating-store',[PlatingManageController::class,'PlatingStore'])->name('PlatingStore');
    route::get('SuperAdmin/Plating/plating-index',[PlatingManageController::class,'PlatingIndex'])->name('PlatingIndex');
    route::get('SuperAdmin/Plating/plating-edite/{id}',[PlatingManageController::class,'PlatingEdite'])->name('PlatingEdite');
    route::post('SuperAdmin/Plating/plating-update',[PlatingManageController::class,'PlatingUpdate'])->name('PlatingUpdate');
    route::get('SuperAdmin/Plating/plating-delete/{id}',[PlatingManageController::class,'PlatingDelete'])->name('PlatingDelete');

    //.................................Product Manage......................
    route::get('SuperAdmin/Product/product-create',[ProductManageController::class,'ProductCreate'])->name('ProductCreate');
    route::post('SuperAdmin/Product/product-store',[ProductManageController::class,'ProductStore'])->name('ProductStore');
    route::get('SuperAdmin/Product/product-index',[ProductManageController::class,'ProductIndex'])->name('ProductIndex');
    route::get('SuperAdmin/Product/product-edite/{id}',[ProductManageController::class,'ProductEdite'])->name('ProductEdite');
    route::post('SuperAdmin/Product/product-update',[ProductManageController::class,'ProductUpdate'])->name('ProductUpdate');
    route::get('SuperAdmin/Product/product-delete/{id}',[ProductManageController::class,'ProductDelete'])->name('ProductDelete');
    route::get('SuperAdmin/Product/product-approve',[ProductManageController::class,'ProductApprove'])->name('ProductApprove');
    route::get('SuperAdmin/Product/product-panding',[ProductManageController::class,'ProductPanding'])->name('ProductPanding');
    route::get('SuperAdmin/Product/product-details-add/{id}',[ProductManageController::class,'ProductDetailsAdd'])->name('ProductDetailsAdd');
    route::post('SuperAdmin/Product/product-details-post',[ProductManageController::class,'ProductDetailsPost'])->name('ProductDetailsPost');
    route::get('SuperAdmin/Product/discount_product/{id}',[ProductManageController::class,'DiscountProduct'])->name('DiscountProduct');
    route::post('SuperAdmin/Product/discount_product_store',[ProductManageController::class,'DiscountProductStore'])->name('DiscountProductStore');
    route::get('SuperAdmin/Product/discount_product',[ProductManageController::class,'OnlyDiscountProduct'])->name('OnlyDiscountProduct');
    //....................................Purshes section..............................

    route::get('SuperAdmin/purshes',[PurshasController::class,'purshesadd'])->name('purshesadd');
    route::post('SuperAdmin/purshesstore',[PurshasController::class,'purshesadd_store'])->name('purshesadd_store');
    route::get('SuperAdmin/purshes_view',[PurshasController::class,'purshesadd_view'])->name('purshesadd_view');
    route::get('SuperAdmin/purshes_edite/{id}',[PurshasController::class,'purshesadd_edite'])->name('purshesadd_edite');
    route::post('SuperAdmin/purshes_update/{id}',[PurshasController::class,'purshesadd_update'])->name('purshesadd_update');
    route::get('SuperAdmin/purshes_delete/{id}',[PurshasController::class,'purshesadd_delete'])->name('purshesadd_delete');
    route::get('SuperAdmin/panding',[PurshasController::class,'panding_purshes'])->name('panding_purshes');
    route::get('SuperAdmin/approve/{id}',[PurshasController::class,'approve_purshes'])->name('approve_purshes');
    route::get('SuperAdmin/purshes_dailyreport',[PurshasController::class,'purshesadd_dailyreport'])->name('purshesadd_dailyreport');
    route::get('SuperAdmin/purshes_dailyreport_genarate',[PurshasController::class,'purshesadd_dailyreport_genarate'])->name('purshesadd_dailyreport_genarate');


    //...............................Reprot Genarate Sectin...................................
    route::get('SuperAdmin/report_genarate',[ReportGenarate::class,'Report_Genarator'])->name('Report_Genarator');
    route::post('SuperAdmin/final_report_genarate',[ReportGenarate::class,'Final_Report_Genarator'])->name('Final_Report_Genarator');
    route::get('SuperAdmin/report_genaratepdf',[ReportGenarate::class,'Pdf_Report_Genarator'])->name('Pdf_Report_Genarator');
    route::post('SuperAdmin/final_report_genaratepdf/',[ReportGenarate::class,'PdfFinal_Report_Genarator'])->name('PdfFinal_Report_Genarator');

    //...............................Stock Report......................
    route::get('SuperAdmin/stock_ganarete_page',[StockReportController::class,'StockGenaratorPage'])->name('StockGenaratorPage');
    route::post('SuperAdmin/categoru_wise_stock',[StockReportController::class,'CategoryWiseStock'])->name('CategoryWiseStock');
    route::get('SuperAdmin/stock_ganarete_pro_ajax',[StockReportController::class,'StockGenaratorProductAjax'])->name('StockGenaratorProductAjax');
    route::post('SuperAdmin/product_wise_stock',[StockReportController::class,'ProductWiseStockGenare'])->name('ProductWiseStockGenare');

    //.....................................Stock Report Genarate Pdf.................................
    route::get('SuperAdmin/stock_ganarete_pdf_page',[StockReportController::class,'StockGenaratorPdfPage'])->name('StockGenaratorPdfPage');
    route::post('SuperAdmin/cat_stock_ganarete_pdf_page',[StockReportController::class,'CatStockGenaratorPdfPage'])->name('CatStockGenaratorPdfPage');
    route::post('SuperAdmin/product_stock_ganarete_pdf_page',[StockReportController::class,'ProductStockGenaratorPdfPage'])->name('ProductStockGenaratorPdfPage');

    route::post('SuperAdmin/category_wise_same_stock',[StockReportController::class,'CategoryWiseSameStockpdf'])->name('CategoryWiseSameStockpdf');
    route::post('SuperAdmin/product_wise_same_stock',[StockReportController::class,'ProductWiseSameStockpdf'])->name('ProductWiseSameStockpdf');

    //................................Shipping Charage Section..............
    Route::get('SuperAdmin/shipping_index',[ShippingChargeController::class,'ShippingIndex'])->name('ShippingIndex');
    Route::post('SuperAdmin/shipping_charge_store',[ShippingChargeController::class,'ShippingChargeStore'])->name('ShippingChargeStore');
    Route::get('SuperAdmin/shipping_edite/{id}',[ShippingChargeController::class,'ShippingEdite'])->name('ShippingEdite');
    Route::post('SuperAdmin/shipping_charge_update',[ShippingChargeController::class,'ShippingChargeUpdate'])->name('ShippingChargeUpdate');
    Route::get('SuperAdmin/shipping_charge_delete/{id}',[ShippingChargeController::class,'ShippingDelete'])->name('ShippingDelete');

    //-----------------------------Shipping Offer---------------------
    Route::post('SuperAdmin/shipping_offer_post',[ShippingChargeController::class,'ShippingOfferPost'])->name('ShippingOfferPost');

    //..........................Pdf Information.................................
    Route::get('SuperAdmin/pdf_information_view',[PDFInformation::class,'PdfInfoIndex'])->name('PdfInfoIndex');
    Route::post('SuperAdmin/pdf_information_update',[PDFInformation::class,'PdfInfoUpdate'])->name('PdfInfoUpdate');

    //.................................Role Manage......................
    route::post('SuperAdmin/Role/role-store',[UserRoleManagement::class,'RoleStore'])->name('RoleStore');
    route::get('SuperAdmin/Role/role-index',[UserRoleManagement::class,'RoleIndex'])->name('RoleIndex');
    route::get('SuperAdmin/Role/role-edite/{id}',[UserRoleManagement::class,'RoleEdite'])->name('RoleEdite');
    route::post('SuperAdmin/Role/role-update',[UserRoleManagement::class,'RoleUpdate'])->name('RoleUpdate');
    route::get('SuperAdmin/Role/role-delete/{id}',[UserRoleManagement::class,'RoleDelete'])->name('RoleDelete');

    //.................................Permission Manage......................
    route::post('SuperAdmin/Permission/permission-store',[UserRoleManagement::class,'PermissionStore'])->name('PermissionStore');
    route::get('SuperAdmin/Permission/permission-index',[UserRoleManagement::class,'PermissionIndex'])->name('PermissionIndex');
    route::get('SuperAdmin/Permission/permission-edite/{id}',[UserRoleManagement::class,'PermissionEdite'])->name('PermissionEdite');
    route::post('SuperAdmin/Permission/permission-update',[UserRoleManagement::class,'PermissionUpdate'])->name('PermissionUpdate');
    route::get('SuperAdmin/Permission/permission-delete/{id}',[UserRoleManagement::class,'PermissionDelete'])->name('PermissionDelete');

    //.................................Custom User Manage......................
    route::get('SuperAdmin/CustomerUser/custom_user-create',[UserRoleManagement::class,'CustomUserCreate'])->name('CustomUserCreate');
    route::post('SuperAdmin/CustomerUser/custom_user-store',[UserRoleManagement::class,'CustomUserStore'])->name('CustomUserStore');
    route::get('SuperAdmin/CustomerUser/custom_user-index',[UserRoleManagement::class,'CustomUserIndex'])->name('CustomUserIndex');
    route::get('SuperAdmin/CustomerUser/custom_user-edite/{id}',[UserRoleManagement::class,'CustomUserEdite'])->name('CustomUserEdite');
    route::post('SuperAdmin/CustomerUser/custom_user-update',[UserRoleManagement::class,'CustomUserUpdate'])->name('CustomUserUpdate');
    route::get('SuperAdmin/CustomerUser/custom_user-delete/{id}',[UserRoleManagement::class,'CustomUsernDelete'])->name('CustomUsernDelete');


    //.................................Social Icon Manage Manage......................
    route::post('SuperAdmin/SocialIcon/social-store',[SocialIconController::class,'SocialIconStore'])->name('SocialIconStore');
    route::get('SuperAdmin/SocialIcon/social-index',[SocialIconController::class,'SocialIconIndex'])->name('SocialIconIndex');
    route::get('SuperAdmin/SocialIcon/social-edite/{id}',[SocialIconController::class,'SocialIconEdite'])->name('SocialIconEdite');
    route::post('SuperAdmin/SocialIcon/social-update',[SocialIconController::class,'SocialIconUpdate'])->name('SocialIconUpdate');
    route::get('SuperAdmin/SocialIcon/social-delete/{id}',[SocialIconController::class,'SocialIconDelete'])->name('SocialIconDelete');

    //.................................Contact Information Manage.....................
    route::get('SuperAdmin/ContactInfo/contact-info-index',[ContactInformationController::class,'ContactInfoIndex'])->name('ContactInfoIndex');
    route::get('SuperAdmin/ContactInfo/contact-info-edite/{id}',[ContactInformationController::class,'ContactInfoEdite'])->name('ContactInfoEdite');
    route::post('SuperAdmin/ContactInfo/contact-info-update',[ContactInformationController::class,'ContactInfoUpdate'])->name('ContactInfoUpdate');

    //.................................About Us Manage.....................
    route::get('SuperAdmin/AboutUs/about-us-index',[AboutUsController::class,'AboutUsIndex'])->name('AboutUsIndex');
    route::get('SuperAdmin/AboutUs/about-us-edite/{id}',[AboutUsController::class,'AboutUsEdite'])->name('AboutUsEdite');
    route::post('SuperAdmin/AboutUs/about-us-update',[AboutUsController::class,'AboutUsUpdate'])->name('AboutUsUpdate');

    //.................................Coupon Manage......................
    route::post('SuperAdmin/Coupon/coupons-manage-store',[CouponManageController::class,'CouponStore'])->name('CouponStore');
    route::get('SuperAdmin/Coupon/coupons-manage-index',[CouponManageController::class,'CouponIndex'])->name('CouponIndex');
    route::get('SuperAdmin/Coupon/coupons-manage-edite/{id}',[CouponManageController::class,'CouponEdite'])->name('CouponEdite');
    route::post('SuperAdmin/Coupon/coupons-manage-update',[CouponManageController::class,'CouponUpdate'])->name('CouponUpdate');
    route::get('SuperAdmin/Coupon/coupons-manage-delete/{id}',[CouponManageController::class,'CouponDelete'])->name('CouponDelete');

    //..............................Order Manage Section.......................
    Route::get('SuperAdmin/Order/CustomerOrderPdf',[OrderManageAdmin::class,'CustomerOrderPDF'])->name('CustomerOrderPDF');
    Route::get('SuperAdmin/Order/CustomerOrder',[OrderManageAdmin::class,'AllCustomerOrder'])->name('AllCustomerOrder');
    Route::get('SuperAdmin/Order/Approveajax',[OrderManageAdmin::class,'AllCustomerApproveAjax'])->name('AllCustomerApproveAjax');
    Route::get('SuperAdmin/Order/Approve',[OrderManageAdmin::class,'AllCustomerApprove'])->name('AllCustomerApprove');
    Route::get('SuperAdmin/Order/NotApprove',[OrderManageAdmin::class,'AllCustomerNotApprove'])->name('AllCustomerNotApprove');
    Route::get('SuperAdmin/Order/ShippingApprove',[OrderManageAdmin::class,'AllCustomerShippingApprove'])->name('AllCustomerShippingApprove');
    Route::get('SuperAdmin/Order/ShippingNotApprove',[OrderManageAdmin::class,'AllCustomerShippingNotApprove'])->name('AllCustomerShippingNotApprove');
    Route::get('SuperAdmin/Order/complete-order',[OrderManageAdmin::class,'AllCustomerOrderComplete'])->name('AllCustomerOrderComplete');
    Route::get('SuperAdmin/Order/order-details/{id}',[OrderManageAdmin::class,'AllCustomerOrderDetails'])->name('AllCustomerOrderDetails');

    //.......................................Panding Order And Approve Order...................
    Route::get('SuperAdmin/PandingOrder/CustomerPandingOrder',[OrderManageAdmin::class,'AllCustomerPandingOrder'])->name('AllCustomerPandingOrder');
    Route::get('SuperAdmin/OrderPanding/Pandingajax',[OrderManageAdmin::class,'AllCustomerPandingAjax'])->name('AllCustomerPandingAjax');
    Route::get('SuperAdmin/OrderPanding/PandingApprove',[OrderManageAdmin::class,'AllCustomerPandingApprove'])->name('AllCustomerPandingApprove');
    Route::get('SuperAdmin/OrderPanding/PandingNotApprove',[OrderManageAdmin::class,'AllCustomerPandingNotApprove'])->name('AllCustomerPandingNotApprove');
    Route::get('SuperAdmin/OrderPanding/PandingShippingApprove',[OrderManageAdmin::class,'AllCustomerPandingShippingApprove'])->name('AllCustomerPandingShippingApprove');
    Route::get('SuperAdmin/OrderPanding/PandingShippingNotApprove',[OrderManageAdmin::class,'AllCustomerPandingShippingNotApprove'])->name('AllCustomerPandingShippingNotApprove');
    Route::get('SuperAdmin/OrderPanding/Pandingcomplete-order',[OrderManageAdmin::class,'AllCustomerPandingOrderComplete'])->name('AllCustomerPandingOrderComplete');
    //........................Complete Order Section..........................
    Route::get('SuperAdmin/Order/CompleteOrderList',[OrderManageAdmin::class,'AllCompleteOrderList'])->name('AllCompleteOrderList');

    //..........................Multiple Order Print...........................
    Route::post('multi-order-print',[MultiOrderPrintController::class,'MultiOrderPront'])->name('MultiOrderPront');

    //....................Multiple User Send Mail.......................
    Route::post('multi-customer-send-mail',[MultipleUserSendMail::class,'MultipleCustomerSendMail'])->name('MultipleCustomerSendMail');

    //.............................. Our Client Think Of Us.......................
    route::post('SuperAdmin/Our-client-think/OurClientThinkUs-store',[OurClientThinkOfUsController::class,'OurClientThinkUsStore'])->name('OurClientThinkUsStore');
    route::get('SuperAdmin/Our-client-think/OurClientThinkUs-index',[OurClientThinkOfUsController::class,'OurClientThinkUsIndex'])->name('OurClientThinkUsIndex');
    route::get('SuperAdmin/Our-client-think/OurClientThinkUs-edite/{id}',[OurClientThinkOfUsController::class,'OurClientThinkUsEdite'])->name('OurClientThinkUsEdite');
    route::post('SuperAdmin/Our-client-think/OurClientThinkUs-update',[OurClientThinkOfUsController::class,'OurClientThinkUsUpdate'])->name('OurClientThinkUsUpdate');
    route::get('SuperAdmin/Our-client-think/OurClientThinkUs-delete/{id}',[OurClientThinkOfUsController::class,'OurClientThinkUsDelete'])->name('OurClientThinkUsDelete');

    //.....................................Customer Manage Section....................
    route::get('SuperAdmin/all-customer/customer-list',[CustomerManageController::class,'AllCustomerList'])->name('AllCustomerList');
    route::get('SuperAdmin/customer-delete/delete-customer/{id}',[CustomerManageController::class,'CustomerDelete'])->name('CustomerDelete');
    route::get('SuperAdmin/customer-view/view-customer/{id}',[CustomerManageController::class,'CustomerView'])->name('CustomerView');
    //..................................Register Customer.....................
    route::get('SuperAdmin/all-register-customer/register-customer-list',[CustomerManageController::class,'AllRegisterCustomerList'])->name('AllRegisterCustomerList');
    route::get('SuperAdmin/register-customer-delete/delete-register-customer/{id}',[CustomerManageController::class,'RegisterCustomerDelete'])->name('RegisterCustomerDelete');
    route::get('SuperAdmin/register-customer-view/view-register-customer/{id}',[CustomerManageController::class,'RegisterCustomerView'])->name('RegisterCustomerView');
     //..................................Gest Customer.....................
    route::get('SuperAdmin/all-gest-customer/gest-customer-list',[CustomerManageController::class,'AllGestCustomerList'])->name('AllGestCustomerList');
    route::get('SuperAdmin/gest-customer-delete/delete-gest-customer/{id}',[CustomerManageController::class,'GestCustomerDelete'])->name('GestCustomerDelete');
    route::get('SuperAdmin/gest-customer-view/view-gest-customer/{id}',[CustomerManageController::class,'GestCustomerView'])->name('GestCustomerView');

    //................................Seo Tools Section .........................
    route::get('SuperAdmin/seo_tools_index/seo-tools-index',[SeoToolsController::class,'SeoToolsIndex'])->name('SeoToolsIndex');
    route::post('SuperAdmin/seo_tools_home_seo_update/seo-tools-home-edite',[SeoToolsController::class,'SeoToolsHomeEdite'])->name('SeoToolsHomeEdite');
    route::post('SuperAdmin/seo_tools_home_seo_update/seo-tools-shop-edite',[SeoToolsController::class,'SeoToolsShopEdite'])->name('SeoToolsShopEdite');
    route::post('SuperAdmin/seo_tools_home_seo_update/seo-tools-contact-edite',[SeoToolsController::class,'SeoToolsContactEdite'])->name('SeoToolsContactEdite');

});
Route::get('logout', [LoginController::class,'logout']);



