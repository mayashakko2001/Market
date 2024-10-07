<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;
use Illuminate\Support\Facades\Validator;
use App\Traits\GenTraits;
class InvitationController extends Controller
{
    use GenTraits;
public function index()
{  return Invitation::all();

}
//...........................................................................................
public function store(Request $request)
{
    $request->validate([
        'accept' => 'required',
        'description' => 'required',
        'customer_id' => 'required|exists:customers,id'

       
        
    ]);

    
    $invitation = new Invitation;
    
    $invitation->accept = $request->accept;
    $invitation->description = $request->description;
    $invitation->customer_id = $request->customer_id;
    
    $invitation->save();
    return $this ->success($invitation,200,'invitation  add successfully');

}

//...................................................................................
public function show($invitation)
    {

        try {
            $invitation = Invitation::find($invitation);

            if( $invitation){
             return $this->success($invitation,'200','');}
            
        } catch (Exception $ex) {
            return $this->error('','cannot show anysthing',500);
        }
    }
//............................................................................................
public function delete_invitation($id){
$invitation=Invitation::find($id);

    if (!$invitation) {
        return $this->error('','cannot find product',500);
    }

    $invitation->delete();

    return $this ->success($invitation,200,'invitation delete successfully');
}
//..............................................................................................



}
