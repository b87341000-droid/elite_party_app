<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{
    public function index(Request $request)
    {
        $query = Sponsor::query();

        if ($request->filled('tier')) {
            $query->where('tier', $request->tier);
        }

        $sponsors = $query->orderBy('tier')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(30)
            ->withQueryString();

        $counts = [
            'all' => Sponsor::count(),
            'platinum' => Sponsor::where('tier', 'platinum')->count(),
            'gold' => Sponsor::where('tier', 'gold')->count(),
            'silver' => Sponsor::where('tier', 'silver')->count(),
            'partner' => Sponsor::where('tier', 'partner')->count(),
            'media' => Sponsor::where('tier', 'media')->count(),
        ];

        return view('admin.sponsors.index', compact('sponsors', 'counts'));
    }

    public function create()
    {
        return view('admin.sponsors.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('sponsors', 'public');
        }

        Sponsor::create($data);

        return redirect()->route('admin.sponsors.index')
            ->with('success', 'Sponsor added.');
    }

    public function edit(Sponsor $sponsor)
    {
        return view('admin.sponsors.edit', compact('sponsor'));
    }

    public function update(Request $request, Sponsor $sponsor)
    {
        $data = $this->validated($request);

        if ($request->hasFile('logo')) {
            if ($sponsor->logo && Storage::disk('public')->exists($sponsor->logo)) {
                Storage::disk('public')->delete($sponsor->logo);
            }
            $data['logo'] = $request->file('logo')->store('sponsors', 'public');
        }

        $sponsor->update($data);

        return redirect()->route('admin.sponsors.index')
            ->with('success', 'Sponsor updated.');
    }

    public function destroy(Sponsor $sponsor)
    {
        if ($sponsor->logo && Storage::disk('public')->exists($sponsor->logo)) {
            Storage::disk('public')->delete($sponsor->logo);
        }

        $sponsor->delete();

        return back()->with('success', 'Sponsor deleted.');
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => 'required|string|max:160',
            'tier' => 'required|in:platinum,gold,silver,partner,media',
            'website' => 'nullable|url|max:200',
            'description' => 'nullable|string|max:2000',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'sort_order' => 'nullable|integer|min:0|max:999',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
