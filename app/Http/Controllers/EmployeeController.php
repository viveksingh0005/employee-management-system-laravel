<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function __construct()
{
    $this->middleware('permission:view employees')->only(['index', 'show']);
    $this->middleware('permission:create employees')->only(['create', 'store']);
    $this->middleware('permission:edit employees')->only(['edit', 'update']);
    $this->middleware('permission:delete employees')->only(['destroy']);
}

    // ✅ List employees
    public function index(Request $request)
{
    $search = $request->input('search');

    $query = Employee::with(['documents', 'department', 'user']);

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhereHas('department', function ($q2) use ($search) {
                  $q2->where('name', 'like', "%{$search}%");
              });
        });
    }

    $employees = $query->orderBy('id', 'desc')->get();

    return view('employees.index', compact('employees', 'search'));
}


    // ✅ Show create form
    public function create()
    {
        $users = User::all();
        $departments = Department::all();
        $roles = Role::pluck('name', 'id');
        return view('employees.create', compact('users', 'departments', 'roles'));
    }

    // ✅ Store new employee
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'email' => 'required|email|unique:employees,email',
            'department_id' => 'required|exists:departments,id',
            'role' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // 🧩 Create new employee
        $employee = new Employee([
            'name' => $request->name,
            'dob' => $request->dob,
            'email' => $request->email,
            'department_id' => $request->department_id,
            'role' => $request->role,
            'account_number' => $request->account_number ?? null,
            'user_id' => $request->user_id ?? null,
        ]);

        // 🧩 Handle file uploads
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

        // 🧩 Step 2: Assign Role to Linked User
        if ($employee->user) {
            $employee->user->syncRoles([$request->role]);
        }

        return redirect()->route('employees.index')->with('success', 'Employee created and role assigned successfully.');
    }

    // ✅ Show single employee
    public function show(Employee $employee)
    {
        $employee->load('documents', 'department', 'user');
        return view('employees.show', compact('employee'));
    }

    // ✅ Edit form
    public function edit(Employee $employee)
    {
        $employee->load('documents', 'department', 'user');
        $roles = Role::pluck('name', 'id');
        $users = User::all();
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'users', 'departments', 'roles'));
    }

    // ✅ Update employee
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'department_id' => 'required|exists:departments,id',
            'role' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $employee->update($request->only([
            'name',
            'dob',
            'email',
            'department_id',
            'account_number',
            'role',
            'user_id'
        ]));

        // 🧩 Update linked user role
        if ($employee->user) {
            $employee->user->syncRoles([$request->role]);
        }

        // 🧩 Update file uploads
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

        // 🧩 Handle additional documents
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

        return redirect()->route('employees.index')->with('success', 'Employee updated and role synced successfully.');
    }

    // ✅ Delete employee
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    // ✅ Upload a single document
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

    // ✅ Delete a document
    public function destroyDocument(Employee $employee, EmployeeDocument $document)
    {
        if (Storage::disk('public')->exists($document->document_file)) {
            Storage::disk('public')->delete($document->document_file);
        }

        $document->delete();

        return back()->with('success', 'Document deleted successfully.');
    }
    public function search(Request $request)
    {
        $query = $request->query('q');
        $employees = Employee::where('name', 'LIKE', "%{$query}%")
                            ->select('id', 'name')
                            ->take(10)
                            ->get();

        return response()->json($employees);
    }
}
