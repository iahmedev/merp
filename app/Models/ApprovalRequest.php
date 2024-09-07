<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'approval_request_status_id',
        'current_approver_id',
        'created_by_id',
        'final_approval'
    ];

    public function status()
    {
        // 'pending', 'approved', 'rejected', 'correction'
        return $this->belongsTo(ApprovalRequestStatus::class, 'approval_request_status_id');
    }

    public function attachments()
    {
        return $this->hasMany(ApprovalAttachment::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function currentApprover()
    {
        return $this->belongsTo(User::class, 'current_approver_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
