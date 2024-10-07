<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Page;
use App\Models\Customer;
use LaravelJsonApi\Eloquent\Filters\OnlyTrashed;
use App\Traits\GenTraits;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{   use GenTraits;
    public function index(){
        return Product::all()
        ;
    }
  //................................................................................
  public function add_product(Request $request)
  {
      $request->validate([
         
          'saled' => 'required',
          'page_id' => 'required|exists:pages,id',
          'department_id' => 'required|exists:departments,id',
          'name' => 'required',
          'price' => 'required',
          'image' => 'required',
          'description' => 'required',
          'quantity' => 'required',
          
      ]);

      
      $product = new Product;
      $product->saled = $request->saled;
      $product->name = $request->name;
      $product->page_id = $request->page_id;
      $product->description = $request->description;
      $product->department_id = $request->department_id;
      $product->image = $request->image;
      $product->quantity = $request->quantity;
      $product->save();
      return $this ->success($product,200,'product  add successfully');

  }

    //...................................................................................
    
    public function update_product(Request $request, $id)
{
    $product = Product::find($id);
    if (!$product) {
        return $this->error('', 'لا يمكن عرض أي شيء', 500);
    }

    if ($request->has('price')) {
        $product->price = $request->price;
    }
    if ($request->has('name')) {
        $product->name = $request->input('name');
    }
    if ($request->has('image')) {
        $product->image = $request->input('image');
    }
    if ($request->has('department_id')) {
        $product->department_id = $request->input('department_id');
    }
    if ($request->has('page_id')) {
        $product->page_id = $request->input('page_id');
    }
    if ($request->has('description')) {
        $product->description = $request->input('description');
    }
    if ($request->has('saled')) {
        $product->saled = $request->input('saled');
    }
    if ($request->has('quantity')) {
        $product->quantity = $request->input('quantity');
    }

    $product->save();
    return $this->success($product, 200, 'تم تحديث المنتج بنجاح');
}
//............................................................................................
public function delete_product($id){
    $product=Product::find($id);

        if (!$product) {
            return $this->error('','cannot find product',500);
        }

        $product->delete();

        return $this ->success($product,200,'product delete successfully');
    }
 //................................................................................................
 
 //......................................................................................................
 public function show($product)
    {

        try {
            $product = Product::find($product);

            if( $product){
             return $this->success($product,200,'');}
            
        } catch (Exception $ex) {
            return $this->error('','cannot show anysthing',500);
        }
    }
    //.................................................................................................
    public function add_customer_for_publication(Request $request)
    {
        $customer_id = $request->input('customer_id');
        $page_id = $request->input('page_id');
    
        $customer = Customer::find($customer_id);
        $page = Page::find($page_id);
    
        if (!$page || !$customer) {
            return $this->error('','Cannot find customer or page',500);
        }
    
        $this->add_product($request);
        $page->save();
        return $this ->success($page,200,'product added successfully');
       
    }
//................................................................................................
  

}
