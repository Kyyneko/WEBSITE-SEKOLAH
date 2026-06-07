<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('image/Logo.png') }}">
    <meta name="description" content="{{ config('app.name', 'School Website') }} - School Management System">
    <meta name="author" content="School Administration">

    <title>{{ isset($header) ? trim(strip_tags($header)) . ' — ' : '' }}{{ config('app.name', 'School Website') }}</title>

    {{-- Preconnect for Performance --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://unpkg.com">
    <link rel="dns-prefetch" href="https://kit.fontawesome.com">

    {{-- Bootstrap CSS --}}
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">

    {{-- Trix Editor CSS --}}
    <link 
        rel="stylesheet" 
        type="text/css" 
        href="https://unpkg.com/trix@2.0.8/dist/trix.css">

    {{-- SweetAlert2 CSS --}}
    <link 
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    {{-- AOS (Animate On Scroll) CSS --}}
    <link 
        rel="stylesheet" 
        href="https://unpkg.com/aos@next/dist/aos.css">

    {{-- Google Fonts --}}
    <link 
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Font Awesome --}}
    <link 
        rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" 
        referrerpolicy="no-referrer">

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Custom Global Styles --}}
    <style>
        /* ============================
           DASHBOARD DESIGN SYSTEM
        ============================ */
        :root {
            --dash-primary: #1e3a5f;
            --dash-primary-light: #2563eb;
            --dash-accent: #0d9488;
            --dash-accent-light: #14b8a6;
            --dash-warm: #f59e0b;
            --dash-danger: #ef4444;
            --dash-success: #10b981;
            --dash-info: #3b82f6;
            --dash-text: #1e293b;
            --dash-text-light: #64748b;
            --dash-bg: #f1f5f9;
            --dash-bg-card: #ffffff;
            --dash-border: #e2e8f0;
            --dash-radius: 12px;
            --dash-radius-sm: 8px;
            --dash-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
            --dash-shadow-md: 0 4px 6px -1px rgba(0,0,0,0.07), 0 2px 4px -2px rgba(0,0,0,0.05);
            --dash-shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.08), 0 4px 6px -4px rgba(0,0,0,0.05);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: var(--dash-text);
            background-color: var(--dash-bg);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #64748b; }

        /* ============================
           GLOBAL CARD STYLING
        ============================ */
        .card, .bg-white {
            border-radius: var(--dash-radius) !important;
            border: 1px solid var(--dash-border) !important;
            box-shadow: var(--dash-shadow) !important;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            box-shadow: var(--dash-shadow-md) !important;
        }

        .sm\:rounded-lg {
            border-radius: var(--dash-radius) !important;
        }

        /* ============================
           BUTTONS
        ============================ */
        .btn, .btn-lg {
            font-weight: 600 !important;
            font-size: 0.85rem !important;
            border-radius: var(--dash-radius-sm) !important;
            padding: 0.5rem 1.15rem !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: 0.01em;
            border: none;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: var(--dash-shadow-md);
        }

        .btn:active { transform: translateY(0); }

        .btn-primary {
            background: linear-gradient(135deg, var(--dash-primary) 0%, var(--dash-primary-light) 100%);
            color: #fff;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #162d4d 0%, #1d4ed8 100%);
            color: #fff;
        }

        .btn-success {
            background: linear-gradient(135deg, #059669 0%, var(--dash-success) 100%);
            color: #fff;
        }

        .btn-warning {
            background: linear-gradient(135deg, #d97706 0%, var(--dash-warm) 100%);
            color: #fff !important;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc2626 0%, var(--dash-danger) 100%);
            color: #fff !important;
        }

        .btn-info {
            background: linear-gradient(135deg, #2563eb 0%, var(--dash-info) 100%);
            color: #fff;
        }

        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.78rem;
        }

        /* ============================
           TABLES
        ============================ */
        .table {
            font-size: 0.875rem;
            margin-bottom: 0;
        }

        .table thead th {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.72rem;
            letter-spacing: 0.06em;
            color: var(--dash-text-light);
            background: #f8fafc !important;
            border-bottom: 2px solid var(--dash-border);
            padding: 0.85rem 1rem;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 0.85rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            color: var(--dash-text);
        }

        .table-hover tbody tr {
            transition: background-color 0.15s ease;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(37, 99, 235, 0.03) !important;
        }

        .table-responsive {
            border-radius: var(--dash-radius-sm);
            overflow: hidden;
        }

        /* ============================
           BADGES
        ============================ */
        .badge {
            font-weight: 600;
            font-size: 0.72rem;
            letter-spacing: 0.03em;
            padding: 0.4rem 0.75rem;
            border-radius: 6px;
        }

        .badge-primary, .bg-primary {
            background-color: rgba(37, 99, 235, 0.1) !important;
            color: var(--dash-primary-light) !important;
        }

        .badge-success, .bg-success {
            background-color: rgba(16, 185, 129, 0.1) !important;
            color: #059669 !important;
        }

        .badge-info, .bg-info {
            background-color: rgba(59, 130, 246, 0.1) !important;
            color: #2563eb !important;
        }

        .badge-warning, .bg-warning {
            background-color: rgba(245, 158, 11, 0.1) !important;
            color: #d97706 !important;
        }

        .badge-danger, .bg-danger {
            background-color: rgba(239, 68, 68, 0.1) !important;
            color: #dc2626 !important;
        }

        /* ============================
           STAT CARDS
        ============================ */
        .stat-card {
            border: none !important;
            border-radius: var(--dash-radius) !important;
            overflow: hidden;
            position: relative;
        }

        .stat-card .card-body {
            position: relative;
            z-index: 1;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--dash-shadow-lg) !important;
        }

        .stat-card.border-primary { background: linear-gradient(135deg, rgba(37,99,235,0.04) 0%, rgba(37,99,235,0.08) 100%); }
        .stat-card.border-success { background: linear-gradient(135deg, rgba(16,185,129,0.04) 0%, rgba(16,185,129,0.08) 100%); }
        .stat-card.border-info { background: linear-gradient(135deg, rgba(59,130,246,0.04) 0%, rgba(59,130,246,0.08) 100%); }
        .stat-card.border-warning { background: linear-gradient(135deg, rgba(245,158,11,0.04) 0%, rgba(245,158,11,0.08) 100%); }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: var(--dash-radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon i { font-size: 1.25rem !important; }

        /* ============================
           FORMS
        ============================ */
        .form-control, .form-select, .form-control-lg, .form-select-lg {
            border-radius: var(--dash-radius-sm) !important;
            border: 1.5px solid var(--dash-border) !important;
            padding: 0.6rem 0.85rem !important;
            font-size: 0.9rem !important;
            transition: all 0.2s ease;
            height: auto !important;
            color: var(--dash-text) !important;
            background-color: #fff !important;
        }

        .form-control:focus, .form-select:focus, .form-control-lg:focus, .form-select-lg:focus {
            border-color: var(--dash-primary-light) !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12) !important;
            outline: 0 !important;
        }

        .form-control:disabled, .form-control[readonly], .form-select:disabled {
            background-color: #f8fafc !important;
            color: var(--dash-text-light) !important;
            opacity: 0.8 !important;
            border-color: var(--dash-border) !important;
        }

        .form-label {
            font-size: 0.825rem !important;
            font-weight: 600 !important;
            color: var(--dash-text-light) !important;
            text-transform: uppercase !important;
            letter-spacing: 0.04em !important;
            margin-bottom: 0.4rem !important;
            display: inline-block;
        }

        .input-group-text {
            font-size: 0.9rem !important;
            padding: 0.6rem 0.85rem !important;
            border: 1.5px solid var(--dash-border) !important;
            color: var(--dash-text-light) !important;
            background-color: #f8fafc !important;
        }

        /* Trix Editor Font Size Consistency */
        trix-editor {
            font-size: 0.9rem !important;
            color: var(--dash-text) !important;
        }

        .profile-form label {
            text-transform: none !important;
            letter-spacing: normal !important;
        }

        /* Modal Overlay - centered */
        .modal-overlay {
            position: fixed;
            inset: 0;
            overflow-y: auto;
            padding: 1.5rem 1rem;
            z-index: 50;
        }

        .modal-overlay[style*="display: block"] {
            display: flex !important;
            align-items: center;
            justify-content: center;
        }

        .modal-content-box {
            position: relative;
            z-index: 10;
        }

        /* ============================
           AVATAR
        ============================ */
        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            background: linear-gradient(135deg, var(--dash-primary) 0%, var(--dash-primary-light) 100%) !important;
            color: #fff !important;
            flex-shrink: 0;
        }

        /* ============================
           ALERT OVERRIDES
        ============================ */
        .alert {
            border: none;
            border-radius: var(--dash-radius-sm);
            font-size: 0.875rem;
        }

        .alert-info {
            background-color: rgba(59, 130, 246, 0.08);
            color: #1e40af;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.08);
            color: #065f46;
        }

        /* ============================
           PAGE HEADER
        ============================ */
        .bg-red {
            background: linear-gradient(135deg, var(--dash-primary) 0%, var(--dash-primary-light) 100%) !important;
        }

        .bg-red h2 {
            color: #ffffff !important;
        }

        /* ============================
           PAGE HEADER CARD (Uniform Premium Headers)
        ============================ */
        .dash-header-card {
            background: linear-gradient(135deg, var(--dash-primary) 0%, var(--dash-primary-light) 100%) !important;
            border-radius: var(--dash-radius) !important;
            padding: 1.5rem 2rem !important;
            color: #fff !important;
            position: relative !important;
            overflow: hidden !important;
            border: none !important;
            box-shadow: var(--dash-shadow-md) !important;
        }

        .dash-header-card-content {
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
            z-index: 1;
        }

        .dash-header-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
            color: #fff;
        }

        .dash-header-card-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin: 0 0 0.15rem;
            color: #fff;
        }

        .dash-header-card-desc {
            font-size: 0.8rem;
            opacity: 0.75;
            margin: 0;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.85);
        }

        .dash-header-card-deco1 {
            position: absolute;
            top: -50px;
            right: -20px;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }

        .dash-header-card-deco2 {
            position: absolute;
            bottom: -60px;
            right: 120px;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }

        /* ============================
           PREMIUM UPLOAD ZONE
        ============================ */
        .upload-zone-premium {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.25rem 1.5rem;
            border: 2px dashed var(--dash-border);
            border-radius: var(--dash-radius);
            cursor: pointer;
            transition: all 0.2s ease;
            background: #fafbfc;
            width: 100%;
        }

        .upload-zone-premium:hover {
            border-color: var(--dash-primary-light);
            background: rgba(37,99,235,0.02);
        }

        .upload-zone-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(37,99,235,0.08);
            color: var(--dash-primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .upload-zone-text {
            font-size: 0.85rem;
            color: var(--dash-text);
            font-weight: 600;
        }

        .upload-zone-hint {
            font-size: 0.72rem;
            color: var(--dash-text-light);
            margin-top: 0.15rem;
        }

        /* ============================
           PAGINATION
        ============================ */
        .pagination {
            gap: 0.25rem;
        }

        .page-link {
            border-radius: var(--dash-radius-sm) !important;
            border: 1px solid var(--dash-border);
            color: var(--dash-text-light);
            font-size: 0.82rem;
            font-weight: 500;
            padding: 0.4rem 0.75rem;
        }

        .page-item.active .page-link {
            background: var(--dash-primary-light);
            border-color: var(--dash-primary-light);
        }

        /* ============================
           UTILITIES
        ============================ */
        .loading { pointer-events: none; opacity: 0.6; }
        .transition-all { transition: all 0.3s ease-in-out; }
        .swal2-popup { font-family: 'Inter', sans-serif !important; border-radius: var(--dash-radius) !important; }

        /* ============================
           MANAGEMENT PAGES (shared)
        ============================ */
        .mgmt-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--dash-text);
        }

        .mgmt-stat {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.6rem 0.85rem;
            border: 1px solid var(--dash-border);
            border-radius: 10px;
        }

        .mgmt-stat-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .mgmt-stat-val {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--dash-text);
            line-height: 1.2;
        }

        .mgmt-stat-lbl {
            font-size: 0.6rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: var(--dash-text-light);
        }

        .mgmt-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--dash-primary), var(--dash-primary-light));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.75rem;
            flex-shrink: 0;
        }

        .mgmt-icon {
            width: 32px;
            height: 32px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.78rem;
            flex-shrink: 0;
        }

        .mgmt-empty {
            color: var(--dash-text-light);
        }

        .mgmt-empty > i {
            font-size: 2.5rem;
            color: #e2e8f0;
            display: block;
            margin-bottom: 0.5rem;
        }

        .mgmt-empty p {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.15rem;
        }

        .mgmt-no-photo {
            width: 48px;
            height: 36px;
            border-radius: 6px;
            background: var(--dash-bg);
            border: 1.5px solid var(--dash-border);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-size: 0.85rem;
        }

        /* ============================
           SIDEBAR LAYOUT
        ============================ */
        .dash-layout {
            display: flex;
            min-height: 100vh;
        }

        .dash-sidebar {
            width: 260px;
            background: var(--dash-primary);
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .dash-sidebar::-webkit-scrollbar { width: 0; }

        .dash-sidebar-header {
            padding: 1.25rem 1.25rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }

        .dash-sidebar-header img {
            width: 42px;
            height: 42px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .dash-sidebar-brand {
            line-height: 1.2;
        }

        .dash-sidebar-brand-name {
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .dash-sidebar-brand-sub {
            font-size: 0.65rem;
            opacity: 0.5;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .dash-sidebar-nav {
            padding: 0.75rem 0.75rem;
            flex: 1;
        }

        .dash-sidebar-label {
            font-size: 0.6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255,255,255,0.3);
            padding: 0.85rem 0.75rem 0.4rem;
            margin-top: 0.25rem;
        }

        .dash-nav-item {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.6rem 0.75rem;
            border-radius: 8px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 2px;
        }

        .dash-nav-item:hover {
            background: rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.95);
        }

        .dash-nav-item.active {
            background: rgba(255,255,255,0.12);
            color: #fff;
            font-weight: 600;
        }

        .dash-nav-item i {
            width: 18px;
            text-align: center;
            font-size: 0.85rem;
        }

        .dash-sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(255,255,255,0.08);
            flex-shrink: 0;
        }

        .dash-sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .dash-sidebar-user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .dash-sidebar-user-name {
            font-size: 0.8rem;
            font-weight: 600;
            color: rgba(255,255,255,0.9);
        }

        .dash-sidebar-user-role {
            font-size: 0.65rem;
            color: rgba(255,255,255,0.4);
        }

        .dash-sidebar-logout {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.75rem;
            padding: 0.5rem 0.65rem;
            border-radius: 6px;
            background: rgba(239,68,68,0.12);
            color: rgba(255,255,255,0.7);
            border: none;
            width: 100%;
            font-size: 0.75rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .dash-sidebar-logout:hover {
            background: rgba(239,68,68,0.25);
            color: #fff;
        }

        /* ============================
           MAIN CONTENT AREA
        ============================ */
        .dash-main {
            flex: 1;
            margin-left: 260px;
            min-height: 100vh;
            background: var(--dash-bg);
            display: flex;
            flex-direction: column;
        }

        /* ============================
           TOP BAR
        ============================ */
        .dash-topbar {
            background: #fff;
            border-bottom: 1px solid var(--dash-border);
            padding: 0 1.5rem;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .dash-topbar-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--dash-text);
        }

        .dash-topbar-title h2 {
            font-size: 0.95rem;
            font-weight: 700;
            margin: 0;
        }

        .dash-topbar-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 0.85rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--dash-primary-light);
            background: rgba(37,99,235,0.06);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .dash-topbar-link:hover {
            background: rgba(37,99,235,0.12);
            color: var(--dash-primary);
        }

        .dash-topbar-user {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .dash-topbar-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--dash-primary), var(--dash-primary-light));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
        }

        .dash-topbar-name {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--dash-text);
            line-height: 1.2;
        }

        .dash-topbar-role {
            font-size: 0.65rem;
            color: var(--dash-text-light);
        }

        .dash-sidebar-toggle {
            background: none;
            border: 1px solid var(--dash-border);
            border-radius: 6px;
            padding: 0.4rem 0.6rem;
            font-size: 1rem;
            color: var(--dash-text-light);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .dash-sidebar-toggle:hover {
            background: var(--dash-bg);
        }

        .dash-content {
            flex: 1;
            padding: 0;
        }

        /* Overlay */
        .dash-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 1035;
            display: none;
            backdrop-filter: blur(2px);
        }

        .dash-overlay.active {
            display: block;
        }

        /* ============================
           RESPONSIVE
        ============================ */
        @media (max-width: 991.98px) {
            .dash-sidebar {
                transform: translateX(-100%);
            }

            .dash-sidebar.open {
                transform: translateX(0);
            }

            .dash-main {
                margin-left: 0;
            }
        }

        @media print {
            .no-print, .dash-sidebar, .dash-topbar { display: none !important; }
            .dash-main { margin-left: 0; }
        }
    </style>

    {{-- Stack for Additional Page-Specific Styles --}}
    @stack('styles')
</head>

<body class="font-sans antialiased">
    <div class="dash-layout">
        {{-- Sidebar --}}
        @include('layouts.navigation')

        {{-- Main Content Area --}}
        <div class="dash-main">
            {{-- Top Bar --}}
            <header class="dash-topbar">
                <div class="d-flex align-items-center gap-3">
                    <button class="dash-sidebar-toggle d-lg-none" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    @if (isset($header))
                        <div class="dash-topbar-title">{{ $header }}</div>
                    @endif
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ url('/') }}" class="dash-topbar-link" target="_blank" title="Lihat Website">
                        <i class="fas fa-external-link-alt"></i>
                        <span class="d-none d-md-inline">Lihat Website</span>
                    </a>
                    <div class="dash-topbar-user">
                        <div class="dash-topbar-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="d-none d-sm-block">
                            <div class="dash-topbar-name">{{ Auth::user()->name }}</div>
                            <div class="dash-topbar-role">{{ Auth::user()->role === 'admin' ? 'Admin' : 'Guru' }}</div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="dash-content">
                {{ $slot }}
            </main>
        </div>
    </div>

    {{-- Sidebar Overlay (Mobile) --}}
    <div class="dash-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    {{-- jQuery (if needed for Bootstrap components) --}}
    <script 
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>

    {{-- Bootstrap JS Bundle --}}
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    {{-- Trix Editor JS --}}
    <script 
        type="text/javascript" 
        src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    {{-- Font Awesome --}}
    <script 
        src="https://kit.fontawesome.com/eef377116d.js" 
        crossorigin="anonymous"></script>

    {{-- AOS (Animate On Scroll) JS --}}
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // Initialize AOS with custom settings
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
    </script>

    {{-- SweetAlert2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Global JavaScript Utilities --}}
    <script>
        // CSRF Token Setup for AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Confirm Delete Function
        function confirmDelete(formId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
            return false;
        }

        // Toast Notification Function
        function showToast(type, message) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            Toast.fire({
                icon: type,
                title: message
            });
        }

        // Disable Trix File Attachments (Optional)
        document.addEventListener("trix-file-accept", function(e) {
            e.preventDefault();
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert:not(.alert-permanent)').fadeOut('slow');
        }, 5000);
    </script>

    {{-- Success Alert --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: {!! json_encode(session('success')) !!},
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
        </script>
    @endif

    {{-- Error Alert --}}
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: {!! json_encode(session('error')) !!},
                showConfirmButton: true,
                confirmButtonColor: '#dc3545'
            });
        </script>
    @endif

    {{-- Warning Alert --}}
    @if (session('warning'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian!',
                text: {!! json_encode(session('warning')) !!},
                showConfirmButton: true,
                confirmButtonColor: '#ffc107'
            });
        </script>
    @endif

    {{-- Info Alert --}}
    @if (session('info'))
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Informasi',
                text: {!! json_encode(session('info')) !!},
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
        </script>
    @endif

    {{-- Sidebar Toggle & Instant Touch Navigation Fix --}}
    <script>
        function toggleSidebar() {
            document.querySelector('.dash-sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('active');
        }

        // Force instant navigation on sidebar items to bypass touchscreen/hover double-tap delays
        document.addEventListener('DOMContentLoaded', function() {
            const navItems = document.querySelectorAll('.dash-nav-item');
            navItems.forEach(function(item) {
                // Ensure it does not apply to active item to allow refresh, but instantly navigates on other items
                if (!item.classList.contains('active')) {
                    item.addEventListener('click', function(e) {
                        const href = this.getAttribute('href');
                        if (href && href !== '#' && !e.metaKey && !e.ctrlKey) {
                            e.preventDefault();
                            window.location.href = href;
                        }
                    });
                }
            });
        });
    </script>

    {{-- Stack for Additional Page-Specific Scripts --}}
    @stack('scripts')
</body>
</html>
