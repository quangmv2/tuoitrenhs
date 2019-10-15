<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Banner;
use App\User;
use App\RoleRelationship;

class AdminBannerController extends Controller
{

    function getList()
    {
    	
    	$banner = Banner::orderby('order_num', 'asc')->orderby('status', 'desc')->orderby('updated_at', 'desc')->paginate(20);

    	return view('admin.banner.list', ['list'=>$banner, 'title'=>'Danh sách banner']);
    }

    function getAdd()
    {
    	
    	return view('admin.banner.add', ['title'=>'Thêm mới banner']);

    }

    function postAdd(Request $request)
    {
    	$this->validate($request, [
    		'title' => 'required',
    		'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:4096',
    		'link' => 'required',
    		'order_num' => 'required|numeric|min:1|max:3',
    		'status' => 'required|numeric|min:0|max:1'
    	], 
    	[
    		'title.required' => "Bạn chưa nhập tiêu đề.",
    		'image.required' => "Bạn chưa chọn ảnh tải lên.",
    		'image.image' => "File tải lên không phải là ảnh.",
    		'image.mimes' => "Ảnh tải lên là ảnh jpg, png, jpeg hoặc gif.",
    		'image.max' => "Ảnh tải lên không quá 4MB.",
    		'link.required' => "Bạn chưa nhập liên kết.",
    		'order_num.required' => "Bạn chưa chọn vị trí.",
    		'order_num.numeric' => "Chọn sai vị trí.",
    		'order_num.min' => "Chọn sai vị trí.",
    		'order_num.max' => "Chọn sai vị trí.",
    		'status.required' => "Bạn chưa chọn trạng thái.",
    		'status.numeric' => "Chọn sai trạng thái.",
    		'status.min' => "Chọn sai trạng thái.",
    		'status.max' => "Chọn sai trạng thái.",
    	]);

    	if (($request->order_num < 2) && ($request->status>0)){
    		$arr = ['status'=>0];
    		Banner::where('order_num', '=', 1)->update($arr);
    	}

    	$banner = new Banner;
    	$banner->title = $request->input('title');
    	$banner->unsigned_title = utf8tourl($request->input('title'));
    	$banner->link = $request->input('link');
    	$banner->order_num = $request->input('order_num');
    	$banner->status = $request->input('status');

    	if ($request->hasFile('image')) {
    		
    		$file = $request->file('image');

    		$name = $file->getClientOriginalName();

    		$image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
    		while (file_exists("uploads/images/banners/".$image)) {
    		    $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
    		}
    		$file->move("uploads/images/banners", $image);
    		$banner->image = $image;

    	} else {
    		$banner->image = "";
    	}
    	$banner->save();
    	return back()->with('notification', "Thêm thành công banner ".$request->input('title').".");

    }

    function getEdit($id)
    {
    	$banner = Banner::find($id);
    	if ($banner == null) return back()->with('notification', "Banner không tồn tại");
    	return view('admin.banner.edit', ['banner'=>$banner, 'title'=>'Chỉnh sửa banner']);
    }

    function postEdit(Request $request, $id)
    {
        $banner = Banner::find($id);
        if ($banner == null) return back()->with('notification', "Banner không tồn tại");
        $this->validate($request, [
            'title' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif|max:4096',
            'link' => 'required',
            'order_num' => 'required|numeric|min:1|max:3',
            'status' => 'required|numeric|min:0|max:1'
        ], 
        [
            'title.required' => "Bạn chưa nhập tiêu đề.",
            'image.image' => "File tải lên không phải là ảnh.",
            'image.mimes' => "Ảnh tải lên là ảnh jpg, png, jpeg hoặc gif.",
            'image.max' => "Ảnh tải lên không quá 4MB.",
            'link.required' => "Bạn chưa nhập liên kết.",
            'order_num.required' => "Bạn chưa chọn vị trí.",
            'order_num.numeric' => "Chọn sai vị trí.",
            'order_num.min' => "Chọn sai vị trí.",
            'order_num.max' => "Chọn sai vị trí.",
            'status.required' => "Bạn chưa chọn trạng thái.",
            'status.numeric' => "Chọn sai trạng thái.",
            'status.min' => "Chọn sai trạng thái.",
            'status.max' => "Chọn sai trạng thái.",
        ]);

        if (($request->order_num < 2) && ($request->status>0)){
            $arr = ['status'=>0];
            Banner::where('order_num', '=', 1)->update($arr);
        }
        $image = $banner->image;
        $imageOld = $image;
        if ($request->hasFile('image')) {
            
            $file = $request->file('image');

            $name = $file->getClientOriginalName();

            $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
            while (file_exists("uploads/images/banners/".$image)) {
                $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
            }
            $file->move("uploads/images/banners", $image);
            if (file_exists("uploads/images/banners/".$imageOld)) {
                unlink("uploads/images/banners/".$imageOld);
            }
            $image = $image;

        }
        $arr = [
                    'title' => $request->input('title'),
                    'unsigned_title' => utf8tourl($request->input('title')),
                    'image' => $image,
                    'link' => $request->input('link'),
                    'order_num' => $request->input('order_num'),
                    'status' => $request->input('status'),

               ];
        Banner::where('id', '=', $id)->update($arr);
        return back()->with('notification', "Chỉnh sửa thành công banner ".$banner->title.".");
    }

    function getDelete($id)
    {
        $banner = Banner::find($id);
        if ($banner == null) return back()->with('notification', "Banner không tồn tại");
        if (file_exists("uploads/images/banners/".$banner->image)) {
                unlink("uploads/images/banners/".$banner->image);
            }
        $banner->delete();
        return back()->with('notification', "Xóa thành công banner ".$banner->title.".");
    }

}
