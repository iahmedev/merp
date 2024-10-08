<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalRequestStatus extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    
    // 'pending', 'approved', 'rejected', 'correction'
}
