<!DOCTYPE html>
<html><head><meta charset="UTF-8"></head>
<body style="margin:0; padding:0; background:#050505; font-family:Arial,sans-serif; color:#F5F5F0;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#050505; padding:40px 20px;">
<tr><td align="center">
<table width="600" style="max-width:600px; background:#0A0A0A; border:1px solid #D4AF37;">
<tr><td style="padding:40px; text-align:center; border-bottom:1px solid #1A1A1A;">
<div style="font-size:28px; font-weight:900; color:#D4AF37; letter-spacing:5px;">ELITE</div>
<div style="font-size:10px; color:#D4AF37; letter-spacing:4px; margin-top:6px;">APPLICATION APPROVED ✅</div>
</td></tr>
<tr><td style="padding:40px;">
<h1 style="margin:0 0 16px; color:#D4AF37; font-size:32px;">You're in!</h1>
<p style="color:#A0A0A0; font-size:14px; line-height:1.7; margin:0 0 24px;">
Congrats {{ $application->contact_name }} — your <strong style="color:#D4AF37;">{{ strtoupper($application->type) }}</strong> application for ELITE BLOCK PARTY 2025 has been approved.
</p>
@if($application->admin_notes)
<div style="background:#050505; border-left:3px solid #D4AF37; padding:16px; margin-bottom:24px;">
<div style="color:#D4AF37; font-size:10px; letter-spacing:2px; margin-bottom:6px;">NOTE FROM OUR TEAM</div>
<div style="color:#F5F5F0; font-size:13px; line-height:1.6;">{{ $application->admin_notes }}</div>
</div>
@endif
<p style="color:#A0A0A0; font-size:14px;">We'll be in touch with next steps shortly.</p>
</td></tr>
<tr><td style="padding:20px; text-align:center; border-top:1px solid #1A1A1A;">
<p style="color:#6B6B6B; font-size:10px;">© {{ date('Y') }} ELITE BLOCK PARTY</p>
</td></tr>
</table>
</td></tr>
</table>
</body></html>