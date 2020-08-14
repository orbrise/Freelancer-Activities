<?php

namespace App;

class StaticFunctions 
{
    public static function arrayToID($array,$value)
    {
            $json = json_decode($array);
            if(in_array($value, $json)){
            return true;
            }
    }

    public static function arrayToStringLocation($array)
    {
            foreach($array as $key => $loc) {
                $locations[] = Location::getLocationName($loc); 
            }
            return $locations;
            
    }

    public static function arrayToStringCats($cats)
    {
            foreach($cats as $c => $cv) {
                $ac[] = NewsCategory::getCategoryName($cv); 
            }
            return $ac;      
    }

    public static function arrayToStringTypes($types)
    {
            foreach($types as $t => $tpn) {
                $tps[] = BusinessNature::getTypeName($tpn); 
            }
            return $tps;      
    }

    public static function custoFormArray($field,$opt)
    {
        $makearray = explode(',',$field);
        return in_array($opt,$makearray);
        }
}