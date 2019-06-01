<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Auth;

class ContactController extends Controller
{
    public function savecontact(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required|digits:11'
        ]);
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->address = $request->address;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->save();
        return redirect()->back()->withSuccess('Information Sent Successfully');
    }

    public function index(){
        $user = Auth::user();
        if($user->role_id != 1){
            return redirect('home');
        }
        else {
            $contacts = Contact::all();
            $notifications = $user->notifications;
            return view('admin.contact.contact',compact('notifications','contacts'));
        }
    }

    public function delete(Request $request){
        Contact::where('id',$request->id)->delete();
        return 'ok';
    }
}
