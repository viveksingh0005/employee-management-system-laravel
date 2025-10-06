<!DOCTYPE html>
<html>
<head>
    <title>Add Department</title>
</head>
<body>

<h2>Add Department</h2>

@if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('departments.store') }}" method="POST">
    @csrf
    <label>Department Name:</label>
    <input type="text" name="name" placeholder="Department Name" required>
    <button type="submit">Save</button>
</form>

<br>
<a href="{{ route('departments.index') }}">Back to Departments List</a>

</body>
</html>
