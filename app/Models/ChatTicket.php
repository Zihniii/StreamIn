<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatTicket extends Model
{
    protected $table = 'ChatTicket';
    protected $primaryKey = 'ticketID';
    public $timestamps = false;

    protected $fillable = [
        'issueCategory',
        'issueSubCategory',
        'status',
        'createdAt',
        'userID',
    ];

    /**
     * Relasi: satu tiket dimiliki oleh satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    /**
     * Relasi: satu tiket memiliki banyak pesan (ChatMessage)
     */
    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class, 'ticketID', 'ticketID');
    }
}
