<!DOCTYPE html>
<html><head><meta charset="UTF-8"></head>
<body style="margin:0; padding:0; background:#050505; font-family:Arial,sans-serif; color:#F5F5F0;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#050505; padding:40px 20px;">
<tr><td align="center">
<table width="600" style="max-width:600px; background:#0A0A0A; border:1px solid #1A1A1A;">
<tr><td style="padding:40px; text-align:center; border-bottom:1px solid #1A1A1A;">
<div style="font-size:28px; font-weight:900; color:#D4AF37; letter-spacing:5px;">ELITE</div>
<div style="font-size:10px; color:#6B6B6B; letter-spacing:4px; margin-top:6px;">APPLICATION RECEIVED</div>
</td></tr>
<tr><td style="padding:40px;">
<h1 style="margin:0 0 16px; color:#D4AF37; font-size:28px;">Thanks, {{ $application->contact_name }}.</h1>
<p style="color:#A0A0A0; font-size:14px; line-height:1.7; margin:0 0 24px;">
We've received your <strong style="color:#D4AF37;">{{ strtoupper($application->type) }}</strong> application for ELITE BLOCK PARTY 2025.
Our team reviews every submission manually. Expect to hear from us within <strong style="color:#F5F5F0;">5–7 business days</strong>.
</p>
<div style="background:#050505; border:1px solid #1A1A1A; padding:20px; margin-bottom:24px;">
<div style="color:#6B6B6B; font-size:10px; letter-spacing:2px; margin-bottom:6px;">REFERENCE</div>
<div style="color:#F5F5F0; font-family:monospace; font-size:14px;">{{ strtoupper(substr($application->uuid, 0, 8)) }}</div>
</div>
<p style="color:#6B6B6B; font-size:12px;">Questions? Reply to this email or WhatsApp us.</p>
</td></tr>
<tr><td style="padding:20px; text-align:center; border-top:1px solid #1A1A1A;">
<p style="color:#6B6B6B; font-size:10px; letter-spacing:1px; margin:0;">© {{ date('Y') }} ELITE BLOCK PARTY</p>
</td></tr>
</table>
</td></tr>
</table>
</body></html>