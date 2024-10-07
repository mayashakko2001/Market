<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table ='products';
    protected $fillable=[ 'department_id','page_id','saled','image','description','name','price','quantity' ];
    public function order(){
        return $this->hasMany(Order::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
}
public function page(){
    return $this->belongsTo(Page::class);
}

}
