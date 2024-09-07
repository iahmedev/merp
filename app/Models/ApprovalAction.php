<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalAction extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    // 'approved', 'rejected', 'forwarded', 'correction'
}
