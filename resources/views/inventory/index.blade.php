<!DOCTYPE html>
<html>
<head>
    <title>Inventory Batches</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        a, button { padding: 5px 10px; margin-right: 5px; text-decoration: none; }
        .success { color: green; }
    </style>
</head>
<body>

<h2>Inventory Batches</h2>

@if(session('success'))
    <p class="success">{{ session('success') }}</p>
@endif

<a href="{{ route('inventory.create') }}">+ Add New Batch</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Site Name</th>
            <th>Date of Receiving</th>
            <th>Products</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($batches as $batch)
        <tr>
            <td>{{ $batch->id }}</td>
            <td>{{ $batch->site_name }}</td>
            <td>{{ $batch->date_received }}</td>
            <td>
                <ul>
                    @foreach($batch->items as $item)
                        <li>{{ $item->product_name }} (₹{{ $item->cost }}) — Qty: {{ $item->quantity }}</li>
                    @endforeach
                </ul>
            </td>
            <td>
                <a href="{{ route('inventory.edit', $batch->id) }}">Edit</a>
                <form action="{{ route('inventory.destroy', $batch->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
