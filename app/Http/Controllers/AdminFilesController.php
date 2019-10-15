<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Files;
use App\User;

class AdminFilesController extends Controller
{
    function getList()
    {
    	$files = Files::orderby('created_at', 'desc')->paginate(30);
    	return view('admin.file.list', ['files'=>$files, 'title'=>"Danh sách tệp tin"]);
    }

    function getAdd()
    {
    	return view('admin.file.add', ['title'=>"Thêm mới tệp tin"]);
    }

    function postAdd(Request $request)
    {
    	$this->validate($request, [
    		'title' => 'required',
    		'category' => 'required|numeric|min:1|max:3',
            'file' => 'required|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx|max:51200',
            'status' => 'required|numeric|min:0|max:1',

    	],
    	[
    		'title.required' => "Bạn chưa nhập tiêu đề.",
    		'category.required' => "Bạn chưa chọn loại.",
    		'category.numeric' => "Chọn sai loại.",
            'category.min' => "Chọn sai loại.",
            'category.max' => "Chọn sai loại.",
            'file.required' => "Bạn chưa chọn tệp tin.",
            'file.mimes' => "Tệp tải lên phải có đuôi mở rộng doc, docx, pdf, xls, xlsx, ppt, pptx.",
            'file.max' => "Tệp tải lên không quá 50MB.",
            'status.required' => 'Bạn chưa chọn trạng thái.',
            'status.min' => "Chọn sai trạng thái.",
            'status.max' => "Chọn sai trạng thái.",
    	]);

    	$file = new Files;
    	$file->title = $request->input('title');
        $file->category = $request->input('category');
        $file->status = $request->input('status');
    	if (!empty($request->input('date'))) {
           $dates = explode("T", $request->input('date'));
           $date = explode('-', $dates[0]);
           $time = explode(":", $dates[1]);
           $file->created_at = Carbon::create($date[0], $date[1], $date[2], $time[0], $time[1]);
           $file->updated_at = Carbon::create($date[0], $date[1], $date[2], $time[0], $time[1]);
        }
        $acc = $request->session()->get('account');
        if ($acc->username == "admin") {
            $file->author = "admin";
            $file->name_author = "admin";
        } else {
            $account = User::where('username', $acc->username)->get()[0];
            $file->author = $account->username;
            $file->name_author = $account->profile->name;
        }

        if (empty($request->input('number'))) {
            $file->number = "";
        } else {
            $file->number = $request->input('number');
        }
        if ($request->hasFile('file')) {
            
            $files = $request->file('file');

            $name = $files->getClientOriginalName();
            $names = explode(".", $name);
            $image = $names[0].str_replace(":", "-", str_replace(" ", "_", Carbon::now()))."_".Str::random(6).".".$names[1];
            while (file_exists("uploads/files/post/".$image)) {
                $image =  $names[0].str_replace(":", "-", str_replace(" ", "_", Carbon::now()))."_".Str::random(6).".".$names[1];
            }
            $files->move("uploads/files/post/", $image);
            $file->file = $image;

        } else {
            $file->file = "";
        }
    	$file->save();
    	return redirect()->route('files')->with('notification', "Thêm thành công tệp tin ".$request->input('title').".");
    }

    function getEdit(Request $request, $id)
    {
        $file = Files::find($id);
        if ($file == NULL) return redirect()->route('files')->with('notification', "Tệp tin không tồn tại.");
        $acc = $request->session()->get('account');
        if ($acc->type == 1){

        } else {
            if ($acc->username != $file->author){
                return back()->with('notification', "Bạn không có quyền chỉnh sửa tệp tin này.");
            }
        }
        return view('admin.file.edit', ['title' => "Chỉnh sửa tệp tin", 'file' => $file]);
    }

    function postEdit(Request $request, $id)
    {
        $file = Files::find($id);
        if ($file == NULL) return redirect()->route('files')->with('notification', "Tệp tin không tồn tại.");
        $acc = $request->session()->get('account');
        if ($acc->type == 1){

        } else {
            if ($acc->username != $file->author){
                return back()->with('notification', "Bạn không có quyền chỉnh sửa tệp tin này.");
            }
        }
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required|numeric|min:1|max:3',
            'file' => 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx|max:51200',
            'status' => 'required|numeric|min:0|max:1',

        ],
        [
            'title.required' => "Bạn chưa nhập tiêu đề.",
            'category.required' => "Bạn chưa chọn loại.",
            'category.numeric' => "Chọn sai loại.",
            'category.min' => "Chọn sai loại.",
            'category.max' => "Chọn sai loại.",
            'file.mimes' => "Tệp tải lên phải có đuôi mở rộng doc, docx, pdf, xls, xlsx, ppt, pptx.",
            'file.max' => "Tệp tải lên không quá 50MB.",
            'status.required' => 'Bạn chưa chọn trạng thái.',
            'status.min' => "Chọn sai trạng thái.",
            'status.max' => "Chọn sai trạng thái.",
        ]);

        $arr = [
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'status' => $request->input('status'),
        ];
        if (!empty($request->input('date'))) {
           $dates = explode("T", $request->input('date'));
           $date = explode('-', $dates[0]);
           $time = explode(":", $dates[1]);
           $arr['created_at'] = Carbon::create($date[0], $date[1], $date[2], $time[0], $time[1]);
           $arr['updated_at'] = Carbon::create($date[0], $date[1], $date[2], $time[0], $time[1]);
        }

        if (!empty($request->input('number'))) {
           $arr['number'] = $request->input('number');
        }
        if ($request->hasFile('file')) {
            
            $files = $request->file('file');

            $name = $files->getClientOriginalName();

            $names = explode(".", $name);
            $image = $names[0].str_replace(":", "-", str_replace(" ", "_", Carbon::now()))."_".Str::random(6).".".$names[1];
            while (file_exists("uploads/files/post/".$image)) {
                $image =  $names[0].str_replace(":", "-", str_replace(" ", "_", Carbon::now()))."_".Str::random(6).".".$names[1];
            }
            $files->move("uploads/files/post/", $image);
            if (file_exists("uploads/files/post/".$file->file)) {
                unlink("uploads/files/post/".$file->file);
            }
            $arr['file'] = $image;
        }
        Files::where('id', $id)->update($arr);
        return redirect()->route('files')->with('notification', "Chỉnh sửa thành công tệp tin ".$request->input('title').".");
    }

    function getDelete(Request $request, $id)
    {
    	$file = Files::find($id);
    	if ($file == NULL) return redirect()->route('files')->with('notification', "Tệp tin không tồn tại.");
        $acc = $request->session()->get('account');
        if ($acc->type == 1){

        } else {
            if ($acc->username != $file->author){
                return back()->with('notification', "Bạn không có quyền chỉnh sửa tệp tin này.");
            }
        }
        if (file_exists("uploads/files/post/".$file->file)) {
                unlink("uploads/files/post/".$file->file);
        }
    	Files::where('id', $id)->delete();
    	return redirect()->route('files')->with('notification', "Xóa thành công tệp tin ".$file->title.".");
    }

}
