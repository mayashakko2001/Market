<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Traits\GenTraits;
class AuthController extends Controller
{use GenTraits;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function register(Request $request)
    { $validator=Validator::make($request->all(),[
        'email'=>'required',
        'name'=>'required',
        'password'=>'required'

    ]);
       if($validator->fails()){
        return $this->error('','cannot show anysthing',500);
       }
$user=User::create(array_merge(
$validator->validated(),
['password'=>bcrypt($request->password)]
)
);
return   $this ->success($user,200,'successfuly');


    }
//.............................................................................................
public function login(Request $request){
    $c = $request->only(['email', 'password']);
    if(!$token = Auth()->attempt($c))
    {
        return $this->error('','cannot login',500);

    }
    $user = Auth::user();
    $token = $user->createToken('');
    return $this->respondWithToken($token);

}
//.......................................................................................
public function logout(){
auth()->logout();
return   $this ->success('',200,'logut');
}
public function respondWithToken($token)
{
    return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
        'user'=>auth()->user()
    ]);
}
}
