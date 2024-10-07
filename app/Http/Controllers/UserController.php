<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use LaravelJsonApi\Eloquent\Filters\OnlyTrashed;
use Illuminate\Support\Facades\Validator;
use App\Traits\GenTraits;
class UserController extends Controller
{
    use GenTraits;
    public function index(){
        return User::all();
    }
  //................................................................................
    public function store(Request $request)
    {
        $request->validate([
            
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        
        $user = new User;
       
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        return $this ->success($user,200,'user  add successfully');

    }

    //...................................................................................
    
    public function update_user(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Cannot show anything'], 500);
        }
        
        if ($request->has('name')) {
            $user->name = $request->input('name');
        }
    
        if ($request->has('email')) {
            $user->email = $request->input('email');
        }
        
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        
        if ($request->has('phone')) {
            $user->phone = $request->input('phone');
        }
        
        if ($request->has('address')) {
            $user->address = $request->input('address');
        }
    
     
        $user->save();
        return response()->json(['user' => $user, 'message' => 'User updated successfully'], 200);
    }

    //.....................................................................................
    public function soft_delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->error('', 'Cannot show anything', 500);
        }
    
        $user->delete();
    
        return $this->success('', 200, 'User deleted successfully');
    }
    //........................................................................................
    public function back_from_soft_delete($id)
    {
        $record = User::onlyTrashed()->where('id',$id)->first();
        
        if(empty($record)) {
            return $this->error('','cannot show anysthing',500);
        }
        
        $record->restore();
        
        return   $this ->success('',200,' record Delete successfully');
          
        
    }

//...........................................................................................
public function trashed_user(){

        $user = User::onlyTrashed()->get();
     return $user;
     return   $this ->success($user,200,'view delete');
    }
//............................................................................................
 
//.............................................................................................


}
