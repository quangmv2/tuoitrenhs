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

class ClientSearchController extends ClientController
{

	function get()
	{
		$date1 = getdate()[0];
		$result = "";
		if (isset($_GET['author'])){
			$result = $_GET['author'];
			$postss = Post::where('active', 1)->where('status', '=', 1)->where('name_author', 'like', '%'.$result.'%')->orderby('created_at', 'desc')->paginate(10);
			$postsc = Post::where('active', 1)->where('status', '=', 1)->where('name_author', 'like', '%'.$result.'%')->orderby('created_at', 'desc')->get();
		} else {
			if (isset($_GET['q'])) {
				$result = $_GET['q'];
				$postss = Post::where('active', 1)->where('status', '=', 1)->where('title', 'like', '%'.$result.'%')->orWhere('name_author', 'like', '%'.$result.'%')->orderby('created_at', 'desc')->paginate(10);
				$postsc = Post::where('active', 1)->where('status', '=', 1)->where('title', 'like', '%'.$result.'%')->orWhere('name_author', 'like', '%'.$result.'%')->orderby('created_at', 'desc')->get();
			} else {
				return redirect()->route('home');
			}
		}
		$date2 = getdate()[0];
		if (isset($_GET['page'])) {
			return view('client.search.ajax', ['result'=>$result, 'postss'=>$postss, 'time'=>($date2-$date1), 'count'=>count($postsc)]);
		}
		return view('client.search.search', ['title'=>'Tìm kiếm', 'result'=>$result, 'postss'=>$postss, 'time'=>($date2-$date1), 'count'=>count($postsc)]);
	}



}
