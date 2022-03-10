<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
    use HasFactory;

    protected $table = 'category_details';

    protected $fillable = [
        'name',
        'category_id',
        'quality'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function overall(){
        return $this->hasMany('App\Models\Overall','categorydetail_id');
    }

}
