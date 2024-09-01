<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'employee_id',
        'employment_status_id',
        'employment_type_id',
        'department_id',
        'designation_id',
        'date_of_employment',
        'date_of_last_promotion'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
    public function employmentStatus()
    {
        return $this->belongsTo(EmploymentStatus::class);
    }
    public function employmentType()
    {
        return $this->belongsTo(EmploymentType::class);
    }
}
