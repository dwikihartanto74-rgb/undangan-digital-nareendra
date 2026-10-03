<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Wish;
use App\Models\Attendance;
use App\Models\Gallery;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'guests' => Guest::count(),
            'wishes' => Wish::count(),
            'attendances' => Attendance::count(),
            'galleries' => Gallery::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
