
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Add Salary</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <form action="{{ route('salaries.store') }}" method="POST" class="bg-white p-6 rounded-md shadow-md space-y-4">
            @csrf

            <div>
                <label class="font-semibold">Employee</label>
                <select name="employee_id" class="w-full border p-2 rounded">
                    <option value="">-- Select Employee --</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }} ({{ $employee->email }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="font-semibold">Month</label>
                <input type="month" name="month" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-semibold">Base Salary</label>
                <input type="number" step="0.01" name="base_salary" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-semibold">Extra Duty</label>
                <input type="number" name="extra_duties" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-semibold">Extra Duty Salary</label>
                <input type="number" step="0.01" name="extra_duty_salary" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-semibold">Deductions</label>
                <input type="number" step="0.01" name="deductions" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-semibold">Leaves</label>
                <input type="number" name="leaves" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-semibold">Leave Deduction</label>
                <input type="number" step="0.01" name="leave_deduction" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-semibold">Net Salary</label>
                <input type="number" step="0.01" name="net_salary" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-semibold">Payment Date</label>
                <input type="date" name="payment_date" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-semibold">Status</label>
                <select name="status" class="w-full border p-2 rounded">
                    <option value="pending">Pending</option>
                    <option value="paid">Paid</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Salary</button>
        </form>
    </div>
</x-app-layout>
