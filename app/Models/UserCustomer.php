<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCustomer extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','customer_id','course_id', 'confirm_time', 'internship_id', 'status','content', 'type'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function internship(){
        return $this->belongsTo(Internship::class);
    }
}
