<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug','profession_code', 'status'
    ];
    public function courses(){
        return $this->hasMany(Course::class);
    }
}