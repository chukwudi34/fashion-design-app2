<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    {{-- <title>{{ $subject }}</title> --}}
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: #3498db;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px 20px;
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-top: none;
        }

        .greeting {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .message-content {
            margin-bottom: 30px;
            line-height: 1.7;
        }

        hr {
            border: none;
            border-top: 1px solid #e9ecef;
            margin: 30px 0;
        }

        .signature {
            text-align: center;
            color: #2c3e50;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
            background: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
        </div>

        <div class="content">
            <h2 class="greeting">Dear {{ $customer->name }},</h2>
            <div class="message-content">
                {!! nl2br(e($content)) !!}
            </div>

            <hr>
            <div class="signature">
                <p><strong>Best regards,</strong></p>
                <p>{{ config('app.name') }} Team</p>
            </div>
        </div>

        <div class="footer">
            <p>This is an automated email. Please do not reply to this address.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
