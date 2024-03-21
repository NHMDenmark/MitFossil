<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geochronology extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'active',
    ];

    public static function getDropdown()
    {
        return self::all()
            ->map( function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->description
                ];
            });
    }

}
