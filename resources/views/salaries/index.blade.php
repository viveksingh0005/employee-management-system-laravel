<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">All Salaries</h2>
            <a href="{{ route('salaries.create') }}"
               class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
               + Add Salary
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- 🔍 Search by employee name --}}
        <form method="GET" action="{{ route('salaries.index') }}" class="mb-4 flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Search by employee name"
                   class="border border-gray-300 rounded-md px-3 py-2 w-1/3 focus:outline-none focus:ring focus:ring-blue-200">
            <button type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                Search
            </button>
            @if(request('search'))
                <a href="{{ route('salaries.index') }}" class="text-gray-600 hover:underline ml-2">Clear</a>
            @endif
        </form>

        {{-- 📋 Salaries Table --}}
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
           <table class="min-w-full border border-gray-200">
    <thead class="bg-gray-100 text-gray-700">
        <tr>
            <th class="px-4 py-2 border">Employee</th>
            <th class="px-4 py-2 border">Base Salary</th>
            <th class="px-4 py-2 border">Extra Duty Salary</th>
            <th class="px-4 py-2 border">Deductions</th>
            <th class="px-4 py-2 border">Leaves</th>
            <th class="px-4 py-2 border">Net Salary</th>
            <th class="px-4 py-2 border">Payment Date</th>
            <th class="px-4 py-2 border">Status</th>
            <th class="px-4 py-2 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($salaries as $salary)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 border">{{ $salary->employee->name }}</td>
                <td class="px-4 py-2 border">{{ $salary->base_salary }}</td>
                <td class="px-4 py-2 border">{{ $salary->extra_duty_salary }}</td>
                <td class="px-4 py-2 border">{{ $salary->deductions }}</td>
                <td class="px-4 py-2 border">{{ $salary->leaves }}</td>
                <td class="px-4 py-2 border">{{ $salary->net_salary }}</td>
                <td class="px-4 py-2 border">{{ $salary->payment_date ?? 'Pending' }}</td>
                <td class="px-4 py-2 border capitalize">
                    <span class="px-2 py-1 rounded 
                        {{ $salary->status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ $salary->status }}
                    </span>
                </td>
                <td class="px-4 py-2 border space-x-2">
                    <a href="{{ route('salaries.show', $salary->employee_id) }}"
                       class="text-blue-600 hover:text-blue-800">View</a>
                    <a href="{{ route('salaries.edit', $salary->id) }}" 
                       class="text-yellow-600 hover:text-yellow-800">Edit</a>
                    <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Delete salary?')" 
                                class="text-red-600 hover:text-red-800">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center py-4 text-gray-500">No salary records found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $salaries->appends(request()->query())->links() }}
        </div>

    </div>
</x-app-layout>
