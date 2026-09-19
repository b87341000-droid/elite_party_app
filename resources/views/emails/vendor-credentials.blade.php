<!DOCTYPE html>
<html><head><meta charset="UTF-8"></head>
<body style="margin:0; padding:0; background:#050505; font-family:Arial,sans-serif; color:#F5F5F0;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#050505; padding:40px 20px;">
<tr><td align="center">
<table width="600" style="max-width:600px; background:#0A0A0A; border:1px solid #D4AF37;">
<tr><td style="padding:40px; text-align:center; border-bottom:1px solid #1A1A1A;">
<div style="font-size:28px; font-weight:900; color:#D4AF37; letter-spacing:5px;">ELITE</div>
<div style="font-size:10px; color:#D4AF37; letter-spacing:4px; margin-top:6px;">VENDOR ACCOUNT READY</div>
</td></tr>
<tr><td style="padding:40px;">
<h1 style="margin:0 0 16px; color:#D4AF37; font-size:26px;">Welcome, {{ $user->name }}</h1>
<p style="color:#A0A0A0; font-size:14px; line-height:1.7; margin:0 0 24px;">
Your vendor account is live. Use the credentials below to log in and manage your stall.
</p>
<div style="background:#050505; border:1px solid #1A1A1A; padding:20px; margin-bottom:24px;">
<div style="color:#6B6B6B; font-size:10px; letter-spacing:2px; margin-bottom:6px;">EMAIL</div>
<div style="color:#F5F5F0; font-family:monospace; font-size:13px; margin-bottom:16px;">{{ $user->email }}</div>
<div style="color:#6B6B6B; font-size:10px; letter-spacing:2px; margin-bottom:6px;">TEMPORARY PASSWORD</div>
<div style="color:#D4AF37; font-family:monospace; font-size:16px; font-weight:bold;">{{ $password }}</div>
</div>
<p style="color:#E11D2E; font-size:12px;">⚠️ Change your password after first login.</p>
<a href="{{ url('/login') }}" style="display:inline-block; background:#D4AF37; color:#050505; padding:14px 32px; font-weight:bold; text-decoration:none; letter-spacing:2px; font-size:12px; margin-top:16px;">LOG IN NOW</a>
</td></tr>
<tr><td style="padding:20px; text-align:center; border-top:1px solid #1A1A1A;">
<p style="color:#6B6B6B; font-size:10px;">© {{ date('Y') }} ELITE BLOCK PARTY</p>
</td></tr>
</table>
</td></tr>
</table>
</body></html>