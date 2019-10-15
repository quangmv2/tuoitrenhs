<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Link;

class AdminLinksController extends Controller
{
    function getList()
    {
    	$links = Link::orderby('created_at', 'desc')->paginate(20);
    	return view('admin.link.list', ['links'=>$links, 'title'=>"Danh sách liên kết"]);
    }

    function getAdd()
    {
    	return view('admin.link.add', ['title'=>"Thêm mới liên kết"]);
    }

    function postAdd(Request $request)
    {
    	$this->validate($request, [
    		'title' => 'required',
    		'link' => 'required|url',
    	],
    	[
    		'title.required' => "Bạn chưa nhập tiêu đề",
    		'link.required' => "Bạn chưa nhập liên kết.",
    		'link.url' => "Liên kết sai",
    	]);

    	$link = new Link;
    	$link->title = $request->input('title');
    	$link->link = $request->input('link');
    	$link->save();
    	return back()->with('notification', "Thêm thành công liên kết ".$request->input('title').".");
    }

    function postEdit(Request $request, $id)
    {
        $link = Link::find($id);
        if ($link == NULL) return redirect()->route('links')->with('notification', "Liên kết không tồn tại.");
        $this->validate($request, [
            'title' => 'required',
            'link' => 'required|url',
        ],
        [
            'title.required' => "Bạn chưa nhập tiêu đề",
            'link.required' => "Bạn chưa nhập liên kết.",
            'link.url' => "Liên kết sai",
        ]);
        $arr['title'] = $request->input('title');
        $arr['link'] = $request->input('link');
        Link::where('id', $id)->update($arr);
        return back()->with('notification', "Chỉnh sửa thành công liên kết ".$link->title.".");
    }

    function getDelete(Request $request, $id)
    {
    	$link = Link::find($id);
    	if ($link == NULL) return redirect()->route('links')->with('notification', "Liên kết không tồn tại.");
        Link::where('id', $id)->delete();
    	return redirect()->route('links')->with('notification', "Xóa thành công liên kết ".$link->title.".");
    }

}
