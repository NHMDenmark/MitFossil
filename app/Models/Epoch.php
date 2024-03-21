<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Epoch extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'period_id',
        'active',
    ];

    public function period() : BelongsTo {
        return $this->belongsTo(Period::class, 'period_id');
    }

    public static function getDropdownQuery($concat = false)
    {
        $id = $concat ? "CONCAT('epoch_', id)" : 'id';

        $query = self::query()
            ->select('description as label')
            ->where(['active' => true])
            ->addSelect(DB::raw("$id as value"))
            ->orderBy('label', 'asc');

        if(!$concat) {
            $query = $query->addSelect('period_id');
        }

        return $query;
    }
}
