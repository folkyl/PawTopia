@extends('layouts.app')
@include ('layoutadmin.navbar')
{{-- @section('content') --}}

<!-- Add jQuery and Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Add CSRF token meta tag -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="dashboard-root">
    <!-- Main Content -->
    <main class="dashboard-main">
        <!-- Header -->
        <x-dashboard-header 
            title="Customer Feedback"
            subtitle="Pet Boarding Customer Reviews & Feedback"
            icon="comments"
        />

        <!-- Stats Summary -->
        <div class="stats-summary">
            <div class="summary-card">
                <div class="summary-icon">
                    <img src="{{ asset('images/komen.svg') }}" alt="Komentar" class="icon-image">
                </div>
                <div class="summary-content">
                    <div class="summary-number" id="totalFeedback">20</div>
                    <div class="summary-label">Total Feedback</div>
                </div>
            </div>
            <div class="summary-card">
                <div class="summary-icon average">
                    <img src="{{ asset('images/chart.svg') }}" alt="Chart" class="icon-image">
                </div>
                <div class="summary-content">
                    <div class="summary-number">4.6</div>
                    <div class="summary-label">Average Rating</div>
                </div>
            </div>
            <div class="summary-card">
                <div class="summary-icon monthly">
                    <img src="{{ asset('images/kalender.svg') }}" alt="Calendar" class="icon-image">
                </div>
                <div class="summary-content">
                    <div class="summary-number">12</div>
                    <div class="summary-label">This Month</div>
                </div>
            </div>
            <div class="summary-card">
                <div class="summary-icon positive">
                    <img src="{{ asset('images/star.svg') }}" alt="Star" class="icon-image">
                </div>
                <div class="summary-content">
                    <div class="summary-number">95%</div>
                    <div class="summary-label">Positive Reviews</div>
                </div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="content-card">
            <!-- Feedback Table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Feedback</th>
                            <th>Date</th>
                            <th>Rating</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="feedbackTableBody">
                        @forelse($feedbacks as $feedback)
                            <tr data-id="{{ $feedback->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="feedback-text">{{ $feedback->message }}</div>
                                    @if($feedback->user_name)
                                        <div class="text-muted small">- {{ $feedback->user_name }}</div>
                                    @endif
                                </td>
                                <td>{{ $feedback->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="star {{ $i <= $feedback->rating ? 'filled' : '' }}">★</span>
                                        @endfor
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="editFeedback({{ $feedback->id }}, '{{ addslashes($feedback->message) }}', {{ $feedback->rating }})">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteFeedback({{ $feedback->id }})">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="text-muted">No feedback available</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- EDIT FEEDBACK MODAL -->
        <div class="modal fade" id="editFeedbackModal" tabindex="-1" role="dialog" aria-labelledby="editFeedbackModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <div class="modal-header" style="border: none; padding: 30px 30px 20px 30px; background: white; border-radius: 20px 20px 0 0;">
                        <h4 class="modal-title" id="editFeedbackModalLabel" style="color: #8B4513; font-weight: 600; margin: 0;">
                            Edit Feedback
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #999; opacity: 1; font-size: 24px; background: none; border: none; cursor: pointer;" onclick="$('#editFeedbackModal').modal('hide');">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editFeedbackForm">
                        @csrf
                        @method('PUT')
                        <div class="modal-body" style="padding: 20px 30px 30px 30px; background: white;">
                            <input type="hidden" id="editFeedbackId" name="feedback_id">
                            
                            <div class="mb-4">
                                <label for="editMessage" class="form-label" style="color: #8B4513; font-weight: 500; margin-bottom: 8px; display: block;">
                                    Pesan Feedback
                                </label>
                                <textarea class="form-control" id="editMessage" name="message" rows="4" 
                                    placeholder="Masukkan pesan feedback..." required
                                    style="border: 1px solid #ddd; border-radius: 12px; padding: 15px; font-size: 14px; background: #f8f9fa; resize: vertical;"></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label for="editRating" class="form-label" style="color: #8B4513; font-weight: 500; margin-bottom: 8px; display: block;">
                                    Rating
                                </label>
                                <select class="form-control" id="editRating" name="rating" required
                                    style="border: 1px solid #ddd; border-radius: 12px; padding: 15px; font-size: 14px; background: #f8f9fa; appearance: none; background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 4 5\'><path fill=\'%23666\' d=\'M2 0L0 2h4zm0 5L0 3h4z\'/></svg>'); background-repeat: no-repeat; background-position: right 15px center; background-size: 12px;">
                                    <option value="">Pilih Rating</option>
                                    <option value="1">⭐ 1 - Buruk</option>
                                    <option value="2">⭐⭐ 2 - Kurang</option>
                                    <option value="3">⭐⭐⭐ 3 - Baik</option>
                                    <option value="4">⭐⭐⭐⭐ 4 - Sangat Baik</option>
                                    <option value="5">⭐⭐⭐⭐⭐ 5 - Excellent</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer" style="border: none; padding: 20px 30px 30px 30px; background: white; border-radius: 0 0 20px 20px;">
                            <button type="button" class="btn" data-dismiss="modal" 
                                style="background: #f8f9fa; color: #666; border: 1px solid #ddd; border-radius: 12px; padding: 12px 24px; font-weight: 500; margin-right: 15px; cursor: pointer;" 
                                onclick="$('#editFeedbackModal').modal('hide');">
                                Batal
                            </button>
                            <button type="submit" class="btn" 
                                style="background: #e67e22; color: white; border: none; border-radius: 12px; padding: 12px 24px; font-weight: 500; box-shadow: 0 2px 8px rgba(230, 126, 34, 0.3);">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
</div>

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
    margin-left: 250px; /* biar ga ketimpa sidebar */
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
    color: #8B7355;
    font-size: 1.5rem;
    flex-shrink: 0;
    overflow: hidden;
    padding: 8px;
    position: relative;
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
    color: #4CAF50;
}

.summary-icon.monthly {
    background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
    border-color: rgba(33, 150, 243, 0.15);
    color: #2196F3;
}

.summary-icon.positive {
    background: linear-gradient(135deg, #FFF3E0 0%, #FFCC99 100%);
    border-color: rgba(255, 152, 0, 0.15);
    color: #FF9800;
}

.summary-content {
    flex: 1;
}

.summary-number {
    font-size: 2rem;
    font-weight: 800;
    color: #6B4F3A;
    margin-bottom: 4px;
    line-height: 1;
}

.summary-label {
    color: #A97B5D;
    font-size: 0.9rem;
    font-weight: 600;
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

/* Table Styles */
.table-container {
    overflow-x: auto;
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 24px;
}

.feedback-table {
    width: 100%;
    min-width: 800px;
    background: #fff;
    border-collapse: collapse;
}

.feedback-table thead   tr {
    background: linear-gradient(135deg, #fff 0%, #fefefe 100%);
}

.feedback-table th {
    color: #6B4F3A;
    padding: 20px 16px;
    font-weight: 700;
    text-align: left;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid rgba(169, 123, 93, 0.1);
}

.feedback-table th:first-child {
    text-align: center;
    width: 80px;
}

.feedback-table th:nth-child(3),
.feedback-table th:nth-child(4) {
    text-align: center;
}

.feedback-table th:last-child {
    text-align: center;
    width: 160px;
}

.feedback-table td {
    padding: 20px 16px;
    border-bottom: 1px solid rgba(240, 240, 240, 0.8);
    color: #6B4F3A;
    vertical-align: middle;
    font-weight: 500;
}

.feedback-table tbody tr {
    transition: all 0.3s ease;
}

.feedback-table tbody tr:hover {
    background: rgba(229, 115, 0, 0.02);
    transform: scale(1.002);
}

/* Table Cell Specific Styles */
.feedback-table td:first-child {
    text-align: center;
    font-weight: 600;
    color: #E57300;
}

.feedback-table td:nth-child(3),
.feedback-table td:nth-child(4) {
    text-align: center;
}

.feedback-table td:last-child {
    text-align: center;
}

.feedback-text {
    max-width: 400px;
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
    justify-content: center;
    gap: 4px;
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
    gap: 0px;
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

.btn-reply {
    background: #E57300;
    color: #fff;
}

.btn-reply:hover {
    background: #E57300;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

.btn-delete {
    background: #DC3545;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-left: 4px;
}

.btn-edit {
    background: #F4A460;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-right: 4px;
}

.btn-edit:hover {
    background: #E67E22;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(244, 164, 96, 0.3);
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
    color: #8B7355;
    background: #FEFEFE;
    border-radius: 12px;
    margin: 20px 0;
    border: 1px solid rgba(169, 123, 93, 0.1);
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
    text-align: center;
}

.pagination-nav {
    display: inline-block;
    margin: 0 auto;
}

/* Bootstrap Pagination Custom Styling */
.pagination {
    margin: 0;
    gap: 4px;
    flex-wrap: nowrap;
    display: flex !important;
    flex-direction: row !important;
}

.page-item {
    display: inline-block !important;
}

.page-item .page-link {
    color: #F9D9A7;
    background-color: #FFFFFF;
    border: 2px solid #E8DDD4;
    border-radius: 8px;
    padding: 8px 12px;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    text-decoration: none;
    min-width: 40px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    display: inline-block !important;
    vertical-align: middle;
}

.page-item .page-link:hover {
    color: #F9D9A7;
    background-color: #F5F0E8;
    border-color: #D4C4B0;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.page-item.active .page-link {
    color: #FFFFFF;
    background: linear-gradient(135deg, #A97B5D, #8B6F47);
    border-color: #A97B5D;
    box-shadow: 0 4px 12px rgba(169, 123, 93, 0.3);
}

.page-item.active .page-link:hover {
    color: #FFFFFF;
    background: linear-gradient(135deg, #8B6F47, #6B4F3A);
    border-color: #8B6F47;
}

.page-item.disabled .page-link {
    color: #C4B5A0;
    background-color: #F8F6F3;
    border-color: #E8DDD4;
    cursor: not-allowed;
    opacity: 0.6;
}

.page-item.disabled .page-link:hover {
    color: #C4B5A0;
    background-color: #F8F6F3;
    border-color: #E8DDD4;
    transform: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.page-item:first-child .page-link,
.page-item:last-child .page-link {
    border-radius: 8px;
}

/* Pagination info styling */
.pagination-info {
    color: #8B7355;
    font-size: 0.9rem;
    font-weight: 500;
    white-space: nowrap;
}

/* Edit Modal Styling */
.edit-modal-content {
    border: none;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.edit-modal-header {
    background: linear-gradient(135deg, #A97B5D, #8B6F47);
    color: white;
    border-radius: 15px 15px 0 0;
    padding: 20px 25px;
    border-bottom: none;
}

.edit-modal-header .modal-title {
    font-weight: 700;
    font-size: 1.3rem;
}

.edit-modal-header .btn-close {
    filter: invert(1);
    opacity: 0.8;
}

.edit-modal-body {
    padding: 25px;
    background: #FEFEFE;
}

.edit-label {
    font-weight: 600;
    color: #6B4F3A;
    font-size: 1rem;
    margin-bottom: 8px;
}

.edit-textarea {
    border: 2px solid #E8DDD4;
    border-radius: 10px;
    padding: 15px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    resize: vertical;
}

.edit-textarea:focus {
    border-color: #A97B5D;
    box-shadow: 0 0 0 0.2rem rgba(169, 123, 93, 0.25);
}

.edit-select {
    border: 2px solid #E8DDD4;
    border-radius: 10px;
    padding: 12px 15px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.edit-select:focus {
    border-color: #A97B5D;
    box-shadow: 0 0 0 0.2rem rgba(169, 123, 93, 0.25);
}

.edit-preview {
    background: linear-gradient(135deg, #F7F5F2, #FFEEE5);
    border: 2px solid #E8DDD4;
    border-radius: 12px;
    padding: 20px;
    margin-top: 20px;
}

.preview-title {
    color: #6B4F3A;
    font-weight: 700;
    margin-bottom: 15px;
    font-size: 1rem;
}

.preview-content {
    background: white;
    border-radius: 8px;
    padding: 15px;
    border: 1px solid #E8DDD4;
}

.preview-rating {
    font-weight: 600;
    color: #E57300;
    margin-bottom: 10px;
    font-size: 0.95rem;
}

.preview-message {
    color: #6B4F3A;
    font-style: italic;
    line-height: 1.5;
}

.edit-modal-footer {
    background: #F8F6F3;
    border-radius: 0 0 15px 15px;
    padding: 20px 25px;
    border-top: 1px solid #E8DDD4;
}

.edit-btn-cancel {
    background: #6c757d;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.edit-btn-cancel:hover {
    background: #5a6268;
    transform: translateY(-1px);
}

.edit-btn-save {
    background: linear-gradient(135deg, #A97B5D, #8B6F47);
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.edit-btn-save:hover {
    background: linear-gradient(135deg, #8B6F47, #6B4F3A);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(169, 123, 93, 0.3);
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

    .summary-number {
        font-size: 1.8rem;
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

    .feedback-table th,
    .feedback-table td {
        padding: 16px 12px;
        font-size: 0.85rem;
    }

    .action-buttons {
        flex-direction: column;
        gap: 6px;
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
        font-size: 1.3rem;
    }

    .summary-number {
        font-size: 1.6rem;
    }

    .feedback-table th,
    .feedback-table td {
        padding: 12px 8px;
        font-size: 0.8rem;
    }

    .feedback-text {
        max-width: 250px;
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
// No notification functionality needed

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const modal = document.querySelector('.modal.show');
        if (modal) {
            const modalInstance = bootstrap.Modal.getInstance(modal);
            if (modalInstance) {
                modalInstance.hide();
            }
        }
    }
});

// Initialize when document is ready
document.addEventListener('DOMContentLoaded', function() {
    // Function to handle feedback editing
    window.editFeedback = function(id, message, rating) {
        const editModal = new bootstrap.Modal(document.getElementById('editFeedbackModal'));
        const form = document.getElementById('editFeedbackForm');
        
        // Set form values
        form.querySelector('input[name="feedback_id"]').value = id;
        form.querySelector('textarea[name="message"]').value = message;
        form.querySelector('select[name="rating"]').value = rating;
        
        // Show the modal
        editModal.show();
    };
    
    // Function to handle feedback deletion
    window.deleteFeedback = function(id) {
        if (confirm('Are you sure you want to delete this feedback?')) {
            fetch(`/admin/feedback/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove the deleted row
                    const row = document.querySelector(`tr[data-id="${id}"]`);
                    if (row) {
                        row.remove();
                        showNotification('success', 'Feedback deleted successfully');
                    }
                } else {
                    throw new Error(data.message || 'Error deleting feedback');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('error', 'Error deleting feedback: ' + error.message);
            });
        }
    };
    
    // Show notification function
    function showNotification(type, message) {
        // Simple notification using browser's alert
        alert(`${type === 'success' ? '✅' : '❌'} ${message}`);
    }

    // Edit feedback function - simple approach
    window.editFeedback = function(id, message, rating) {
        console.log('Edit feedback called:', id, message, rating);
        
        // Set form values directly
        document.getElementById('editFeedbackId').value = id;
        document.getElementById('editMessage').value = message;
        document.getElementById('editRating').value = rating;
        
        // Update preview
        updatePreview();
        
        // Show modal - try multiple methods
        try {
            // Method 1: jQuery
            if (typeof $ !== 'undefined') {
                $('#editFeedbackModal').modal('show');
            } 
            // Method 2: Bootstrap 4 vanilla JS
            else if (typeof bootstrap !== 'undefined') {
                var modal = new bootstrap.Modal(document.getElementById('editFeedbackModal'));
                modal.show();
            }
            // Method 3: Direct style manipulation
            else {
                var modal = document.getElementById('editFeedbackModal');
                modal.style.display = 'block';
                modal.classList.add('show');
                document.body.classList.add('modal-open');
                
                // Add backdrop
                var backdrop = document.createElement('div');
                backdrop.className = 'modal-backdrop fade show';
                document.body.appendChild(backdrop);
            }
        } catch (error) {
            console.error('Error showing modal:', error);
            alert('Modal error. ID: ' + id + ', Message: ' + message + ', Rating: ' + rating);
        }
    };

    // Delete feedback function
    window.deleteFeedback = function(event, id) {
        if (confirm('Apakah Anda yakin ingin menghapus feedback ini? Data akan dihapus secara permanen!')) {
            // Get the feedback row element
            const feedbackRow = document.querySelector(`tr[data-feedback-id="${id}"]`);
            
            // Show loading state
            const deleteBtn = event.target.closest('.btn-delete');
            const originalText = deleteBtn.innerHTML;
            deleteBtn.innerHTML = '<i class="bi bi-arrow-clockwise"></i> Menghapus...';
            deleteBtn.disabled = true;
            
            // Add CSRF token to headers
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Send AJAX request to delete
            fetch(`/admin/feedback/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { 
                        throw new Error(err.message || 'Gagal menghapus feedback');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data && data.success) {
                    // Remove the feedback row from the table with animation
                    if (feedbackRow) {
                        feedbackRow.style.transition = 'all 0.3s ease';
                        feedbackRow.style.opacity = '0';
                        setTimeout(() => {
                            feedbackRow.remove();
                            // Show success message
                            showNotification('success', 'Feedback berhasil dihapus');
                            // Update pagination or counters if needed
                            updateFeedbackSummary();
                        }, 300);
                    }
                } else {
                    throw new Error(data?.message || 'Gagal menghapus feedback');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('error', 'Terjadi kesalahan: ' + (error.message || 'Tidak dapat menghapus feedback'));
                // Re-enable the button on error
                if (deleteBtn) {
                    deleteBtn.innerHTML = originalText;
                    deleteBtn.disabled = false;
                }
            });
        }
    };

    // Initialize filters from URL parameters
    function initializeFilters() {
        const params = new URLSearchParams(window.location.search);
        
        // Set search input
        if (params.has('search')) {
            searchInput.value = params.get('search');
        }
        
        // Set rating filter
        if (params.has('rating')) {
            const rating = params.get('rating');
            if (rating && ratingFilter.querySelector(`option[value="${rating}"]`)) {
                ratingFilter.value = rating;
            }
        }
        
        // Apply filters
        filterFeedbacks();
    }

    // Debounce function to limit API calls during typing
    function debounce(func, wait) {
        let timeout;
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                func.apply(context, args);
            }, wait);
        };
    }

    // Event listeners
    if (ratingFilter) {
        ratingFilter.addEventListener('change', () => loadFeedbacks());
    }
    
    if (searchInput) {
        searchInput.addEventListener('input', debounce(() => loadFeedbacks(), 300));
    }
    
    // Handle browser back/forward buttons
    window.addEventListener('popstate', () => {
        // Get current filter values from URL
        const url = new URL(window.location.href);
        const searchValue = url.searchParams.get('search') || '';
        const ratingValue = url.searchParams.get('rating') || '';
        
        // Update form fields
        if (searchInput) searchInput.value = searchValue;
        if (ratingFilter) ratingFilter.value = ratingValue;
        
        // Reload feedback
        loadFeedbacks();
    });
    
    // Initial load
    loadFeedbacks();

    // Show notification function
    function showNotification(type, message) {
        // You can replace this with a more sophisticated notification system
        // For now, we'll use a simple alert
        const alertType = type === 'success' ? 'success' : 'error';
        const icon = type === 'success' ? '✅' : '❌';
        alert(`${icon} ${message}`);
    }

    // Update feedback summary function
    function updateFeedbackSummary() {
        // This function can be used to update any summary information
        // after feedback is deleted
        const feedbackCount = document.querySelectorAll('tbody tr[data-feedback-id]').length;
        console.log(`Total feedbacks remaining: ${feedbackCount}`);
    }

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

    // Preview functionality
    function updatePreview() {
        const messageEl = document.getElementById('editMessage');
        const ratingEl = document.getElementById('editRating');
        const previewRating = document.getElementById('previewRating');
        const previewMessage = document.getElementById('previewMessage');
        
        if (!messageEl || !ratingEl || !previewRating || !previewMessage) {
            console.log('Preview elements not found');
            return;
        }
        
        const message = messageEl.value;
        const rating = ratingEl.value;
        
        if (rating) {
            const stars = '⭐'.repeat(parseInt(rating));
            previewRating.textContent = `${stars} ${rating}/5 Stars`;
        } else {
            previewRating.textContent = 'No rating selected';
        }
        
        if (message.trim()) {
            previewMessage.textContent = message;
        } else {
            previewMessage.textContent = 'No message entered';
        }
    }

    // Wait for jQuery to be ready
    $(document).ready(function() {
        // Add event listeners for preview
        $('#editMessage').on('input', updatePreview);
        $('#editRating').on('change', updatePreview);
        
        // Test modal functionality
        window.testModal = function() {
            $('#editFeedbackModal').modal('show');
        };
    });

    // Handle edit form submission
    document.getElementById('editFeedbackForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const feedbackId = document.getElementById('editFeedbackId').value;
        
        fetch(`/admin/feedback/${feedbackId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Feedback updated successfully!');
                const modal = bootstrap.Modal.getInstance(document.getElementById('editFeedbackModal'));
                modal.hide();
                location.reload(); // Reload page to update data
            } else {
                alert('Error updating feedback: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating feedback');
        });
    });

    // Initial render
    renderFeedbacks();

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
{{-- @endsection --}}

<!-- Edit Feedback Modal -->
<div class="modal fade" id="editFeedbackModal" tabindex="-1" aria-labelledby="editFeedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFeedbackModalLabel">Edit Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editFeedbackForm" action="{{ route('admin.feedback.update') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="feedback_id" value="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select class="form-select" id="rating" name="rating" required>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reply to Feedback Modal -->
<div class="modal fade" id="replyFeedbackModal" tabindex="-1" aria-labelledby="replyFeedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="replyFeedbackModalLabel">Reply to Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="replyFeedbackForm" action="{{ route('admin.feedback.reply') }}" method="POST">
                @csrf
                <input type="hidden" name="feedback_id" value="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="reply_message" class="form-label">Your Reply</label>
                        <textarea class="form-control" id="reply_message" name="message" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Send Reply</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- --}}