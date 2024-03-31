<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\MessageAttachment;
use App\Models\Thread;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'sender_id',
        'thread_id',
        'body',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class);
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function attachments()
    {
        return $this->hasMany(MessageAttachment::class);
    }
}
