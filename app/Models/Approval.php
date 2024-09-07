<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;
    protected $fillable = [
        'approval_request_id',
        'approver_id',
        'approval_action_id',
        'forwarded_to_id'
    ];

    public function approvalRequest()
    {
        return $this->belongsTo(ApprovalRequest::class);
    }

    public function action()
    {
        // 'approved', 'rejected', 'forwarded', 'correction'
        return $this->belongsTo(ApprovalAction::class, 'approval_action_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    public function nextApprover()
    {
        return $this->belongsTo(User::class, 'forwarded_to_id');
    }
}
