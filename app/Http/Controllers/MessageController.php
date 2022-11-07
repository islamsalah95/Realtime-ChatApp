<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friend;
use App\Models\message;
use App\Traits\ApiTraits;
use App\Events\SendMessage;
use Illuminate\Http\Request;
use App\Models\Friendrequest;
// use App\Notifications\Sendmessage;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendmessage(Request $request)
    {
        $user=Auth::guard('sanctum')->user();

        $messageRequest=[
            'message' => $request->message,
            'user_id' =>  $user->id,
            'friend_id' => $request->friend_id,
            'created_at'=>date('Y-m-d H:i:s')
        ];

        $sender=Friend::where([
             ['id', '=', $request->friend_id],
             ['user_id_sender', '=', $user->id],
         ])->exists();
     
        $recieved=Friend::where([
             ['id', '=', $request->friend_id],
             ['user_id_recieved', '=', $user->id],
         ])->exists();



        if ( $sender ||  $recieved) {
            $messages= Message::insert(
                [
                        'message' => $request->message,
                        'user_id' =>  $user->id,
                        'friend_id' => $request->friend_id,
                
                ]
            );


            $myFriend=Friend::where([
                ['id', '=', $request->friend_id],
            ])->first();


            //  $sendtosender=User::find($myFriend->user_id_sender);
            //  $sendtosender->notify(new Sendmessage($messageRequest));

            //  $sendtorecieved=User::find($myFriend->user_id_recieved);
            //  $sendtorecieved->notify(new Sendmessage($messageRequest));
          
            broadcast(new SendMessage($messageRequest))->toOthers();

                return  ApiTraits::successMessage();        
            }



            return  ApiTraits::errorMessage('wrong user or friendid');        

 

    }


    public function allmessage(Request $request,$friendId)
    {

        $user=Auth::guard('sanctum')->user();


        $sender=Friend::where([
             ['id', '=',$friendId],
             ['user_id_sender','=', $user->id],
         ])->exists();
     
        $recieved=Friend::where([
             ['id', '=',$friendId],
             ['user_id_recieved','=', $user->id],
         ])->exists();
 

         if ( $sender ||  $recieved) {
           
            $messages= Message::where('friend_id',$friendId)->get();

         
            return  ApiTraits::data(compact('messages'));
        }

        return  ApiTraits::errorMessage('wrong user or friendid');        



    }
}
