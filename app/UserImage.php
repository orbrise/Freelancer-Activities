<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    protected $fillable = ['id','user_id','image_name','created_at', 'updated_at'];
}
