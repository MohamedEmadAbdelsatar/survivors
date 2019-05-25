<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Blood;
use App\User;
use App\Hospital;

class BloodController extends Controller
{
    public function modify_amounts($hospital_id = null){
        $user = Auth::user();
        $notifications = $user->notifications;
        if($user->role_id == 1 && $hospital_id != null ){
            $hospital = Hospital::find($hospital_id);
            $balance = Blood::where('hospital_id',$hospital_id)->first();
            return view('admin.blood.modify',compact('balance','notifications','hospital'));
        } else {
            if($hospital_id != null){
                if($user->hospital_id != $hospital_id ){
                    return redirect('/home');
                }
            }
            $hospital_id = $user->hospital_id;
            $hospital = Hospital::find($hospital_id);
            $balance = Blood::where('hospital_id',$hospital_id)->first();
            return view('admin.blood.modify',compact('balance','notifications','hospital'));
        }
    }

    public function store_mod(Request $request){
        $this->validate($request,[
            'o_pos' => 'numeric',
            'o_neg' => 'numeric',
            'a_pos' => 'numeric',
            'a_neg' => 'numeric',
            'b_pos' => 'numeric',
            'b_neg' => 'numeric',
            'ab_pos' => 'numeric',
            'ab_neg' => 'numeric',
        ]);
        $user = Auth::user();
        $hospital_id = $request->hospital_id;
        $balance = Blood::where('hospital_id',$hospital_id)->first();
        $balance->o_pos = $request->o_pos;
        $balance->o_neg = $request->o_neg;
        $balance->a_pos = $request->a_pos;
        $balance->a_neg = $request->a_neg;
        $balance->b_pos = $request->b_pos;
        $balance->b_neg = $request->b_neg;
        $balance->ab_pos = $request->ab_pos;
        $balance->ab_neg = $request->ab_neg;
        $balance->save();
        return redirect()->back()->withSuccess('Modified Successfully');
    }
}
