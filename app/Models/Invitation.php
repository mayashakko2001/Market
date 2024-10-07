<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;
    protected $table ='invitations';
    protected $fillable=[ 'customer_id' ,'accept','description'];
    public function customer(){
        return $this->belongsTo(Customer::class);
}
public function page(){
    return $this->hasMany(Page::class);
}

}
