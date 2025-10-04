<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Attendance for {{ $employee->name }}</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto overflow-x-auto">
        <form action="{{ route('attendances.update', $employee->id) }}" method="POST" class="bg-white p-6 rounded-md shadow-md space-y-4">
            @csrf
            @method('PUT')

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
                                    <input type="checkbox" name="attendance[{{ $date }}][shift1]" value="1"
                                        {{ isset($attendance[$date]) && $attendance[$date]->shift1 ? 'checked' : '' }}>
                                </td>
                                <td class="border px-2 py-1 text-center">
                                    <input type="checkbox" name="attendance[{{ $date }}][shift2]" value="1"
                                        {{ isset($attendance[$date]) && $attendance[$date]->shift2 ? 'checked' : '' }}>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update Attendance</button>
        </form>
    </div>
</x-app-layout>
