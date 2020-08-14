<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessNature extends Model
{
    public static function getTypeName($id)
    {
        $gtn = BusinessNature::where('id', $id)->first();
        return $gtn->name;
    }
}
