<?php

namespace App\Http\Controllers;

use App\Models\InventoryBatch;
use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = InventoryBatch::with('items')->latest()->get();
        return view('inventories.index', compact('inventories'));
    }

    public function create()
    {
        return view('inventories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_of_receiving' => 'required|date',
            'product_name.*' => 'required|string|max:255',
            'cost.*' => 'required|numeric|min:0',
            'quantity.*' => 'required|integer|min:1',
        ]);

        // Create inventory record
        $inventory = InventoryBatch::create([
            'date_of_receiving' => $request->date_of_receiving,
        ]);

        // Loop through all products and save
        foreach ($request->product_name as $index => $name) {
            InventoryItem::create([
                'inventory_id' => $inventory->id,
                'product_name' => $name,
                'cost' => $request->cost[$index],
                'quantity' => $request->quantity[$index],
            ]);
        }

        return redirect()->route('inventories.index')->with('success', 'Inventory added successfully!');
    }

    public function edit($id)
    {
        $inventory = InventoryBatch::with('items')->findOrFail($id);
        return view('inventories.edit', compact('inventory'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date_of_receiving' => 'required|date',
            'product_name.*' => 'required|string|max:255',
            'cost.*' => 'required|numeric|min:0',
            'quantity.*' => 'required|integer|min:1',
        ]);

        $inventory = InventoryBatch::findOrFail($id);
        $inventory->update(['date_of_receiving' => $request->date_of_receiving]);

        // Delete old items and reinsert new
        $inventory->items()->delete();

        foreach ($request->product_name as $index => $name) {
            InventoryItem::create([
                'inventory_id' => $inventory->id,
                'product_name' => $name,
                'cost' => $request->cost[$index],
                'quantity' => $request->quantity[$index],
            ]);
        }

        return redirect()->route('inventories.index')->with('success', 'Inventory updated successfully!');
    }

    public function destroy($id)
    {
        $inventory = InventoryBatch::findOrFail($id);
        $inventory->items()->delete();
        $inventory->delete();

        return redirect()->route('inventories.index')->with('success', 'Inventory deleted successfully!');
    }
}
