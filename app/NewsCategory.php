<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    public function subCats()
    {
        return $this->hasMany(NewsCategory::Class, 'parent_id', 'id');
    }

    public static function getCategoryName($id)
    {
        $gcn = NewsCategory::where('id', $id)->first();
        return $gcn->name;
    }

    public function getServices()
    {
        return $this->hasMany(Service::Class, 'cat_id', 'id');
    }
}
