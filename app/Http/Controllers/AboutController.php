<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    public function modify(){
        $user = Auth::user();
        if($user->role_id != 1){
            return redirect('/home');
        }
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
        /*
        if($request->hasFile('image')){
            $imageName = $request->image->store('public');
        }
        */
        if($request->hasFile('image')){
            $cover = $request->file('image');
            $extension = $cover->getClientOriginalExtension();
            Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));
        }
        $about = About::find(1);
        $about->title = $request->title;
        if($request->hasFile('image')){
            $about->image = $cover->getFilename().'.'.$extension;
        }
        $about->body = $request->body;
        $about->save();
        return redirect()->back()->withSuccess('About Us Modified Successfully');

    }
}
