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
            <a href="{{ route('inventory.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Add New Batch
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 text-left font-medium text-gray-700">ID</th>
                        <th class="py-2 px-4 text-left font-medium text-gray-700">Site Name</th>
                        <th class="py-2 px-4 text-left font-medium text-gray-700">Date Received</th>
                        <th class="py-2 px-4 text-left font-medium text-gray-700">Received By</th>
                        <th class="py-2 px-4 text-left font-medium text-gray-700">Total Cost</th>
                        <th class="py-2 px-4 text-left font-medium text-gray-700">Products</th>
                        <th class="py-2 px-4 text-left font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($batches as $batch)
                        <tr>
                            <td class="py-2 px-4">{{ $batch->id }}</td>
                            <td class="py-2 px-4">{{ $batch->site_name }}</td>
                            <td class="py-2 px-4">{{ $batch->date_received }}</td>
                            <td class="py-2 px-4">
                                {{ $batch->employee ? $batch->employee->name : '—' }}
                            </td>
                            <td class="py-2 px-4 font-semibold text-green-700">
    ₹{{ number_format($batch->total, 2) }}
</td>
                            <td class="py-2 px-4">
                                <ul class="list-disc pl-5">
                                    @foreach($batch->items as $item)
                                        <li>{{ $item->product_name }} (₹{{ $item->cost }}) — Qty: {{ $item->quantity }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="py-2 px-4 space-x-2">
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
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No inventory batches found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
