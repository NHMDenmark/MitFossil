<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'resource_id',
        'name',
        'endpoint',
        'description',
        'html',
        'resource_order',
        'image',
        'active',
    ];

    public function parent() : BelongsTo {
        return $this->belongsTo(Resource::class, 'resource_id');
    }

    public static function getChilds($parent_id) {
        return self::query()
            ->where(['resource_id' => $parent_id])
            ->orderBy('resource_order')
            ->get();
    }

    public static function getResources() {
        return self::query()
            ->where(['active' => true, 'resource_id' => null])
            ->orderBy('resource_order')
            ->get();
    }

    public static function findResource($id) {
        return self::query()
            ->with('parent')
            ->where(['id' => $id])
            ->firstOrFail();
    }

    public static function getResource($endpoint) {
        return self::query()
            ->with('parent')
            ->where(['active' => true, 'endpoint' => $endpoint])
            ->firstOrFail();
    }
}
