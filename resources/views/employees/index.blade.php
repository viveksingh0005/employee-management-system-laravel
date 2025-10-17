<x-app-layout>
    <x-slot name="header">
        <div class="flex  items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                Employees
            </h2>
            <a href="{{ route('employees.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md shadow-md transition-all text-sm">
                + Add Employee
            </a>
        </div>
    </x-slot>

    <div class="mt-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('employees.index') }}" method="GET" class="mb-4 flex items-center gap-2">
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search by name, email, or department"
        class="border border-gray-300 rounded-md p-2 w-64 focus:outline-none focus:ring-2 focus:ring-indigo-500"
    >
    <button
        type="submit"
        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-all"
    >
        Search
    </button>
    @if(request('search'))
        <a href="{{ route('employees.index') }}" class="text-gray-500 underline">Clear</a>
    @endif
</form>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($employees as $employee)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $employee->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $employee->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $employee->email }}</td>
                            <!-- Updated department display -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $employee->department ? $employee->department->name : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $employee->role }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($employee->photo)
                                    <img src="{{ asset('storage/'.$employee->photo) }}" class="w-16 h-16 object-cover rounded">
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('employees.show', $employee->id) }}"
                                    class="text-blue-600 hover:text-blue-800 mr-2">View</a>
                                <a href="{{ route('employees.edit', $employee->id) }}"
                                    class="text-yellow-600 hover:text-yellow-800 mr-2">Edit</a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure?')"
                                        class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if($employees->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">No employees found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
