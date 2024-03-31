<?php

namespace App\Models;

use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Thread;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'licence_id',
        'copyright_rule_id',
        'accept_policy',
        'fossil_speciality',
        'fossil_region',
        'send_delete',
        'active',
        'role',
        'answered_questions'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function copyright_rule() : BelongsTo {
        return $this->belongsTo(CopyrightRule::class);
    }

    public static function getCantMembers() {
        return self::query()
            ->where([
                'active' => true            
            ])
            ->count();
    }

    public static function getActiveUser($id)
    {
        $query = self::query()
            ->where([
                'active' => true,
                'id' => $id
            ]);

        return $query->first();
    }

    public static function getUserAdmin($paginate = false, $onlyAdmin = false) {
        $query = self::query()
                ->where(['active' => true]);

        if($onlyAdmin) {
            $query = $query->where('role' , '=', 'admin');
        } else {
            $query = $query->where('role' , '!=', 'customer');
        }

        if($paginate) {
            return $query->paginate();
        }

        return $query->get();
    }

    public static function getUserCustomer() {
        return self::query()
            ->where('role' , '=', 'customer')
            ->paginate();
    }

    public static function getDropdownCurators() {

        return self::query()
            ->where([
                'role' => 'curator',
                'active' => true,
            ])
            ->select(['users.id as value', 'users.username as label', 'fossil_speciality as speciality', 'fossil_region as region'])
            ->get();
    }

    public static function getByIds($ids) {
        return self::query()
            ->whereIn('id', $ids)
            ->select('id', 'username')
            ->get();
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }

    public function threadsSent()
    {
        return $this->hasMany(Thread::class, 'sender_id');
    }

    public function threadsReceived()
    {
        return $this->hasMany(Thread::class, 'receiver_id');
    }
}
