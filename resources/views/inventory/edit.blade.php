<!DOCTYPE html>
<html>
<head>
  <title>Edit Inventory</title>
  <script>
    function addProductRow() {
      const container = document.getElementById('product-container');
      const newRow = document.createElement('div');
      newRow.innerHTML = `
        <hr>
        <label>Product Name:</label>
        <input type="text" name="products[][product_name]" required>

        <label>Cost:</label>
        <input type="number" name="products[][cost]" step="0.01" required>

        <label>Quantity:</label>
        <input type="number" name="products[][quantity]" required>

        <button type="button" onclick="this.parentNode.remove()">Remove</button>
      `;
      container.appendChild(newRow);
    }
  </script>
</head>
<body>
  <h1>Edit Inventory</h1>

  <form method="POST" action="{{ route('inventory.update', $batch->id) }}">
    @csrf
    @method('PUT')

    <label>Site Name:</label>
    <input type="text" name="site_name" value="{{ $batch->site_name }}" required><br><br>

    <label>Date Received:</label>
    <input type="date" name="date_received" value="{{ $batch->date_received }}" required><br><br>

    <h3>Products</h3>
    <div id="product-container">
      @foreach ($batch->items as $item)
      <div>
        <label>Product Name:</label>
        <input type="text" name="products[][product_name]" value="{{ $item->product_name }}" required>

        <label>Cost:</label>
        <input type="number" name="products[][cost]" step="0.01" value="{{ $item->cost }}" required>

        <label>Quantity:</label>
        <input type="number" name="products[][quantity]" value="{{ $item->quantity }}" required>

        <button type="button" onclick="this.parentNode.remove()">Remove</button>
      </div>
      <hr>
      @endforeach
    </div>

    <button type="button" onclick="addProductRow()">+ Add Another Product</button>
    <br><br>

    <button type="submit">Update Inventory</button>
  </form>

  <br>
  <a href="{{ route('inventory.index') }}">Back to List</a>
</body>
</html>
