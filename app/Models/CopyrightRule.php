<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopyrightRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'notes'
    ];

    public static function getDropdown()
    {
        return self::all()
            ->map( function ($item, $key) {
                return [
                    'value' => $item->id,
                    'label' => $item->description,
                    'notes' => $item->notes
                ];
            });
    }
}
