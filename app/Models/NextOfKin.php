<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NextOfKin extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'email', 'phone', 'address', 'relationship'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
