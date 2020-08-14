<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function subLocs()
    {
        return $this->hasMany(Location::Class, 'parent_id', 'id');
    }

    public static function getLocationName($id)
    {
        $gln = Location::where('id', $id)->first();
        return $gln->name;
    }

    
}
