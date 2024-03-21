<?php

namespace App\Models;

use App\Notifications\CustomResetPasswordNotification;
use App\Notifications\CustomVerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'email_verified_at',
        'password',
        'zip_code',
        'year_birth',
        'role',
        'picture',
        'licence_id',
        'copyright_rule_id',
        'accept_policy',
        'fossil_speciality',
        'fossil_region',
        'send_delete',
        'active'
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
            ->whereNotNull('email')
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
            ->select('id', 'name', 'email', 'username')
            ->get();
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmailNotification);
    }
}
