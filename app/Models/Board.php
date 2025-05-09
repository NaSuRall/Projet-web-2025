<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'retro_id',
        'cohort_id'
    ];

    public function retro()
    {
        return $this->belongsTo(Retro::class);
    }

    public function columns()
    {
        return $this->hasMany(Column::class);
    }
}
