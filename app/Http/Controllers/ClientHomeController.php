<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmRegister;

use App\Banner;
use App\Post;
use App\Slide;
use App\Slogan;
use App\PostCategory;
use App\Information;
use App\Contact;
use App\Link;
use App\Files;
use App\Video;
class ClientHomeController extends ClientController
{
    function getHome()
    {
    	$slides = Slide::where('status', '=', 1)->orderby('order_num', 'asc')->get();
    	$category = PostCategory::where('status', '=', 1)->where('home', 1)->orderby('order_num', 'asc')->get();
    	$listPosts = array();
    	foreach ($category as $value) {
    		$temp = array();
    		$post = Post::where('active', 1)->where('category', $value->id)->where('status', '=', 1)->where('highlight', '=', 1)->orderby('created_at', 'desc')->take(1)->get();
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
    	$banner = Banner::where('status', 1)->where('order_num', 2)->get();
        $file1 = Files::where('category', 1)->orderby('created_at', 'desc')->paginate(10);
        $file2 = Files::where('category', 2)->orderby('created_at', 'desc')->paginate(10);
        $file3 = Files::where('category', 3)->orderby('created_at', 'desc')->paginate(10);
    	return view('client.home.home', ['slides'=>$slides, 'category'=>$category, 'listPosts'=>$listPosts, 'banner'=>$banner, 'file1'=>$file1, 'file2'=>$file2, 'file3'=>$file3]);
    	
    }

    function getAbout()
    {
    	$slides = Slide::where('status', '=', 1)->orderby('order_num', 'asc')->get();
    	return view('client.about.about', ['slides'=>$slides, 'title'=>"Giới thiệu chung"]);
    }

    function getOrganization()
    {
    	$slides = Slide::where('status', '=', 1)->orderby('order_num', 'asc')->get();
    	return view('client.about.organization', ['slides'=>$slides, 'title'=>"Cơ cấu tổ chức"]);
    }

    function getContact()
    {
    	$slides = Slide::where('status', '=', 1)->orderby('order_num', 'asc')->get();
    	return view('client.about.contact', ['slides'=>$slides, 'title'=>"Liên hệ"]);
    }
    
    function postContact(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required',
    		'phone_number' => 'required|regex:/(0)[0-9]{9}/',
            'email' => 'required|email',
            'content' => 'required',
    	],
    	[
    		'name.required' => 'Bạn chưa nhập họ tên.',
    		'phone_number.required' => 'Bạn chưa nhập số điện thoại.',
            'phone_number.regex' => 'Số điện thoại có ít nhất 10 số.',
            'email.required' => 'Bạn chưa nhập số email.',
            'email.email' => 'Email sai định dạng.',
            'content.required' => 'Bạn chưa nhập nội dung.',
    	]);

    	$contact = new Contact;
    	$contact->name = $request->input('name');
    	$contact->phone_number = $request->input('phone_number');
    	$contact->email = $request->input('email');
    	$contact->content = $request->input('content');
    	$contact->save();
        
        return back()->with('notification', "Gửi thành công liên hệ.");
    }
}
