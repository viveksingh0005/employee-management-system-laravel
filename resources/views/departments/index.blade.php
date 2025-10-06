<!DOCTYPE html>
<html>
<head>
    <title>Departments List</title>
    <style>
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 8px; }
        th { background-color: #f2f2f2; }
        a, button { margin-right: 5px; }
    </style>
</head>
<body>

<h2>Departments</h2>
<a href="{{ route('departments.create') }}">Add Department</a>
<br><br>

@if(session('success'))
    <div style="color:green">{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($departments as $dept)
            <tr>
                <td>{{ $dept->id }}</td>
                <td>{{ $dept->name }}</td>
                <td>
                    <a href="{{ route('departments.edit', $dept->id) }}">Edit</a>
                    <form action="{{ route('departments.destroy', $dept->id) }}" method="POST" style="display:inline">
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
