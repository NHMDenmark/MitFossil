<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_notificator_id',
        'fossil_id',
        'type',
        'title',
        'text',
        'viewed',
    ];

    public function user_notificator() : BelongsTo {
        return  $this->belongsTo(User::class, 'user_notificator_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public static function getNotifications($user_id) {
        return self::query()
            ->with('user_notificator')
            ->where(['user_id' => $user_id])
            ->orderByDesc('created_at')
            ->get();
    }

    public static function getCount($user) {
        if($user == null) return 0;

        return self::query()
            ->where(['user_id' => $user->id, 'viewed' => 0])
            ->count('id');
    }
}
