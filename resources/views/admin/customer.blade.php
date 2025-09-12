<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Customer - Pet Boarding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
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
            /* biar ga ketimpa sidebar */
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

        .summary-icon.customers {
            background: linear-gradient(135deg, #E8F5E8 0%, #D4EDDA 100%);
            border-color: rgba(76, 175, 80, 0.15);
            color: #4CAF50;
        }

        .summary-icon.active {
            background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
            border-color: rgba(33, 150, 243, 0.15);
            color: #2196F3;
        }

        .summary-icon.pets {
            background: linear-gradient(135deg, #FFF3E0 0%, #FFCC99 100%);
            border-color: rgba(255, 152, 0, 0.15);
            color: #FF9800;
        }

        .summary-icon.orders {
            background: linear-gradient(135deg, #F5E6D3 0%, #E8D5C4 100%);
            border-color: rgba(139, 115, 85, 0.15);
            color: #8B7355;
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

        /* Add Customer Button */
        .btn-add-customer {
            background: #E57300;
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .btn-add-customer:hover {
            background: #D16500;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(229, 115, 0, 0.3);
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 24px;
        }

        .customer-table {
            width: 100%;
            min-width: 800px;
            background: #fff;
            border-collapse: collapse;
        }

        .customer-table thead tr {
            background: linear-gradient(135deg, #FFE0B2, #F9D9A7);
        }

        .customer-table th {
            color: #6B4F3A;
            padding: 20px 16px;
            font-weight: 700;
            text-align: left;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid rgba(169, 123, 93, 0.1);
        }

        .customer-table th:first-child {
            width: 60px;
            text-align: center;
        }

        .customer-table th:nth-child(5) {
            text-align: center;
            width: 120px;
        }

        .customer-table th:last-child {
            text-align: center;
            width: 180px;
        }

        .customer-table td {
            padding: 20px 16px;
            border-bottom: 1px solid rgba(240, 240, 240, 0.8);
            color: #6B4F3A;
            vertical-align: middle;
            font-weight: 500;
        }

        .customer-table tbody tr {
            transition: all 0.3s ease;
        }

        .customer-table tbody tr:hover {
            background: rgba(229, 115, 0, 0.02);
            transform: scale(1.002);
        }

        /* Table Cell Specific Styles */
        .customer-table td:first-child {
            text-align: center;
            font-weight: 600;
            color: #E57300;
        }

        .customer-table td:nth-child(5) {
            text-align: center;
        }

        .customer-table td:last-child {
            text-align: center;
        }

        .customer-name {
            font-weight: 600;
            color: #6B4F3A;
            margin-bottom: 4px;
        }

        .customer-email {
            color: #A97B5D;
            font-size: 0.85rem;
        }

        .customer-phone {
            font-weight: 500;
            color: #6B4F3A;
        }

        .customer-address {
            max-width: 250px;
            line-height: 1.4;
            color: #6B4F3A;
            font-size: 0.9rem;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active {
            background: rgba(76, 175, 80, 0.15);
            color: #4CAF50;
        }

        .status-inactive {
            background: rgba(244, 67, 54, 0.15);
            color: #F44336;
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
            padding: 8px 12px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-transform: capitalize;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .btn-view {
            background: #2196F3;
            color: #fff;
        }

        .btn-view:hover {
            background: #0b7dda;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(33, 150, 243, 0.3);
        }

        .btn-edit {
            background: #FF9800;
            color: #fff;
        }

        .btn-edit:hover {
            background: #e68a00;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 152, 0, 0.3);
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

            .customer-table th,
            .customer-table td {
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
                font-size: 1.3rem;
            }

            .summary-number {
                font-size: 1.6rem;
            }

            .customer-table th,
            .customer-table td {
                padding: 12px 8px;
                font-size: 0.8rem;
            }

            .customer-address {
                max-width: 150px;
            }

            .action-btn {
                padding: 6px 10px;
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

        .summary-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .summary-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .summary-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .summary-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .content-card {
            animation-delay: 0.5s;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(107, 79, 58, 0.7);
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-container {
            background: linear-gradient(135deg, #fff 0%, #fefefe 100%);
            border-radius: 24px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(107, 79, 58, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.5);
            transform: translateY(30px);
            opacity: 0;
            transition: all 0.4s ease;
            padding: 50px;
        }

        .modal-overlay.active .modal-container {
            transform: translateY(0);
            opacity: 1;
        }

        .modal-header {
            padding: 24px 32px 16px;
            border-bottom: 1px solid rgba(169, 123, 93, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-weight: 800;
            font-size: 1.5rem;
            color: #6B4F3A;
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #A97B5D;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-close:hover {
            background: rgba(169, 123, 93, 0.1);
            color: #6B4F3A;
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 24px 32px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #6B4F3A;
            font-size: 0.9rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            background: #F7F5F2;
            border: 1px solid rgba(169, 123, 93, 0.2);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.9rem;
            color: #6B4F3A;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #E57300;
            box-shadow: 0 0 0 3px rgba(229, 115, 0, 0.1);
            background: #fff;
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: #A97B5D;
            opacity: 0.7;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-checkbox {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .form-checkbox input {
            width: 18px;
            height: 18px;
            accent-color: #E57300;
        }

        .form-checkbox-label {
            color: #6B4F3A;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .modal-footer {
            padding: 16px 32px 24px;
            border-top: 1px solid rgba(169, 123, 93, 0.2);
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .modal-btn {
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-cancel {
            background: #F7F5F2;
            color: #6B4F3A;
        }

        .btn-cancel:hover {
            background: #e8e5e0;
            transform: translateY(-2px);
        }

        .btn-save {
            background: #E57300;
            color: #fff;
        }

        .btn-save:hover {
            background: #D16500;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(229, 115, 0, 0.3);
        }

        /* Responsive for modal */
        @media (max-width: 768px) {
            .modal-container {
                width: 95%;
                border-radius: 16px;
            }

            .modal-header,
            .modal-body,
            .modal-footer {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .modal-title {
                font-size: 1.3rem;
            }

            .modal-footer {
                flex-direction: column;
            }

            .modal-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    @extends ('layouts.app')
    @include ('layoutadmin.navbar')
    <div class="dashboard-root">
        <!-- Main Content -->
        <main class="dashboard-main">
            <!-- Header -->
            <x-dashboard-header 
                title="Customer Management"
                subtitle="Manajemen Data Customer Pet Boarding"
                icon="users"
            />

            <!-- Stats Summary -->
            <div class="stats-summary">
                <div class="summary-card">
                    <div class="summary-icon customers">
                        <img src="{{ asset('images/customer.svg') }}" alt="Customers" class="icon-image">
                    </div>
                    <div class="summary-content">
                        <div class="summary-number" id="totalCustomers">125</div>
                        <div class="summary-label">Total Customers</div>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-icon active">
                        <img src="{{ asset('images/active.svg') }}" alt="Active" class="icon-image">
                    </div>
                    <div class="summary-content">
                        <div class="summary-number">98</div>
                        <div class="summary-label">Active Customers</div>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-icon pets">
                        <img src="{{ asset('images/pets.svg') }}" alt="Pets" class="icon-image">
                    </div>
                    <div class="summary-content">
                        <div class="summary-number">156</div>
                        <div class="summary-label">Total Pets</div>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-icon orders">
                        <img src="{{ asset('images/orders.svg') }}" alt="Orders" class="icon-image">
                    </div>
                    <div class="summary-content">
                        <div class="summary-number">342</div>
                        <div class="summary-label">Total Orders</div>
                    </div>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="content-card">
                <!-- Header with Search and Filters -->
                <div class="content-header">
                    <div class="content-info">
                        <div class="content-title">Data Customer</div>
                        <div class="content-subtitle">Kelola dan pantau data customer pet boarding</div>
                    </div>
                    <div class="content-controls">
                        <!-- Status Filter -->
                        <select id="statusFilter" class="filter-select">
                            <option value="">Semua Status</option>
                            <option value="active">Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>
                        <!-- Search Bar -->
                        <div class="search-box">
                            <i class="bi bi-search"></i>
                            <input type="text" id="searchInput" placeholder="Cari customer..." class="search-input">
                        </div>
                        <!-- Add Customer Button -->
                        <button class="btn-add-customer" onclick="addCustomer()">
                            <i class="bi bi-plus-circle"></i> Tambah Customer
                        </button>
                    </div>
                </div>

                <!-- Customer Table -->
                <div class="table-container">
                    <table class="customer-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Customer</th>
                                <th>Kontak</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="customerTableBody">
                            <!-- Customer rows will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- No Customer Message -->
                <div id="noCustomerMessage" class="no-data-message" style="display:none;">
                    <div class="no-data-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="no-data-title">Tidak ada customer</div>
                    <div class="no-data-subtitle">Tidak ada data customer yang ditemukan.</div>
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

    <!-- Modal Edit Customer -->
    <div class="modal-overlay" id="editCustomerModal">
        <div class="modal-container">
            <div class="modal-header">
                <h2 class="modal-title">Edit Data Customer</h2>
                <button class="modal-close" onclick="closeModal()">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="editCustomerForm">
                    <input type="hidden" id="editCustomerId">

                    <div class="form-row">
                        <div class="form-group">
                            <label for="editCustomerName" class="form-label">Nama Lengkap</label>
                            <input type="text" id="editCustomerName" class="form-input"
                                placeholder="Masukkan nama customer" required>
                        </div>

                        <div class="form-group">
                            <label for="editCustomerEmail" class="form-label">Email</label>
                            <input type="email" id="editCustomerEmail" class="form-input"
                                placeholder="Masukkan alamat email" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="editCustomerPhone" class="form-label">Nomor Telepon</label>
                            <input type="tel" id="editCustomerPhone" class="form-input"
                                placeholder="Masukkan nomor telepon" required>
                        </div>

                        <div class="form-group">
                            <label for="editCustomerPets" class="form-label">Jumlah Hewan</label>
                            <input type="number" id="editCustomerPets" class="form-input" min="0"
                                placeholder="Jumlah hewan" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="editCustomerAddress" class="form-label">Alamat Lengkap</label>
                        <textarea id="editCustomerAddress" class="form-textarea" placeholder="Masukkan alamat lengkap"
                            required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="form-checkbox">
                            <input type="checkbox" id="editCustomerStatus">
                            <span class="form-checkbox-label">Aktif (customer dapat melakukan pemesanan)</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="modal-btn btn-cancel" onclick="closeModal()">Batal</button>
                <button class="modal-btn btn-save" onclick="saveCustomer()">Simpan Perubahan</button>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="addCustomerModal">
        <div class="modal-container">
            <div class="modal-header">
                <h2 class="modal-title">Tambah Data Customer</h2>
                <button class="modal-close" onclick="closeAddModal()">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="addCustomerForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="addCustomerName" class="form-label">Nama Lengkap</label>
                            <input type="text" id="addCustomerName" class="form-input"
                                placeholder="Masukkan nama customer" required>
                        </div>
                        <div class="form-group">
                            <label for="addCustomerEmail" class="form-label">Email</label>
                            <input type="email" id="addCustomerEmail" class="form-input"
                                placeholder="Masukkan alamat email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="addCustomerPhone" class="form-label">Nomor Telepon</label>
                            <input type="tel" id="addCustomerPhone" class="form-input"
                                placeholder="Masukkan nomor telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="addCustomerPets" class="form-label">Jumlah Hewan</label>
                            <input type="number" id="addCustomerPets" class="form-input" min="0"
                                placeholder="Jumlah hewan" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="addCustomerAddress" class="form-label">Alamat Lengkap</label>
                        <textarea id="addCustomerAddress" class="form-textarea" placeholder="Masukkan alamat lengkap"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="form-checkbox">
                            <input type="checkbox" id="addCustomerStatus">
                            <span class="form-checkbox-label">Aktif (customer dapat melakukan pemesanan)</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="modal-btn btn-cancel" onclick="closeAddModal()">Batal</button>
                <button class="modal-btn btn-save" onclick="submitAddCustomer()">Tambah Customer</button>
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
    </main>
</div>

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
        // Sample customer data
        const customers = [
            {
                id: 1,
                name: 'Ahmad Rizky',
                email: 'ahmad.rizky@email.com',
                phone: '081234567890',
                address: 'Jl. Merdeka No. 123, Jakarta Pusat',
                status: 'active',
                pets: 2,
                orders: 5
            },
            {
                id: 2,
                name: 'Siti Nurhaliza',
                email: 'siti.nurhaliza@email.com',
                phone: '081298765432',
                address: 'Jl. Sudirman Kav. 45, Jakarta Selatan',
                status: 'active',
                pets: 1,
                orders: 3
            },
            {
                id: 3,
                name: 'Budi Santoso',
                email: 'budi.santoso@email.com',
                phone: '081312345678',
                address: 'Jl. Gatot Subroto No. 78, Jakarta Barat',
                status: 'active',
                pets: 3,
                orders: 8
            },
            {
                id: 4,
                name: 'Dewi Lestari',
                email: 'dewi.lestari@email.com',
                phone: '081387654321',
                address: 'Jl. Thamrin No. 56, Jakarta Pusat',
                status: 'inactive',
                pets: 1,
                orders: 2
            },
            {
                id: 5,
                name: 'Rudi Hermawan',
                email: 'rudi.hermawan@email.com',
                phone: '081512345678',
                address: 'Jl. Kebon Jeruk Raya No. 99, Jakarta Barat',
                status: 'active',
                pets: 2,
                orders: 4
            },
            {
                id: 6,
                name: 'Maya Sari',
                email: 'maya.sari@email.com',
                phone: '081598765432',
                address: 'Jl. Panglima Polim No. 34, Jakarta Selatan',
                status: 'active',
                pets: 1,
                orders: 6
            },
            {
                id: 7,
                name: 'Joko Widodo',
                email: 'joko.widodo@email.com',
                phone: '081612345678',
                address: 'Jl. Rasuna Said No. 67, Jakarta Selatan',
                status: 'inactive',
                pets: 2,
                orders: 3
            },
            {
                id: 8,
                name: 'Ani Wijaya',
                email: 'ani.wijaya@email.com',
                phone: '081698765432',
                address: 'Jl. Senopati No. 12, Jakarta Selatan',
                status: 'active',
                pets: 1,
                orders: 7
            },
            {
                id: 9,
                name: 'Hendra Kurniawan',
                email: 'hendra.kurniawan@email.com',
                phone: '081712345678',
                address: 'Jl. Kemang Raya No. 45, Jakarta Selatan',
                status: 'active',
                pets: 3,
                orders: 9
            },
            {
                id: 10,
                name: 'Rina Melati',
                email: 'rina.melati@email.com',
                phone: '081798765432',
                address: 'Jl. Cipete Raya No. 23, Jakarta Selatan',
                status: 'inactive',
                pets: 1,
                orders: 1
            },
            {
                id: 11,
                name: 'Fajar Pratama',
                email: 'fajar.pratama@email.com',
                phone: '081812345678',
                address: 'Jl. Pondok Indah No. 78, Jakarta Selatan',
                status: 'active',
                pets: 2,
                orders: 5
            },
            {
                id: 12,
                name: 'Lina Marlina',
                email: 'lina.marlina@email.com',
                phone: '081898765432',
                address: 'Jl. Kelapa Gading Boulevard No. 56, Jakarta Utara',
                status: 'active',
                pets: 1,
                orders: 4
            },
            {
                id: 13,
                name: 'Agus Suparman',
                email: 'agus.suparman@email.com',
                phone: '081912345678',
                address: 'Jl. Pluit Raya No. 34, Jakarta Utara',
                status: 'active',
                pets: 2,
                orders: 6
            },
            {
                id: 14,
                name: 'Dian Pertiwi',
                email: 'dian.pertiwi@email.com',
                phone: '081998765432',
                address: 'Jl. Mangga Besar No. 67, Jakarta Barat',
                status: 'inactive',
                pets: 1,
                orders: 2
            },
            {
                id: 15,
                name: 'Eko Prasetyo',
                email: 'eko.prasetyo@email.com',
                phone: '082112345678',
                address: 'Jl. Pasar Minggu No. 89, Jakarta Selatan',
                status: 'active',
                pets: 3,
                orders: 8
            },
            {
                id: 16,
                name: 'Fitri Handayani',
                email: 'fitri.handayani@email.com',
                phone: '082198765432',
                address: 'Jl. Cilandak KKO No. 12, Jakarta Selatan',
                status: 'active',
                pets: 1,
                orders: 3
            },
            {
                id: 17,
                name: 'Gunawan Wibisono',
                email: 'gunawan.wibisono@email.com',
                phone: '082212345678',
                address: 'Jl. Tanah Abang No. 45, Jakarta Pusat',
                status: 'inactive',
                pets: 2,
                orders: 4
            },
            {
                id: 18,
                name: 'Hana Safitri',
                email: 'hana.safitri@email.com',
                phone: '082298765432',
                address: 'Jl. Kemayoran No. 78, Jakarta Pusat',
                status: 'active',
                pets: 1,
                orders: 5
            },
            {
                id: 19,
                name: 'Irfan Maulana',
                email: 'irfan.maulana@email.com',
                phone: '082312345678',
                address: 'Jl. Casablanca No. 56, Jakarta Selatan',
                status: 'active',
                pets: 2,
                orders: 7
            },
            {
                id: 20,
                name: 'Juliastuti',
                email: 'juli.astuti@email.com',
                phone: '082398765432',
                address: 'Jl. Tebet Barat No. 34, Jakarta Selatan',
                status: 'active',
                pets: 1,
                orders: 4
            }
        ];

        // Global variables
        let filteredCustomers = [...customers];
        let currentPage = 1;
        const itemsPerPage = 8;

        // DOM elements
        const statusFilter = document.getElementById('statusFilter');
        const searchInput = document.getElementById('searchInput');
        const customerTableBody = document.getElementById('customerTableBody');
        const noCustomerMessage = document.getElementById('noCustomerMessage');
        const paginationContainer = document.getElementById('paginationContainer');
        const pageInfo = document.getElementById('pageInfo');
        const searchStatus = document.getElementById('searchStatus');
        const totalCustomersElement = document.getElementById('totalCustomers');

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function () {
            renderCustomers();

            // Add event listeners
            statusFilter.addEventListener('change', filterCustomers);
            searchInput.addEventListener('input', debounce(filterCustomers, 300));

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

        // Function to render customers
        function renderCustomers() {
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const currentCustomers = filteredCustomers.slice(startIndex, endIndex);

            if (currentCustomers.length === 0) {
                customerTableBody.innerHTML = '';
                noCustomerMessage.style.display = 'block';
                paginationContainer.parentElement.style.display = 'none';
            } else {
                noCustomerMessage.style.display = 'none';
                paginationContainer.parentElement.style.display = 'flex';

                customerTableBody.innerHTML = currentCustomers.map((customer, index) => {
                    const globalIndex = startIndex + index + 1;
                    const statusClass = customer.status === 'active' ? 'status-active' : 'status-inactive';
                    const statusText = customer.status === 'active' ? 'Aktif' : 'Tidak Aktif';

                    return `
                        <tr data-status="${customer.status}">
                            <td>${globalIndex}</td>
                            <td>
                                <div class="customer-name">${customer.name}</div>
                                <div class="customer-email">${customer.email}</div>
                            </td>
                            <td>
                                <div class="customer-phone">${customer.phone}</div>
                            </td>
                            <td>
                                <div class="customer-address">${customer.address}</div>
                            </td>
                            <td>
                                <span class="status-badge ${statusClass}">${statusText}</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn btn-view" onclick="viewCustomer(${customer.id})">
                                        <i class="bi bi-eye"></i> Lihat
                                    </button>
                                    <button class="action-btn btn-edit" onclick="editCustomer(${customer.id})">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="action-btn btn-delete" onclick="deleteCustomer(${customer.id})">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                }).join('');
            }

            // Update total customer count
            totalCustomersElement.textContent = filteredCustomers.length;

            // Render pagination
            renderPagination();

            // Render page info
            renderPageInfo();

            // Render search status
            renderSearchStatus();

            // Update statistics
            updateStatistics();
        }

        // Function to render page info
        function renderPageInfo() {
            const totalPages = Math.ceil(filteredCustomers.length / itemsPerPage);
            const startIndex = (currentPage - 1) * itemsPerPage + 1;
            const endIndex = Math.min(currentPage * itemsPerPage, filteredCustomers.length);

            if (filteredCustomers.length === 0) {
                pageInfo.innerHTML = 'Tidak ada customer untuk ditampilkan';
            } else {
                pageInfo.innerHTML = `Menampilkan ${startIndex}-${endIndex} dari ${filteredCustomers.length} customer (Halaman ${currentPage} dari ${totalPages})`;
            }
        }

        // Function to render search status
        function renderSearchStatus() {
            const searchTerm = searchInput.value.trim();
            const selectedStatus = statusFilter.value;

            if (searchTerm || selectedStatus) {
                const filters = [];
                if (searchTerm) filters.push(`"${searchTerm}"`);
                if (selectedStatus) filters.push(`status ${selectedStatus}`);
                searchStatus.innerHTML = `Filter diterapkan: ${filters.join(', ')}`;
                searchStatus.style.display = 'inline-block';
            } else {
                searchStatus.innerHTML = 'Menampilkan semua customer';
                searchStatus.style.display = 'inline-block';
            }
        }

        // Function to render pagination
        function renderPagination() {
            const totalPages = Math.ceil(filteredCustomers.length / itemsPerPage);

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
        function changePage(page) {
            const totalPages = Math.ceil(filteredCustomers.length / itemsPerPage);
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                renderCustomers();
                // Smooth scroll to top of table
                document.querySelector('.content-card').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }

        // Function to filter customers
        function filterCustomers() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const selectedStatus = statusFilter.value;

            filteredCustomers = customers.filter(customer => {
                const matchesSearch = !searchTerm ||
                    customer.name.toLowerCase().includes(searchTerm) ||
                    customer.email.toLowerCase().includes(searchTerm) ||
                    customer.phone.toLowerCase().includes(searchTerm) ||
                    customer.address.toLowerCase().includes(searchTerm);
                const matchesStatus = !selectedStatus || customer.status === selectedStatus;

                return matchesSearch && matchesStatus;
            });

            currentPage = 1; // Reset to first page when filtering
            renderCustomers();
        }

        // Function to update statistics
        function updateStatistics() {
            // Count active customers
            const activeCustomers = filteredCustomers.filter(c => c.status === 'active').length;

            // Calculate total pets
            const totalPets = filteredCustomers.reduce((sum, customer) => sum + customer.pets, 0);

            // Calculate total orders
            const totalOrders = filteredCustomers.reduce((sum, customer) => sum + customer.orders, 0);

            // Update DOM elements
            document.querySelector('.summary-card:nth-child(2) .summary-number').textContent = activeCustomers;
            document.querySelector('.summary-card:nth-child(3) .summary-number').textContent = totalPets;
            document.querySelector('.summary-card:nth-child(4) .summary-number').textContent = totalOrders;
        }

        // Modal functions
        function openEditModal(customerId) {
            const customer = customers.find(c => c.id === customerId);
            if (customer) {
                // Fill form with customer data
                document.getElementById('editCustomerId').value = customer.id;
                document.getElementById('editCustomerName').value = customer.name;
                document.getElementById('editCustomerEmail').value = customer.email;
                document.getElementById('editCustomerPhone').value = customer.phone;
                document.getElementById('editCustomerAddress').value = customer.address;
                document.getElementById('editCustomerPets').value = customer.pets;
                document.getElementById('editCustomerStatus').checked = customer.status === 'active';

                // Show modal
                document.getElementById('editCustomerModal').classList.add('active');
                document.body.style.overflow = 'hidden'; // Prevent scrolling
            }
        }

        function closeModal() {
            document.getElementById('editCustomerModal').classList.remove('active');
            document.body.style.overflow = ''; // Enable scrolling
        }

        function saveCustomer() {
            const id = parseInt(document.getElementById('editCustomerId').value);
            const name = document.getElementById('editCustomerName').value;
            const email = document.getElementById('editCustomerEmail').value;
            const phone = document.getElementById('editCustomerPhone').value;
            const address = document.getElementById('editCustomerAddress').value;
            const pets = parseInt(document.getElementById('editCustomerPets').value);
            const status = document.getElementById('editCustomerStatus').checked ? 'active' : 'inactive';

            // Basic validation
            if (!name || !email || !phone || !address || isNaN(pets)) {
                alert('Harap isi semua field yang wajib diisi!');
                return;
            }

            // Find customer index
            const index = customers.findIndex(c => c.id === id);
            if (index > -1) {
                // Update customer data
                customers[index] = {
                    ...customers[index],
                    name,
                    email,
                    phone,
                    address,
                    pets,
                    status
                };

                // Re-render table
                filterCustomers();

                // Show success message
                alert('Data customer berhasil diperbarui!');

                // Close modal
                closeModal();
            }
        }

        // Action functions
        function viewCustomer(id) {
            const customer = customers.find(c => c.id === id);
            if (customer) {
                alert(`Detail Customer:\n\nNama: ${customer.name}\nEmail: ${customer.email}\nTelepon: ${customer.phone}\nAlamat: ${customer.address}\nStatus: ${customer.status === 'active' ? 'Aktif' : 'Tidak Aktif'}\nJumlah Hewan: ${customer.pets}\nJumlah Order: ${customer.orders}`);
            }
        }

        function editCustomer(id) {
            openEditModal(id);
        }

        function deleteCustomer(id) {
            const customer = customers.find(c => c.id === id);
            if (customer && confirm(`Apakah Anda yakin ingin menghapus customer ini?\n\n${customer.name}\n${customer.email}`)) {
                // Remove from main array
                const index = customers.findIndex(c => c.id === id);
                if (index > -1) {
                    customers.splice(index, 1);
                    // Re-filter and re-render
                    filterCustomers();
                    alert('Customer berhasil dihapus!');
                }
            }
        }

        // Open Add Customer Modal
        function addCustomer() {
            document.getElementById('addCustomerForm').reset();
            document.getElementById('addCustomerModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        // Close Add Customer Modal
        function closeAddModal() {
            document.getElementById('addCustomerModal').classList.remove('active');
            document.body.style.overflow = '';
        }
        // Save Add Customer
        function submitAddCustomer() {
            const name = document.getElementById('addCustomerName').value.trim();
            const email = document.getElementById('addCustomerEmail').value.trim();
            const phone = document.getElementById('addCustomerPhone').value.trim();
            const address = document.getElementById('addCustomerAddress').value.trim();
            const pets = parseInt(document.getElementById('addCustomerPets').value);
            const status = document.getElementById('addCustomerStatus').checked ? 'active' : 'inactive';

            if (!name || !email || !phone || !address || isNaN(pets)) {
                alert('Harap isi semua field yang wajib diisi!');
                return;
            }

            // Generate new id
            const newId = customers.length ? Math.max(...customers.map(c => c.id)) + 1 : 1;

            customers.push({
                id: newId,
                name,
                email,
                phone,
                address,
                pets,
                status,
                orders: 0 // default order
            });

            filterCustomers();
            alert('Customer baru berhasil ditambahkan!');
            closeAddModal();
        }

        // Close modal when clicking outside
        document.getElementById('addCustomerModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeAddModal();
            }
        });
        // Close modal with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && document.getElementById('addCustomerModal').classList.contains('active')) {
                closeAddModal();
            }
        });

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

        // Close modal when clicking outside
        document.getElementById('editCustomerModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && document.getElementById('editCustomerModal').classList.contains('active')) {
                closeModal();
            }
        });

        // Make functions available globally
        window.changePage = changePage;
        window.viewCustomer = viewCustomer;
        window.editCustomer = editCustomer;
        window.deleteCustomer = deleteCustomer;
        window.addCustomer = addCustomer;
        window.closeModal = closeModal;
        window.saveCustomer = saveCustomer;
        window.closeAddModal = closeAddModal;
        window.submitAddCustomer = submitAddCustomer;
    </script>