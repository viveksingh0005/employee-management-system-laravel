<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Salary Details — {{ $employee->name }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto">
        <!-- Employee Information -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h3 class="text-lg font-semibold mb-2">Employee Information</h3>
            <p><strong>Name:</strong> {{ $employee->name }}</p>
            <p><strong>Email:</strong> {{ $employee->email }}</p>
            <p><strong>Department:</strong> {{ $employee->department->name ?? 'N/A' }}</p>
        </div>

        <!-- Monthly Salary Records -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold mb-4">Monthly Salary Records</h3>
            <table class="min-w-full border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2">Month</th>
                        <th class="border px-4 py-2">Base Salary</th>
                        <th class="border px-4 py-2">Extra Duties</th>
                        <th class="border px-4 py-2">Extra Duty Salary</th>
                        <th class="border px-4 py-2">Deductions</th>
                        <th class="border px-4 py-2">Leaves</th>
                        <th class="border px-4 py-2">Leave Deduction</th>
                        <th class="border px-4 py-2">Net Salary</th>
                        <th class="border px-4 py-2">Payment Date</th>
                        <th class="border px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($salaries as $salary)
                        <tr>
                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($salary->month . '-01')->format('F Y') }}</td>
                            <td class="border px-4 py-2">{{ $salary->base_salary }}</td>
                            <td class="border px-4 py-2">{{ $salary->extra_duties }}</td>
                            <td class="border px-4 py-2">{{ $salary->extra_duty_salary }}</td>
                            <td class="border px-4 py-2">{{ $salary->deductions }}</td>
                            <td class="border px-4 py-2">{{ $salary->leaves }}</td>
                            <td class="border px-4 py-2">{{ $salary->leave_deduction }}</td>
                            <td class="border px-4 py-2 font-semibold">{{ $salary->net_salary }}</td>
                            <td class="border px-4 py-2">{{ $salary->payment_date ?? 'Pending' }}</td>
                            <td class="border px-4 py-2 capitalize">{{ $salary->status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-gray-500 py-4">
                                No salary records found for this employee.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <a href="{{ route('salaries.index') }}" 
               class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
               ← Back to All Salaries
            </a>
        </div>
    </div>
</x-app-layout>
