<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Traits\GenTraits;
class PageController extends Controller
{
    use GenTraits;
    public function index(){
        return Page::all();
    }
  //................................................................................
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
           
            'invitation_id' => 'required|exists:invitations,id',
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
           'count_products' => 'required',
           'saled_products' => 'required',
        ]);

        
        $page = new Page;
        $page->customer_id = $request->customer_id;
        $page->name = $request->name;
        $page->count_products = $request->count_products;
    
        $page->description = $request->description;
        $page->invitation_id = $request->invitation_id;
        $page->image = $request->image;
        $page->saled_products = $request->saled_products;
        $page->save();
        return $this ->success($page,200,'page  add successfully');

    }

    //...................................................................................
    
    public function  update_page(Request $request, $id){
        $page = Page::find($id);
        if (!$page) {
            return $this->error('','cannot show anysthing',500);
        }
        
        if($request->customer_id )
        {
            $page->customer_id  = $request->customer_id ;
        }
        if($request->name)
        {
            $page->name = $request->name;
        }
        if($request->count_products)
        {
            $page->count_products = $request->count_products;
        }

        if($request->image)
        {
            $page->image = $request->image;
        }
        if($request->invitation_id)
        {
            $page->invitation_id = $request->invitation_id;
        }
      
        if($request->description)
        {
            $page->description = $request->description;
        }
        if($request->saled_products)
        {
            $page->saled_products = $request->saled_products;
        }

        $page->save();
        return $this ->success($page,200,'page updated successfully');

    }
//............................................................................................
public function delete_page($id){
    $page=Page::find($id);

        if (!$page) {
            return $this->error('','cannot find page',500);
        }

        $page->delete();

        return $this ->success($page,200,'page delete successfully');
    }
 //................................................................................................

 //......................................................................................................
 public function show($page)
    {

        try {
            $page = Page::find($page);

            if( $page){
             return $this->success($page,'200','');}
            
        } catch (Exception $ex) {
            return $this->error('','cannot show anysthing',500);
        }
    }
    //.................................................................................................
    public function count_product($id)
    {
        $page = Page::find($id);
    
        if (!$page) {
            return $this->error('', 'cannot find', 500);
        }
    
        $count_products = $page->product()->sum('quantity');
    
        $page->count_products = $count_products;
        $page->save();
    
        return $this->success($page, 200, 'it is the count_products');
    }
    //...................................................................................................
    public function saled_product($id)
{
    $page = Page::find($id);

    if (!$page) {
        return $this->error('', 'cannot find', 500);
    }
    
    $saled_products = $page->product()->where('saled', true)->count();
    $page->saled_products = $saled_products;
    $page->save();
    return $this->success($page, 200, 'it is the saled_products');
}


    
    }








