<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\Customer;
use App\Traits\GenTraits;
use Illuminate\Support\Facades\Validator;
class CatController extends Controller
{  use GenTraits;
    
  //................................................................................
    public function add_cat(Request $request)
    {
        $request->validate([
            
            'customer_id' => 'required|exists:customers,id',
        ]);

        
        $cat = new Cat;
        $cat->customer_id = $request->customer_id;
        
        $cat->save();
        return $this ->success($cat,200,'cat  add successfully');

    }
//...........................................................................................
public function delete_cat($id){
    $cat=Cat::find($id);

        if (!$cat) {
            return $this->error('','cannot find cat',500);
        }

        $cat->delete();

        return $this ->success($cat,200,'cat delete successfully');
    }
}
