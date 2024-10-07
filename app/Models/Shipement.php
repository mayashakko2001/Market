<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Shipement extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='shipements';
    protected $fillable=[ 'total_price','cat_id' ];
    protected $dates = ['deleted_at'];

public function cat(){
    return $this->belongsTo(Cat::class);
}

}
