<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $fillable = [
        'retrospective_id',
        'title',
        'position'
    ];

    public function retrospective()
    {
        return $this->belongsTo(Retrospective::class);
    }


    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
