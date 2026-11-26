<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DestinationController extends Controller
{
    private const REGENCIES = [
        'Majene',
        'Polewali Mandar',
        'Mamuju',
        'Mamasa',
        'Mamuju Tengah',
        'Pasangkayu',
    ];

    public function index(Request $request): View
    {
        $query = Destination::where('is_active', true);

        if ($request->filled('regency') && in_array($request->regency, self::REGENCIES, true)) {
            $query->where('regency', $request->regency);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $destinations = $query->latest()->get();
        $regencies = self::REGENCIES;

        return view('destinations.index', compact('destinations', 'regencies'));
    }

    public function show(Request $request, string $slug): View
    {
        $destination = Destination::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $selectedDate = $request->input('date', now()->toDateString());
        if ($selectedDate < now()->toDateString()) {
            $selectedDate = now()->toDateString();
        }

        $remainingQuota = $destination->remainingQuotaForDate($selectedDate);

        return view('destinations.show', compact('destination', 'selectedDate', 'remainingQuota'));
    }
}
