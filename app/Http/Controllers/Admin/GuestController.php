<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guest;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    public function index()
    {
        $guests = Guest::latest()->get();
        return view('admin.guests.index', compact('guests'));
    }

    public function create()
    {
        return view('admin.guests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Guest::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . strtolower(Str::random(4)),
        ]);

        return redirect()->route('admin.guests.index')->with('success', 'Tamu berhasil ditambahkan!');
    }

    public function edit(Guest $guest)
    {
        return view('admin.guests.edit', compact('guest'));
    }

    public function update(Request $request, Guest $guest)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $guest->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . strtolower(Str::random(4)),
        ]);

        return redirect()->route('admin.guests.index')->with('success', 'Data tamu berhasil diubah!');
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();
        return redirect()->route('admin.guests.index')->with('success', 'Tamu berhasil dihapus!');
    }
}
