<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::latest()->get();
        return view('admin.attendances.index', compact('attendances'));
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('admin.attendances.index')->with('success', 'Konfirmasi kehadiran berhasil dihapus!');
    }
}
