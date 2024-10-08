<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'number',
        'employee_id',
        'joining_date',
        'department',
        'password',
        'salary_monthly',
        'designation',
        'senior_name',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'joining_date' => 'date',
        'salary_monthly' => 'decimal:2',
    ];

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }
}
