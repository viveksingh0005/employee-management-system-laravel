<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    // Admin: Show all salaries
    public function index()
    {
        $salaries = Salary::with('employee')->get();
        return view('salaries.index', compact('salaries'));
    }

    // Employee: Show only their salaries
  public function show($employeeId)
{
    // Fetch employee details
    $employee = \App\Models\Employee::findOrFail($employeeId);

    // Fetch all salary records for this employee, ordered by month
    $salaries = \App\Models\Salary::where('employee_id', $employeeId)
        ->orderBy('month', 'desc')
        ->get();

    // Pass data to the view
    return view('salaries.show', compact('employee', 'salaries'));
}


    // Show create salary form (admin only)
    public function create()
    {
        $employees = Employee::all();
        return view('salaries.create', compact('employees'));
    }

    // Store salary
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'base_salary' => 'required|numeric',
            'extra_duties' => 'nullable|integer',
            'extra_duty_salary' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'leaves' => 'nullable|integer',
            'leave_deduction' => 'nullable|numeric',
            'net_salary' => 'required|numeric',
            'month' => 'required|string',
            'payment_date' => 'nullable|date',
            'status' => 'required|in:pending,paid'
        ]);

        Salary::create($request->all());
        return redirect()->route('salaries.index')->with('success','Salary added successfully.');
    }

    // Edit salary
    public function edit(Salary $salary)
    {
        $employees = Employee::all();
        return view('salaries.edit', compact('salary','employees'));
    }

    // Update salary
    public function update(Request $request, Salary $salary)
    {
         $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'base_salary' => 'required|numeric',
            'extra_duties' => 'nullable|integer',
            'extra_duty_salary' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'leaves' => 'nullable|integer',
            'leave_deduction' => 'nullable|numeric',
            'net_salary' => 'required|numeric',
            'month' => 'required|string',
            'payment_date' => 'nullable|date',
            'status' => 'required|in:pending,paid'
        ]);

        $salary->update($request->all());
        return redirect()->route('salaries.index')->with('success','Salary updated successfully.');
    }

    // Delete salary
    public function destroy(Salary $salary)
    {
        $salary->delete();
        return back()->with('success','Salary deleted successfully.');
    }
}
