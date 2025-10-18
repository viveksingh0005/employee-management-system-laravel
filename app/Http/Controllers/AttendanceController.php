<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AttendanceController extends Controller
{
    // Display attendance table
    public function index(Request $request)
    {
        $year  = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        $start = Carbon::create($year, $month, 1)->startOfMonth();
        $end   = $start->copy()->endOfMonth();
        $dates = collect(CarbonPeriod::create($start, $end));

        $employees = Employee::orderBy('name')->get();

        $raw = Attendance::whereYear('date', $year)
                         ->whereMonth('date', $month)
                         ->get();

        $attendances = [];
        foreach ($raw as $a) {
            $d = Carbon::parse($a->date)->toDateString();
            $morning = $a->morning_shift ? 'full' : 'absent';
            $evening = $a->evening_shift ? 'full' : 'absent';

            // If morning but not evening -> half
            if($a->morning_shift && !$a->evening_shift) $morning = 'half';
            if(!$a->morning_shift && $a->evening_shift) $evening = 'half';

            $attendances[$a->employee_id][$d] = [
                'morning' => $morning,
                'evening' => $evening,
                'id' => $a->id,
            ];
        }

        // Monthly summary
        $summary = [];
        foreach ($employees as $employee) {
            $records = $raw->where('employee_id', $employee->id);
            $full = $records->filter(fn($a) => $a->morning_shift && $a->evening_shift)->count();
            $half = $records->filter(fn($a) => $a->morning_shift xor $a->evening_shift)->count();
            $daysInMonth = $start->daysInMonth;
            $leave = $daysInMonth - ($full + $half * 0.5);

            $summary[$employee->id] = [
                'full' => $full,
                'half' => $half,
                'leave' => round($leave, 1),
            ];
        }

        return view('attendances.index', compact(
            'employees',
            'dates',
            'attendances',
            'month',
            'year',
            'summary'
        ));
    }

    // Store attendance data
    public function store(Request $request)
    {
        $data = $request->input('attendance', []);

        foreach ($data as $employeeId => $days) {
            foreach ($days as $date => $shifts) {
                $morningStatus = $shifts['morning'] ?? 'absent';
                $eveningStatus = $shifts['evening'] ?? 'absent';

                Attendance::updateOrCreate(
                    ['employee_id' => $employeeId, 'date' => $date],
                    [
                        'morning_shift' => in_array($morningStatus, ['half','full']),
                        'evening_shift' => in_array($eveningStatus, ['half','full']),
                    ]
                );
            }
        }

        return redirect()->route('attendances.index', $request->only(['month','year']))
                         ->with('success', 'Attendance saved successfully!');
    }

    // Edit attendance (optional if you want separate edit page)
    public function edit($year, $month)
    {
        $start = Carbon::create($year, $month, 1)->startOfMonth();
        $end   = $start->copy()->endOfMonth();
        $dates = collect(CarbonPeriod::create($start, $end));

        $employees = Employee::orderBy('name')->get();

        $raw = Attendance::whereYear('date', $year)
                         ->whereMonth('date', $month)
                         ->get();

        $attendances = [];
        foreach ($raw as $a) {
            $d = Carbon::parse($a->date)->toDateString();
            $morning = $a->morning_shift ? 'full' : 'absent';
            $evening = $a->evening_shift ? 'full' : 'absent';

            if($a->morning_shift && !$a->evening_shift) $morning = 'half';
            if(!$a->morning_shift && $a->evening_shift) $evening = 'half';

            $attendances[$a->employee_id][$d] = [
                'morning' => $morning,
                'evening' => $evening,
                'id' => $a->id,
            ];
        }

        return view('attendances.edit', compact('employees','dates','attendances','month','year'));
    }

    // Update attendance data
    public function update(Request $request, $year, $month)
    {
        $data = $request->input('attendance', []);

        foreach ($data as $employeeId => $days) {
            foreach ($days as $date => $shifts) {
                $morningStatus = $shifts['morning'] ?? 'absent';
                $eveningStatus = $shifts['evening'] ?? 'absent';

                Attendance::updateOrCreate(
                    ['employee_id' => $employeeId, 'date' => $date],
                    [
                        'morning_shift' => in_array($morningStatus, ['half','full']),
                        'evening_shift' => in_array($eveningStatus, ['half','full']),
                    ]
                );
            }
        }

        return redirect()->route('attendances.index', ['month'=>$month,'year'=>$year])
                         ->with('success', 'Attendance updated successfully!');
    }

    // Delete attendance
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Attendance deleted.');
    }

    // Optional month view
    public function monthView($year, $month)
    {
        $employees = Employee::all();
        $attendances = Attendance::whereYear('date', $year)
                                  ->whereMonth('date', $month)
                                  ->get();

        return view('attendances.month', compact('employees','attendances','month','year'));
    }
}
