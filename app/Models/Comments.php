<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'theme_id', 
        'profile_id', 
        'user_id',
        'content',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function theme()
    {
        return $this->hasOne(theme::class);
    }
}
