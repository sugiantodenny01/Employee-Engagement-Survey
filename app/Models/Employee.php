<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'division_id',
        'id_number',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'email',
        'password',
        'education',
        'address',
        'phone',
        'role',
        'join_date',
        'avatar',
        'status',
    ];

    public function division()
    {
        return $this->belongsTo('App\Models\Division');
    }
}
