<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvitationSetting;
use App\Models\Guest;
use App\Models\Wish;
use App\Models\Attendance;
use App\Models\Gallery;

class FrontendController extends Controller
{
    public function show($slug)
    {
        $settings = InvitationSetting::first();
        if (!$settings) {
            abort(404, 'Undangan belum diatur oleh Admin.');
        }

        $guest = Guest::where('slug', $slug)->first();
        
        $guestName = $guest ? $guest->name : 'Tamu Undangan';
        if ($slug !== 'tamu' && !$guest) {
            // Replace hyphens with spaces and title case if not found
            $guestName = ucwords(str_replace('-', ' ', $slug));
        }

        $wishes = Wish::latest()->get();
        $galleries = Gallery::latest()->get();

        return view('frontend.invitation', compact('settings', 'guestName', 'wishes', 'galleries'));
    }

    public function storeWish(Request $request, $slug)
    {
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Wish::create([
            'guest_name' => $request->guest_name,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success_wish', 'Ucapan berhasil dikirim!');
    }

    public function storeRsvp(Request $request, $slug)
    {
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'people_count' => 'required|integer|min:1',
            'status' => 'required|in:Hadir,Tidak Hadir,Masih Ragu',
        ]);

        Attendance::create([
            'guest_name' => $request->guest_name,
            'people_count' => $request->people_count,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success_rsvp', 'Konfirmasi kehadiran berhasil dikirim!');
    }

    public function storeRsvpWish(Request $request, $slug)
    {
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'people_count' => 'required|integer|min:1',
            'status' => 'required|in:Hadir,Tidak Hadir,Masih Ragu',
            'message' => 'nullable|string',
        ]);

        Attendance::create([
            'guest_name' => $request->guest_name,
            'people_count' => $request->people_count,
            'status' => $request->status,
        ]);

        if ($request->filled('message')) {
            Wish::create([
                'guest_name' => $request->guest_name,
                'message' => $request->message,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih, konfirmasi kehadiran dan ucapan Anda telah berhasil dikirim.',
        ]);
    }
}
