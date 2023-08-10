<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'image', 'description', 'position', 'type', 'status'
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class,'category_id','id');
    }

    
}

