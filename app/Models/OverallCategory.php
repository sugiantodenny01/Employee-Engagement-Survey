<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverallCategory extends Model
{
    protected $table = 'overall_category';
    use HasFactory;

    protected $fillable = [
        'listassessment_id',
        'user_id',
        'category_id',
        'subtotal'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

}
