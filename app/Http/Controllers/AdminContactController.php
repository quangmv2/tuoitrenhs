<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackContact;

use App\Contact;

class AdminContactController extends Controller
{
    function getList()
    {
    	$contacts = Contact::paginate(20);
    	return view('admin.contact.list', ['list'=>$contacts, 'title'=>"Liên hệ"]);
    }

    function getView(Request $request, $id)
    {

    	$contact = Contact::find($id);
    	if ($contact == NULL) return redirect()->route('contactList')->with('notification', "Liên hệ không tồn tại.");
    	return view('admin.contact.feedback', ['title'=>'Phản hồi liên hệ', 'contact'=>$contact]);
    }

    function postView(Request $request, $id)
    {
    	$contact = Contact::find($id);
    	if ($contact == NULL) return redirect()->route('contactList')->with('notification', "Liên hệ không tồn tại.");
    	$this->validate($request, [
    		'contentfb' => 'required',
    	],
    	[
    		'contentfb.required' => 'Bạn chưa nhập phản hồi',
    	]);

    	$arr = (object) ['content' => $request->input('contentfb')];
        Mail::to($contact->email)->send(new FeedbackContact($arr));

        Contact::where('id', $id)->update(['contentfb' => $request->input('contentfb'), 'status' => 1]);
        return redirect()->route('contactList')->with('notification', 'Phản hồi thành công liên hệ '.$contact->name.".");

    }

    function getDelete(Request $request, $id)
    {
        $contact = Contact::find($id);
        if ($contact == NULL) return redirect()->route('contactList')->with('notification', "Liên hệ không tồn tại.");
        Contact::where('id', $id)->delete();
        return redirect()->route('contactList')->with('notification', 'Xóa thành công liên hệ '.$contact->name.".");
    }

}
