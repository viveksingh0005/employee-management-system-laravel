<!DOCTYPE html>
<html>
<head>
    <title>Add Inventory</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .product-row { margin-bottom: 10px; }
        input, button { padding: 5px; margin-right: 10px; }
        button { cursor: pointer; }
    </style>
</head>
<body>
    <h2>Add Inventory</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inventories.store') }}" method="POST">
        @csrf

        <label>Date of Receiving:</label>
        <input type="date" name="date_of_receiving" required><br><br>

        <h3>Products</h3>
        <div id="product-list">
            <div class="product-row">
                <input type="text" name="product_name[]" placeholder="Product Name" required>
                <input type="number" name="cost[]" placeholder="Cost" step="0.01" required>
                <input type="number" name="quantity[]" placeholder="Quantity" required>
                <button type="button" onclick="removeProduct(this)">Remove</button>
            </div>
        </div>

        <button type="button" onclick="addProduct()">+ Add Another Product</button><br><br>

        <button type="submit">Save Inventory</button>
    </form>

    <script>
        function addProduct() {
            const productList = document.getElementById('product-list');
            const newRow = document.createElement('div');
            newRow.classList.add('product-row');
            newRow.innerHTML = `
                <input type="text" name="product_name[]" placeholder="Product Name" required>
                <input type="number" name="cost[]" placeholder="Cost" step="0.01" required>
                <input type="number" name="quantity[]" placeholder="Quantity" required>
                <button type="button" onclick="removeProduct(this)">Remove</button>
            `;
            productList.appendChild(newRow);
        }

        function removeProduct(button) {
            button.parentElement.remove();
        }
    </script>
</body>
</html>
