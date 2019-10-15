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

class ClientPostDetailController extends ClientController
{

    function getPostDetail(Request $request, $unsigned_title, $id)
    {
    	$post = Post::find($id);
        if ($post == NULL) return view('errors.404');
    	$url = changeUrl($post->loaitin);
        if ($post == NULL) return redirect()->route('home');
        if ($post->active == 0 || $post->status < 1) return view('errors.404');
        if ($unsigned_title != $url.$post->unsigned_title) return redirect()->route('postDetail', ['unsigned_title'=>$url.$post->unsigned_title, 'id'=>$id]);
        Post::where('id', $id)->update(['view'=>$post->view + 1],);
        $arr = explode("/", $url);
        $stack = array();
        foreach ($arr as $value) {
        	$category = PostCategory::where('unsigned_name', $value)->get();
        	foreach ($category as $element) {
        		$stack[] = $element;
        	}
        }
        $postss = Post::where('active', 1)->where('status', '=', 1)->where('category', $post->category)->where('id', '<>',$id)->orderby('created_at','desc')->take(10)->get();
        return view('client.post.detail', ['title'=>mb_strtoupper($post->title, 'UTF-8'), 'post'=>$post, 'stack'=>$stack, 'postss'=>$postss]);
    }
}
