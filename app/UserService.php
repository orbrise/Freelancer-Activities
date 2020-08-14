<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
     protected  $fillable = ['id', 'user_id', 'cat_id', 'service','duration', 'budget_type', 'price','created_at','updated_at'];

     public static function checkIfExists($id)
     {
     	$user = UserService::where('service', $id)->first();
     	if(!empty($user->service)){return true;} else {return false;}
     }

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    public function userservice(){
        return $this->belongsTo('App\Service','service','id');
    }

    public function getcatdetails()
    {
        return $this->hasOne('App\NewsCategory','id','cat_id');
    }

    public function servicesDetails()
    {
       return $this->hasOne('App\Service','id','service');
    }

    public function serviceName()
    {
        return $this->hasOne(Service::class, 'id', 'service');
    }

    public static function manyServices($userid, $service_id)
    {
       return Userservice::where(['user_id' => $userid, 'service' => $service_id])->get();
    }

}
