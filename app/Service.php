<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
   public static function getServiceName($id)
   {
   	 $q = Service::find($id);
   	 return $q->name;
   }
}
