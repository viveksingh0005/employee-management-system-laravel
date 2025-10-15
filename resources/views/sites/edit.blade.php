<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Site</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('sites.update', $site->id) }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 font-semibold">Site Name</label>
                <input type="text" name="name" class="w-full border px-3 py-2 rounded" value="{{ $site->name }}" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Location</label>
                <input type="text" name="location" class="w-full border px-3 py-2 rounded" value="{{ $site->location }}" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Department</label>
                <select name="department_id" class="w-full border px-3 py-2 rounded" required>
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ $site->department_id == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
                    Update Site
                </button>
                <a href="{{ route('sites.index') }}" class="text-blue-600 hover:underline">Back to Sites</a>
            </div>
        </form>
    </div>
</x-app-layout>
