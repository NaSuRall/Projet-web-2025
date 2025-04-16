<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'position',
        'column_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
