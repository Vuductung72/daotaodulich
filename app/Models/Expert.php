<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id','profession_id','birthday','gender','nationality','marital_status','current_address','content','social_network'];

    public function customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }
    public function profession(){
        return $this->hasOne(Profession::class,'id','profession_id');
    }
}
