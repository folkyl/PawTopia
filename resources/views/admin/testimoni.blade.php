@extends('layouts.app')
@include ('layoutadmin.navbar')
@section('content')
<div class="dashboard-root">
    <!-- Main Content -->
    <main class="dashboard-main">
        <!-- Header -->
        <x-dashboard-header 
            title="Customer Testimonial"
            subtitle="Pet Boarding Customer Reviews & Feedback"
            icon="star"
        />

        <!-- Stats Summary -->
        <div class="stats-summary">
            <div class="summary-card">
                <div class="summary-icon">
                    <img src="{{ asset('images/komen.svg') }}" alt="Reviews Icon" class="icon-image">
                </div>
                <div class="summary-content">
                    <div class="summary-number" id="totalReviews">20</div>
                    <div class="summary-label">Total Reviews</div>
                </div>
            </div>
            <div class="summary-card">
                <div class="summary-icon average">
                    <img src="{{ asset('images/chart.svg') }}" alt="Chart Icon" class="icon-image">
                </div>
                <div class="summary-content">
                    <div class="summary-number">4.6</div>
                    <div class="summary-label">Average Rating</div>
                </div>
            </div>
            <div class="summary-card">
                <div class="summary-icon monthly">
                    <img src="{{ asset('images/kalender.svg') }}" alt="Calendar Icon" class="icon-image">
                </div>
                <div class="summary-content">
                    <div class="summary-number">12</div>
                    <div class="summary-label">This Month</div>
                </div>
            </div>
            <div class="summary-card">
                <div class="summary-icon positive">
                    <img src="{{ asset('images/star.svg') }}" alt="Star Icon" class="icon-image">
                </div>
                <div class="summary-content">
                    <div class="summary-number">95%</div>
                    <div class="summary-label">Positive Reviews</div>
                </div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="content-card">
            <!-- Header with Search and Filters -->
            <div class="content-header">
                <div class="content-info">
                    <div class="content-title">Customer Testimonials</div>
                    <div class="content-subtitle">Manage and review customer feedback</div>
                </div>
                <div class="content-controls">
                    <!-- Rating Filter -->
                    <select id="ratingFilter" class="filter-select">
                        <option value="">All Ratings</option>
                        <option value="5">★★★★★ 5 Stars</option>
                        <option value="4">★★★★☆ 4 Stars</option>
                        <option value="3">★★★☆☆ 3 Stars</option>
                        <option value="2">★★☆☆☆ 2 Stars</option>
                        <option value="1">★☆☆☆☆ 1 Star</option>
                    </select>
                    <!-- Search Bar -->
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" id="searchInput" placeholder="Search testimonials..." class="search-input">
                    </div>
                </div>
            </div>

            <!-- Testimonial Table -->
            <div class="table-container">
                <table class="testimonial-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer Name</th>
                            <th>Testimonial</th>
                            <th>Date</th>
                            <th>Rating</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="testimonialTableBody">
                        <!-- Testimonial rows will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- No Testimonials Message -->
            <div id="noTestimonialsMessage" class="no-data-message" style="display:none;">
                <div class="no-data-icon">
                    <i class="bi bi-chat-dots"></i>
                </div>
                <div class="no-data-title">No testimonials found</div>
                <div class="no-data-subtitle">No customer testimonials available at this time.</div>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                <div id="paginationContainer" class="pagination-container"></div>
                <div id="pageInfo" class="page-info"></div>
            </div>

            <!-- Search Status -->
            <div id="searchStatus" class="search-status"></div>
        </div>
    </main>
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
.dashboard-main {
    flex: 1;
    padding: 40px 32px 32px 32px;
    max-width: 100%;
    margin-left: 250px; /* geser isi karena sidebar */
}
</style>


<style>
/* Root Styles - Same as Dashboard */
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
}

/* Header - Same as Dashboard */
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
    padding: 24px;
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

.summary-icon.average {
    background: linear-gradient(135deg, #E8F5E8 0%, #D4EDDA 100%);
    border-color: rgba(76, 175, 80, 0.15);
}

.summary-icon.monthly {
    background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
    border-color: rgba(33, 150, 243, 0.15);
}

.summary-icon.positive {
    background: linear-gradient(135deg, #FFF3E0 0%, #FFCC99 100%);
    border-color: rgba(255, 152, 0, 0.15);
}

.summary-content {
    flex: 1;
}

.summary-number {
    font-size: 2.2rem;
    font-weight: 800;
    color: #6B4F3A;
    margin-bottom: 4px;
    line-height: 1;
    letter-spacing: -0.02em;
}

.summary-label {
    color: #A97B5D;
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 0.01em;
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

/* Search Box - Same as Dashboard */
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

/* Table Styles - Same as Dashboard */
.table-container {
    overflow-x: auto;
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 24px;
}

.testimonial-table {
    width: 100%;
    min-width: 900px;
    background: #fff;
    border-collapse: collapse;
}

.testimonial-table thead tr {
    background: linear-gradient(135deg, #FFE0B2, #F9D9A7);
}

.testimonial-table th {
    color: #6B4F3A;
    padding: 20px 16px;
    font-weight: 700;
    text-align: left;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid rgba(169, 123, 93, 0.1);
}

.testimonial-table th:first-child {
    text-align: center;
    width: 80px;
}

.testimonial-table th:nth-child(4),
.testimonial-table th:nth-child(5) {
    text-align: center;
}

.testimonial-table th:last-child {
    text-align: center;
    width: 160px;
}

.testimonial-table td {
    padding: 20px 16px;
    border-bottom: 1px solid rgba(240, 240, 240, 0.8);
    color: #6B4F3A;
    vertical-align: middle;
    font-weight: 500;
}

.testimonial-table tbody tr {
    transition: all 0.3s ease;
}

.testimonial-table tbody tr:hover {
    background: rgba(229, 115, 0, 0.02);
    transform: scale(1.002);
}

/* Table Cell Specific Styles */
.testimonial-table td:first-child {
    text-align: center;
    font-weight: 600;
    color: #E57300;
}

.testimonial-table td:nth-child(4),
.testimonial-table td:nth-child(5) {
    text-align: center;
}

.testimonial-table td:last-child {
    text-align: center;
}

.customer-name {
    font-weight: 600;
    color: #6B4F3A;
    font-size: 0.95rem;
}

.testimonial-text {
    max-width: 300px;
    line-height: 1.4;
    color: #6B4F3A;
}

.date-display {
    font-weight: 600;
    color: #6B4F3A;
    font-size: 0.9rem;
}

.rating-display {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
}

.rating-score {
    font-weight: 600;
    color: #6B4F3A;
    font-size: 0.9rem;
}

.star-rating {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 2px;
}

.star {
    color: #E57300;
    font-size: 1.1rem;
    line-height: 1;
    transition: all 0.2s ease;
}

.star.filled {
    opacity: 1;
}

.star.empty {
    opacity: 0.3;
}

.star:hover {
    transform: scale(1.1);
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
    padding: 8px 16px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    text-transform: capitalize;
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

/* Pagination */
.pagination-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
    margin-top: 32px;
}

.pagination-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
}

.pagination-btn {
    background: linear-gradient(135deg, #FFE0B2, #FFCC99);
    color: #6B4F3A;
    border: 1px solid rgba(169, 123, 93, 0.2);
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pagination-btn:hover {
    background: linear-gradient(135deg, #F9D9A7, #F0B27A);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(229, 115, 0, 0.2);
}

.pagination-btn.active {
    background: #E57300;
    color: #fff;
    border-color: #E57300;
    box-shadow: 0 4px 12px rgba(229, 115, 0, 0.3);
}

.pagination-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    background: #f0f0f0;
    color: #999;
    border-color: #ddd;
}

.pagination-btn:disabled:hover {
    transform: none;
    box-shadow: none;
    background: #f0f0f0;
}

.pagination-dots {
    padding: 10px 14px;
    color: #A97B5D;
    font-weight: 600;
}

.page-info {
    text-align: center;
    color: #A97B5D;
    font-size: 0.9rem;
    font-weight: 500;
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

    .testimonial-table th,
    .testimonial-table td {
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

    .testimonial-table th,
    .testimonial-table td {
        padding: 12px 8px;
        font-size: 0.8rem;
    }

    .testimonial-text {
        max-width: 200px;
    }

    .action-btn {
        padding: 6px 12px;
        font-size: 0.8rem;
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
    // Sample testimonial data (enhanced with more realistic data)
    const testimonials = [
        { id: 1, name: 'Sarah Johnson', testimoni: 'Pawtopia memberikan pelayanan terbaik untuk anjing saya. Staff sangat profesional dan caring terhadap hewan peliharaan.', date: '2025-08-15', rating: 5 },
        { id: 2, name: 'Michael Chen', testimoni: 'Pelayanan cukup baik, tapi masih ada beberapa hal yang bisa ditingkatkan dalam hal kebersihan kandang.', date: '2025-08-14', rating: 3 },
        { id: 3, name: 'Amanda Putri', testimoni: 'Luar biasa! Kucing saya sangat senang dan terawat dengan baik. Akan selalu menggunakan jasa Pawtopia.', date: '2025-08-13', rating: 5 },
        { id: 4, name: 'Robert Williams', testimoni: 'Harga terjangkau dengan kualitas pelayanan yang memuaskan. Recommended untuk pet boarding.', date: '2025-08-12', rating: 4 },
        { id: 5, name: 'Lisa Maharani', testimoni: 'Staff sangat ramah dan berpengalaman. Fasilitas lengkap dan bersih. Sangat puas dengan layanan mereka.', date: '2025-08-11', rating: 5 },
        { id: 6, name: 'David Kumar', testimoni: 'Pelayanan excellent! Hewan peliharaan saya mendapat perhatian khusus dan perawatan terbaik.', date: '2025-08-10', rating: 5 },
        { id: 7, name: 'Jessica Wong', testimoni: 'Layanan bagus dan harga bersaing. Lokasi strategis dan mudah dijangkau.', date: '2025-08-09', rating: 4 },
        { id: 8, name: 'Andrew Lee', testimoni: 'Staff profesional dan sangat memahami kebutuhan hewan peliharaan. Highly recommended!', date: '2025-08-08', rating: 5 },
        { id: 9, name: 'Rachel Green', testimoni: 'Pelayanan memuaskan, fasilitas lengkap. Anjing saya selalu senang ketika dititipkan di sini.', date: '2025-08-07', rating: 4 },
        { id: 10, name: 'Kevin Tan', testimoni: 'Sangat puas dengan hasil perawatan dan pelayanan yang diberikan. Worth every penny!', date: '2025-08-06', rating: 5 },
        { id: 11, name: 'Maria Santos', testimoni: 'Layanan terpercaya dan berkualitas. Staff sangat care dan detail dalam merawat hewan.', date: '2025-08-05', rating: 5 },
        { id: 12, name: 'James Miller', testimoni: 'Pelayanan baik, tapi waktu tunggu agak lama. Overall masih recommended.', date: '2025-08-04', rating: 3 },
        { id: 13, name: 'Sophie Brown', testimoni: 'Fasilitas modern dan bersih. Hewan peliharaan mendapat perhatian optimal.', date: '2025-08-03', rating: 4 },
        { id: 14, name: 'Daniel Park', testimoni: 'Exceptional service! Pawtopia benar-benar memahami kebutuhan pet owner.', date: '2025-08-02', rating: 5 },
        { id: 15, name: 'Emily Davis', testimoni: 'Sangat puas dengan layanan grooming dan boarding. Staff ramah dan berpengalaman.', date: '2025-08-01', rating: 5 },
        { id: 16, name: 'Thomas Wilson', testimoni: 'Pelayanan profesional dengan harga yang fair. Akan terus menggunakan jasa mereka.', date: '2025-07-31', rating: 4 },
        { id: 17, name: 'Hannah Kim', testimoni: 'Layanan standar, bisa lebih ditingkatkan dalam hal komunikasi dengan customer.', date: '2025-07-30', rating: 3 },
        { id: 18, name: 'Christopher Lee', testimoni: 'Staff sangat ramah dan profesional. Fasilitas bersih dan terawat dengan baik.', date: '2025-07-29', rating: 4 },
        { id: 19, name: 'Olivia Martinez', testimoni: 'Pelayanan luar biasa! Kucing saya sangat happy dan sehat setelah boarding di sini.', date: '2025-07-28', rating: 5 },
        { id: 20, name: 'Ryan Thompson', testimoni: 'Sangat puas dengan layanan Pawtopia. Definitely my go-to place untuk pet care!', date: '2025-07-27', rating: 5 }
    ];

    const ratingFilter = document.getElementById('ratingFilter');
    const searchInput = document.getElementById('searchInput');
    const testimonialTableBody = document.getElementById('testimonialTableBody');
    const noTestimonialsMessage = document.getElementById('noTestimonialsMessage');
    const paginationContainer = document.getElementById('paginationContainer');
    const pageInfo = document.getElementById('pageInfo');
    const searchStatus = document.getElementById('searchStatus');
    const totalReviewsElement = document.getElementById('totalReviews');

    let currentPage = 1;
    const itemsPerPage = 8;
    let filteredTestimonials = [...testimonials];

    // Function to render testimonials
    function renderTestimonials() {
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const currentTestimonials = filteredTestimonials.slice(startIndex, endIndex);

        if (currentTestimonials.length === 0) {
            testimonialTableBody.innerHTML = '';
            noTestimonialsMessage.style.display = 'block';
            paginationContainer.parentElement.style.display = 'none';
        } else {
            noTestimonialsMessage.style.display = 'none';
            paginationContainer.parentElement.style.display = 'flex';

            testimonialTableBody.innerHTML = currentTestimonials.map((testimonial, index) => {
                const globalIndex = startIndex + index + 1;
                const stars = generateStars(testimonial.rating);

                return `
                    <tr data-rating="${testimonial.rating}">
                        <td>${globalIndex}</td>
                        <td>
                            <div class="customer-name">${testimonial.name}</div>
                        </td>
                        <td>
                            <div class="testimonial-text">${testimonial.testimoni}</div>
                        </td>
                        <td>
                            <div class="date-display">${formatDate(testimonial.date)}</div>
                        </td>
                        <td>
                            <div class="rating-display">
                                <div class="rating-score">${testimonial.rating}/5</div>
                                ${stars}
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn btn-edit" onclick="editTestimonial(${testimonial.id})">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="action-btn btn-delete" onclick="deleteTestimonial(${testimonial.id})">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        // Update total reviews count
        totalReviewsElement.textContent = filteredTestimonials.length;

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

    // Function to generate star rating HTML
    function generateStars(rating) {
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= rating) {
                stars += '<span class="star filled">★</span>';
            } else {
                stars += '<span class="star empty">☆</span>';
            }
        }
        return `<div class="star-rating">${stars}</div>`;
    }

    // Function to render page info
    function renderPageInfo() {
        const totalPages = Math.ceil(filteredTestimonials.length / itemsPerPage);
        const startIndex = (currentPage - 1) * itemsPerPage + 1;
        const endIndex = Math.min(currentPage * itemsPerPage, filteredTestimonials.length);

        if (filteredTestimonials.length === 0) {
            pageInfo.innerHTML = 'No testimonials to display';
        } else {
            pageInfo.innerHTML = `Showing ${startIndex}-${endIndex} of ${filteredTestimonials.length} testimonials (Page ${currentPage} of ${totalPages})`;
        }
    }

    // Function to render search status
    function renderSearchStatus() {
        const searchTerm = searchInput.value.trim();
        const selectedRating = ratingFilter.value;

        if (searchTerm || selectedRating) {
            const filters = [];
            if (searchTerm) filters.push(`"${searchTerm}"`);
            if (selectedRating) filters.push(`${selectedRating}★ rating`);
            searchStatus.innerHTML = `Applied filters: ${filters.join(', ')}`;
            searchStatus.style.display = 'inline-block';
        } else {
            searchStatus.innerHTML = 'Showing all testimonials';
            searchStatus.style.display = 'inline-block';
        }
    }

    // Function to render pagination
    function renderPagination() {
        const totalPages = Math.ceil(filteredTestimonials.length / itemsPerPage);

        if (totalPages <= 1) {
            paginationContainer.innerHTML = '';
            return;
        }

        let paginationHTML = '';

        // Previous button
        paginationHTML += `
            <button class="pagination-btn" onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>
                <i class="bi bi-chevron-left"></i>
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
            <button class="pagination-btn" onclick="changePage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''}>
                <i class="bi bi-chevron-right"></i>
            </button>
        `;

        paginationContainer.innerHTML = paginationHTML;
    }

    // Function to change page
    window.changePage = function(page) {
        const totalPages = Math.ceil(filteredTestimonials.length / itemsPerPage);
        if (page >= 1 && page <= totalPages) {
            currentPage = page;
            renderTestimonials();
            // Smooth scroll to top of table
            document.querySelector('.content-card').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
        }
    };

    // Function to filter testimonials
    function filterTestimonials() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedRating = ratingFilter.value;

        filteredTestimonials = testimonials.filter(testimonial => {
            const matchesSearch = !searchTerm || 
                testimonial.name.toLowerCase().includes(searchTerm) ||
                testimonial.testimoni.toLowerCase().includes(searchTerm);
            const matchesRating = !selectedRating || testimonial.rating === parseInt(selectedRating);

            return matchesSearch && matchesRating;
        });

        currentPage = 1; // Reset to first page when filtering
        renderTestimonials();
    }

    // Function to update statistics
    function updateStatistics() {
        // Calculate average rating
        const totalRating = filteredTestimonials.reduce((sum, testimonial) => sum + testimonial.rating, 0);
        const averageRating = filteredTestimonials.length > 0 ? (totalRating / filteredTestimonials.length).toFixed(1) : 0;
        
        // Count this month's reviews (assuming current month is August 2025)
        const thisMonth = filteredTestimonials.filter(t => t.date.startsWith('2025-08')).length;
        
        // Calculate positive reviews (4-5 stars)
        const positiveReviews = filteredTestimonials.filter(t => t.rating >= 4).length;
        const positivePercentage = filteredTestimonials.length > 0 ? 
            Math.round((positiveReviews / filteredTestimonials.length) * 100) : 0;

        // Update DOM elements
        document.querySelector('.summary-card:nth-child(2) .summary-number').textContent = averageRating;
        document.querySelector('.summary-card:nth-child(3) .summary-number').textContent = thisMonth;
        document.querySelector('.summary-card:nth-child(4) .summary-number').textContent = positivePercentage + '%';
    }

    // Action functions
    window.editTestimonial = function(id) {
        const testimonial = testimonials.find(t => t.id === id);
        if (testimonial) {
            alert(`Edit testimonial from ${testimonial.name}:\n"${testimonial.testimoni}"\n\n(This would open an edit modal in a real application)`);
        }
    };

    window.deleteTestimonial = function(id) {
        const testimonial = testimonials.find(t => t.id === id);
        if (testimonial && confirm(`Are you sure you want to delete the testimonial from ${testimonial.name}?`)) {
            // Remove from main array
            const index = testimonials.findIndex(t => t.id === id);
            if (index > -1) {
                testimonials.splice(index, 1);
                // Re-filter and re-render
                filterTestimonials();
                alert('Testimonial deleted successfully!');
            }
        }
    };

    // Event listeners
    ratingFilter.addEventListener('change', filterTestimonials);
    searchInput.addEventListener('input', debounce(filterTestimonials, 300));

    // Debounce function for search input
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Initial render
    renderTestimonials();

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