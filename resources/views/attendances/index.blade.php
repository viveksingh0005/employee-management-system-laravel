<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Employee Attendance - {{ \Carbon\Carbon::create($year, $month, 1)->format('F Y') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <div class="mb-4 flex items-center space-x-4">
            <a href="{{ route('attendances.index', ['month' => $month == 1 ? 12 : $month-1, 'year' => $month == 1 ? $year-1 : $year]) }}" class="bg-gray-200 px-3 py-1 rounded">← Previous</a>

            <form action="{{ route('attendances.index') }}" method="GET" class="flex items-center space-x-2">
                @php
                    $months = [
                        1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',
                        7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December'
                    ];
                @endphp
                <select name="month" class="border px-2 py-1 rounded">
                    @foreach($months as $num => $name)
                        <option value="{{ $num }}" {{ $month == $num ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
                <input type="number" name="year" value="{{ $year }}" class="border px-2 py-1 rounded w-20">
                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Go</button>
            </form>

            <a href="{{ route('attendances.index', ['month' => $month == 12 ? 1 : $month+1, 'year' => $month == 12 ? $year+1 : $year]) }}" class="bg-gray-200 px-3 py-1 rounded">Next →</a>
        </div>

        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf

            <div class="overflow-x-auto">
                <table class="min-w-full border text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-2 py-1">Employee</th>
                            <th class="border px-2 py-1 text-center">Full Days</th>
                            <th class="border px-2 py-1 text-center">Half Days</th>
                            <th class="border px-2 py-1 text-center">Leaves</th>
                            @foreach($dates as $date)
                                <th class="border px-2 py-1 text-center">{{ $date->format('d M') }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td class="border px-2 py-1 font-semibold whitespace-nowrap">{{ $employee->name }}</td>
                                <td class="border px-2 py-1 text-center monthly-full">0</td>
                                <td class="border px-2 py-1 text-center monthly-half">0</td>
                                <td class="border px-2 py-1 text-center monthly-leave">0</td>

                                @foreach($dates as $date)
                                    @php
                                        $dstr = $date->toDateString();
                                        $att = $attendances[$employee->id][$dstr] ?? ['morning'=>'none','evening'=>'none'];
                                    @endphp
                                    <td class="border px-2 py-1 text-center">
                                        <div class="flex flex-col items-center space-y-1">
                                            <label class="text-xs">M</label>
                                            <input type="checkbox"
                                                   class="shift-toggle px-2 py-2 rounded"
                                                   data-name="attendance[{{ $employee->id }}][{{ $dstr }}][morning]"
                                                   data-state="{{ $att['morning'] }}"
                                                   style="background-color: {{ $att['morning'] === 'full' ? 'green' : ($att['morning'] === 'half' ? 'yellow' : 'transparent') }}"
                                                   {{ $att['morning'] !== 'none' ? 'checked' : '' }}>
                                            <label class="text-xs">E</label>
                                            <input type="checkbox"
                                                   class="shift-toggle px-2 py-2 rounded"
                                                   data-name="attendance[{{ $employee->id }}][{{ $dstr }}][evening]"
                                                   data-state="{{ $att['evening'] }}"
                                                   style="background-color: {{ $att['evening'] === 'full' ? 'green' : ($att['evening'] === 'half' ? 'yellow' : 'transparent') }}"
                                                   {{ $att['evening'] !== 'none' ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="attendance-hidden-inputs"></div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Attendance</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const hiddenContainer = document.getElementById('attendance-hidden-inputs');

            function updateMonthlyCounts(row) {
                let full = 0, half = 0, leave = 0;
                row.querySelectorAll('.shift-toggle').forEach(box => {
                    const state = box.getAttribute('data-state');
                    if (state === 'full') full++;
                    else if (state === 'half') half++;
                    else leave++;
                });
                row.querySelector('.monthly-full').innerText = full;
                row.querySelector('.monthly-half').innerText = half;
                row.querySelector('.monthly-leave').innerText = leave;
            }

            // Initialize hidden inputs for all shifts on page load
            document.querySelectorAll('.shift-toggle').forEach(box => {
                const name = box.getAttribute('data-name');
                const state = box.getAttribute('data-state');
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = state;
                hiddenContainer.appendChild(input);
            });

            document.querySelectorAll('tr').forEach(row => {
                const boxes = row.querySelectorAll('.shift-toggle');
                if (boxes.length === 0) return;

                boxes.forEach(box => {
                    box.addEventListener('click', (e) => {
                        e.preventDefault();
                        let state = box.getAttribute('data-state');

                        // Toggle none → full → half → none
                        if (state === 'none') state = 'full';
                        else if (state === 'full') state = 'half';
                        else state = 'none';

                        box.setAttribute('data-state', state);

                        box.style.backgroundColor = state === 'full' ? 'green' : (state === 'half' ? 'yellow' : 'transparent');
                        box.checked = state !== 'none';

                        const name = box.getAttribute('data-name');
                        let input = hiddenContainer.querySelector(`[name="${name}"]`);
                        if (!input) {
                            input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = name;
                            hiddenContainer.appendChild(input);
                        }
                        input.value = state;

                        updateMonthlyCounts(row);
                    });
                });

                updateMonthlyCounts(row);
            });
        });
    </script>
</x-app-layout>