<!DOCTYPE html>
<html>
<head>
  <title>Inventory Details</title>
</head>
<body>
  <h1>Inventory Details</h1>

  <p><strong>Site Name:</strong> {{ $batch->site_name }}</p>
  <p><strong>Date Received:</strong> {{ $batch->date_received }}</p>

  <h3>Products</h3>
  <table border="1" cellpadding="8" cellspacing="0">
    <thead>
      <tr>
        <th>Product Name</th>
        <th>Cost</th>
        <th>Quantity</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($batch->items as $item)
      <tr>
        <td>{{ $item->product_name }}</td>
        <td>{{ $item->cost }}</td>
        <td>{{ $item->quantity }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <br>
  <a href="{{ route('inventory.index') }}">Back to List</a>
</body>
</html>
