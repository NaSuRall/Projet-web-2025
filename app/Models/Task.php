<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'board_id', 'position', 'retro_id'];

    public function retro()
    {
        return $this->belongsTo(Retro::class);
    }
}
