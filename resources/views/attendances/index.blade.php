<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Employee Attendance - {{ \Carbon\Carbon::create($year, $month, 1)->format('F Y') }}
        </h2>
    </x-slot>
    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search -->
        <!-- Search Box -->
<div class="mb-4 w-64 relative">
    <input type="text" 
           id="employee-search" 
           placeholder="Search employee..." 
           class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
           autocomplete="off">

    <!-- Suggestions dropdown -->
    <ul id="suggestions" class="absolute z-10 bg-white border border-gray-300 w-full mt-1 rounded-md hidden max-h-60 overflow-y-auto">
        <!-- Suggestions will appear here -->
    </ul>
</div>

    <div class="py-6 max-w-full mx-auto">
        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf

            <!-- Month Navigation -->
            <div class="mb-4 flex items-center space-x-4">
                <a href="{{ route('attendances.index', ['month' => $month == 1 ? 12 : $month - 1, 'year' => $month == 1 ? $year - 1 : $year]) }}"
                   class="bg-gray-200 px-3 py-1 rounded">← Previous</a>
                <span class="font-semibold">{{ \Carbon\Carbon::create($year, $month, 1)->format('F Y') }}</span>
                <a href="{{ route('attendances.index', ['month' => $month == 12 ? 1 : $month + 1, 'year' => $month == 12 ? $year + 1 : $year]) }}"
                   class="bg-gray-200 px-3 py-1 rounded">Next →</a>
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
                        @foreach($employees as $employee)
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
                                                value="1"
                                                {{ !empty($att['morning']) ? 'checked' : '' }}>

                                            <!-- Evening -->
                                            <label class="text-xs">E</label>
                                            <input type="checkbox"
                                                name="attendance[{{ $employee->id }}][{{ $dstr }}][evening]"
                                                value="1"
                                                {{ !empty($att['evening']) ? 'checked' : '' }}>
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
                <button type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded">
                    Save Attendance
                </button>
            </div>
        </form>
    </div>
 

</x-app-layout>
