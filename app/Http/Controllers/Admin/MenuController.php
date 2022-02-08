<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Admin\Menu;
use DB;

class MenuController extends Controller
{
    public function MenuIndex(){
        $data['menu'] =   Menu::all();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        return view('AdminDashboard.Menu.index',$data);
    }
    public function MenuCreate(){

        $data['main'] = Menu::orderBy('id','DESC')
            ->where('display',1)
            ->get();
        $data['sub_main'] = Menu::orderBy('id','ASC')
            ->whereNotNull('root_id')
            ->whereNull('sroot_id')
            ->get();
        $data['sroot_main'] = Menu::orderBy('id','ASC')
            ->whereNotNull('sroot_id')
            ->whereNull('troot_id')
            ->get();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        return view('AdminDashboard/Menu/create',$data);
    }

    public function MenuStore(Request $request){

        // return $request;





        $request->validate([
            'menu_name'=>'required',
        ]);

        $slug = Str::slug($request->menu_name);


        $menu = new Menu();
        $menu->menu_name = $request->menu_name;
        $menu->slug = $slug;
        $menu->root_id = $request->root_id;
        $menu->sroot_id = $request->sroot_id;
        $menu->troot_id = $request->troot_id;
        $menu->page_type = $request->page_type;
        $menu->external_link = $request->external;
        $menu->target = $request->target;
        $menu->display = $request->display;
        $menu->footer1 = $request->footer1;
        $menu->important_link = $request->important_link;
        $menu->customer_service = $request->customer_service;
        $menu->my_account = $request->my_account;
        $menu->sequence = 0;


        $menu->save();
        return redirect()->route('MenuIndex')->with('successMsg','Menu Successfully Saved');


    }


    public function Menusearchajax(Request $req){

        if($req->keywords!="")
        {
            $keywords=$req->keywords;
            $colid=$req->colid;
            $searchresults = DB::table('menus')->where($colid,$keywords)->get();
            $displayvar = '';
            $p1 = "'lastcatid'";
            $p2 = "'sroot_id'";

            if($colid =="root_id"){
                $displayvar .= '<select name="sroot_id" class="form-control" onchange="ajaxSearch(this.value,'.$p1.','.$p2.')">';
            }
            else{
                $displayvar .= '<select name="troot_id" class="form-control">';
            }
            $displayvar .= '<option value="">Select Category</option>';
            foreach($searchresults as $rows):
                $displayvar .='<option value="'.$rows->id.'">'.$rows->menu_name.'</option>';
            endforeach;
            $displayvar .= '</select>';
            echo $displayvar;
        }
        else{
            echo "Null";
        }
    }


    public function MenuEdite($id){
        $logo = Setting::where('id','1')->first();
        $info = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        $menu =   Menu::find($id);

        $main   =   Menu::orderBy('id','DESC')
            ->where('display',1)
            ->get();
        $menu_all   =   Menu::all();

        $parent_root_id = Menu::orderBy('id','DESC')
            ->where('root_id',$menu->root_id)->first();

        $parent_id_for = Menu::orderBy('id','DESC')
            ->where('id',$parent_root_id->root_id)->first();

        $sub_menu_id = Menu::orderBy('id','DESC')
            ->where('sroot_id',$menu->sroot_id)->first();

        $sub_id_for = Menu::orderBy('id','DESC')
            ->where('id',$sub_menu_id->sroot_id)

            ->first();
        $sub_main   =   Menu::orderBy('id','ASC')
            ->whereNotNull('root_id')
            ->whereNull('sroot_id')
            ->get();
        $last_menu_id = Menu::orderBy('id','DESC')
            ->where('troot_id',$menu->troot_id)->first();

        $last_id_for = Menu::orderBy('id','DESC')
            ->where('id',$last_menu_id->troot_id)->first();



        return view('AdminDashboard/Menu/edite',compact('menu','info','logo','sub_main','main','parent_id_for','sub_id_for','menu_all','last_id_for'));
    }

    public function MenuUpdate(Request $request,$id){

        // return $request->all();

        $this->validate($request,[
            'menu_name' => 'required',
        ]);

        $slug = Str::slug($request->menu_name);
        $menu = Menu::find($id);

        $menu->menu_name = $request->menu_name;
        $menu->slug = $slug;
        $menu->root_id = $request->root_id;
        $menu->sroot_id = $request->sroot_id;
        $menu->troot_id = $request->troot_id;
        $menu->page_type = $request->page_type;
        $menu->external_link = $request->external;
        $menu->target = $request->target;
        $menu->display = $request->display;
        $menu->footer1 = $request->footer1;
        $menu->customer_service = $request->customer_service;
        $menu->my_account = $request->my_account;
        $menu->important_link = $request->important_link;


        $menu->save();
        return redirect()->route('MenuIndex')->with('successMsg','Menuu Successfully Updated');
    }


    public function MenuDelete($id){

        $menu = Menu::find($id)->delete();

        return redirect()->back()->with('successMsg','Menu Successfully Deleted');
    }
}
