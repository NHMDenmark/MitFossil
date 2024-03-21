<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'fossil_id',
        'path',
        'principal'
    ];

    public function fossil()
    {
        return $this->belongsTo(Fossil::class);
    }

    public static function getImage($id) {
        $query = self::query()
            ->where(['id' => $id]);

        return $query->firstOrFail();
    }
}
