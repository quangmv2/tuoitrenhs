<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\PostMail;

use App\PostCategory;
use App\Post;
use App\User;
use App\RoleRelationship;

class AdminPostController extends Controller
{

	function getList(Request $request)
	{
		
		$posts = Post::orderby('active')->orderby('status', 'desc')->orderby('created_at', 'desc')->orderby('updated_at', 'desc')->paginate(50);
        $acc = $request->session()->get('account');
        $role = RoleRelationship::where('username', $acc->username)->where('role_id', 8)->get(); 
		return view('admin.post.list', ['list'=>$posts, 'title'=>'Danh sách bài viết', 'acc'=>$acc, 'role'=>$role]);

	}

    function getAjax(Request $request)
    {
        if (!isset($_GET['post'])) return;
        $type = $_GET['post']; 
        switch ($type) {
            case 'all':
                $posts = Post::orderby('active')->orderby('status', 'desc')->orderby('created_at', 'desc')->orderby('updated_at', 'desc')->paginate(50);
                break;
            case 'show':
                $posts = Post::where('status', 1)->orderby('active')->orderby('status', 'desc')->orderby('created_at', 'desc')->orderby('updated_at', 'desc')->paginate(50);
                break;
            case 'hidde':
                $posts = Post::where('status', 0)->orderby('active')->orderby('status', 'desc')->orderby('created_at', 'desc')->orderby('updated_at', 'desc')->paginate(50);
                break;
            default:
                $posts = Post::where('highlight', 1)->orderby('active')->orderby('status', 'desc')->orderby('created_at', 'desc')->orderby('updated_at', 'desc')->paginate(50);
                break;
        }

        $page = 1;
        if (isset($_GET['page'])) $page = $_GET['page'];

        $acc = $request->session()->get('account');
        $role = RoleRelationship::where('username', $acc->username)->where('role_id', 8)->get(); 
        return view('admin.post.post-ajax', ['list'=>$posts, 'acc'=>$acc, 'role'=>$role, 'page'=>$page]);
    }

    function getAdd()
    {

    	$category = PostCategory::all();

    	return view('admin.post.add', ['category'=>$category,'title'=>'Thêm mới bài viết']);
    }

    function postAdd(Request $request)
    {
    
    	$this->validate($request,[
    		'title' => 'required',
    		'category' => 'required',
    		'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:51200',
    		'summary' => 'required',
    		'content' => 'required',

    	],
    	[
    		'title.required' => 'Bạn chưa nhập tiêu đề.',
    		'category.required' => 'Bạn chưa chọn danh mục.',
    		'image.required' => 'Bạn chưa chọn ảnh đại diện.',
    		'image.image' => 'Sai định dạng.',
    		'image.mimes' => 'Ảnh đại diện phải có định dạng jpg, jpeg, png hoặc gif.',
    		'image.max' => 'Kích thước ảnh đại diện tối đa 50MB.',
    		'summary.required' => 'Bạn chưa nhập tóm tắt.',
    		'content.required' => 'Bài viết chưa có nội dung.',
   		]);

    	$title = $request->input('title');

    	$post = new Post;
    	$post->title = $title;
    	$post->unsigned_title = createPost($title);
    	$post->category = $request->input('category');
    	$post->summary = $request->input('summary');
    	$post->content = $request->input('content');

        if (!empty($request->input('date'))) {
           $dates = explode("T", $request->input('date'));
           $date = explode('-', $dates[0]);
           $time = explode(":", $dates[1]);
           $post->created_at = Carbon::create($date[0], $date[1], $date[2], $time[0], $time[1]);
           $post->updated_at = Carbon::create($date[0], $date[1], $date[2], $time[0], $time[1]);
        }

    	if ($request->hasFile('image')) {
    		
    		$file = $request->file('image');

    		$name = $file->getClientOriginalName();

    		$image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
    		while (file_exists("uploads/images/posts".$image)) {
    		    $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
    		}
    		$file->move("uploads/images/posts", $image);
    		$post->image = $image;

    	} else {
    		$post->image = "";
    	}
        $acc = $request->session()->get('account');
        $role = RoleRelationship::where('username', $acc->username)->where('role_id', 8)->get();
        if (count($role)>0) {
            $post->active = 1;
            $post->status = 1;
        }
        if ($acc->username == "admin") {
            $post->author = "admin";
            $post->name_author = "admin";
            $post->active = 1;
            $post->status = 1;
        } else {
            $account = User::where('username', $acc->username)->get()[0];
            $post->author = $account->username;
            $post->name_author = $account->profile->name;
        }
    	$post->save();


        if ($post->active != 1){
            $roles = RoleRelationship::where('role_id', 8)->where('username', '<>', $post->author)->get();
            $ad = User::where('type', 1)->where('username', '<>', 'admin')->where('username', '<>', $post->author)->get();
            $arrp = (object) ['view' => 'admin.mail.newPost', 'sub'=>'BÀI VIẾT MỚI "'.$post->title.'"'];
            foreach ($ad as $value) {
                $mail = Mail::to($value->profile->email);
                $mail->queue(new PostMail($arrp));
            }
            // $k = true;
            // foreach ($roles as $value) {
            //     $k = true;
            //     foreach ($ad as $element) {
            //         if ($value->username == $element->username){
            //             $k = false;
            //             break;
            //         }
            //     }
            //     if (k){
                    
            //         $mail = Mail::to($value->profile->email);
            //         $mail->queue(new PostMail($arrp));
            //     }
            // }
        }
       
    	return redirect()->route('posts')->with('notification', "Thêm thành công bài viết ".$title.".");

    }

    function getEdit(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post == NULL) return redirect()->route('posts')->with('notification', "Bài viết không tồn tại");
        $acc = $request->session()->get('account');
        if ($acc->type == 1){

        } else {
            if ($acc->username != $post->author){
                return redirect()->route('posts')->with('notification', "Bạn không có quyền chỉnh sửa bài viết này.");
            }
        }
        
        $category = PostCategory::all();
        $roles = RoleRelationship::where('username', $acc->username)->where('role_id', 8)->get();
        return view('admin.post.edit', ['post' => $post, "category" => $category, 'title'=>'Chỉnh sửa bài viết', 'account'=>$acc, 'roles'=>$roles]);
        
    }

    function postEdit(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post == NULL) return redirect()->route('posts')->with('notification', "Bài viết không tồn tại");
        $acc = $request->session()->get('account');
        if ($acc->type == 1){

        } else {
            if ($acc->username != $post->author){
                return redirect()->route('posts')->with('notification', "Bạn không có quyền chỉnh sửa bài viết này.");
            }
        }
        $this->validate($request,[
            'title' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif|max:51200',
            'summary' => 'required',
            'content' => 'required',

        ],
        [
            'title.required' => 'Bạn chưa nhập tiêu đề.',
            'category.required' => 'Bạn chưa chọn danh mục.',
            'image.image' => 'Sai định dạng.',
            'image.mimes' => 'Ảnh đại diện phải có định dạng jpg, jpeg, png hoặc gif.',
            'image.max' => 'Kích thước ảnh đại diện tối đa 50MB.',
            'summary.required' => 'Bạn chưa nhập tóm tắt.',
            'content.required' => 'Bài viết chưa có nội dung.',
        ]);

        $active = $post->active;
        if ($request->input('status') == 1) {
            $active = 1;
        }

        $names = Post::find($id)->title;
        $title = $request->input('title');
        $unsigned_title = Post::find($id)->unsigned_title;
        if (utf8tourl($title) != $unsigned_title){
            $unsigned_title = createPost($title);
        }
        $image = "";
        if ($request->hasFile('image')) {
            
            $file = $request->file('image');

            $name = $file->getClientOriginalName();

            $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
            while (file_exists("uploads/images/posts".$image)) {
                $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
            }
            $file->move("uploads/images/posts", $image);
            $pt = Post::find($id);
            if (file_exists("uploads/images/posts/".$pt->image)) {
                unlink("uploads/images/posts/".$pt->image);
            }

        } else {
           $image = Post::find($id)->image;
        }
        $roles = RoleRelationship::where('username', $acc->username)->where('role_id', 8)->get();
        if ($acc->type == 1 || count($roles) > 0):
            $arr = [

                    'title' => $title,
                    'unsigned_title' => $unsigned_title,
                    'category' => $request->input('category'),
                    'summary' => $request->input('summary'),
                    'content' => $request->input('content'),
                    'image' => $image,
                    'status' => $request->input('status'),
                    'highlight' => $request->input('highlight'),
                    'active' => $active,

               ];
        else:
            $arr = [

                    'title' => $title,
                    'unsigned_title' => $unsigned_title,
                    'category' => $request->input('category'),
                    'summary' => $request->input('summary'),
                    'content' => $request->input('content'),
                    'image' => $image,

               ];
        endif;

        if (!empty($request->input('date'))) {
           $dates = explode("T", $request->input('date'));
           $date = explode('-', $dates[0]);
           $time = explode(":", $dates[1]);
           Post::where('id', '=', $id)->update(['created_at' => Carbon::create($date[0], $date[1], $date[2], $time[0], $time[1])]);
        }
        
        Post::where('id', '=', $id)->update($arr);
        return redirect()->route('posts')->with('notification', "Sửa thành công bài viết \"".$names."\".");

    }
    function getDelete(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post == NULL) return redirect()->route('posts')->with('notification', "Bài viết không tồn tại");
        $acc = $request->session()->get('account');
        if ($acc->type == 1){

        } else {
            if ($acc->username != $post->author){
                return redirect()->route('posts')->with('notification', "Bạn không có quyền xóa bài viết này.");
            }
        }
        $pt = Post::find($id);
        if (file_exists("uploads/images/posts/".$pt->image)) {
            unlink("uploads/images/posts/".$pt->image);
        }
        Post::where('id', '=', $id)->delete();
        return back()->with('notification', "Xóa thành công bài viết \"".$pt->title."\".");
       
    }

    function getPass(Request $request)
    {   
        $acc = $request->session()->get('account');
        $role = RoleRelationship::where('username', $acc->username)->where('role_id', 8)->get();
        if ($acc->type != 1 && count($role) < 1) return redirect()->route("adminHome")->with('notification', "Bạn không có quyền truy cập");
        $posts = Post::where('active', 0)->orderby('status', 'desc')->orderby('created_at', 'desc')->orderby('updated_at', 'desc')->paginate(10);
        return view('admin.post.pass', ['list'=>$posts, 'title'=>'Phê duyệt bài viết']);
    }

}
