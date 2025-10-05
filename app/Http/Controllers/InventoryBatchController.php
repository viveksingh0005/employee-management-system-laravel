<?php

namespace App\Http\Controllers;

use App\Models\InventoryBatch;
use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryBatchController extends Controller
{
    // Display all batches
    public function index()
    {
        $batches = InventoryBatch::with('items')->latest()->get();
        return view('inventory.index', compact('batches'));
    }

    // Show form to create a new batch
    public function create()
    {
        return view('inventory.create');
    }

    // Store new batch
  public function store(Request $request)
{
    $request->validate([
        'site_name' => 'required|string|max:255',
        'date_received' => 'required|date', // validate this field
        'product_name.*' => 'required|string|max:255',
        'cost.*' => 'required|numeric|min:0',
        'quantity.*' => 'required|integer|min:1',
    ]);

    $batch = InventoryBatch::create([
        'site_name' => $request->site_name,
        'date_received' => $request->date_received, // make sure this is included
    ]);

    foreach ($request->product_name as $i => $name) {
        $batch->items()->create([
            'product_name' => $name,
            'cost' => $request->cost[$i],
            'quantity' => $request->quantity[$i],
        ]);
    }

    return redirect()->route('inventory.index')->with('success', 'Inventory batch added successfully!');
}


    // Show form to edit a batch
    public function edit($id)
    {
        $batch = InventoryBatch::with('items')->findOrFail($id);
        return view('inventory.edit', compact('batch'));
    }

    // Update a batch
    public function update(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'site_name' => 'required|string|max:255',
        'date_received' => 'required|date',
        'product_name.*' => 'required|string|max:255',
        'cost.*' => 'required|numeric|min:0',
        'quantity.*' => 'required|integer|min:1',
    ]);

    // Find the batch
    $batch = InventoryBatch::findOrFail($id);

    // Update batch info
    $batch->update([
        'site_name' => $request->site_name,
        'date_received' => $request->date_received,
    ]);

    // Delete old items
    $batch->items()->delete();

    // Insert new items
    foreach ($request->product_name as $i => $name) {
        $batch->items()->create([
            'product_name' => $name,
            'cost' => $request->cost[$i],
            'quantity' => $request->quantity[$i],
        ]);
    }

    // Redirect back with success message
    return redirect()->route('inventory.index')->with('success', 'Inventory batch updated successfully!');
}


    // Delete a batch
    public function destroy($id)
    {
        $batch = InventoryBatch::findOrFail($id);
        $batch->items()->delete();
        $batch->delete();

        return redirect()->route('inventory.index')->with('success', 'Inventory batch deleted successfully!');
    }
}
