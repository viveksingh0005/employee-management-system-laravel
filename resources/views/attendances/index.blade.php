<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Employee Attendance - {{ \Carbon\Carbon::create($year, $month, 1)->format('F Y') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf

            <!-- Month Navigation (omitted for brevity, same as before) -->

            <!-- Attendance Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full border text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-2 py-1">Employee</th>
                            <th class="border px-2 py-1 text-center">Full Days</th>
                            <th class="border px-2 py-1 text-center">Half Days</th>
                            <th class="border px-2 py-1 text-center">Leaves</th>
                            @foreach ($dates as $date)
                                <th class="border px-2 py-1 text-center">{{ $date->format('d M') }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td class="border px-2 py-1 font-semibold whitespace-nowrap">{{ $employee->name }}</td>
                                <td class="border px-2 py-1 text-center monthly-full">0</td>
                                <td class="border px-2 py-1 text-center monthly-half">0</td>
                                <td class="border px-2 py-1 text-center monthly-leave">0</td>

                                @foreach ($dates as $date)
                                    @php
                                        $dstr = $date->toDateString();
                                        $att = $attendances[$employee->id][$dstr] ?? null;
                                        $morningState = !empty($att['morning']) ? $att['morning'] : 'absent';
                                        $eveningState = !empty($att['evening']) ? $att['evening'] : 'absent';
                                    @endphp
                                    <td class="border px-2 py-1 text-center">
                                        <div class="flex flex-col items-center space-y-1">
                                            <label class="text-xs">M</label>
                                            <input type="checkbox"
       class="shift-toggle px-2 py-2 rounded"
       data-name="attendance[{{ $employee->id }}][{{ $dstr }}][morning]"
       data-state="{{ $att['morning'] ?? 'absent' }}"
       style="background-color: 
              {{ ($att['morning'] ?? 'absent') === 'full' ? 'green' : 
                 (($att['morning'] ?? 'absent') === 'half' ? 'yellow' : 'transparent') }}">

<input type="checkbox"
       class="shift-toggle px-2 py-2 rounded"
       data-name="attendance[{{ $employee->id }}][{{ $dstr }}][evening]"
       data-state="{{ $att['evening'] ?? 'absent' }}"
       style="background-color: 
              {{ ($att['evening'] ?? 'absent') === 'full' ? 'green' : 
                 (($att['evening'] ?? 'absent') === 'half' ? 'yellow' : 'transparent') }}">

                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Hidden inputs for submission -->
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
                    if(state === 'full') full++;
                    else if(state === 'half') half++;
                    else leave++;
                });

                row.querySelector('.monthly-full').innerText = full ;
                row.querySelector('.monthly-half').innerText = half ;
                row.querySelector('.monthly-leave').innerText = leave ;
            }

            document.querySelectorAll('tr').forEach(row => {
                const boxes = row.querySelectorAll('.shift-toggle');
                if(boxes.length === 0) return;

                boxes.forEach(box => {
                    box.addEventListener('click', (e) => {
                        e.preventDefault();
                        let state = box.getAttribute('data-state');

                        if (state === 'absent') state = 'full';
                        else if (state === 'full') state = 'half';
                        else state = 'absent';

                        box.setAttribute('data-state', state);

                        // Update color
                        box.style.backgroundColor = state === 'full' ? 'green' : (state === 'half' ? 'yellow' : 'transparent');
                        box.checked = (state !== 'absent');

                        // Update hidden input
                        const name = box.getAttribute('data-name');
                        const existing = hiddenContainer.querySelector(`[name="${name}"]`);
                        if(existing) existing.remove();
                        if(state !== 'absent'){
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = name;
                            input.value = state;
                            hiddenContainer.appendChild(input);
                        }

                        updateMonthlyCounts(row);
                    });
                });

                // Initial calculation
                updateMonthlyCounts(row);
            });
        });
    </script>
</x-app-layout>
