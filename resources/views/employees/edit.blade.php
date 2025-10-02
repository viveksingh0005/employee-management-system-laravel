<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
</head>
<body>
    <h1>Edit Employee</h1>
    <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label>Name:</label><input type="text" name="name" value="{{ $employee->name }}"><br>
        <label>Email:</label><input type="email" name="email" value="{{ $employee->email }}"><br>
        <label>DOB:</label><input type="date" name="dob" value="{{ $employee->dob }}"><br>
        <label>Department:</label><input type="text" name="department" value="{{ $employee->department }}"><br>
        <label>Role:</label><input type="text" name="role" value="{{ $employee->role }}"><br>
        <label>Account Number:</label><input type="text" name="account_number" value="{{ $employee->account_number }}"><br>
        <label>Aadhaar Card:</label><input type="file" name="aadhaar_card" ><br>
          @if($employee->aadhaar_card)
            <img src="{{ asset('storage/'.$employee->aadhaar_card) }}" width="80">
        @endif
        <label>PAN Card:</label><input type="file" name="pan_card" ><br>
          @if($employee->pan_card)
            <img src="{{ asset('storage/'.$employee->pan_card) }}" width="80">
        @endif
        <label>Photo:</label><input type="file" name="photo"><br>
        @if($employee->photo)
            <img src="{{ asset('storage/'.$employee->photo) }}" width="80">
        @endif
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('employees.index') }}">Back</a>
</body>
</html>
