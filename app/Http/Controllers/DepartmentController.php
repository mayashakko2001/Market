<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Traits\GenTraits;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    use GenTraits;
    public function index(){
        return Department::all();
    }
  //................................................................................
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'discription' => 'required',
           
            
        ]);

        
        $department = new Department;
        
        $department->name = $request->name;
        $department->discription = $request->discription;
    
        $department->save();
        return $this ->success($department,200,'department  add successfully');

    }

    //...................................................................................
    
    public function  update_department(Request $request, $id){
        $department = Department::find($id);
        if (!$department) {
            return $this->error('','cannot show anysthing',500);
        }
       
        if($request->name)
        {
            $product->name = $request->name;
        }

        if($request->discription)
        {
            $product->discription = $request->discription;
        }
      
        $department->save();
        return $this ->success($department,200,'department updated successfully');

    }
//............................................................................................
public function delete_department($id){
    $department=Department::find($id);

        if (!$department) {
            return $this->error('','cannot find product',500);
        }

        $department->delete();

        return $this ->success($department,200,'department delete successfully');
    }
 //................................................................................................
 
 //......................................................................................................
 public function show($department)
    {

        try {
            $department = Department::find($department);

            if( $department){
             return $this->success($department,'200','');}
            
        } catch (Exception $ex) {
            return $this->error('','cannot show anysthing',500);
        }
    }
}
