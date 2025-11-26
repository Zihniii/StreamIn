<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportIssue extends Model
{
    protected $table = 'reportissue';
    protected $primaryKey = 'reportID';
    public $timestamps = false; 

    protected $fillable = [
        'issueCategory',
        'issueDescription',
        'status',
        'createdAt',
        'updatedAt',
        'attachment',
        'userID',
        'userSubscriptionID',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function subscription()
    {
        return $this->belongsTo(UserSubscription::class, 'userSubscriptionID');
    }
}
