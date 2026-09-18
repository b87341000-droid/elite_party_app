@extends('layouts.admin')

@section('title', 'Scanner — ELITE Admin')

@section('content')

<div class="mb-8">
    <div class="label-eyebrow mb-2">Gate Control</div>
    <h1 class="heading-display text-4xl md:text-5xl text-elite-bone">
        TICKET <span class="text-gold-gradient">SCANNER</span>
    </h1>
</div>

<div class="grid lg:grid-cols-2 gap-6">

    {{-- Scanner input --}}
    <div class="card-elite p-6">
        <div class="label-eyebrow mb-4">Scan / Enter Code</div>

        <form id="scan-form" class="space-y-4" onsubmit="event.preventDefault(); submitScan();">
            <textarea id="scan-input"
                      rows="4"
                      placeholder="Scan QR with phone camera OR paste ticket code (EBP-XXXXXXXX) and press Enter"
                      autofocus
                      class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm resize-none"></textarea>

            <button type="submit" class="btn-gold w-full justify-center">
                SCAN NOW →
            </button>
        </form>

        <div class="mt-4 p-4 bg-elite-gold/5 border border-elite-gold/20 text-xs text-elite-smoke leading-relaxed">
            <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-2">💡 TIPS</div>
            <ul class="space-y-1">
                <li>• Use a Bluetooth/USB QR scanner — it types the code + Enter</li>
                <li>• Or paste the ticket code manually for testing</li>
                <li>• Every scan is logged permanently</li>
            </ul>
        </div>
    </div>

    {{-- Result panel --}}
    <div class="card-elite p-6">
        <div class="label-eyebrow mb-4">Result</div>

        <div id="scan-result" class="min-h-[300px] flex flex-col items-center justify-center text-center">
            <div class="text-6xl mb-4 text-elite-gold/30">🎟️</div>
            <div class="text-elite-smoke font-mono text-sm">Waiting for scan…</div>
        </div>
    </div>
</div>

{{-- Recent scans on this page load --}}
<div class="card-elite p-6 mt-8">
    <div class="flex items-center justify-between mb-4">
        <div class="heading-bebas text-2xl text-elite-bone">THIS SESSION</div>
        <div class="font-mono text-[10px] tracking-ultra text-elite-gold" id="session-count">0 SCANS</div>
    </div>
    <div id="session-log" class="space-y-2 text-sm text-elite-smoke">
        <div class="text-center py-6 font-mono text-xs">No scans yet.</div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let sessionCount = 0;

    async function submitScan() {
        const input = document.getElementById('scan-input');
        const code = input.value.trim();
        if (! code) return;

        const resultBox = document.getElementById('scan-result');
        resultBox.innerHTML = `
            <div class="text-4xl animate-pulse mb-4">⏳</div>
            <div class="text-elite-gold font-mono text-sm">Verifying…</div>
        `;

        try {
            const res = await fetch('{{ route('admin.scanner.scan') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ code }),
            });

            const data = await res.json();
            showResult(data, code);
            logScan(data, code);
        } catch (err) {
            resultBox.innerHTML = `
                <div class="text-6xl mb-4 text-elite-crimson">⚠️</div>
                <div class="text-elite-crimson font-bebas text-2xl">NETWORK ERROR</div>
                <div class="text-elite-smoke font-mono text-xs mt-2">${err.message}</div>
            `;
        }

        input.value = '';
        input.focus();
    }

    function showResult(data, code) {
        const box = document.getElementById('scan-result');
        const colors = {
            success:   { bg: 'elite-gold',    icon: '✅', label: 'VALID ENTRY' },
            duplicate: { bg: 'elite-crimson', icon: '🛑', label: 'ALREADY USED' },
            invalid:   { bg: 'elite-crimson', icon: '❌', label: 'INVALID' },
        };
        const c = colors[data.result] || colors.invalid;

        let ticketInfo = '';
        if (data.ticket) {
            ticketInfo = `
                <div class="mt-6 p-4 bg-elite-black border border-elite-steel/50 text-left w-full">
                    <div class="font-mono text-[10px] tracking-ultra text-elite-gold mb-1">${(data.ticket.tier || 'TICKET').toUpperCase()}</div>
                    <div class="font-bebas text-xl text-elite-bone">${data.ticket.attendee_name}</div>
                    <div class="font-mono text-xs text-elite-smoke mt-1">${data.ticket.code}</div>
                </div>
            `;
        }

        box.innerHTML = `
            <div class="text-7xl mb-4">${c.icon}</div>
            <div class="heading-bebas text-4xl text-${c.bg}">${c.label}</div>
            <div class="text-elite-smoke font-mono text-xs mt-3 px-6">${data.message}</div>
            ${ticketInfo}
        `;
    }

    function logScan(data, code) {
        sessionCount++;
        document.getElementById('session-count').textContent = sessionCount + ' SCAN' + (sessionCount === 1 ? '' : 'S');

        const log = document.getElementById('session-log');
        if (log.querySelector('.text-center')) log.innerHTML = '';

        const colors = { success: 'text-elite-gold', duplicate: 'text-elite-crimson', invalid: 'text-elite-crimson' };
        const icons = { success: '✅', duplicate: '🛑', invalid: '❌' };

        const entry = document.createElement('div');
        entry.className = 'flex items-center justify-between p-2 border border-elite-steel/30 bg-elite-black';
        entry.innerHTML = `
            <div class="flex items-center gap-3">
                <span>${icons[data.result] || '❓'}</span>
                <span class="font-mono text-xs text-elite-bone">${data.ticket?.code || code.slice(0, 20)}</span>
            </div>
            <div class="font-mono text-[10px] ${colors[data.result] || 'text-elite-smoke'}">
                ${new Date().toLocaleTimeString()}
            </div>
        `;
        log.prepend(entry);
    }

    // Auto-focus on load
    document.getElementById('scan-input').focus();
</script>
@endpush