<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Customer extends Model
{
    protected $dates = ['deleted_at'];
    use HasFactory;
    use SoftDeletes;
    protected $table ='customers';
    protected $fillable=[ 'password','email','name' ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function cat(){
        return $this->hasMany(Cat::class);
    }
    public function pages(){
        return $this->hasMany(Page::class);
    }
    
    public function record(){
        return $this->belongsTo(Record::class);
    }
    public function invitation(){
        return $this->hasMany(Invitation::class);
    }

}
