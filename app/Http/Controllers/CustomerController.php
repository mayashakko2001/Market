<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
use App\Traits\GenTraits;
use Illuminate\Support\Facades\Validator;
class CustomerController extends Controller
{   
    use GenTraits;
    
   public function index(){
        return Customer::all();
    }
  //................................................................................
    public function store(Request $request)
    {
        $request->validate([
            
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required',
        ]);

        
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->password = $request->password;
        $customer->email = $request->email;
        $customer->save();
        return $this ->success($customer,200,'customer  add successfully');

    }

    //...................................................................................
    
    public function  update_customer(Request $request, $id){
        $customer = Customer::find($id);
        if (!$customer) {
            return $this->error('','cannot show anysthing',500);
        }
        
        if($request->name)
        {
            $customer->name = $request->name;
        }

        if($request->email)
        {
            $customer->email = $request->email;
        }
        if($request->password)
        {
            $customer->password = $request->passowrd;
        }
    

        $customer->save();
        return $this ->success($customer,200,'customer updated successfully');

    }

    //.....................................................................................
    public function soft_delete($id)
    {
        $customer=  Customer::find($id);
        if(empty($customer)) {
            return $this->error('','cannot show anysthing',500);
       }
    
       $customer->delete();
    
        return   $this ->success('',200,'customer Delete successfully');
          
        
        
    }
    //........................................................................................
    public function back_from_soft_delete($id)
{
    $customer = Customer::onlyTrashed()->where('id',$id)->first();
    
    if(empty($customer)) {
        return $this->error('','cannot show anysthing',500);
    }
    
    $customer->restore();
    
    return   $this ->success('',200,' customer Delete successfully');
      
    
}

//...........................................................................................
public function trashed_Customer (){

        $customer = Customer::onlyTrashed()->get();
     return $customer;
     return   $this ->success($customer,200,'view delete');
    }

//.............................................................................................
public function show($customer)
    {

        try {
            $customer = Customer::find($customer);

            if( $customer){
             return $this->success($customer,'200','');}
            
        } catch (Exception $ex) {
            return $this->error('','cannot show anysthing',500);
        }
    }
    public function search(Request $request)
    {
        $name = $request->input('name');
    
        $customer = Customer::where('name', 'like', "%$name%")->first();
    
        if (!$customer) {
            return $this->error('', 'Cannot find customer', 500);
        }
    
        $pages = $customer->pages()->get();
    
        return $this->success($pages, 200, '');
    }
}





