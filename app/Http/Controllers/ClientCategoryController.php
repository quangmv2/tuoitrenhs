<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Banner;
use App\Post;
use App\Slogan;
use App\PostCategory;
use App\Information;
use App\Link;
use App\Video;

class ClientCategoryController extends ClientController
{
    
	function get($unsigned_title)
	{
		$arr = explode("/", $unsigned_title);
		$category = PostCategory::where('unsigned_name', $arr[count($arr)-1])->get();
		// echo $category->tojson();
		// die();
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
        $listPosts = array();
    	foreach ($categoryEx as $value) {
    		$temp = array();
    		$post = Post::where('active', 1)->where('category', $value->id)->where('status', '=', 1)->where('highlight', '=', 1)->take(1)->get();
    		if (count($post) > 0) {
    			$post1 = Post::where('active', 1)->where('category', $value->id)->where('status', '=', 1)->where('id', '<>', $post[0]->id)->orderby('created_at', 'desc')->take(4)->get();
    		} else {
    			$post1 = Post::where('active', 1)->where('category', $value->id)->where('status', '=', 1)->orderby('created_at', 'desc')->take(5)->get();
    		}
    		
    		foreach ($post1 as $element) {
    			$post[] = $element;
    		}
    		$listPosts[$value->id] = getUrlPost($post);
    	}
    	$posts = Post::where('active', 1)->where('category', $category->id)->where('status', 1)->orderby('highlight', 'desc')->orderby('created_at', 'desc')->paginate(20);

        return view('client.category.detail', ['title'=>$category->name, 'stack'=>$stack, 'category'=>$categoryEx, 'listPosts'=>$listPosts, 'postss'=>getUrlPost($posts), 'cates' => $category]);
	}

}
