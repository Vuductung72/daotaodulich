<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'avatar', 'position', 'position_type' , 'content', 'star', 'course_id','user_id', 'status'
    ];

    public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
