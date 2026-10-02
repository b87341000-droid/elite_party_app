@extends('layouts.admin')
@section('title', 'New Announcement — ELITE Admin')

@section('content')

<a href="{{ route('admin.announcements.index') }}" class="font-mono text-[10px] tracking-ultra text-elite-gold hover:text-elite-bone">
    ← BACK TO ANNOUNCEMENTS
</a>

<div class="mt-4 mb-8">
    <div class="label-eyebrow mb-2">Broadcast</div>
    <h1 class="heading-display text-4xl md:text-5xl text-elite-bone">
        NEW <span class="text-gold-gradient">ANNOUNCEMENT</span>
    </h1>
</div>

<div class="card-elite p-6 md:p-8 max-w-3xl">
    @if ($errors->any())
        <div class="mb-6 p-4 border border-elite-crimson bg-elite-crimson/10 text-elite-crimson font-mono text-sm">
            @foreach ($errors->all() as $err) <div>✗ {{ $err }}</div> @endforeach
        </div>
    @endif

    <form action="{{ route('admin.announcements.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">TITLE *</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
        </div>

        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">BODY *</label>
            <textarea name="body" rows="6" required
                      class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm resize-y">{{ old('body') }}</textarea>
        </div>

        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">TARGET AUDIENCE *</label>
            <select name="audience" required
                    class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
                <option value="all" @selected(old('audience', 'all') === 'all')>ALL USERS</option>
                <option value="customers" @selected(old('audience') === 'customers')>CUSTOMERS ONLY</option>
                <option value="vendors" @selected(old('audience') === 'vendors')>VENDORS ONLY</option>
                <option value="ticket_holders" @selected(old('audience') === 'ticket_holders')>TICKET HOLDERS ONLY</option>
            </select>
        </div>

        <div class="flex flex-wrap gap-6 pt-2">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published', true))
                       class="w-5 h-5 bg-elite-black border-elite-steel text-elite-gold focus:ring-elite-gold">
                <span class="font-bebas text-sm tracking-wider text-elite-bone">PUBLISH IMMEDIATELY</span>
            </label>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="send_email" value="1" @checked(old('send_email'))
                       class="w-5 h-5 bg-elite-black border-elite-steel text-elite-gold focus:ring-elite-gold">
                <span class="font-bebas text-sm tracking-wider text-elite-bone">SEND EMAIL TO AUDIENCE</span>
            </label>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="btn-gold">POST ANNOUNCEMENT →</button>
            <a href="{{ route('admin.announcements.index') }}" class="btn-outline-gold">CANCEL</a>
        </div>
    </form>
</div>

@endsection
