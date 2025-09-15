@include ('layouts.navbar')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking Details - Pawtopia</title>
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
    }
    
    .header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #6B4F3A;
        margin-bottom: 10px;
    }
    
    .header p {
        color: #9C6F4B;
        font-size: 1.1rem;
    }
    
    .booking-card {
        background: #f8f9fa;
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .booking-id {
        background: linear-gradient(135deg, #E57300, #D76A00);
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 20px;
    }
    
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .detail-item {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .detail-label {
        font-weight: 600;
        color: #6B4F3A;
        margin-bottom: 8px;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .detail-value {
        color: #9C6F4B;
        font-size: 1.1rem;
        font-weight: 500;
    }
    
    .status-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
    }
    
    .status-pending {
        background: linear-gradient(135deg, #FFF3CD, #FFF8DC);
        color: #856404;
    }
    
    .status-confirmed {
        background: linear-gradient(135deg, #D4EDDA, #C3E6CB);
        color: #155724;
    }
    
    .status-completed {
        background: linear-gradient(135deg, #E2E3E5, #F8F9FA);
        color: #383D41;
    }
    
    .status-cancelled {
        background: linear-gradient(135deg, #F8D7DA, #F5C6CB);
        color: #721C24;
    }
    
    .notes-section {
        background: white;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .notes-section h3 {
        color: #6B4F3A;
        margin-bottom: 15px;
    }
    
    .notes-content {
        color: #9C6F4B;
        line-height: 1.6;
        font-style: italic;
    }
    
    .action-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
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
    
    .btn-danger {
        background: linear-gradient(135deg, #DC3545, #C82333);
        color: white;
    }
    
    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(220, 53, 69, 0.3);
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }
        
        .header h1 {
            font-size: 2rem;
        }
        
        .detail-grid {
            grid-template-columns: 1fr;
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
    <div class="header">
        <h1>Booking Details</h1>
        <p>View your booking information and status</p>
    </div>
    
    <div class="booking-card">
        <div class="booking-id">Booking #{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</div>
        
        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">Service Type</div>
                <div class="detail-value">{{ ucfirst($booking->service_type) }}</div>
            </div>
            
            <div class="detail-item">
                <div class="detail-label">Pet Name</div>
                <div class="detail-value">{{ $booking->pet_name }}</div>
            </div>
            
            <div class="detail-item">
                <div class="detail-label">Pet Type</div>
                <div class="detail-value">{{ ucfirst($booking->pet_type) }}</div>
            </div>
            
            <div class="detail-item">
                <div class="detail-label">Booking Date</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</div>
            </div>
            
            <div class="detail-item">
                <div class="detail-label">Booking Time</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</div>
            </div>
            
            <div class="detail-item">
                <div class="detail-label">Total Price</div>
                <div class="detail-value">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
            </div>
            
            <div class="detail-item">
                <div class="detail-label">Status</div>
                <div class="detail-value">
                    <span class="status-badge status-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                </div>
            </div>
            
            <div class="detail-item">
                <div class="detail-label">Created At</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y H:i') }}</div>
            </div>
        </div>
        
        @if($booking->notes)
        <div class="notes-section">
            <h3>Special Notes</h3>
            <div class="notes-content">{{ $booking->notes }}</div>
        </div>
        @endif
    </div>
    
    <div class="action-buttons">
        <a href="{{ route('history') }}" class="btn btn-primary">Back to History</a>
        <a href="{{ route('booking') }}" class="btn btn-secondary">Make New Booking</a>
        @if($booking->status === 'pending')
            <form action="{{ route('booking.cancel', $booking) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel Booking</button>
            </form>
        @endif
    </div>
</div>

@include ('layouts.footer')
</body>
</html>
