<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="margin:0; padding:0; background:#050505; font-family:Arial,sans-serif; color:#F5F5F0;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#050505; padding:40px 20px;">
    <tr>
        <td align="center">
            <table width="600" style="max-width:600px; background:#0A0A0A; border:1px solid #D4AF37;">
                <tr>
                    <td style="padding:40px; text-align:center; border-bottom:1px solid #1A1A1A;">
                        <div style="font-size:28px; font-weight:900; color:#D4AF37; letter-spacing:5px;">ELITE</div>
                        <div style="font-size:10px; color:#D4AF37; letter-spacing:4px; margin-top:6px;">OFFICIAL ANNOUNCEMENT</div>
                    </td>
                </tr>
                <tr>
                    <td style="padding:40px;">
                        <div style="font-size:11px; color:#D4AF37; letter-spacing:2px; font-family:monospace; margin-bottom:12px;">
                            AUDIENCE: {{ strtoupper($announcement->audience) }}
                        </div>
                        <h1 style="margin:0 0 20px; color:#F5F5F0; font-size:26px; line-height:1.3;">
                            {{ $announcement->title }}
                        </h1>
                        <div style="color:#A0A0A0; font-size:15px; line-height:1.8; margin:0 0 30px; white-space:pre-line;">
                            {{ $announcement->body }}
                        </div>
                        <a href="{{ url('/announcements') }}" style="display:inline-block; background:#D4AF37; color:#050505; padding:14px 32px; font-weight:bold; text-decoration:none; letter-spacing:2px; font-size:12px;">
                            VIEW ANNOUNCEMENTS
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="padding:20px 40px; text-align:center; border-top:1px solid #1A1A1A;">
                        <p style="color:#6B6B6B; font-size:10px; letter-spacing:1px; margin:0;">
                            © {{ date('Y') }} ELITE BLOCK PARTY • LAGOS, NIGERIA
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
