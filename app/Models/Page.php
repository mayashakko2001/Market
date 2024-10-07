<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    use HasFactory;
    protected $table ='pages';
    protected $fillable=[ 'invitation_id','customer_id','image','description','name' ,'count_products','saled_products'];
    public function invitation(){
        return $this->belongsTo(Invitation::class);
}

public function customer(){
    return $this->belongsTo(Customer::class);
}
public function product(){
    return $this->hasMany(Product::class);
}

}
