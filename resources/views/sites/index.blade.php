<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sites</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="container mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Sites</h2>
        <a href="{{ route('sites.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Site</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="py-2 px-4 border-b">Site Name</th>
                    <th class="py-2 px-4 border-b">Location</th>
                    <th class="py-2 px-4 border-b">Department</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sites as $site)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $site->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $site->location }}</td>
                        <td class="py-2 px-4 border-b">{{ $site->department ? $site->department->name : 'N/A' }}</td>
                        <td class="py-2 px-4 border-b space-x-2">
                            <a href="{{ route('sites.edit', $site->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Edit</a>

                            <form action="{{ route('sites.destroy', $site->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="return confirm('Are you sure you want to delete this site?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if($sites->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center py-4">No sites found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
