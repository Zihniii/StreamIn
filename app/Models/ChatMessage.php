<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $table = 'ChatMessage';
    protected $primaryKey = 'messageID';
    public $timestamps = false;

    protected $fillable = [
        'sender',
        'messageText',
        'attachment',
        'sentAt',
        'ticketID',
    ];

    /**
     * Relasi: satu pesan termasuk dalam satu tiket (ChatTicket)
     */
    public function chatTicket()
    {
        return $this->belongsTo(ChatTicket::class, 'ticketID', 'ticketID');
    }
}
