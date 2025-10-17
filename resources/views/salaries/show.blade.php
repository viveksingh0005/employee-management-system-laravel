<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            My Salary Details
        </h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">#</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Month</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Basic Salary</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Allowances</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Deductions</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Net Pay</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Payment Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($salaries as $index => $salary)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4 text-gray-700">{{ $index + 1 }}</td>
                            <td class="py-3 px-4 text-gray-700">{{ $salary->month }}</td>
                            <td class="py-3 px-4 text-gray-700">₹{{ number_format($salary->basic, 2) }}</td>
                            <td class="py-3 px-4 text-gray-700">₹{{ number_format($salary->allowances, 2) }}</td>
                            <td class="py-3 px-4 text-gray-700 text-red-600">₹{{ number_format($salary->deductions, 2) }}</td>
                            <td class="py-3 px-4 font-semibold text-green-700">₹{{ number_format($salary->net_pay, 2) }}</td>
                            <td class="py-3 px-4 text-gray-700">{{ \Carbon\Carbon::parse($salary->payment_date)->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-4 text-center text-gray-500">
                                No salary records found yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
