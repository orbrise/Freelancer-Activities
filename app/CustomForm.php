<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class CustomForm extends Model
{
    protected $fillable = [
    	'label','type','fvalues','created_at','updated_at',
    ];

    public function getValue()
    {
    	return $this->hasOne(UserCustomform::class, 'label', 'field_name')->where('user_id', Auth::user()->id);
    }
}
