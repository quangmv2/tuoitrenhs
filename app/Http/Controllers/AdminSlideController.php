<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Slide;

class AdminSlideController extends Controller
{
    function getList()
    {
    	$slides = Slide::orderby('status', 'desc')->orderby('order_num', 'asc')->paginate(20);
    	return view('admin.slide.list', ['slides'=>$slides, 'title'=>'Danh sách slide']);
    	
    }

    function getAdd()
    {
    	return view('admin.slide.add', ['title'=>'Thêm mới slide']);
    }

    function postAdd(Request $request)
    {
    	$this->validate($request, [
    		'title' => 'required',
    		'summary' => 'required',
    		'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:4096',
    		'link' => 'required',
    		'order_num' => 'required|numeric|min:1',
    		'status' => 'required|numeric|min:0|max:1'
    	], 
    	[
    		'title.required' => "Bạn chưa nhập tiêu đề.",
    		'summary.required' => "Bạn chưa nhập tóm tắt.",
    		'image.required' => "Bạn chưa chọn ảnh tải lên.",
    		'image.image' => "File tải lên không phải là ảnh.",
    		'image.mimes' => "Ảnh tải lên là ảnh jpg, png, jpeg hoặc gif.",
    		'image.max' => "Ảnh tải lên không quá 4MB.",
    		'link.required' => "Bạn chưa nhập liên kết.",
    		'order_num.required' => "Bạn chưa chọn vị trí.",
    		'order_num.numeric' => "Chọn sai vị trí.",
    		'order_num.min' => "Chọn sai vị trí.",
    		'status.required' => "Bạn chưa chọn trạng thái.",
    		'status.numeric' => "Chọn sai trạng thái.",
    		'status.min' => "Chọn sai trạng thái.",
    		'status.max' => "Chọn sai trạng thái.",
    	]);

    	$slides = Slide::where('order_num', '=', $request->input('order_num'))->orderby('order_num', 'asc')->get();
    	if (count($slides) > 0){
    		$slides = Slide::where('order_num', '>=', $request->input('order_num'))->get();
    		$k = $request->input('order_num');
    		foreach ($slides as $value) {
    			if ($k != $value->order_num) break;
	    		$order_num = $value->order_num+1;
	    		$arr = ['order_num'=>$order_num];
	    		Slide::where('id', '=', $value->id)->update($arr);
	    		$k++;
	    		echo $value."<br>";
				echo $order_num."<br>";
	    	}
    	}
    	

    	$slide = new Slide;
    	$slide->title = $request->input('title');
    	$slide->unsigned_title = utf8tourl($request->input('title'));
    	$slide->summary = $request->input('summary');
    	$slide->link = $request->input('link');
    	$slide->order_num = $request->input('order_num');
    	$slide->status = $request->input('status');

    	if ($request->hasFile('image')) {
    		
    		$file = $request->file('image');

    		$name = $file->getClientOriginalName();

    		$image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
    		while (file_exists("uploads/images/slides/".$image)) {
    		    $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
    		}
    		$file->move("uploads/images/slides", $image);
    		$slide->image = $image;
    		echo $image;
    	} else {
    		$slide->image = "";
    	}

    	$slide->save();
    	return back()->with('notification', "Thêm thành công slide ".$request->input('title').".");
    }

    function getEdit($id)
    {
    	$slide = Slide::find($id);
    	if ($slide == null) return back()->with('notification', "Slide không tồn tại");
    	return view('admin.slide.edit', ['slide'=>$slide, 'title'=>'Chỉnh sửa slide']);
    }

    function postEdit(Request $request, $id)
    {
        $slide = Slide::find($id);
        if ($slide == null) return back()->with('notification', "Slide không tồn tại");
        $this->validate($request, [
            'title' => 'required',
            'summary' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif|max:4096',
            'link' => 'required',
            'order_num' => 'required|numeric|min:1',
            'status' => 'required|numeric|min:0|max:1'
        ], 
        [
            'title.required' => "Bạn chưa nhập tiêu đề.",
            'summary.required' => "Bạn chưa nhập tóm tắt.",
            'image.image' => "File tải lên không phải là ảnh.",
            'image.mimes' => "Ảnh tải lên là ảnh jpg, png, jpeg hoặc gif.",
            'image.max' => "Ảnh tải lên không quá 4MB.",
            'link.required' => "Bạn chưa nhập liên kết.",
            'order_num.required' => "Bạn chưa chọn vị trí.",
            'order_num.numeric' => "Chọn sai vị trí.",
            'order_num.min' => "Chọn sai vị trí.",
            'status.required' => "Bạn chưa chọn trạng thái.",
            'status.numeric' => "Chọn sai trạng thái.",
            'status.min' => "Chọn sai trạng thái.",
            'status.max' => "Chọn sai trạng thái.",
        ]);

        $order_num = $slide->order_num;
        echo $order_num;
        echo $request->input('order_num');
        if ($order_num == $request->input('order_num')) goto nextED;
        Slide::where('id', '=', $id)->update(['order_num'=>0]);
        $slides = Slide::where('order_num', '=', $request->input('order_num'))->orderby('order_num', 'asc')->get();
    	if (count($slides) > 0){
    		$slides = Slide::where('order_num', '>=', $request->input('order_num'))->get();
    		$k = $request->input('order_num');
    		foreach ($slides as $value) {
    			if ($k != $value->order_num) break;
	    		$order_num = $value->order_num+1;
	    		$arr = ['order_num'=>$order_num];
	    		Slide::where('id', '=', $value->id)->update($arr);
	    		$k++;
	    		echo $value."<br>";
				echo $order_num."<br>";
	    	}
    	} 
        $order_num =$request->input('order_num');
        echo $order_num;

    	nextED:
       
        $image = $slide->image;
        if ($request->hasFile('image')) {
            
            $file = $request->file('image');

            $name = $file->getClientOriginalName();

            $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
            while (file_exists("uploads/images/slides/".$image)) {
                $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
            }
            $file->move("uploads/images/slides", $image);
            $sl = Slide::find($id);
            if (file_exists("uploads/images/slides/".$sl->image)) {
                unlink("uploads/images/slides/".$sl->image);
            }

        }

        $arr = [
                    'title' => $request->input('title'),
                    'unsigned_title' => utf8tourl($request->input('title')),
                	'summary' => $request->input('summary'),
                    'image' => $image,
                    'link' => $request->input('link'),
                    'order_num' => $order_num,
                    'status' => $request->input('status'),

               ];
        Slide::where('id', '=', $id)->update($arr);
        return back()->with('notification', "Chỉnh sửa thành công slide ".$slide->title.".");
    }

    function postEditLive(Request $request, $id)
    {
        $slide = Slide::find($id);
        if ($slide == null) return back()->with('notification', "Slide không tồn tại");
        $this->validate($request, [
            'order_num' => 'required|numeric|min:1',
            'status' => 'required|numeric|min:0|max:1'
        ], 
        [
            'order_num.required' => "Bạn chưa chọn vị trí.",
            'order_num.numeric' => "Chọn sai vị trí.",
            'order_num.min' => "Chọn sai vị trí.",
            'status.required' => "Bạn chưa chọn trạng thái.",
            'status.numeric' => "Chọn sai trạng thái.",
            'status.min' => "Chọn sai trạng thái.",
            'status.max' => "Chọn sai trạng thái.",
        ]);

        $order_num = $slide->order_num;
        echo $order_num;
        echo $request->input('order_num');
        if ($order_num == $request->input('order_num')) goto nextED;
        Slide::where('id', '=', $id)->update(['order_num'=>0]);
        $slides = Slide::where('order_num', '=', $request->input('order_num'))->orderby('order_num', 'asc')->get();
    	if (count($slides) > 0){
    		$slides = Slide::where('order_num', '>=', $request->input('order_num'))->orderby('order_num', 'asc')->get();
    		$k = $request->input('order_num');
    		foreach ($slides as $value) {
    			if ($k != $value->order_num) break;
	    		$order_num = $value->order_num+1;
	    		$arr = ['order_num'=>$order_num];
	    		Slide::where('id', '=', $value->id)->update($arr);
	    		$k++;
	    		echo $value."<br>";
				echo $order_num."<br>";
	    	}
    	} 
        $order_num =$request->input('order_num');
	    echo $order_num;
    	

    	nextED:
       
        $arr = [
                    'order_num' => $order_num,
                    'status' => $request->input('status'),

               ];
        Slide::where('id', '=', $id)->update($arr);
        return back()->with('notification', "Chỉnh sửa thành công slide ".$slide->title.".");
    }


    function getDelete(Request $request, $id)
    {
    	$slide = Slide::find($id);
        if ($slide == NULL) return back()->with('notification', "Slide không tồn tại");
        if (file_exists("uploads/images/slides/".$slide->image)) {
            unlink("uploads/images/slides/".$slide->image);
        }
        Slide::where('id', '=', $id)->delete();
        return back()->with('notification', "Xóa thành công slide ".$slide->title.".");
    }

}
