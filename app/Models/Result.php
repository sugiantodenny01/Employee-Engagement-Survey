<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $table = 'results';
    protected $fillable = [
        'listassessment_id',
        'user_id',
        'score'
    ];


    public function listAssessment(){
        return $this->belongsTo('App\Models\ListAssessments');
    }


    public function user(){
        return $this->belongsTo('App\Models\User');

    }


}
