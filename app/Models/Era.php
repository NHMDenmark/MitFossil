<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Era extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'eon_id',
        'active',
    ];

    public function eon() : BelongsTo {
        return $this->belongsTo(Eon::class, 'eon_id');
    }

    public static function getDropdownQuery($concat = false)
    {
        $id = $concat ? "CONCAT('era_', id)" : 'id';

        $query = self::query()
            ->select('description as label')
            ->where(['active' => true])
            ->addSelect(DB::raw("$id as value"))
            ->orderBy('label', 'asc');

        if(!$concat) {
            $query = $query->addSelect('eon_id');
        }

        return $query;
    }
}
