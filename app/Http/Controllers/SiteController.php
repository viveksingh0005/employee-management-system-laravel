<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::all();
        return view('sites.index', compact('sites'));
    }

    public function create()
    {
        return view('sites.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        Site::create($request->all());

        return redirect()->route('sites.index')->with('success', 'Site added successfully.');
    }

    public function edit(Site $site)
    {
        return view('sites.edit', compact('site'));
    }

    public function update(Request $request, Site $site)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $site->update($request->all());

        return redirect()->route('sites.index')->with('success', 'Site updated successfully.');
    }

    public function destroy(Site $site)
    {
        $site->delete();
        return redirect()->route('sites.index')->with('success', 'Site deleted successfully.');
    }
}
