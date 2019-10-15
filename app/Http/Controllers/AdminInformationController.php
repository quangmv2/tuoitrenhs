<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Information;

class AdminInformationController extends Controller
{
    function get()
    {
    	$information = Information::orderby('created_at', 'desc')->take(1)->get();
    	return view('admin.information.index', ['title'=>'Thông tin', 'information'=>$information]);
    }

    function post(Request $request)
    {
    	$this->validate($request, [
            'about' => 'required',
            'organization' => 'required',
            'image' => 'mimes:ico|max:2048',
            'image_background' => 'mimes:jpg,png,jpeg,gif|max:2048',
    		'fb' => 'required',
    		'yt' => 'required',
    		'map' => 'required',
    		'email' => 'required|email',
    		'address' => 'required',
    		'phone_number' => 'required|regex:/(0)[0-9]{9}/',
    		'admin' => 'required',
    	],
    	[
            'about.required' => 'Bạn chưa nhập giới thiệu',
            'organization.required' => 'Bạn chưa nhập giới thiệu',
            'image.mimes' => 'Biểu tượng phải có định dạng *.ico.',
            'image.max' => 'Kích thước ảnh đại diện tối đa 2MB.',
            'image_background.mimes' => 'Ảnh đại diện phải có định dạng *.png, *.jpg, *.gif.',
            'image_background.max' => 'Kích thước ảnh đại diện tối đa 2MB.',
    		'fb.required' => 'Bạn chưa nhập liên kết Facebook.',
    		'yt.required' => 'Bạn chưa nhập liên kết Youtube.',
    		'map.required' => 'Bạn chưa nhập liên kết Bản đồ.',
    		'email.required' => 'Bạn chưa nhập email.',
    		'email.email' => 'Sai định dạng email.',
    		'address.required' => 'Bạn chưa nhập địa chỉ.',
    		'phone_number.required' => 'Bạn chưa nhập địa chỉ.',
    		'phone_number.regex' => 'Số định dạng là số có 10 chữ số bắt đầu bằng số 0.',
    		'admin.required' => 'Bạn chưa nhập người phụ trách.' 
    	]);

    	$information = new Information;
        $information->about = $request->input('about');
        $information->organization = $request->input('organization');
    	$information->link_fb = $request->input('fb');
    	$information->link_youtube = $request->input('yt');
    	$information->link_map = $request->input('map');
    	$information->email = $request->input('email');
    	$information->address = $request->input('address');
    	$information->phone_number = $request->input('phone_number');
    	$information->admin = $request->input('admin');

        if ($request->hasFile('image')) {
            
            $file = $request->file('image');

            $name = $file->getClientOriginalName();

            $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
            while (file_exists("uploads/images/system/".$image)) {
                $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
            }
            $file->move("uploads/images/system/", $image);
            $info = Information::all();
            if (count($info) > 0) {
                $info = $info[0];
                if (file_exists("uploads/images/system/".$info->icon)) {
                unlink("uploads/images/system/".$info->icon);
                }
            }
            
            $information->icon = $image;

        } else {
            $info = Information::all();
            if (count($info) > 0) {
                $info = $info[0];
                $information->icon = $info->icon;
            }
        }
        if ($request->hasFile('image_background')) {
            
            $file = $request->file('image_background');

            $name = $file->getClientOriginalName();

            $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
            while (file_exists("uploads/images/system/".$image)) {
                $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
            }
            $file->move("uploads/images/system/", $image);
            $info = Information::all();
            if (count($info) > 0) {
                $info = $info[0];
                if (file_exists("uploads/images/system/".$info->image_background)) {
                unlink("uploads/images/system/".$info->image_background);
                }
            }

            $information->image_background = $image;

        } else {
            $info = Information::all();
            if (count($info) > 0) {
                $info = $info[0];
                $information->image_background = $info->image_background;
            }
        }
        
        Information::where('id', '>', 0)->delete();
    	$information->save();
    	return back()->with('notification', "Thêm thành công thông tin.");
    }
}
