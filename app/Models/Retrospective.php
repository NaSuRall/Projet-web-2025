<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retrospective extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cohort_id',
    ];

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function columns()
    {
        return $this->hasMany(Column::class);
    }
}
