<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\EmployeeDocument;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dob',
        'email',
        'department_id',
        'photo',
        'aadhaar_card',
        'pan_card',
        'account_number',
        'role',
        'user_id',
    ];

    protected $dates = ['dob'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(EmployeeDocument::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/'.$this->photo) : null;
    }

    public function getAadhaarUrlAttribute()
    {
        return $this->aadhaar_card ? asset('storage/'.$this->aadhaar_card) : null;
    }

    public function getPanUrlAttribute()
    {
        return $this->pan_card ? asset('storage/'.$this->pan_card) : null;
    }
}
