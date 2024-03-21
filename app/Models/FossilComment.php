<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FossilComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'fossil_id',
        'user_id',
        'comment',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo( User::class );
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public static function getComments($fossil_id)
    {
        return self::query()
            ->where(['fossil_id' => $fossil_id])
            ->get();
    }
}
