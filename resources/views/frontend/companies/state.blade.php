<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Top Solar Companies in {{ $state['name'] }} - Solar Reviews</title>
    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #1e40af;
            --secondary-color: #1e3a8a;
            --accent-color: #3b82f6;
            --text-color: #1f2937;
            --light-bg: #f9fafb;
        }

        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: var(--light-bg);
            color: var(--text-color);
        }

        .page-wrapper {
            display: flex;
            justify-content: center;
            padding: 30px 20px;
        }

        /* Left Sidebar */
        .sidebar {
            width: 260px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin-right: 25px;
            height: fit-content;
        }

        .sidebar h3 {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 12px;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin-bottom: 8px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #3498db;
            font-size: 14px;
        }

        .calculator {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .calculator input {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .calculator button {
            width: 100%;
            background: #3498db;
            color: #fff;
            border: none;
            padding: 10px 0;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
        }

        /* Right Content */
        .content {
            max-width: 850px;
            flex: 1;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .company-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 25px;
            padding: 20px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .company-left {
            display: flex;
            align-items: flex-start;
        }

        .company-logo {
            width: 90px;
            height: 70px;
            object-fit: contain;
            margin-right: 20px;
            border: 1px solid #eee;
            padding: 5px;
            background: #fff;
            border-radius: 5px;
        }

        .company-info h2 {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .stars {
            color: #f5a623;
            font-size: 15px;
        }

        .rating-text {
            font-size: 14px;
            color: #7f8c8d;
        }

        .company-desc {
            font-size: 14px;
            color: #555;
            margin-top: 8px;
            line-height: 1.6;
        }

        .company-desc a {
            color: #3498db;
            text-decoration: none;
        }

        .rating-bar {
            margin-top: 12px;
            display: flex;
            align-items: center;
        }

        .blue-bar {
            background: #3498db;
            height: 8px;
            width: 60px;
            border-radius: 3px;
            margin-right: 6px;
        }

        .get-quote {
            background: #3498db;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .get-quote-btn {
            background: #3498db;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .write-review-btn {
            background: #3498db;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        @media(max-width: 992px) {
            .page-wrapper { flex-direction: column; }
            .sidebar { width: 100%; margin-right: 0; margin-bottom: 20px; }
            .content { width: 100%; }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
        }

        /* Custom Modal Styles */
        .custom-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .custom-modal-content {
            background-color: #fff;
            margin: 5% auto;
            width: 90%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .custom-modal-header {
            padding: 15px 20px;
            background: #3498db;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .custom-modal-header h3 {
            margin: 0;
            font-size: 18px;
        }

        .close-btn {
            font-size: 24px;
            cursor: pointer;
            color: white;
        }

        .custom-modal-body {
            padding: 20px;
            max-height: 70vh;
            overflow-y: auto;
        }

        .custom-modal-footer {
            padding: 15px 20px;
            background: #f8f9fa;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .input-group {
            display: flex;
            gap: 10px;
            margin-bottom: 5px;
        }

        .input-group input {
            flex: 1;
        }

        button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        #sendOtpBtn,
        #verifyOtpBtn {
            background-color: #f0f0f0;
            color: #333;
        }

        #sendOtpBtn:hover,
        #verifyOtpBtn:hover {
            background-color: #e0e0e0;
        }

        .cancel-btn {
            background-color: #f0f0f0;
            color: #333;
        }

        .cancel-btn:hover {
            background-color: #e0e0e0;
        }

        .submit-btn {
            background-color: #3498db;
            color: white;
        }

        .submit-btn:hover {
            background-color: #2980b9;
        }

        .submit-btn:disabled {
            background-color: #bdc3c7;
            cursor: not-allowed;
        }

        /* Rating Stars */
        .rating-stars {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
            margin: 10px 0;
        }

        .rating-stars i {
            margin-right: 5px;
        }

        .rating-stars .fas {
            color: #f1c40f;
        }

        .otp-status {
            margin-top: 5px;
            font-size: 13px;
        }

        .otp-status.success {
            color: #27ae60;
        }

        .otp-status.error {
            color: #e74c3c;
        }
    </style>
</head>
<body>

@include('components.frontend.navbar')

<div class="page-wrapper">
    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Solar in your state </h3>
        <ul>
            @foreach($states as $s)
                <li><a href="{{ url('state/'.$s['slug']) }}">{{ $s['name'] }}</a></li>
            @endforeach
        </ul>

        <div class="calculator">
            <h3>Try our solar cost calculator</h3>
            <input type="text" placeholder="Enter your PIN code">
            <button>Calculate Now</button>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="header">
            <h1>Top Solar Companies in {{ $state['name'] }}</h1>
            <p>Compare verified solar installation companies in {{ $state['name'] }} with customer reviews and ratings.</p>
        </div>

        @forelse($companies as $company)
            @php
                $company = (object) $company; // Convert array to object for easier access
            @endphp
            <div class="company-card">
                <div class="company-left">
                    @if(!empty($company->logo) && $company->logo !== 'null')
                        <img src="{{ $company->logo }}" class="company-logo" alt="{{ $company->name ?? 'Company Logo' }}">
                    @else
                        <img src="{{ asset('images/company/cmp.png') }}" class="company-logo" alt="Default Company Logo">
                    @endif

                    <div class="company-info">
                        <h2>{{ $company->name ?? 'Company Name' }}</h2>
                        <div class="stars">
                            @php
                                $rating = $company->average_rating ?? 0;
                                $fullStars = floor($rating);
                                $hasHalfStar = $rating - $fullStars >= 0.5;
                            @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $fullStars)
                                    ★
                                @elseif($i == $fullStars + 1 && $hasHalfStar)
                                    ☆
                                @else
                                    ☆
                                @endif
                            @endfor
                            <span class="rating-text">
                                {{ number_format($rating, 1) }} 
                                ({{ $company->total_reviews ?? 0 }} {{ $company->total_reviews == 1 ? 'review' : 'reviews' }})
                            </span>
                        </div>
                        <div class="company-desc">
                            {{ Str::limit($company->description ?? 'No description available.', 180) }}
                            @if(strlen($company->description ?? '') > 180)
                                @if(!(auth()->check() && auth()->user()->is_admin))
                                    <button type="button" class="get-quote-btn write-review-btn"
                                            data-company-id="{{ $company->id }}"
                                            data-company-name="{{ $company->name }}"
                                            data-category-ids="{{ implode(',', $company->category_ids ?? []) }}">
                                        Write a Review
                                    </button>
                                @endif
                            @endif
                        </div>
                        <div class="rating-bar">
                            <div class="blue-bar"></div>
                            <div class="blue-bar"></div>
                            <div class="blue-bar"></div>
                            <div class="blue-bar"></div>
                            <div class="blue-bar"></div>
                            <span style="color:#777; font-size:13px; margin-left:5px;">Elite</span>
                        </div>
                    </div>
                </div>

                <div>
                    @if(!(auth()->check() && auth()->user()->is_admin))
                        <button type="button" class="get-quote write-review-btn" 
                                data-company-id="{{ $company->id }}" 
                                data-company-name="{{ $company->name }}"
                                data-category-ids="{{ implode(',', $company->category_ids ?? []) }}">
                            Write a Review
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div style="background:#fff; padding:30px; text-align:center; border-radius:8px; border:1px solid #eee;">
                <h3>No companies found in {{ $state['name'] }}</h3>
                <p>Check back later or explore other nearby states.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="custom-modal">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <h3>Write a Review</h3>
            <span class="close-btn">&times;</span>
        </div>
        <form id="reviewForm" method="POST" action="{{ route('reviews.store') }}">
            @csrf
            <input type="hidden" name="company_id" id="companyId">
            <div class="custom-modal-body">
                <div class="form-group">
                    <label for="state">State *</label>
                    {{-- Fix state to current page state --}}
                    <input type="hidden" name="state_id" value="{{ $state['id'] ?? ($state->id ?? '') }}">
                    <select id="state" disabled>
                        <option value="">
                            {{ $state['name'] ?? ($state->name ?? 'State') }}
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="category">Select Category *</label>
                    <select id="category" name="category_id" required>
                        <option value="">Select Category</option>
                        @if(isset($categories))
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-category-id="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Rate your experience with <span id="companyNameInModal"></span> *</label>
                    <div class="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="far fa-star" data-rating="{{ $i }}"></i>
                        @endfor
                        <input type="hidden" name="rating" id="rating" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="reviewTitle">Review Title (Optional)</label>
                    <input type="text" id="reviewTitle" name="review_title" placeholder="Summarize your experience">
                </div>
                
                <div class="form-group">
                    <label for="reviewText">Your Review *</label>
                    <textarea id="reviewText" name="review_text" rows="3" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="reviewerName">Your Name *</label>
                    <input type="text" id="reviewerName" name="reviewer_name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <div class="input-group">
                        <input type="email" id="email" name="email" required>
                        <button type="button" id="sendOtpBtn">Send OTP</button>
                    </div>
                    <small>We'll send a verification code to this email</small>
                </div>
                
                <div class="form-group" id="otpField" style="display: none;">
                    <label for="otp">Enter OTP *</label>
                    <div class="input-group">
                        <input type="text" id="otp" name="otp" maxlength="6" placeholder="Enter 6-digit OTP">
                        <button type="button" id="verifyOtpBtn">Verify</button>
                    </div>
                    <div class="otp-status" id="otpStatus"></div>
                </div>
            </div>
            <div class="custom-modal-footer">
                <button type="button" class="cancel-btn">Close</button>
                <button type="submit" class="submit-btn" id="submitReviewBtn" disabled>Submit Review</button>
            </div>
        </form>
    </div>
</div>

<!-- SweetAlert2 for alerts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Existing JavaScript
    
    // Review Modal Functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all DOM elements
        const reviewModal = document.getElementById('reviewModal');
        const writeReviewBtns = document.querySelectorAll('.write-review-btn');
        const closeBtn = document.querySelector('.close-btn');
        const cancelBtn = document.querySelector('.cancel-btn');
        const companyNameInModal = document.getElementById('companyNameInModal');
        const companyIdInput = document.getElementById('companyId');
        const ratingStars = document.querySelectorAll('.rating-stars i');
        const ratingInput = document.getElementById('rating');
        const emailInput = document.getElementById('email');
        const categorySelect = document.getElementById('category');
        const otpField = document.getElementById('otpField');
        const otpInput = document.getElementById('otp');
        const sendOtpBtn = document.getElementById('sendOtpBtn');
        const verifyOtpBtn = document.getElementById('verifyOtpBtn');
        const otpStatus = document.getElementById('otpStatus');
        const submitReviewBtn = document.getElementById('submitReviewBtn');
        
        // Initialize state variables
        let otpSent = false;
        let otpVerified = false;
        
        // Make sure ratingInput is properly initialized
        if (!ratingInput) {
            console.error('Rating input not found!');
        }
        
        // Cache original category options for filtering
        let originalCategoryOptions = [];
        if (categorySelect) {
            originalCategoryOptions = Array.from(categorySelect.options).map(option => ({
                value: option.value,
                text: option.text,
                categoryId: option.getAttribute('data-category-id')
            }));
        }

        function filterCategoriesForCompany(categoryIdsCsv) {
            if (!categorySelect || originalCategoryOptions.length === 0) return;

            const categoryIds = (categoryIdsCsv || '')
                .split(',')
                .map(id => id.trim())
                .filter(id => id !== '');

            // Clear current options
            categorySelect.innerHTML = '';

            // Add placeholder
            const placeholder = document.createElement('option');
            placeholder.value = '';
            placeholder.textContent = 'Select Category';
            categorySelect.appendChild(placeholder);

            let optionsToShow = [];

            // If company has specific categories, filter; otherwise show none
            if (categoryIds.length) {
                optionsToShow = originalCategoryOptions.filter(opt =>
                    opt.categoryId && categoryIds.includes(String(opt.categoryId))
                );
            } else {
                optionsToShow = [];
            }

            // Enable/disable select based on availability
            categorySelect.disabled = optionsToShow.length === 0;

            optionsToShow.forEach(opt => {
                const option = document.createElement('option');
                option.value = opt.value;
                option.textContent = opt.text;
                if (opt.categoryId) {
                    option.setAttribute('data-category-id', opt.categoryId);
                }
                categorySelect.appendChild(option);
            });
        }

        // Open review modal with company data
        writeReviewBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const companyId = this.getAttribute('data-company-id');
                const companyName = this.getAttribute('data-company-name');
                const companyCategoryIds = this.getAttribute('data-category-ids');
                
                companyIdInput.value = companyId;
                companyNameInModal.textContent = companyName;

                // Filter categories for this company
                filterCategoriesForCompany(companyCategoryIds);
                
                // Reset form
                resetReviewForm();
                
                // Show modal
                reviewModal.style.display = 'flex';
            });
        });
        
        // Handle star rating
        ratingStars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = parseInt(this.getAttribute('data-rating'));
                ratingInput.value = rating;
                
                // Update star display
                ratingStars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.add('active');
                        s.classList.add('fas');
                        s.classList.remove('far');
                    } else {
                        s.classList.remove('active');
                        s.classList.add('far');
                        s.classList.remove('fas');
                    }
                });
            });
        });
        
        // Send OTP
        sendOtpBtn.addEventListener('click', function() {
            const email = emailInput.value.trim();
            
            if (!email) {
                showAlert('Error', 'Please enter your email address', 'error');
                return;
            }
            
            // Show loading state
            const originalText = sendOtpBtn.innerHTML;
            sendOtpBtn.disabled = true;
            sendOtpBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';
            
            // Make AJAX call to send OTP
            fetch('{{ route("reviews.send-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                console.log('OTP Response:', data);
                
                if (data.success) {
                    // In development, show OTP in console
                    if (data.otp) {
                        console.log('Your OTP for testing:', data.otp);
                        showAlert('OTP Sent', `OTP sent to ${email}. Check console for OTP (for testing).`, 'success');
                    } else {
                        showAlert('OTP Sent', 'We have sent a 6-digit OTP to your email address.', 'success');
                    }
                    
                    // Show OTP field
                    otpField.style.display = 'block';
                    otpSent = true;
                    
                    // Focus OTP input
                    otpInput.focus();
                } else {
                    throw new Error(data.message || 'Failed to send OTP');
                }
            })
            .catch(error => {
                console.error('Error sending OTP:', error);
                showAlert('Error', error.message || 'Failed to send OTP. Please try again.', 'error');
            })
            .finally(() => {
                // Reset button state
                sendOtpBtn.disabled = false;
                sendOtpBtn.innerHTML = 'Resend OTP';
            });
        });
        
        // Handle OTP verification
        if (verifyOtpBtn && otpInput && otpStatus) {
            verifyOtpBtn.addEventListener('click', function() {
                const otp = otpInput.value.trim();
                const email = emailInput ? emailInput.value.trim() : '';
                
                if (!otp || otp.length !== 6) {
                    showAlert('Error', 'Please enter a valid 6-digit OTP', 'error');
                    return;
                }

                // Show loading state
                const originalText = verifyOtpBtn.innerHTML;
                verifyOtpBtn.disabled = true;
                verifyOtpBtn.innerHTML = 'Verifying...';

                // Make API call to verify OTP
                fetch('{{ route("reviews.verify-otp") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        email: email,
                        otp: otp
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('OTP Verification Response:', data);
                    
                    if (data.success) {
                        otpVerified = true;
                        if (submitReviewBtn) submitReviewBtn.disabled = false;
                        otpStatus.textContent = 'OTP verified successfully!';
                        otpStatus.className = 'otp-status success';
                        verifyOtpBtn.innerHTML = 'Verified';
                        verifyOtpBtn.disabled = true;
                        
                        // Show success message
                        showAlert('Success', 'OTP verified successfully!', 'success');
                    } else {
                        throw new Error(data.message || 'Failed to verify OTP');
                    }
                })
                .catch(error => {
                    console.error('Error verifying OTP:', error);
                    otpStatus.textContent = error.message || 'Failed to verify OTP. Please try again.';
                    otpStatus.className = 'otp-status error';
                    verifyOtpBtn.disabled = false;
                    verifyOtpBtn.innerHTML = originalText;
                    
                    // Show error message
                    showAlert('Error', error.message || 'Failed to verify OTP. Please try again.', 'error');
                });
            });
        }

        // Form submission
        const reviewForm = document.getElementById('reviewForm');
        if (reviewForm) {
            reviewForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!otpVerified) {
                    showAlert('Error', 'Please verify your email with OTP first', 'error');
                    return;
                }
                
                // Show loading state
                submitReviewBtn.disabled = true;
                submitReviewBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...';
                
                // Get form data
                const formData = new FormData(this);
                
                // Convert FormData to JSON
                const formObject = {};
                formData.forEach((value, key) => {
                    formObject[key] = value;
                });
                
                // Add email if not already in form
                if (emailInput && emailInput.value) {
                    formObject['email'] = emailInput.value;
                }
                
                // Debug: Log the data being sent
                console.log('Submitting form data:', formObject);
                
                // Submit form via AJAX
                fetch(this.action, {
                    method: 'POST',
                    body: JSON.stringify(formObject),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('Success', 'Thank you for your review! It will be visible after approval.', 'success');
                        reviewModal.style.display = 'none';
                        // Reload the page to see the updated reviews
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        throw new Error(data.message || 'Failed to submit review');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Error', error.message || 'Failed to submit review. Please try again.', 'error');
                    submitReviewBtn.disabled = false;
                    submitReviewBtn.innerHTML = 'Submit Review';
                });
            });
        }

        // Close modal when clicking the close button
        closeBtn.addEventListener('click', function() {
            reviewModal.style.display = 'none';
            resetReviewForm();
        });

        // Close modal when clicking the cancel button
        cancelBtn.addEventListener('click', function() {
            reviewModal.style.display = 'none';
            resetReviewForm();
        });

        // Close modal when clicking outside the modal content
        window.addEventListener('click', function(event) {
            if (event.target === reviewModal) {
                reviewModal.style.display = 'none';
                resetReviewForm();
            }
        });
    });

    // Handle OTP verification - Moved inside DOMContentLoaded to ensure proper scoping

        // Helper function to reset the review form
        function resetReviewForm() {
            const form = document.getElementById('reviewForm');
            const ratingInput = document.getElementById('rating');
            
            if (form) form.reset();
            if (ratingInput) ratingInput.value = '';
            
            // Reset OTP state
            otpSent = false;
            otpVerified = false;
            
            // Reset OTP UI
            if (otpField) otpField.style.display = 'none';
            if (otpStatus) {
                otpStatus.textContent = '';
                otpStatus.className = 'otp-status';
            }
            
            // Reset buttons
            if (submitReviewBtn) submitReviewBtn.disabled = true;
            if (verifyOtpBtn) {
                verifyOtpBtn.disabled = false;
                verifyOtpBtn.innerHTML = 'Verify';
                verifyOtpBtn.className = '';
            }
            if (sendOtpBtn) sendOtpBtn.innerHTML = 'Send OTP';

            // Reset stars
            const stars = document.querySelectorAll('.rating-stars i');
            if (stars && stars.length > 0) {
                stars.forEach(star => {
                    if (star) {
                        star.classList.remove('fas');
                        star.classList.add('far');
                    }
                });
            }
}

// Helper function to show alerts
function showAlert(title, text, icon) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: 'OK'
    });
}
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
