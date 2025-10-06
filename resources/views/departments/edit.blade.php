<!DOCTYPE html>
<html>
<head>
    <title>Edit Department</title>
</head>
<body>

<h2>Edit Department</h2>

@if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('departments.update', $department->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Department Name:</label>
    <input type="text" name="name" value="{{ $department->name }}" required>
    <button type="submit">Update</button>
</form>

<br>
<a href="{{ route('departments.index') }}">Back to Departments List</a>

</body>
</html>
