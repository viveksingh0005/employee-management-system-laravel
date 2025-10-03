<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'employee_id',
        'base_salary',
        'extra_duties',
        'extra_duty_salary',
        'deductions',
        'leaves',
        'leave_deduction',
        'net_salary',
        'month',
        'payment_date',
        'payment_status',
    ];

    // Relationship with Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}