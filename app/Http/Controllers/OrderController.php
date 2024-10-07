<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use App\Traits\GenTraits;
class OrderController extends Controller
{
    use GenTraits;
    public function index(){
        return Order::all();
    }
    public function add(Request $request)
    {
        $request->validate([
            
            'cat_id' => 'required|exists:cats,id',
            'product_id' => 'required|exists:products,id',
        ]);

        
        $order = new Order;
        $order->cat_id = $request->cat_id;
        $order->product_id = $request->product_id;
        $order->save();
        return $this ->success($order,200,'order  add successfully');

    }
//...........................................................................................
public function delete($id){
    $order=Order::find($id);

        if (!$order) {
            return $this->error('','cannot find order',500);
        }

        $order->delete();

        return $this ->success($order,200,'order delete successfully');
    }
}
