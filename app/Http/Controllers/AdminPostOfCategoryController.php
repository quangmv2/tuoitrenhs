<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PostCategory;
use App\Post;
use App\RoleRelationship;

class AdminPostOfCategoryController extends Controller
{
    function get(Request $request, $unsigned_title)
    {
    	$arr = explode("/", $unsigned_title);
		$category = PostCategory::where('unsigned_name', $arr[count($arr)-1])->get();
		if (count($category) < 1) return view('errors.404');
		$category = $category[0];
		
        $stack = array();
        foreach ($arr as $value) {
        	$cate = PostCategory::where('unsigned_name', $value)->get();
        	foreach ($cate as $element) {
        		$stack[] = $element;
        	}
        }

        $categoryEx = PostCategory::where('parent_id', $category->id)->get();
       
    	$posts = Post::where('category', $category->id)->orderby('highlight', 'desc')->orderby('created_at', 'desc')->paginate(20);
    	$acc = $request->session()->get('account');
        $role = RoleRelationship::where('username', $acc->username)->where('role_id', 8)->get();
    	return view('admin.post.listofcategory', ['categorys'=>$categoryEx, 'list'=>$posts, 'acc'=>$acc, 'role'=>$role,'title'=>$category->name, 'stack'=>$stack]);
    }
}
