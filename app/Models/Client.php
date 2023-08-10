<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'birthday', 'email', 'phone', 'address', 'image', 'user_id', 'qrcode_id'
    ];

    public function services()
    {
        return $this->belongsTo(Service::class, 'client_id' );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
