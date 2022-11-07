<?php

namespace App\Http\Controllers;
use App\Mail\Code;
use App\Models\User;
use App\Traits\ApiTraits;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\CustomHelpers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AuthRegisterValidation;

class AuthApis extends Controller
{
    public function register(Request $request)
    {
        $fileName=$request->file('image')->getClientOriginalName();

        if ($request->hasFile('image')) {
     
         $request->image->move(public_path('imgs'),$fileName);
     
     
         $path = asset('imgs/'.$fileName) ;//http://127.0.0.1:8000/imgs/test.jpg
     
     }
     

            $data=$request->only('name','email','password','image');
            $data['password']=Hash::make($request->password);
            $data['image']=$path;
            $user=User::create($data);
            $tokens=$user->createToken('Android')->plainTextToken;
            $user->token='Bearer '.$tokens;
            return ApiTraits::data(compact('user'),'register success');

    }



public function send(Request $request){

$token=$request->header('Authorization');
$userAuth=Auth::guard('sanctum')->user();
$code=CustomHelpers::generateCode();
User::where('id',$userAuth->id)->update([
    'code'=>$code
]);
$user=User::find($userAuth->id);
///////////////////
CustomHelpers::sendMail($user->email,'your verify code is:',$code);
Mail::to($user->email)->send(new Code($code));
//////////////////
$user->token=$token;
return ApiTraits::data(compact('user'),'send success');

}





public function verify(Request $request){
    //  $request->validate([
    //     'code' => 'required|digits:5|exists:user',
    // ]);

    $token=$request->header('Authorization');
    $userAuth=Auth::guard('sanctum')->user();

    $user=User::find($userAuth->id);
    if ($user->code==$request->code) {
    User::where('id',$user->id)->update(['email_verified_at'=>date('Y-m-d H:i:s'),'code'=>null]);
    $user->token=$token;
    return ApiTraits::data(compact('user'),'verify success',200);

}else {
    $user->token=$token;
    return ApiTraits::data(compact('user'),'wrong code',400);}
}



public function login(Request $request){

$user=User::where('email',$request->email)->first();
if (!Hash::check($request->password,$user->password)) {
return ApiTraits::errorMessage(['email'=>'the provided cirdation incorrect'], $message='wrong password');
}

//$user->tokens()->delete();//if want one device only that login
$tokens=$user->createToken('Android')->plainTextToken;
$user->token='Bearer '.$tokens;

if (is_null($user->email_verified_at)) {
    return ApiTraits::data(compact('user'),'not Verifyed',401);//401unauthorithed
}

    return ApiTraits::data(compact('user'),'login success',200);//401unauthorithed
}



public function rest(Request $request){
    // $request->validate([
    //     'email'=>['required','max:50','exists:user'],
    // ]);


    $user=User::where('email',$request->email)->first();
    $code=CustomHelpers::generateCode();
    User::where('id',$user->id)->update([
        'code'=>$code
    ]);


    CustomHelpers::sendMail($user->email,'your verify code is:',$code);


    // $token='Bearer '.$user->createToken('Android')->plainTextToken;
    // $user->token=$token;
    // return ApiTraits::data(compact('user'),'send code success',200);//401unauthorithed
    return ApiTraits::successMessage("send code success");

}

public function Newpass(Request $request){
    // $request->validate([
    //     'code' => 'required|digits:5|exists:user',
    //     'password'=>['required','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/'],
    // ]);

  $user=User::where('code',$request->code)->first();

  if ($user) {
    User::where('id',$user->id)->update([
        'password'=>Hash::make($request->password),'code'=>null
    ]);
}


    return ApiTraits::successMessage($message="update password success",$statusCode=200);

}

public function logoutAll(Request $request){

    $user=Auth::guard('sanctum')->user();
    $user->tokens()->delete();
    return ApiTraits::successMessage($message=" logoutAll success",$statusCode=200);

}

public function logout(Request $request){
$token=$request->header('Authorization');
$user=Auth::guard('sanctum')->user();

// dd($user);

$collection = Str::of($token)->explode('|');
$collection = Str::of($collection[0])->explode(' ');

$user->tokens()->where('id', $collection[1])->delete();

 return ApiTraits::successMessage($message=" logout success",$statusCode=200);

}


public function lang(Request $request){
    $this->allslots=array('ar','en');
    $this->validate($request, [
        'lang' => ['required',Rule::in($this->allslots)],
    ]);
       App::setLocale($request->lang);
      echo __('messages.welcome');

    }


    public function curenLang(Request $request){

          echo __(App::currentLocale());

        }

}
