<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;
use App\Models\Friendrequest;
use Illuminate\Support\Facades\Auth;

class FriendrequestController extends Controller
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
    public function create(Request $request,$sendto)
    {

        $user=Auth::guard('sanctum')->user();
     
        // $Myrequest=new Friendrequest;
        // $Myrequest->user_id_sender=$user->id;
        // $Myrequest->user_id_recieved=$request->user_id_recieved ;
        // $Myrequest->save;
       $recieveduser=User::find($sendto);
        $Myrequest=Friendrequest::insert([
        'user_id_sender'=>$user->id,
        'user_id_recieved'=>$sendto,
        'sendername'=> $user->name,
        'recievedname'=>$recieveduser->name
        ]);
        
        return  ApiTraits::successMessage();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\request  $request
     * @return \Illuminate\Http\Response
     */
    public function showMyRequestsReceived(Request $request)
    {

        $user=Auth::guard('sanctum')->user();


        $showMyRequestsSender= Friendrequest::where('user_id_recieved',$user->id)->get();
        
       
        return  ApiTraits::data(compact('showMyRequestsSender'));

    }


    public function showMyRequestsSender(Request $request)
    {

        $user=Auth::guard('sanctum')->user();


        $showMyRequestsSender= Friendrequest::where('user_id_sender',$user->id)->get();
        

       
        return  ApiTraits::data(compact('showMyRequestsSender'));

    }



    public function deleteMyRequest(Request $request,$sendto)
    {

        $user=Auth::guard('sanctum')->user();

        $showMyRequestsSender= Friendrequest::where([
            ['user_id_sender'=>$user->id],
            ['user_id_recieved'=>$sendto]
        ])->delete();
        

        return  ApiTraits::data(compact('showMyRequestsSender'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\friendrequest  $friendrequest
     * @return \Illuminate\Http\Response
     */
    public function edit(friendrequest $friendrequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\friendrequest  $friendrequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, friendrequest $friendrequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\friendrequest  $friendrequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(friendrequest $friendrequest)
    {
        //
    }
}
