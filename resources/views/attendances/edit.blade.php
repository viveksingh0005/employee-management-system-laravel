<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Attendance - {{ \Carbon\Carbon::create($year, $month, 1)->format('F Y') }}
        </h2>
    </x-slot>
  <div class="mb-4">
            <a href="{{ route('attendances.index', ['month' => $month, 'year' => $year]) }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                ← Back
            </a>
        </div>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('attendances.update', [$year, $month]) }}" method="POST">
            @csrf
            @method('PUT')

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
                                            <label class="text-xs">M</label>
                                            <input type="checkbox"
                                                name="attendance[{{ $employee->id }}][{{ $dstr }}][morning]"
                                                value="1" {{ !empty($att['morning']) ? 'checked' : '' }}>

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

            <div class="mt-4">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                    Update Attendance
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
