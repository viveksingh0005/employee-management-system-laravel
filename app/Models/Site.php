<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    // Allow mass assignment for department_id
    protected $fillable = ['name', 'location', 'department_id'];

    // Define relationship to Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
