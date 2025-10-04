<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Add Attendance</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto overflow-x-auto">
        <form action="{{ route('attendances.store') }}" method="POST" class="bg-white p-6 rounded-md shadow-md space-y-4">
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

            <div class="overflow-x-auto">
                <table class="w-max border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border px-2 py-1">Date</th>
                            <th class="border px-2 py-1">Shift 1</th>
                            <th class="border px-2 py-1">Shift 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dates as $date)
                            <tr>
                                <td class="border px-2 py-1">{{ $date }}</td>
                                <td class="border px-2 py-1 text-center">
                                    <input type="checkbox" name="attendance[{{ $date }}][shift1]" value="1">
                                </td>
                                <td class="border px-2 py-1 text-center">
                                    <input type="checkbox" name="attendance[{{ $date }}][shift2]" value="1">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Attendance</button>
        </form>
    </div>
</x-app-layout>
