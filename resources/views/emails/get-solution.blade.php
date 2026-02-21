<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Solar Solution Request</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #3ba14d 0%, #2d8f3f 100%);
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            margin: -30px -30px 30px -30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 150px 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }
        .info-label {
            font-weight: 600;
            color: #666;
            font-size: 14px;
        }
        .info-value {
            font-weight: 500;
            color: #333;
        }
        .service-badge {
            display: inline-block;
            background: #e8f5e8;
            color: #2d8f3f;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .details-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #3ba14d;
            margin-top: 20px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
        .urgent {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌞 New Solar Solution Request</h1>
        </div>

        <div class="urgent">
            <strong>🔔 Action Required:</strong> Customer needs assistance with their solar system. Please respond within 24 hours.
        </div>

        <div class="service-badge">
            Service Type: {{ $solutionData['service_type'] }}
        </div>

        <div class="info-grid">
            <div class="info-label">Customer Name:</div>
            <div class="info-value">{{ $solutionData['name'] }}</div>

            <div class="info-label">Mobile Number:</div>
            <div class="info-value">{{ $solutionData['mobile_number'] }}</div>

            @if(!empty($solutionData['email']))
            <div class="info-label">Email Address:</div>
            <div class="info-value">{{ $solutionData['email'] }}</div>
            @endif

            <div class="info-label">Pincode:</div>
            <div class="info-value">{{ $solutionData['pincode'] }}</div>

            <div class="info-label">Request Date:</div>
            <div class="info-value">{{ $solutionData['created_at']->format('d M Y, h:i A') }}</div>

            <div class="info-label">IP Address:</div>
            <div class="info-value">{{ $solutionData['ip_address'] }}</div>
        </div>

        @if(!empty($solutionData['details']))
        <div class="details-box">
            <h3 style="margin-top: 0; color: #2d8f3f;">📝 Additional Details</h3>
            <p style="margin: 10px 0; white-space: pre-wrap;">{{ $solutionData['details'] }}</p>
        </div>
        @endif

        <div class="footer">
            <p>This is an automated notification from SolarReviews.in</p>
            <p>Please log in to the admin panel for more details and to manage this request.</p>
        </div>
    </div>
</body>
</html>
