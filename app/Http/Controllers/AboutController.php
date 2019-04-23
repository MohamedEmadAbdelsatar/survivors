<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function modify(){
        $user = Auth::user();
        $notifications = $user->notifications;
        $about = About::find(1);
        return view('admin.about.modify',compact('notifications','about'));
    }
    public function save(Request $request){
        //return $request->all();
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
        ]);
        if($request->hasFile('image')){
            $imageName = $request->image->store('public');
        }
        $about = About::find(1);
        $about->title = $request->title;
        if($request->hasFile('image')){
            $about->image = $imageName;
        }
        $about->body = $request->body;
        $about->save();
        return redirect('/home')->withSuccess('About Us Modified Successfully');

    }
}
