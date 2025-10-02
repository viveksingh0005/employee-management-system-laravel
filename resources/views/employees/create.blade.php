<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
</head>
<body>
    <h1>Add Employee</h1>
    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Name:</label><input type="text" name="name"><br>
        <label>Email:</label><input type="email" name="email"><br>
        <label>DOB:</label><input type="date" name="dob"><br>
        <label>Department:</label><input type="text" name="department"><br>
        <label>Role:</label><input type="text" name="role"><br>
        <label>Account Number:</label><input type="text" name="account_number"><br>
        
        <label>Photo:</label><input type="file" name="photo"><br>
        <label>Aadhar Card:</label><input type="file" name="aadhaar_card"><br>
        <label>Pan Card:</label><input type="file" name="pan_card"><br>
        <button type="submit">Save</button>
    </form>
    <a href="{{ route('employees.index') }}">Back</a>
</body>
</html>
