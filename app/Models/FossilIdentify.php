<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FossilIdentify extends Model
{
    use HasFactory;

    protected $fillable = [
        'fossil_id',
        'fossil_kingdom',
        'fossil_common',
        'fossil_phylum',
        'fossil_class',
        'fossil_order',
        'fossil_family',
        'fossil_genre',
        'fossil_subgenre',
        'specific_epithet',
        'fossil_subspecies',
        'fossil_taxonomy_id',
        'user_id',
        'user_suggest_id',
        'user_curator_id',
        'active',
        'vote_curator',
        'vote_expert',
        'vote_user',
        'vote_users_json',
        'vote_curator_id',
        'vote_expert_id',
        'vote_curator_date'
    ];

    public static function getFossilIdentifies($fossil_id) {
        $query = self::query()
            ->where(['fossil_id' => $fossil_id]);

        return $query->get();
    }

    public function fossils() : BelongsTo
    {
        return $this->belongsTo( Fossil::class );
    }

    public function fossil_taxonomy() : BelongsTo
    {
        return $this->belongsTo( FossilTaxonomy::class );
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo( User::class );
    }

    public function user_suggest() : BelongsTo
    {
        return $this->belongsTo( User::class, 'user_suggest_id');
    }

    public function user_curator() : BelongsTo
    {
        return $this->belongsTo( User::class, 'user_curator_id');
    }

    public function vote_curator_user() : BelongsTo
    {
        return $this->belongsTo( User::class, 'vote_curator_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getVoteCuratorDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
