<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::orderByDesc('is_headliner')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(30);

        return view('admin.artists.index', compact('artists'));
    }

    public function create()
    {
        $events = Event::active()->get();
        return view('admin.artists.create', compact('events'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('artists', 'public');
        }

        Artist::create($data);

        return redirect()->route('admin.artists.index')
            ->with('success', 'Artist created.');
    }

    public function edit(Artist $artist)
    {
        $events = Event::active()->get();
        return view('admin.artists.edit', compact('artist', 'events'));
    }

    public function update(Request $request, Artist $artist)
    {
        $data = $this->validated($request);

        if ($request->hasFile('photo')) {
            // Delete old
            if ($artist->photo && Storage::disk('public')->exists($artist->photo)) {
                Storage::disk('public')->delete($artist->photo);
            }
            $data['photo'] = $request->file('photo')->store('artists', 'public');
        }

        $artist->update($data);

        return redirect()->route('admin.artists.index')
            ->with('success', 'Artist updated.');
    }

    public function destroy(Artist $artist)
    {
        if ($artist->photo && Storage::disk('public')->exists($artist->photo)) {
            Storage::disk('public')->delete($artist->photo);
        }

        $artist->delete();

        return back()->with('success', 'Artist deleted.');
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            'event_id'     => 'nullable|exists:events,id',
            'name'         => 'required|string|max:120',
            'stage_name'   => 'nullable|string|max:120',
            'role'         => 'required|in:performer,dj,host,mc,band',
            'bio'          => 'nullable|string|max:5000',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'instagram'    => 'nullable|string|max:80',
            'tiktok'       => 'nullable|string|max:80',
            'twitter'      => 'nullable|string|max:80',
            'is_headliner' => 'nullable|boolean',
            'sort_order'   => 'nullable|integer|min:0|max:999',
            'is_active'    => 'nullable|boolean',
        ]);

        $data['is_headliner'] = $request->boolean('is_headliner');
        $data['is_active']    = $request->boolean('is_active', true);
        $data['sort_order']   = $data['sort_order'] ?? 0;

        return $data;
    }
}