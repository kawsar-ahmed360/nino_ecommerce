<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\SettingController;
use App\Http\Controllers\User\MenuController;
use App\Http\Controllers\User\PageController;
use App\Http\Controllers\User\SliderManageController;
use App\Http\Controllers\User\LogoManageController;
use App\Http\Controllers\User\CategoryManageController;
use App\Http\Controllers\User\SectionManageController;
use App\Http\Controllers\User\TagManageController;
use App\Http\Controllers\User\ColorManageController;
use App\Http\Controllers\User\PlatingManageController;
use App\Http\Controllers\User\ProductManageController;
use App\Http\Controllers\User\PurshasController;
use App\Http\Controllers\User\ReportGenarate;
use App\Http\Controllers\User\StockReportController;
use App\Http\Controllers\User\ShippingChargeController;
use App\Http\Controllers\User\PDFInformation;
use App\Http\Controllers\User\OrderManageUser;
use App\Http\Controllers\User\CouponManageController;
use App\Http\Controllers\User\ContactInformationController;
use App\Http\Controllers\User\AboutUsController;
use App\Http\Controllers\User\SocialIconController;
use App\Http\Controllers\User\OurClientThinkOfUsController;
use App\Http\Controllers\User\CustomerManageController;
use App\Http\Controllers\User\MultiOrderPrintController;
use App\Http\Controllers\User\MultipleUserSendMail;
use App\Http\Controllers\User\SeoToolsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//..........................Default Controller....................
route::get('BasicUser/getcategory',[DefaultController::class,'category_id'])->name('category_id');
route::get('BasicUser/getproduct',[DefaultController::class,'getPorudct'])->name('getPorudct');

Auth::routes();

Route::get('/Nino_User/login', [LoginController::class, 'showLoginForm']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    //................................User Profile View And Setting...........................
    Route::get('/User/Setting-view',[SettingController::class,'UserSettingView'])->name('UserSettingView');
    Route::post('/User/Setting-update',[SettingController::class,'UserSettingUpdate'])->name('UserSettingUpdate');

    //................................Menu Section...............................
    route::get('BasicUser/Menu/menu-create',[MenuController::class,'MenuCreateUser'])->name('MenuCreateUser');
    route::post('BasicUser/Menu/menu-store',[MenuController::class,'MenuStoreUser'])->name('MenuStoreUser');
    route::get('BasicUser/Menu/menu-index',[MenuController::class,'MenuIndexUser'])->name('MenuIndexUser');
    route::get('BasicUser/Menu/menu-ajax-search',[MenuController::class,'MenusearchajaxUser'])->name('MenusearchajaxUser');
    route::get('BasicUser/Menu/menu-edite/{id}',[MenuController::class,'MenuEditeUser'])->name('MenuEditeUser');
    route::post('BasicUser/Menu/menu-update/{id}',[MenuController::class,'MenuUpdateUser'])->name('MenuUpdateUser');
    route::get('BasicUser/Menu/menu-delete/{id}',[MenuController::class,'MenuDeleteUser'])->name('MenuDeleteUser');

    //................................Page Section...............................
    route::get('BasicUser/Page/page-create',[PageController::class,'UserPageCreate'])->name('UserPageCreate');
    route::post('BasicUser/Page/page-store',[PageController::class,'UserPageStore'])->name('UserPageStore');
    route::get('BasicUser/Page/page-index',[PageController::class,'UserPageIndex'])->name('UserPageIndex');
    route::get('BasicUser/Page/page-edite/{id}',[PageController::class,'UserPageEdite'])->name('UserPageEdite');
    route::post('BasicUser/Page/page-update/{id}',[PageController::class,'UserPageUpdate'])->name('UserPageUpdate');
    route::get('BasicUser/Page/page-delete/{id}',[PageController::class,'UserPageDelete'])->name('UserPageDelete');

    //.................................Slider Section......................
    route::get('BasicUser/Slider/slider-create',[SliderManageController::class,'UserSliderCreate'])->name('UserSliderCreate');
    route::post('BasicUser/Slider/slider-store',[SliderManageController::class,'UserSliderStore'])->name('UserSliderStore');
    route::get('BasicUser/Slider/slider-index',[SliderManageController::class,'UserSliderIndex'])->name('UserSliderIndex');
    route::get('BasicUser/Slider/slider-edite/{id}',[SliderManageController::class,'UserSliderEdite'])->name('UserSliderEdite');
    route::post('BasicUser/Slider/slider-update',[SliderManageController::class,'UserSliderUpdate'])->name('UserSliderUpdate');
    route::get('BasicUser/Slider/slider-delete/{id}',[SliderManageController::class,'UserSliderDelete'])->name('UserSliderDelete');

    //...................................Logo Section.......................
    route::get('BasicUser/Logo/logo-index',[LogoManageController::class,'UserLogoIndex'])->name('UserLogoIndex');
    route::get('BasicUser/Logo/logo-edite/{id}',[LogoManageController::class,'UserLogoEdite'])->name('UserLogoEdite');
    route::post('BasicUser/Logo/logo-update/{id}',[LogoManageController::class,'UserLogoUpdate'])->name('UserLogoUpdate');

    //......................Category Management..............................
    route::get('BasicUser/category-index',[CategoryManageController::class,'UserCategoryIndex'])->name('UserCategoryIndex');
    route::get('BasicUser/categoryCreate',[CategoryManageController::class,'UserCategoryCreate'])->name('UserCategoryCreate');
    route::post('BasicUser/category-store',[CategoryManageController::class,'UserCategoryStore'])->name('UserCategoryStore');
    route::get('BasicUser/category_edite/{id}',[CategoryManageController::class,'UserCategoryEdite'])->name('UserCategoryEdite');
    route::post('BasicUser/category_update',[CategoryManageController::class,'UserCategoryUpdate'])->name('UserCategoryUpdate');
    route::get('BasicUser/category_delete/{id}',[CategoryManageController::class,'UserCategoryDelete'])->name('UserCategoryDelete');
    route::get('BasicUser/categoryactive/{id}',[CategoryManageController::class,'UserCategory_active'])->name('UserCategory_active');
    route::get('BasicUser/categoryDeactive/{id}',[CategoryManageController::class,'UserCategory_Deactive'])->name('UserCategory_Deactive');

    //.................................Section Manage......................
    route::get('BasicUser/Section/section-create',[SectionManageController::class,'UserSectionCreate'])->name('UserSectionCreate');
    route::post('BasicUser/Section/section-store',[SectionManageController::class,'UserSectionStore'])->name('UserSectionStore');
    route::get('BasicUser/Section/section-index',[SectionManageController::class,'UserSectionIndex'])->name('UserSectionIndex');
    route::get('BasicUser/Section/section-edite/{id}',[SectionManageController::class,'UserSectionEdite'])->name('UserSectionEdite');
    route::post('BasicUser/Section/section-update',[SectionManageController::class,'UserSectionUpdate'])->name('UserSectionUpdate');
    route::get('BasicUser/Section/section-delete/{id}',[SectionManageController::class,'UserSectionDelete'])->name('UserSectionDelete');

    //.................................Tag Manage......................
    route::post('BasicUser/Tag/tag-store',[TagManageController::class,'UserTagStore'])->name('UserTagStore');
    route::get('BasicUser/Tag/tag-index',[TagManageController::class,'UserTagIndex'])->name('UserTagIndex');
    route::get('BasicUser/Tag/tag-edite/{id}',[TagManageController::class,'UserTagEdite'])->name('UserTagEdite');
    route::post('BasicUser/Tag/tag-update',[TagManageController::class,'UserTagUpdate'])->name('UserTagUpdate');
    route::get('BasicUser/Tag/tag-delete/{id}',[TagManageController::class,'UserTagDelete'])->name('UserTagDelete');

    //.................................Color Manage......................
    route::get('BasicUser/Color/color-create',[ColorManageController::class,'UserColorCreate'])->name('UserColorCreate');
    route::post('BasicUser/Color/color-store',[ColorManageController::class,'UserColorStore'])->name('UserColorStore');
    route::get('BasicUser/Color/color-index',[ColorManageController::class,'UserColorIndex'])->name('UserColorIndex');
    route::get('BasicUser/Color/color-edite/{id}',[ColorManageController::class,'UserColorEdite'])->name('UserColorEdite');
    route::post('BasicUser/Color/color-update',[ColorManageController::class,'UserColorUpdate'])->name('UserColorUpdate');
    route::get('BasicUser/Color/color-delete/{id}',[ColorManageController::class,'UserColorDelete'])->name('UserColorDelete');

    //.................................Plating/Polish Manage......................
    route::post('BasicUser/Plating/plating-store',[PlatingManageController::class,'UserPlatingStore'])->name('UserPlatingStore');
    route::get('BasicUser/Plating/plating-index',[PlatingManageController::class,'UserPlatingIndex'])->name('UserPlatingIndex');
    route::get('BasicUser/Plating/plating-edite/{id}',[PlatingManageController::class,'UserPlatingEdite'])->name('UserPlatingEdite');
    route::post('BasicUser/Plating/plating-update',[PlatingManageController::class,'UserPlatingUpdate'])->name('UserPlatingUpdate');
    route::get('BasicUser/Plating/plating-delete/{id}',[PlatingManageController::class,'UserPlatingDelete'])->name('UserPlatingDelete');

    //.................................Product Manage......................
    route::get('BasicUser/Product/product-create',[ProductManageController::class,'UserProductCreate'])->name('UserProductCreate');
    route::post('BasicUser/Product/product-store',[ProductManageController::class,'UserProductStore'])->name('UserProductStore');
    route::get('BasicUser/Product/product-index',[ProductManageController::class,'UserProductIndex'])->name('UserProductIndex');
    route::get('BasicUser/Product/product-edite/{id}',[ProductManageController::class,'UserProductEdite'])->name('UserProductEdite');
    route::post('BasicUser/Product/product-update',[ProductManageController::class,'UserProductUpdate'])->name('UserProductUpdate');
    route::get('BasicUser/Product/product-delete/{id}',[ProductManageController::class,'UserProductDelete'])->name('UserProductDelete');
    route::get('BasicUser/Product/product-approve',[ProductManageController::class,'UserProductApprove'])->name('UserProductApprove');
    route::get('BasicUser/Product/product-panding',[ProductManageController::class,'UserProductPanding'])->name('UserProductPanding');
    route::get('BasicUser/Product/product-details-add/{id}',[ProductManageController::class,'UserProductDetailsAdd'])->name('UserProductDetailsAdd');
    route::post('BasicUser/Product/product-details-post',[ProductManageController::class,'UserProductDetailsPost'])->name('UserProductDetailsPost');
    route::get('BasicUser/Product/discount_product/{id}',[ProductManageController::class,'UserDiscountProduct'])->name('UserDiscountProduct');
    route::post('BasicUser/Product/discount_product_store',[ProductManageController::class,'UserDiscountProductStore'])->name('UserDiscountProductStore');
    route::get('BasicUser/Product/discount_product',[ProductManageController::class,'UserOnlyDiscountProduct'])->name('UserOnlyDiscountProduct');

    //....................................Purshes section..............................

    route::get('BasicUser/purshes',[PurshasController::class,'Userpurshesadd'])->name('Userpurshesadd');
    route::post('BasicUser/purshesstore',[PurshasController::class,'Userpurshesadd_store'])->name('Userpurshesadd_store');
    route::get('BasicUser/purshes_view',[PurshasController::class,'Userpurshesadd_view'])->name('Userpurshesadd_view');
    route::get('BasicUser/purshes_edite/{id}',[PurshasController::class,'Userpurshesadd_edite'])->name('Userpurshesadd_edite');
    route::post('BasicUser/purshes_update/{id}',[PurshasController::class,'Userpurshesadd_update'])->name('Userpurshesadd_update');
    route::get('BasicUser/purshes_delete/{id}',[PurshasController::class,'Userpurshesadd_delete'])->name('Userpurshesadd_delete');
    route::get('BasicUser/panding',[PurshasController::class,'Userpanding_purshes'])->name('Userpanding_purshes');
    route::get('BasicUser/approve/{id}',[PurshasController::class,'Userapprove_purshes'])->name('Userapprove_purshes');
    route::get('BasicUser/purshes_dailyreport',[PurshasController::class,'Userpurshesadd_dailyreport'])->name('Userpurshesadd_dailyreport');
    route::get('BasicUser/purshes_dailyreport_genarate',[PurshasController::class,'Userpurshesadd_dailyreport_genarate'])->name('Userpurshesadd_dailyreport_genarate');

    //...............................Reprot Genarate Sectin...................................
    route::get('BasicUser/report_genarate',[ReportGenarate::class,'UserReport_Genarator'])->name('UserReport_Genarator');
    route::post('BasicUser/final_report_genarate',[ReportGenarate::class,'UserFinal_Report_Genarator'])->name('UserFinal_Report_Genarator');
    route::get('BasicUser/report_genaratepdf',[ReportGenarate::class,'UserPdf_Report_Genarator'])->name('UserPdf_Report_Genarator');
    route::post('BasicUser/final_report_genaratepdf/',[ReportGenarate::class,'UserPdfFinal_Report_Genarator'])->name('UserPdfFinal_Report_Genarator');

    //...............................Stock Report......................
    route::get('BasicUser/stock_ganarete_page',[StockReportController::class,'UserStockGenaratorPage'])->name('UserStockGenaratorPage');
    route::post('BasicUser/categoru_wise_stock',[StockReportController::class,'UserCategoryWiseStock'])->name('UserCategoryWiseStock');
    route::get('BasicUser/stock_ganarete_pro_ajax',[StockReportController::class,'UserStockGenaratorProductAjax'])->name('UserStockGenaratorProductAjax');
    route::post('BasicUser/product_wise_stock',[StockReportController::class,'UserProductWiseStockGenare'])->name('UserProductWiseStockGenare');
    //.....................................Stock Report Genarate Pdf.................................
    route::get('BasicUser/stock_ganarete_pdf_page',[StockReportController::class,'UserStockGenaratorPdfPage'])->name('UserStockGenaratorPdfPage');
    route::post('BasicUser/cat_stock_ganarete_pdf_page',[StockReportController::class,'UserCatStockGenaratorPdfPage'])->name('UserCatStockGenaratorPdfPage');
    route::post('BasicUser/product_stock_ganarete_pdf_page',[StockReportController::class,'UserProductStockGenaratorPdfPage'])->name('UserProductStockGenaratorPdfPage');

    route::post('BasicUser/category_wise_same_stock',[StockReportController::class,'UserCategoryWiseSameStockpdf'])->name('UserCategoryWiseSameStockpdf');
    route::post('BasicUser/product_wise_same_stock',[StockReportController::class,'UserProductWiseSameStockpdf'])->name('UserProductWiseSameStockpdf');

    //................................Shipping Charage Section..............
    Route::get('BasicUser/shipping_index',[ShippingChargeController::class,'UserShippingIndex'])->name('UserShippingIndex');
    Route::post('BasicUser/shipping_charge_store',[ShippingChargeController::class,'UserShippingChargeStore'])->name('UserShippingChargeStore');
    Route::get('BasicUser/shipping_edite/{id}',[ShippingChargeController::class,'UserShippingEdite'])->name('UserShippingEdite');
    Route::post('BasicUser/shipping_charge_update',[ShippingChargeController::class,'UserShippingChargeUpdate'])->name('UserShippingChargeUpdate');
    Route::get('BasicUser/shipping_charge_delete/{id}',[ShippingChargeController::class,'UserShippingDelete'])->name('UserShippingDelete');
    //-----------------------------Shipping Offer---------------------
    Route::post('BasicUser/shipping_offer_post',[ShippingChargeController::class,'UserShippingOfferPost'])->name('UserShippingOfferPost');

    //..........................Pdf Information.................................
    Route::get('BasicUser/pdf_information_view',[PDFInformation::class,'UserPdfInfoIndex'])->name('UserPdfInfoIndex');
    Route::post('BasicUser/pdf_information_update',[PDFInformation::class,'UserPdfInfoUpdate'])->name('UserPdfInfoUpdate');


    //.................................Social Icon Manage Manage......................
    route::post('BasicUser/SocialIcon/social-store',[SocialIconController::class,'UserSocialIconStore'])->name('UserSocialIconStore');
    route::get('BasicUser/SocialIcon/social-index',[SocialIconController::class,'UserSocialIconIndex'])->name('UserSocialIconIndex');
    route::get('BasicUser/SocialIcon/social-edite/{id}',[SocialIconController::class,'UserSocialIconEdite'])->name('UserSocialIconEdite');
    route::post('BasicUser/SocialIcon/social-update',[SocialIconController::class,'UserSocialIconUpdate'])->name('UserSocialIconUpdate');
    route::get('BasicUser/SocialIcon/social-delete/{id}',[SocialIconController::class,'UserSocialIconDelete'])->name('UserSocialIconDelete');



    //.................................Contact Information Manage.....................
    route::get('BasicUser/ContactInfo/contact-info-index',[ContactInformationController::class,'UserContactInfoIndex'])->name('UserContactInfoIndex');
    route::get('BasicUser/ContactInfo/contact-info-edite/{id}',[ContactInformationController::class,'UserContactInfoEdite'])->name('UserContactInfoEdite');
    route::post('BasicUser/ContactInfo/contact-info-update',[ContactInformationController::class,'UserContactInfoUpdate'])->name('UserContactInfoUpdate');


    //.................................About Us Manage.....................
    route::get('BasicUser/AboutUs/about-us-index',[AboutUsController::class,'UserAboutUsIndex'])->name('UserAboutUsIndex');
    route::get('BasicUser/AboutUs/about-us-edite/{id}',[AboutUsController::class,'UserAboutUsEdite'])->name('UserAboutUsEdite');
    route::post('BasicUser/AboutUs/about-us-update',[AboutUsController::class,'UserAboutUsUpdate'])->name('UserAboutUsUpdate');

    //.................................Coupon Manage......................
    route::post('BasicUser/Coupon/coupons-manage-store',[CouponManageController::class,'UserCouponStore'])->name('UserCouponStore');
    route::get('BasicUser/Coupon/coupons-manage-index',[CouponManageController::class,'UserCouponIndex'])->name('UserCouponIndex');
    route::get('BasicUser/Coupon/coupons-manage-edite/{id}',[CouponManageController::class,'UserCouponEdite'])->name('UserCouponEdite');
    route::post('BasicUser/Coupon/coupons-manage-update',[CouponManageController::class,'UserCouponUpdate'])->name('UserCouponUpdate');
    route::get('BasicUser/Coupon/coupons-manage-delete/{id}',[CouponManageController::class,'UserCouponDelete'])->name('UserCouponDelete');

    //..............................Order Manage Section.......................
    Route::get('BasicUser/Order/CustomerOrderPdf',[OrderManageUser::class,'UserCustomerOrderPDF'])->name('UserCustomerOrderPDF');
    Route::get('BasicUser/Order/CustomerOrder',[OrderManageUser::class,'UserAllCustomerOrder'])->name('UserAllCustomerOrder');
    Route::get('BasicUser/Order/Approveajax',[OrderManageUser::class,'UserAllCustomerApproveAjax'])->name('UserAllCustomerApproveAjax');
    Route::get('BasicUser/Order/Approve',[OrderManageUser::class,'UserAllCustomerApprove'])->name('UserAllCustomerApprove');
    Route::get('BasicUser/Order/NotApprove',[OrderManageUser::class,'UserAllCustomerNotApprove'])->name('UserAllCustomerNotApprove');
    Route::get('BasicUser/Order/ShippingApprove',[OrderManageUser::class,'UserAllCustomerShippingApprove'])->name('UserAllCustomerShippingApprove');
    Route::get('BasicUser/Order/ShippingNotApprove',[OrderManageUser::class,'UserAllCustomerShippingNotApprove'])->name('UserAllCustomerShippingNotApprove');
    Route::get('BasicUser/Order/complete-order',[OrderManageUser::class,'UserAllCustomerOrderComplete'])->name('UserAllCustomerOrderComplete');
      Route::get('BasicUser/Order/order-details/{id}',[OrderManageUser::class,'UserAllCustomerOrderDetails'])->name('UserAllCustomerOrderDetails');

    //.......................................Panding Order And Approve Order...................
    Route::get('BasicUser/PandingOrder/CustomerPandingOrder',[OrderManageUser::class,'UserAllCustomerPandingOrder'])->name('UserAllCustomerPandingOrder');
    Route::get('BasicUser/OrderPanding/Pandingajax',[OrderManageUser::class,'UserAllCustomerPandingAjax'])->name('UserAllCustomerPandingAjax');
    Route::get('BasicUser/OrderPanding/PandingApprove',[OrderManageUser::class,'UserAllCustomerPandingApprove'])->name('UserAllCustomerPandingApprove');
    Route::get('BasicUser/OrderPanding/PandingNotApprove',[OrderManageUser::class,'UserAllCustomerPandingNotApprove'])->name('UserAllCustomerPandingNotApprove');
    Route::get('BasicUser/OrderPanding/PandingShippingApprove',[OrderManageUser::class,'UserAllCustomerPandingShippingApprove'])->name('UserAllCustomerPandingShippingApprove');
    Route::get('BasicUser/OrderPanding/PandingShippingNotApprove',[OrderManageUser::class,'UserAllCustomerPandingShippingNotApprove'])->name('UserAllCustomerPandingShippingNotApprove');
    Route::get('BasicUser/OrderPanding/Pandingcomplete-order',[OrderManageUser::class,'UserAllCustomerPandingOrderComplete'])->name('UserAllCustomerPandingOrderComplete');
    //........................Complete Order Section....................
    Route::get('BasicUser/Order/CompleteOrderList',[OrderManageUser::class,'UserAllCompleteOrderList'])->name('UserAllCompleteOrderList');

    //.............................. Our Client Think Of Us.......................
    route::post('BasicUser/Our-client-think/OurClientThinkUs-store',[OurClientThinkOfUsController::class,'UserOurClientThinkUsStore'])->name('UserOurClientThinkUsStore');
    route::get('BasicUser/Our-client-think/OurClientThinkUs-index',[OurClientThinkOfUsController::class,'UserOurClientThinkUsIndex'])->name('UserOurClientThinkUsIndex');
    route::get('BasicUser/Our-client-think/OurClientThinkUs-edite/{id}',[OurClientThinkOfUsController::class,'UserOurClientThinkUsEdite'])->name('UserOurClientThinkUsEdite');
    route::post('BasicUser/Our-client-think/OurClientThinkUs-update',[OurClientThinkOfUsController::class,'UserOurClientThinkUsUpdate'])->name('UserOurClientThinkUsUpdate');
    route::get('BasicUser/Our-client-think/OurClientThinkUs-delete/{id}',[OurClientThinkOfUsController::class,'UserOurClientThinkUsDelete'])->name('UserOurClientThinkUsDelete');

    //.....................................Customer Manage Section....................
    route::get('BasicUser/all-customer/customer-list',[CustomerManageController::class,'UserAllCustomerList'])->name('UserAllCustomerList');
    route::get('BasicUser/customer-delete/delete-customer/{id}',[CustomerManageController::class,'UserCustomerDelete'])->name('UserCustomerDelete');
    route::get('BasicUser/customer-view/view-customer/{id}',[CustomerManageController::class,'UserCustomerView'])->name('UserCustomerView');
    //..................................Register Customer.....................
    route::get('BasicUser/all-register-customer/register-customer-list',[CustomerManageController::class,'UserAllRegisterCustomerList'])->name('UserAllRegisterCustomerList');
    route::get('BasicUser/register-customer-delete/delete-register-customer/{id}',[CustomerManageController::class,'UserRegisterCustomerDelete'])->name('UserRegisterCustomerDelete');
    route::get('BasicUser/register-customer-view/view-register-customer/{id}',[CustomerManageController::class,'UserRegisterCustomerView'])->name('UserRegisterCustomerView');
    //..................................Gest Customer.....................
    route::get('BasicUser/all-gest-customer/gest-customer-list',[CustomerManageController::class,'UserAllGestCustomerList'])->name('UserAllGestCustomerList');
    route::get('BasicUser/gest-customer-delete/delete-gest-customer/{id}',[CustomerManageController::class,'UserGestCustomerDelete'])->name('UserGestCustomerDelete');
    route::get('BasicUser/gest-customer-view/view-gest-customer/{id}',[CustomerManageController::class,'UserGestCustomerView'])->name('UserGestCustomerView');
    //..........................Multiple Order Print...........................
    Route::post('BasicUser/multi-order-print',[MultiOrderPrintController::class,'UserMultiOrderPront'])->name('UserMultiOrderPront');

    //....................Multiple User Send Mail.......................
    Route::post('BasicUser/multi-customer-send-mail',[MultipleUserSendMail::class,'UserMultipleCustomerSendMail'])->name('UserMultipleCustomerSendMail');

    //................................Seo Tools Section .........................
    route::get('BasicUser/seo_tools_index/seo-tools-index',[SeoToolsController::class,'UserSeoToolsIndex'])->name('UserSeoToolsIndex');
    route::post('BasicUser/seo_tools_home_seo_update/seo-tools-home-edite',[SeoToolsController::class,'UserSeoToolsHomeEdite'])->name('UserSeoToolsHomeEdite');
    route::post('BasicUser/seo_tools_home_seo_update/seo-tools-shop-edite',[SeoToolsController::class,'UserSeoToolsShopEdite'])->name('UserSeoToolsShopEdite');
    route::post('BasicUser/seo_tools_home_seo_update/seo-tools-contact-edite',[SeoToolsController::class,'UserSeoToolsContactEdite'])->name('UserSeoToolsContactEdite');




});
