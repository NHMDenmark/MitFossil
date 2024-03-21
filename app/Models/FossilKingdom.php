<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FossilKingdom extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'active',
    ];

    public static function getDropdownQuery($concat = false)
    {
        $id = $concat ? "CONCAT('kingdom_', id)" : 'id';

        return self::query()
            ->select('description as label')
            ->where(['active' => true])
            ->addSelect(DB::raw("$id as value"))
            ->orderBy('label', 'asc');
    }
}
