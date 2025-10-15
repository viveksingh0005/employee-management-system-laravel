<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Add Site</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
       

        <form action="{{ route('sites.store') }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
            @csrf

            <div>
                <label class="font-semibold">Site Name</label>
                <input type="text" name="name" class="w-full border p-2 rounded" placeholder="Enter site name" required>
            </div>

            <div>
                <label class="font-semibold">Location</label>
                <input type="text" name="location" class="w-full border p-2 rounded" placeholder="Enter location" required>
            </div>

            <div>
                <label class="font-semibold">Department</label>
                <select name="department_id" class="w-full border p-2 rounded" required>
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Save Site
                </button>
                <a href="{{ route('sites.index') }}" class="text-blue-600 hover:underline">Back to Sites</a>
            </div>
        </form>
    </div>
</x-app-layout>
