<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'image', 'date_buy', 'date_expired', 'client_id','user_id', 'origin', 'dental_name', 'supplier', 'description', 'qrcode_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function qrcode()
    {
        return $this->belongsTo(Qrcode::class, 'qrcode_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
