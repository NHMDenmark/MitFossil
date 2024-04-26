<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class FossilTaxonomy extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'fossil_kingdom_id',
        'fossil_common_id',
        'fossil_phylum_id',
        'fossil_class_id',
        'fossil_order_id',
        'fossil_family_id',
        'fossil_genre_id',
        'fossil_subgenre_id',
        'specific_epithet_id',
        'fossil_subspecies_id',
        'active',
    ];

    public function fossil_kingdom() : BelongsTo
    {
        return $this->belongsTo( FossilKingdom::class );
    }

    public function fossil_common() : BelongsTo
    {
        return $this->belongsTo( FossilCommon::class );
    }

    public function fossil_phylum() : BelongsTo
    {
        return $this->belongsTo( FossilPhylum::class );
    }

    public function fossil_class() : BelongsTo
    {
        return $this->belongsTo( FossilClass::class );
    }

    public function fossil_order() : BelongsTo
    {
        return $this->belongsTo( FossilOrder::class );
    }

    public function fossil_family() : BelongsTo
    {
        return $this->belongsTo( FossilFamily::class );
    }

    public function fossil_genre() : BelongsTo
    {
        return $this->belongsTo( FossilGenre::class );
    }

    public function fossil_subgenre() : BelongsTo
    {
        return $this->belongsTo( FossilSubgenre::class );
    }

    public function specific_epithet() : BelongsTo
    {
        return $this->belongsTo( SpecificEpithet::class );
    }

    public function fossil_subspecies() : BelongsTo
    {
        return $this->belongsTo( FossilSubspecies::class );
    }

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

    public static function getGroupDropdown(): array
    {
        $common = FossilCommon::getDropdownQuery(true);
        $kingdom = FossilKingdom::getDropdownQuery(true);
        $family = FossilFamily::getDropdownQuery(true);
        $phylum = FossilPhylum::getDropdownQuery(true);
        $class = FossilClass::getDropdownQuery(true);
        $order = FossilOrder::getDropdownQuery(true);
        $genre = FossilGenre::getDropdownQuery(true);
        $subgenre = FossilSubgenre::getDropdownQuery(true);
        $specific_epithet = SpecificEpithet::getDropdownQuery(true);
        $subspecies = FossilSubspecies::getDropdownQuery(true);

        $array1 = $common ->get()->toArray();
        $array2 = $kingdom ->get()->toArray();
        $array3 = $phylum ->get()->toArray();
        $array4 = $class ->get()->toArray();
        $array5 = $order ->get()->toArray();
        $array6 = $family ->get()->toArray();
        $array7 = $genre ->get()->toArray();
        $array8 = $subgenre ->get()->toArray();
        $array9 = $specific_epithet ->get()->toArray();
        $array10 = $subspecies ->get()->toArray();
        $raw = array_merge($array2, $array3, $array4, $array5, $array6, $array7, $array8, $array10);

        $temp = [];

        foreach ($raw as $item) {
            $parts = explode('_', $item["value"]);
            $group = $parts[0];

            if(!array_key_exists( $group, $temp )) {
                $temp[$group] = ['label' => __('messages.forms.' . strtolower($group))];
            }

            $temp[$group]['options'][] = $item;
        }

        $result = [];

        foreach ($temp as $item) {
            $result[] = $item;
        }

        return $result;
    }

    public static function getTaxonomies() {
        $query = self::query()
            ->with('fossil_common', function (BelongsTo $q){
                return $q = $q->where('active', true);
            })
            ->with('fossil_kingdom', function (BelongsTo $q){
                return $q = $q->where('active', true);
            })
            ->with('fossil_phylum', function (BelongsTo $q){
                return $q = $q->where('active', true);
            })
            ->with('fossil_class', function (BelongsTo $q){
                return $q = $q->where('active', true);
            })
            ->with('fossil_order', function (BelongsTo $q){
                return $q = $q->where('active', true);
            })
            ->with('fossil_family', function (BelongsTo $q){
                return $q = $q->where('active', true);
            })
            ->with('fossil_genre', function (BelongsTo $q){
                return $q = $q->where('active', true);
            })
            ->with('fossil_subgenre', function (BelongsTo $q){
                return $q = $q->where('active', true);
            })
            ->with('specific_epithet', function (BelongsTo $q){
                return $q = $q->where('active', true);
            })
            ->with('fossil_subspecies', function (BelongsTo $q){
                return $q = $q->where('active', true);
            })
            ->where(['active' => true])
            ->select(
                'description as label',
                'id as value',
                'fossil_common_id',
                'fossil_kingdom_id',
                'fossil_phylum_id',
                'fossil_class_id',
                'fossil_order_id',
                'fossil_family_id',
                'fossil_genre_id',
                'fossil_subgenre_id',
                'specific_epithet_id',
                'fossil_subspecies_id')
            ->orderBy('description')
            ->get();

            return $query;
    }
}
