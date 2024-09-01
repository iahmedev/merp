<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'phone', 'gender', 'address', 'marital_status', 'state', 'lga', 'date_of_birth', 'nin'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
