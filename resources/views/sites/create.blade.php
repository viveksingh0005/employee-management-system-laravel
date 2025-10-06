<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Site</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="container mx-auto">
    <h2 class="text-2xl font-bold mb-4">Add Site</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sites.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Site Name</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" placeholder="Enter site name" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Location</label>
            <input type="text" name="location" class="w-full border px-3 py-2 rounded" placeholder="Enter location" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Department</label>
            <select name="department_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Site</button>
        <a href="{{ route('sites.index') }}" class="ml-4 text-blue-600 hover:underline">Back to Sites</a>
    </form>
</div>

</body>
</html>
