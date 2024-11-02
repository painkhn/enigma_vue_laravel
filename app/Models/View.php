<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $fillable = ['theme_id', 'user_id'];

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
