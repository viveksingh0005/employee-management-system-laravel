<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Department</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('departments.update', $department->id) }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 font-semibold">Department Name</label>
                <input type="text" name="name" value="{{ $department->name }}" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
                    Update Department
                </button>
                <a href="{{ route('departments.index') }}" class="text-blue-600 hover:underline">Back to Departments List</a>
            </div>
        </form>
    </div>
</x-app-layout>
