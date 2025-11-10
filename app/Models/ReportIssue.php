<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportIssue extends Model
{
    protected $table = 'ReportIssue';
    protected $primaryKey = 'reportID';
    public $timestamps = false;

    protected $fillable = [
        'issueCategory',
        'issueDescription',
        'status',
        'createdAt',
        'updatedAt',
        'attachment',
        'userID'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
}
