@extends('layouts.admin')
@section('title', 'Edit Announcement — ELITE Admin')

@section('content')

<a href="{{ route('admin.announcements.index') }}" class="font-mono text-[10px] tracking-ultra text-elite-gold hover:text-elite-bone">
    ← BACK TO ANNOUNCEMENTS
</a>

<div class="mt-4 mb-8">
    <div class="label-eyebrow mb-2">Edit</div>
    <h1 class="heading-display text-4xl md:text-5xl text-elite-bone">
        EDIT <span class="text-gold-gradient">ANNOUNCEMENT</span>
    </h1>
</div>

<div class="card-elite p-6 md:p-8 max-w-3xl">
    @if ($errors->any())
        <div class="mb-6 p-4 border border-elite-crimson bg-elite-crimson/10 text-elite-crimson font-mono text-sm">
            @foreach ($errors->all() as $err) <div>✗ {{ $err }}</div> @endforeach
        </div>
    @endif

    <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST" class="space-y-5">
        @csrf @method('PUT')

        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">TITLE *</label>
            <input type="text" name="title" value="{{ old('title', $announcement->title) }}" required
                   class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
        </div>

        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">BODY *</label>
            <textarea name="body" rows="6" required
                      class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm resize-y">{{ old('body', $announcement->body) }}</textarea>
        </div>

        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">TARGET AUDIENCE *</label>
            <select name="audience" required
                    class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
                <option value="all" @selected(old('audience', $announcement->audience) === 'all')>ALL USERS</option>
                <option value="customers" @selected(old('audience', $announcement->audience) === 'customers')>CUSTOMERS ONLY</option>
                <option value="vendors" @selected(old('audience', $announcement->audience) === 'vendors')>VENDORS ONLY</option>
                <option value="ticket_holders" @selected(old('audience', $announcement->audience) === 'ticket_holders')>TICKET HOLDERS ONLY</option>
            </select>
        </div>

        <div class="flex flex-wrap gap-6 pt-2">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $announcement->is_published))
                       class="w-5 h-5 bg-elite-black border-elite-steel text-elite-gold focus:ring-elite-gold">
                <span class="font-bebas text-sm tracking-wider text-elite-bone">PUBLISHED</span>
            </label>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="send_email" value="1" @checked(old('send_email', $announcement->send_email))
                       class="w-5 h-5 bg-elite-black border-elite-steel text-elite-gold focus:ring-elite-gold">
                <span class="font-bebas text-sm tracking-wider text-elite-bone">SEND EMAIL TO AUDIENCE</span>
            </label>
        </div>

        @if ($announcement->emailed_at)
            <div class="p-3 border border-green-500/30 bg-green-500/10 text-green-400 font-mono text-xs">
                ✓ Email was sent on {{ $announcement->emailed_at->format('M d, Y \a\t g:i A') }}
            </div>
        @endif

        <div class="flex gap-3 pt-4">
            <button type="submit" class="btn-gold">UPDATE →</button>
            <a href="{{ route('admin.announcements.index') }}" class="btn-outline-gold">CANCEL</a>
        </div>
    </form>
</div>

@endsection
