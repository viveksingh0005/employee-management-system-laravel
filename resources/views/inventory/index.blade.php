<!DOCTYPE html>
<html>
<head>
  <title>Inventory List</title>
</head>
<body>
  <h1>Inventory Records</h1>

  <a href="{{ route('inventory.create') }}">+ Add New Inventory</a>

  @if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
  @endif

  <table border="1" cellpadding="8" cellspacing="0">
    <thead>
      <tr>
        <th>ID</th>
        <th>Site Name</th>
        <th>Date Received</th>
        <th>Total Products</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($batches as $batch)
      <tr>
        <td>{{ $batch->id }}</td>
        <td>{{ $batch->site_name }}</td>
        <td>{{ $batch->date_received }}</td>
        <td>{{ $batch->items_count }}</td>
        <td>
          <a href="{{ route('inventory.show', $batch->id) }}">View</a> |
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
