<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overall extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'listassessment_id',
        'categorydetail_id',
        'nilai',
        'nadj'
    ];

    public function categoryDetail(){
        return $this->belongsTo('App\Models\CategoryDetail','categorydetail_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

}
