<?php

namespace App\Models;

use App\Core\Functions;
use App\Notifications\CustomResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Fossil extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'country_id',
        'county_id',
        'city',
        'municipality',
        'locality_name',
        'latitude',
        'longitude',
        'hide_location',
        'eon_id',
        'era_id',
        'period_id',
        'epoch_id',
        'age_id',
        'group',
        'formation',
        'member',
        'geochronology_id',
        'length',
        'width',
        'height',
        'identifier',
        'collector',
        'date_find',
        'notes',
        'personal_id',
        'user_id',
        'send_delete',
        'send_report',
        'vote_scientific',
        'vote_danekrae',
        'validated_fossil',
        'vote_curator',
        'fossil_identify_id',
        'active',
        'vote_scientific_id',
        'vote_scientific_date',
        'copyright_rule_id'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo( User::class );
    }

    public function images() : HasMany
    {
        return $this->hasMany( Image::class );
    }

    public function country() : BelongsTo
    {
        return $this->belongsTo( Country::class );
    }

    public function county() : BelongsTo
    {
        return $this->belongsTo( County::class );
    }

    public function eon() : BelongsTo
    {
        return $this->belongsTo( Eon::class );
    }

    public function era() : BelongsTo
    {
        return $this->belongsTo( Era::class );
    }

    public function period() : BelongsTo
    {
        return $this->belongsTo( Period::class );
    }

    public function epoch() : BelongsTo
    {
        return $this->belongsTo( Epoch::class );
    }

    public function age() : BelongsTo
    {
        return $this->belongsTo( Age::class );
    }

    public function fossil_identify() : BelongsTo
    {
        return $this->belongsTo( FossilIdentify::class );
    }

    public function fossil_identifies() : HasMany
    {
        return $this->hasMany( FossilIdentify::class );
    }

    public function fossil_comments() : HasMany
    {
        return $this->hasMany( FossilComment::class );
    }

    public function vote_scientific_user() : BelongsTo
    {
        return $this->belongsTo( User::class, 'vote_scientific_id' );
    }

    public function copyright_rule() : BelongsTo {
        return $this->belongsTo(CopyrightRule::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getVoteScientificDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public static function getCollection($user_id, $cant = 0, $filter = null) {
        $query = self::query()
            ->with('user', function (BelongsTo $q){
                return $q
                    ->select('id', 'copyright_rule_id', 'username');
            })
            ->with('images')
            ->with('country')
            ->with('county')
            ->with('fossil_identify')
            ->with('copyright_rule')
            ->with('fossil_identifies', function (HasMany $q){
                return $q
                    ->with('user', function (BelongsTo $q2){
                        return $q2->select('id', 'username');
                    })->with('vote_curator_user', function (BelongsTo $q2){
                    return $q2->select('id', 'username');
                });
            })
            ->with('fossil_comments', function (HasMany $q) {
                return $q->with('user', function (BelongsTo $q2){
                    return $q2->select('id', 'username');
                })->orderByDesc('created_at');
            })
            ->with('vote_scientific_user', function (BelongsTo $q){
                return $q->select('id', 'username');
            })
            ->with('eon')
            ->with('era')
            ->with('period')
            ->with('epoch')
            ->with('age')
            ->orderBy('created_at', 'desc');

        if($filter === 'my-collection') {
            $query = $query->where(['user_id' => $user_id]);
        } else {
            $query = $query->where(['active' => true]);
        }

        if($cant != 0) {
            $query = $query->limit($cant);
        }

        if($filter === 'uploads') {
            $query->where(function ($q1) {
                return $q1
                    ->where(['active' => true])
                    ->where(function ($q1b) {
                        return $q1b
                            ->where(['vote_curator' => 1])
                            ->orwhere(['validated_fossil' => 1])
                            ->orwhere(['vote_scientific' => 1])
                            ->orwhere(['vote_danekrae' => 1]);
                    });
            });
        }

        if($filter === 'identify') {
            $query = $query->where(function ($q2) {
                return $q2
                    ->where(['vote_curator' => 0])
                    ->where(['vote_danekrae' => 0])
                    ->where(['validated_fossil' => 0]);
            });
        }

        return $query->get();
    }

    public static function getFossils(Array $options) {
        $order = 'desc';
        $taxonomy = null;

        $query = self::query()
            ->with('user', function (BelongsTo $q) use ($options){
                return $q
                    ->select('id', 'copyright_rule_id', 'username');
            })
            ->with('images')
            ->with('country')
            ->with('county')
            ->with('copyright_rule')
            ->with('fossil_identifies', function (HasMany $q) {
                return $q->with('user', function (BelongsTo $q2){
                    return $q2->select('id', 'username');
                })->with('vote_curator_user', function (BelongsTo $q2){
                    return $q2->select('id', 'username');
                });
            })
            ->with('fossil_comments', function (HasMany $q) {
                return $q->with('user', function (BelongsTo $q2){
                    return $q2->select('id', 'username');
                })->orderByDesc('created_at');;
            })
            ->with('vote_scientific_user', function (BelongsTo $q){
                return $q->select('id', 'copyright_rule_id', 'username');
            })
            ->with('fossil_identify')
            ->with('eon')
            ->with('era')
            ->with('period')
            ->with('epoch')
            ->with('age');

        if(Functions::arrayHasValue('search', $options)) {
            $query = $query->where(function ($sq) use ($options, $taxonomy) {
                $sq->where('id', 'like', '%'. $options["search"] . '%')
                ->orWhere('notes', 'like', '%'. $options["search"] . '%')
                ->orWhere('author', 'like', '%'. $options["search"] . '%')
                ->orWhere('country_id', 'like', '%'. $options["search"] . '%')
                ->orWhere('county_id', 'like', '%'. $options["search"] . '%')
                ->orWhere('city', 'like', '%'. $options["search"] . '%')
                ->orWhere('locality_name', 'like', '%'. $options["search"] . '%')
                ->orWhere('group', 'like', '%'. $options["search"] . '%')
                ->orWhere('formation', 'like', '%'. $options["search"] . '%')
                ->orWhere('member', 'like', '%'. $options["search"] . '%')
                ->orWhereHas('fossil_identify', function ($q) use ($options, $taxonomy) {
                    if($taxonomy !== null) {
                        $q->where($taxonomy['field'], '=', $taxonomy['value']);
                    } else {
                        $q->where('fossil_kingdom', 'like', '%' . $options["search"] . '%')
                            ->orWhere('fossil_common', 'like', '%' . $options["search"] . '%')
                            ->orWhere('fossil_phylum', 'like', '%' . $options["search"] . '%')
                            ->orWhere('fossil_class', 'like', '%' . $options["search"] . '%')
                            ->orWhere('fossil_order', 'like', '%' . $options["search"] . '%')
                            ->orWhere('fossil_family', 'like', '%' . $options["search"] . '%')
                            ->orWhere('fossil_genre', 'like', '%' . $options["search"] . '%')
                            ->orWhere('fossil_subgenre', 'like', '%' . $options["search"] . '%')
                            ->orWhere('specific_epithet', 'like', '%' . $options["search"] . '%')
                            ->orWhere('fossil_subspecies', 'like', '%' . $options["search"] . '%');
                    }
                    return $q;
                })
                ->orWhereHas('username', function ($q) use ($options){
                    return $q->where('username', 'like', '%'. $options["search"] . '%');
                })
                ->orWhereHas('country', function ($q) use ($options){
                    return $q->where('description', 'like', '%'. $options["search"] . '%');
                })
                ->orWhereHas('county', function ($q) use ($options){
                    return $q->where('description', 'like', '%'. $options["search"] . '%');
                })
                ->orWhereHas('eon', function ($q) use ($options){
                    return $q->where('description', 'like', '%'. $options["search"] . '%');
                })
                ->orWhereHas('era', function ($q) use ($options){
                    return $q->where('description', 'like', '%'. $options["search"] . '%');
                })
                ->orWhereHas('period', function ($q) use ($options){
                    return $q->where('description', 'like', '%'. $options["search"] . '%');
                })
                ->orWhereHas('epoch', function ($q) use ($options){
                    return $q->where('description', 'like', '%'. $options["search"] . '%');
                })
                ->orWhereHas('age', function ($q) use ($options){
                    return $q->where('description', 'like', '%'. $options["search"] . '%');
                });
            });
        }

        if(Functions::arrayHasValue('filter', $options)) {
            $filter = $options['filter'];

            if(array_key_exists('newest', $filter)){
                $order = $filter['newest'] === 'newest' ? 'desc' : 'asc';
            }

            if(Functions::arrayHasValue('age', $filter)) {
                list($key, $value) = explode('_', $filter['age']);

                if ($key && $value)
                {
                    $tables = [
                        'eon' => 'eon_id',
                        'era' => 'era_id',
                        'period' => 'period_id',
                        'epoch' => 'epoch_id',
                        'age' => 'age_id'
                    ];

                    if( array_key_exists($key, $tables) )
                    {
                        $query = $query->where([$tables[ $key ] => $value]);
                    }
                }
            }

            if(Functions::arrayHasValue('date', $filter)) {
                $start = date($filter['date']['start']);
                $end = date($filter['date']['end']);

                $query = $query->whereBetween('fossils.created_at', [$start, $end]);
            }

            if(Functions::arrayHasValue('taxonomy', $filter)) {
                list($key, $value) = explode('_', $filter['taxonomy']);

                if ($key && $value)
                {
                    $tables = [
                        'common' => [ 'table' => 'fossil_commons', 'field' => 'fossil_common'],
                        'class' => [ 'table' => 'fossil_classes', 'field' => 'fossil_class'],
                        'kingdom' => [ 'table' => 'fossil_kingdoms', 'field' => 'fossil_kingdom'],
                        'genre' =>  [ 'table' => 'fossil_genres', 'field' => 'fossil_genre'],
                        'subgenre' => [ 'table' => 'fossil_subgenres', 'field' => 'fossil_subgenre'],
                        'order' => [ 'table' => 'fossil_orders', 'field' => 'fossil_order'],
                        'family' => [ 'table' => 'fossil_families', 'field' => 'fossil_family'],
                        'phylum' => [ 'table' => 'fossil_phylums', 'field' => 'fossil_phylum'],
                        'subspecies' => [ 'table' => 'fossil_subgenres', 'field' => 'fossil_subgenre'],
                        'epithet' => [ 'table' => 'specific_epithets', 'field' => 'specific_epithet'],
                    ];

                    if( array_key_exists($key, $tables) )
                    {
                        $data = DB::table($tables[$key]['table'])
                            ->where(['id' =>  $value])
                            ->first();

                        $taxonomy = [
                            'field' => $tables[$key]['field'],
                            'value' => $data->description
                        ];
                    }
                }

                if($taxonomy !== null) {
                    $query->whereHas('fossil_identify', function ($q) use ($taxonomy) {
                        return $q->where($taxonomy['field'], '=', trim($taxonomy['value']));
                    });
                }
            }
        }

        if(Functions::arrayHasValue('noClassified', $options) && $options['noClassified'] === false ||
            Functions::arrayHasValue('noValidated', $options) && $options['noValidated'] === false) {
            if(Functions::arrayHasValue('noClassified', $options) && $options['noClassified'] === true) {
                $query = $query->whereHas('fossil_identify', function ($q) {
                    $q  ->where(function ($q2) {
                            return  $q2->where('fossil_kingdom', trans('messages.forms.unknown'))
                                ->orWhereNull ('fossil_kingdom');
                        })
                        ->where(function ($q2) {
                            return  $q2->where('fossil_common', trans('messages.forms.unknown'))
                                ->orWhereNull('fossil_common');
                        })
                        ->where(function ($q2) {
                            return  $q2->where('fossil_phylum', trans('messages.forms.unknown'))
                                ->orWhereNull('fossil_phylum');
                        })
                        ->where(function ($q2) {
                            return  $q2->where('fossil_class', trans('messages.forms.unknown'))
                                ->orWhereNull('fossil_class');
                        })
                        ->where(function ($q2) {
                            return  $q2->where('fossil_order', trans('messages.forms.unknown'))
                                ->orWhereNull('fossil_order');
                        })
                        ->where(function ($q2) {
                            return  $q2->where('fossil_family', trans('messages.forms.unknown'))
                                ->orWhereNull('fossil_family');
                        })
                        ->where(function ($q2) {
                            return  $q2->where('fossil_genre', trans('messages.forms.unknown'))
                                ->orWhereNull('fossil_genre');
                        })
                        ->where(function ($q2) {
                            return  $q2->where('fossil_subgenre', trans('messages.forms.unknown'))
                                ->orWhereNull('fossil_subgenre');
                        })
                        ->where(function ($q2) {
                            return  $q2->where('specific_epithet', trans('messages.forms.unknown'))
                                ->orWhereNull('specific_epithet');
                        })
                        ->where(function ($q2) {
                            return  $q2->where('fossil_subspecies', trans('messages.forms.unknown'))
                                ->orWhereNull('fossil_subspecies');
                        });
                });
            }

            if(Functions::arrayHasValue('noValidated', $options) && $options['noValidated'] === true) {
                $query = $query->whereHas('fossil_identify', function ($q) {
                    $q  ->where('fossil_kingdom', '!=', trans('messages.forms.unknown'))
                        ->orWhere('fossil_common', '!=', trans('messages.forms.unknown'))
                        ->orWhere('fossil_phylum', '!=', trans('messages.forms.unknown'))
                        ->orWhere('fossil_class', '!=', trans('messages.forms.unknown'))
                        ->orWhere('fossil_order', '!=', trans('messages.forms.unknown'))
                        ->orWhere('fossil_family', '!=', trans('messages.forms.unknown'))
                        ->orWhere('fossil_genre', '!=', trans('messages.forms.unknown'))
                        ->orWhere('fossil_subgenre', '!=', trans('messages.forms.unknown'))
                        ->orWhere('specific_epithet', '!=', trans('messages.forms.unknown'))
                        ->orWhere('fossil_subspecies', '!=', trans('messages.forms.unknown'));
                });
            }
        }

        $query = $query->orderBy('fossils.created_at', $order);

        if(Functions::arrayHasValue('origin', $options)) {
            $query = match ($options['origin']) {
                'my-collection' => $query->where(function ($q2) use ($options) {
                    return $q2->where(['user_id' => $options['user_id']]);
                }),
                'identify' => $query->where(function ($q2) {
                    return $q2
                        ->where(['vote_curator' => 0])
                        ->where(['vote_danekrae' => 0])
                        ->where(['validated_fossil' => 0])
                        ->where(['vote_scientific' => 0])
                        ->where(['active' => true]);
                }),
                'experts' => $query->where(function ($sq) {
                    return $sq
                        ->where(['vote_scientific' => 0])
                        ->where(['vote_danekrae' => 0])
                        ->where(['active' => true])
                        ->where(function ($sq4) {
                            return $sq4
                                ->where(['vote_curator' => 1])
                                ->orwhere(['validated_fossil' => 1]);
                        });
                }),
                'curated' => $query->where(function ($sq3) {
                    return $sq3
                        ->where(['vote_scientific' => 1])
                        ->where(['vote_danekrae' => 0])
                        ->where(['active' => true]);
                }),
                'fossil-experts' => $query->where(function ($sq3) {
                    return $sq3
                        ->where(['vote_danekrae' => 1])
                        ->where(['active' => true]);
                }),
                'map' => $query->where(function ($sq) use($options) {
                    if(!Functions::arrayHasValue('user_id', $options)) {
                        $sq = $sq->where('active', true);
                    } else {
                        $userId = $options['user_id'];
                        $sq = $sq->where(function ($sq2) use ($userId, $options) {
                            return $sq2
                                ->where('user_id', '==', $userId)
                                ->orWhere(function($sq3) use ($userId, $options) {
                                    $sq3 = $sq3->where('user_id', '!=', 0); //$sq3 = $sq3->where('user_id', '!=', $userId);

                                    if($options['role'] !== 'admin' && $options['role'] !== 'curator') {
                                        $sq3 = $sq3->where('active', true);
                                    }

                                    return $sq3;
                                });
                        });
                    }

                    return $sq;
                })
            };
        }

        if(Functions::arrayHasValue('map', $options)) {
            $map = $options['map'];

            $query = $query->whereBetween('latitude', [$map['minLat'], $map['maxLat']]);
            $query = $query->whereBetween('longitude', [$map['minLng'], $map['maxLng']]);
            $query = $query->limit(100);

            return $query->get();
        }

        return $query->paginate(20);
    }

    public static function getFossil($id) {
        $query = self::query()
            ->with('user', function (BelongsTo $q){
                return $q->select('id', 'username');
            })->with('vote_scientific_user', function (BelongsTo $q){
                return $q->select('id', 'username');
            })
            ->with('images')
            ->with('country')
            ->with('county')
            ->with('fossil_identify')
            ->with('copyright_rule')
            ->with('fossil_identifies', function (HasMany $q){
                return $q->with('user', function (BelongsTo $q2){
                    return $q2->select('id', 'username');
                })->with('vote_curator_user', function (BelongsTo $q2){
                    return $q2->select('id', 'username');
                });
            })
            ->with('fossil_comments', function (HasMany $q) {
                return $q->with('user', function (BelongsTo $q2){
                    return $q2->select('id', 'username');
                })->orderByDesc('created_at');;
            })
            ->with('eon')
            ->with('era')
            ->with('period')
            ->with('epoch')
            ->with('age')
            ->where(['id' => $id]);

        return $query->first();
    }

    public static function getCount($user_id = null, $filter = null) {
        $query = self::query()
            ->with('fossil_identify');
        $query = $query->where(['active' => true]);

        if($user_id) {
            $query = $query->where(['user_id' => $user_id]);
        }

        if($filter == 'today') {
            $today = Carbon::now()->toDateString();
            $query = $query->whereBetween('created_at', [ $today . ' 00:00:00', $today . ' 23:59:59' ]);
        }

        if($filter == 'validated') {
            $query = $query->where(function ($q) {
                return $q->where(['validated_fossil' => true])
                         ->orWhereHas('fossil_identify', function ($q2) {
                            return $q2->where('vote_curator', true);
                        });
            });
        }

        if($filter == 'curated') {
            $query = $query->where(['vote_scientific' => true]);
        }

        return $query->count();
    }
}
