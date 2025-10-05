<!DOCTYPE html>
<html>
<head>
    <title>Add Inventory Batch</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .product-row { margin-bottom: 10px; }
        input, button { padding: 5px; margin-right: 10px; }
    </style>
</head>
<body>

<h2>Add Inventory Batch</h2>

@if ($errors->any())
<div style="color: red;">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('inventory.store') }}">
    @csrf

    <label>Site Name:</label>
    <input type="text" name="site_name" required><br><br>

    <!-- Corrected input name to match DB column -->
    <label>Date of Receiving:</label>
    <input type="date" name="date_received" required><br><br>

    <h3>Products</h3>
    <div id="product-list">
        <div class="product-row">
            <input type="text" name="product_name[]" placeholder="Product Name" required>
            <input type="number" name="cost[]" placeholder="Cost" step="0.01" required>
            <input type="number" name="quantity[]" placeholder="Quantity" required>
            <button type="button" onclick="removeRow(this)">Remove</button>
        </div>
    </div>

    <button type="button" onclick="addRow()">+ Add Another Product</button><br><br>

    <button type="submit">Save Batch</button>
</form>

<script>
function addRow() {
    const list = document.getElementById('product-list');
    const div = document.createElement('div');
    div.className = 'product-row';
    div.innerHTML = `
        <input type="text" name="product_name[]" placeholder="Product Name" required>
        <input type="number" name="cost[]" placeholder="Cost" step="0.01" required>
        <input type="number" name="quantity[]" placeholder="Quantity" required>
        <button type="button" onclick="removeRow(this)">Remove</button>
    `;
    list.appendChild(div);
}

function removeRow(button) {
    button.parentElement.remove();
}
</script>

</body>
</html>
