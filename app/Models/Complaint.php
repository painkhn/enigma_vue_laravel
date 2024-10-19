<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'theme_id', 
        'user_id',
        'comment_id',
        'complaint',
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
