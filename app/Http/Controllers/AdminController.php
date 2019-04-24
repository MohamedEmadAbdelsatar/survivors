<?php

namespace App\Http\Controllers;

use App\User;
use App\Hospital;
use Auth;
use App\Orders;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        if($user->role_id != 1){
            return redirect('/home');
        }
        $notifications = $user->notifications;
        $admins = User::all();
        $hospitals = Hospital::all();
        return view('admin.admins.admins',compact('admins','notifications','hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if($user->role_id != 1){
            return redirect('/home');
        }
        $hospitals = Hospital::all();
        return view('admin.admins.create',compact('hospitals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6'
        ]);
        $request['password'] = bcrypt($request->password);
        $admin = new User;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = $request->password;
        $admin->phone = $request->phone;
        $admin->role_id = $request->role;
        if($admin->role != 1){
            $admin->hospital_id = $request->hospital_id;
        }
        $admin->save();
        return redirect('/admins')->with('success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Auth::user();
        if($admin->role_id != 1){
            return redirect('/home');
        }
        $notifications = $admin->notifications;
        $hospital = Hospital::find($admin->hospital_id);
        $orders = Orders::where('user_id',$admin->id)->get();
        return view('admin.admins.show',compact('notifications','hospital','orders','admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        if($user->role_id != 1){
            return redirect('/home');
        }
        $notifications = $user->notifications;
        $admin = User::find($id);
        $hospitals = Hospital::all();
        return view('admin.admins.edit',compact('admin','notifications','hospitals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric',
        ]);


        $admin = User::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if($request->password != null){
            $request['password'] = bcrypt($request->password);
            $admin->password = $request->password;
        }
        $admin->phone = $request->phone;
        $admin->role_id = $request->role;
        if($admin->role != 1){
            $admin->hospital_id = $request->hospital_id;
        }
        $admin->save();
        return redirect('/home')->with('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
