<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;


use App\PostCategory;
use App\Post;

class AdminPostCategorysController extends Controller
{
    function getList()
    {
    	
    	$listCategorys = PostCategory::orderby('order_num', 'asc')->orderby('parent_id', 'asc')->orderby('menu', 'desc')->orderby('updated_at', 'asc')->paginate(20);
    	return view('admin.category.list', ['list' => $listCategorys, 'title'=>'Danh sách danh mục']);

    }

    function getAdd()
    {
        $category = PostCategory::all();
        $max = PostCategory::max('order_num');
        if (empty($max)) {
            $max = 1;
        } else {
            $max++;
        }
    	return view('admin.category.add', ['title'=>'Thêm mới danh mục', 'category'=>$category, 'max'=>$max]);
    }

    function postAdd(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required',
    		'order_num' => 'required|numeric',
    	], 
    	[
    		'name.required' => 'Bạn chưa nhập tên danh mục',
    		'order_num.required' => 'Bạn chưa nhập thứ tự',
    		'order_num.required' => 'Thứ tự phải là số',
    	]);

        $categorys = PostCategory::where('order_num', $request->input('order_num'))->orderby('order_num', 'asc')->get();
        if (count($categorys) > 0){
            $categorys = PostCategory::where('order_num', '>=', $request->input('order_num'))->orderby('order_num', 'asc')->get();
            $k = $request->input('order_num');
            foreach ($categorys as $value) {
                if ($k != $value->order_num) break;
                $order_num = $value->order_num+1;
                $arr = ['order_num'=>$order_num];
                PostCategory::where('id', '=', $value->id)->update($arr);
                $k++;
                echo $value."<br>";
                echo $order_num."<br>";
            }
        }

    	$category = new PostCategory;
    	$category->name = $request->input('name');
    	$category->unsigned_name = createCategory($request->name);
        $category->parent_id = $request->input('category');
    	$category->menu = $request->input('menu');
    	$category->home = $request->input('home');
    	$category->order_num = $request->input('order_num');
        $category->right_home = $request->input('right_home');
    	$category->status = $request->input('status');

        if ($request->hasFile('imagecate')) {
            
            $file = $request->file('imagecate');

            $name = $file->getClientOriginalName();

            $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
            while (file_exists("uploads/images/categorys".$image)) {
                $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
            }
            $file->move("uploads/images/categorys", $image);
            $category->image = $image;

        }

    	$category->save();
    	return back()->with('notification', "Thêm thành công danh mục ".$request->name.".");

    }

    function getEdit($id)
    {

    	$category = PostCategory::find($id);
        if ($category == NULL) return redirect()->route('categoryList')->with('notification', "Danh mục không tồn tại");
        $categorys = PostCategory::where('id', '<>', $id)->get();
        foreach ($categorys as $index => $value) {
            if (getCategoryParent($category) == getCategoryParent($value) && $category->parent_id != $value->id) {
                unset($categorys[$index]);
            }
        }
    	return view("admin.category.edit", ["list"=>$category, 'category'=>$categorys,'title'=>'Chỉnh sửa danh mục']);

    	
    }

    function postEdit(Request $request, $id)
    {
        $category = PostCategory::find($id);
        if ($category == NULL) return redirect()->route('categoryList')->with('notification', "Danh mục không tồn tại");

    	$this->validate($request, [
            'name' => 'required',
            'imagecate' => 'image|mimes:jpg,jpeg,png,gif|max:51200',
            'order_num' => 'required|numeric',
        ], 
        [
            'name.required' => 'Bạn chưa nhập tên danh mục',
            'order_num.required' => 'Bạn chưa nhập thứ tự',
            'order_num.required' => 'Thứ tự phải là số',
            'imagecate.image' => 'Sai định dạng.',
            'imagecate.mimes' => 'Ảnh đại diện phải có định dạng jpg, jpeg, png hoặc gif.',
            'imagecate.max' => 'Kích thước ảnh đại diện tối đa 50MB.',
        ]);

        $name = $request->input('name');
        $unsigned_name = PostCategory::find($id)->unsigned_name;
        if (utf8tourl($name) != $unsigned_name){
            $unsigned_name = createCategory($name);
        }
        PostCategory::where('id', $id)->update(['order_num'=>0]);
        $categorys = PostCategory::where('id', '<>',$id)->where('order_num', $request->input('order_num'))->orderby('order_num', 'asc')->get();
        if (count($categorys) > 0){
            $category = PostCategory::where('id', '<>', $id)->where('order_num', '>=', $request->input('order_num'))->orderby('order_num', 'asc')->get();
            $k = $request->input('order_num');
            foreach ($category as $value) {
                if ($k != $value->order_num) break;
                $order_num = $value->order_num+1;
                $arr = ['order_num'=>$order_num];
                PostCategory::where('id', '=', $value->id)->update($arr);
                $k++;
                echo $value."<br>";
                echo $order_num."<br>";
            }
        }



        $arr = [ 

                    'name' => $name,
                    'unsigned_name' => $unsigned_name,
                    'parent_id' => $request->input('category'),
                    'menu' => $request->input('menu'),
                    'home' => $request->input('home'),
                    'right_home' => $request->input('right_home'),
                    'order_num' => $request->input('order_num'),
                    'status' => $request->input('status'),

               ];

       if ($request->hasFile('imagecate')) {
    
            $file = $request->file('imagecate');

            $name = $file->getClientOriginalName();

            $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
            while (file_exists("uploads/images/categorys".$image)) {
                $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
            }
            $file->move("uploads/images/categorys", $image);
            $cate = PostCategory::find($id);
            if (file_exists("uploads/images/categorys/".$cate->image)) {
                unlink("uploads/images/categorys/".$cate->image);
            }
            $arr['image'] = $image;

        }
        PostCategory::where('id', '=', $id)->update($arr);
        return redirect()->route('categoryList')->with('notification', "Sửa thành công danh mục ".$request->name.".");
    }

    function getDelete($id)
    {   
        $category = PostCategory::find($id);
        if ($category == NULL) return redirect()->route('categoryList')->with('notification', "Danh mục không tồn tại");
    	$names = PostCategory::find($id)->name;
        $categorys = PostCategory::where('parent_id', '=', $id)->get();
        foreach ($categorys as $value) {
            $this->changeCategory($value->id);
        }
        $cate = PostCategory::find($id);
        if (file_exists("uploads/images/categorys/".$cate->image)) {
            unlink("uploads/images/categorys/".$cate->image);
        }
        Post::where('category', '=', $category->id)->delete();
    	PostCategory::where('id', '=', $id)->delete();
    	return back()->with('notification', "Xóa thành công danh mục ".$names.".");

    }

    function changeCategory($id)
    {
        PostCategory::where('id', '=', $id)->update(['parent_id'=>0]);
    }

}
