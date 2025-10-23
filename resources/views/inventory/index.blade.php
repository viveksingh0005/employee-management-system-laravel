<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Inventory Batches</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">All Inventory Batches</h2>
            <a href="{{ route('inventory.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Add New Batch
            </a>
        </div>

        <!-- 🔍 Search Form -->
        <form method="GET" action="{{ route('inventory.index') }}" class="mb-6 bg-white p-4 rounded shadow-sm flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Site Name</label>
                <input type="text" name="site_name" value="{{ request('site_name') }}"
                       placeholder="Search by site name"
                       class="border border-gray-300 rounded px-3 py-2 w-60 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date Received</label>
                <input type="date" name="date_received" value="{{ request('date_received') }}"
                       class="border border-gray-300 rounded px-3 py-2 w-52 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Search
                </button>
                <a href="{{ route('inventory.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                    Reset
                </a>
            </div>
        </form>

        <div class="overflow-x-auto bg-white rounded shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 text-left font-medium text-gray-700">#</th>
                        <th class="py-2 px-4 text-left font-medium text-gray-700">Site Name</th>
                        <th class="py-2 px-4 text-left font-medium text-gray-700">Date Received</th>
                        <th class="py-2 px-4 text-left font-medium text-gray-700">Received By</th>
                        <th class="py-2 px-4 text-left font-medium text-gray-700">Total Cost</th>
                        <th class="py-2 px-4 text-left font-medium text-gray-700">Products</th>
                        <th class="py-2 px-4 text-center font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($batches as $batch)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-2 px-4">{{ $batch->id }}</td>
                            <td class="py-2 px-4 font-semibold text-gray-800">{{ $batch->site_name }}</td>
                            <td class="py-2 px-4">{{ \Carbon\Carbon::parse($batch->date_received)->format('d M Y') }}</td>
                            <td class="py-2 px-4">{{ $batch->employee ? $batch->employee->name : '—' }}</td>
                            <td class="py-2 px-4 font-semibold text-green-700">₹{{ number_format($batch->total, 2) }}</td>
                            <td class="py-2 px-4">
                                @if($batch->items->count())
                                    <ul class="list-disc pl-5 text-gray-700">
                                        @foreach($batch->items as $item)
                                            <li>{{ $item->product_name }} (₹{{ number_format($item->cost, 2) }}) × {{ $item->quantity }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-gray-400 italic">No items</span>
                                @endif
                            </td>

                            <td class="py-2 px-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <!-- 👁️ View Button -->
                                    <a href="{{ route('inventory.show', $batch->id) }}"
                                       class="bg-indigo-500 text-white px-3 py-1 rounded hover:bg-indigo-600 transition">
                                        View
                                    </a>

                                    <a href="{{ route('inventory.edit', $batch->id) }}" 
                                       class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('inventory.destroy', $batch->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition"
                                                onclick="return confirm('Are you sure you want to delete this batch?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">
                                No inventory batches found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
