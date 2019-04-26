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

    public function check_destance($lat1, $lng1, $lat2, $lng2){
        $R = 6371;
        $dLat = deg2rad(lat2-lat1);
        $dLon = deg2rad(lon2-lon1);
        $a = sin(dLat/2) * sin(dLat/2) + cos(deg2rad(lat1)) * cos(deg2rad(lat2)) * sin(dLon/2) * sin(dLon/2);
        $c = 2 * atan2(sqrt(a), sqrt(1-a));
        $d = R * c; // Distance in km
        return d;
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
        $current_hospital = Hospital::find($hospital_id);
        $other_hospitals = Hospital::where('id','!=',$hospital_id)->get();
        $distance = 0;
        $to_id = null;
        foreach($other_hospitals as $other){
            $new_destance = $this->check_destance($current_hospital->lat, $current_hospital->lng, $other->lat,$other->lng);
            if($new_destance < $distance){
                $distance = $new_destance;
                $to_id = $other->id;
            }
        }
        $dest_hospital = Hospital::find($to_id);
        $order = new Orders;
        $order->blood_type = $request->blood_type;
        $order->amount = $request->amount;
        $order->hospital_id = $hospital_id;
        $order->user_id = $user_id;
        $order->to_id = $to_id;
        $order->status = 1;
        $order->save();
        $blood_type = null;
        switch($order->blood_type){
            case 1: $blood_type = "O+"; break;
            case 3: $blood_type = "A+"; break;
            case 4: $blood_type = "A-"; break;
            case 5: $blood_type = "B+"; break;
            case 6: $blood_type = "B-"; break;
            case 7: $blood_type = "AB+"; break;
            case 8: $blood_type = "AB-"; break;
        }
        $details = [
            'greeting' => 'Hi '.$dest_hospital->name."Admin",
            'body' => $current_hospital->name.' orderd '.$amount.' of '.$blood_type,
            'thanks' => 'Thank you for using survivors.com ',
            'notification_body' => $current_hospital->name.' orderd '.$amount.' of '.$blood_type
        ];
        $receivers = User::where('hospital_id',$to_id)->get();
        Notification::send($receivers, new ChangeStatus($details));
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
        $user = Auth::user();
        $notifications = $user->notifications;
        $order = Orders::find($id);
        $hospital = Hospital::find($user->hospital_id);
        return view('admin.orders.show',compact('notifications','order','hospital'));
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
        $notifications = $user->notifications;
        $order = Orders::find($id);
        return view('admin.orders.edit',compact('notifications','order'));
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
            "amount"=>"required",
        ]);
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $hospital_id = $user->hospital_id;
        $order = Orders::find($id);
        $order->blood_type = $request->blood_type;
        $order->amount = $request->amount;
        $order->save();
        return redirect('orders')->withSuccess('Orderd updated Successfully');
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
        if($user->role_id == 1){
            $orders = Orders::where(['status'=>1])->get();
            $users = User::all();
            $hospitals = Hospital::all();
        } else {
            $hospital = Hospital::find($user->hospital_id);
            $orders = Orders::where(['status'=>1],['to_id'=>$hospital->id])->get();
            $users = User::all();
            $hospitals = Hospital::all();
        }


        return view('admin.orders.pending',compact('orders','users','hospitals','notifications'));
    }

    public function pending_action(Request $request){
        $order = Orders::find($request->id);
        $user = User::find($order->user_id);
        $hospital_id = $user->hospital_id;
        $receiver_hospital = hospital::find($hospital_id);
        $sender_hospital = Hospital::find(Auth::user()->hospital_id);
        $check_balance = Blood::where('hospital_id',$sender_hospital)->get();
        $f = true;
        switch($order->blood_type){
            case 1: if($check_balance->o_pos <= $order->amount){$f = false;}; break;
            case 2: if($check_balance->o_neg <= $order->amount){$f = false;}; break;
            case 3: if($check_balance->a_pos <= $order->amount){$f = false;}; break;
            case 4: if($check_balance->a_neg <= $order->amount){$f = false;}; break;
            case 5: if($check_balance->b_pos <= $order->amount){$f = false;}; break;
            case 6: if($check_balance->b_neg <= $order->amount){$f = false;}; break;
            case 7: if($check_balance->ab_pos <= $order->amount){$f = false;}; break;
            case 8: if($check_balance->ab_neg <= $order->amount){$f = false;}; break;
        }
        if(!f){
            return redirect()->back()->withErrors('there is no available blood bags');
        }
        if($request->action == 'accept'){
            $order->status = 2;
            $balance = Blood::where('hospital_id',$hospital_id)->first();
            switch($order->blood_type){
                case 1: $balance->o_pos += $order->amount; $check_balance->o_pos -= $order->amount; break;
                case 2: $balance->o_neg += $order->amount; $check_balance->o_neg -= $order->amount; break;
                case 3: $balance->a_pos += $order->amount; $check_balance->a_pos -= $order->amount; break;
                case 4: $balance->a_neg += $order->amount; $check_balance->a_neg -= $order->amount; break;
                case 5: $balance->b_pos += $order->amount; $check_balance->b_pos -= $order->amount; break;
                case 6: $balance->b_neg += $order->amount; $check_balance->b_neg -= $order->amount; break;
                case 7: $balance->ab_pos += $order->amount; $check_balance->ab_pos -= $order->amount; break;
                case 8: $balance->ab_neg += $order->amount; $check_balance->ab_neg -= $order->amount; break;
            }
            $balance->save();
            $check_balance->save();
            $details = [
                'greeting' => 'Hi '.$receiver_hospital->name.' Admins',
                'body' => $sender_hospital->name.' accepted your order',
                'thanks' => 'Thank you for using survivors.com ',
                'notification_body' => $sender_hospital->name.' accepted your order',
                'order_id' =>$order->id
            ];
        } else {
            $order->status = 3;
            $details = [
                'greeting' => 'Hi '.$receiver_hospital->name.' Admins',
                'body' => 'sorry, '.$sender_hospital->name.' we refused your order',
                'thanks' => 'Thank you for using survivors.com ',
                'notification_body' => 'sorry, '.$sender_hospital->name.' we refused your order',
                'order_id' =>$order->id
            ];
        }
        $order->save();
        Notification::send($user, new ChangeStatus($details));
        return 'ok';
    }
    public function hospital_orders(){
        $user = Auth::user();
        $notifications = $user->notifications;
        $hospital = Hospital::find($user->hospital_id);
        $orders = Orders::where('hospital_id',$user->hospital_id)->get();
        $admins = User::where('hospital_id',$user->hospital_id)->get();
        return view('admin.orders.hospital_orders',compact('notifications','hospital','orders','admins'));
    }
}
