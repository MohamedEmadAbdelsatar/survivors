<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Hospital;
use App\Orders;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications;
        if(Auth::user()->role_id == 1){
            $hospitals = Hospital::all();
            $n_hospital = count($hospitals);
            $orders = Orders::all();
            $n_order = count($orders);
            $pending = Orders::where('status',1)->get();
            $n_pending = count($pending);
            $role = 1;
            return view('admin/home',compact('notifications','role','n_hospital','n_pending','n_order'));
        } else {
            $hospital_id = $user->hospital_id;
            $received_orders = Orders::where('to_id',$hospital_id)->get();
            $n_received = count($received_orders);
            $sent_orders = Orders::where('hospital_id',$hospital_id)->get();
            $n_sent = count($sent_orders);
            $accepted_orders = Orders::where('status',2)
                                        ->where('to_id',$hospital_id)->get();
            $n_accepted = count($accepted_orders);
            $role = 2;
            return view('admin/home',compact('notifications','role','n_received','n_sent','n_accepted'));
        }

    }


}
