<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ["id"];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function borrow()
    {
        return $this->hasMany(Borrow::class, 'book_id');
    }
    public function histories()
    {
        return $this->hasMany(History::class, 'books_id');
    }
}
