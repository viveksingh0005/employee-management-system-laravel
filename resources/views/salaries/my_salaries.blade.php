<x-app-layout>
    <x-slot name="header">
        <h2>My Salaries</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="min-w-full bg-white border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">Month</th>
                        <th class="border px-4 py-2">Base Salary</th>
                        <th class="border px-4 py-2">Extra Duties</th>
                        <th class="border px-4 py-2">Extra Duty Salary</th>
                        <th class="border px-4 py-2">Leaves</th>
                        <th class="border px-4 py-2">Leave Deduction</th>
                        <th class="border px-4 py-2">Deductions</th>
                        <th class="border px-4 py-2">Net Salary</th>
                        <th class="border px-4 py-2">Payment Date</th>
                        <th class="border px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($salaries as $salary)
                        <tr>
                            <td class="border px-4 py-2">{{ $salary->month }}</td>
                            <td class="border px-4 py-2">{{ $salary->base_salary }}</td>
                            <td class="border px-4 py-2">{{ $salary->extra_duties }}</td>
                            <td class="border px-4 py-2">{{ $salary->extra_duty_salary }}</td>
                            <td class="border px-4 py-2">{{ $salary->leaves }}</td>
                            <td class="border px-4 py-2">{{ $salary->leave_deduction }}</td>
                            <td class="border px-4 py-2">{{ $salary->deductions }}</td>
                            <td class="border px-4 py-2">{{ $salary->net_salary }}</td>
                            <td class="border px-4 py-2">{{ $salary->payment_date?->format('d-m-Y') ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ ucfirst($salary->status) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="border px-4 py-2 text-center">No salary records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
