<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;

class MessageAttachment extends Model
{
    use HasFactory;

    protected $table = 'message_attachments';

    protected $fillable = [
        'message_id',
        'name',
        'path',
    ];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
