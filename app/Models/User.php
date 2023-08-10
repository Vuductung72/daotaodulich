<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use Filterable;

    // protected $guard = 'user';

    protected $gender = [
        1 => 'Nam',
        2 => 'Nữ'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','token', 'email_verified' ,'verify_code', 'last_login' ,'address', 'avatar', 'gender', 'phone', 'money',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function getGender($gender)
    {
        return $this->gender[$gender] ?  $this->gender[$gender] : 'Không xác định';
    }

    public function dataUser()
    {
        return $this->hasOne(DataUser::class, 'user_id', 'id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function qrcodes()
    {
        return $this->hasMany(Qrcode::class);
    }

     public function courseBuys(){
        return $this->hasMany(CourseBuy::class);
    }

    public function userCustomer(){
        return $this->hasMany(UserCustomer::class);
    }
}
