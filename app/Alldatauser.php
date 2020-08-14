<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alldatauser extends Model
{
    public function getUserServices()
    {
    	return $this->hasOne(UserService::class, 'user_id', 'id')->orderBy('id');
    }
	
	 public static function getCustomValues($label)
    {
      return Alldatauser::where('label', $label)->where('customvalue', '!=', '')->select('customvalue')->groupBy('customvalue')->get();
    }
}
