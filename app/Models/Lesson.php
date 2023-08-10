<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug' ,'order', 'thumb', 'content', 'course_id', 'audio','status'
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function lessonQuestions(){
        return $this->hasMany(LessonQuestion::class);
    }  
    
    public function learneds(){
        return $this->hasMany(Learned::class);
    } 

}
