<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['fullname','slug','email','password','description','type','avatar','phone','status','regular_address'];
    public function expert(){
        return $this->hasOne(Expert::class,'customer_id','id');
    }

    public function internship(){
        return $this->hasOne(Internship::class,'customer_id','id');
    }

}
