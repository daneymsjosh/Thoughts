<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thought extends Model
{
    use HasFactory;

    protected $with = ['user', 'comments.user'];

    protected $withCount = ['likes', 'pins'];

    protected $fillable = [
        'user_id',
        'content',
        'image'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'like_thought')->withTimestamps();
    }

    public function pins()
    {
        return $this->belongsToMany(User::class, 'pin_thought')->withTimestamps();
    }

    public function scopeSearch(Builder $query, $search = '')
    {
        $query->where('content', 'like', '%' . $search . '%');
    }

    public function scopeLikedThought(Builder $query, User $user)
    {
        $likedIds = $user->likes()->pluck('id');
        $query->whereIn('id', $likedIds)->latest();
    }

    public function getImageURL()
    {
        if ($this->image) {
            return url('storage/' . $this->image);
        }
        return null;
    }
}
