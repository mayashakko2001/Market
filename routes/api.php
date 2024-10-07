<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShippmentController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;
//for cat::
    Route::post('add_cat',[CatController::class,'add_cat']);
    Route::delete('delete_cat/{id}',[CatController::class,'delete_cat']); 
//.....................................................................................................
//for user::
    
Route::group(['middleware' => ['CheckAdminToken:users-api'], 'namespace' => 'Api'], function () {
Route::post('add_user',[UserController::class,'store']);
Route::post('login1',[AuthController::class,'login']);
Route::post('logout1',[AuthController::class,'logout']);
Route::post('register1', [AuthController::class, 'register']);
Route::get('get_all_users',[UserController::class,'index']);
Route::put('update_user/{user}',[UserController::class,'update_user']);
Route::get('trashed_user',[UserController::class,'trashed_user']);
Route::get('back_from_soft_delete/{user}', [UserController::class, 'back_from_soft_delete']);
Route::delete('delete_user/{user}',[UserController::class,'soft_delete']);
//.......................................................
Route::post('add_customer',[CustomerController::class,'store']); 
Route::get('trashed_customer',[CustomerController::class,'trashed_Customer']);
Route::get('back_from_soft_delete/{customer}', [CustomerController::class, 'back_from_soft_delete']);
Route::delete('delete_customer/{customer}',[CustomerController::class,'soft_delete']);
//for record
Route::post('add_record',[RecordController::class,'store']);
Route::get('get_all_departments',[RecordController::class,'index']);
Route::put('update_record/{record}',[RecordController::class,'update_record']);
Route::delete('delete_recorcd/{record}',[RecordController::class,'soft_delete']);
Route::get('trashed_customer',[RecordController::class,'trashed_Customer']);
Route::get('back_from_soft_delete/{record}', [RecordController::class, 'back_from_soft_delete']);
Route::delete('delete_shippment/{shippment}',[ShippmentController::class,'soft_delete']);
Route::get('trashed_Shipement',[ShippmentController::class,'trashed_Shipement']);
Route::get('back_from_soft_delete/{shipment}', [ShippmentController::class, 'back_from_soft_delete']);
//................................................................................................
});
//......................................................................................................
//for customer

//Route::post('add_customer',[CustomerController::class,'store']);
Route::get('get_all_customers',[CustomerController::class,'index']);
Route::get('get_customer_id/{id}',[CustomerController::class,'show']);
Route::put('update_customer/{customer}',[CustomerController::class,'update_customer']);
 
Route::get('search',[CustomerController::class,'search']); 
//.........................................................................................................
//for product
Route::post('add_product',[ProductController::class,'add_product']);
Route::post('add_customer_for_publication',[ProductController::class,'add_customer_for_publication']);
Route::get('get_all_products',[ProductController::class,'index']);
Route::get('get_product_id/{id}',[ProductController::class,'show']);
Route::put('update_product/{product}',[ProductController::class,'update_product']);

Route::delete('delete_product/{product}',[ProductController::class,'delete_product']); 
//..................................................................................................
//for pages
Route::post('add_page',[PageController::class,'store']);
Route::get('saled_product/{id}',[PageController::class,'saled_product']);
Route::get('get_all_pages',[PageController::class,'index']);
Route::get('get_page_id/{id}',[PageController::class,'show']);
Route::put('update_page/{page}',[PageController::class,'update_page']);
Route::get('count_product/{id}',[PageController::class,'count_product']);
Route::delete('delete_page/{page}',[PageController::class,'delete_page']);
//.................................................................................................
//for department
Route::post('add_department',[DepartmentController::class,'store']);
Route::get('get_all_departments',[DepartmentController::class,'index']);
Route::get('get_department_id/{department}',[DepartmentController::class,'show']);
Route::put('update_department/{department}',[DepartmentController::class,'update_department']);
Route::delete('delete_department/{department}',[DepartmentController::class,'delete_department']);
//..................................................................................................

//for order
Route::post('add_order',[OrderController::class,'add']);
Route::get('get_all_orders',[OrderController::class,'index']);
Route::delete('delete_order/{order}',[OrderController::class,'delete']);
//...................................................................................................
//for shippment
Route::post('add_shippment',[ShippmentController::class,'add_shippment']);
Route::get('get_all_shippments',[ShippmentController::class,'index']);
Route::get('discounted_period_time/{id}',[ShippmentController::class,'discounted_period_time']);
Route::get('discounted/{id}',[ShippmentController::class,'discounted']);
Route::put('update_Shipement/{shippment}',[ShippmentController::class,'update_Shipement']);

//.....................................................................................................
//for invitation
Route::post('add_invtation',[InvitationController::class,'store']);
Route::get('get_all_invtations',[InvitationController::class,'index']);
Route::get('get_invtation/{id}',[InvitationController::class,'show']);
Route::delete('delete_invitation/{id}',[InvitationController::class,'delete_invitation']);
//....................................................................................................