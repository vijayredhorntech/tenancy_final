<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Document Notification</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2563eb;">Document Notification from {{ $agency->agency_name }}</h2>

        <p>Hello,</p>

        <div style="background-color: #f8fafc; padding: 15px; border-left: 4px solid #2563eb; margin: 20px 0;">
            {{ $message }}
        </div>

        @if(isset($document))
        <div style="background-color: #f8fafc; padding: 15px; margin: 20px 0; border: 1px solid #e2e8f0; border-radius: 8px;">
            <h3 style="color: #2563eb; margin-top: 0;">Document Details:</h3>
            <p><strong>Client:</strong> {{ $document->client->client_name ?? 'N/A' }}</p>
            <p><strong>Document Name:</strong> {{ $document->document_name }}</p>
            <p><strong>Received On:</strong> {{ $document->received_on ? $document->received_on->format('Y-m-d H:i:s') : 'N/A' }}</p>
            @if($document->remarks)
            <p><strong>Remarks:</strong> {{ $document->remarks }}</p>
            @endif
        </div>
        @endif

        <p>This message was sent from {{ $agency->agency_name }}.</p>

        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 30px 0;">
        <p style="font-size: 12px; color: #666;">
            This is an automated message. Please do not reply to this email.
        </p>
    </div>
</body>
</html>
