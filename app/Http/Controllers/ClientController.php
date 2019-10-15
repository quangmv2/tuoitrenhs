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

class ClientController extends Controller
{
    function __construct()
	{
		$bannerHeader = Banner::where('status', '=', 1)->where('order_num', 1)->get();
		if (count($bannerHeader)>0) {
			$bannerHeader = $bannerHeader[0];
		}
		$postHiglight = Post::where('active', 1)->where('status', '=', 1)->where('highlight', '=', 1)->orderby('updated_at', 'desc')->take(5)->get();
		$slogans = Slogan::where('status', '>', 0)->get();
		$categoryHeader = PostCategory::where('menu', '>', 0)->where('status', '>', 0)->get();
		$informationHeader = Information::orderby('id', 'desc')->take(1)->get();
		$bannerRightContent = Banner::where('status', '=', 1)->where('order_num', 3)->orderby('updated_at', 'desc')->get();
		$categoryRight = PostCategory::where('status', 1)->where('right_home', 1)->get();
		$postNew = Post::where('active', 1)->where('status', '=', 1)->orderby('created_at', 'desc')->take(5)->get();
		$links = Link::all();
		$videos = Video::orderby('order_num')->take(10)->get();
        View::share('videos', $videos);
		View::share('bannerHeader', $bannerHeader);
		View::share('postHiglight', getUrlPost($postHiglight));
		View::share('categoryHeader', $categoryHeader);
		View::share('categoryRight', $categoryRight);
		View::share('informationHeader', $informationHeader);
		View::share('bannerRightContent', $bannerRightContent);
		View::share('postNew', getUrlPost($postNew));
		View::share('links', $links);

		if (count($slogans) < 1){
			view()->share('slogan', 'Chào mừng bạn đến với trang thông tin điện tử.');
		} else {
			view()->share('slogan', $slogans[0]->title);
		}
	}
}
