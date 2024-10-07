<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use Illuminate\Support\Facades\DB;
use App\Traits\GenTraits;
use LaravelJsonApi\Eloquent\Filters\OnlyTrashed;
use Illuminate\Support\Facades\Validator;
class RecordController extends Controller
{
    use GenTraits;
    
   public function index(){
        return Record::all();
    }
  //................................................................................
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'gender' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'age' => 'required',
            
        ]);

        // حفظ الطالب في قاعدة البيانات
        $record = new Record;
        $record->customer_id = $request->customer_id;
        $record->name = $request->name;
        $record->age = $request->age;
        $record->phone = $request->phone;
        $record->address = $request->address;
        $record->gender = $request->gender;
        $record->save();
        return $this ->success($record,200,'Record  add successfully');

    }

    //...................................................................................
    
    public function  update_record(Request $request, $id){
        $record = Record::find($id);
        if (!$record) {
            return $this->error('','cannot show anysthing',500);
        }
        
        if($request->customer_id )
        {
            $record->customer_id  = $request->customer_id ;
        }
        if($request->name)
        {
            $record->name = $request->name;
        }

        if($request->age)
        {
            $record->age = $request->age;
        }
        if($request->gender)
        {
            $record->gender = $request->gender;
        }
        if($request->phone)
        {
            $record->phone = $request->phone;
        }
        if($request->address)
        {
            $record->address = $request->address;
        }

        $record->save();
        return $this ->success($record,200,'record updated successfully');

    }

    //.....................................................................................
    public function soft_delete($id)
    {
        $record=  Record::find($id);
        if(empty($record)) {
            return $this->error('','cannot show anysthing',500);
       }
    
       $record->delete();
    
        return   $this ->success('',200,'student Delete successfully');
          
        
        
    }
    //........................................................................................
    public function back_from_soft_delete($id)
{
    $record = Record::onlyTrashed()->where('id',$id)->first();
    
    if(empty($record)) {
        return $this->error('','cannot show anysthing',500);
    }
    
    $record->restore();
    
    return   $this ->success('',200,' record Delete successfully');
      
    
}

//...........................................................................................
public function trashed_Customer (){

        $customer = Record::onlyTrashed()->get();
     return $customer;
     return   $this ->success($customer,200,'view delete');
    }

//.............................................................................................
public function  search_name($name){
    return Record::where('name','like','%'.$name.'%')->get();

}



  
  //..................................................................................
}
