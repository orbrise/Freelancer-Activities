<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userdetail(){
        return $this->hasOne('App\UserDetail','user_id','id');
    }
    
    public function userservice(){
        return $this->hasMany('App\UserService','user_id','id');
    }

    public function userCustomforms(){
        return $this->hasMany(UserCustomform::class,'user_id','id');
    }

public function getUserServices()
    {
    	return $this->hasOne(UserService::class, 'user_id', 'id')->orderBy('id');
    }
    

    }
