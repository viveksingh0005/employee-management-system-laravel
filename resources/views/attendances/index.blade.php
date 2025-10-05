<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Employee Attendance - {{ \Carbon\Carbon::create($year, $month, 1)->format('F Y') }}
        </h2>
    </x-slot>
    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <td class="px-4 py-2">

        </td>



        <div class="py-6 max-w-full mx-auto">
            <form action="{{ route('attendances.store') }}" method="POST">
                @csrf

                <!-- Month Navigation -->
                <div class="mb-4 flex items-center space-x-4">
    <!-- Previous Button -->
    <a href="{{ route('attendances.index', ['month' => $month == 1 ? 12 : $month - 1, 'year' => $month == 1 ? $year - 1 : $year]) }}"
        class="bg-gray-200 px-3 py-1 rounded">← Previous</a>

    <!-- Custom Month & Year Form -->
    <form action="{{ route('attendances.index') }}" method="GET" class="flex items-center space-x-2">
        @php
            $months = [
                1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',
                7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December'
            ];
        @endphp

        <!-- Month Select -->
        <select name="month" class="border px-2 py-1 rounded">
            @foreach($months as $num => $name)
                <option value="{{ $num }}" {{ $month == $num ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>

        <!-- Year Input -->
        <input type="number" name="year" value="{{ $year }}" class="border px-2 py-1 rounded w-20">

        <!-- Go Button -->
        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Go</button>
    </form>

    <!-- Next Button -->
    <a href="{{ route('attendances.index', ['month' => $month == 12 ? 1 : $month + 1, 'year' => $month == 12 ? $year + 1 : $year]) }}"
        class="bg-gray-200 px-3 py-1 rounded">Next →</a>
</div>

                <div class="flex justify-end mb-4">
                    <a href="{{ route('attendances.edit', [$year, $month]) }}"
                        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                        Edit Attendance
                    </a>
                </div>

                <!-- Attendance Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full border text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-2 py-1">Employee</th>
                                @foreach ($dates as $date)
                                    <th class="border px-2 py-1 text-center">
                                        {{ $date->format('d M') }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td class="border px-2 py-1 font-semibold whitespace-nowrap">
                                        {{ $employee->name }}
                                    </td>

                                    @foreach ($dates as $date)
                                        @php
                                            $dstr = $date->toDateString();
                                            $att = $attendances[$employee->id][$dstr] ?? null;
                                        @endphp
                                        <td class="border px-2 py-1 text-center">
                                            <div class="flex flex-col items-center space-y-1">
                                                <!-- Morning -->
                                                <label class="text-xs">M</label>
                                                <input type="checkbox"
                                                    name="attendance[{{ $employee->id }}][{{ $dstr }}][morning]"
                                                    value="1" {{ !empty($att['morning']) ? 'checked' : '' }}>

                                                <!-- Evening -->
                                                <label class="text-xs">E</label>
                                                <input type="checkbox"
                                                    name="attendance[{{ $employee->id }}][{{ $dstr }}][evening]"
                                                    value="1" {{ !empty($att['evening']) ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Save Button -->
                <div class="mt-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                        Save Attendance
                    </button>
                </div>
            </form>
        </div>


</x-app-layout>
