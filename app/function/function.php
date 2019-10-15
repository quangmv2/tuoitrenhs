<?php 

use App\User;
use App\PostCategory;
use App\Post;

function utf8convert($str) {

    if(!$str) return false;

    $utf8 = [

            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'd'=>'đ|Đ',

            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',

            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ'];

    foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);

    return $str;

}

function utf8tourl($text) {
    $text = strtolower(utf8convert($text));
    $text = str_replace( "ß", "ss", $text);
    $text = str_replace( "%", "", $text);
    $text = preg_replace("/[^_a-zA-Z0-9 -] /", "",$text);
    $text = str_replace(array('%20', ' '), '-', $text);
    $text = str_replace("----","-",$text);
    $text = str_replace("---","-",$text);
    $text = str_replace("--","-",$text);
    $str = "";
    for ($i = 0; $i < strlen($text); $i++) {
        $k = ord($text[$i]);
        if (($k<=122 && $k>=97) || ($text[$i] == "-")) {
            $str .=$text[$i];
        }
    }
    return $str;
}

function createAccount($user) {
    $list = explode("-", utf8tourl($user));
    $acc = $list[count($list)-1];
    foreach ($list as $value) {
        if ($value == $list[count($list)-1]) break;
        $acc .= $value[0];
    }
    $k = User::where('username', '=', $acc)->get();
    if ( count($k) > 1 ) return $acc;
    $account = User::where('username', 'like', ''.$acc.'%')->orderBy('username', 'asc')->get();
    if (count($account)<1) return $acc;
    $oldAcc = $account[count($account)-1]->username;
    $list = explode($acc, $oldAcc);
    $number = (int)$list[count($list)-1];
    $number++;
    return $acc.$number;
}

function createCategory($str) {

    $name = utf8tourl($str);
    $k = PostCategory::where('unsigned_name', '=', $name)->get();
    if ( count($k) < 1 ) return $name;
    $account = PostCategory::where('unsigned_name', 'like', $name.'%')->orderBy('unsigned_name', 'asc')->get();
    if (count($account)<1) return $name;
    $oldAcc = $account[count($account)-1]->unsigned_name;
    $list = explode($name, $oldAcc);
    $number = (int)$list[count($list)-1];
    $number++;
    return $name."-".$number;
}

function createPost($str) {

    $name = utf8tourl($str);
    $k = Post::where('unsigned_title', '=', $name)->get();
    if ( count($k) < 1 ) return $name;
    $account = Post::where('unsigned_title', 'like', $name.'%')->orderBy('unsigned_title', 'asc')->get();
    if (count($account)<1) return $name;
    $oldAcc = $account[count($account)-1]->unsigned_name;
    $list = explode($name, $oldAcc);
    $number = (int)$list[count($list)-1];
    $number++;
    return $name."-".$number;
}
function changeUrl($category)
{
        $str = [];
        $i = 0;
        do{
            $i++;
            $str[] = $category->unsigned_name;
            if ($category->parent_id == 0) {
                break;
            }
            $category = $category->muccon;

        } while($i<50);
        $url = "";
        for ($i = count($str)-1; $i > -1; $i--){
            $url .= $str[$i]."/";
        }
        return $url;
}

function getCategoryParent($category)
{
    $k = $category->id;
    $i = 0;
    do{
        $i++;
        if ($category->parent_id == 0) {
            break;
        }
        $k = $category->parent_id;
        $category = $category->muccon;

    } while($i < 50);
    return $k;
}

function getTitleCategory($category)
{
        $str = [];
        $i = 0;
        do{
            $i++;
            $str[] = $category->name;
            if ($category->parent_id == 0) {
                break;
            }
            $category = $category->muccon;

        } while($i < 50);
        $url = "";
        for ($i = count($str)-1; $i > -1; $i--){
            if ($i==0) {
                $url .= $str[$i];
            } else
            $url .= $str[$i]." - ";
        }
        return $url;
}

function getUrlPost($postNew)
{
    for ($i = 0; $i < count($postNew); $i++) {
        $postNew[$i]->unsigned_title = changeUrl($postNew[$i]->loaitin).$postNew[$i]->unsigned_title;
    }
    return $postNew;
}

function checkCategory($category)
{
    $id = $category->id;
    return Post::where('category', $id)->get();

}

function cutTitle($char, $number)
{
    $arr = explode(" ", $char);
    $str = "";

    foreach ($arr as $index => $value) {
        if ($index == $number) {
            return $str."...";
        }
        $str.=$value." ";
    }
    return $str;
}

?>