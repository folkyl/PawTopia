<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
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
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Information</th>
            <th>Review</th>
          </tr>
        </thead>
        <tbody>
          @forelse(($bookings ?? []) as $index => $b)
            @php
              $start = $b['start_date'] ?? $b['startDate'] ?? '';
              $end = $b['end_date'] ?? $b['endDate'] ?? '';
              $status = $b['status'] ?? '';
              $review = $b['review'] ?? '';
              $isComplete = strtolower($status) === 'complete' || strtolower($status) === 'completed';
              $statusClass = $isComplete ? 'complete' : 'ongoing';
            @endphp
            <tr>
              <td data-label="No">{{ $index + 1 }}</td>
              <td data-label="Start Date">{{ $start }}</td>
              <td data-label="End Date">{{ $end }}</td>
              <td data-label="Status"><span class="status {{ $statusClass }}">{{ $status ?: '-' }}</span></td>
              <td data-label="Information">
                @if ($isComplete)
                  <a href="#" class="btn btn-rate">Rate Us</a>
                @else
                  <a class="btn btn-disabled">Rate Us</a>
                @endif
              </td>
              <td data-label="Review">{{ $review ?: '-' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align:center; padding:20px; color:#9C6F4B;">No booking data.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    </div>
    @include('layouts.footer')
    
  </body>
  </html>
