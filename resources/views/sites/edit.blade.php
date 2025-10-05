<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Site</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="container mx-auto max-w-md bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Site</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sites.update', $site->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-semibold">Site Name</label>
            <input type="text" name="name" class="w-full border rounded p-2" value="{{ $site->name }}" required>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Location</label>
            <input type="text" name="location" class="w-full border rounded p-2" value="{{ $site->location }}" required>
        </div>

        <div class="flex justify-between items-center">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
            <a href="{{ route('sites.index') }}" class="text-blue-600 hover:underline">Back</a>
        </div>
    </form>
</div>

</body>
</html>
