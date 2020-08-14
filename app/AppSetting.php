<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    public static function AppName()
    {
    	$appname = AppSetting::find(1);
    	return $appname->appname;
    }
    public static function AppLogo()
    {
    	$logo = AppSetting::find(1);
    	return $logo->logo;
    }

    public static function AppIcon()
    {
    	$icon = AppSetting::find(1);
    	return $icon->favicon;
    }

    public static function AppDesc()
    {
        $desc = AppSetting::find(1);
        return $desc->description;
    }
    public static function AppKeywords()
    {
        $key = AppSetting::find(1);
        return $key->keywords;
    }

}
