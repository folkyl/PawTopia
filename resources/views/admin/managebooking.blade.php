@extends('layouts.app')
@include ('layoutadmin.navbar')

@section('content')
<div class="dashboard-root">
    <!-- Main Content -->
     
    <main class="dashboard-main">
        <!-- Header (reused component with profile + notification) -->
        <x-dashboard-header 
            title="Booking Management"
            subtitle="Pet Boarding Reservations & Bookings"
            icon="calendar"
        />

       
        <!-- Main Content Card -->
        <div class="content-card">
            <!-- Header with Search and Filters -->
            <div class="content-header">
                <div class="content-info">
                    <div class="content-title">Booking Management</div>
                    <div class="content-subtitle">Manage pet boarding reservations and bookings</div>
                </div>
                <div class="content-controls">
                    <!-- Status Filter -->
                    <select id="statusFilter" class="filter-select">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="checked-in">Checked In</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="on-pickup">On Pickup</option>
                        

                    </select>
                    <!-- Search Bar -->
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" id="searchInput" placeholder="Cari booking..." class="search-input">
                    </div>
                    <!-- Add Booking Button -->
                    <button type="button" class="action-btn btn-add" onclick="openAddBookingModal()">
                        <i class="bi bi-plus-lg"></i> Tambah Booking
                    </button>
                </div>
            </div>

            <!-- Booking Table -->
            <div class="table-container">
                <table class="booking-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Pet Name</th>
                            <th>Check-in Date</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="bookingTableBody">
                        <!-- Booking rows will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- No Bookings Message -->
            <div id="noBookingsMessage" class="no-data-message" style="display:none;">
                <div class="no-data-icon">
                    <i class="bi bi-calendar-x"></i>
                </div>
                <div class="no-data-title">No bookings found</div>
                <div class="no-data-subtitle">No bookings available at this time.</div>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                <div id="paginationContainer" class="pagination-container"></div>
                <div id="pageInfo" class="page-info"></div>
            </div>

            <style>
                /* Pagination */
                .pagination-wrapper {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    margin-top: 32px;
                }

                .pagination-container {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    gap: 10px;
                }

                .pagination-btn {
                    width: 44px;
                    height: 44px;
                    border-radius: 12px;
                    border: 1px solid rgba(0,0,0,0.1);
                    background: linear-gradient(135deg, #FFE0B2, #FFCC99);
                    color: #6B4F3A;
                    font-weight: 600;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    transition: all 0.2s ease;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                }

                .pagination-btn:hover { 
                    transform: translateY(-2px); 
                    box-shadow: 0 8px 24px rgba(230,161,93,0.22);
                    background: linear-gradient(135deg, #FFE4B5, #FFD1A3);
                }

                .pagination-btn.active { 
                    background: linear-gradient(135deg, #E57300, #D76A00); 
                    color: #fff; 
                    border-color: #D76A00; 
                    box-shadow: 0 8px 24px rgba(229,115,0,0.28); 
                }

                .pagination-btn:disabled {
                    background: linear-gradient(135deg, #E57300, #D76A00);
                    color: #fff;
                    border-color: #D76A00;
                    cursor: not-allowed;
                    box-shadow: none;
                    opacity: 0.6;
                }

                .pagination-btn:disabled:hover { 
                    transform: none; 
                    box-shadow: none; 
                }

                .pagination-dots {
                    padding: 10px 14px;
                    color: #A97B5D;
                    font-weight: 600;
                }
                
                .page-info {
                    text-align: center;
                    margin-top: 15px;
                    color: #6B4F3A;
                    font-size: 14px;
                    line-height: 1.5;
                }

                @media (max-width: 768px) {
                    .pagination-btn { 
                        width: 40px; 
                        height: 40px; 
                    }
                }
            </style>

           
        </div>
    </main>
</div>

<!-- Booking Detail Modal -->
<div id="bookingModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Booking Details</h3>
            <span class="modal-close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body" id="modalBody">
            <!-- Booking details will be loaded here -->
        </div>
    </div>
</div>

<!-- Add Booking Modal -->
<div id="addBookingModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Booking</h3>
            <span class="modal-close" onclick="closeAddBookingModal()">&times;</span>
        </div>
        <div class="modal-body">
            <form id="addBookingForm" class="form-grid">
                <div class="form-field">
                    <label>Customer Name</label>
                    <input type="text" name="customer" required />
                </div>
                <div class="form-field">
                    <label>Pet Name</label>
                    <input type="text" name="pet" required />
                </div>
                <div class="form-field">
                    <label>Pet Type</label>
                    <select name="petType" required>
                        <option value="Dog">Dog</option>
                        <option value="Cat">Cat</option>
                    </select>
                </div>
                <div class="form-field">
                    <label>Phone</label>
                    <input type="tel" name="phone" required />
                </div>
                <div class="form-field">
                    <label>Email</label>
                    <input type="email" name="email" />
                </div>
                <div class="form-field">
                    <label>Service</label>
                    <select name="service" required>
                        <option value="Drop Off">Drop Off</option>
                        <option value="Pet Pickup">Pet Pickup</option>
                    </select>
                </div>
                <div class="form-field">
                    <label>Check-in</label>
                    <input type="date" name="checkin" required />
                </div>
                <div class="form-field">
                    <label>Check-out</label>
                    <input type="date" name="checkout" required />
                </div>
                <div class="form-field">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="checked-in">Checked In</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="on-pickup">On Pickup</option>
                    </select>
                </div>
                <div class="form-field">
                    <label>Total Price (Rp)</label>
                    <input type="number" name="price" min="0" step="1000" value="0" required />
                </div>
                <div class="form-actions">
                    <button type="button" class="action-btn btn-delete" onclick="closeAddBookingModal()">Batal</button>
                    <button type="submit" class="action-btn btn-add">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    
</div>
<!-- MODAL NOTIFICATION -->
<div class="notification-modal" id="notificationModal">
    <div class="notification-content">
        <div class="notification-header">
            <h3>Notifikasi</h3>
            <button onclick="toggleNotificationModal()">&times;</button>
        </div>

        <div id="notificationList">
            <div class="notification-item unread">
                <h4>Booking Baru</h4>
                <p>User melakukan booking hari ini</p>
            </div>
            <div class="notification-item unread">
                <h4>Pembayaran Diterima</h4>
                <p>Transaksi #123 berhasil</p>
            </div>
            <div class="notification-item">
                <h4>Testimoni Baru</h4>
                <p>Ada ulasan dari pelanggan</p>
            </div>
        </div>

        <div class="notification-footer">
            <button onclick="markAllAsRead()">Tandai Semua Dibaca</button>
        </div>
    </div>
</div>
<style>
      .dashboard-card:hover {
        transform: translateY(-2px);
    }

    .dashboard-sidebar a:hover {
        transform: translateX(2px);
    }

    @media (max-width: 1200px) {
        .dashboard-stats-row {
            grid-template-columns: repeat(2, 1fr);
        }

      

        .dashboard-sidebar {
            width: 100%;
            border-radius: 0;
            border-bottom-left-radius: 24px;
            border-bottom-right-radius: 24px;
        }
    }

    @media (max-width: 768px) {
        .dashboard-stats-row {
            grid-template-columns: 1fr;
        }

        .dashboard-main {
            padding: 20px 16px;
        }

        .dashboard-header {
            flex-direction: column;
            gap: 16px;
            text-align: center;
        }

        .dashboard-header h1 {
            font-size: 1.5rem;
        }
    }
/* Root Styles - Same as Testimonial */
.dashboard-root {
    display: flex;
    min-height: 100vh;
    background: #EAE6E1;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.dashboard-main {
    flex: 1;
    padding: 40px 32px 32px 32px;
    max-width: 100%;
    margin-left: 250px;
    /* prevent overlap with fixed sidebar (see layoutadmin.navbar width:250px) */
}

/* Header - Same as Testimonial */
.dashboard-header {
    background: #fff;
    border-radius: 24px;
    padding: 24px 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
    box-shadow: 0 8px 32px rgba(230, 161, 93, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.header-left {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.header-title {
    font-size: 2.2rem;
    font-weight: 800;
    color: #6B4F3A;
    letter-spacing: -0.02em;
}

.header-subtitle {
    color: #A97B5D;
    font-size: 1rem;
    font-weight: 500;
}

.header-profile {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notification-icon {
            position: relative;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transition: all 0.2s ease;
        }
        
        .notification-img {
            width: 24px;
            height: 24px;
            object-fit: contain;
        }

        .notification-icon:hover {
            background: #f5f5f5;
        }

        .notification-icon .badge {
            position: absolute;
            top: -6px;
            right: -8px;
            background: #E63946;
            color: #fff;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 50%;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 16px 6px 6px;
            border-radius: 50px;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.05);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .profile-info:hover {
            background: #f9f9f9;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .profile-info img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #E57300;
        }

        .profile-details {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .profile-name {
            font-weight: 600;
            color: #333;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .profile-email {
            font-size: 0.75rem;
            color: #888;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 180px;
        }

        .profile-details {
            line-height: 1.2;
        }

        .profile-name {
            font-weight: 700;
            color: #6B4F3A;
            font-size: 1rem;
            text-transform: capitalize;
        }

        .profile-role {
            font-size: 0.85rem;
            color: #A97B5D;
            font-weight: 500;
        }

        .profile-notification {
            position: absolute;
            top: -5px;
            right: -5px;
            cursor: pointer;
        }

        .notification-icon {
            font-size: 20px;
            color: #6B4F3A;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -8px;
            background: #E57300;
            color: #fff;
            font-size: 10px;
            font-weight: bold;
            padding: 2px 5px;
            border-radius: 50%;
            min-width: 16px;
            height: 16px;
            text-align: center;
            line-height: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
         /* Notification Modal */
         .notification-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.3);
            justify-content: flex-end;
            z-index: 2000;
        }

        .notification-modal.show {
            display: flex;
        }

        .notification-content {
            width: 380px;
            background: #fff;
            height: 100%;
            padding: 20px;
            overflow-y: auto;
            box-shadow: -2px 0 12px rgba(0,0,0,0.1);
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); }
            to { transform: translateX(0); }
        }

        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f0f0f0;
        }

        .notification-header h3 {
            margin: 0;
            font-size: 1.3rem;
            font-weight: 600;
            color: #4B2E2B;
        }

        .notification-header button {
            background: transparent;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
            line-height: 1;
            padding: 4px 8px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .notification-header button:hover {
            background: #f5f5f5;
            color: #333;
        }

        .notification-item {
            padding: 14px 16px;
            border-radius: 8px;
            background: #fafafa;
            margin-bottom: 10px;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .notification-item:hover {
            background: #f5f5f5;
        }

        .notification-item.unread {
            background: #FFF6E9;
            border-left-color: #F28C48;
        }

        .notification-item h4 {
            margin: 0 0 4px 0;
            font-size: 0.95rem;
            font-weight: 600;
            color: #333;
        }

        .notification-item p {
            margin: 0;
            font-size: 0.85rem;
            color: #666;
            line-height: 1.4;
        }

        .notification-footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid #f0f0f0;
        }

        .notification-footer button {
            background: #F28C48;
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .notification-footer button:hover {
            background: #e07732;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(242, 140, 72, 0.3);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .notification-content {
                width: 100%;
                max-width: 100%;
            }
            
            .profile-info span {
                display: none;
            }
            
            .profile-info {
                padding: 4px;
                margin-left: 4px;
            }
        }


/* Stats Summary */
.stats-summary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
}

.summary-card {
    background: linear-gradient(135deg, #fff 0%, #fefefe 100%);
    border-radius: 18px;
    padding: 13px; /* mengikuti preferensi terbaru */
    display: flex;
    align-items: center;
    gap: 20px;
    box-shadow: 0 4px 24px rgba(230, 161, 93, 0.08);
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.5);
}

.summary-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 32px rgba(230, 161, 93, 0.15);
}

.summary-icon {
    width: 64px;
    height: 64px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #F5E6D3 0%, #E8D5C4 100%);
    border: 2px solid rgba(139, 115, 85, 0.15);
    flex-shrink: 0;
    position: relative;
    overflow: hidden;
}

.summary-icon::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.3) 0%, transparent 60%);
    border-radius: 14px;
}

.icon-image {
    width: 32px;
    height: 32px;
    object-fit: contain;
    opacity: 0.9;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    z-index: 1;
    position: relative;
    margin: auto;
    display: block;
}

.summary-icon.total {
    background: linear-gradient(135deg, #F5E6D3 0%, #BBDEFB 100%);
    border-color: rgba(139, 115, 85, 0.15);
}

.summary-icon.active {
    background: linear-gradient(135deg, #E8F5E8 0%, #F5E6D3 100%);
    border-color: rgba(76, 175, 80, 0.15);
}

.summary-icon.pending {
    background: linear-gradient(135deg, #FFF8E1 0%, #FFECB3 100%);
    border-color: rgba(255, 193, 7, 0.15);
}

.summary-icon.revenue {
    background: linear-gradient(135deg, #E3F2FD 0%, #FFF8E1 100%);
    border-color: rgba(33, 150, 243, 0.15);
}

.summary-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.summary-number {
    font-size: 2rem; /* samakan dengan halaman feedback */
    font-weight: 800;
    color: #6B4F3A;
    margin-bottom: 2px;
    line-height: 1.1;
    letter-spacing: -0.02em;
}

.summary-label {
    color: #A97B5D;
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 0.01em;
    line-height: 1.2;
}

/* Content Card */
.content-card {
    background: linear-gradient(135deg, #fff 0%, #fefefe 100%);
    border-radius: 24px;
    padding: 32px;
    box-shadow: 0 12px 40px rgba(230, 161, 93, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.5);
    margin-bottom: 32px;
}

/* Content Header */
.content-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 32px;
    gap: 24px;
}

.content-info {
    flex: 1;
}

.content-title {
    font-weight: 800;
    font-size: 1.6rem;
    color: #6B4F3A;
    margin-bottom: 6px;
}

.content-subtitle {
    color: #A97B5D;
    font-size: 1rem;
    font-weight: 500;
}

.content-controls {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

/* Filter Select */
.filter-select {
    background: linear-gradient(135deg, #FFE0B2, #FFCC99);
    border: 1px solid rgba(169, 123, 93, 0.2);
    border-radius: 12px;
    padding: 12px 16px;
    color: #6B4F3A;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 160px;
    font-size: 0.9rem;
}

.filter-select:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(229, 115, 0, 0.2);
}

.filter-select:focus {
    outline: none;
    border-color: #E57300;
    box-shadow: 0 0 0 3px rgba(229, 115, 0, 0.1);
}

/* Search Box - Same as Testimonial */
.search-box {
    position: relative;
    display: flex;
    align-items: center;
}

.search-box i {
    position: absolute;
    left: 12px;
    color: #A97B5D;
    z-index: 1;
    font-size: 1rem;
}

.search-input {
    background: #F7F5F2;
    border: 1px solid rgba(169, 123, 93, 0.2);
    border-radius: 12px;
    padding: 12px 16px 12px 40px;
    font-size: 0.9rem;
    color: #6B4F3A;
    width: 280px;
    transition: all 0.3s ease;
    font-weight: 500;
}

.search-input:focus {
    outline: none;
    border-color: #E57300;
    box-shadow: 0 0 0 3px rgba(229, 115, 0, 0.1);
    background: #fff;
}

.search-input::placeholder {
    color: #A97B5D;
    opacity: 0.7;
}

/* Table Styles - Same as Testimonial */
.table-container {
    overflow-x: auto;
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 24px;
}

.booking-table {
    width: 100%;
    min-width: 1000px;
    background: #fff;
    border-collapse: collapse;
}

.booking-table thead tr {
    background: linear-gradient(135deg, #FFE0B2, #F9D9A7);
}

.booking-table th {
    color: #6B4F3A;
    padding: 20px 16px;
    font-weight: 700;
    text-align: left;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid rgba(169, 123, 93, 0.1);
}

.booking-table th:first-child {
    text-align: center;
    width: 80px;
}

.booking-table th:nth-child(4),
.booking-table th:nth-child(5),
.booking-table th:nth-child(6) {
    text-align: center;
}

.booking-table th:last-child {
    text-align: center;
    width: 180px;
}

.booking-table td {
    padding: 20px 16px;
    border-bottom: 1px solid rgba(240, 240, 240, 0.8);
    color: #6B4F3A;
    vertical-align: middle;
    font-weight: 500;
}

.booking-table tbody tr {
    transition: all 0.3s ease;
}

.booking-table tbody tr:hover {
    background: rgba(229, 115, 0, 0.02);
    transform: scale(1.002);
}

/* Table Cell Specific Styles */
.booking-table td:first-child {
    text-align: center;
    font-weight: 600;
    color: #E57300;
}

.booking-table td:nth-child(4),
.booking-table td:nth-child(5),
.booking-table td:nth-child(6) {
    text-align: center;
}

.booking-table td:last-child {
    text-align: center;
}

.customer-name {
    font-weight: 600;
    color: #6B4F3A;
    font-size: 0.95rem;
}

.pet-name {
    font-weight: 600;
    color: #E57300;
    font-size: 0.95rem;
}

.date-display {
    font-weight: 600;
    color: #6B4F3A;
    font-size: 0.9rem;
}

.duration-display {
    font-weight: 600;
    color: #6B4F3A;
    font-size: 0.9rem;
}

/* Status Badges */
.status-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-block;
}

.status-pending {
    background: linear-gradient(135deg, #FFF3CD, #FFF8DC);
    color: #856404;
    border: 1px solid #FFEAA7;
}

.status-confirmed {
    background: linear-gradient(135deg, #D4EDDA, #C3E6CB);
    color: #155724;
    border: 1px solid #B8DAFF;
}

.status-checked-in {
    background: linear-gradient(135deg, #D1ECF1, #BEE5EB);
    color: #0C5460;
    border: 1px solid #BEE5EB;
}

.status-completed {
    background: linear-gradient(135deg, #E2E3E5, #F8F9FA);
    color: #383D41;
    border: 1px solid #DEE2E6;
}

/* On Pickup Status */
.status-on-pickup {
    background: linear-gradient(135deg, #FFE0B2, #F9D9A7);
    color: #6B4F3A;
    border: 1px solid #F5CBA7;
}

/* Cancelled Status (missing earlier) */
.status-cancelled {
    background: linear-gradient(135deg, #F8D7DA, #F5C6CB);
    color: #721C24;
    border: 1px solid #F5C6CB;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
}

.action-btn {
    border: none;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    text-transform: capitalize;
}

.btn-view {
    background: #17A2B8;
    color: #fff;
}

.btn-view:hover {
    background: #138496;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
}

.btn-edit {
    background: #E57300;
    color: #fff;
}

.btn-edit:hover {
    background: #CC6600;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(229, 115, 0, 0.3);
}

.btn-delete {
    background: #DC3545;
    color: #fff;
}

.btn-delete:hover {
    background: #C82333;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
}

/* Add Booking Button */
/* Add Booking Button (match Customer page style) */
.btn-add {
    background: #E57300;
    color: #fff;
    border-radius: 12px;
    padding: 12px 20px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
}



/* Make Add button size visually balanced with filter/select & search input */
.content-controls .btn-add {
    height: 44px;
}

/* Modal Styles */
.modal {
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: #fff;
    border-radius: 16px;
    width: 90%;
    max-width: 600px;
    max-height: 80vh;
    overflow-y: auto;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    animation: slideUp 0.3s ease;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal-header {
    background: linear-gradient(135deg, #FFE0B2, #F9D9A7);
    padding: 20px 32px;
    border-radius: 16px 16px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #6B4F3A;
    margin: 0;
}

.modal-close {
    font-size: 28px;
    color: #6B4F3A;
    cursor: pointer;
    font-weight: bold;
    line-height: 1;
}

.modal-close:hover {
    color: #E57300;
}

.modal-body {
    padding: 32px;
}

/* Add Booking Form */
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

.form-field {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.form-field label {
    font-size: 0.85rem;
    color: #A97B5D;
    font-weight: 600;
}

.form-field input,
.form-field select {
    padding: 10px 12px;
    border-radius: 10px;
    border: 1px solid rgba(169, 123, 93, 0.25);
    background: #F7F5F2;
    color: #6B4F3A;
}

.form-field input:focus,
.form-field select:focus {
    outline: none;
    border-color: #E57300;
    box-shadow: 0 0 0 3px rgba(229, 115, 0, 0.1);
    background: #fff;
}

.form-actions {
    grid-column: 1 / -1;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 8px;
}

.booking-detail-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 24px;
}

.detail-item {
    padding: 16px;
    background: #F7F5F2;
    border-radius: 12px;
    border: 1px solid rgba(169, 123, 93, 0.1);
}

.detail-label {
    font-size: 0.85rem;
    color: #A97B5D;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}

.detail-value {
    font-size: 1rem;
    color: #6B4F3A;
    font-weight: 600;
}

/* No Data Message */
.no-data-message {
    text-align: center;
    padding: 60px 20px;
    color: #A97B5D;
}

.no-data-icon {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.5;
    color: #E57300;
}

.no-data-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #6B4F3A;
    margin-bottom: 8px;
}

.no-data-subtitle {
    font-size: 1rem;
    color: #A97B5D;
}

/* Pagination Wrapper */
.pagination-wrapper {
    display: flex !important;
    flex-direction: row; /* selalu horizontal */
    justify-content: center;
    align-items: center;
    margin: 24px 0;
    width: 100%;
    padding: 8px 0;
}

/* Pagination List */
.pagination {
    display: flex;
    align-items: center;
    gap: 6px;
    margin: 0;
    padding: 0;
    list-style: none;
}

/* Pagination Item */
.page-item {
    margin: 0;
    padding: 0;
    list-style: none;
}

/* Pagination Link (Button) */
.page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    padding: 0;
    background: #fff;
    color: #6B4F3A;
    border: 1px solid #E6A15D;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    text-align: center;
}

/* Icon di dalam pagination */
.page-link i {
    font-size: 1rem;
}

/* Hover efek */
.page-link:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(229, 115, 0, 0.15);
}

/* Aktif */
.page-item.active .page-link {
    background: #E57300;
    color: #fff;
    border-color: #E57300;
    box-shadow: 0 2px 6px rgba(229, 115, 0, 0.25);
}

/* Disabled */
.page-item.disabled .page-link {
    opacity: 0.5;
    cursor: not-allowed;
    background: #f9f9f9;
    border-color: #ddd;
    box-shadow: none;
    pointer-events: none;
    transform: none !important;
}

/* Arrow Style */
.pagination-arrow {
    width: 16px;
    height: 16px;
    display: block;
    margin: 0 auto;
}

.page-item.disabled .pagination-arrow {
    filter: grayscale(100%);
    opacity: 0.5;
}

/* Dots separator */
.page-dots {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    color: #6B7280;
    user-select: none;
    font-size: 1.2rem;
    border: none;
    background: transparent;
    box-shadow: none;
    cursor: default;
}

/* Responsive */
@media (max-width: 768px) {
    .pagination {
        gap: 4px;
        flex-wrap: wrap; /* biar rapi kalau kepanjangan */
        justify-content: center;
    }

    .page-link {
        width: 32px;
        height: 32px;
        font-size: 0.8rem;
    }

    .pagination-arrow {
        width: 14px;
        height: 14px;
    }
}

.search-status {
    text-align: center;
    color: #6B4F3A;
    font-size: 0.9rem;
    font-weight: 600;
    margin-top: 12px;
    padding: 8px 16px;
    background: linear-gradient(135deg, #F7F5F2, #FFEEE5);
    border-radius: 20px;
    border: 1px solid rgba(169, 123, 93, 0.1);
    display: inline-block;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .stats-summary {
        grid-template-columns: repeat(2, 1fr);
    }

    .content-controls {
        flex-direction: column;
        align-items: stretch;
        gap: 12px;
    }

    .filter-select,
    .search-input {
        width: 100%;
    }
}

@media (max-width: 768px) {
    .dashboard-main {
        padding: 20px 16px;
    }
    .dashboard-main { margin-left: 0; }

    .dashboard-header {
        flex-direction: column;
        gap: 16px;
        text-align: center;
        padding: 20px;
    }

    .header-title {
        font-size: 1.8rem;
    }

    .stats-summary {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .summary-card {
        padding: 20px;
    }

    .summary-icon {
        width: 56px;
        height: 56px;
    }

    .icon-image {
        width: 28px;
        height: 28px;
    }

    .summary-number {
        font-size: 2rem;
    }

    .content-card {
        padding: 24px 20px;
        border-radius: 16px;
    }

    .content-header {
        flex-direction: column;
        gap: 20px;
        align-items: stretch;
    }

    .content-controls {
        gap: 12px;
    }

    .booking-table th,
    .booking-table td {
        padding: 16px 12px;
        font-size: 0.85rem;
    }

    .action-buttons {
        flex-direction: column;
        gap: 6px;
    }

    .pagination-btn {
        padding: 8px 12px;
        font-size: 0.85rem;
    }

    .booking-detail-grid {
        grid-template-columns: 1fr;
    }

    .modal-content {
        width: 95%;
        margin: 20px;
    }

    .modal-body {
        padding: 20px;
    }
}

@media (max-width: 480px) {
    .header-title {
        font-size: 1.6rem;
    }

    .content-title {
        font-size: 1.4rem;
    }

    .summary-icon {
        width: 50px;
        height: 50px;
    }

    .icon-image {
        width: 24px;
        height: 24px;
    }

    .summary-number {
        font-size: 1.8rem;
    }

    .booking-table th,
    .booking-table td {
        padding: 12px 8px;
        font-size: 0.8rem;
    }

    .action-btn {
        padding: 6px 10px;
        font-size: 0.75rem;
    }
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.summary-card,
.content-card {
    animation: fadeInUp 0.6s ease forwards;
}

.summary-card:nth-child(1) { animation-delay: 0.1s; }
.summary-card:nth-child(2) { animation-delay: 0.2s; }
.summary-card:nth-child(3) { animation-delay: 0.3s; }
.summary-card:nth-child(4) { animation-delay: 0.4s; }
.content-card { animation-delay: 0.5s; }
</style>

<script>
    // Notification Functions
const modal = document.getElementById("notificationModal");
const badge = document.getElementById("notificationBadge");
let notifications = document.querySelectorAll(".notification-item.unread");

function toggleNotificationModal() {
    modal.classList.toggle("show");
    document.body.style.overflow = modal.classList.contains("show") ? "hidden" : "";
    
    // Mark notifications as read when opening the modal
    if (modal.classList.contains("show")) {
        markAllAsRead();
    }
}

function markAllAsRead() {
    const unreadItems = document.querySelectorAll(".notification-item.unread");
    unreadItems.forEach(item => {
        item.classList.remove("unread");
        item.style.opacity = '0.7';
    });
    
    // Update badge count
    updateBadgeCount();
}

function updateBadgeCount() {
    const unreadCount = document.querySelectorAll(".notification-item.unread").length;
    if (unreadCount > 0) {
        badge.textContent = unreadCount;
        badge.style.display = 'flex';
    } else {
        badge.style.display = 'none';
    }
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target === modal) {
        toggleNotificationModal();
    }
}

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' && modal.classList.contains('show')) {
        toggleNotificationModal();
    }
});
document.addEventListener('DOMContentLoaded', function() {
    // Sample booking data with more variety
    const bookings = [
        { id: 1, customer: 'Sarah Johnson', pet: 'Bella', petType: 'Dog', checkin: '2025-09-20', checkout: '2025-09-25', duration: '5 days', status: 'confirmed', phone: '081234567890', email: 'sarah@email.com', service: 'Pet Pickup', price: 750000 },
        { id: 2, customer: 'Michael Chen', pet: 'Whiskers', petType: 'Cat', checkin: '2025-09-22', checkout: '2025-09-24', duration: '2 days', status: 'OnPickup', phone: '081234567891', email: 'michael@email.com', service: 'Drop Off', price: 400000 },
        { id: 3, customer: 'Amanda Putri', pet: 'Rocky', petType: 'Dog', checkin: '2025-09-18', checkout: '2025-09-20', duration: '2 days', status: 'checked-in', phone: '081234567892', email: 'amanda@email.com', service: 'Drop Off', price: 600000 },
        { id: 4, customer: 'Robert Williams', pet: 'Luna', petType: 'Cat', checkin: '2025-09-15', checkout: '2025-09-18', duration: '3 days', status: 'completed', phone: '081234567893', email: 'robert@email.com', service: 'Pet Pickup', price: 450000 },
        { id: 5, customer: 'David Kim', pet: 'Max', petType: 'Dog', checkin: '2025-09-10', checkout: '2025-09-12', duration: '2 days', status: 'pending', phone: '081234567894', email: 'david@email.com', service: 'Pet Pickup', price: 300000 },
        { id: 6, customer: 'Lisa Wong', pet: 'Charlie', petType: 'Rabbit', checkin: '2025-09-05', checkout: '2025-09-10', duration: '5 days', status: 'confirmed', phone: '081234567895', email: 'lisa@email.com', service: 'Drop Off', price: 500000 },
        { id: 7, customer: 'James Brown', pet: 'Milo', petType: 'Cat', checkin: '2025-09-01', checkout: '2025-09-05', duration: '4 days', status: 'cancelled', phone: '081234567896', email: 'james@email.com', service: 'Pet Pickup', price: 600000 },
        { id: 8, customer: 'Emma Davis', pet: 'Lucy', petType: 'Dog', checkin: '2025-08-28', checkout: '2025-09-02', duration: '5 days', status: 'completed', phone: '081234567897', email: 'emma@email.com', service: 'Drop Off', price: 750000 },
        { id: 9, customer: 'Daniel Wilson', pet: 'Bailey', petType: 'Dog', checkin: '2025-08-25', checkout: '2025-08-28', duration: '3 days', status: 'completed', phone: '081234567898', email: 'daniel@email.com', service: 'Pet Pickup', price: 450000 },
        { id: 10, customer: 'Sophia Martinez', pet: 'Daisy', petType: 'Cat', checkin: '2025-08-20', checkout: '2025-08-25', duration: '5 days', status: 'completed', phone: '081234567899', email: 'sophia@email.com', service: 'Drop Off', price: 625000 },
        { id: 11, customer: 'William Taylor', pet: 'Molly', petType: 'Dog', checkin: '2025-08-15', checkout: '2025-08-18', duration: '3 days', status: 'completed', phone: '081234567800', email: 'william@email.com', service: 'Pet Pickup', price: 525000 },
        { id: 12, customer: 'Olivia Anderson', pet: 'Buddy', petType: 'Dog', checkin: '2025-08-10', checkout: '2025-08-15', duration: '5 days', status: 'completed', phone: '081234567801', email: 'olivia@email.com', service: 'Drop Off', price: 700000 },
        { id: 13, customer: 'Ethan Thomas', pet: 'Lola', petType: 'Cat', checkin: '2025-08-05', checkout: '2025-08-10', duration: '5 days', status: 'completed', phone: '081234567802', email: 'ethan@email.com', service: 'Pet Pickup', price: 750000 },
        { id: 14, customer: 'Ava Jackson', pet: 'Zoe', petType: 'Rabbit', checkin: '2025-07-28', checkout: '2025-08-05', duration: '7 days', status: 'completed', phone: '081234567803', email: 'ava@email.com', service: 'Drop Off', price: 700000 },
        { id: 15, customer: 'Noah White', pet: 'Lucky', petType: 'Dog', checkin: '2025-07-25', checkout: '2025-07-28', duration: '3 days', status: 'completed', phone: '081234567804', email: 'noah@email.com', service: 'Pet Pickup', price: 450000 },
        { id: 16, customer: 'Mia Harris', pet: 'Oreo', petType: 'Cat', checkin: '2025-07-20', checkout: '2025-07-25', duration: '5 days', status: 'completed', phone: '081234567805', email: 'mia@email.com', service: 'Drop Off', price: 625000 },
        { id: 17, customer: 'Liam Martin', pet: 'Coco', petType: 'Dog', checkin: '2025-07-15', checkout: '2025-07-20', duration: '5 days', status: 'completed', phone: '081234567806', email: 'liam@email.com', service: 'Pet Pickup', price: 750000 },
        { id: 18, customer: 'Isabella Garcia', pet: 'Toby', petType: 'Dog', checkin: '2025-07-10', checkout: '2025-07-15', duration: '5 days', status: 'completed', phone: '081234567807', email: 'isabella@email.com', service: 'Drop Off', price: 750000 },
        { id: 19, customer: 'Lucas Martinez', pet: 'Simba', petType: 'Cat', checkin: '2025-07-05', checkout: '2025-07-10', duration: '5 days', status: 'completed', phone: '081234567808', email: 'lucas@email.com', service: 'Pet Pickup', price: 750000 },
        { id: 20, customer: 'Ryan Thompson', pet: 'Snowball', petType: 'Cat', checkin: '2025-07-01', checkout: '2025-07-05', duration: '4 days', status: 'completed', phone: '081234567809', email: 'ryan@email.com', service: 'Drop Off', price: 600000 },
        { id: 21, customer: 'Aisha Rahman', pet: 'Milo', petType: 'Dog', checkin: '2025-09-16', checkout: '2025-09-19', duration: '3 days', status: 'confirmed', phone: '081234567810', email: 'aisha@email.com', service: 'Pet Pickup', price: 525000 },
        { id: 22, customer: 'Budi Santoso', pet: 'Max', petType: 'Dog', checkin: '2025-09-14', checkout: '2025-09-17', duration: '3 days', status: 'pending', phone: '081234567811', email: 'budi@email.com', service: 'Drop Off', price: 450000 },
        { id: 23, customer: 'Citra Dewi', pet: 'Bella', petType: 'Cat', checkin: '2025-09-12', checkout: '2025-09-15', duration: '3 days', status: 'confirmed', phone: '081234567812', email: 'citra@email.com', service: 'Pet Pickup', price: 375000 },
        { id: 24, customer: 'Dedi Kurniawan', pet: 'Luna', petType: 'Cat', checkin: '2025-09-10', checkout: '2025-09-13', duration: '3 days', status: 'checked-in', phone: '081234567813', email: 'dedi@email.com', service: 'Drop Off', price: 375000 },
        { id: 25, customer: 'Eva Nurmalasari', pet: 'Charlie', petType: 'Rabbit', checkin: '2025-09-08', checkout: '2025-09-11', duration: '3 days', status: 'completed', phone: '081234567814', email: 'eva@email.com', service: 'Pet Pickup', price: 300000 },
        { id: 26, customer: 'Fajar Setiawan', pet: 'Lucy', petType: 'Dog', checkin: '2025-09-05', checkout: '2025-09-10', duration: '5 days', status: 'completed', phone: '081234567815', email: 'fajar@email.com', service: 'Drop Off', price: 625000 },
        { id: 27, customer: 'Gita Wulandari', pet: 'Bailey', petType: 'Dog', checkin: '2025-09-03', checkout: '2025-09-08', duration: '5 days', status: 'cancelled', phone: '081234567816', email: 'gita@email.com', service: 'Pet Pickup', price: 750000 },
        { id: 28, customer: 'Hendra Gunawan', pet: 'Daisy', petType: 'Cat', checkin: '2025-09-01', checkout: '2025-09-06', duration: '5 days', status: 'completed', phone: '081234567817', email: 'hendra@email.com', service: 'Drop Off', price: 625000 },
        { id: 29, customer: 'Indah Permatasari', pet: 'Molly', petType: 'Dog', checkin: '2025-08-28', checkout: '2025-09-02', duration: '5 days', status: 'completed', phone: '081234567818', email: 'indah@email.com', service: 'Pet Pickup', price: 750000 },
        { id: 30, customer: 'Joko Susilo', pet: 'Buddy', petType: 'Dog', checkin: '2025-08-25', checkout: '2025-08-30', duration: '5 days', status: 'completed', phone: '081234567819', email: 'joko@email.com', service: 'Drop Off', price: 625000 },
        { id: 31, customer: 'Kartika Sari', pet: 'Lola', petType: 'Cat', checkin: '2025-08-22', checkout: '2025-08-27', duration: '5 days', status: 'completed', phone: '081234567820', email: 'kartika@email.com', service: 'Pet Pickup', price: 750000 },
        { id: 32, customer: 'Lukman Hakim', pet: 'Zoe', petType: 'Rabbit', checkin: '2025-08-20', checkout: '2025-08-25', duration: '5 days', status: 'completed', phone: '081234567821', email: 'lukman@email.com', service: 'Drop Off', price: 625000 },
        { id: 33, customer: 'Maya Indah', pet: 'Lucky', petType: 'Dog', checkin: '2025-08-18', checkout: '2025-08-23', duration: '5 days', status: 'completed', phone: '081234567822', email: 'maya@email.com', service: 'Pet Pickup', price: 750000 },
        { id: 34, customer: 'Nugroho Saputra', pet: 'Oreo', petType: 'Cat', checkin: '2025-08-15', checkout: '2025-08-20', duration: '5 days', status: 'completed', phone: '081234567823', email: 'nugroho@email.com', service: 'Drop Off', price: 625000 },
        { id: 35, customer: 'Oki Setiawan', pet: 'Coco', petType: 'Dog', checkin: '2025-08-12', checkout: '2025-08-17', duration: '5 days', status: 'completed', phone: '081234567824', email: 'oki@email.com', service: 'Pet Pickup', price: 750000 },
        { id: 36, customer: 'Putri Ayu', pet: 'Toby', petType: 'Dog', checkin: '2025-08-10', checkout: '2025-08-15', duration: '5 days', status: 'completed', phone: '081234567825', email: 'putri@email.com', service: 'Drop Off', price: 625000 },
        { id: 37, customer: 'Rudi Hartono', pet: 'Simba', petType: 'Cat', checkin: '2025-08-08', checkout: '2025-08-13', duration: '5 days', status: 'completed', phone: '081234567826', email: 'rudi@email.com', service: 'Pet Pickup', price: 750000 },
        { id: 38, customer: 'Siti Rahayu', pet: 'Snowball', petType: 'Cat', checkin: '2025-08-05', checkout: '2025-08-10', duration: '5 days', status: 'completed', phone: '081234567827', email: 'siti@email.com', service: 'Drop Off', price: 625000 },
        { id: 39, customer: 'Teguh Wijaya', pet: 'Milo', petType: 'Dog', checkin: '2025-08-01', checkout: '2025-08-06', duration: '5 days', status: 'completed', phone: '081234567828', email: 'teguh@email.com', service: 'Pet Pickup', price: 750000 },
        { id: 40, customer: 'Wulan Sari', pet: 'Max', petType: 'Dog', checkin: '2025-07-28', checkout: '2025-08-02', duration: '5 days', status: 'completed', phone: '081234567829', email: 'wulan@email.com', service: 'Drop Off', price: 625000 }


        
    ];

    const statusFilter = document.getElementById('statusFilter');
    const searchInput = document.getElementById('searchInput');
    const bookingTableBody = document.getElementById('bookingTableBody');
    const noBookingsMessage = document.getElementById('noBookingsMessage');
    const paginationContainer = document.getElementById('paginationContainer');
    const pageInfo = document.getElementById('pageInfo');
    const searchStatus = document.getElementById('searchStatus');
    const totalBookingsElement = document.getElementById('totalBookings');
    // Add Booking modal elements
    const addBookingModal = document.getElementById('addBookingModal');
    const addBookingForm = document.getElementById('addBookingForm');

    let currentPage = 1;
    const itemsPerPage = 10; // Changed from 8 to 10 items per page
    let filteredBookings = [...bookings];

    // Open/Close Add Booking Modal
    window.openAddBookingModal = function() {
        addBookingModal.style.display = 'flex';
    };

    window.closeAddBookingModal = function() {
        addBookingModal.style.display = 'none';
    };

    // Handle Add Booking Submit
    if (addBookingForm) {
        addBookingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(addBookingForm);
            const checkin = formData.get('checkin');
            const checkout = formData.get('checkout');

            // Calculate duration in days
            const start = new Date(checkin);
            const end = new Date(checkout);
            const msPerDay = 1000 * 60 * 60 * 24;
            let days = Math.round((end - start) / msPerDay);
            if (isNaN(days) || days < 1) days = 1; // minimal 1 hari

            // Generate new id
            const newId = bookings.length ? Math.max(...bookings.map(b => b.id)) + 1 : 1;

            const newBooking = {
                id: newId,
                customer: formData.get('customer').trim(),
                pet: formData.get('pet').trim(),
                petType: formData.get('petType'),
                checkin,
                checkout,
                duration: `${days} days`,
                status: formData.get('status'),
                phone: formData.get('phone').trim(),
                email: formData.get('email').trim(),
                service: formData.get('service'),
                price: Number(formData.get('price') || 0)
            };

            bookings.unshift(newBooking); // add to top for visibility
            // Refresh filters and table
            filterBookings();
            // Reset and close modal
            addBookingForm.reset();
            closeAddBookingModal();
        });
    }

    // Function to change page
    function changePage(page) {
        const totalPages = Math.ceil(filteredBookings.length / itemsPerPage);
        if (page >= 1 && page <= totalPages) {
            currentPage = page;
            renderBookings();
            // Smooth scroll to top of table
            document.querySelector('.content-card')?.scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
        }
    }

    // Function to render pagination
    function renderPagination() {
        const totalPages = Math.ceil(filteredBookings.length / itemsPerPage);
        const paginationContainer = document.getElementById('paginationContainer');
        
        if (totalPages <= 1) {
            paginationContainer.innerHTML = '';
            return;
        }

        let paginationHTML = '';

        // Previous button
        paginationHTML += `
            <button class="pagination-btn" onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''} title="Previous">
                <img class="nav-img" src="{{ asset('images/kiri.svg') }}" alt="Previous" style="width: 16px; height: 16px;">
            </button>
        `;

        // First page
        if (totalPages > 1) {
            paginationHTML += `
                <button class="pagination-btn ${currentPage === 1 ? 'active' : ''}" onclick="changePage(1)">1</button>
            `;
        }

        // Left dots
        if (currentPage > 3) {
            paginationHTML += '<span class="pagination-dots">...</span>';
        }

        // Pages around current
        for (let i = Math.max(2, currentPage - 1); i <= Math.min(totalPages - 1, currentPage + 1); i++) {
            if (i > 1 && i < totalPages) {
                paginationHTML += `
                    <button class="pagination-btn ${i === currentPage ? 'active' : ''}" onclick="changePage(${i})">${i}</button>
                `;
            }
        }

        // Right dots
        if (currentPage < totalPages - 2) {
            paginationHTML += '<span class="pagination-dots">...</span>';
        }

        // Last page
        if (totalPages > 1) {
            paginationHTML += `
                <button class="pagination-btn ${currentPage === totalPages ? 'active' : ''}" onclick="changePage(${totalPages})">${totalPages}</button>
            `;
        }

        // Next button
        paginationHTML += `
            <button class="pagination-btn" onclick="changePage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''} title="Next">
                <img class="nav-img" src="{{ asset('images/kanan.svg') }}" alt="Next" style="width: 16px; height: 16px;">
            </button>
        `;

        paginationContainer.innerHTML = paginationHTML;

        // Center the current page in the scrollable area
        const currentBtn = paginationContainer.querySelector('.pagination-btn.active');
        if (currentBtn) {
            currentBtn.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest',
                inline: 'center'
            });
        }
    }

    // Function to render bookings
    function renderBookings() {
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const currentBookings = filteredBookings.slice(startIndex, endIndex);
        
        // Render pagination
        renderPagination();

        if (currentBookings.length === 0) {
            bookingTableBody.innerHTML = '';
            noBookingsMessage.style.display = 'block';
            document.querySelector('.pagination-wrapper').style.display = 'none';
        } else {
            noBookingsMessage.style.display = 'none';
            document.querySelector('.pagination-wrapper').style.display = 'flex';

            bookingTableBody.innerHTML = currentBookings.map((booking, index) => {
                const globalIndex = startIndex + index + 1;
                const statusBadge = getStatusBadge(booking.status);

                return `
                    <tr data-status="${normalizeStatus(booking.status)}">
                        <td>${globalIndex}</td>
                        <td>
                            <div class="customer-name">${booking.customer}</div>
                        </td>
                        <td>
                            <div class="pet-name">${booking.pet}</div>
                        </td>
                        <td>
                            <div class="date-display">${formatDate(booking.checkin)}</div>
                        </td>
                        <td>
                            <div class="duration-display">${booking.duration}</div>
                        </td>
                        <td>
                            ${statusBadge}
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn btn-view" onclick="viewBooking(${booking.id})">
                                    <i class="bi bi-eye"></i> View
                                </button>
                                <button class="action-btn btn-edit" onclick="editBooking(${booking.id})">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="action-btn btn-delete" onclick="deleteBooking(${booking.id})">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        // Update total bookings count
        totalBookingsElement.textContent = filteredBookings.length;

        // Render pagination
        renderPagination();

        // Render page info
        renderPageInfo();

        // Render search status
        renderSearchStatus();

        // Update statistics
        updateStatistics();
    }

    // Function to format date
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });
    }

    // Normalize status to a consistent key
    function normalizeStatus(status) {
        if (!status) return '';
        return String(status)
            .toLowerCase()
            .trim()
            .replace(/_/g, '-')
            .replace(/\s+/g, '-')
            .replace(/onpickup/g, 'on-pickup')
            .replace(/checkedin/g, 'checked-in');
    }

    // Function to get status badge
    function getStatusBadge(status) {
        const key = normalizeStatus(status);
        const statusMap = {
            'pending': { class: 'status-pending', text: 'Pending' },
            'confirmed': { class: 'status-confirmed', text: 'Confirmed' },
            'checked-in': { class: 'status-checked-in', text: 'Checked In' },
            'completed': { class: 'status-completed', text: 'Completed' },
            'cancelled': { class: 'status-cancelled', text: 'Cancelled' },
            'on-pickup': { class: 'status-on-pickup', text: 'On Pickup' },
        };

        const statusInfo = statusMap[key] || { class: 'status-pending', text: 'Unknown' };
        return `<span class="status-badge ${statusInfo.class}">${statusInfo.text}</span>`;
    }

    // Function to render page info
    function renderPageInfo() {
        const totalPages = Math.ceil(filteredBookings.length / itemsPerPage);
        const startIndex = filteredBookings.length > 0 ? (currentPage - 1) * itemsPerPage + 1 : 0;
        const endIndex = Math.min(currentPage * itemsPerPage, filteredBookings.length);
        const pageInfo = document.getElementById('pageInfo');
        
        if (!pageInfo) {
            console.error('Page info element not found');
            return;
        }

        if (filteredBookings.length === 0) {
            pageInfo.innerHTML = 'No bookings to display';
        } else {
            pageInfo.innerHTML = `
                <div style="text-align: center; margin-top: 15px; color: #6B4F3A; font-size: 14px;">
                    <div>manage booking</div>
                    <div>Showing ${startIndex}-${endIndex} of ${filteredBookings.length} customers (Page ${currentPage} of ${totalPages})</div>
                    ${filteredBookings.length <= itemsPerPage ? '<div>Showing all customers</div>' : ''}
                </div>
            `;
        }
        
        // Make sure the element is visible
        pageInfo.style.display = 'block';
    }

    // Function to render search status
    function renderSearchStatus() {
        const searchTerm = searchInput.value.trim();
        const selectedStatus = statusFilter.value;

        if (searchTerm || selectedStatus) {
            const filters = [];
            if (searchTerm) filters.push(`"${searchTerm}"`);
            if (selectedStatus) filters.push(`${displayStatus} status`);
            searchStatus.innerHTML = `Applied filters: ${filters.join(', ')}`;
            searchStatus.style.display = 'inline-block';
        } else {
            searchStatus.innerHTML = 'Showing all customers';
            searchStatus.style.display = 'inline-block';
        }
    }

    // Function to render pagination
    function renderPagination() {
        const totalPages = Math.ceil(filteredBookings.length / itemsPerPage);

        if (totalPages <= 1) {
            paginationContainer.innerHTML = '';
            return;
        }

        let paginationHTML = '';

        // Previous button
        paginationHTML += `
            <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="changePage(${currentPage - 1}); return false;">
                    <img src="{{ asset('images/kiri.svg') }}" alt="Previous" class="pagination-arrow">
                </a>
            </li>
        `;

        // First page
        if (totalPages > 1) {
            paginationHTML += `
                <li class="page-item ${currentPage === 1 ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="changePage(1); return false;">1</a>
                </li>
            `;
        }

        // Left dots
        if (currentPage > 3) {
            paginationHTML += '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }

        // Pages around current
        for (let i = Math.max(2, currentPage - 1); i <= Math.min(totalPages - 1, currentPage + 1); i++) {
            if (i > 1 && i < totalPages) {
                paginationHTML += `
                    <li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="changePage(${i}); return false;">${i}</a>
                    </li>
                `;
            }
        }

        // Right dots
        if (currentPage < totalPages - 2) {
            paginationHTML += '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }

        // Last page
        if (totalPages > 1) {
            paginationHTML += `
                <li class="page-item ${currentPage === totalPages ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${totalPages}); return false;">${totalPages}</a>
                </li>
            `;
        }

        // Next button
        paginationHTML += `
            <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="changePage(${currentPage + 1}); return false;">
                    <img src="{{ asset('images/kanan.svg') }}" alt="Next" class="pagination-arrow">
                </a>
            </li>
        `;

        paginationContainer.innerHTML = paginationHTML;
    }

    // Function to change page
    window.changePage = function(page) {
        const totalPages = Math.ceil(filteredBookings.length / itemsPerPage);
        if (page >= 1 && page <= totalPages) {
            currentPage = page;
            renderBookings();
            // Smooth scroll to top of table
            document.querySelector('.content-card').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
        }
    };

    // Function to filter bookings
    function filterBookings() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedStatus = statusFilter.value;

        filteredBookings = bookings.filter(booking => {
            const matchesSearch = !searchTerm || 
                booking.customer.toLowerCase().includes(searchTerm) ||
                booking.pet.toLowerCase().includes(searchTerm);
            const matchesStatus = !selectedStatus || normalizeStatus(booking.status) === normalizeStatus(selectedStatus);

            return matchesSearch && matchesStatus;
        });

        currentPage = 1; // Reset to first page when filtering
        renderBookings();
    }

    // Function to update statistics
    function updateStatistics() {
        // Total bookings
        const totalBookings = filteredBookings.length;
        
        // Pets currently boarded (checked-in status)
        const activePets = filteredBookings.filter(b => b.status === 'checked-in').length;
        
        // Pending bookings
        const pendingBookings = filteredBookings.filter(b => b.status === 'pending').length;
        
        // Calculate monthly revenue (all bookings regardless of status for realistic revenue)
        const monthlyRevenue = bookings.reduce((sum, booking) => sum + booking.price, 0);
        const revenueFormatted = (monthlyRevenue / 1000000).toFixed(1) + 'M';

        // Update DOM elements with proper IDs
        document.getElementById('totalBookings').textContent = totalBookings;
        document.getElementById('activePets').textContent = activePets;
        document.getElementById('pendingBookings').textContent = pendingBookings;
        document.getElementById('monthlyRevenue').textContent = `Rp ${revenueFormatted}`;
    }

    // Action functions
    window.viewBooking = function(id) {
        const booking = bookings.find(b => b.id === id);
        if (booking) {
            showBookingModal(booking);
        }
    };

    window.editBooking = function(id) {
        const booking = bookings.find(b => b.id === id);
        if (booking) {
            alert(`Edit booking for ${booking.customer} - ${booking.pet}\n\n(This would open an edit form in a real application)`);
        }
    };

    window.deleteBooking = function(id) {
        const booking = bookings.find(b => b.id === id);
        if (booking && confirm(`Are you sure you want to delete the booking for ${booking.customer} - ${booking.pet}?`)) {
            // Remove from main array
            const index = bookings.findIndex(b => b.id === id);
            if (index > -1) {
                bookings.splice(index, 1);
                // Re-filter and re-render
                filterBookings();
                alert('Booking deleted successfully!');
            }
        }
    };

    // Function to show booking modal
    function showBookingModal(booking) {
        const modal = document.getElementById('bookingModal');
        const modalBody = document.getElementById('modalBody');
        
        modalBody.innerHTML = `
            <div class="booking-detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Customer Name</div>
                    <div class="detail-value">${booking.customer}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Pet Name</div>
                    <div class="detail-value">${booking.pet}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Pet Type</div>
                    <div class="detail-value">${booking.petType}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Phone Number</div>
                    <div class="detail-value">${booking.phone}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div class="detail-value">${booking.email}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Service Method</div>
                    <div class="detail-value">${booking.service}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Check-in Date</div>
                    <div class="detail-value">${formatDate(booking.checkin)}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Check-out Date</div>
                    <div class="detail-value">${formatDate(booking.checkout)}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Duration</div>
                    <div class="detail-value">${booking.duration}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status</div>
                    <div class="detail-value">${getStatusBadge(booking.status)}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Total Price</div>
                    <div class="detail-value">${new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(booking.price).replace('IDR', 'Rp')}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Booking ID</div>
                    <div class="detail-value">#BK${String(booking.id).padStart(4, '0')}</div>
                </div>
            </div>
        `;
        
        modal.style.display = 'flex';
    }

    // Function to close modal
    window.closeModal = function() {
        const modal = document.getElementById('bookingModal');
        modal.style.display = 'none';
    };

    // Close booking modal when clicking outside (without overriding other handlers)
    document.addEventListener('click', function(event) {
        const modal = document.getElementById('bookingModal');
        if (modal && event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Event listeners
    statusFilter.addEventListener('change', filterBookings);
    searchInput.addEventListener('input', debounce(filterBookings, 300));

    // Debounce function for search input
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                func(...args);
                renderBookings();
                renderPageInfo();
                // Smooth scroll to top of table
                document.querySelector('.content-card')?.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'start' 
                });
            }, wait);
        };
    }

    // Initialize
    filterBookings();
    renderBookings();
    renderPageInfo();

    // Add some visual feedback for loading
    setTimeout(() => {
        document.querySelectorAll('.summary-card, .content-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        });
    }, 100);
});
</script>
@endsection