<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'status', 'content', 'description', 'slug', 'image', 'keyword', 'type'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function forms()
    {
        return $this->morphMany(CustomerRegister::class, 'formable_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'comments','commentable_type', 'commentable_id')
            ->where('status', 1)->orderBy('id', 'desc')->limit(5);
    }

}
