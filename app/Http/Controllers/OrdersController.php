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
        $hospitals = Hospital::all();
        return view('admin.orders.create',compact('notifications','hospitals'));
    }

    public function check_destance($lat1, $lon1, $lat2, $lon2){
        $R = 6371;
        $dLat = deg2rad($lat2-$lat1);
        $dLon = deg2rad($lon2-$lon1);
        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $d = $R * $c; // Distance in km
        return $d;
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
        $to_id = null;
        if($request->to_id == 0){
            $other_hospitals = Hospital::where('id','!=',$hospital_id)->get();
            $first_hospital = Hospital::where('id','!=',$hospital_id)->first();
            $distance = $this->check_destance($current_hospital->lat, $current_hospital->lng, $first_hospital->lat, $first_hospital->lng);
            if(count($other_hospitals) != 0){
                foreach($other_hospitals as $other){
                    $new_destance = $this->check_destance($current_hospital->lat, $current_hospital->lng, $other->lat, $other->lng);
                    if($new_destance <= $distance){
                        $distance = $new_destance;
                        $to_id = $other->id;
                    }
                }
            }
        } else {
            $to_id = $request->to_id;
        }
        $dest_hospital = Hospital::find($to_id);
        $order = new Orders;
        $order->blood_type = $request->blood_type;
        $order->amount = $request->amount;
        $order->hospital_id = $hospital_id;
        $order->user_id = $user_id;
        $order->to_id = $to_id;
        $order->status = 1;
        $order->try = 1;
        if($request->to_id == 0) {
            $order->direct = 1;
        } else {
            $order->direct = 0;
        }
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
                'greeting' => 'Hi,',
                'body' => $current_hospital->name.' orderd '.$order->amount.' of '.$blood_type.' blood bags',
                'thanks' => 'Thank you for using survivors.com ',
                'notification_body' => $current_hospital->name.' orderd '.$order->amount.' of '.$blood_type.' blood bags',
                'order_id' =>$order->id
            ];
        if($request->to_id == 0){
            $receivers = User::where('hospital_id',$to_id)
                            ->orwhere('role_id',1)->get();
        } else {
            $receivers = User::where('hospital_id',$request->to_id)
                            ->orwhere('role_id',1)->get();
        }

        Notification::send($receivers, new ChangeStatus($details));
        return redirect('/home')->withSuccess('Orderd is sent');
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
        foreach($notifications as $notification){
            if($notification->data['order_id'] == $id){
                $notification->delete();
            }
        }
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
        $hospitals = Hospital::all();
        return view('admin.orders.edit',compact('notifications','order','hospitals'));
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
        if($request->to_id) {
            $order->to_id = $request->to_id;
        }
        $order->save();
        return redirect('/home')->withSuccess('Orderd updated Successfully');
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
            $orders = Orders::where('status',1)
                                ->where('to_id',$hospital->id)->get();
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
        if($order->to_id != null){
            $sender_hospital = Hospital::find($order->to_id);
            $check_balance = Blood::where('hospital_id',$sender_hospital->id)->first();
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
            if(!$f){
                return 'there is no available blood bags';
            }
        }
        if($request->action == 'accept'){
            $order->status = 2;
            $order->price = $request->price;
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
            Notification::send($user, new ChangeStatus($details));
        } else {
            if($order->direct == 0){
                if($order->try == 1){
                    $order->try = 2;
                    $hospitals = Hospital::where('id','!=',$receiver_hospital->id)
                                            ->where('id','!=',$sender_hospital->id)->get();
                    if(count($hospitals)){
                        $distances = array();
                        foreach($hospitals as $hospital){
                            $d = $this->check_destance($receiver_hospital->lat, $receiver_hospital->lng, $hospital->lat, $hospital->lng);
                            array_push($distances, $d);
                        }
                        sort($distances);
                        $secondlowest = $distances[1];
                        foreach($hospitals as $hospital){
                            $d = $this->check_destance($receiver_hospital->lat, $receiver_hospital->lng, $hospital->lat, $hospital->lng);
                            if($d == $secondlowest) {
                                $to_id = $hospital->id;
                                break;
                            }
                        }
                        $order->comment = $request->comment;
                        $order->to_id = $to_id;
                        $dest_hospital = Hospital::find($to_id);
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
                            'body' => $receiver_hospital->name.' orderd '.$order->amount.' of '.$blood_type,
                            'thanks' => 'Thank you for using survivors.com ',
                            'notification_body' => $receiver_hospital->name.' orderd '.$order->amount.' of '.$blood_type,
                            'order_id' =>$order->id
                        ];
                        $receivers = User::where('hospital_id',$to_id)->get();
                        Notification::send($receivers, new ChangeStatus($details));
                    } else {
                        $order->status = 3;
                        $details = [
                            'greeting' => 'Hi '.$receiver_hospital->name.' Admins',
                            'body' => 'sorry, '.$sender_hospital->name.' we refused your order',
                            'thanks' => 'Thank you for using survivors.com ',
                            'notification_body' => 'sorry, '.$sender_hospital->name.' we refused your order',
                            'order_id' =>$order->id
                        ];
                        $order->status = 3;
                        $order->comment = $request->comment;
                        Notification::send($user, new ChangeStatus($details));
                    }
                } else {
                    $order->status = 3;
                    $details = [
                        'greeting' => 'Hi '.$receiver_hospital->name.' Admins',
                        'body' => 'sorry, '.$sender_hospital->name.' we refused your order',
                        'thanks' => 'Thank you for using survivors.com ',
                        'notification_body' => 'sorry, '.$sender_hospital->name.' we refused your order',
                        'order_id' =>$order->id
                    ];
                    Notification::send($user, new ChangeStatus($details));
                }
            } else {
                $order->status = 3;
                    $details = [
                        'greeting' => 'Hi '.$receiver_hospital->name.' Admins',
                        'body' => 'sorry, '.$sender_hospital->name.' we refused your order',
                        'thanks' => 'Thank you for using survivors.com ',
                        'notification_body' => 'sorry, '.$sender_hospital->name.' we refused your order',
                        'order_id' =>$order->id
                    ];
                    Notification::send($user, new ChangeStatus($details));
            }

        }
        $order->save();

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

    public function show_accepted(){
        $user = Auth::user();
        $notifications = $user->notifications;
        if($user->role_id == 1){
            $orders = Orders::where('status',2)->get();
            $hospitals = Hospital::all();
            $users = User::all();
            $role = 1;
            return view('admin.orders.accepted',compact('notifications','orders','hospitals','users','role'));
        } else {
            $orders = Orders::where('status',2)
                                ->where('hospital_id',$user->hospital_id)->get();
            $hospital = Hospital::find($user->hospital_id);
            $users = User::where('hospital_id',$user->hospital_id)->get();
            $role = 2;
            return view('admin.orders.accepted',compact('notifications','orders','hospital','users','role'));
        }

    }

    public function show_refused(){
        $user = Auth::user();
        $notifications = $user->notifications;
        if($user->role_id == 1){
            $orders = Orders::where('status',3)->get();
            $hospitals = Hospital::all();
            $users = User::all();
            $role = 1;
            return view('admin.orders.refused',compact('notifications','orders','hospitals','users','role'));
        } else {
            $orders = Orders::where('status',3)
                                ->where('hospital_id',$user->hospital_id)->get();
            $hospital = Hospital::find($user->hospital_id);
            $users = User::where('hospital_id',$user->hospital_id)->get();
            $role = 2;
            return view('admin.orders.refused',compact('notifications','orders','hospital','users','role'));
        }
    }
}
