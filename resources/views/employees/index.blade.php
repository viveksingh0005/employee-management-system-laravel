<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
</head>
<body>
    <h1>Employees</h1>
    <a href="{{ route('employees.create') }}">Add Employee</a>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Role</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->department }}</td>
                    <td>{{ $employee->role }}</td>
                    <td>
                        @if($employee->photo)
                            <img src="{{ asset('storage/'.$employee->photo) }}" width="60">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('employees.show', $employee->id) }}">View</a> |
                        <a href="{{ route('employees.edit', $employee->id) }}">Edit</a> |
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
