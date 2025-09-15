<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Booking History</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #F7F5F2; /* match site background to avoid clash */
      margin: 0;
      padding: 0; /* avoid affecting navbar spacing */
      color: #5a3b2e;
    }

    .container {
      width: 90%;
      margin: 0 auto;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      padding: 20px;
      overflow: hidden; /* biar radius kepotong rapi */
    }

    .title {
      font-size: 20px;
      font-weight: 600;
      color: #674337;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.12); /* 👉 shadow buat tabel */
      background: #fff; /* pastikan background solid biar shadow kelihatan */
    }

    thead th {
      background: #F6A892;
      color: #674337;
      font-weight: 600;
      padding: 12px;
      text-align: center;
    }

    tbody tr {
      background: #fff8f5;
      transition: background 0.2s ease;
    }

    tbody tr:hover {
      background: #ffece5;
    }

    tbody td {
      padding: 14px;
      text-align: center;
      border-bottom: 1px solid #F2E1C9; /* only bottom border for cleaner look */
    }

    /* Rounded corners hanya di pinggir tabel */
    thead tr:first-child th:first-child {
      border-top-left-radius: 20px;
    }
    thead tr:first-child th:last-child {
      border-top-right-radius: 20px;
    }
    tbody tr:last-child td:first-child {
      border-bottom-left-radius: 20px;
    }
    tbody tr:last-child td:last-child {
      border-bottom-right-radius: 20px;
    }

    /* Status Badges */
    /* Status Badges (match other pages) */
    .status {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      height: 34px;
      min-width: 140px;
      padding: 0 16px;
      border-radius: 22px;
      font-size: 12px;
      font-weight: 700;
      letter-spacing: .5px;
      text-transform: uppercase;
      box-sizing: border-box;
    }

    .status.ongoing {
      background: linear-gradient(135deg, #FFE0B2, #F9D9A7);
      color: #6B4F3A;
      border: 1px solid #F5CBA7;
    }

    .status.complete {
      background: linear-gradient(135deg, #E2E3E5, #F8F9FA);
      color: #383D41;
      border: 1px solid #DEE2E6;
    }

    /* Buttons */
    .btn {
      display: inline-block;
      padding: 6px 16px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 500;
      text-decoration: none;
      transition: 0.2s;
    }

    .btn-rate {
      background: #ff8a65;
      color: #fff;
    }

    .btn-rate:hover {
      background: #ff7043;
    }

    .btn-disabled {
      background: #e0e0e0;
      color: #888;
      cursor: not-allowed;
      pointer-events: none;
    }

    /* Responsive Style */
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }

      thead {
        display: none;
      }

      tr {
        margin-bottom: 15px;
        border-radius: 16px;
        padding: 12px;
        background: #fff8f5;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      }

      td {
        border: none;
        padding: 10px 0;
        text-align: left;
      }

      td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #ff8a65;
        display: block;
        margin-bottom: 3px;
        font-size: 13px;
      }
    }
  </style>
</head>
  <body>
    @include('layouts.navbar')
    <div class="page-wrapper" style="padding: 30px;">
      <div class="container">
      <div class="title">
        <img src="{{ asset('images/Time Machine.svg') }}" alt="" width="30" height="30" style="margin-right:8px;">
        Booking History
      </div>

      <table id="bookingTable">
        <thead>
          <tr>
            <th>No</th>
            <th>Service</th>
            <th>Pet</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($bookings as $index => $booking)
            @php
              $isComplete = strtolower($booking->status) === 'completed';
              $statusClass = $isComplete ? 'complete' : 'ongoing';
            @endphp
            <tr>
              <td data-label="No">{{ $index + 1 }}</td>
              <td data-label="Service">{{ ucfirst($booking->service_type) }}</td>
              <td data-label="Pet">{{ $booking->pet_name }} ({{ ucfirst($booking->pet_type) }})</td>
              <td data-label="Date">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
              <td data-label="Time">{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</td>
              <td data-label="Status">
                <span class="status {{ $statusClass }}">{{ ucfirst($booking->status) }}</span>
              </td>
              <td data-label="Price">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
              <td data-label="Actions">
                <div style="display: flex; gap: 8px; justify-content: center;">
                  <a href="{{ route('booking.show', $booking) }}" class="btn btn-rate" style="background: #17a2b8; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 12px;">View</a>
                  @if($booking->status === 'pending')
                    <form action="{{ route('booking.cancel', $booking) }}" method="POST" style="display: inline;">
                      @csrf
                      <button type="submit" class="btn btn-disabled" style="background: #dc3545; color: white; padding: 6px 12px; border-radius: 4px; border: none; font-size: 12px; cursor: pointer;" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel</button>
                    </form>
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" style="text-align:center; padding:20px; color:#9C6F4B;">
                <div style="padding: 40px;">
                  <img src="{{ asset('images/Time Machine.svg') }}" alt="No bookings" style="width: 60px; height: 60px; margin-bottom: 15px; opacity: 0.5;">
                  <div style="font-size: 18px; font-weight: 600; margin-bottom: 10px;">No bookings yet</div>
                  <div style="font-size: 14px; color: #9C6F4B;">You haven't made any bookings yet. Start by booking a service for your pet!</div>
                  <a href="{{ route('booking') }}" style="display: inline-block; margin-top: 15px; padding: 10px 20px; background: #E57300; color: white; text-decoration: none; border-radius: 8px; font-weight: 600;">Make a Booking</a>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    </div>
    @include('layouts.footer')
    
  </body>
  </html>
