<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New {{ $type }} Notification</title>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #334155; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); text-align: center; }
        h1 { color: #0f172a; font-size: 24px; margin-bottom: 20px; }
        p { font-size: 16px; line-height: 1.6; color: #475569; margin-bottom: 20px; }
        .btn { display: inline-block; padding: 12px 24px; background-color: #00d4ff; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; }
        .footer { margin-top: 30px; font-size: 12px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="container">
        <h1>New {{ $type }} Published!</h1>
        <p>Hi there,</p>
        <p>I just posted a new {{ strtolower($type) }} on my portfolio: <strong>{{ $title }}</strong>.</p>
        <p>Click the button below to check it out!</p>
        <a href="{{ $url }}" class="btn">View {{ $type }}</a>
        <div class="footer">
            <p>You received this email because you subscribed to updates on Imran Developer.</p>
        </div>
    </div>
</body>
</html>
