<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your ELITE Tickets</title>
</head>
<body style="margin:0; padding:0; background:#050505; font-family: Arial, Helvetica, sans-serif; color:#F5F5F0;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#050505; padding:40px 20px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px; background:#0A0A0A; border:1px solid #1A1A1A;">

                    {{-- Header --}}
                    <tr>
                        <td style="padding:40px 40px 20px; text-align:center; border-bottom:1px solid #1A1A1A;">
                            <div style="font-size:32px; font-weight:900; color:#D4AF37; letter-spacing:6px;">ELITE</div>
                            <div style="font-size:10px; color:#6B6B6B; letter-spacing:4px; margin-top:6px;">BLOCK PARTY 2025</div>
                        </td>
                    </tr>

                    {{-- Hero --}}
                    <tr>
                        <td style="padding:40px 40px 20px; text-align:center;">
                            <div style="font-size:11px; color:#D4AF37; letter-spacing:3px; margin-bottom:12px;">PAYMENT CONFIRMED</div>
                            <h1 style="margin:0 0 16px; font-size:36px; color:#D4AF37; font-weight:900; letter-spacing:2px;">YOU'RE IN.</h1>
                            <p style="margin:0 0 8px; color:#6B6B6B; font-size:14px; line-height:1.6;">
                                Hey {{ $order->customer_name }},<br>
                                Your {{ $order->tickets->count() }} ticket(s) for ELITE BLOCK PARTY 2025 are attached below.
                            </p>
                        </td>
                    </tr>

                    {{-- Order info --}}
                    <tr>
                        <td style="padding:20px 40px;">
                            <table width="100%" style="background:#050505; border:1px solid #1A1A1A; padding:20px;">
                                <tr>
                                    <td style="padding:8px 0; color:#6B6B6B; font-size:11px; letter-spacing:2px;">ORDER REF</td>
                                    <td style="padding:8px 0; color:#F5F5F0; font-size:13px; font-weight:bold; text-align:right;">{{ $order->reference }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0; color:#6B6B6B; font-size:11px; letter-spacing:2px;">AMOUNT PAID</td>
                                    <td style="padding:8px 0; color:#D4AF37; font-size:13px; font-weight:bold; text-align:right;">{{ $order->formatted_total }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0; color:#6B6B6B; font-size:11px; letter-spacing:2px;">EVENT DATE</td>
                                    <td style="padding:8px 0; color:#F5F5F0; font-size:13px; font-weight:bold; text-align:right;">Dec 20, 2025 • 6 PM</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0; color:#6B6B6B; font-size:11px; letter-spacing:2px;">VENUE</td>
                                    <td style="padding:8px 0; color:#F5F5F0; font-size:13px; font-weight:bold; text-align:right;">Eko Hotel Grounds, Lagos</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Tickets --}}
                    <tr>
                        <td style="padding:20px 40px;">
                            <div style="font-size:11px; color:#D4AF37; letter-spacing:3px; margin-bottom:16px;">YOUR TICKETS</div>

                            @foreach ($order->tickets as $ticket)
                                <table width="100%" style="background:#050505; border:1px solid #1A1A1A; margin-bottom:10px;">
                                    <tr>
                                        <td style="padding:16px 20px;">
                                            <div style="font-size:10px; color:#D4AF37; letter-spacing:2px; margin-bottom:4px;">
                                                {{ strtoupper($ticket->ticketType->name ?? 'TICKET') }}
                                            </div>
                                            <div style="font-size:16px; color:#F5F5F0; font-weight:bold; font-family:monospace;">
                                                {{ $ticket->ticket_code }}
                                            </div>
                                        </td>
                                        <td style="padding:16px 20px; text-align:right; vertical-align:middle;">
                                            <div style="font-size:10px; color:#6B6B6B; letter-spacing:1px;">
                                                QR IN PDF ⬇
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            @endforeach
                        </td>
                    </tr>

                    {{-- CTA --}}
                    <tr>
                        <td style="padding:20px 40px 40px; text-align:center;">
                            <a href="{{ url('/my-tickets') }}"
                               style="display:inline-block; background:#D4AF37; color:#050505; padding:16px 40px; font-weight:bold; letter-spacing:2px; text-decoration:none; font-size:13px;">
                                VIEW MY TICKETS
                            </a>
                            <p style="margin:24px 0 0; color:#6B6B6B; font-size:11px; line-height:1.6;">
                                Your QR codes are in the attached PDFs. Do not share them.<br>
                                Need help? Email hello@eliteblockparty.com
                            </p>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding:20px 40px; text-align:center; border-top:1px solid #1A1A1A;">
                            <p style="margin:0; color:#6B6B6B; font-size:10px; letter-spacing:1px;">
                                © {{ date('Y') }} ELITE BLOCK PARTY • Lagos, Nigeria
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>