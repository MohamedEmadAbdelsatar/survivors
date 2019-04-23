<?php

namespace App\Http\Controllers;

use App\Orders;
use App\User;
use App\Hospital;
use Auth;
use Illuminate\Http\Request;
use Notification;
use App\Notifications\ChangeStatus;
use App\Blood;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        return view('admin.orders.create',compact('notifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        Status
        1 -> pending
        2 -> accepted
        3 -> refused
        */
        $request->validate([
            "amount"=>"required",
        ]);
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $hospital_id = $user->hospital_id;
        $order = new Orders;
        $order->blood_type = $request->blood_type;
        $order->amount = $request->amount;
        $order->hospital_id = $hospital_id;
        $order->user_id = $user_id;
        $order->status = 1;
        $order->save();
        return redirect('orders')->withSuccess('Orderd is sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function show_pending(){
        $user = Auth::user();
        $notifications = $user->notifications;
        $orders = Orders::where('status',1)->get();
        $users = User::all();
        $hospitals = Hospital::all();
        return view('admin.orders.pending',compact('orders','users','hospitals','notifications'));
    }

    public function pending_action(Request $request){
        $order = Orders::find($request->id);
        $user = User::find($order->user_id);
        $hospital_id = $user->hospital_id;
        if($request->action == 'accept'){
            $order->status = 2;
            $balance = Blood::where('hospital_id',$hospital_id)->first();
            switch($order->blood_type){
                case 1: $balance->o_pos += $order->amount; break;
                case 2: $balance->o_neg += $order->amount; break;
                case 3: $balance->a_pos += $order->amount; break;
                case 4: $balance->a_neg += $order->amount; break;
                case 5: $balance->b_pos += $order->amount; break;
                case 6: $balance->b_neg += $order->amount; break;
                case 7: $balance->ab_pos += $order->amount; break;
                case 8: $balance->ab_neg += $order->amount; break;
            }
            $balance->save();
            $details = [
                'greeting' => 'Hi '.$user->name,
                'body' => 'we accepted your order',
                'thanks' => 'Thank you for using survivors.com ',
                'notification_body' => 'we accepted your order'
            ];
        } else {
            $order->status = 3;
            $details = [
                'greeting' => 'Hi Artisan'.$user->name,
                'body' => 'sorry, we refused your order',
                'thanks' => 'Thank you for using survivors.com ',
                'notification_body' => 'sorrt, we refused your order'
            ];
        }
        $order->save();
        Notification::send($user, new ChangeStatus($details));
        return 'ok';
    }
}
