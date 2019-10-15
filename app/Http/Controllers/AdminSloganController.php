<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Slogan;

class AdminSloganController extends Controller
{
    function getList()
    {
    	$slogans = Slogan::orderby('status', 'desc')->orderby('created_at', 'desc')->paginate(20);
    	return view('admin.slogan.list', ['title'=>'Danh sách Slogan', 'slogans'=>$slogans]);
    }

    function getAdd()
    {
    	return view('admin.slogan.add', ['title'=>'Thêm mới Slogan']);
    }

    function postAdd(Request $request)
    {
    	$this->validate($request, [
    		'title' => 'required',
    		'status' => 'required|numeric|min:0|max:1'
    	], 
    	[
    		'title.required' => "Bạn chưa nhập tiêu đề.",
    		'status.required' => "Bạn chưa chọn trạng thái.",
    		'status.numeric' => "Chọn sai trạng thái.",
    		'status.min' => "Chọn sai trạng thái.",
    		'status.max' => "Chọn sai trạng thái.",
    	]);
    	$status = $request->input('status');
    	if ($status > 0){
    		Slogan::where('status', '=', 1)->update(['status'=>0]);
    	}

    	$slogan = new Slogan;
    	$slogan->title = $request->input('title');
    	$slogan->status = $status;
    	$slogan->save();
    	return back()->with('notification', "Thêm thành công slogan ".$request->input('title').".");
    }

    function getEdit(Request $request, $id)
    {
    	$slogan = Slogan::find($id);
    	if ($slogan == null) return back()->with('notification', "Slogan không tồn tại");
    	return view('admin.slogan.edit', ['slogan'=>$slogan, 'title'=>'Chỉnh sửa Slogan']);

    }

    function postEdit(Request $request, $id)
    {
    	$slogan = Slogan::find($id);
    	if ($slogan == null) return back()->with('notification', "Slogan không tồn tại");
    	$this->validate($request, [
    		'title' => 'required',
    		'status' => 'required|numeric|min:0|max:1'
    	], 
    	[
    		'title.required' => "Bạn chưa nhập tiêu đề.",
    		'status.required' => "Bạn chưa chọn trạng thái.",
    		'status.numeric' => "Chọn sai trạng thái.",
    		'status.min' => "Chọn sai trạng thái.",
    		'status.max' => "Chọn sai trạng thái.",
    	]);
    	$status = $request->input('status');
    	if ($status > 0){
    		Slogan::where('status', '=', 1)->update(['status'=>0]);
    	}

    	$arr = ['title'=>$request->input('title'), 'status'=>$status];
    	Slogan::where('id', '=', $id)->update($arr);
    	return back()->with('notification', "Chỉnh sửa thành công Slogan ".$request->input('title').".");	
    }

    function getDelete(Request $request, $id)
    {
    	$slogan = Slogan::find($id);
    	if ($slogan == null) return back()->with('notification', "Slogan không tồn tại");
    	Slogan::where('id', '=', $id)->delete();
    	return back()->with('notification', "Xóa thành công Slogan ".$request->input('title').".");
    }

}
