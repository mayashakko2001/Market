<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{protected $dates = ['deleted_at'];
    use SoftDeletes;
    use HasFactory;
    protected $table ='records';
    protected $fillable=[ 'customer_id','address','phone','gender','age','name' ];
   
    public function customer(){
        return $this->hasOne(Customer::class);
    }
}
