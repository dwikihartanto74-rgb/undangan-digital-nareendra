<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'image' => $path,
            'caption' => $request->caption,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil diupload!');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil dihapus!');
    }
}
