<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class EmployeeController extends Controller
{
    // ✅ List employees
    public function index()
    {
        $employees = Employee::with('documents')->get();
        return view('employees.index', compact('employees'));
    }

    // ✅ Show create form
    public function create()
    {
        $users = User::all();
    return view('employees.create', compact('users'));
       
    }

    // ✅ Store new employee
      public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'dob' => 'required|date',
        'email' => 'required|email|unique:employees,email',
        'department' => 'required|string|max:255',
        'role' => 'required|string|max:255',
         'user_id' => 'nullable|exists:users,id',
    ]);

    $employee = new Employee([
        'name' => $request->name,
        'dob' => $request->dob,
        'email' => $request->email,
        'department' => $request->department,
        'role' => $request->role,
        'account_number' => $request->account_number ?? null,
         'user_id' => $request->user_id ?? null,
        
    ]);

    // Handle files
    if ($request->hasFile('photo')) {
        $employee->photo = $request->file('photo')->store('employees/photos', 'public');
    }

    if ($request->hasFile('aadhaar_card')) {
        $employee->aadhaar_card = $request->file('aadhaar_card')->store('employees/aadhaar', 'public');
    }

    if ($request->hasFile('pan_card')) {
        $employee->pan_card = $request->file('pan_card')->store('employees/pan', 'public');
    }

    $employee->save();

    return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
}



    // ✅ Show single employee
    public function show(Employee $employee)
    {
        $employee->load('documents');
        return view('employees.show', compact('employee'));
    }

    // ✅ Edit form
    public function edit(Employee $employee)
    {
        $employee->load('documents');
        return view('employees.edit', compact('employee'));
    }

    // ✅ Update employee
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'dob' => 'required|date',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'department' => 'required',
            'role' => 'required',
            'user_id' => $request->user_id ?? $employee->user_id,
        ]);

        $employee->update($request->only([
            'name', 'dob', 'email', 'department', 'account_number', 'role','user_id'
        ]));

        // Update photo if new uploaded
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('employees/photos', 'public');
            $employee->update(['photo' => $photoPath]);
        }

        if ($request->hasFile('aadhaar_card')) {
            $aadhaarPath = $request->file('aadhaar_card')->store('employees/aadhaar', 'public');
            $employee->update(['aadhaar_card' => $aadhaarPath]);
        }

        if ($request->hasFile('pan_card')) {
            $panPath = $request->file('pan_card')->store('employees/pan', 'public');
            $employee->update(['pan_card' => $panPath]);
        }

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $docPath = $file->store('employees/documents', 'public');
                EmployeeDocument::create([
                    'employee_id' => $employee->id,
                    'document_name' => $file->getClientOriginalName(),
                    'document_file' => $docPath,
                ]);
            }
        }

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    // ✅ Delete employee
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }



// Upload a document
public function storeDocument(Request $request, Employee $employee)
{
    $request->validate([
        'file' => 'required|file|max:2048'
    ]);

    $path = $request->file('file')->store('employees/documents', 'public');

    $employee->documents()->create([
        'document_name' => $request->file('file')->getClientOriginalName(),
        'document_file' => $path,
    ]);

    return back()->with('success', 'Document uploaded successfully.');
}

// Delete a document
public function destroyDocument(Employee $employee, EmployeeDocument $document)
{
    // Delete the file from storage
    if (Storage::disk('public')->exists($document->document_file)) {
        Storage::disk('public')->delete($document->document_file);
    }

    // Delete record from database
    $document->delete();

    return back()->with('success', 'Document deleted successfully.');
}

}
