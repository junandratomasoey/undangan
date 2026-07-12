<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Rsvp;
use App\Models\Wish;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total'      => Invitation::count(),
            'published'  => Invitation::where('status', 'published')->count(),
            'draft'      => Invitation::where('status', 'draft')->count(),
            'hadir'      => (int) Rsvp::where('attendance', 'hadir')->sum('headcount'),
            'wishes'     => Wish::count(),
        ];

        $recent = Invitation::latest()->take(6)->get();

        // Undangan yang akan kedaluwarsa dalam 14 hari
        $expiring = Invitation::whereNotNull('expires_at')
            ->whereBetween('expires_at', [now(), now()->addDays(14)])
            ->orderBy('expires_at')
            ->get();

        return view('admin.dashboard', compact('stats', 'recent', 'expiring'));
    }
}
