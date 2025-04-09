<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'promotion',
        'group_number',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
