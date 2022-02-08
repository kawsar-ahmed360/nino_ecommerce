<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\RoleManage;
use App\Models\Admin\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\PermissionManage;
use Illuminate\Support\Facades\Hash;


class UserRoleManagement extends Controller
{
    public function RoleIndex(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['index'] = RoleManage::get();
        return view('AdminDashboard.RoleManage.index',$data);
    }

    public function RoleStore(Request $request){

        $store = new RoleManage();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('RoleIndex')->with($noti);
    }

    public function RoleEdite($id){
        $data['edite'] = RoleManage::where('id',$id)->first();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['index'] = RoleManage::get();
        return view('AdminDashboard.RoleManage.index',$data);
    }

    public function RoleUpdate(Request $request){
        $store =RoleManage::where('id',$request->EditeId)->first();
        $this->save($store,$request);

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('RoleIndex')->with($noti);
    }

    protected function save(RoleManage $store,Request $request){

        $store->role_name = $request->role_name;
        $store->save();
    }

    public function RoleDelete($id){

        RoleManage::where('id',$id)->delete();
        $noti = array(
            'message'=>'successfully Delete',
            'alert-type'=>'success'
        );

        return redirect()->route('RoleIndex')->with($noti);
    }


    //..........................Permission Manage...............

    public function PermissionIndex(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['index'] = PermissionManage::get();
        return view('AdminDashboard.PermissionManage.index',$data);
    }

    public function PermissionStore(Request $request){

        $storePer = new PermissionManage();
        $this->savePermission($storePer,$request);

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('PermissionIndex')->with($noti);
    }

    public function PermissionEdite($id){
        $data['edite'] = PermissionManage::where('id',$id)->first();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['index'] = PermissionManage::get();
        return view('AdminDashboard.PermissionManage.index',$data);
    }

    public function PermissionUpdate(Request $request){
        $storePer =PermissionManage::where('id',$request->EditeId)->first();
        $this->savePermission($storePer,$request);

        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('PermissionIndex')->with($noti);
    }

    protected function savePermission(PermissionManage $storePer,Request $request){

        $storePer->permissin_name = $request->permissin_name;
        $storePer->save();
    }

    public function PermissionDelete($id){

        PermissionManage::where('id',$id)->delete();
        $noti = array(
            'message'=>'successfully Delete',
            'alert-type'=>'success'
        );

        return redirect()->route('PermissionIndex')->with($noti);
    }


    //..........................User Management...................

    public function CustomUserCreate(){
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['role'] = RoleManage::get();
        $data['permission'] = PermissionManage::get();
        return view('AdminDashboard.CustomUser.create',$data);

    }

    public function CustomUserIndex(){

        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['index'] = User::get();
        return view('AdminDashboard.CustomUser.index',$data);
    }

    public function CustomUserStore(Request $request){

        $request->validate([
            'name'=>['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'=>['required', 'string', 'min:8'],
        ]);

        $store =new User();
        $store->name = $request->name;
        $store->email = $request->email;
        $store->role = $request->role;
        $store->after_hash_passowrd = $request->password;
        $store->password =  Hash::make($request->password);
        $store->save();


        foreach(@$request->permission as $key=>$permi){

            $user = User::where('id',$store->id)->first();

            if(@$permi=='Menu Builder'){
                $user->Menu_Builder ='Menu Builder';
            }elseif(@$permi=='Slider Manage'){
                $user->Slider_Manage ='Slider Manage';
            }elseif(@$permi=='Section Manage'){
                $user->Section_Manage ='Section Manage';
            }elseif(@$permi=='Color Manage'){
                $user->Color_Manage ='Color Manage';
            }elseif(@$permi=='Plating Manage'){
                $user->Plating_Manage ='Plating Manage';
            }elseif(@$permi=='Purchase Section'){
                $user->Purchase_Section ='Purchase Section';
            }elseif(@$permi=='Stock Report'){
                $user->Stock_Report ='Stock Report';
            }elseif(@$permi=='Pdf Information'){
                $user->Pdf_Information ='Pdf Information';
            }elseif(@$permi=='Page Builder'){
                $user->Page_Builder ='Page Builder';
            }elseif(@$permi=='Logo Manage'){
                $user->Logo_Manage ='Logo Manage';
            }elseif(@$permi=='Category Manage'){
                $user->Category_Manage ='Category Manage';
            }elseif(@$permi=='Tag Manage'){
                $user->Tag_Manage ='Tag Manage';
            }elseif(@$permi=='Product Manage'){
                $user->Product_Manage ='Product Manage';
            }elseif(@$permi=='Sale Report'){
                $user->Sale_Report ='Sale Report';
            }elseif(@$permi=='Shipment Charge'){
                $user->Shipment_Charge ='Shipment Charge';
            }elseif(@$permi=='Order Manage'){
                $user->Order_Manage ='Order Manage';
            }elseif(@$permi=='Coupon Manage'){
                $user->Coupon_Manage ='Coupon Manage';
            }elseif(@$permi=='Contact Information'){
                $user->Contact_Information ='Contact Information';
            }elseif(@$permi=='About Us'){
                $user->About_Us ='About Us';
            }elseif(@$permi=='Social Icon'){
                $user->Social_Icon ='Social Icon';
            }elseif(@$permi=='Our Client Think Of'){
                $user->Our_Client_Think_Of ='Our Client Think Of';
            }elseif(@$permi=='Customer Manage'){
                $user->Customer_Manage ='Customer Manage';
            }elseif(@$permi=='Seo Tools'){
                $user->Seo_Tools ='Seo Tools';
            }

            $user->save();
        }

        $noti = array(
            'message'=>'successfully Created',
            'alert-type'=>'success'
        );

        return redirect()->route('CustomUserIndex')->with($noti);
    }

    public function CustomUserEdite($id){


        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $data['role'] = RoleManage::get();
        $data['permission'] = PermissionManage::get();
        $data['edite'] = User::where('id',$id)->first();

        return view('AdminDashboard.CustomUser.edite',$data);

    }

    public function CustomUserUpdate(Request $request){


        $request->validate([
            'name'=>['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'email', 'max:255'],
            'password'=>['required', 'string', 'min:8'],
        ]);

        $store =User::where('id',$request->EditeId)->first();
        $store->name = $request->name;
        $store->email = $request->email;
        $store->role = $request->role;
        $store->after_hash_passowrd = $request->password;
        $store->password =  Hash::make($request->password);
        $store->save();




        if(@$request->permission[0]=='Menu Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[1]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[2]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[3]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[4]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[5]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[6]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[7]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[8]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[9]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[10]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[11]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[12]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[13]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[14]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[15]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[16]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[17]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[18]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[19]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[20]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[21]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }elseif(@$request->permission[22]=='Menu Builder'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder ='Menu Builder';
            $user->save();
        }else{
            $user = User::where('id',$request->EditeId)->first();
            $user->Menu_Builder =0;
            $user->save();
        }






        if(@$request->permission[0]=='Slider Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Slider_Manage ='Slider Manage';
                $user->save();
        }elseif(@$request->permission[1]=='Slider Manage'){

                $user = User::where('id',$request->EditeId)->first();
                $user->Slider_Manage ='Slider Manage';
                $user->save();
        }elseif(@$request->permission[2]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[3]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[4]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[5]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[6]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[7]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[8]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[9]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[10]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[11]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[12]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[13]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[14]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[15]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[16]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[17]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[18]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[19]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[20]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[21]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }elseif(@$request->permission[22]=='Slider Manage'){

            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage ='Slider Manage';
            $user->save();
        }else{
            $user = User::where('id',$request->EditeId)->first();
            $user->Slider_Manage =0;
            $user->save();
        }




            if(@$request->permission[0]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[1]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[2]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[3]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[4]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[5]=='Section Manage') {
                $user = User::where('id', $request->EditeId)->first();
                $user->Section_Manage = 'Section Manage';
                $user->save();
            }
            elseif(@$request->permission[6]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[7]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[8]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[9]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[10]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[11]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[12]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[13]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[14]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[15]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[16]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[17]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[18]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[19]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[20]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[21]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }elseif(@$request->permission[22]=='Section Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage ='Section Manage';
                $user->save();
            }else{
                $user = User::where('id',$request->EditeId)->first();
                $user->Section_Manage =0;
                $user->save();
            }







            if(@$request->permission[0]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[1]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[2]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[3]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[4]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[5]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[6]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[7]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[8]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[9]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[10]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[11]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[12]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[13]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[14]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[15]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[16]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[17]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[18]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[19]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[20]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[21]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }elseif(@$request->permission[22]=='Color Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage ='Color Manage';
                $user->save();
            }else{
                $user = User::where('id',$request->EditeId)->first();
                $user->Color_Manage =0;
                $user->save();
            }


            if(@$request->permission[0]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[1]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[2]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[3]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[4]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[5]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[6]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[7]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[8]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[9]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[10]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[11]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[12]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[13]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[14]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[15]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[16]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[17]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[18]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[19]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[20]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[21]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }elseif(@$request->permission[22]=='Plating Manage'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage ='Plating Manage';
                $user->save();
            }else{
                $user = User::where('id',$request->EditeId)->first();
                $user->Plating_Manage =0;
                $user->save();
            }









            if(@$request->permission[0]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[1]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[2]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[3]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[4]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[5]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[6]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[7]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[8]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[9]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[10]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[11]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[12]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[13]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[14]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[15]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[16]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[17]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[18]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[19]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[20]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[21]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }elseif(@$request->permission[22]=='Purchase Section'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section ='Purchase Section';
                $user->save();
            }else{
                $user = User::where('id',$request->EditeId)->first();
                $user->Purchase_Section =0;
                $user->save();
            }




            if(@$request->permission[0]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[1]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[2]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[3]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[4]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[5]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[6]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[7]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[8]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[9]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[10]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[11]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[12]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[13]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[14]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[15]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[16]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[17]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[18]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[19]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[20]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[21]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }elseif(@$request->permission[22]=='Stock Report'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report ='Stock Report';
                $user->save();
            }else{
                $user = User::where('id',$request->EditeId)->first();
                $user->Stock_Report =0;
                $user->save();
            }




            if(@$request->permission[0]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[1]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[2]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[3]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[4]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[5]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[6]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[7]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[8]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[9]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[10]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[11]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[12]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[13]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[14]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[15]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[16]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[17]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[18]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[19]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[20]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[21]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }elseif(@$request->permission[22]=='Pdf Information'){
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information ='Pdf Information';
                $user->save();
            }else{
                $user = User::where('id',$request->EditeId)->first();
                $user->Pdf_Information =0;
                $user->save();
            }





        if(@$request->permission[0]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[1]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[2]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[3]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[4]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[5]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[6]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[7]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[8]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[9]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[10]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[11]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[12]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[13]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[14]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[15]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[16]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[17]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[18]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[19]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[20]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[21]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }elseif(@$request->permission[22]=='Page Builder'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder ='Page Builder';
            $user->save();
        }else{
            $user = User::where('id',$request->EditeId)->first();
            $user->Page_Builder =0;
            $user->save();
        }




        if(@$request->permission[0]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[1]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[2]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[3]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[4]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[5]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[6]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[7]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[8]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[9]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[10]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='PLogo Manage';
            $user->save();
        }elseif(@$request->permission[11]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[12]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[13]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[14]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[15]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[16]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[17]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[18]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[19]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[20]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[21]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }elseif(@$request->permission[22]=='Logo Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage ='Logo Manage';
            $user->save();
        }else{
            $user = User::where('id',$request->EditeId)->first();
            $user->Logo_Manage =0;
            $user->save();
        }




        if(@$request->permission[0]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[1]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[2]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[3]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[4]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[5]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[6]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[7]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[8]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[9]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[10]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[11]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[12]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[13]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[14]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[15]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[16]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[17]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[18]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[19]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[20]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[21]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }elseif(@$request->permission[22]=='Category Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage ='Category Manage';
            $user->save();
        }else{
            $user = User::where('id',$request->EditeId)->first();
            $user->Category_Manage =0;
            $user->save();
        }



        if(@$request->permission[0]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[1]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[2]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[3]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[4]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[5]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[6]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[7]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[8]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[9]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[10]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[11]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[12]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[13]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[14]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[15]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[16]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[17]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[18]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[19]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[20]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[21]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }elseif(@$request->permission[22]=='Tag Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage ='Tag Manage';
            $user->save();
        }else{
            $user = User::where('id',$request->EditeId)->first();
            $user->Tag_Manage =0;
            $user->save();
        }



        if(@$request->permission[0]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[1]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[2]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[3]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[4]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[5]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[6]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[7]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[8]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[9]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[10]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[11]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[12]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[13]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[14]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[15]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[16]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[17]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[18]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[19]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[20]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[21]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }elseif(@$request->permission[22]=='Product Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage ='Product Manage';
            $user->save();
        }else{
            $user = User::where('id',$request->EditeId)->first();
            $user->Product_Manage =0;
            $user->save();
        }







        if(@$request->permission[0]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[1]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[2]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[3]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[4]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[5]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[6]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[7]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[8]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[9]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[10]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[11]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[12]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[13]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[14]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[15]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[16]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[17]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[18]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[19]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[20]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[21]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }elseif(@$request->permission[22]=='Sale Report'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report ='Sale Report';
            $user->save();
        }else{
            $user = User::where('id',$request->EditeId)->first();
            $user->Sale_Report =0;
            $user->save();
        }




        if(@$request->permission[0]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[1]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[2]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[3]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[4]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[5]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[6]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[7]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[8]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[9]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[10]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[11]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[12]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[13]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[14]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[15]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[16]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[17]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[18]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[19]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[20]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[21]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }elseif(@$request->permission[22]=='Shipment Charge'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge ='Shipment Charge';
            $user->save();
        }else{
            $user = User::where('id',$request->EditeId)->first();
            $user->Shipment_Charge =0;
            $user->save();
        }



        if(@$request->permission[0]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[1]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[2]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[3]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[4]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[5]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[6]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[7]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[8]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[9]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[10]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[11]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[12]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[13]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[14]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[15]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[16]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[17]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[18]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[19]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[20]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[21]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }elseif(@$request->permission[22]=='Order Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage ='Order Manage';
            $user->save();
        }else{
            $user = User::where('id',$request->EditeId)->first();
            $user->Order_Manage =0;
            $user->save();
        }



        if(@$request->permission[0]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[1]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[2]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[3]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[4]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[5]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[6]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[7]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[8]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[9]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[10]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[11]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[12]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[13]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[14]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[15]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[16]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[17]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[18]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[19]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[20]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[21]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }elseif(@$request->permission[22]=='Coupon Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage ='Coupon Manage';
            $user->save();
        }else{
            $user = User::where('id',$request->EditeId)->first();
            $user->Coupon_Manage =0;
            $user->save();
        }



        if(@$request->permission[0]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[1]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[2]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[3]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[4]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[5]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[6]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[7]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[8]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[9]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[10]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[11]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[12]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[13]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[14]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[15]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[16]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[17]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[18]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[19]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[20]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[21]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }elseif(@$request->permission[22]=='Contact Information'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information ='Contact Information';
            $user->save();
        }else{
            $user = User::where('id',$request->EditeId)->first();
            $user->Contact_Information =0;
            $user->save();
        }




        if(@$request->permission[0]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[1]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[2]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[3]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[4]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[5]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[6]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[7]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[8]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[9]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[10]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[11]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[12]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[13]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[14]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[15]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[16]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[17]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[18]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[19]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[20]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[21]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }elseif(@$request->permission[22]=='About Us'){
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us ='About Us';
            $user->save();
        }else{
            $user = User::where('id',$request->EditeId)->first();
            $user->About_Us =0;
            $user->save();
        }





        if(@$request->permission[0]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[1]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[2]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[3]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[4]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[5]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[6]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[7]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[8]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[9]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[10]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[11]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[12]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[13]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[14]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[15]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[16]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[17]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[18]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[19]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[20]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[21]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }elseif(@$request->permission[22]=='Social Icon'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon ='Social Icon';
            $user->save();
        }else{
            $user = User::where('id',$request->EditeId)->first();
            $user->Social_Icon =0;
            $user->save();
        }


        //.................Our Client Think...............

        if(@$request->permission[0]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[1]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[2]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[3]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[4]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[5]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[6]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[7]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[8]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[9]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[10]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[11]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[12]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[13]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[14]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[15]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[16]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[17]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[18]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[19]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[20]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[21]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }elseif(@$request->permission[22]=='Our Client Think Of'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of ='Our Client Think Of';
            $user->save();
        }else{
            $user = User::where('id',$request->EditeId)->first();
            $user->Our_Client_Think_Of =0;
            $user->save();
        }

        //.....................Customer Manage................

        if(@$request->permission[0]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[1]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[2]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[3]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[4]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[5]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[6]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[7]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[8]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[9]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[10]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[11]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[12]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[13]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[14]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[15]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[16]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[17]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[18]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[19]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[20]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[21]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }elseif(@$request->permission[22]=='Customer Manage'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage ='Customer Manage';
            $user->save();
        }else{
            $user = User::where('id',$request->EditeId)->first();
            $user->Customer_Manage =0;
            $user->save();
        }



        //.....................Seo Tools Manage................

        if(@$request->permission[0]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[1]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[2]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[3]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[4]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[5]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[6]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[7]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[8]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[9]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[10]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[11]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[12]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[13]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[14]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[15]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[16]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[17]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[18]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[19]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[20]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[21]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }elseif(@$request->permission[22]=='Seo Tools'){
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools ='Seo Tools';
            $user->save();
        }else{
            $user = User::where('id',$request->EditeId)->first();
            $user->Seo_Tools =0;
            $user->save();
        }










        $noti = array(
            'message'=>'successfully Updated',
            'alert-type'=>'success'
        );

        return redirect()->route('CustomUserIndex')->with($noti);

    }


}
