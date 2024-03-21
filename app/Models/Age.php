<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Age extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'epoch_id',
        'active',
    ];

    public function epoch() : BelongsTo {
        return $this->belongsTo(Epoch::class, 'epoch_id');
    }

    public static function getDropdownQuery($concat = false)
    {
        $id = $concat ? "CONCAT('age_', id)" : 'id';

        $query = self::query()
            ->select('description as label')
            ->where(['active' => true])
            ->addSelect(DB::raw("$id as value"))
            ->orderBy('label', 'asc');

        if(!$concat) {
            $query = $query->addSelect('epoch_id');
        }

        return $query;
    }

    public static function getGroupDropdown(): array
    {
        $age = self::getDropdownQuery(true);
        $eon = Eon::getDropdownQuery(true);
        $epoch = Epoch::getDropdownQuery(true);
        $era = Era::getDropdownQuery(true);
        $period = Period::getDropdownQuery(true);

        $raw = $eon
            ->union($era)
            ->union($period)
            ->union($epoch)
            ->union($age)
            ->get();

        $temp = [];

        foreach ($raw as $item) {
            $parts = explode('_', $item->value);
            $group = $parts[0];

            if(!array_key_exists( $group, $temp )) {
                $temp[$group] = ['label' => __('messages.forms.' . $group )];
            }

            $temp[$group]['options'][] = $item;
        }

        $result = [];

        foreach ($temp as $item) {
            $result[] = $item;
        }

        return $result;
    }
}
