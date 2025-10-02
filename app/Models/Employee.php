<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'dob', 'email', 'department', 'photo',
        'aadhaar_card', 'pan_card', 'account_number', 'role'
    ];

    public function documents()
    {
        return $this->hasMany(EmployeeDocument::class);
    }
}
