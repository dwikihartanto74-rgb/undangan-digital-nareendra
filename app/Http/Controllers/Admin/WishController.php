<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wish;

class WishController extends Controller
{
    public function index()
    {
        $wishes = Wish::latest()->get();
        return view('admin.wishes.index', compact('wishes'));
    }

    public function destroy(Wish $wish)
    {
        $wish->delete();
        return redirect()->route('admin.wishes.index')->with('success', 'Ucapan berhasil dihapus!');
    }
}
