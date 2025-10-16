<?php

namespace App\Http\Controllers;

use App\Models\InventoryBatch;
use App\Models\InventoryItem;
use App\Models\Employee;
use Illuminate\Http\Request;

class InventoryBatchController extends Controller
{
    // Display all batches
    public function index()
    {
        $batches = InventoryBatch::with('items', 'employee')->latest()->get();
        return view('inventory.index', compact('batches'));
    }

    // Show form to create a new batch
    public function create()
    {
        $employees = Employee::all(); // For "Received By" dropdown
        return view('inventory.create', compact('employees'));
    }

    // Store new batch
    public function store(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'date_received' => 'required|date',
            'received_by' => 'required|exists:employees,id',
            'product_name.*' => 'required|string|max:255',
            'cost.*' => 'required|numeric|min:0',
            'quantity.*' => 'required|integer|min:1',
        ]);

        // Calculate total cost
        $total = 0;
        foreach ($request->product_name as $i => $name) {
            $total += $request->cost[$i] * $request->quantity[$i];
        }

        // Create batch
        $batch = InventoryBatch::create([
            'site_name' => $request->site_name,
            'date_received' => $request->date_received,
            'received_by' => $request->received_by,
            'total' => $total,
        ]);

        // Create items
        foreach ($request->product_name as $i => $name) {
            $batch->items()->create([
                'product_name' => $name,
                'cost' => $request->cost[$i],
                'quantity' => $request->quantity[$i],
            ]);
        }

        return redirect()->route('inventory.index')->with('success', 'Inventory batch added successfully!');
    }

    // Edit batch
    public function edit($id)
    {
        $batch = InventoryBatch::with('items')->findOrFail($id);
        $employees = Employee::all();
        return view('inventory.edit', compact('batch', 'employees'));
    }

    // Update batch
    public function update(Request $request, $id)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'date_received' => 'required|date',
            'received_by' => 'required|exists:employees,id',
            'product_name.*' => 'required|string|max:255',
            'cost.*' => 'required|numeric|min:0',
            'quantity.*' => 'required|integer|min:1',
        ]);

        $batch = InventoryBatch::findOrFail($id);

        // Calculate total again
        $total = 0;
        foreach ($request->product_name as $i => $name) {
            $total += $request->cost[$i] * $request->quantity[$i];
        }

        // Update batch
        $batch->update([
            'site_name' => $request->site_name,
            'date_received' => $request->date_received,
            'received_by' => $request->received_by,
            'total' => $total,
        ]);

        // Remove old items and add new ones
        $batch->items()->delete();

        foreach ($request->product_name as $i => $name) {
            $batch->items()->create([
                'product_name' => $name,
                'cost' => $request->cost[$i],
                'quantity' => $request->quantity[$i],
            ]);
        }

        return redirect()->route('inventory.index')->with('success', 'Inventory batch updated successfully!');
    }

    // Delete batch
    public function destroy($id)
    {
        $batch = InventoryBatch::findOrFail($id);
        $batch->items()->delete();
        $batch->delete();

        return redirect()->route('inventory.index')->with('success', 'Inventory batch deleted successfully!');
    }
}
