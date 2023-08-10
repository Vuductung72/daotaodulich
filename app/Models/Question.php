<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','profession_id', 'content', 'type','status'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function examQuestions()
    {
        return $this->hasMany(ExamQuestion::class,'question_id','id');
    }

    public function lessonQuestions()
    {
        return $this->hasMany(LessonQuestion::class,'question_id','id');
    }
}
