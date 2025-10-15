<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Inventory Batch</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('inventory.update', $batch->id) }}" class="bg-white p-6 rounded shadow-md space-y-4">
            @csrf
            @method('PUT')

            <!-- Site Name -->
            <div>
                <label class="block mb-1 font-semibold">Site Name</label>
                <input type="text" name="site_name" value="{{ $batch->site_name }}" class="w-full border px-3 py-2 rounded" required>
            </div>

            <!-- Date -->
            <div>
                <label class="block mb-1 font-semibold">Date of Receiving</label>
                <input type="date" name="date_received" value="{{ $batch->date_received }}" class="w-full border px-3 py-2 rounded" required>
            </div>

            <!-- Received By -->
            <div>
                <label class="block mb-1 font-semibold">Received By</label>
                <select name="received_by" class="w-full border px-3 py-2 rounded" required>
                    <option value="">Select Employee</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $batch->received_by == $employee->id ? 'selected' : '' }}>
                            {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Products -->
            <div>
                <h3 class="font-semibold mb-2">Products</h3>
                <div id="product-list" class="space-y-2">
                    @foreach($batch->items as $item)
                        <div class="flex space-x-2 items-center">
                            <input type="text" name="product_name[]" value="{{ $item->product_name }}" placeholder="Product Name" class="border px-3 py-2 rounded w-1/3" required>
                            <input type="number" name="cost[]" value="{{ $item->cost }}" step="0.01" placeholder="Cost" class="border px-3 py-2 rounded w-1/6 cost" required oninput="updateTotal()">
                            <input type="number" name="quantity[]" value="{{ $item->quantity }}" placeholder="Quantity" class="border px-3 py-2 rounded w-1/6 quantity" required oninput="updateTotal()">
                            <button type="button" onclick="removeRow(this)" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Remove</button>
                        </div>
                    @endforeach
                </div>

                <button type="button" onclick="addRow()" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    + Add Another Product
                </button>
            </div>

            <!-- Total -->
            <div>
                <label class="block mb-1 font-semibold">Total Amount</label>
                <input type="text" id="totalDisplay" class="w-full border px-3 py-2 rounded bg-gray-100" readonly>
                <input type="hidden" id="total" name="total" value="{{ $batch->total }}">
            </div>

            <!-- Buttons -->
            <div>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Update Batch</button>
                <a href="{{ route('inventory.index') }}" class="ml-4 text-blue-600 hover:underline">Back to Inventory</a>
            </div>
        </form>
    </div>

    <script>
        function addRow() {
            const list = document.getElementById('product-list');
            const div = document.createElement('div');
            div.className = 'flex space-x-2 items-center';
            div.innerHTML = `
                <input type="text" name="product_name[]" placeholder="Product Name" class="border px-3 py-2 rounded w-1/3" required>
                <input type="number" name="cost[]" placeholder="Cost" step="0.01" class="border px-3 py-2 rounded w-1/6 cost" required oninput="updateTotal()">
                <input type="number" name="quantity[]" placeholder="Quantity" class="border px-3 py-2 rounded w-1/6 quantity" required oninput="updateTotal()">
                <button type="button" onclick="removeRow(this)" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Remove</button>
            `;
            list.appendChild(div);
        }

        function removeRow(button) {
            button.parentElement.remove();
            updateTotal();
        }

        function updateTotal() {
            let total = 0;
            const costs = document.querySelectorAll('.cost');
            const quantities = document.querySelectorAll('.quantity');

            for (let i = 0; i < costs.length; i++) {
                const cost = parseFloat(costs[i].value) || 0;
                const qty = parseInt(quantities[i].value) || 0;
                total += cost * qty;
            }

            document.getElementById('totalDisplay').value = total.toFixed(2);
            document.getElementById('total').value = total.toFixed(2);
        }

        // Initialize total on page load
        document.addEventListener("DOMContentLoaded", updateTotal);
    </script>
</x-app-layout>
