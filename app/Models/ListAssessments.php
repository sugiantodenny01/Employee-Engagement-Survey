<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListAssessments extends Model
{
    use HasFactory;
    protected $table = 'list_assessments';
    protected $fillable = [
        'detail',
        'start',
    ];


    public function result(){
        return $this->hasMany('App\Models\Result');
    }


}
