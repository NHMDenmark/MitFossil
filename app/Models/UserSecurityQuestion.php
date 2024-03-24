<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserSecurityQuestion extends Model
{
    use HasFactory;

    protected $table = 'user_security_questions';

    protected $fillable = [
        'user_id',
        'question_number',
        'answer'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
