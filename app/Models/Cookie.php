<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cookie extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'number_of_cookies',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
