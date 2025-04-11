<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCohort extends Model
{
   use HasFactory;

   protected $table = 'users_cohorts';
   protected $fillable = [
       'user_id',
       'cohorts_id',
   ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
