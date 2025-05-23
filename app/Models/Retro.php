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
        return $this->belongsTo(Cohort::class, 'promotion');
    }
    public function cards()
    {
        return $this->hasMany(Card::class);
    }
    public function column()
    {
        return $this->belongsTo(Column::class);
    }
    public function board()
    {
        return $this->hasOne(Board::class);
    }
    public function boards()
    {
        return $this->hasMany(Board::class);
    }
}
