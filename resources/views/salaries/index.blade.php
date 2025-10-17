<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">All Salaries</h2>
    </x-slot>

    <div class="py-6">
        <a href="{{ route('salaries.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md">Add Salary</a>
        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Employee</th>
                        <th class="px-4 py-2 border">Month</th>
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
                    @foreach($salaries as $salary)
                        <tr>
                            <td class="px-4 py-2 border">{{ $salary->employee->name }}</td>
                            <td class="px-4 py-2 border">{{ $salary->month }}</td>
                            <td class="px-4 py-2 border">{{ $salary->base_salary }}</td>
                            <td class="px-4 py-2 border">{{ $salary->extra_duty_salary }}</td>
                            <td class="px-4 py-2 border">{{ $salary->deductions }}</td>
                            <td class="px-4 py-2 border">{{ $salary->leaves }}</td>
                            <td class="px-4 py-2 border">{{ $salary->net_salary }}</td>
                            <td class="px-4 py-2 border">{{ $salary->payment_date ?? 'Pending' }}</td>
                            <td class="px-4 py-2 border capitalize">{{ $salary->status }}</td>
                            <td class="px-4 py-2 border space-x-2">
                                  <a href="{{ route('salaries.my') }}" class="text-blue-600 hover:text-blue-800 mr-2">View</a>

                                <a href="{{ route('salaries.edit', $salary->id) }}" class="text-blue-600">Edit</a>
                                <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600" onclick="return confirm('Delete salary?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
