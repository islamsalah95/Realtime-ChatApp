<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;
use App\Models\Friendrequest;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{

    public function createFriend(Request $request)
    {

        $user=Auth::guard('sanctum')->user();

        $myFriendRequest= Friendrequest::where([
                ['user_id_sender', '=', $request->user_id_sender],
                ['user_id_recieved', '=', $user->id],
            ])->first();

            // dd($myFriendRequest->user_id_sender);
         

        $Myrequest=Friend::insert([
        'user_id_sender'=> $myFriendRequest->user_id_sender ,
        'user_id_recieved'=> $myFriendRequest->user_id_recieved ,
        'sender_name'=> $myFriendRequest->sendername,
        'recieved_name'=> $myFriendRequest->recievedname
        ]);
        
                    // dd($Myrequest);

       Friendrequest::where([
        ['user_id_sender', '=', $request->user_id_sender],
        ['user_id_recieved', '=', $user->id],
    ])->delete();

        return  ApiTraits::successMessage();
        
    }

 
    public function allFriends(Request $request)
    {

        $user=Auth::guard('sanctum')->user();

        $a=$user->id ;
        
        $friends=Friend::where(function ($query) use ($a) {
            $query->where('user_id_recieved', '=', $a)
                  ->orWhere('user_id_sender', '=', $a);
        })->get();

    
        return  ApiTraits::data(compact('friends'));

    }


 

    public function deleteFriend(Request $request,$id)
    {

        $user=Auth::guard('sanctum')->user();

        Friend::where('id',$id)->delete();

    //    Friend::where([
    //     ['user_id_sender',$user->id],
    //     ['id',$request->id]
    //     ])->delete();
       

    //     Friend::where([
    //         ['user_id_recieved',$user->id],
    //         ['id',$request->id]
    //         ])->delete();

            // $userid=$user->id;
            // Friend::where(function($query) use ($userid) {
            // $query->where('user_id_sender',$userid) 
            //        ->orWhere('user_id_recieved',$userid);
            //         })->delete();

        return  ApiTraits::successMessage();

    }

}
