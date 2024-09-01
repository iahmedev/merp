<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalAttachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'approval_request_id',
        'attachment'
    ];
}
