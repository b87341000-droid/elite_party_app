@extends('layouts.admin')
@section('title', 'Edit ' . $artist->display_name . ' — ELITE Admin')

@section('content')

<a href="{{ route('admin.artists.index') }}" class="font-mono text-[10px] tracking-ultra text-elite-gold hover:text-elite-bone">
    ← BACK TO ARTISTS
</a>

<div class="mt-4 mb-8">
    <div class="label-eyebrow mb-2">Editing</div>
    <h1 class="heading-display text-4xl md:text-5xl text-elite-bone">
        EDIT <span class="text-gold-gradient">{{ strtoupper($artist->display_name) }}</span>
    </h1>
</div>

<div class="card-elite p-6 md:p-8 max-w-3xl">
    @if ($errors->any())
        <div class="mb-6 p-4 border border-elite-crimson bg-elite-crimson/10 text-elite-crimson font-mono text-sm">
            @foreach ($errors->all() as $err) <div>✗ {{ $err }}</div> @endforeach
        </div>
    @endif

    @if ($artist->photo_url)
        <div class="mb-6">
            <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-2">CURRENT PHOTO</div>
            <img src="{{ $artist->photo_url }}" class="w-32 h-32 object-cover border border-elite-steel">
        </div>
    @endif

    <form action="{{ route('admin.artists.update', $artist) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">REAL NAME *</label>
                <input type="text" name="name" value="{{ old('name', $artist->name) }}" required
                       class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
            </div>
            <div>
                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">STAGE NAME</label>
                <input type="text" name="stage_name" value="{{ old('stage_name', $artist->stage_name) }}"
                       class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">ROLE *</label>
                <select name="role" required
                        class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
                    @foreach (['performer','dj','host','mc','band'] as $role)
                        <option value="{{ $role }}" @selected(old('role', $artist->role) === $role)>{{ strtoupper($role) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">EVENT</label>
                <select name="event_id"
                        class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
                    <option value="">— None —</option>
                    @foreach ($events as $event)
                        <option value="{{ $event->id }}" @selected(old('event_id', $artist->event_id) == $event->id)>{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">BIO</label>
            <textarea name="bio" rows="4"
                      class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm resize-none">{{ old('bio', $artist->bio) }}</textarea>
        </div>

        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">REPLACE PHOTO (leave empty to keep current)</label>
            <input type="file" name="photo" accept="image/*"
                   class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-elite-gold file:text-elite-black file:font-bebas">
        </div>

        <div class="grid md:grid-cols-3 gap-5">
            <div>
                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">INSTAGRAM</label>
                <input type="text" name="instagram" value="{{ old('instagram', $artist->instagram) }}"
                       class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
            </div>
            <div>
                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">TIKTOK</label>
                <input type="text" name="tiktok" value="{{ old('tiktok', $artist->tiktok) }}"
                       class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
            </div>
            <div>
                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">TWITTER</label>
                <input type="text" name="twitter" value="{{ old('twitter', $artist->twitter) }}"
                       class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-5">
            <div>
                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">SORT ORDER</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $artist->sort_order) }}" min="0" max="999"
                       class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
            </div>
            <div class="flex items-end">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_headliner" value="1" @checked(old('is_headliner', $artist->is_headliner))
                           class="w-5 h-5 bg-elite-black border-elite-steel text-elite-gold focus:ring-elite-gold">
                    <span class="font-bebas text-sm tracking-wider text-elite-bone">HEADLINER</span>
                </label>
            </div>
            <div class="flex items-end">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $artist->is_active))
                           class="w-5 h-5 bg-elite-black border-elite-steel text-elite-gold focus:ring-elite-gold">
                    <span class="font-bebas text-sm tracking-wider text-elite-bone">ACTIVE</span>
                </label>
            </div>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="btn-gold">UPDATE ARTIST →</button>
            <a href="{{ route('admin.artists.index') }}" class="btn-outline-gold">CANCEL</a>
        </div>
    </form>
</div>

@endsection