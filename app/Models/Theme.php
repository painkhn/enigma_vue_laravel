<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', 
        'user_id',
        'comment_id',
        'name', 
        'content',
        'link'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->belongsTo(Comments::class);
    }
    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
    public function views()
    {
        return $this->hasMany(View::class);
    }
}
