<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Sites</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">All Sites</h2>
            <a href="{{ route('sites.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Add Site
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 text-left font-medium text-gray-700">Site Name</th>
                        <th class="py-2 px-4 text-left font-medium text-gray-700">Location</th>
                        <th class="py-2 px-4 text-left font-medium text-gray-700">Department</th>
                        <th class="py-2 px-4 text-left font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($sites as $site)
                        <tr>
                            <td class="py-2 px-4">{{ $site->name }}</td>
                            <td class="py-2 px-4">{{ $site->location }}</td>
                            <td class="py-2 px-4">{{ $site->department ? $site->department->name : 'N/A' }}</td>
                            <td class="py-2 px-4 space-x-2">
                                <a href="{{ route('sites.edit', $site->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 transition">
                                    Edit
                                </a>

                                <form action="{{ route('sites.destroy', $site->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition"
                                        onclick="return confirm('Are you sure you want to delete this site?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">No sites found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
