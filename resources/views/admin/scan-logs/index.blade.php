@extends('layouts.admin')

@section('title', 'Scan Logs — ELITE Admin')

@section('content')

<div class="mb-8">
    <div class="label-eyebrow mb-2">Audit Trail</div>
    <h1 class="heading-display text-4xl md:text-5xl text-elite-bone">
        SCAN <span class="text-gold-gradient">LOGS</span>
    </h1>
</div>

{{-- Filter tabs --}}
<div class="flex flex-wrap gap-2 mb-6">
    @foreach ([
        'all'       => 'ALL (' . $counts['all'] . ')',
        'success'   => 'SUCCESS (' . $counts['success'] . ')',
        'duplicate' => 'DUPLICATES (' . $counts['duplicate'] . ')',
        'invalid'   => 'INVALID (' . $counts['invalid'] . ')',
    ] as $key => $label)
        <a href="{{ $key === 'all' ? route('admin.scan-logs.index') : route('admin.scan-logs.index', ['result' => $key]) }}"
           class="px-4 py-2 font-bebas text-xs tracking-wider
                  {{ (request('result') === $key || (! request('result') && $key === 'all'))
                     ? 'bg-elite-gold text-elite-black'
                     : 'border border-elite-steel text-elite-smoke hover:text-elite-gold hover:border-elite-gold' }}">
            {{ $label }}
        </a>
    @endforeach
</div>

<div class="card-elite p-6">
    @if ($logs->isEmpty())
        <div class="text-center py-10 text-elite-smoke text-sm">No scan logs found.</div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-elite-steel/50">
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">TIME</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">RESULT</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">TICKET</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">ATTENDEE</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">SCANNED BY</th>
                        <th class="py-3 font-mono text-[10px] tracking-ultra text-elite-gold">IP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr class="border-b border-elite-steel/20 hover:bg-elite-charcoal/50">
                            <td class="py-3 font-mono text-xs text-elite-smoke whitespace-nowrap">
                                {{ $log->created_at->format('M d, H:i:s') }}
                            </td>
                            <td class="py-3">
                                @php
                                    $badge = match($log->result) {
                                        'success'   => 'bg-elite-gold/20 text-elite-gold',
                                        'duplicate' => 'bg-elite-crimson/20 text-elite-crimson',
                                        default     => 'bg-elite-steel/40 text-elite-smoke',
                                    };
                                @endphp
                                <span class="px-2 py-1 font-mono text-[9px] tracking-ultra {{ $badge }}">
                                    {{ strtoupper($log->result) }}
                                </span>
                            </td>
                            <td class="py-3 font-mono text-xs text-elite-bone">
                                {{ $log->ticket->ticket_code ?? '—' }}
                            </td>
                            <td class="py-3 text-sm text-elite-bone">
                                {{ $log->ticket->attendee_name ?? '—' }}
                            </td>
                            <td class="py-3 text-sm text-elite-smoke">
                                {{ $log->scanner->name ?? 'Guest' }}
                            </td>
                            <td class="py-3 font-mono text-xs text-elite-smoke">
                                {{ $log->ip_address }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $logs->links() }}
        </div>
    @endif
</div>

@endsection