<?php
// app/Models/Attendance.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id',
        'date',
        'morning_shift',
        'evening_shift'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
