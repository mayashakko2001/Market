<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;
    protected $table ='cats';
    protected $fillable=[ 'customer_id' ];
   
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function order(){
        return $this->hasMany(Order::class);
    }
    public function shipement(){
        return $this->hasMany(Shipement::class);
    }


}
