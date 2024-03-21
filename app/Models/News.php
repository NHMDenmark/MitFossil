<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'endpoint',
        'description',
        'html',
        'new_order',
        'active',
    ];

    public static function getNews() {
        return self::query()
            ->where(['active' => true])
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();
    }

    public static function getNew($endpoint) {
        return self::query()
            ->where(['active' => true, 'endpoint' => $endpoint])
            ->firstOrFail();
    }
}
