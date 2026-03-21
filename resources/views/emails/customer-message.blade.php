<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #3498db;">{{ $subject }}</h2>
        
        <p>Dear {{ $customer->name }},</p>
        
        <p>{{ $content }}</p>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
        
        <p style="color: #666; font-size: 14px;">
            Best regards,<br>
            Fashion Design Team
        </p>
        
        <p style="color: #999; font-size: 12px; margin-top: 30px;">
            This is an automated message from Fashion Design App.
        </p>
    </div>
</body>
</html>