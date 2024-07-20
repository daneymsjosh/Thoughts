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
        'featured',
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

    public function scopeFeatured(Builder $query, User $user)
    {
        $query->where('user_id', $user->id)->where('featured', true);
    }

    public function scopeLikedThought(Builder $query, User $user)
    {
        $likes = $user->likes()->withPivot('updated_at')->orderByPivot('updated_at', 'desc')->get(['thoughts.id', 'like_thought.updated_at']);
        $likedIds = $likes->pluck('id')->toArray();
        $query->whereIn('id', $likedIds)->orderByRaw("FIELD(id, " . implode(',', $likedIds) . ")");
    }

    public function scopeBookmarkedThought(Builder $query, User $user)
    {
        // Order the pins by the updated_at column in the pivot table in descending order
        $bookmarks = $user->pins()->withPivot('updated_at')->orderByPivot('updated_at', 'desc')->get(['thoughts.id', 'pin_thought.updated_at']);
        // Extract the thought IDs in the ordered sequence and converts it to an array
        $bookmarkIds = $bookmarks->pluck('id')->toArray();
        // Retrieve the thoughts using the ordered bookmark IDs
        $query->whereIn('id', $bookmarkIds)->orderByRaw("FIELD(id, " . implode(',', $bookmarkIds) . ")");
    }

    public function scopeMedia(Builder $query, User $user)
    {
        $query->where('user_id', $user->id)->latest()->whereNotNull('image');
    }

    public function getImageURL()
    {
        if ($this->image) {
            return url('storage/' . $this->image);
        }
        return null;
    }
}
