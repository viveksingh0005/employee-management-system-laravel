<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\EmployeeDocument;

class Employee extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'name',
        'dob',
        'email',
        'department',
        'photo',
        'aadhaar_card',
        'pan_card',
        'account_number',
        'role',
        'user_id',
    ];

    // Cast dob to date object
    protected $dates = ['dob'];

    /**
     * Relationship: Employee belongs to a User (optional)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Employee has many documents
     */
    public function documents()
    {
        return $this->hasMany(EmployeeDocument::class);
    }

    /**
     * Accessor for photo URL
     */
    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/'.$this->photo) : null;
    }

    /**
     * Accessor for Aadhaar URL
     */
    public function getAadhaarUrlAttribute()
    {
        return $this->aadhaar_card ? asset('storage/'.$this->aadhaar_card) : null;
    }

    /**
     * Accessor for PAN URL
     */
    public function getPanUrlAttribute()
    {
        return $this->pan_card ? asset('storage/'.$this->pan_card) : null;
    }
}
