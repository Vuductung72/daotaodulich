<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExamQuestion;
use App\Models\Profession;
class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
       'name', 'profession_id','course_id' ,'time',	'type', 'number_pass','money',
    ];

    public function examQuestions(){
        return $this->hasMany(ExamQuestion::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function results(){
        return $this->hasMany(Result::class);
    }

    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function course(){
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
