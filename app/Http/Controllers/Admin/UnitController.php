<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy('name')->get();
        return view('admin.units.index', compact('units'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:units,name',
            'color' => 'nullable|string|max:7',
        ]);

        Unit::create($validated);

        return redirect()->back()->with('success', 'Unit berhasil ditambahkan');
    }

    public function update(Request $request, Unit $unit)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:units,name,' . $unit->id,
            'color' => 'nullable|string|max:7',
        ]);

        $unit->update($validated);

        return redirect()->back()->with('success', 'Unit berhasil diperbarui');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->back()->with('success', 'Unit berhasil dihapus');
    }
}
