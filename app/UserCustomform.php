<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCustomform extends Model
{
    protected $fillable = [
    	'user_id','label','value','created_at','updated_at'
    ];
}
