<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Salary</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <form action="{{ route('salaries.update', $salary->id) }}" method="POST" class="bg-white p-6 rounded-md shadow-md space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="font-semibold">Employee</label>
                <input type="text" value="{{ $salary->employee->name }}" disabled class="w-full border p-2 rounded bg-gray-100">
            </div>

            <div>
                <label class="font-semibold">Month</label>
                <input type="month" name="month" value="{{ $salary->month }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-semibold">Base Salary</label>
                <input type="number" step="0.01" name="base_salary" value="{{ $salary->base_salary }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-semibold">Extra Duty</label>
                <input type="number" name="extra_duties" value="{{ $salary->extra_duties }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-semibold">Extra Duty Salary</label>
                <input type="number" step="0.01" name="extra_duty_salary" value="{{ $salary->extra_duty_salary }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-semibold">Deductions</label>
                <input type="number" step="0.01" name="deductions" value="{{ $salary->deductions }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-semibold">Leaves</label>
                <input type="number" name="leaves" value="{{ $salary->leaves }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-semibold">Leave Deduction</label>
               
