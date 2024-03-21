<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class FossilClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'active',
    ];

    public static function getDropdownQuery($concat = false)
    {
        $id = $concat ? "CONCAT('class_', id)" : 'id';

        return self::query()
            ->select('description as label')
            ->where(['active' => true])
            ->addSelect(DB::raw("$id as value"))
            ->orderBy('label', 'asc');
    }
}
