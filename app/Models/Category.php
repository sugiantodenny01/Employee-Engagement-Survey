<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function categoryDetail(){
       return $this->hasMany('App\Models\CategoryDetail','category_id');
       /* sama
       return $this->hasMany('App\Models\CategoryDetail','category_id','id');
       */
    }

    public function overrallCategory(){
        return $this->hasMany('App\Models\overallCategory','category_id');
    }


}
