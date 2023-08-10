<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug' , 'customer_id','profession_id','describe','quantity','wage','time','start_time', 'status'];

    public function customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }

    public function profession(){
        return $this->hasOne(Profession::class,'id','profession_id');
    }

    public function userCustomer(){
        return $this->hasMany(UserCustomer::class,'internship_id','id');
    }

}
