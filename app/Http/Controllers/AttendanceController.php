<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        // choose month/year (allow ?month=10&year=2025)
        $year  = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        // build start/end and a CarbonPeriod of all dates in month
        $start = Carbon::create($year, $month, 1)->startOfMonth();
        $end   = $start->copy()->endOfMonth();
        $period = CarbonPeriod::create($start, $end);
        $dates = collect($period); // collection of Carbon dates

        // employees to show as rows
        $employees = Employee::orderBy('name')->get();

        // load attendances for that month and build an associative array:
        // $attendances[employee_id][yyyy-mm-dd] = ['morning' => true/false, 'evening' => true/false, 'id'=>attendance_id]
        $raw = Attendance::whereYear('date', $year)
                         ->whereMonth('date', $month)
                         ->get();

        $attendances = [];
        foreach ($raw as $a) {
            $d = Carbon::parse($a->date)->toDateString();
            $attendances[$a->employee_id][$d] = [
                'morning' => (bool) $a->morning_shift,
                'evening' => (bool) $a->evening_shift,
                'id' => $a->id,
            ];
        }

        // pass everything to the view
        return view('attendances.index', compact('employees', 'dates', 'attendances', 'month', 'year'));
    }


    public function create()
    {
        $employees = Employee::all();
        return view('attendances.create', compact('employees'));
    }

   public function store(Request $request)
{
    $data = $request->input('attendance', []); // array: employee_id => date => morning/evening

    foreach ($data as $employee_id => $dates) {
        foreach ($dates as $date => $shifts) {
            Attendance::updateOrCreate(
                [
                    'employee_id' => $employee_id,
                    'date' => $date,
                ],
                [
                    'morning_shift' => isset($shifts['morning']),
                    'evening_shift' => isset($shifts['evening']),
                ]
            );
        }
    }

    return redirect()->route('attendances.index')
                     ->with('success', 'Attendance recorded successfully!');
}


public function edit($year, $month)
{
    $start = Carbon::create($year, $month, 1)->startOfMonth();
    $end   = $start->copy()->endOfMonth();
    $period = CarbonPeriod::create($start, $end);
    $dates = collect($period);

    $employees = Employee::orderBy('name')->get();

    $raw = Attendance::whereYear('date', $year)
                     ->whereMonth('date', $month)
                     ->get();

    $attendances = [];
    foreach ($raw as $a) {
        $d = Carbon::parse($a->date)->toDateString();
        $attendances[$a->employee_id][$d] = [
            'morning' => (bool) $a->morning_shift,
            'evening' => (bool) $a->evening_shift,
            'id' => $a->id,
        ];
    }

    return view('attendances.edit', compact('employees', 'dates', 'attendances', 'month', 'year'));
}


public function update(Request $request, $year, $month)
{
    $data = $request->input('attendance', []);

    foreach ($data as $employeeId => $days) {
        foreach ($days as $date => $shifts) {
            $attendance = Attendance::updateOrCreate(
                ['employee_id' => $employeeId, 'date' => $date],
                [
                    'morning_shift' => !empty($shifts['morning']),
                    'evening_shift' => !empty($shifts['evening']),
                ]
            );
        }
    }

    return redirect()->route('attendances.index', ['month' => $month, 'year' => $year])
                     ->with('success', 'Attendance updated successfully!');
}




    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Attendance deleted.');
    }

    // Monthly view
    public function monthView($year, $month)
    {
        $employees = Employee::all();
        $attendances = Attendance::whereYear('date', $year)
                                  ->whereMonth('date', $month)
                                  ->get();

        return view('attendances.month', compact('employees', 'attendances', 'month', 'year'));
    }


}

