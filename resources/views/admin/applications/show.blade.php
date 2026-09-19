@extends('layouts.admin')
@section('title', 'Application — ' . $application->contact_name)

@section('content')

<a href="{{ route('admin.applications.index') }}"
   class="font-mono text-[10px] tracking-ultra text-elite-gold hover:text-elite-bone">
    ← BACK TO APPLICATIONS
</a>

<div class="mt-4 mb-8 flex items-center gap-4">
    <h1 class="heading-display text-4xl md:text-5xl text-elite-bone">
        {{ strtoupper($application->type) }} APPLICATION
    </h1>
    @php
        $badge = match($application->status) {
            'pending'  => 'bg-elite-gold/20 text-elite-gold',
            'approved' => 'bg-green-500/20 text-green-500',
            'rejected' => 'bg-elite-crimson/20 text-elite-crimson',
            default    => 'bg-elite-steel/40 text-elite-smoke',
        };
    @endphp
    <span class="px-3 py-1 font-mono text-[10px] tracking-ultra {{ $badge }}">
        {{ strtoupper($application->status) }}
    </span>
</div>

<div class="grid lg:grid-cols-3 gap-6">

    {{-- Main detail --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="card-elite p-6">
            <div class="label-eyebrow mb-4">Applicant</div>
            <div class="grid sm:grid-cols-2 gap-4">
                @foreach ([
                    ['CONTACT NAME', $application->contact_name],
                    ['BUSINESS / BRAND', $application->business_name ?: '—'],
                    ['EMAIL', $application->email],
                    ['PHONE', $application->phone],
                    ['WEBSITE', $application->website ?: '—'],
                    ['INSTAGRAM', $application->instagram ?: '—'],
                    ['TIKTOK', $application->tiktok ?: '—'],
                    ['SUBMITTED', $application->created_at->format('M d, Y H:i')],
                ] as $row)
                    <div>
                        <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-1">{{ $row[0] }}</div>
                        <div class="text-sm text-elite-bone break-all">{{ $row[1] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="card-elite p-6">
            <div class="label-eyebrow mb-4">Description</div>
            <p class="text-sm text-elite-bone leading-relaxed whitespace-pre-wrap">{{ $application->description }}</p>
        </div>

        @if (!empty($application->documents))
            <div class="card-elite p-6">
                <div class="label-eyebrow mb-4">Documents ({{ count($application->documents) }})</div>
                <div class="space-y-2">
                    @foreach ($application->documents as $path)
                        <div class="flex items-center justify-between p-3 bg-elite-black border border-elite-steel/40">
                            <span class="font-mono text-xs text-elite-bone">{{ basename($path) }}</span>
                            <span class="font-mono text-[10px] text-elite-smoke">STORED LOCALLY</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    {{-- Actions --}}
    <div class="space-y-6">
        @if ($application->status === 'pending')
            <div class="card-elite p-6">
                <div class="label-eyebrow mb-4">Take Action</div>

                <form action="{{ route('admin.applications.approve', $application) }}" method="POST" class="space-y-3 mb-4">
                    @csrf
                    <textarea name="admin_notes" rows="3" placeholder="Optional note to applicant..."
                              class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-3 py-2 font-mono text-xs resize-none"></textarea>
                    <button type="submit" class="btn-gold w-full justify-center !py-3 !text-xs">
                        ✅ APPROVE
                    </button>
                </form>

                <div class="divider-gold my-4"></div>

                <form action="{{ route('admin.applications.reject', $application) }}" method="POST" class="space-y-3">
                    @csrf
                    <textarea name="admin_notes" rows="3" placeholder="Reason for rejection (sent to applicant)..."
                              class="w-full bg-elite-black border border-elite-steel focus:border-elite-crimson text-elite-bone px-3 py-2 font-mono text-xs resize-none"></textarea>
                    <button type="submit" class="btn-crimson w-full justify-center !py-3 !text-xs">
                        ❌ REJECT
                    </button>
                </form>
            </div>
        @else
            <div class="card-elite p-6">
                <div class="label-eyebrow mb-4">Reviewed</div>
                <div class="text-sm text-elite-bone mb-2">
                    By: {{ $application->reviewer->name ?? 'System' }}
                </div>
                <div class="font-mono text-xs text-elite-smoke mb-4">
                    {{ optional($application->reviewed_at)->format('M d, Y H:i') }}
                </div>
                @if ($application->admin_notes)
                    <div class="p-3 bg-elite-black border-l-2 border-elite-gold">
                        <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-2">NOTES</div>
                        <div class="text-sm text-elite-bone">{{ $application->admin_notes }}</div>
                    </div>
                @endif
            </div>
        @endif

        <div class="card-elite p-6">
            <div class="label-eyebrow mb-4">Quick Actions</div>
            <ul class="space-y-2 text-sm">
                <li>
                    <a href="mailto:{{ $application->email }}" class="text-elite-gold hover:text-elite-bone">
                        ✉ Email applicant
                    </a>
                </li>
                <li>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $application->phone) }}" target="_blank" class="text-elite-gold hover:text-elite-bone">
                        💬 WhatsApp applicant
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

@endsection