<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\Setting;
use App\Models\Admin\Page;
use App\Models\Admin\Menu;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function UserPageIndex()
    {
        $data['page'] =   Page::all();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        return view('UserDashboard.Page.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UserPageCreate()
    {
        $data['menu_all'] = Menu::all();
        $data['logo'] = Setting::where('id','1')->first();
        $data['info'] = User::where('id',Auth::user()->id)->first();
        return view('UserDashboard.Page.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function UserPageStore(Request $request)
    {

        $this->validate($request,[
            'title' => 'required',
            'title_uri' => 'required',
            // 'image' => 'required',
        ]);

        $slug = $request->title_uri;


        $store = new Page();
        $store->title = $request->title;
        $store->title_uri = $slug;
        $store->short = $request->short;
        $store->description = $request->description;
        $store->meta_title = $request->meta_title;
        $store->user_id = Auth::User()->id;
        $store->meta_des = $request->meta_des;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fullName = time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(400,400)->save('upload/Admin/page/'.$fullName);
            $store->image = $fullName;
            $store->save();
        }else {
            $fullName = 'default.png';
        }

        $store->save();
        return redirect()->route('UserPageIndex')->with('successMsg','Page Successfully Saved');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function UserPageEdite($id)
    {
        $page =   Page::find($id);
        $menu_all =  Menu::all();
        $logo = Setting::where('id','1')->first();
        $info = User::where('id',Auth::user()->id)->first();

        $parent_root_id = Page::orderBy('id','DESC')
            ->where('title_uri',$page->title_uri)->first();
        $parent_id_for = Menu::orderBy('id','DESC')
            ->where('slug',$parent_root_id->title_uri)->first();

        return view('UserDashboard/Page/edite',compact('page','menu_all','parent_id_for','logo','info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function UserPageUpdate(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'title_uri' => 'required',
            // 'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);


        $slug = $request->title_uri;
        $page = Page::find($id);

        if ($request->hasFile('image')) {

            $image =$request->file('image');
            $fullName = time().'.'.$image->getClientOriginalExtension();
            @unlink('upload/Admin/page/'.$page->image);
            Image::make($image)->resize(400,400)->save('upload/Admin/page/'.$fullName);
            $page->image = $fullName;
            $page->save();
        }else {
            $fullName = $page->image;
        }

        $page->title = $request->title;
        $page->title_uri = $slug;
        $page->short = $request->short;
        $page->description = $request->description;
        $page->meta_title = $request->meta_title;
        $page->user_id = Auth::User()->id;
        $page->meta_des = $request->meta_des;
        $page->image = $fullName;
        $page->save();
        return redirect()->route('UserPageIndex')->with('successMsg','Page Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function UserPageDelete($id)
    {
        $page = Page::find($id);
        if (file_exists('upload/Admin/page/'.$page->image))
        {
            unlink('upload/Admin/page/'.$page->image);
        }
        $page->delete();
        return redirect()->back()->with('successMsg','Page Successfully Deleted');
    }


}
