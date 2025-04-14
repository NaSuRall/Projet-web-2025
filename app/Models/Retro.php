<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retro extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'promotion',
        'creator_id',
    ];
    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

}
