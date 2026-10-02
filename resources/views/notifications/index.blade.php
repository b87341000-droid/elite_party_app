@extends('layouts.app')
@section('title', 'Notifications — Elite Block Party')

@section('content')
<div class="py-12 bg-elite-black min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="heading-display text-3xl md:text-4xl text-elite-bone">NOTIFICATIONS</h1>
            @if ($notifications->isNotEmpty())
                <form action="{{ route('notifications.read-all') }}" method="POST">
                    @csrf
                    <button type="submit" class="font-mono text-xs text-elite-gold hover:underline">
                        MARK ALL AS READ
                    </button>
                </form>
            @endif
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 border border-elite-gold bg-elite-gold/10 text-elite-gold font-mono text-sm">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div class="bg-elite-charcoal/40 border border-elite-steel/40 p-6 rounded-none">
            @forelse ($notifications as $notification)
                <div class="py-4 border-b border-elite-steel/20 last:border-0 flex items-start justify-between gap-4 {{ $notification->read_at ? 'opacity-60' : '' }}">
                    <div>
                        <div class="text-sm text-elite-bone font-medium">
                            {{ $notification->data['message'] ?? $notification->data['title'] ?? 'Notification' }}
                        </div>
                        <div class="font-mono text-xs text-elite-smoke mt-1">
                            {{ $notification->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        @if (!$notification->read_at)
                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="font-mono text-[10px] text-elite-gold uppercase hover:underline">
                                    Mark Read
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-mono text-[10px] text-elite-crimson uppercase hover:underline">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <p class="font-mono text-sm text-elite-smoke">No notifications yet.</p>
                </div>
            @endforelse

            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
