<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Attendance for {{ $employee->name }}</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto overflow-x-auto">
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
                            {{ isset($attendance[$date]) && $attendance[$date]->shift1 ? 'Present' : 'Absent' }}
                        </td>
                        <td class="border px-2 py-1 text-center">
                            {{ isset($attendance[$date]) && $attendance[$date]->shift2 ? 'Present' : 'Absent' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
