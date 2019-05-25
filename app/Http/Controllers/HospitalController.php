<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hospital;
use App\User;
use Auth;
use App\Blood;
use App\Orders;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;


class HospitalController extends Controller
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
        $hospitals = Hospital::all();
        return view('admin.hospitals.hospitals',compact('hospitals','notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $notifications = $user->notifications;
        if($user->role_id != 1){
            return redirect('/home');
        }
        return view('admin.hospitals.create',compact('notifications'));
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
        $request->validate([
            'name'=>'required|unique:hospitals|max:40',
            'address'=>'required|unique:hospitals',
            'phone'=>'required|max:11|min:11|numeric',
            'lat'=>'required|unique:hospitals|numeric',
            'lng'=>'required|unique:hospitals|numeric',
            'email'=>'required|unique:hospitals'
        ]);

        $hospital = new Hospital;
        $hospital->name = $request->name;
        $hospital->address = $request->address;
        $hospital->email = $request->email;
        $hospital->phone = $request->phone;
        $hospital->lat = $request->lat;
        $hospital->lng = $request->lng;
        $hospital->save();
        $balance = new Blood;
        $balance->hospital_id = $hospital->id;
        $balance->save();
        Mail::to($hospital->email)->send(new SendMailable());
        return redirect('hospital')->withSuccess('Hospital Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        if($user->role_id != 1){
            if($user->hospital_id != $id){
                return redirect('/home');
            }
        }
        $notifications = $user->notifications;
        $hospital = Hospital::find($id);
        $users = User::where('hospital_id',$id)->get();
        $orders = Orders::where('hospital_id',$id)->get();
        return view('admin.hospitals.show',compact('notifications','hospital','users','orders'));
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
            if($user->hospital_id != $id){
                return redirect('/home');
            }
        }
        $notifications = $user->notifications;
        $hospital = Hospital::find($id);
        return view('admin.hospitals.edit',compact('notifications','hospital'));
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
        $request->validate([
            'name'=>'required|max:40',
            'address'=>'required',
            'phone'=>'required|max:11|min:11|numeric',
            'lat'=>'required|numeric',
            'lng'=>'required|numeric'
        ]);

        $hospital = Hospital::find($id);
        $hospital->name = $request->name;
        $hospital->address = $request->address;
        $hospital->email = $request->email;
        $hospital->phone = $request->phone;
        $hospital->lat = $request->lat;
        $hospital->lng = $request->lng;
        $hospital->save();
        return redirect('hospital')->withSuccess('Hospital Inforamtion Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orders = Orders::where('hospital_id',$id)->get();
        if(count($orders) != 0){
            foreach($orders as $order){
                Orders::where('id',$order->id)->delete();
            }
        }
        $admins = User::where('hospital_id',$id)->get();
        if(count($admins) != 0){
            foreach($admins as $admin){
                User::where('id',$admin->id)->delete();
            }
        }
        Blood::where('hospital_id',$id)->delete();
        Hospital::where('id',$id)->delete();
        return redirect('hospital')->withSuccess('Hospital deleted successfully');
    }
}
