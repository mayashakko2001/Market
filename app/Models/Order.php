<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table ='orders';
    protected $fillable=[ 'product_id','cat_id' ];
    public function product(){
        return $this->belongsTo(Product::class);
}
public function cat(){
    return $this->belongsTo(Cat::class);
}
}
