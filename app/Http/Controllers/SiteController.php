<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Department;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    // Display all sites
    public function index()
    {
        // Eager load department to display in index
        $sites = Site::with('department')->get();

        return view('sites.index', compact('sites'));
    }

    // Show create site form
    public function create()
    {
        $departments = Department::all();
        return view('sites.create', compact('departments'));
    }

    // Store new site
   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'department_id' => 'required|exists:departments,id', // Validate department
    ]);

    // Only take the fields we want to save
    Site::create($request->only('name', 'location', 'department_id'));

    return redirect()->route('sites.index')->with('success', 'Site added successfully.');
}


    // Show edit site form
    public function edit(Site $site)
    {
        $departments = Department::all();
        return view('sites.edit', compact('site', 'departments'));
    }

    // Update existing site
    public function update(Request $request, Site $site)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        $site->update($request->only('name', 'location', 'department_id'));

        return redirect()->route('sites.index')->with('success', 'Site updated successfully.');
    }

    // Delete site
    public function destroy(Site $site)
    {
        $site->delete();
        return redirect()->route('sites.index')->with('success', 'Site deleted successfully.');
    }
}
