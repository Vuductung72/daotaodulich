<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'profession_id', 'exam_id', 'exam_id_test', 'name', 'slug', 'price', 'price_sale','time_sale', 'thumb', 'description','describe','keyword','status'
    ];

    public function profession(){
        return $this->belongsTo(Profession::class);
    }
    public function lessons(){
        return $this->hasMany(Lesson::class);
    }
    public function exam(){
        return $this->hasOne(Exam::class,'id','exam_id');
    }
    public function examTest(){
        return $this->hasOne(Exam::class,'id','exam_id_test');
    }
    public function courseBuys(){
        return $this->hasMany(CourseBuy::class);
    }

    public function benefits(){
        return $this->hasMany(Benefit::class,'course_id','id');
    }

    public function feedbacks(){
        return $this->hasMany(Feedback::class,'course_id','id');
    }

    public function userCustomers(){
        return $this->hasMany(UserCustomer::class,'course_id','id');
    }

    public function exams(){
        return $this->hasMany(Exam::class);
    }
}
