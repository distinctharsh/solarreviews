<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solar Panel Management System - Login & Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images/solar-icon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <style>
        :root {
            --primary: #3B82F6;
            --primary-dark: #2563EB;
            --primary-light: #EFF6FF;
            --text: #1F2937;
            --text-light: #6B7280;
            --light: #F9FAFB;
            --border: #E5E7EB;
            --error: #EF4444;
            --success: #10B981;
            --card-bg: #FFFFFF;
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #F8FAFC 0%, #EFF6FF 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            line-height: 1.5;
            color: var(--text);
        }

        
        h1 {
            font-weight: bold;
            margin: 0;
        }

        h2 {
            text-align: center;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }

        a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        button {
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #FFD700;
            background-color: #FFD700;
            color: #000000;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            outline: none;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:active {
            transform: scale(0.95);
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
            color: #000000;
        }
        
        button.ghost:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Multi-step form styles */
        .progress-steps {
            display: flex;
            justify-content: center;
            margin: 20px 0 30px;
            position: relative;
        }

        .progress-steps::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 10%;
            right: 10%;
            height: 2px;
            background: #e0e0e0;
            z-index: 1;
        }

        .progress-steps .step {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-weight: bold;
            position: relative;
            z-index: 2;
            margin: 0 15px;
            transition: all 0.3s ease;
        }

        .progress-steps .step.active {
            background: #FFD700;
            color: #000;
        }

        .form-step {
            display: none;
            animation: fadeIn 0.5s ease;
            width: 100%;
            margin-bottom: 20px;
        }

        .form-step.active {
            display: block;
        }

        .form-row {
            display: flex;
            gap: 12px;
            width: 100%;
            margin-bottom: 0px !important;
        }

        .form-row input,
        .form-row select {
            flex: 1;
            min-width: 0;
        }

        .input-group {
            margin-bottom: 0px !important;
        }

        .form-navigation {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin: 18px 0 12px;
            padding: 6px 0;
            border-top: 1px solid #eee;
        }

        .form-navigation button {
            margin: 0;
            padding: 10px 20px;
        }

        .form-checkbox {
            display: flex;
            align-items: center;
            margin: 15px 0;
            text-align: left;
            width: 100%;
        }

        .form-checkbox input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
        }

        .form-checkbox {
            margin: 15px 0;
            text-align: left;
            width: 100%;
        }

        .form-checkbox label {
            font-size: 14px;
            color: #666;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .role-selection {
            width: 100%;
            margin-bottom: 12px;
            text-align: left;
        }

        .role-selection h4 {
            margin-bottom: 4px;
            font-size: 0.9rem;
            color: #111827;
        }

        .role-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            width: 100%;
        }

        .role-card {
            flex: 1 1 180px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            background: #fff;
            position: relative;
        }

        .role-card input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        .role-card .role-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .role-card .role-text {
            display: flex;
            flex-direction: column;
            gap: 1px;
        }

        .role-card .role-title {
            font-weight: 600;
            font-size: 0.85rem;
            color: #1f2937;
        }

        .role-card .role-subtitle {
            font-size: 0.72rem;
            color: #6b7280;
        }

        .role-card.active {
            border-color: #ffd700;
            box-shadow: 0 8px 20px rgba(17, 24, 39, 0.08);
        }

        .role-card.active .role-icon {
            background: #fff7cc;
            color: #b45309;
        }

        .role-dependent-fields.disabled {
            opacity: 0.4;
            pointer-events: none;
            filter: grayscale(0.4);
        }

        .company-section {
            width: 100%;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 18px;
            text-align: left;
        }

        .company-section.compact {
            background: transparent;
            border-style: dashed;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 6px;
        }

        .section-description {
            font-size: 0.9rem;
            color: #6b7280;
            margin-bottom: 14px;
        }

        .tag-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .tag-option {
            border: 1px solid #d1d5db;
            border-radius: 999px;
            padding: 6px 14px;
            font-size: 0.85rem;
            color: #374151;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #fff;
        }

        .tag-option input {
            display: none;
        }

        .tag-option.active {
            border-color: #f59e0b;
            background: #fffbeb;
            color: #92400e;
            box-shadow: inset 0 0 0 1px #fcd34d;
        }

        .role-specific-block {
            display: none;
        }

        .role-specific-block.active {
            display: block;
        }

        .form-checkbox input[type="checkbox"] {
            margin-right: 10px;
            width: auto;
        }

        .input-group {
            width: 100%;
            margin-bottom: 15px;
            position: relative;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .input-group input:focus,
        .input-group select:focus {
            border-color: #FFD700;
            box-shadow: 0 0 0 2px rgba(255, 215, 0, 0.2);
            outline: none;
        }

        .error-msg {
            color: #EF4444;
            font-size: 12px;
            margin-top: 5px;
            display: block;
            min-height: 18px;
        }

        .error-message {
            background-color: #FEE2E2;
            color: #B91C1C;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 13px;
            text-align: left;
        }

        .error-message p {
            margin: 5px 0;
            line-height: 1.4;
        }

        input.error,
        select.error {
            border-color: #EF4444 !important;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 10px;
            }
            
            .form-navigation {
                flex-direction: column;
                gap: 10px;
            }
            
            .form-navigation button {
                width: 100%;
            }
            
            .progress-steps .step {
                width: 25px;
                height: 25px;
                font-size: 12px;
                margin: 0 10px;
            }
        }

        /* Desktop styles (keep as before) */
        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 550px;
        }

        @media (max-width: 992px) {
            /* Mobile styles */
            body, html {
                margin: 0;
                padding: 20px;
                width: 100%;
                height: 100%;
                overflow-x: hidden;
                background: #f5f5f5;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }
            
            .container {
                width: 100%;
                max-width: 100%;
                min-height: auto;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                overflow: visible;
                display: block;
            }
            
            .form-container {
                width: 100% !important;
                padding: 20px;
                box-sizing: border-box;
                position: relative;
                left: 0 !important;
                right: 0 !important;
                transform: none !important;
                transition: none;
                height: auto;
            }
            
            .sign-up-container {
                display: none;
                width: 100%;
                padding: 20px;
                box-sizing: border-box;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                background: #fff;
                border-radius: 10px;
                transform: translateX(100%);
                transition: transform 0.3s ease-in-out;
            }
            
            .container.right-panel-active .sign-in-container {
                transform: translateX(-100%);
            }
            
            .container.right-panel-active .sign-up-container {
                transform: translateX(0);
                display: block;
            }
            
            /* .overlay-container {
                display: none !important;
            } */
            
            .form-container {
                display: block !important;
                width: 50%;
                padding: 40px;
                box-sizing: border-box;
                margin: 0;
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                transition: transform 0.6s ease-in-out;
            }
            
            .form-container h1 {
                font-size: 1.8rem;
                margin: 0 0 25px 0;
                text-align: center;
                color: #333;
            }
            
            .sign-up-container {
                display: block;
                width: 50%;
                padding: 40px;
                box-sizing: border-box;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                background: #fff;
                height: 100%;
                transform: translateX(100%);
                transition: transform 0.6s ease-in-out;
            }

            .overlay {
                position: relative !important;
                transform: none !important;
                width: 100% !important;
                height: auto !important;
                background: transparent !important;
                box-shadow: none !important;
            }

            .overlay-panel {
                position: relative !important;
                transform: none !important;
                width: 100% !important;
                padding: 25px !important;
                margin: 0 !important;
                background: linear-gradient(135deg, #FFD700, #FFA500);
                border-radius: 10px;
                color: white;
                text-align: center;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            }

            .overlay-left, 
            .overlay-right {
                position: relative !important;
                transform: none !important;
                width: 100% !important;
                padding: 25px !important;
            }

            .ghost {
                background: rgba(255, 255, 255, 0.2);
                border: 1px solid white;
                color: white;
                padding: 10px 25px;
                border-radius: 20px;
                margin-top: 15px;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .ghost:hover {
                background: rgba(255, 255, 255, 0.3);
            }

            .container {
                flex-direction: column;
                min-height: 100vh;
                padding: 10px;
                overflow-x: hidden;
            }
            
            .form-container {
                width: 100%;
                max-width: 100%;
                height: auto;
                min-height: auto;
                margin: 10px 0;
                padding: 15px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                border-radius: 8px;
            }
            
            .form-container form {
                padding: 15px 10px;
            }
            
            h1 {
                font-size: 24px;
                margin-bottom: 15px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 10px;
            }
            
            .form-row .input-group {
                width: 100%;
                margin-bottom: 10px;
            }
            
            .progress-steps {
                margin: 15px 0 20px;
            }
            
            .progress-steps .step {
                width: 30px;
                height: 30px;
                font-size: 14px;
                margin: 0 8px;
            }
            
            input[type="email"],
            input[type="password"],
            input[type="text"],
            input[type="tel"],
            select {
                padding: 14px 12px;
                font-size: 16px;
                min-height: 48px;
            }
            
            button {
                padding: 14px 20px;
                font-size: 16px;
                width: 100%;
                margin: 8px 0;
                min-height: 48px;
            }
            
            .form-navigation {
                flex-direction: column;
                gap: 10px;
                margin: 20px 0 10px;
                padding: 15px 0 5px;
                border-top: 1px solid #eee;
            }
            
            .form-navigation button {
                width: 100%;
                margin: 5px 0;
            }
            
            /* Adjust the overlay for mobile */
            .overlay-container {
                position: relative;
                width: 100%;
                height: auto;
                top: 0;
                transform: none;
                left: 0;
                margin: 10px 0;
                order: -1;
            }
            
            .overlay {
                background: linear-gradient(to right, #FFD700, #FFA500) !important;
                flex-direction: column;
                padding: 20px;
                text-align: center;
                border-radius: 8px;
                height: auto;
                left: 0;
                width: 100%;
                transform: none !important;
            }
            
            .overlay-panel {
                position: relative;
                padding: 20px;
                width: 100%;
                transform: none !important;
                height: auto;
            }
            
            /* Make sure form is visible on mobile */
            .sign-up-container,
            .sign-in-container {
                position: relative;
                width: 100%;
                transform: none;
                opacity: 1;
                z-index: 10;
                display: none;
            }
            
            .container.right-panel-active .sign-in-container {
                display: none;
            }
            
            .container.right-panel-active .sign-up-container {
                display: block;
            }
            
            .sign-in-container {
                display: block;
            }
            
            /* Mobile toggle buttons */
            .mobile-toggle {
                display: block;
                margin: 15px auto;
                max-width: 250px;
            }
            
            .desktop-toggle {
                display: none;
            }
            
            /* Adjust form steps */
            .form-step {
                padding: 10px 0;
            }
            
            /* Social icons */
            .social-container {
                margin: 10px 0 20px;
            }
            
            .social {
                margin: 0 8px;
                width: 40px;
                height: 40px;
                line-height: 40px;
            }
        }
        
        /* For very small devices */
        @media (max-width: 480px) {
            .form-container {
                padding: 10px;
            }
            
            .form-container form {
                padding: 10px 5px;
            }
            
            h1 {
                font-size: 22px;
                margin-bottom: 12px;
            }
            
            .progress-steps {
                margin: 10px 0 15px;
            }
            
            .progress-steps .step {
                width: 28px;
                height: 28px;
                font-size: 13px;
                margin: 0 5px;
            }
        }

        form {
            background: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-direction: column;
            padding: 20px 50px;
            min-height: 100%;
            text-align: center;
            width: 100%;
            border-radius: 10px;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"],
        input[type="tel"] {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px 15px;
            margin: 8px 0;
            outline: none;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus,
        input[type="tel"]:focus {
            border-color: #FFD700;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
        }
        
        input[type="checkbox"] {
            width: auto;
            margin-right: 8px;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
                        0 10px 10px rgba(0,0,0,0.22);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .form-container {
            background-color: #FFFFFF;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.1), 0 10px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow-y: auto;
            width: 768px;
            max-width: 100%;
            max-height: 90vh;
            padding: 20px;
        }

        .form-container form {
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-direction: column;
            padding: 20px 15px;
            min-height: 100%;
            text-align: center;
            width: 100%;
            border-radius: 10px;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
            overflow-y: auto;
        }

        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {
            0%, 49.99% {
                opacity: 0;
                z-index: 1;
            }
            
            50%, 100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .forgot-password {
            transition: all 0.3s ease;
            color: #666;
        }

        .forgot-password:hover {
            color: #FFA500;
            text-decoration: none;
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container{
            transform: translateX(-100%);
        }

        .overlay {
            background: #fff9e6;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.1);
            background: -webkit-linear-gradient(to right, #FFD700, #FFA500);
            background: linear-gradient(to right, #FFD700, #FFA500);
            color: #000000;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            color: #000000;
            transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            color: #000000;
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        .social-container {
            margin: 20px 0;
        }

        /* Styles for Need a solar text */
        .auth-actions {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin: 15px 0;
            align-items: center;
        }
        
        .mobile-register-btn {
            display: none; /* Hide by default */
            background: transparent;
            border: 1px solid #FFD700;
            color: #000000;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-left: 10px;
        }
        
        .mobile-register-btn:hover {
            background: rgba(255, 215, 0, 0.1);
        }
        
        /* Show only on mobile */
        @media (max-width: 992px) {
            .mobile-register-btn {
                display: inline-block;
            }
        }
        
        .need-solar-text {
            position: absolute;
            bottom: 30px;
            left: 0;
            right: 0;
            text-align: center;
            color: #000000;
            font-size: 0.9rem;
            margin-top: 20px;
            padding: 0 20px;
        }
        
        .solar-link {
            color: #0000EE;
            text-decoration: underline;
            font-weight: 500;
            margin-left: 5px;
        }
        
        .solar-link:hover {
            color: #0000CC;
        }
        
        /* Ensure overlay panels have proper positioning for the text */
        .overlay-panel {
            padding-bottom: 60px; /* Add space for the absolute positioned text */
        }

        .social-container a:hover {
            background-color: #FFD700;
            color: #000000;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .social-container a {
            transition: all 0.3s ease;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
            color: #000000;
            text-decoration: none;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }




/* Add these styles to your existing style section */
.progress-steps {
    display: flex;
    justify-content: center;
    margin: 20px 0 30px;
    position: relative;
}

.progress-steps::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 2px;
    background: #e0e0e0;
    z-index: 1;
}

.progress-steps .step {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #e0e0e0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
    font-weight: bold;
    position: relative;
    z-index: 2;
    margin: 0 15px;
    transition: all 0.3s ease;
}

.progress-steps .step.active {
    background: #FFD700;
    color: #000;
}

.form-step {
    display: none;
    animation: fadeIn 0.5s ease;
}

.form-step.active {
    display: block;
}

.form-row {
    display: flex;
    gap: 15px;
    width: 100%;
    margin-bottom: 10px;
}

.form-row input,
.form-row select {
    flex: 1;
    min-width: 0;
}

.form-navigation {
    display: flex;
    justify-content: space-between;
    width: 100%;
    margin-top: 20px;
}

.form-navigation button {
    margin: 0;
    padding: 10px 20px;
}

.form-checkbox {
    display: flex;
    align-items: center;
    margin: 15px 0;
    text-align: left;
    width: 100%;
}

.form-checkbox input[type="checkbox"] {
    width: auto;
    margin-right: 10px;
}

.form-checkbox label {
    font-size: 14px;
    color: #666;
    cursor: pointer;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .form-row {
        flex-direction: column;
        gap: 10px;
    }
    
    .form-navigation {
        flex-direction: column;
        gap: 10px;
    }
    
    .form-navigation button {
        width: 100%;
    }
    
    .progress-steps .step {
        width: 25px;
        height: 25px;
        font-size: 12px;
        margin: 0 10px;
    }
}








            </style>
        </head>
        <body>


        <div class="container" id="container">
<!-- Update the registration form section -->
<div class="form-container sign-up-container">
    <form id="registrationForm" method="POST" action="{{ route('register') }}" class="multi-step-form" novalidate>
        @csrf
      
        <h1>Registration</h1>
        <div class="social-container">
            <a href="#" class="social"><i class="fas fa-solar-panel"></i></a>
            <a href="#" class="social"><i class="fas fa-sun"></i></a>
            <a href="#" class="social"><i class="fas fa-leaf"></i></a>
        </div>
        <span>Start your solar journey with us</span>
        
        <!-- Progress Steps -->
        <div class="progress-steps">
            <div class="step active" data-step="1">1</div>
            <div class="step" data-step="2">2</div>
            <div class="step" data-step="3">3</div>
        </div>

        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Step 1: Account basics -->
        <div class="form-step active" id="step1">
            
            
            <div class="role-selection" style="width:100%; text-align:left; margin-top:5px;">
                <h4>Are you registering as</h4>
                <div class="role-grid">
                    <label class="role-card {{ old('company_type') == 'manufacturer' ? 'active' : '' }}" data-role-option>
                        <input type="radio" name="company_type" value="manufacturer" {{ old('company_type') == 'manufacturer' ? 'checked' : '' }} required>
                        <div class="role-icon" style="background:#eef2ff; color:#4338ca;">M</div>
                        <div class="role-text">
                            <span class="role-title">Manufacturer</span>
                        </div>
                    </label>
                    <label class="role-card {{ old('company_type') == 'distributor' ? 'active' : '' }}" data-role-option>
                        <input type="radio" name="company_type" value="distributor" {{ old('company_type') == 'distributor' ? 'checked' : '' }} required>
                        <div class="role-icon" style="background:#fff7ed; color:#c2410c;">D</div>
                        <div class="role-text">
                            <span class="role-title">Distributor / Service Provider</span>
                        </div>
                    </label>
                </div>
                <span class="error-msg"></span>
            </div>
            <h3>Basic details</h3>
            <div class="form-row">
                <div class="input-group">
                    <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>
                    <span class="error-msg"></span>
                </div>
                <div class="input-group">
                    <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
                    <span class="error-msg"></span>
                </div>
            </div>
            <div class="input-group">
                <input type="email" name="email" placeholder="Work Email" value="{{ old('email') }}" required>
                <span class="error-msg"></span>
            </div>
            <div class="input-group">
                <input type="tel" name="phone" id="phone" placeholder="Phone Number" value="{{ old('phone') }}" required>
                <span class="error-msg"></span>
            </div>
            
            <div class="form-navigation">
                <button type="button" class="next-step">Next <i class="fas fa-arrow-right"></i></button>
            </div>
        </div>

        <!-- Step 2: Company snapshot -->
        <div class="form-step" id="step2">
            <h3>Company info</h3>
            <div class="input-group">
                <input type="text" name="company_name" placeholder="Company / Brand Name" value="{{ old('company_name') }}" required>
                <span class="error-msg"></span>
            </div>
            <div class="input-group">
                <input type="text" name="state" placeholder="Headquarter State" value="{{ old('state') }}" required>
                <span class="error-msg"></span>
            </div>
            <div class="input-group">
                <select name="primary_goal">
                    <option value="">What brings you here?</option>
                    <option value="showcase_products" {{ old('primary_goal') == 'showcase_products' ? 'selected' : '' }}>Showcase products / services</option>
                    <option value="find_leads" {{ old('primary_goal') == 'find_leads' ? 'selected' : '' }}>Generate verified leads</option>
                    <option value="listings" {{ old('primary_goal') == 'listings' ? 'selected' : '' }}>Get listed in comparisons</option>
                </select>
                <span class="error-msg"></span>
            </div>
            <div class="input-group">
                <textarea name="notes" rows="3" placeholder="Anything else we should know? (optional)">{{ old('notes') }}</textarea>
                <span class="error-msg"></span>
            </div>
            <div class="form-navigation">
                <button type="button" class="prev-step"><i class="fas fa-arrow-left"></i> Previous</button>
                <button type="button" class="next-step">Next <i class="fas fa-arrow-right"></i></button>
            </div>
        </div>

        <!-- Step 3: Account Setup -->
        <div class="form-step" id="step3">
            <h3>Account Setup</h3>
            <div class="input-group">
                <input type="password" name="password" placeholder="Create Password (min 8 characters)" minlength="8" required>
                <span class="error-msg"></span>
            </div>
            <div class="input-group">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" minlength="8" required>
                <span class="error-msg"></span>
            </div>
            <div class="form-checkbox">
                <input type="checkbox" id="terms" name="terms" {{ old('terms') ? 'checked' : '' }} required>
                <label for="terms">I agree to the <a href="#" target="_blank">Terms & Conditions</a></label>
                <span class="error-msg"></span>
            </div>
            <div class="form-navigation">
                <button type="button" class="prev-step"><i class="fas fa-arrow-left"></i> Previous</button>
                <button type="submit" class="submit-btn">Create Account</button>
            </div>
        </div>
    </form>
</div>
        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1> Login</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fas fa-solar-panel"></i></a>
                    <a href="#" class="social"><i class="fas fa-user-shield"></i></a>
                    <a href="#" class="social"><i class="fas fa-key"></i></a>
                </div>
                <span>Access your solar dashboard</span>
                
                @if($errors->any())
                    <div style="color: #EF4444; margin-bottom: 15px; font-size: 14px;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <input id="email" type="email" 
                       class="@error('email') is-invalid @enderror" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autocomplete="email" 
                       autofocus
                       placeholder="Email Address" />
                
                <input id="password" 
                       type="password" 
                       class="@error('password') is-invalid @enderror" 
                       name="password" 
                       required 
                       autocomplete="current-password"
                       placeholder="Your Password" />
                
                <div style="margin: 10px 0 0 0; width: 100%; text-align: left;">
                    <label style="display: flex; align-items: center; cursor: pointer;">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} 
                               style="margin-right: 8px; width: auto;">
                        <span style="font-size: 14px; color: #666;">{{ __('Remember Me') }}</span>
                    </label>
                </div>

                <div class="auth-actions">
                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    <button type="button" class="mobile-register-btn" id="mobileRegisterBtn">
                        {{ __('Register') }}
                    </button>
                </div>

                <button type="submit">Login to Dashboard</button>
            </form>
        </div>
        <!-- Overlay container is hidden on mobile -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>Monitor your solar panel performance and track your energy savings</p>
                    <button class="ghost" id="signIn">Login to Dashboard</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>New to Solar?</h1>
                    <p>Join us to monitor your solar energy production and savings</p>
                    <button class="ghost" id="signUp">Create Account</button>
                </div>
            </div>
        </div>
        </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        // Toggle between login and signup panels
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');
        const mobileRegisterBtn = document.getElementById('mobileRegisterBtn');
        const mobileBackBtn = document.createElement('button');
        
        document.addEventListener('DOMContentLoaded', () => {
            // Create back to login button for mobile
            mobileBackBtn.innerHTML = '← Back to Login';
            mobileBackBtn.className = 'mobile-back-btn';
            mobileBackBtn.type = 'button';
            mobileBackBtn.style.display = 'none';
            mobileBackBtn.style.margin = '15px 0';
            mobileBackBtn.style.background = 'transparent';
            mobileBackBtn.style.border = 'none';
            mobileBackBtn.style.color = '#3B82F6';
            mobileBackBtn.style.cursor = 'pointer';
            mobileBackBtn.style.fontSize = '14px';
            mobileBackBtn.style.padding = '8px 0';
            mobileBackBtn.style.textAlign = 'left';
            mobileBackBtn.style.width = '100%';

            const signUpForm = document.querySelector('.sign-up-container form');
            if (signUpForm && !signUpForm.querySelector('.mobile-back-btn')) {
                signUpForm.insertBefore(mobileBackBtn, signUpForm.firstChild);
            }

            const roleOptions = document.querySelectorAll('[data-role-option] input[type="radio"]');
            const roleCards = document.querySelectorAll('[data-role-option]');
            const roleFields = document.querySelector('[data-role-fields]');
            const roleFieldInputs = roleFields ? roleFields.querySelectorAll('input, select, textarea') : [];
            const roleBlocks = document.querySelectorAll('[data-role-block]');
            const tagInputs = document.querySelectorAll('.tag-option input');

            const updateRoleState = () => {
                const selected = document.querySelector('[data-role-option] input[type="radio"]:checked');
                const hasSelection = !!selected;

                if (roleFields) {
                    roleFields.classList.toggle('disabled', !hasSelection);
                }

                roleFieldInputs.forEach(input => {
                    if (hasSelection) {
                        input.removeAttribute('disabled');
                    } else {
                        input.setAttribute('disabled', 'disabled');
                    }
                });

                roleCards.forEach(card => {
                    const input = card.querySelector('input[type="radio"]');
                    card.classList.toggle('active', input && input.checked);
                });

                if (selected) {
                    const value = selected.value;
                    roleBlocks.forEach(block => {
                        const matches = block.dataset.roleBlock === value;
                        block.classList.toggle('active', matches);

                        block.querySelectorAll('input, textarea, select').forEach(field => {
                            if (matches) {
                                field.removeAttribute('disabled');
                            } else {
                                field.setAttribute('disabled', 'disabled');
                                if (field.type === 'checkbox' || field.type === 'radio') {
                                    field.checked = false;
                                } else {
                                    field.value = '';
                                }
                            }
                        });
                    });
                } else {
                    roleBlocks.forEach(block => block.classList.remove('active'));
                }
            };

            roleOptions.forEach(option => option.addEventListener('change', updateRoleState));

            roleCards.forEach(card => {
                card.addEventListener('click', (event) => {
                    const radio = card.querySelector('input[type="radio"]');
                    if (!radio) return;
                    if (event.target !== radio) {
                        radio.checked = true;
                        radio.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });
            });

            tagInputs.forEach(input => {
                const parent = input.closest('.tag-option');
                if (!parent) return;

                const syncTagState = () => {
                    parent.classList.toggle('active', input.checked);
                };

                input.addEventListener('change', syncTagState);
                syncTagState();
            });

            updateRoleState();
        });
        
        // Handle mobile register button click
        if (mobileRegisterBtn) {
            mobileRegisterBtn.addEventListener('click', function(e) {
                e.preventDefault();
                container.classList.add('right-panel-active');
                mobileBackBtn.style.display = 'block';
                
                // Hide overlay container on mobile when register is clicked
                const overlayContainer = document.querySelector('.overlay-container');
                if (window.innerWidth <= 992 && overlayContainer) {
                    overlayContainer.style.display = 'none';
                }
                
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
        
        // Handle back to login button
        mobileBackBtn.addEventListener('click', function() {
            container.classList.remove('right-panel-active');
            this.style.display = 'none';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
        
        // Update mobile view on resize
        function handleMobileView() {
            const isMobile = window.innerWidth <= 992;
            
            if (isMobile) {
                // Hide overlay container on mobile
                const overlayContainer = document.querySelector('.overlay-container');
                if (overlayContainer) {
                    overlayContainer.style.display = 'none';
                }
                
                // Show/hide back button based on active panel
                if (container.classList.contains('right-panel-active')) {
                    mobileBackBtn.style.display = 'block';
                } else {
                    mobileBackBtn.style.display = 'none';
                }
            } else {
                // Reset for desktop view
                mobileBackBtn.style.display = 'none';
                const overlayContainer = document.querySelector('.overlay-container');
                
            }
        }
        let iti; // Store the intlTelInput instance
        let currentStep = 1;
        const totalSteps = 3;

        function showStep(step) {
            // Hide all steps first
            document.querySelectorAll('.form-step').forEach(stepEl => {
                stepEl.classList.remove('active');
            });
            
            // Show current step
            const currentStepElement = document.getElementById(`step${step}`);
            if (currentStepElement) {
                currentStepElement.classList.add('active');
                // Scroll to top of the form
                currentStepElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
            
            // Update progress indicators
            updateProgress();
        }
        
        function updateProgress() {
            document.querySelectorAll('.step').forEach((stepEl, index) => {
                if (index + 1 <= currentStep) {
                    stepEl.classList.add('active');
                } else {
                    stepEl.classList.remove('active');
                }
            });
        }

        // Handle both desktop and mobile toggle buttons
        const mobileSignUpButton = document.getElementById('mobileSignUp');
        const mobileSignInButton = document.getElementById('mobileSignIn');

        function showSignUp() {
            container.classList.add('right-panel-active');
            
            // Handle mobile view
            if (window.innerWidth <= 992) {
                window.scrollTo({ top: 0, behavior: 'smooth' });
                // Ensure overlay panels are properly displayed on mobile
                const overlayContainer = document.querySelector('.overlay-container');
                if (overlayContainer) {
                    overlayContainer.style.display = 'flex';
                }
            }
        }

        function showSignIn() {
            container.classList.remove('right-panel-active');
            
            // Handle mobile view
            if (window.innerWidth <= 992) {
                window.scrollTo({ top: 0, behavior: 'smooth' });
                // Ensure overlay panels are properly displayed on mobile
                const overlayContainer = document.querySelector('.overlay-container');
                if (overlayContainer) {
                    overlayContainer.style.display = 'flex';
                }
            }
        }

        // Desktop buttons
        if (signUpButton) signUpButton.addEventListener('click', showSignUp);
        if (signInButton) signInButton.addEventListener('click', showSignIn);
        
        // Mobile buttons
        if (mobileSignUpButton) mobileSignUpButton.addEventListener('click', showSignUp);
        if (mobileSignInButton) mobileSignInButton.addEventListener('click', showSignIn);
        
        // Mobile back to login button
        const mobileBackToLogin = document.getElementById('mobileBackToLogin');
        if (mobileBackToLogin) {
            mobileBackToLogin.addEventListener('click', function(e) {
                e.preventDefault();
                showSignIn();
                // Ensure overlay container is visible on mobile
                if (window.innerWidth <= 992) {
                    const overlayContainer = document.querySelector('.overlay-container');
                    if (overlayContainer) {
                        overlayContainer.style.display = 'flex';
                    }
                }
            });
        }

        // Multi-step form functionality
        // Call handleMobileView on load and resize
        window.addEventListener('load', handleMobileView);
        window.addEventListener('resize', handleMobileView);
        
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize phone number input
            const phoneInput = document.querySelector("#phone");
            if (phoneInput) {
                iti = window.intlTelInput(phoneInput, {
                    preferredCountries: ["in"],
                    separateDialCode: true,
                    autoPlaceholder: 'aggressive',
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                });
                
                // Format phone number on blur
                phoneInput.addEventListener('blur', function() {
                    if (phoneInput.value.trim()) {
                        if (iti.isValidNumber()) {
                            phoneInput.value = iti.getNumber();
                        }
                    }
                });
            }

            // Show first step by default
            showStep(currentStep);
            
            // Handle next/previous button clicks
            document.addEventListener('click', function(e) {
                // Next button click
                if (e.target.classList.contains('next-step') || 
                    (e.target.closest && e.target.closest('.next-step'))) {
                    e.preventDefault();
                    const currentStepElement = document.querySelector(`.form-step.active`);
                    const inputs = currentStepElement.querySelectorAll('input[required], select[required]');
                    let isValid = true;
                    
                    // Validate current step
                    inputs.forEach(input => {
                        if (!input.value.trim() || 
                            (input.type === 'checkbox' && !input.checked)) {
                            input.classList.add('error');
                            const errorMsg = input.nextElementSibling;
                            if (errorMsg && errorMsg.classList.contains('error-msg')) {
                                errorMsg.textContent = 'This field is required';
                            }
                            isValid = false;
                            
                            // Scroll to first error
                            if (isValid) {
                                input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }
                        }
                    });
                    
                    if (isValid && currentStep < totalSteps) {
                        currentStep++;
                        showStep(currentStep);
                    }
                }
                
                // Previous button click
                if (e.target.classList.contains('prev-step') || 
                    (e.target.closest && e.target.closest('.prev-step'))) {
                    e.preventDefault();
                    if (currentStep > 1) {
                        currentStep--;
                        showStep(currentStep);
                    }
                }
            });
            
            // Add error class on invalid
            document.querySelectorAll('input, select').forEach(input => {
                input.addEventListener('invalid', function(e) {
                    e.preventDefault();
                    this.classList.add('error');
                    const errorMsg = this.nextElementSibling;
                    if (errorMsg && errorMsg.classList.contains('error-msg')) {
                        errorMsg.textContent = this.validationMessage;
                    }
                });
                
                // Clear error on input
                input.addEventListener('input', function() {
                    this.classList.remove('error');
                    const errorMsg = this.nextElementSibling;
                    if (errorMsg && errorMsg.classList.contains('error-msg')) {
                        errorMsg.textContent = '';
                    }
                });
            });
            
            // Handle form submission
            const registrationForm = document.getElementById('registrationForm');
            if (registrationForm) {
                registrationForm.addEventListener('submit', function(e) {
                    // Validate all steps before submission
                    let isValid = true;
                    const allInputs = this.querySelectorAll('input[required], select[required]');
                    
                    allInputs.forEach(input => {
                        if (!input.value.trim() || (input.type === 'checkbox' && !input.checked)) {
                            input.classList.add('error');
                            const errorMsg = input.nextElementSibling;
                            if (errorMsg && errorMsg.classList.contains('error-msg')) {
                                errorMsg.textContent = 'This field is required';
                            }
                            isValid = false;
                            
                            // Scroll to first error
                            if (isValid) {
                                input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }
                        }
                    });
                    
                    // Validate password match
                    const password = this.querySelector('input[name="password"]');
                    const confirmPassword = this.querySelector('input[name="password_confirmation"]');
                    
                    if (password && confirmPassword && password.value !== confirmPassword.value) {
                        confirmPassword.classList.add('error');
                        const errorMsg = confirmPassword.nextElementSibling;
                        if (errorMsg && errorMsg.classList.contains('error-msg')) {
                            errorMsg.textContent = 'Passwords do not match';
                        }
                        isValid = false;
                    }
                    
                    if (!isValid) {
                        e.preventDefault();
                        // Go to first step with error
                        currentStep = 1;
                        showStep(currentStep);
                        updateProgress();
                    }
                });
            }
            
            // Function to reset registration form
            function resetRegistrationForm() {
                const form = document.getElementById('registrationForm');
                if (form) {
                    form.reset();
                    currentStep = 1;
                    showStep(currentStep);
                    updateProgress();
                    
                    // Clear all error messages
                    document.querySelectorAll('.error-msg').forEach(el => {
                        el.textContent = '';
                    });
                    
                    // Clear error classes
                    document.querySelectorAll('.error').forEach(el => {
                        el.classList.remove('error');
                    });
                    
                    // Reset phone input
                    if (iti) {
                        iti.setNumber('');
                    }
                }
            }
        });
    </script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize phone number input
        const phoneInput = document.querySelector("#phone");
        if (phoneInput) {
            window.intlTelInput(phoneInput, {
                preferredCountries: ["in"],
                separateDialCode: true,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });
        }

        // Form steps functionality
        let currentStep = 1;
        const totalSteps = 3;
        
        // Show first step by default
        showStep(currentStep);
        
        // Next button click
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('next-step') || 
                (e.target.closest('.next-step'))) {
                e.preventDefault();
                const currentStepElement = document.getElementById(`step${currentStep}`);
                const inputs = currentStepElement.querySelectorAll('input[required], select[required]');
                let isValid = true;
                
                // Validate current step
                inputs.forEach(input => {
                    if (!input.value.trim() || 
                        (input.type === 'checkbox' && !input.checked)) {
                        input.classList.add('error');
                        isValid = false;
                    } else {
                        input.classList.remove('error');
                    }
                });
                
                if (isValid) {
                    if (currentStep < totalSteps) {
                        currentStep++;
                        showStep(currentStep);
                        updateProgress();
                    }
                }
            }
            
            // Previous button click
            if (e.target.classList.contains('prev-step') || 
                (e.target.closest('.prev-step'))) {
                e.preventDefault();
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep);
                    updateProgress();
                }
            }
        });
        
        function showStep(step) {
            // Hide all steps
            document.querySelectorAll('.form-step').forEach(step => {
                step.style.display = 'none';
            });
            
            // Show current step
            const currentStepElement = document.getElementById(`step${step}`);
            if (currentStepElement) {
                currentStepElement.style.display = 'block';
            }
        }
        
        function updateProgress() {
            document.querySelectorAll('.step').forEach((step, index) => {
                if (index + 1 <= currentStep) {
                    step.classList.add('active');
                } else {
                    step.classList.remove('active');
                }
            });
        }
        
        // Add error class on invalid
        document.querySelectorAll('input, select').forEach(input => {
            input.addEventListener('invalid', function() {
                this.classList.add('error');
            });
        });
    });
</script>
</body>
</html>