<?php

use App\Models\User;
use App\Models\Friend;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;
use App\Models\Friendrequest;
use App\Http\Controllers\AuthApis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FriendrequestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/allUsers',function(){
    $user=Auth::guard('sanctum')->user();
$allUsers=User::where('id','!=',$user->id)->get();
return  ApiTraits::data(compact('allUsers'));
})->middleware('AcceptKey');


Route::get('/authinfo/{id}',function($id){
   
    $user=Auth::guard('sanctum')->user();
  
    $myfriend=Friend::where('id',$id)->first();

    if ($myfriend->user_id_sender !==  $user->id) {
    
        $authinfo=User::where('id','=',$myfriend->user_id_sender)->first();
       
        return  ApiTraits::data(compact('authinfo'));
    }

    if ($myfriend->user_id_recieved  !==  $user->id) {
    
        $authinfo=User::where('id','=',$myfriend->user_id_recieved)->first();
       
        return  ApiTraits::data(compact('authinfo'));
    }


})->middleware('AcceptKey');



Route::post('/register', [AuthApis::class, 'register'])->middleware('AcceptKey');
Route::post('/send', [AuthApis::class, 'send'])->middleware('AcceptKey');
Route::post('/verify', [AuthApis::class, 'verify'])->middleware('AcceptKey');
Route::post('/login', [AuthApis::class, 'login'])->middleware('AcceptKey');

Route::post('/rest', [AuthApis::class, 'rest'])->middleware('AcceptKey');
Route::post('/Newpass', [AuthApis::class, 'Newpass'])->middleware('AcceptKey');

Route::get('/logoutAll', [AuthApis::class, 'logoutAll'])->middleware('AcceptKey');
Route::get('/logout', [AuthApis::class, 'logout'])->middleware('AcceptKey');
// 'LangCheck',StripeController php artisan make:controller StripeController -r


Route::post('/sendRequest/{sendto}', [FriendrequestController::class, 'create'])->middleware('AcceptKey');
Route::get('/showMyRequestsReceived', [FriendrequestController::class, 'showMyRequestsReceived'])->middleware('AcceptKey');
Route::get('/showMyRequestsSender', [FriendrequestController::class, 'showMyRequestsSender'])->middleware('AcceptKey');
Route::delete('/deleteMyRequest/{sendto}', [FriendrequestController::class, 'deleteMyRequest'])->middleware('AcceptKey');



Route::post('/createFriend', [FriendController::class, 'createFriend'])->middleware('AcceptKey');
Route::get('/allFriends', [FriendController::class, 'allFriends'])->middleware('AcceptKey');
Route::delete('/deleteFriend/{id}', [FriendController::class, 'deleteFriend'])->middleware('AcceptKey');


Route::post('/sendmessage', [MessageController::class, 'sendmessage'])->middleware('AcceptKey');
Route::get('/allmessage/{friendId}', [MessageController::class, 'allmessage'])->middleware('AcceptKey');




