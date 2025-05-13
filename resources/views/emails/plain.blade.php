<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eaeaea;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 150px;
            height: auto;
        }
        .content {
            padding: 20px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eaeaea;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #d4a762;
            color: white !important;
            text-decoration: none;
            border-radius: 4px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Guzana Restaurant</h1>
    </div>

    <div class="content">
        <h2>{{ $subject }}</h2>
        
        <p>Guten Tag,</p>
        
        <p>{!! nl2br(e($body)) !!}</p>
        
        @if(isset($order))
        <div style="margin: 20px 0; padding: 15px; background: #f9f9f9; border-left: 4px solid #d4a762;">
            <h3>Bestelldetails:</h3>
            <p><strong>Name:</strong> {{ $order->user_name  }}</p>
            <p><strong>Personen:</strong> {{ $order->number_of_seats   }}</p>
            <p><strong>Datum:</strong> {{ $order->date }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        </div>
        @endif
        
        <p>Mit freundlichen Grüßen <br>
        Ihr Guzana Restaurant Team</p>
    </div>

    <div class="footer">
        <p><strong>Kontaktinformationen:</strong></p>
        <p>Telefon: 0176 41512034</p>
        <p>Adresse: Guzana Restaurant, Pfortener Straße 13A, 07545 Gera</p>
        <p>© {{ date('Y') }} Guzana Restaurant. Alle Rechte vorbehalten.</p>
    </div>
</body>
</html>