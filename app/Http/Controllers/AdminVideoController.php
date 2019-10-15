<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Video;

class AdminVideoController extends Controller
{
    function getList()
    {
    	$videos = Video::orderby('order_num', 'asc')->orderby('status', 'desc')->paginate(20);
    	return view('admin.video.list', ['videos'=>$videos, 'title'=>'Danh sách video']);
    }

    function getAdd()
    {
    	return view('admin.video.add', ['title'=>'Thêm mới video']);
    }

    function postAdd(Request $request)
    {
    	$this->validate($request, [
    		'title' => 'required',
    		'link' => 'required',
    		'order_num' => 'required|numeric|min:1',
    		'status' => 'required|numeric|min:0|max:1'
    	], 
    	[
    		'title.required' => "Bạn chưa nhập tiêu đề.",
    		'link.required' => "Bạn chưa nhập liên kết.",
    		'order_num.required' => "Bạn chưa chọn vị trí.",
    		'order_num.numeric' => "Chọn sai vị trí.",
    		'order_num.min' => "Chọn sai vị trí.",
    		'status.required' => "Bạn chưa chọn trạng thái.",
    		'status.numeric' => "Chọn sai trạng thái.",
    		'status.min' => "Chọn sai trạng thái.",
    		'status.max' => "Chọn sai trạng thái.",
    	]);

    	$videos = Video::where('order_num', '=', $request->input('order_num'))->orderby('order_num', 'asc')->get();
    	if (count($videos) > 0){
    		$videos = Video::where('order_num', '>=', $request->input('order_num'))->get();
    		$k = $request->input('order_num');
    		foreach ($videos as $value) {
    			if ($k != $value->order_num) break;
	    		$order_num = $value->order_num+1;
	    		$arr = ['order_num'=>$order_num];
	    		Video::where('id', '=', $value->id)->update($arr);
	    		$k++;
	    		echo $value."<br>";
				echo $order_num."<br>";
	    	}
    	}
        $link = "";
        $ar = explode("v=", $request->input('link'));
        if (count($ar) > 1){
            $ar = $ar[1];
            $ar = explode("&", $ar);
            if (count($ar) > 0) {
                $link = $ar[0];
            }
        }
        if ($link == "") {
            return back()->with('notification', "Liên kết không đúng.");
        }

    	$video = new Video;
    	$video->title = $request->input('title');
    	$video->link = $link;
    	$video->order_num = $request->input('order_num');
    	$video->status = $request->input('status');
    	$video->save();
    	return back()->with('notification', "Thêm thành công video ".$request->input('title').".");
    }

    function getEdit(Request $request, $id)
    {
    	$video = Video::find($id);
    	if ($video == null) return back()->with('notification', "Video không tồn tại");
    	return view('admin.video.edit', ['video'=>$video, 'title'=>'Chỉnh sửa video']);

    }

    function postEdit(Request $request, $id)
    {
    	$video = Video::find($id);
    	if ($video == null) return back()->with('notification', "Video không tồn tại");
    	$this->validate($request, [
    		'title' => 'required',
    		'link' => 'required',
    		'order_num' => 'required|numeric|min:1',
    		'status' => 'required|numeric|min:0|max:1'
    	], 
    	[
    		'title.required' => "Bạn chưa nhập tiêu đề.",
    		'link.required' => "Bạn chưa nhập liên kết.",
    		'order_num.required' => "Bạn chưa chọn vị trí.",
    		'order_num.numeric' => "Chọn sai vị trí.",
    		'order_num.min' => "Chọn sai vị trí.",
    		'status.required' => "Bạn chưa chọn trạng thái.",
    		'status.numeric' => "Chọn sai trạng thái.",
    		'status.min' => "Chọn sai trạng thái.",
    		'status.max' => "Chọn sai trạng thái.",
    	]);

    	$order_num = $video->order_num;
        echo $order_num;
        echo $request->input('order_num');
        if ($order_num == $request->input('order_num')) goto nextED;
        Video::where('id', '=', $id)->update(['order_num'=>0]);
        $videos = Video::where('order_num', '=', $request->input('order_num'))->orderby('order_num', 'asc')->get();
    	if (count($videos) > 0){
    		$videos = Video::where('order_num', '>=', $request->input('order_num'))->get();
    		$k = $request->input('order_num');
    		foreach ($videos as $value) {
    			if ($k != $value->order_num) break;
	    		$order_num = $value->order_num+1;
	    		$arr = ['order_num'=>$order_num];
	    		Video::where('id', '=', $value->id)->update($arr);
	    		$k++;
	    		echo $value."<br>";
				echo $order_num."<br>";
	    	}
    	} 
        $order_num =$request->input('order_num');
        echo $order_num;

    	nextED:

        $link = "";
        $ar = explode("v=", $request->input('link'));
        if (count($ar) > 1){
            $ar = $ar[1];
            $ar = explode("&", $ar);
            if (count($ar) > 0) {
                $link = $ar[0];
            }
        }
        if ($link == "") {
            return back()->with('notification', "Liên kết không đúng.");
        }

    	$arr = [
                    'title' => $request->input('title'),
                    'link' => $link,
                    'order_num' => $order_num,
                    'status' => $request->input('status'),

               ];
        Video::where('id', '=', $id)->update($arr);
        return back()->with('notification', "Chỉnh sửa thành công video ".$video->title.".");

    }

    function postEditLive(Request $request, $id)
    {
    	$video = Video::find($id);
    	if ($video == null) return back()->with('notification', "Video không tồn tại");
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

    	$order_num = $video->order_num;
        echo $order_num;
        echo $request->input('order_num');
        if ($order_num == $request->input('order_num')) goto nextED;
        Video::where('id', '=', $id)->update(['order_num'=>0]);
        $videos = Video::where('order_num', '=', $request->input('order_num'))->orderby('order_num', 'asc')->get();
    	if (count($videos) > 0){
    		$videos = Video::where('order_num', '>=', $request->input('order_num'))->get();
    		$k = $request->input('order_num');
    		foreach ($videos as $value) {
    			if ($k != $value->order_num) break;
	    		$order_num = $value->order_num+1;
	    		$arr = ['order_num'=>$order_num];
	    		Video::where('id', '=', $value->id)->update($arr);
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
        Video::where('id', '=', $id)->update($arr);
        return back()->with('notification', "Chỉnh sửa thành công video ".$video->title.".");

    }

    function getDelete(Request $request, $id)
    {
    	$video = Video::find($id);
    	if ($video == null) return back()->with('notification', "Video không tồn tại");
    	Video::where('id', '=', $id)->delete();
    	return back()->with('notification', "Xóa thành công video ".$video->title.".");
    }

}
