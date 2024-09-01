<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'data',
        'is_read'
    ];

    public static function createNotification($userId, $type, $data)
    {
        return self::create([
            'user_id' => $userId,
            'type' => $type,
            'data' => json_encode($data),
        ]);
    }
}
