<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentStatus extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function employmentInfo()
    {
        return $this->hasMany(EmploymentInfo::class);
    }
}
