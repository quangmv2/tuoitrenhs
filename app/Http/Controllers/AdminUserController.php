<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmRegister;

use App\Profile;
use App\User;
use App\Role;
use App\RoleRelationship;
use App\Post;
use App\PostCategory;



class AdminUserController extends Controller
{

    function home(Request $request)
    {
        $user = $request->session()->get('account');
        if ($user->active < 1) return redirect()->route('getChangePass')->with('notification', 'Đổi mật khẩu để kích hoạt tài khoản.');
        $sumView = Post::sum('view');
        $sumPost = Post::count('id');
        $sumCategory = PostCategory::count('id');
        $sumMember = Profile::count('id');
        return view('admin.home', ['title'=>'Trang chủ', 'sumView'=>$sumView, 'sumPost'=>$sumPost, 'sumCategory'=>$sumCategory, 'sumMember'=>$sumMember]);
    }

    function getListUser(Request $request)
    {   
        $acc = $request->session()->get('account');
        if ($acc->type == 1) $list = User::where('username', '<>', 'admin')->paginate(10); 
    	 else $list = User::where('type', '<>', 1)->where('username', '<>', 'admin')->paginate(10);
    	return view('admin.user.list', ['listUser'=>$list, 'title'=>'Danh sách tài khoản']);
    }

    function getAddUser()
    {
    	$role = Role::all();
    	return view('admin.user.add', ['role'=>$role, 'title'=>'Thêm mới tài khoản']);
    }

    function postAddUser(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'phoneNumber' => 'required|regex:/(0)[0-9]{9}/',
            'email' => 'required|email|unique:profile',
            'address' => 'required',

        ], 
        [

            'name.required' => 'Bạn chưa điền họ và tên',
            'phoneNumber.required' => 'Bạn chưa nhập số điện thoại',
            'phoneNumber.regex' => 'Số điện thoại có ít nhất 10 số',
            'email.required' => 'Bạn chưa nhập số email',
            'email.email' => 'Email sai định dạng',
            'email.unique' => 'Email đã đăng ký',
            'address.required' => 'Bạn chưa nhập địa chỉ',

        ]);
        
        $rd = Str::random(9);
        $acc =createAccount($request->input('name'));
        $user = new User;
        $user->username = $acc;
        $user->password = password_hash($rd, PASSWORD_BCRYPT);
        $user->status = $request->input('status');
        $user->type = 0;
        $user->save();

        $profile = new Profile;
        $profile->name = $request->input('name');
        $profile->phone_number = $request->input('phoneNumber');
        $profile->email = $request->input('email');
        $profile->address = $request->input('address');
        $profile->username_profile = $acc;
        $profile->save();

        
        $roleRelationship = new RoleRelationship;
        $roleRelationship->username = $acc;
        $roleRelationship->role_id = 0;
        $roleRelationship->save();
        $arr = $request->input('chrole');
        if (!empty($arr))
        if (count($arr)>0)
            foreach ($arr as $value) {
                $roleRelationship = new RoleRelationship;
                $roleRelationship->username = $acc;
                $roleRelationship->role_id = $value;
                $roleRelationship->save();
            }
        $arr = (object) ['name'=>$request->input('name'), 'username'=>$acc, 'pass'=>$rd];
        Mail::to($request->input('email'))->send(new ConfirmRegister($arr));
        return redirect()->route('adminUsergetAdd')->with('notification', "Tạo tài khoản thành công. Tên đăng nhập: ".$acc." Mật khẩu: ".$rd);

    }

    function getResetPass($username)
    {
        $user = User::where('username','=', $username)->get();
        if ($user == NULL) {
            return redirect()->route('adminUsergetList')->with('notification', "Tài khoản không tồn tại");
        }
        $rd = Str::random(9);
        $password = password_hash($rd, PASSWORD_BCRYPT);
        User::where('username', '=', $username)->update(['password'=>$password, 'active'=>0]);
        return back()->with('notification', "Reset tài khoản thành công. Tên đăng nhập: ".$username." Mật khẩu: ".$rd);
    }

    function getDelete($username)
    {
        $user = User::where('username','=', $username)->get();
        if ($user == NULL) {
            return redirect()->route('adminUsergetList')->with('notification', "Tài khoản không tồn tại");
        }
        $pf = Profile::where('username_profile', $user[0]->username)->get();
        if (count($pf)>0) {
            $pf = $pf[0];
            if (file_exists("uploads/images/profiles/".$pf->image) && $pf->image != "avt.png") {
                unlink("uploads/images/profiles/".$pf->image);
            }
        }
        RoleRelationship::where('username', '=', $username)->delete();
        Profile::where('username_profile', '=', $username)->delete();
        User::where('username', '=', $username)->delete();
        return back()->with('notification', "Xóa tài khoản thành công tài khoản ".$username.".");
    }

    function getEdit(Request $request, $username)
    {
        $user = User::where('username','=', $username)->get();
        if (count($user) < 1) {
            if (back()->getTargetUrl() == $request->url()){
                return redirect()->route('getLogin')->with('notification', 'Bạn phải đăng nhập');
            }
            return back()->with('notification', 'Tài khoản không tồn tại.');
        }

        $role = Role::all();
        $roleRelationship = RoleRelationship::where('username', '=', $username)->get();
        return view('admin.user.edit', ['user'=>$user[0], 'role'=>$role, 'roleRelationship'=>$roleRelationship,  'title'=>'Chỉnh sửa tài khoản']);
    }

    function postEdit(Request $request, $username)
    {
        $user = User::where('username', '=', $username)->get();
        if (count($user) < 1) {
            if (back()->getTargetUrl() == $request->url()){
                return redirect()->route('getLogin')->with('notification', 'Bạn phải đăng nhập');
            }
            return back()->with('notification', 'Tài khoản không tồn tại.');
        }
        $this->validate($request, [
            'name' => 'required',
            'phoneNumber' => 'required|regex:/(0)[0-9]{9}/',
            'email' => 'required|email',
            'address' => 'required',
            'status' => 'required',

        ], 
        [

            'name.required' => 'Bạn chưa điền họ và tên',
            'phoneNumber.required' => 'Bạn chưa nhập số điện thoại',
            'phoneNumber.regex' => 'Số điện thoại có ít nhất 10 số',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email sai định dạng',
            'address.required' => 'Bạn chưa nhập địa chỉ',
            'status.required' => 'Bạn chưa chọn trạng thái.'

        ]);

        
        if ($request->input('email') == $user[0]->profile->email) goto nextEdit;

        $this->validate($request, [
            'email' => 'unique:profile',
        ], 
        [
            'email.unique' => 'Email đã đăng ký',
        ]);
        
        nextEdit:

        RoleRelationship::where('username', '=', $username)->delete();

        
        $acc = $user[0]->username;
        if ($request->input('name') != $user[0]->profile->name){
            $acc = createAccount($request->input('name'));
        }
    
        $edit = [
            'username' => $acc,
            'status' => $request->input('status'),
            'type' => 0,
        ];
        if ($user[0]->status != 1 && $request->input('status') == 1) {
            $rd = Str::random(9);
            $password = password_hash($rd, PASSWORD_BCRYPT);
            User::where('username', $user[0]->username)->update(['password'=>$password]);
            $arr = (object) ['name'=>$request->input('name'), 'username'=>$user[0]->username, 'pass'=>$rd];
            Mail::to($request->input('email'))->send(new ConfirmRegister($arr));
        }
        User::where('username', '=', $username)->update($edit);
        $edit = [
            'name' => $request->input('name'),
            'phone_number' => $request->input('phoneNumber'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'username_profile' => $acc,
        ];
        Profile::where('username_profile', '=', $username)->update($edit);
        $arr = $request->chrole;
        $roleRelationship = new RoleRelationship;
        $roleRelationship->username = $acc;
        $roleRelationship->role_id = 0;
        $roleRelationship->save();
        if (!empty($arr))
        if (count($arr)>0)
            foreach ($arr as $value) {
                $roleRelationship = new RoleRelationship;
                $roleRelationship->username = $acc;
                $roleRelationship->role_id = $value;
                $roleRelationship->save();
            }
        Post::where('author', $username)->update(['author'=>$acc, 'name_author'=>$request->input('name')]);

        return redirect()->route('adminUser')->with('notification', "Chỉnh sửa tài khoản thành công tài khoản ".$username.".");
    }

    function getChangePassword(Request $request)
    {
        return view('admin.user.changePassword',  ['title'=>'Đổi mật khẩu']);
    }

    function postChangePassword(Request $request)
    {
        $this->validate($request, [
            'oldPass' => 'required',
            'newPass' => 'required|min:8',
        ], 
        [
            'oldPass.required' => 'Bạn chưa nhập mật khẩu cũ.',
            'newPass.required' => 'Bạn chưa nhập mật khẩu mới.',
            'newPass.min' => 'Mật khẩu có ít nhất 8 ký tự.',
        ]);

        $user = $request->session()->get('account');

        $oldPass = $request->input('oldPass');
        
        $k = Auth::attempt(['username' => $user->username, 'password' => $oldPass]);
        if (!($k)) return back()->with('notification', "Mật khẩu cũ không đúng.");
        $newPass = password_hash($request->input('newPass'), PASSWORD_BCRYPT);
        User::where('username', '=', $user->username)->update(['password'=>$newPass, 'active'=>1]);
        $request->session()->forget('account');
        return redirect()->route('getLogin')->with('notification', "Đăng nhập lại");
    }

    function getChangeInfo(Request $request)
    {
        $acc = $request->session()->get('account');
        if ($acc->username == 'admin') return redirect()->route('adminHome');
        $profile = Profile::where('username_profile', $acc->username)->get();
        if (count($profile) < 1) return redirect()->route('adminHome');
        $profile = $profile[0];
        return view('admin.user.changeInformation', ['title'=>"Thông tin cá nhân", 'profile'=>$profile]);
    }

    function postChangeInfo(Request $request)
    {
        $user = User::where('username', $request->session()->get('account')->username)->get();
        if (count($user) < 1) return redirect()->route('adminHome');
        $this->validate($request, [
            'image' => 'mimes:jpg,png,jpeg,gif|max:20480',
            'phoneNumber' => 'required|regex:/(0)[0-9]{9}/',
            'email' => 'required|email',
            'address' => 'required',

        ], 
        [
            'image.mimes' => 'Ảnh đại diện phải có định dạng jpg, jpeg, png hoặc gif.',
            'image.max' => 'Kích thước ảnh đại diện tối đa 20MB.',
            'phoneNumber.required' => 'Bạn chưa nhập số điện thoại',
            'phoneNumber.regex' => 'Số điện thoại có ít nhất 10 số',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email sai định dạng',
            'address.required' => 'Bạn chưa nhập địa chỉ',

        ]);

        
        if ($request->input('email') == $user[0]->profile->email) goto nextEdit;

        $this->validate($request, [
            'email' => 'unique:profile',
        ], 
        [
            'email.unique' => 'Email đã đăng ký',
        ]);
        
        nextEdit:

        $edit = [
            'phone_number' => $request->input('phoneNumber'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
        ];

        if ($request->hasFile('image')) {
            
            $file = $request->file('image');

            $name = $file->getClientOriginalName();

            $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
            while (file_exists("uploads/images/profiles/".$image)) {
                $image = str_replace(":", "-", str_replace(" ", "_", Carbon::now())).Str::random(6)."_".$name;
            }
            $file->move("uploads/images/profiles/", $image);
            $pf = Profile::where('username_profile', $user[0]->username)->get();
            if (count($pf) > 0) {
                $pf = $pf[0];
                if ((file_exists("uploads/images/profiles/".$pf->image)) && $pf->image != "avt.png") {
                    unlink("uploads/images/profiles/".$pf->image);
                }
            }
            $edit['image'] = $image;

        }

        Profile::where('username_profile', '=', $user[0]->username)->update($edit);
        return back()->with('notification', "Cập nhật tài khoản thành công tài khoản ".$user[0]->username.".");
    }

}
