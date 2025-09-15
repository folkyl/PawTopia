@include ('layouts.navbar')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking Success - Pawtopia</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #fff;
        margin: 0;
        padding: 0;
        color: #674337;
    }
    .container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        text-align: center;
    }
    
    .success-icon {
        width: 120px;
        height: 120px;
        margin: 40px auto 30px;
        background: linear-gradient(135deg, #4CAF50, #45a049);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
        color: white;
        box-shadow: 0 8px 32px rgba(76, 175, 80, 0.3);
    }
    
    .success-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #4CAF50;
        margin-bottom: 15px;
    }
    
    .success-message {
        font-size: 1.2rem;
        color: #9C6F4B;
        margin-bottom: 40px;
        line-height: 1.6;
    }
    
    .booking-details {
        background: #f8f9fa;
        border-radius: 16px;
        padding: 30px;
        margin: 30px 0;
        text-align: left;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #e9ecef;
    }
    
    .detail-row:last-child {
        border-bottom: none;
    }
    
    .detail-label {
        font-weight: 600;
        color: #6B4F3A;
    }
    
    .detail-value {
        color: #9C6F4B;
        font-weight: 500;
    }
    
    .status-badge {
        background: linear-gradient(135deg, #FFE0B2, #F9D9A7);
        color: #6B4F3A;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .next-steps {
        background: linear-gradient(135deg, #E3F2FD, #BBDEFB);
        border-radius: 16px;
        padding: 30px;
        margin: 30px 0;
    }
    
    .next-steps h3 {
        color: #1976D2;
        margin-bottom: 20px;
        font-size: 1.5rem;
    }
    
    .step {
        display: flex;
        align-items: center;
        margin: 15px 0;
        padding: 15px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .step-number {
        width: 40px;
        height: 40px;
        background: #1976D2;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        margin-right: 15px;
        flex-shrink: 0;
    }
    
    .step-text {
        color: #6B4F3A;
        font-weight: 500;
    }
    
    .action-buttons {
        margin-top: 40px;
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .btn {
        padding: 15px 30px;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #E57300, #D76A00);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(229, 115, 0, 0.3);
    }
    
    .btn-secondary {
        background: white;
        color: #6B4F3A;
        border: 2px solid #E57300;
    }
    
    .btn-secondary:hover {
        background: #E57300;
        color: white;
        transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }
        
        .success-title {
            font-size: 2rem;
        }
        
        .detail-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }
        
        .action-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .btn {
            width: 100%;
            max-width: 300px;
        }
    }
</style>
</head>
<body>

<div class="container">
    <div class="success-icon">✓</div>
    
    <h1 class="success-title">Booking Confirmed!</h1>
    <p class="success-message">
        Thank you for choosing Pawtopia! Your booking has been successfully submitted and is now pending confirmation.
    </p>
    
    <div class="booking-details">
        <h3 style="color: #6B4F3A; margin-bottom: 20px; text-align: center;">Booking Details</h3>
        
        <div class="detail-row">
            <span class="detail-label">Booking ID:</span>
            <span class="detail-value">#BK{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Service Type:</span>
            <span class="detail-value">{{ ucfirst($booking->service_type) }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Pet Name:</span>
            <span class="detail-value">{{ $booking->pet_name }} ({{ ucfirst($booking->pet_type) }})</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Booking Date:</span>
            <span class="detail-value">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Booking Time:</span>
            <span class="detail-value">{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Total Price:</span>
            <span class="detail-value">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
        </div>
        
        <div class="detail-row">
            <span class="detail-label">Status:</span>
            <span class="status-badge">{{ ucfirst($booking->status) }}</span>
        </div>
        
        @if($booking->notes)
        <div class="detail-row">
            <span class="detail-label">Notes:</span>
            <span class="detail-value">{{ $booking->notes }}</span>
        </div>
        @endif
    </div>
    
    <div class="next-steps">
        <h3>What happens next?</h3>
        
        <div class="step">
            <div class="step-number">1</div>
            <div class="step-text">Our team will review your booking within 2 hours</div>
        </div>
        
        <div class="step">
            <div class="step-number">2</div>
            <div class="step-text">You'll receive a confirmation call within 24 hours</div>
        </div>
        
        <div class="step">
            <div class="step-number">3</div>
            <div class="step-text">We'll send you a preparation guide via email</div>
        </div>
        
        <div class="step">
            <div class="step-number">4</div>
            <div class="step-text">Payment will be collected on the service date</div>
        </div>
    </div>
    
    <div class="action-buttons">
        <a href="{{ route('history') }}" class="btn btn-primary">View Booking History</a>
        <a href="{{ route('home') }}" class="btn btn-secondary">Back to Home</a>
    </div>
</div>

@include ('layouts.footer')
</body>
</html>
