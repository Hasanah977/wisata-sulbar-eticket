<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DestinationManageController extends Controller
{
    private const REGENCIES = [
        'Majene',
        'Polewali Mandar',
        'Mamuju',
        'Mamasa',
        'Mamuju Tengah',
        'Pasangkayu',
    ];

    public function index(): View
    {
        $destinations = Destination::latest()->get();
        $regencies = self::REGENCIES;

        return view('petugas.destinations.index', compact('destinations', 'regencies'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:120'],
            'regency'     => ['required', Rule::in(self::REGENCIES)],
            'description' => ['required', 'string'],
            'price'       => ['required', 'integer', 'min:0'],
            'daily_quota' => ['required', 'integer', 'min:1'],
            'open_hours'  => ['required', 'string', 'max:60'],
            'image'       => ['nullable', 'url', 'max:500'],
        ]);

        Destination::create([
            ...$validated,
            'slug'      => Str::slug($validated['name']) . '-' . Str::lower(Str::random(4)),
            'is_active' => true,
        ]);

        return back()->with('success', 'Destinasi baru berhasil ditambahkan.');
    }

    public function update(Request $request, Destination $destination): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:120'],
            'regency'     => ['required', Rule::in(self::REGENCIES)],
            'description' => ['required', 'string'],
            'price'       => ['required', 'integer', 'min:0'],
            'daily_quota' => ['required', 'integer', 'min:1'],
            'open_hours'  => ['required', 'string', 'max:60'],
            'image'       => ['nullable', 'url', 'max:500'],
            'is_active'   => ['nullable', 'boolean'],
        ]);

        $destination->update([
            ...$validated,
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Data destinasi berhasil diperbarui.');
    }
}
