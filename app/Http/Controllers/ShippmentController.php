<?php

namespace App\Http\Controllers;
use App\Models\Shipement;
use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelJsonApi\Eloquent\Filters\OnlyTrashed;
use App\Traits\GenTraits;
class ShippmentController extends Controller
{
    use GenTraits;
    
    public function index(){
        return Shipement::all();
    }
    public function add_shippment(Request $request)
    {
        $request->validate([
            
            'cat_id' => 'required|exists:cats,id',
            'total_price'=>'required'
        ]);

        
        $Shipement = new Shipement;
        $Shipement->cat_id = $request->cat_id;
        $Shipement->total_price = $request->total_price;
        $Shipement->save();
        return $this ->success($Shipement,200,'Shipement  add successfully');

    }
//...........................................................................................
public function  update_Shipement(Request $request, $id){
    $Shipement = Shipement::find($id);
    if (!$Shipement) {
        return $this->error('','cannot show anysthing',500);
    }
    
    if($request->cat_id )
    {
        $Shipement->cat_id  = $request->cat_id ;
    }
    

    
    $Shipement->save();
    return $this ->success($Shipement,200,'Shipement updated successfully');

}
    //.....................................................................................
    public function soft_delete($id)
    {
        $Shipement=  Shipement::find($id);
        if(empty($Shipement)) {
            return $this->error('','cannot show anysthing',500);
       }
    
       $Shipement->delete();
    
        return   $this ->success('',200,'Shipement Delete successfully');
          
        
        
    }
    //........................................................................................
    public function back_from_soft_delete($id)
{
    $Shipement = Shipement::onlyTrashed()->where('id',$id)->first();
    
    if(empty($Shipement)) {
        return $this->error('','cannot show anysthing',500);
    }
    
    $Shipement->restore();
    
    return   $this ->success('',200,' Shipement Delete successfully');
      
    
}

//...........................................................................................
public function trashed_Shipement (){

        $Shipement = Shipement::onlyTrashed()->get();
     return $Shipement;
     return   $this ->success($Shipement,200,'view delete');
    }
//.....................................................................................
public function show($Shipement)
    {

        try {
            $Shipement = Shipement::find($Shipement);

            if( $Shipement){
             return $this->success($Shipement,200,'');}
            
        } catch (Exception $ex) {
            return $this->error('','cannot show anysthing',500);
        }
    }
    //.....................................................................................
    public function discounted($id)
    {
        $shipment = Shipement::find($id);
        
        if (!$shipment) {
            return $this->error('', 'Cannot show anything', 500);
        }
        
        $total_price = $shipment->total_price;
        
        $discounted = $total_price - ($total_price * 0.2);
        
        $shipment->total_price = $discounted;
        $shipment->save();
        
        return $this->success($shipment, 200, 'Discounted successfully');
    }
//....................................................................................................
public function discounted_period_time()
{
    $date = date('Y-m-d');
    $start = '2023-09-06';
    $end = '2023-09-10';

    $shipment = Shipement::first(); 
    if (!$shipment) {
        return $this->error('', 'Cannot show anything', 500);
    } 

    $total_price = $shipment->total_price;

    if ($date >= $start && $date <= $end) {
        $discount = 0.4;
        $discounted_price = $total_price - ($total_price * $discount);
        
        $shipment->total_price = $discounted_price;
        $shipment->save();
        
        return $this->success($shipment, 200, 'Discounted successfully');
    } else {
        return $this->error('', 'Cannot apply discount', 500);
    }
}
}
