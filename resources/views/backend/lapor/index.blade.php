<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Form Pengaduan - Layanan Publik</title>
    <style>
        /* ===== FORM PENGADUAN STYLES ===== */
        .form-pengaduan-container {
            max-width: 1400px;
            margin: 3rem auto;
            padding: 0 2rem;
        }

        .form-pengaduan-layout {
            display: flex;
            gap: 3rem;
            margin-top: 3rem;
        }

        /* Sidebar - 25% */
        .form-sidebar {
            flex: 0 0 25%;
            min-width: 280px;
        }

        .form-sidebar-card {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(229, 217, 182, 0.3);
            position: sticky;
            top: 120px;
        }

        .form-sidebar-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--cream);
        }

        .form-menu-item {
            display: block;
            width: 100%;
            padding: 1.2rem 1.5rem;
            background: transparent;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-green);
            text-align: left;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
            position: relative;
            overflow: hidden;
        }

        .form-menu-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(164, 190, 123, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .form-menu-item:hover::before {
            left: 100%;
        }

        .form-menu-item:hover {
            background: rgba(164, 190, 123, 0.08);
            transform: translateX(5px);
        }

        .form-menu-item.active {
            background: rgba(164, 190, 123, 0.15);
            color: var(--dark-green);
            box-shadow: 0 4px 15px rgba(164, 190, 123, 0.1);
        }

        .form-menu-item.active::after {
            content: '';
            position: absolute;
            right: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            background: var(--green);
            border-radius: 50%;
        }

        /* Menu Admin Khusus */
        .admin-section {
            margin-top: 3rem;
            padding-top: 2.5rem;
            border-top: 2px solid rgba(164, 190, 123, 0.2);
        }

        .admin-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-green);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .admin-section-title i {
            color: var(--green);
        }

        .admin-menu-item {
            display: block;
            width: 100%;
            padding: 1.2rem 1.5rem;
            background: linear-gradient(135deg, rgba(164, 190, 123, 0.1) 0%, rgba(95, 141, 78, 0.1) 100%);
            border: 2px solid rgba(164, 190, 123, 0.3);
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-green);
            text-align: left;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
            position: relative;
            overflow: hidden;
        }

        .admin-menu-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(164, 190, 123, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .admin-menu-item:hover::before {
            left: 100%;
        }

        .admin-menu-item:hover {
            background: linear-gradient(135deg, rgba(164, 190, 123, 0.2) 0%, rgba(95, 141, 78, 0.2) 100%);
            transform: translateX(5px) scale(1.02);
            border-color: var(--green);
            box-shadow: 0 8px 20px rgba(164, 190, 123, 0.15);
        }

        /* Badge untuk admin */
        .admin-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--sage) 0%, var(--green) 100%);
            color: white;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            margin-left: 0.5rem;
            vertical-align: middle;
        }

        /* Form Content - 75% */
        .form-content {
            flex: 1;
        }

        .form-header {
            margin-bottom: 2.5rem;
        }

        .form-title {
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--dark-green);
            margin-bottom: 0.8rem;
            line-height: 1.2;
        }

        .form-subtitle {
            font-size: 1.2rem;
            color: var(--text-medium);
            line-height: 1.6;
            max-width: 800px;
        }

        /* Form Card */
        .form-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 8px 35px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(229, 217, 182, 0.2);
            min-height: 500px;
        }

        /* Content untuk setiap menu */
        .content-section {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .content-section.active {
            display: block;
        }

        /* Styles untuk Panduan */
        .guide-item {
            background: rgba(229, 217, 182, 0.08);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border-left: 4px solid var(--sage);
            transition: all 0.3s ease;
        }

        .guide-item:hover {
            transform: translateX(10px);
            background: rgba(229, 217, 182, 0.15);
        }

        .guide-step {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .step-number {
            background: var(--green);
            color: white;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .guide-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-green);
            margin: 0;
        }

        .guide-desc {
            color: var(--text-medium);
            line-height: 1.6;
            padding-left: 3rem;
        }

        /* Styles untuk FAQ */
        .faq-item {
            margin-bottom: 1rem;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(164, 190, 123, 0.2);
        }

        .faq-question {
            padding: 1.5rem;
            background: rgba(164, 190, 123, 0.05);
            color: var(--dark-green);
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .faq-question:hover {
            background: rgba(164, 190, 123, 0.1);
        }

        .faq-question.active {
            background: rgba(164, 190, 123, 0.15);
        }

        .faq-answer {
            padding: 0 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-answer.show {
            padding: 1.5rem;
            max-height: 500px;
        }

        .faq-icon {
            transition: transform 0.3s ease;
        }

        .faq-question.active .faq-icon {
            transform: rotate(180deg);
        }

        /* Styles untuk Kontak Support */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .contact-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            border: 2px solid rgba(164, 190, 123, 0.2);
            transition: all 0.3s ease;
            height: 100%;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            border-color: var(--sage);
            box-shadow: 0 10px 30px rgba(164, 190, 123, 0.15);
        }

        .contact-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, rgba(164, 190, 123, 0.1) 0%, rgba(95, 141, 78, 0.1) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.8rem;
            color: var(--green);
        }

        .contact-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark-green);
            margin-bottom: 1rem;
        }

        .contact-info {
            color: var(--text-medium);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .contact-link {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background: rgba(164, 190, 123, 0.1);
            color: var(--green);
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .contact-link:hover {
            background: var(--sage);
            color: white;
            text-decoration: none;
        }

        .hours-list {
            list-style: none;
            padding: 0;
            margin: 1rem 0;
        }

        .hours-list li {
            padding: 0.3rem 0;
            color: var(--text-medium);
            border-bottom: 1px dashed rgba(164, 190, 123, 0.2);
        }

        .hours-list li:last-child {
            border-bottom: none;
        }

        /* Form Groups (untuk form pengaduan) */
        .form-group {
            margin-bottom: 2.5rem;
        }

        .form-label {
            display: block;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-green);
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label.required::after {
            content: '*';
            color: #e74c3c;
            margin-left: 0.2rem;
        }

        .form-control-custom {
            width: 100%;
            padding: 1.2rem 1.5rem;
            font-size: 1.1rem;
            font-family: inherit;
            color: var(--dark-green);
            background: white;
            border: 2px solid rgba(164, 190, 123, 0.3);
            border-radius: 12px;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-control-custom:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 4px rgba(164, 190, 123, 0.15);
            transform: translateY(-2px);
        }

        .form-control-custom::placeholder {
            color: var(--text-light);
            opacity: 0.7;
        }

        textarea.form-control-custom {
            min-height: 180px;
            resize: vertical;
            line-height: 1.6;
        }

        select.form-control-custom {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%235F8D4E' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1.5rem center;
            background-size: 16px;
            padding-right: 3.5rem;
        }

        /* ===== REVISI TAMPILAN LAMPIRAN YANG LEBIH BAIK ===== */
        .file-upload-container {
            position: relative;
        }

        .file-upload-wrapper {
            position: relative;
            border: 2px dashed rgba(164, 190, 123, 0.4);
            border-radius: 16px;
            padding: 3.5rem 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: linear-gradient(135deg, rgba(164, 190, 123, 0.02) 0%, rgba(229, 217, 182, 0.02) 100%);
            overflow: hidden;
        }

        .file-upload-wrapper:hover {
            border-color: var(--sage);
            background: linear-gradient(135deg, rgba(164, 190, 123, 0.05) 0%, rgba(229, 217, 182, 0.05) 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(164, 190, 123, 0.1);
        }

        .file-upload-wrapper.dragover {
            border-color: var(--green);
            background: linear-gradient(135deg, rgba(164, 190, 123, 0.1) 0%, rgba(229, 217, 182, 0.1) 100%);
            box-shadow: 0 15px 30px rgba(164, 190, 123, 0.15);
        }

        .file-upload-icon {
            font-size: 3.5rem;
            color: var(--sage);
            margin-bottom: 1.5rem;
            display: inline-block;
            animation: float 3s ease-in-out infinite;
        }

        .file-upload-text {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-green);
            margin-bottom: 0.8rem;
        }

        .file-upload-subtext {
            font-size: 1rem;
            color: var(--text-medium);
            margin-bottom: 0.8rem;
            line-height: 1.5;
        }

        .file-upload-hint {
            font-size: 0.9rem;
            color: var(--text-light);
            background: rgba(164, 190, 123, 0.08);
            padding: 0.8rem 1.2rem;
            border-radius: 8px;
            display: inline-block;
            margin-top: 1rem;
        }

        .file-upload-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            padding: 1rem 2.5rem;
            background: linear-gradient(135deg, var(--sage) 0%, var(--green) 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(164, 190, 123, 0.3);
            margin-top: 1.5rem;
        }

        .file-upload-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(164, 190, 123, 0.4);
            background: linear-gradient(135deg, var(--green) 0%, var(--sage) 100%);
        }

        .file-input {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .file-list-container {
            margin-top: 2rem;
            display: none;
        }

        .file-list-container.show {
            display: block;
            animation: slideUp 0.4s ease;
        }

        .file-list-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-green);
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .file-list-title i {
            color: var(--green);
        }

        .file-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1rem;
        }

        .file-item {
            background: white;
            border-radius: 12px;
            padding: 1.2rem;
            border: 1px solid rgba(164, 190, 123, 0.2);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .file-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(164, 190, 123, 0.15);
            border-color: var(--sage);
        }

        .file-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--sage);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .file-item:hover::before {
            opacity: 1;
        }

        .file-icon-wrapper {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, rgba(164, 190, 123, 0.1) 0%, rgba(95, 141, 78, 0.1) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--green);
            flex-shrink: 0;
        }

        .file-info {
            flex: 1;
            min-width: 0;
        }

        .file-name {
            font-weight: 600;
            color: var(--dark-green);
            margin-bottom: 0.3rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 1rem;
        }

        .file-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .file-size {
            background: rgba(164, 190, 123, 0.1);
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
        }

        .file-type {
            text-transform: uppercase;
            font-weight: 500;
        }

        .file-progress {
            width: 100%;
            height: 4px;
            background: rgba(164, 190, 123, 0.1);
            border-radius: 2px;
            margin-top: 0.8rem;
            overflow: hidden;
            display: none;
        }

        .file-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--sage), var(--green));
            width: 0%;
            transition: width 0.3s ease;
        }

        .file-remove {
            background: rgba(231, 76, 60, 0.1);
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #e74c3c;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .file-remove:hover {
            background: #e74c3c;
            color: white;
            transform: rotate(90deg);
        }

        .file-status {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 0.7rem;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            font-weight: 600;
        }

        .file-status.uploading {
            background: rgba(52, 152, 219, 0.1);
            color: #3498db;
        }

        .file-status.success {
            background: rgba(46, 204, 113, 0.1);
            color: #2ecc71;
        }

        .file-status.error {
            background: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
        }

        /* Animasi untuk file count */
        .file-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background: var(--green);
            color: white;
            border-radius: 50%;
            font-size: 0.8rem;
            font-weight: bold;
            margin-left: 0.5rem;
            animation: bounceIn 0.5s ease;
        }

        /* Submit Button */
        .form-submit {
            text-align: center;
            margin-top: 3rem;
            padding-top: 3rem;
            border-top: 2px solid rgba(164, 190, 123, 0.1);
        }

        .submit-btn {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            padding: 1.3rem 3.5rem;
            background: linear-gradient(135deg, var(--green) 0%, var(--dark-green) 100%);
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(95, 141, 78, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(95, 141, 78, 0.4);
            background: linear-gradient(135deg, var(--dark-green) 0%, var(--green) 100%);
        }

        .submit-btn:active {
            transform: translateY(-2px);
        }

        /* Informasi */
        .info-box {
            background: linear-gradient(135deg, rgba(229, 217, 182, 0.05) 0%, rgba(164, 190, 123, 0.05) 100%);
            border-radius: 12px;
            padding: 2rem;
            margin-top: 2.5rem;
            border-left: 4px solid var(--sage);
        }

        .info-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-green);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .info-title i {
            color: var(--green);
        }

        .info-text {
            color: var(--text-medium);
            line-height: 1.6;
            font-size: 1rem;
        }

        /* Animasi */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0);
            }
            70% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }

        @keyframes progressBar {
            from {
                width: 0%;
            }
            to {
                width: 100%;
            }
        }

        /* CSS Variables */
        :root {
            --cream: #E5D9B6;
            --sage: #A4BE7B;
            --green: #5F8D4E;
            --dark-green: #285430;
            --text-light: #6c757d;
            --text-medium: #495057;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .form-pengaduan-layout {
                flex-direction: column;
                gap: 2rem;
            }
            
            .form-sidebar {
                flex: none;
                width: 100%;
                min-width: auto;
            }
            
            .form-sidebar-card {
                position: static;
                top: auto;
            }
            
            .file-list {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .form-pengaduan-container {
                padding: 0 1.5rem;
            }
            
            .form-title {
                font-size: 2.2rem;
            }
            
            .form-card {
                padding: 2rem;
            }
            
            .form-group {
                margin-bottom: 2rem;
            }
            
            .form-control-custom {
                padding: 1rem 1.2rem;
                font-size: 1rem;
            }
            
            .submit-btn {
                padding: 1.2rem 2.5rem;
                font-size: 1.1rem;
            }
            
            .file-upload-wrapper {
                padding: 2.5rem 1.5rem;
            }
            
            .file-upload-icon {
                font-size: 2.8rem;
            }
            
            .file-upload-text {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 480px) {
            .form-pengaduan-container {
                padding: 0 1rem;
            }
            
            .form-title {
                font-size: 1.8rem;
            }
            
            .form-subtitle {
                font-size: 1.1rem;
            }
            
            .form-card {
                padding: 1.5rem;
                border-radius: 16px;
            }
            
            .form-label {
                font-size: 1rem;
            }
            
            .form-menu-item {
                padding: 1rem 1.2rem;
                font-size: 1rem;
            }
            
            .file-upload-wrapper {
                padding: 2rem 1rem;
            }
            
            .file-upload-btn {
                padding: 0.8rem 1.8rem;
                font-size: 1rem;
            }
            
            .file-item {
                flex-direction: column;
                text-align: center;
                padding: 1.5rem;
            }
            
            .file-meta {
                justify-content: center;
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('backend.bar.Navbar')

    <!-- Main Content -->
    <div class="content-container">
        <div class="content-box">
            <div>
                <div class="gambar">
                    <h2>LAYANAN PENGADUAN</h2>
                </div>
                
                <!-- Form Pengaduan Section -->
                <div class="form-pengaduan-container">
                    <div class="form-pengaduan-layout">
                        <!-- Sidebar - 25% -->
                        <aside class="form-sidebar">
                            <div class="form-sidebar-card">
                                <h3 class="form-sidebar-title">Menu</h3>
                                <button class="form-menu-item active" data-content="pengaduan">
                                    <i class="fas fa-bullhorn me-2"></i>
                                    Pengaduan
                                </button>
                                <button class="form-menu-item" data-content="panduan">
                                    <i class="fas fa-file-alt me-2"></i>
                                    Panduan
                                </button>
                                <button class="form-menu-item" data-content="faq">
                                    <i class="fas fa-question-circle me-2"></i>
                                    FAQ
                                </button>
                                <button class="form-menu-item" data-content="kontak">
                                    <i class="fas fa-headset me-2"></i>
                                    Kontak Support
                                </button>
                                
                                <!-- Section Admin -->
                                @auth
                                    @if(auth()->user()->role === 'admin')
                                    <div class="admin-section">
                                        <h4 class="admin-section-title">
                                            <i class="fas fa-user-shield"></i>
                                            Admin Panel
                                        </h4>
                                        <button class="admin-menu-item" id="adminLaporanBtn">
                                            <i class="fas fa-eye me-2"></i>
                                            Lihat Laporan
                                            <span class="admin-badge">ADMIN</span>
                                        </button>
                                    </div>
                                    @endif
                                @endauth
                            </div>
                        </aside>

                        <!-- Form Content - 75% -->
                        <main class="form-content">
                            <!-- Header akan berubah sesuai menu -->
                            <div class="form-header" id="contentHeader">
                                <h1 class="form-title">Form Pengaduan</h1>
                                <p class="form-subtitle">
                                    Lengkapi data di bawah ini untuk mengirim laporan Anda. 
                                    Semua informasi akan dijaga kerahasiaannya dan ditindaklanjuti oleh pihak berwenang.
                                </p>
                            </div>

                            <div class="form-card">
                                <!-- Konten Pengaduan (Default) -->
                                <div id="pengaduanContent" class="content-section active">
                                    <form id="pengaduanForm" action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <!-- Email Pelapor -->
                                        <div class="form-group">
                                            <label class="form-label required" for="emailPelapor">
                                                <i class="fas fa-envelope"></i>
                                                Email Pelapor
                                            </label>
                                            <input 
                                                type="email" 
                                                id="emailPelapor"
                                                name="email" 
                                                class="form-control-custom"
                                                placeholder="Contoh: user@email.com"
                                                required
                                                value="{{ old('email') }}"
                                            >
                                            <small class="text-muted" style="display: block; margin-top: 0.5rem; color: var(--text-light);">
                                                Gunakan email aktif untuk komunikasi lebih lanjut
                                            </small>
                                        </div>
                                        
                                        <!-- Judul Laporan -->
                                        <div class="form-group">
                                            <label class="form-label required" for="judulLaporan">
                                                <i class="fas fa-heading"></i>
                                                Judul Laporan
                                            </label>
                                            <input 
                                                type="text" 
                                                id="judulLaporan"
                                                name="judul" 
                                                class="form-control-custom"
                                                placeholder="Contoh: Penebangan Liar di Hutan Lindung"
                                                required
                                                value="{{ old('judul') }}"
                                            >
                                            <small class="text-muted" style="display: block; margin-top: 0.5rem; color: var(--text-light);">
                                                Buat judul yang jelas dan deskriptif untuk membantu penanganan
                                            </small>
                                        </div>

                                        <!-- Isi Laporan -->
                                        <div class="form-group">
                                            <label class="form-label required" for="isiLaporan">
                                                <i class="fas fa-file-alt"></i>
                                                Isi Laporan
                                            </label>
                                            <textarea 
                                                id="isiLaporan"
                                                name="isi" 
                                                class="form-control-custom"
                                                placeholder="Jelaskan secara detail kejadian yang Anda laporkan. Sertakan informasi waktu, tempat, dan kronologi kejadian."
                                                rows="6"
                                                required
                                            >{{ old('isi') }}</textarea>
                                            <small class="text-muted" style="display: block; margin-top: 0.5rem; color: var(--text-light);">
                                                Minimal 100 karakter. Jelaskan dengan jelas agar laporan dapat ditindaklanjuti
                                            </small>
                                        </div>

                                        <!-- Tanggal dan Lokasi -->
                                        <div class="form-row" style="display: flex; gap: 2rem; margin-bottom: 2.5rem;">
                                            <div style="flex: 1;">
                                                <label class="form-label required" for="tanggalKejadian">
                                                    <i class="far fa-calendar-alt"></i>
                                                    Tanggal Kejadian
                                                </label>
                                                <input 
                                                    type="date" 
                                                    id="tanggalKejadian"
                                                    name="tanggal" 
                                                    class="form-control-custom"
                                                    required
                                                    value="{{ old('tanggal') }}"
                                                >
                                            </div>
                                            <div style="flex: 2;">
                                                <label class="form-label required" for="lokasiKejadian">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    Lokasi Kejadian
                                                </label>
                                                <input 
                                                    type="text" 
                                                    id="lokasiKejadian"
                                                    name="lokasi" 
                                                    class="form-control-custom"
                                                    placeholder="Contoh: Jl. Hutan Lindung No. 123, Kecamatan Sukamaju"
                                                    required
                                                    value="{{ old('lokasi') }}"
                                                >
                                            </div>
                                        </div>

                                        <!-- Kategori Laporan -->
                                        <div class="form-group">
                                            <label class="form-label required" for="kategoriLaporan">
                                                <i class="fas fa-tags"></i>
                                                Kategori Laporan
                                            </label>
                                            <select id="kategoriLaporan" name="kategori" class="form-control-custom" required>
                                                <option value="" disabled selected>Pilih kategori laporan</option>
                                                <option value="fasilitas" {{ old('kategori') == 'fasilitas' ? 'selected' : '' }}>Fasilitas Publik</option>
                                                <option value="keamanan" {{ old('kategori') == 'keamanan' ? 'selected' : '' }}>Keamanan Lingkungan</option>
                                                <option value="layanan" {{ old('kategori') == 'layanan' ? 'selected' : '' }}>Layanan Publik</option>
                                                <option value="lingkungan" {{ old('kategori') == 'lingkungan' ? 'selected' : '' }}>Kerusakan Lingkungan</option>
                                                <option value="sampah" {{ old('kategori') == 'sampah' ? 'selected' : '' }}>Pengelolaan Sampah</option>
                                                <option value="polusi" {{ old('kategori') == 'polusi' ? 'selected' : '' }}>Polusi Udara/Air</option>
                                            </select>
                                        </div>

                                        <!-- REVISI LAMPIRAN YANG LEBIH BAIK -->
                                        <div class="form-group file-upload-container">
                                            <label class="form-label" for="lampiran">
                                                <i class="fas fa-paperclip"></i>
                                                Lampiran
                                                <span id="fileCountBadge" class="file-count" style="display: none;">0</span>
                                            </label>
                                            <div class="file-upload-wrapper" id="fileDropArea">
                                                <div class="file-upload-icon">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                                <h4 class="file-upload-text">
                                                    Upload Bukti Pendukung
                                                </h4>
                                                <p class="file-upload-subtext">
                                                    Seret dan lepas file Anda di sini atau klik tombol di bawah
                                                </p>
                                                <button type="button" class="file-upload-btn" id="fileUploadBtn">
                                                    <i class="fas fa-folder-open"></i>
                                                    Pilih File
                                                </button>
                                                <p class="file-upload-hint">
                                                    <i class="fas fa-info-circle me-2"></i>
                                                    Maksimal 5 file (JPG, PNG, PDF, DOC) • Masing-masing maksimal 10MB
                                                </p>
                                                <input 
                                                    type="file" 
                                                    id="lampiran"
                                                    name="lampiran[]" 
                                                    class="file-input"
                                                    multiple
                                                    accept=".jpg,.jpeg,.png,.pdf,.doc,.docx"
                                                >
                                            </div>
                                            
                                            <!-- Container untuk daftar file -->
                                            <div class="file-list-container" id="fileListContainer">
                                                <h4 class="file-list-title">
                                                    <i class="fas fa-folder-open"></i>
                                                    File Terpilih
                                                    <span id="fileCountText" class="file-count">0</span>
                                                </h4>
                                                <div class="file-list" id="fileList">
                                                    <!-- File list akan ditampilkan di sini -->
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Informasi Tambahan -->
                                        <div class="info-box">
                                            <h4 class="info-title">
                                                <i class="fas fa-info-circle"></i>
                                                Informasi Penting
                                            </h4>
                                            <p class="info-text">
                                                • Laporan Anda akan diproses dalam waktu maksimal 3-5 hari kerja<br>
                                                • Pastikan data yang diisi akurat dan dapat dipertanggungjawabkan<br>
                                                • Anda akan mendapatkan nomor tiket untuk melacak status laporan<br>
                                                • Identitas pelapor dijamin kerahasiaannya sesuai peraturan yang berlaku
                                            </p>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="form-submit">
                                            <button type="submit" class="submit-btn">
                                                <i class="fas fa-paper-plane"></i>
                                                Kirim Laporan
                                            </button>
                                        </div>
                                    </form>
                                    
                                    @if ($errors->any())
                                        <div class="alert alert-danger mt-3">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    
                                    @if (session('success'))
                                        <div class="alert alert-success mt-3">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Konten Panduan -->
                                <div id="panduanContent" class="content-section">
                                    <div class="info-box">
                                        <h4 class="info-title">
                                            <i class="fas fa-info-circle"></i>
                                            Panduan Penggunaan Layanan Pengaduan
                                        </h4>
                                        <p class="info-text">
                                            Berikut adalah langkah-langkah untuk menggunakan layanan pengaduan dengan efektif:
                                        </p>
                                    </div>

                                    <div class="guide-item">
                                        <div class="guide-step">
                                            <div class="step-number">1</div>
                                            <h4 class="guide-title">Persiapkan Data dan Informasi</h4>
                                        </div>
                                        <p class="guide-desc">
                                            Sebelum mengirim laporan, pastikan Anda telah mengumpulkan semua informasi yang diperlukan seperti:
                                            waktu kejadian, lokasi, bukti foto/video, dan detail kronologi kejadian.
                                        </p>
                                    </div>

                                    <div class="guide-item">
                                        <div class="guide-step">
                                            <div class="step-number">2</div>
                                            <h4 class="guide-title">Isi Form Pengaduan dengan Lengkap</h4>
                                        </div>
                                        <p class="guide-desc">
                                            Isi semua field yang wajib diisi. Pastikan email yang digunakan aktif karena
                                            notifikasi dan balasan akan dikirim ke email tersebut. Berikan judul yang jelas
                                            dan deskripsi yang detail.
                                        </p>
                                    </div>

                                    <div class="guide-item">
                                        <div class="guide-step">
                                            <div class="step-number">3</div>
                                            <h4 class="guide-title">Lampirkan Bukti Pendukung</h4>
                                        </div>
                                        <p class="guide-desc">
                                            Unggah foto, video, atau dokumen pendukung (maksimal 5 file, masing-masing 10MB).
                                            Format yang diterima: JPG, PNG, PDF, DOC. Bukti visual akan mempercepat proses penanganan.
                                        </p>
                                    </div>

                                    <div class="guide-item">
                                        <div class="guide-step">
                                            <div class="step-number">4</div>
                                            <h4 class="guide-title">Verifikasi Email</h4>
                                        </div>
                                        <p class="guide-desc">
                                            Setelah mengirim laporan, periksa inbox email Anda untuk verifikasi.
                                            Klik link verifikasi yang dikirim sistem untuk mengaktifkan laporan.
                                        </p>
                                    </div>

                                    <div class="guide-item">
                                        <div class="guide-step">
                                            <div class="step-number">5</div>
                                            <h4 class="guide-title">Pantau Status Laporan</h4>
                                        </div>
                                        <p class="guide-desc">
                                            Setelah terverifikasi, Anda akan menerima nomor tiket pelacakan.
                                            Gunakan nomor ini untuk mengecek status laporan melalui halaman lacak laporan.
                                        </p>
                                    </div>

                                    <div class="info-box mt-4">
                                        <h4 class="info-title">
                                            <i class="fas fa-lightbulb"></i>
                                            Tips Penting
                                        </h4>
                                        <p class="info-text">
                                            • Sampaikan laporan dengan bahasa yang santun dan jelas<br>
                                            • Pastikan laporan berdasarkan fakta yang dapat dipertanggungjawabkan<br>
                                            • Hindari mengirimkan laporan yang mengandung SARA atau ujaran kebencian<br>
                                            • Simpan nomor tiket dengan baik untuk keperluan pelacakan<br>
                                            • Respons petugas biasanya dalam 1-3 hari kerja setelah verifikasi
                                        </p>
                                    </div>
                                </div>

                                <!-- Konten FAQ -->
                                <div id="faqContent" class="content-section">
                                    <div class="info-box">
                                        <h4 class="info-title">
                                            <i class="fas fa-info-circle"></i>
                                            Pertanyaan yang Sering Diajukan (FAQ)
                                        </h4>
                                        <p class="info-text">
                                            Temukan jawaban untuk pertanyaan-pertanyaan umum seputar layanan pengaduan kami.
                                        </p>
                                    </div>

                                    <div class="faq-item">
                                        <div class="faq-question">
                                            <span>Apa saja yang bisa saya laporkan melalui sistem ini?</span>
                                            <i class="fas fa-chevron-down faq-icon"></i>
                                        </div>
                                        <div class="faq-answer">
                                            <p>Anda dapat melaporkan berbagai masalah seperti: kerusakan fasilitas publik, masalah keamanan lingkungan, pelayanan publik yang kurang memuaskan, kerusakan lingkungan, pengelolaan sampah, polusi udara/air, dan masalah lainnya yang berkaitan dengan pelayanan publik.</p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <div class="faq-question">
                                            <span>Berapa lama waktu yang dibutuhkan untuk menanggapi laporan?</span>
                                            <i class="fas fa-chevron-down faq-icon"></i>
                                        </div>
                                        <div class="faq-answer">
                                            <p>Laporan akan diproses maksimal 3-5 hari kerja setelah verifikasi email. Laporan prioritas (seperti yang menyangkut keselamatan) akan ditangani lebih cepat. Anda akan menerima notifikasi via email setiap ada perkembangan.</p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <div class="faq-question">
                                            <span>Apakah identitas saya sebagai pelapor dirahasiakan?</span>
                                            <i class="fas fa-chevron-down faq-icon"></i>
                                        </div>
                                        <div class="faq-answer">
                                            <p>Ya, identitas pelapor dijamin kerahasiaannya sesuai dengan peraturan perundang-undangan yang berlaku. Data Anda tidak akan disebarluaskan kepada pihak ketiga tanpa persetujuan, kecuali diminta oleh proses hukum yang sah.</p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <div class="faq-question">
                                            <span>Bagaimana cara melacak status laporan saya?</span>
                                            <i class="fas fa-chevron-down faq-icon"></i>
                                        </div>
                                        <div class="faq-answer">
                                            <p>Setelah laporan terverifikasi, Anda akan menerima email berisi nomor tiket pelacakan. Gunakan nomor tersebut di halaman "Lacak Laporan" untuk melihat perkembangan penanganan laporan Anda.</p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <div class="faq-question">
                                            <span>Apakah ada batasan ukuran file untuk lampiran?</span>
                                            <i class="fas fa-chevron-down faq-icon"></i>
                                        </div>
                                        <div class="faq-answer">
                                            <p>Ya, maksimal 5 file lampiran dengan ukuran masing-masing tidak lebih dari 10MB. Format yang diterima: JPG, PNG, PDF, DOC, DOCX. Pastikan file tidak mengandung virus atau malware.</p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <div class="faq-question">
                                            <span>Bagaimana jika saya lupa nomor tiket pelacakan?</span>
                                            <i class="fas fa-chevron-down faq-icon"></i>
                                        </div>
                                        <div class="faq-answer">
                                            <p>Anda dapat menghubungi kontak support dengan menyebutkan email yang digunakan saat mengirim laporan. Tim support akan membantu Anda menemukan nomor tiket tersebut.</p>
                                        </div>
                                    </div>

                                    <div class="info-box mt-4">
                                        <h4 class="info-title">
                                            <i class="fas fa-question-circle"></i>
                                            Masih Punya Pertanyaan?
                                        </h4>
                                        <p class="info-text">
                                            Jika pertanyaan Anda belum terjawab di FAQ, silakan hubungi tim support kami melalui menu "Kontak Support" atau langsung hubungi melalui kontak yang tersedia.
                                        </p>
                                    </div>
                                </div>

                                <!-- Konten Kontak Support -->
                                <div id="kontakContent" class="content-section">
                                    <div class="info-box">
                                        <h4 class="info-title">
                                            <i class="fas fa-info-circle"></i>
                                            Hubungi Tim Support Kami
                                        </h4>
                                        <p class="info-text">
                                            Tim support kami siap membantu Anda 24/7. Pilih metode kontak yang paling nyaman untuk Anda.
                                        </p>
                                    </div>

                                    <div class="contact-grid">
                                        <div class="contact-card">
                                            <div class="contact-icon">
                                                <i class="fas fa-phone-alt"></i>
                                            </div>
                                            <h4 class="contact-title">Telepon</h4>
                                            <p class="contact-info">
                                                Hubungi kami untuk pertanyaan mendesak atau konsultasi langsung
                                            </p>
                                            <div class="contact-info">
                                                <strong>1500-123</strong><br>
                                                (24 jam, bebas pulsa)
                                            </div>
                                            <a href="tel:1500123" class="contact-link">
                                                <i class="fas fa-phone me-2"></i>Hubungi Sekarang
                                            </a>
                                        </div>

                                        <div class="contact-card">
                                            <div class="contact-icon">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <h4 class="contact-title">Email</h4>
                                            <p class="contact-info">
                                                Kirim pertanyaan detail atau dokumen pendukung via email
                                            </p>
                                            <div class="contact-info">
                                                <strong>support@pengaduan.go.id</strong><br>
                                                Respon dalam 24 jam
                                            </div>
                                            <a href="mailto:support@pengaduan.go.id" class="contact-link">
                                                <i class="fas fa-envelope me-2"></i>Kirim Email
                                            </a>
                                        </div>

                                        <div class="contact-card">
                                            <div class="contact-icon">
                                                <i class="fas fa-comments"></i>
                                            </div>
                                            <h4 class="contact-title">Live Chat</h4>
                                            <p class="contact-info">
                                                Chat langsung dengan customer service kami
                                            </p>
                                            <div class="contact-info">
                                                Tersedia pada jam kerja:<br>
                                                Senin-Jumat: 08.00-17.00 WIB
                                            </div>
                                            <button class="contact-link" id="liveChatBtn">
                                                <i class="fas fa-comment me-2"></i>Mulai Chat
                                            </button>
                                        </div>

                                        <div class="contact-card">
                                            <div class="contact-icon">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <h4 class="contact-title">Kunjungan Langsung</h4>
                                            <p class="contact-info">
                                                Kunjungi kantor kami untuk konsultasi langsung
                                            </p>
                                            <div class="contact-info">
                                                <strong>Gedung Layanan Publik</strong><br>
                                                Jl. Merdeka No. 123, Jakarta Pusat<br>
                                                <ul class="hours-list">
                                                    <li>Senin-Kamis: 08.00-16.00</li>
                                                    <li>Jumat: 08.00-11.00</li>
                                                    <li>Sabtu-Minggu: Tutup</li>
                                                </ul>
                                            </div>
                                            <a href="https://maps.google.com" target="_blank" class="contact-link">
                                                <i class="fas fa-directions me-2"></i>Lihat Peta
                                            </a>
                                        </div>
                                    </div>

                                    <div class="info-box mt-4">
                                        <h4 class="info-title">
                                            <i class="fas fa-clock"></i>
                                            Jam Operasional
                                        </h4>
                                        <p class="info-text">
                                            • <strong>Layanan Telepon:</strong> 24 jam sehari, 7 hari seminggu<br>
                                            • <strong>Layanan Email:</strong> Respon dalam 24 jam<br>
                                            • <strong>Live Chat:</strong> Senin-Jumat, 08.00-17.00 WIB<br>
                                            • <strong>Kunjungan Langsung:</strong> Senin-Kamis 08.00-16.00, Jumat 08.00-11.00<br>
                                            • Hari libur nasional: Tutup
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
                <!-- End Form Pengaduan -->
                
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('backend.bar.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Data untuk header setiap konten
        const contentData = {
            pengaduan: {
                title: "Form Pengaduan",
                subtitle: "Lengkapi data di bawah ini untuk mengirim laporan Anda. Semua informasi akan dijaga kerahasiaannya dan ditindaklanjuti oleh pihak berwenang."
            },
            panduan: {
                title: "Panduan Penggunaan",
                subtitle: "Pelajari langkah-langkah penggunaan layanan pengaduan untuk memastikan laporan Anda diproses dengan efektif dan efisien."
            },
            faq: {
                title: "FAQ - Pertanyaan Umum",
                subtitle: "Temukan jawaban untuk pertanyaan-pertanyaan yang sering diajukan seputar layanan pengaduan kami."
            },
            kontak: {
                title: "Kontak Support",
                subtitle: "Hubungi tim support kami melalui berbagai saluran komunikasi yang tersedia. Kami siap membantu Anda."
            }
        };

        // Fungsi untuk mengganti konten
        function switchContent(contentId) {
            // Sembunyikan semua konten
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Tampilkan konten yang dipilih
            const targetContent = document.getElementById(`${contentId}Content`);
            if (targetContent) {
                targetContent.classList.add('active');
            }
            
            // Update header
            const header = document.getElementById('contentHeader');
            if (header && contentData[contentId]) {
                header.innerHTML = `
                    <h1 class="form-title">${contentData[contentId].title}</h1>
                    <p class="form-subtitle">${contentData[contentId].subtitle}</p>
                `;
            }
            
            // Update menu aktif
            document.querySelectorAll('.form-menu-item').forEach(item => {
                item.classList.remove('active');
            });
            document.querySelector(`.form-menu-item[data-content="${contentId}"]`).classList.add('active');
            
            // Tambah efek ripple
            addRippleEffect(event);
        }

        // Fungsi untuk efek ripple
        function addRippleEffect(event) {
            const btn = event.currentTarget;
            const ripple = document.createElement('span');
            const rect = btn.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = event.clientX - rect.left - size/2;
            const y = event.clientY - rect.top - size/2;
            
            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(164, 190, 123, 0.3);
                transform: scale(0);
                animation: ripple 0.6s linear;
                width: ${size}px;
                height: ${size}px;
                top: ${y}px;
                left: ${x}px;
            `;
            
            btn.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        }

        // Fungsi untuk toggle FAQ
        function toggleFAQ(event) {
            const question = event.currentTarget;
            const answer = question.nextElementSibling;
            const icon = question.querySelector('.faq-icon');
            
            question.classList.toggle('active');
            
            if (question.classList.contains('active')) {
                answer.classList.add('show');
            } else {
                answer.classList.remove('show');
            }
        }

        // Fungsi untuk redirect ke halaman admin laporan
        function redirectToAdminLaporan() {
            // Redirect ke route laporan admin
            window.location.href = "{{ route('lapor.laporan') }}";
        }

        // Navbar transparency toggle
        function handleNavbarToggle() {
            const navContainer = document.querySelector('.nav-container');
            const hero = document.querySelector('.gambar');
            if (!navContainer) return;

            const threshold = hero ? (hero.offsetHeight - 100) : 80;
            if (window.scrollY > threshold) {
                navContainer.classList.remove('nav-transparent');
                navContainer.classList.add('nav-solid');
            } else {
                navContainer.classList.remove('nav-solid');
                navContainer.classList.add('nav-transparent');
            }
        }

        // ===== REVISI JAVASCRIPT UNTUK LAMPIRAN YANG LEBIH BAIK =====
        class FileUploadManager {
            constructor() {
                this.files = [];
                this.maxFiles = 5;
                this.maxSize = 10 * 1024 * 1024; // 10MB
                this.allowedTypes = [
                    'image/jpeg',
                    'image/png',
                    'image/gif',
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];
                
                this.fileExtensions = {
                    'image/jpeg': 'jpg',
                    'image/png': 'png',
                    'image/gif': 'gif',
                    'application/pdf': 'pdf',
                    'application/msword': 'doc',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document': 'docx'
                };
                
                this.init();
            }
            
            init() {
                this.fileInput = document.getElementById('lampiran');
                this.fileDropArea = document.getElementById('fileDropArea');
                this.fileUploadBtn = document.getElementById('fileUploadBtn');
                this.fileListContainer = document.getElementById('fileListContainer');
                this.fileList = document.getElementById('fileList');
                this.fileCountText = document.getElementById('fileCountText');
                this.fileCountBadge = document.getElementById('fileCountBadge');
                
                this.setupEventListeners();
            }
            
            setupEventListeners() {
                // Click to select files
                this.fileUploadBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.fileInput.click();
                });
                
                // Handle file selection
                this.fileInput.addEventListener('change', (e) => {
                    this.handleFiles(e.target.files);
                });
                
                // Drag and drop functionality
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    this.fileDropArea.addEventListener(eventName, this.preventDefaults, false);
                });
                
                ['dragenter', 'dragover'].forEach(eventName => {
                    this.fileDropArea.addEventListener(eventName, this.highlight.bind(this), false);
                });
                
                ['dragleave', 'drop'].forEach(eventName => {
                    this.fileDropArea.addEventListener(eventName, this.unhighlight.bind(this), false);
                });
                
                this.fileDropArea.addEventListener('drop', (e) => {
                    const dt = e.dataTransfer;
                    const droppedFiles = dt.files;
                    this.handleFiles(droppedFiles);
                });
            }
            
            preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            highlight() {
                this.fileDropArea.classList.add('dragover');
            }
            
            unhighlight() {
                this.fileDropArea.classList.remove('dragover');
            }
            
            handleFiles(newFiles) {
                Array.from(newFiles).forEach(file => {
                    // Check file limit
                    if (this.files.length >= this.maxFiles) {
                        this.showNotification(`Maksimal ${this.maxFiles} file yang diizinkan`, 'warning');
                        return;
                    }
                    
                    // Check file size
                    if (file.size > this.maxSize) {
                        this.showNotification(`File ${file.name} terlalu besar. Maksimal 10MB`, 'warning');
                        return;
                    }
                    
                    // Check file type
                    if (!this.allowedTypes.includes(file.type)) {
                        this.showNotification(`File ${file.name} tidak didukung. Gunakan JPG, PNG, PDF, atau DOC`, 'warning');
                        return;
                    }
                    
                    // Add file with unique ID
                    file.id = Date.now() + Math.random().toString(36).substr(2, 9);
                    this.files.push(file);
                    
                    // Show uploading animation
                    this.showFileUploading(file);
                    
                    // Simulate upload completion after 1 second
                    setTimeout(() => {
                        this.updateFileList();
                        this.showNotification(`File ${file.name} berhasil ditambahkan`, 'success');
                    }, 1000);
                });
                
                // Reset input
                this.fileInput.value = '';
            }
            
            showFileUploading(file) {
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';
                fileItem.id = `file-${file.id}`;
                
                const fileSize = this.formatFileSize(file.size);
                const fileType = this.getFileType(file.type);
                
                fileItem.innerHTML = `
                    <div class="file-icon-wrapper">
                        <i class="fas ${this.getFileIcon(file.type)}"></i>
                    </div>
                    <div class="file-info">
                        <div class="file-name">${file.name}</div>
                        <div class="file-meta">
                            <span class="file-size">${fileSize}</span>
                            <span class="file-type">${fileType}</span>
                        </div>
                        <div class="file-progress">
                            <div class="file-progress-bar" style="width: 70%"></div>
                        </div>
                    </div>
                    <div class="file-status uploading">Mengunggah...</div>
                    <button type="button" class="file-remove" onclick="fileUploadManager.removeFile('${file.id}')">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                
                this.fileListContainer.classList.add('show');
                this.fileList.appendChild(fileItem);
                
                // Show progress bar
                const progressBar = fileItem.querySelector('.file-progress');
                const progressBarInner = fileItem.querySelector('.file-progress-bar');
                progressBar.style.display = 'block';
                
                // Animate progress bar
                let width = 0;
                const interval = setInterval(() => {
                    if (width >= 100) {
                        clearInterval(interval);
                        progressBar.style.display = 'none';
                        fileItem.querySelector('.file-status').className = 'file-status success';
                        fileItem.querySelector('.file-status').textContent = 'Berhasil';
                    } else {
                        width += 10;
                        progressBarInner.style.width = width + '%';
                    }
                }, 100);
            }
            
            updateFileList() {
                // Remove all existing file items
                this.fileList.innerHTML = '';
                
                if (this.files.length === 0) {
                    this.fileListContainer.classList.remove('show');
                    this.fileCountBadge.style.display = 'none';
                    return;
                }
                
                this.fileListContainer.classList.add('show');
                
                // Update file count
                this.fileCountText.textContent = this.files.length;
                this.fileCountBadge.textContent = this.files.length;
                this.fileCountBadge.style.display = 'inline-flex';
                
                // Add each file item
                this.files.forEach(file => {
                    const fileItem = document.createElement('div');
                    fileItem.className = 'file-item';
                    
                    const fileSize = this.formatFileSize(file.size);
                    const fileType = this.getFileType(file.type);
                    
                    fileItem.innerHTML = `
                        <div class="file-icon-wrapper">
                            <i class="fas ${this.getFileIcon(file.type)}"></i>
                        </div>
                        <div class="file-info">
                            <div class="file-name" title="${file.name}">${file.name}</div>
                            <div class="file-meta">
                                <span class="file-size">${fileSize}</span>
                                <span class="file-type">${fileType}</span>
                            </div>
                        </div>
                        <button type="button" class="file-remove" onclick="fileUploadManager.removeFile('${file.id}')">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    
                    this.fileList.appendChild(fileItem);
                });
            }
            
            removeFile(fileId) {
                const fileIndex = this.files.findIndex(f => f.id === fileId);
                if (fileIndex > -1) {
                    const fileName = this.files[fileIndex].name;
                    this.files.splice(fileIndex, 1);
                    this.updateFileList();
                    this.showNotification(`File ${fileName} telah dihapus`, 'info');
                }
            }
            
            getFileIcon(fileType) {
                const iconMap = {
                    'image/jpeg': 'fa-file-image',
                    'image/png': 'fa-file-image',
                    'image/gif': 'fa-file-image',
                    'application/pdf': 'fa-file-pdf',
                    'application/msword': 'fa-file-word',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document': 'fa-file-word'
                };
                
                return iconMap[fileType] || 'fa-file';
            }
            
            getFileType(fileType) {
                return this.fileExtensions[fileType] || 'file';
            }
            
            formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
            }
            
            showNotification(message, type) {
                const notification = document.createElement('div');
                notification.className = `file-notification file-notification-${type}`;
                notification.innerHTML = `
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
                        <span>${message}</span>
                    </div>
                    <button class="notification-close">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                
                // Add styles
                notification.style.cssText = `
                    position: fixed;
                    top: 100px;
                    right: 20px;
                    background: white;
                    padding: 1.2rem 1.5rem;
                    border-radius: 12px;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
                    border-left: 4px solid ${type === 'success' ? '#5F8D4E' : type === 'warning' ? '#f39c12' : '#3498db'};
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    min-width: 300px;
                    max-width: 400px;
                    z-index: 1000;
                    animation: slideIn 0.3s ease;
                `;
                
                document.body.appendChild(notification);
                
                // Add close button functionality
                notification.querySelector('.notification-close').addEventListener('click', () => {
                    notification.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => notification.remove(), 300);
                });
                
                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.style.animation = 'slideOut 0.3s ease';
                        setTimeout(() => notification.remove(), 300);
                    }
                }, 5000);
            }
            
            clearAllFiles() {
                this.files = [];
                this.updateFileList();
                this.showNotification('Semua file telah dihapus', 'info');
            }
            
            getFilesForForm() {
                return this.files;
            }
        }

        // Live Chat button
        function initLiveChat() {
            const liveChatBtn = document.getElementById('liveChatBtn');
            if (liveChatBtn) {
                liveChatBtn.addEventListener('click', function() {
                    const now = new Date();
                    const hour = now.getHours();
                    const day = now.getDay();
                    
                    // Cek jam kerja (Senin-Jumat, 08.00-17.00)
                    if (day >= 1 && day <= 5 && hour >= 8 && hour < 17) {
                        alert('Live Chat sedang dibuka. Tim customer service akan segera merespons Anda.');
                        // Di sini bisa ditambahkan kode untuk membuka widget live chat
                    } else {
                        alert('Live Chat hanya tersedia pada hari Senin-Jumat pukul 08.00-17.00 WIB. Silakan hubungi kami melalui telepon atau email untuk bantuan darurat.');
                    }
                });
            }
        }

        // Global instance
        let fileUploadManager;

        document.addEventListener('DOMContentLoaded', function() {
            handleNavbarToggle();
            
            // Setup menu click handlers
            document.querySelectorAll('.form-menu-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    const contentId = this.getAttribute('data-content');
                    switchContent(contentId);
                });
            });
            
            // Setup FAQ click handlers
            document.querySelectorAll('.faq-question').forEach(question => {
                question.addEventListener('click', toggleFAQ);
            });
            
            // Setup live chat
            initLiveChat();
            
            // Initialize file upload manager
            fileUploadManager = new FileUploadManager();
            
            // Setup admin laporan button
            const adminLaporanBtn = document.getElementById('adminLaporanBtn');
            if (adminLaporanBtn) {
                adminLaporanBtn.addEventListener('click', redirectToAdminLaporan);
            }
            
            // Form submission untuk pengaduan
            const form = document.getElementById('pengaduanForm');
            if (form) {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    
                    // Validasi form
                    if (!validateForm()) return;
                    
                    // Show loading state
                    const submitBtn = form.querySelector('.submit-btn');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
                    submitBtn.disabled = true;
                    
                    try {
                        // Buat FormData dari form
                        const formData = new FormData(form);
                        
                        // Tambahkan files yang dipilih dari manager
                        const files = fileUploadManager.getFilesForForm();
                        files.forEach((file, index) => {
                            formData.append('lampiran[]', file);
                        });
                        
                        // Kirim ke server Laravel
                        const response = await fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });
                        
                        if (response.redirected) {
                            window.location.href = response.url;
                        } else if (response.ok) {
                            const result = await response.json();
                            if (result.redirect) {
                                window.location.href = result.redirect;
                            }
                        } else {
                            const error = await response.json();
                            throw new Error(error.message || 'Gagal mengirim laporan');
                        }
                        
                    } catch (error) {
                        // Show error message
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                        showNotification('Gagal mengirim laporan: ' + error.message, 'error');
                    }
                });
                
                // Fungsi validasi
                function validateForm() {
                    const email = document.getElementById('emailPelapor')?.value.trim();
                    const judul = document.getElementById('judulLaporan')?.value.trim();
                    const isi = document.getElementById('isiLaporan')?.value.trim();
                    const tanggal = document.getElementById('tanggalKejadian')?.value;
                    const lokasi = document.getElementById('lokasiKejadian')?.value.trim();
                    const kategori = document.getElementById('kategoriLaporan')?.value;
                    
                    if (!email || !judul || !isi || !tanggal || !lokasi || !kategori) {
                        alert('Harap lengkapi semua field yang wajib diisi');
                        return false;
                    }
                    
                    // Validasi email
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(email)) {
                        alert('Format email tidak valid. Contoh: nama@email.com');
                        return false;
                    }
                    
                    // Validasi panjang isi
                    if (isi.length < 100) {
                        alert('Isi laporan minimal 100 karakter');
                        return false;
                    }
                    
                    // Validasi tanggal (tidak boleh lebih dari hari ini)
                    const today = new Date().toISOString().split('T')[0];
                    if (tanggal > today) {
                        alert('Tanggal kejadian tidak boleh lebih dari hari ini');
                        return false;
                    }
                    
                    return true;
                }
            }
            
            // Add CSS animations
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
                
                @keyframes slideIn {
                    from {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
                
                @keyframes slideOut {
                    from {
                        transform: translateX(0);
                        opacity: 1;
                    }
                    to {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                }
                
                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: translateY(20px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            `;
            document.head.appendChild(style);
        });

        window.addEventListener('scroll', handleNavbarToggle);
        window.addEventListener('resize', handleNavbarToggle);
    </script>
</body>
</html>