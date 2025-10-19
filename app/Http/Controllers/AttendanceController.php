<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->month ?? now()->month;
        $year = $request->year ?? now()->year;

        $employees = Employee::orderBy('name')->get();

        $start = Carbon::create($year, $month, 1);
        $end = $start->copy()->endOfMonth();

        $dates = [];
        for($date = $start; $date->lte($end); $date->addDay()){
            $dates[] = $date->copy();
        }

        $attendanceRecords = Attendance::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        $attendances = [];
        foreach ($attendanceRecords as $a) {
            $attendances[$a->employee_id][$a->date->toDateString()] = [
                'morning' => $a->morning_shift,
                'evening' => $a->evening_shift,
            ];
        }

        return view('attendances.index', compact('employees', 'dates', 'attendances', 'month', 'year'));
    }

  public function store(Request $request)
{
    $data = $request->input('attendance', []);

    foreach ($data as $employeeId => $dates) {
        foreach ($dates as $date => $shifts) {
            Attendance::updateOrCreate(
                [
                    'employee_id' => $employeeId,
                    'date' => $date
                ],
                [
                    'morning_shift' => $shifts['morning'] ?? 'none',
                    'evening_shift' => $shifts['evening'] ?? 'none',
                ]
            );
        }
    }

    return redirect()->route('attendances.index', [
        'month' => $request->month ?? now()->month,
        'year' => $request->year ?? now()->year
    ])->with('success', 'Attendance saved successfully!');
}


}
