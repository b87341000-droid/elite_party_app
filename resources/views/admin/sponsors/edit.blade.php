@extends('layouts.admin')
@section('title', 'Edit ' . $sponsor->name . ' — ELITE Admin')

@section('content')

<a href="{{ route('admin.sponsors.index') }}" class="font-mono text-[10px] tracking-ultra text-elite-gold hover:text-elite-bone">
    ← BACK TO SPONSORS
</a>

<div class="mt-4 mb-8">
    <div class="label-eyebrow mb-2">Editing</div>
    <h1 class="heading-display text-4xl md:text-5xl text-elite-bone">
        EDIT <span class="text-gold-gradient">{{ strtoupper($sponsor->name) }}</span>
    </h1>
</div>

<div class="card-elite p-6 md:p-8 max-w-3xl">
    @if ($errors->any())
        <div class="mb-6 p-4 border border-elite-crimson bg-elite-crimson/10 text-elite-crimson font-mono text-sm">
            @foreach ($errors->all() as $err) <div>✗ {{ $err }}</div> @endforeach
        </div>
    @endif

    @if ($sponsor->logo_url)
        <div class="mb-6">
            <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-2">CURRENT LOGO</div>
            <div class="w-40 h-24 bg-elite-black border border-elite-steel flex items-center justify-center p-2">
                <img src="{{ $sponsor->logo_url }}" class="max-w-full max-h-full object-contain">
            </div>
        </div>
    @endif

    <form action="{{ route('admin.sponsors.update', $sponsor) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf @method('PUT')

        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">SPONSOR NAME *</label>
                <input type="text" name="name" value="{{ old('name', $sponsor->name) }}" required
                       class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
            </div>
            <div>
                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">TIER *</label>
                <select name="tier" required
                        class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
                    @foreach (['platinum','gold','silver','partner','media'] as $tier)
                        <option value="{{ $tier }}" @selected(old('tier', $sponsor->tier) === $tier)>{{ strtoupper($tier) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">WEBSITE</label>
            <input type="url" name="website" value="{{ old('website', $sponsor->website) }}"
                   class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
        </div>

        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">DESCRIPTION</label>
            <textarea name="description" rows="3"
                      class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm resize-none">{{ old('description', $sponsor->description) }}</textarea>
        </div>

        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">REPLACE LOGO (leave empty to keep current)</label>
            <input type="file" name="logo" accept="image/*"
                   class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-elite-gold file:text-elite-black file:font-bebas">
        </div>

        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">SORT ORDER</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $sponsor->sort_order) }}" min="0" max="999"
                       class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
            </div>
            <div class="flex items-end">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $sponsor->is_active))
                           class="w-5 h-5 bg-elite-black border-elite-steel text-elite-gold focus:ring-elite-gold">
                    <span class="font-bebas text-sm tracking-wider text-elite-bone">ACTIVE</span>
                </label>
            </div>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="btn-gold">UPDATE SPONSOR →</button>
            <a href="{{ route('admin.sponsors.index') }}" class="btn-outline-gold">CANCEL</a>
        </div>
    </form>
</div>

@endsection
