<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use app\User;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $incrementing = false;
   

    // protected $incrementing = false;
    // protected $table="MST_USER";
    // protected $primaryKey = 'USER_ID';
    // protected $fillable = [
    //     'USER_ID','USER_NAME', 'USER_PASSWORD',
    // ];
    protected $table="API_USERS";
    protected $connection ="dealer";
    protected $primaryKey = 'ID';
    protected $fillable = [
        'ID','NAME','EMAIL','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
