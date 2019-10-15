<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\FileCategory;
use App\Files;

class ClientFileController extends ClientController
{
    function get(Request $request, $unsigned_title)
    {
    	$category = FileCategory::where('unsigned_title', $unsigned_title)->get();
    	if (count($category) < 1) return view('errors.404');
    	$files = Files::where('category', $category[0]->id)->orderby('created_at', 'desc')->paginate(25);
    	if (isset($_GET['page'])) {
    		return view('client.file.ajax', ['category'=>$category[0], 'files'=>$files]);
    	}
    	return view('client.file.detail', ['title'=>'Văn bản '.$category[0]->name, 'category'=>$category[0], 'files'=>$files]);
    }
}
