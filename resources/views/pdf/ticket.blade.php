<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: DejaVu Sans, sans-serif;
            background: #050505;
            color: #F5F5F0;
            width: 595px;
            height: 300px;
            overflow: hidden;
        }
        .ticket {
            display: flex;
            width: 100%;
            height: 100%;
            background: #0A0A0A;
            border: 1px solid #D4AF37;
        }
        .left {
            flex: 1;
            padding: 24px 28px;
            border-right: 2px dashed #D4AF37;
            position: relative;
        }
        .right {
            width: 200px;
            padding: 24px 20px;
            background: #050505;
            text-align: center;
        }
        .brand {
            font-size: 22px;
            font-weight: bold;
            color: #D4AF37;
            letter-spacing: 4px;
            margin-bottom: 4px;
        }
        .brand-sub {
            font-size: 8px;
            color: #6B6B6B;
            letter-spacing: 3px;
            margin-bottom: 20px;
        }
        .label {
            font-size: 8px;
            color: #D4AF37;
            letter-spacing: 2px;
            margin-bottom: 3px;
        }
        .value {
            font-size: 13px;
            color: #F5F5F0;
            margin-bottom: 14px;
            font-weight: bold;
        }
        .tier {
            font-size: 26px;
            color: #D4AF37;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 6px;
        }
        .code {
            font-size: 11px;
            color: #F5F5F0;
            font-family: monospace;
            margin-bottom: 16px;
        }
        .qr {
            width: 140px;
            height: 140px;
            margin: 0 auto 10px;
            background: #FFFFFF;
            padding: 5px;
        }
        .qr img {
            width: 100%;
            height: 100%;
            display: block;
        }
        .scan-note {
            font-size: 8px;
            color: #6B6B6B;
            letter-spacing: 1px;
            line-height: 1.4;
        }
        .footer-note {
            position: absolute;
            bottom: 14px;
            left: 28px;
            font-size: 8px;
            color: #6B6B6B;
            letter-spacing: 1px;
        }
        .stripe {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            background: linear-gradient(180deg, #D4AF37 0%, #E11D2E 100%);
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="left">
            <div class="stripe"></div>
            <div class="brand">ELITE</div>
            <div class="brand-sub">BLOCK PARTY 2025</div>

            <div class="label">TICKET HOLDER</div>
            <div class="value">{{ $ticket->attendee_name }}</div>

            <div class="label">TIER</div>
            <div class="tier">{{ strtoupper($ticket->ticketType->name ?? 'GENERAL') }}</div>

            <div class="label">TICKET CODE</div>
            <div class="code">{{ $ticket->ticket_code }}</div>

            <div class="footer-note">
                Eko Hotel Grounds, Lagos • Dec 20, 2025 • Doors 6 PM
            </div>
        </div>

        <div class="right">
            <div class="qr">
                <img src="{{ $qrDataUri }}" alt="QR">
            </div>
            <div class="scan-note">
                SCAN AT ENTRY<br>
                DO NOT SHARE
            </div>
        </div>
    </div>
</body>
</html>