<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount', 'method', 'user_id', 'transaction_id', 'order_code', 'error_code', 'status', 'type_bank'
    ];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

}
