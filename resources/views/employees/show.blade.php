<!DOCTYPE html>
<html>
<head>
    <title>Employee Details</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        img { margin: 5px 0; border: 1px solid #ccc; padding: 2px; }
        iframe { border: 1px solid #ccc; }
        .doc-container { margin-bottom: 20px; }
        .doc-name { font-weight: bold; margin-bottom: 5px; }
    </style>
</head>
<body>
    <h1>Employee Details</h1>

    <p><b>Name:</b> {{ $employee->name }}</p>
    <p><b>Email:</b> {{ $employee->email }}</p>
    <p><b>DOB:</b> {{ $employee->dob }}</p>
    <p><b>Department:</b> {{ $employee->department }}</p>
    <p><b>Role:</b> {{ $employee->role }}</p>
    <p><b>Account No:</b> {{ $employee->account_number }}</p>

    <p>
        <b>Photo:</b><br>
        @if($employee->photo)
            <img src="{{ asset('storage/'.$employee->photo) }}" width="150">
        @else
            Not uploaded
        @endif
    </p>

    <p>
        <b>Aadhaar Card:</b><br>
        @if($employee->aadhaar_card)
            @php $ext = strtolower(pathinfo($employee->aadhaar_card, PATHINFO_EXTENSION)); @endphp
            @if(in_array($ext, ['jpg','jpeg','png','gif']))
                <img src="{{ asset('storage/'.$employee->aadhaar_card) }}" width="200">
            @elseif($ext == 'pdf')
                <iframe src="{{ asset('storage/'.$employee->aadhaar_card) }}" width="600" height="400"></iframe>
            @else
                <a href="{{ asset('storage/'.$employee->aadhaar_card) }}" target="_blank">View Aadhaar</a>
            @endif
        @else
            Not uploaded
        @endif
    </p>

    <p>
        <b>PAN Card:</b><br>
        @if($employee->pan_card)
            @php $ext = strtolower(pathinfo($employee->pan_card, PATHINFO_EXTENSION)); @endphp
            @if(in_array($ext, ['jpg','jpeg','png','gif']))
                <img src="{{ asset('storage/'.$employee->pan_card) }}" width="200">
            @elseif($ext == 'pdf')
                <iframe src="{{ asset('storage/'.$employee->pan_card) }}" width="600" height="400"></iframe>
            @else
                <a href="{{ asset('storage/'.$employee->pan_card) }}" target="_blank">View PAN</a>
            @endif
        @else
            Not uploaded
        @endif
    </p>

    <h3>Documents</h3>

    <!-- Upload form -->
    <form action="{{ route('employees.documents.store', $employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Upload Document:</label>
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>

    <!-- List and display documents -->
    @if($employee->documents->count() > 0)
        @foreach ($employee->documents as $doc)
            @php
                $ext = strtolower(pathinfo($doc->document_file, PATHINFO_EXTENSION));
            @endphp
            <div class="doc-container">
                <div class="doc-name">{{ $doc->document_name }}</div>

                @if(in_array($ext, ['jpg','jpeg','png','gif']))
                    <img src="{{ asset('storage/'.$doc->document_file) }}" width="200">
                @elseif($ext == 'pdf')
                    <iframe src="{{ asset('storage/'.$doc->document_file) }}" width="600" height="400"></iframe>
                @else
                    <a href="{{ asset('storage/'.$doc->document_file) }}" target="_blank">View Document</a>
                @endif

                <!-- Delete document button -->
                <form action="{{ route('employees.documents.destroy', [$employee->id, $doc->id]) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this document?')">Delete</button>
                </form>
            </div>
        @endforeach
    @else
        <p>No documents uploaded yet.</p>
    @endif

    <br>
    <a href="{{ route('employees.index') }}">Back to Employee List</a>
</body>
</html>
