<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Solar Enquiry</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #3ba14c, #2d8f3e);
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 0 0 8px 8px;
        }
        .field {
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .field-label {
            font-weight: 600;
            color: #3ba14c;
            margin-bottom: 5px;
        }
        .field-value {
            color: #555;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>🌞 New Solar Enquiry</h2>
    </div>
    
    <div class="content">
        <div class="field">
            <div class="field-label">Customer Name:</div>
            <div class="field-value">{{ $enquiry->name }}</div>
        </div>
        
        <div class="field">
            <div class="field-label">Mobile Number:</div>
            <div class="field-value">{{ $enquiry->mobile_number }}</div>
        </div>
        
        @if($enquiry->email)
        <div class="field">
            <div class="field-label">Email:</div>
            <div class="field-value">{{ $enquiry->email }}</div>
        </div>
        @endif
        
        <div class="field">
            <div class="field-label">Capacity Required:</div>
            <div class="field-value">{{ $enquiry->capacity }} KW</div>
        </div>
        
        <div class="field">
            <div class="field-label">Category:</div>
            <div class="field-value">{{ $enquiry->category }}</div>
        </div>
        
        <div class="field">
            <div class="field-label">Net Metering:</div>
            <div class="field-value">{{ $enquiry->net_metering }}</div>
        </div>
        
        <div class="field">
            <div class="field-label">Installation Type:</div>
            <div class="field-value">{{ $enquiry->type }}</div>
        </div>
        
        @if($enquiry->type === 'Tin Shed' && $enquiry->tin_shed_age)
        <div class="field">
            <div class="field-label">Tin Shed Age:</div>
            <div class="field-value">{{ $enquiry->tin_shed_age }} years</div>
        </div>
        @endif
        
        @if($enquiry->type === 'Groundmount')
            @if($enquiry->distance_from_substation)
            <div class="field">
                <div class="field-label">Distance from Substation:</div>
                <div class="field-value">{{ $enquiry->distance_from_substation }} Kms</div>
            </div>
            @endif
            
            @if($enquiry->line)
            <div class="field">
                <div class="field-label">Line Type:</div>
                <div class="field-value">{{ $enquiry->line }} KV</div>
            </div>
            @endif
        @endif
        
        @if($enquiry->notes)
        <div class="field">
            <div class="field-label">Additional Requirements:</div>
            <div class="field-value">{{ nl2br(e($enquiry->notes)) }}</div>
        </div>
        @endif
        
        <div class="field">
            <div class="field-label">IP Address:</div>
            <div class="field-value">{{ $enquiry->ip_address }}</div>
        </div>
        
        <div class="field">
            <div class="field-label">Submitted Date:</div>
            <div class="field-value">{{ $enquiry->created_at->format('d M Y, H:i A') }}</div>
        </div>
    </div>
    
    <div class="footer">
        <p>This enquiry was submitted via Solar Reviews website</p>
        <p>Please contact the customer as soon as possible.</p>
    </div>
</body>
</html>
