<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Message;

class Thread extends Model
{
    use HasFactory;

    public const CATEGORIES = [
        [
            'value' => 'Indsendt fossil',
            'label' => 'Indsendt fossil',
        ],
        [
            'value' => 'Brud på regler eller upassende adfærd',
            'label' => 'Brud på regler eller upassende adfærd',
        ],
        [
            'value' => 'Teknisk hjælp',
            'label' => 'Teknisk hjælp'
        ],
        [
            'value' => 'Andet',
            'label' => 'Andet'
        ]
    ];

    protected $table = 'threads';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'title',
        'status',
        'category'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('created_at', 'desc');
    }
}
