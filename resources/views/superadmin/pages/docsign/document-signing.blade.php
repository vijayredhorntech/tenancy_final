<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'One Nation') }} - Document Signing</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            color: #2c3e50;
        }
        .header-area {
            background: linear-gradient(135deg, #b30d00 0%, #6a0606 100%);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header-logo {
            max-width: 150px;
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .document-container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin: 2rem auto;
            max-width: 1200px;
        }
        .document-header {
            background: linear-gradient(135deg, #b30d00 0%, #6a0606 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 8px 8px 0 0;
            margin: -2rem -2rem 2rem -2rem;
        }
        .document-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: #ffffff;
        }
        #signature-pad {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            background: #fff;
            padding: 10px;
            margin-bottom: 1rem;
        }
        #signature-pad canvas {
            width: 100%;
            height: 200px;
            border: none;
            background-color: #fff;
        }
        .btn-primary {
            background: #b30d00;
            border-color: #b30d00;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: #ffffff;
        }
        .btn-primary:hover {
            background: #8a0a00;
            border-color: #8a0a00;
            transform: translateY(-1px);
            color: #ffffff;
        }
        .btn-secondary {
            background: #6c757d;
            border: none;
            padding: 8px 20px;
            color: #ffffff;
        }
        .btn-secondary:hover {
            background: #5a6268;
            color: #ffffff;
        }
        .success-message {
            background-color: #d4edda;
            border-left: 4px solid #28a745;
            color: #155724;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .success-message h4 {
            color: #155724;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .success-message p {
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }
        .success-message ul {
            list-style-type: none;
            padding-left: 0;
            margin-bottom: 1rem;
        }
        .success-message ul li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        .success-message ul li:before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #28a745;
            font-weight: bold;
        }
        .success-message .btn-primary {
            background: #28a745;
            border-color: #28a745;
        }
        .success-message .btn-primary:hover {
            background: #218838;
            border-color: #218838;
        }
        .info-card {
            background: #ffffff;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .info-card h3 {
            color: #2c3e50;
            font-size: 1.25rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        .info-label {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        .info-value {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }
        .document-preview {
            background: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .document-preview h3 {
            color: #2c3e50;
            font-size: 1.1rem;
            margin: 0;
            padding: 1rem 1.5rem;
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        .document-preview iframe {
            width: 100%;
            height: 600px;
            border: none;
        }
        .signature-section {
            background: #ffffff;
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 2rem;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .signature-section h3 {
            color: #2c3e50;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
        }
        .signature-disclaimer {
            font-size: 0.95rem;
            color: #2c3e50;
            margin-top: 1.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 6px;
            border: 1px solid #dee2e6;
        }
        .member-info-card {
            background: #ffffff;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #dee2e6;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .member-info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: #b30d00;
        }
        .member-avatar {
            width: 64px;
            height: 64px;
            background: #b30d00;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .member-name {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        .member-details {
            color: #2c3e50;
            font-size: 0.95rem;
        }
        .member-detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
            color: #2c3e50;
        }
        .member-detail-item i {
            width: 20px;
            margin-right: 12px;
            color: #b30d00;
        }
        
        .gradient-bg {
            background: linear-gradient(to right, #d53369, #daae51);
        }

        .container-box input[type="checkbox"]:checked+.checkmark {
            background-color: #007bff;
            /* Change to desired color */
            border-color: #007bff;
            /* Change to desired color */
        }

    </style>
</head>
<body>
    <!-- Header Area -->
    <header class="header-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <a href="">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="One Nation" class="header-logo">
                    </a>
                </div>
                <div class="col-md-8 text-end">
                    <h1 class="text-white mb-0">Document Signing Portal</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="container py-5">
        <div class="document-container">
            <div class="document-header">
                <h2><i class="fas fa-file-signature me-2"></i> Document Signing</h2>
            </div>

            @if(session('success'))
                <div class="success-message">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($signature->status === 'signed')
                <div class="success-message mb-4">
                    <i class="fas fa-check-circle me-2"></i>
                    <h4 class="mb-3">Document Successfully Signed!</h4>
                    <p class="mb-2">Your document has been signed and is being processed. Here's what happens next:</p>
                    <ul class="mb-3">
                        <li>Our system is adding your digital signature to the document</li>
                        <li>A signed copy will be stored securely</li>
                        <li>You will receive an email notification once processing is complete</li>
                        <li>You can view the signed document from your profile once processing is done</li>
                    </ul>
                    <div class="mt-4">
                        <a href="{{ url('/members_profile') }}" class="btn btn-primary">
                            <i class="fas fa-user me-2"></i>Return to My Profile
                        </a>
                    </div>
                </div>
            @else
                <!-- Member Information Card -->
                <div class="member-info-card">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="member-avatar">
                                {{ strtoupper(substr($signature->agnecy->name ?? 'U', 0, 1)) }}
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="member-name">{{ $signature->agnecy->name ?? 'Unknown User' }}</div>
                            <div class="member-details">
                                <div class="member-detail-item">
                                    <i class="fas fa-envelope"></i>
                                    {{ $signature->agnecy->email ?? 'No email available' }}
                                </div>
                                <div class="member-detail-item">
                                    <i class="fas fa-id-card"></i>
                                    Member ID: {{ $signature->member_id ?? 'Not assigned' }}
                                </div>
                                @if($signature->assignedRole)
                                <div class="member-detail-item">
                                    <i class="fas fa-user-tag"></i>
                                    Role: {{ $signature->assignedRole->name }}
                                </div>
                                @endif
                                <div class="member-detail-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    Member Since: {{ $signature->created_at ? $signature->created_at->format('d M Y') : 'Unknown' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <h3><i class="fas fa-info-circle me-2"></i>Document Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Title</div>
                            <div class="info-value">{{ $document->title }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Role</div>
                            <div class="info-value">{{ optional($document->role)->name ?? 'Not assigned' }}</div>
                        </div>
                        <div class="col-12">
                            <div class="info-label">Description</div>
                            <div class="info-value">{{ $document->description }}</div>
                        </div>
                    </div>
                </div>

                <div class="document-preview">
                    <h3>Document Preview </h3>
                    <iframe src="{{ route('documents.serve', ['path' => $document->path]) }}" style="width: 100%; height: 600px; border: none;"></iframe>
                    <div class="mt-3">
                    <div class="form-group">
                                            <div class="check-box-wrapper">
                                                <div class="check-box">
                                                    <label class="container-box" style="color: black; font-weight: 600;">
                                                    I agree to sign this document
                                                        <input type="checkbox" id="show-signature"  style="color: black; font-weight: 600;">
                                                        <span class="checkmark" style="color: black; font-weight: 600; border: 1px solid darkgray; border-radius: 5px;"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                        <!-- <input type="checkbox" id="" class="form-check-input">
                        <label for="show-signature" class="form-check-label">I agree to sign this document</label> -->
                    </div>
                 
                </div>

                @if($signature->status === 'pending')
                    <div class="signature-section" >
                        <h3>Digital Signature</h3>
                        <form id="signatureForm" action="{{ route('core-member.document.sign.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="signature_token" value="{{ $signature->signing_token }}">
                            <input type="hidden" name="signature_data" id="signature_data">
                            
                            <div id="signature-pad" class="mb-3">
                                <canvas></canvas>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-secondary" id="clear-signature">
                                    <i class="fas fa-eraser me-2"></i>Clear
                                </button>
                                <button type="submit" class="btn btn-primary" id="submit-signature">
                                    <i class="fas fa-signature me-2"></i>Sign Document
                                </button>
                            </div>

                            <div class="signature-disclaimer mt-4">
                                <p class="text-muted">
                                    <i class="fas fa-info-circle me-2"></i>
                                    By signing this document, you acknowledge that your digital signature is legally binding 
                                    and equivalent to a handwritten signature. This action cannot be undone.
                                </p>
                            </div>
                        </form>
                    </div>
                @endif
            @endif
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>

     
                
            


        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.querySelector('#signature-pad canvas');
            const signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)',
                penColor: 'rgb(0, 0, 0)'
            });

            // Handle window resize
            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();

            function resizeCanvas() {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext('2d').scale(ratio, ratio);
                signaturePad.clear();
            }

            // Clear signature button
            document.querySelector('#clear-signature').addEventListener('click', function() {
                signaturePad.clear();
            });

            // Form submission
            document.querySelector('#signatureForm').addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent default form submission
  
                if (!document.getElementById('show-signature').checked) {
                        // Show the alert if checkbox is not checked
                        alert('Please Agree to Terms and Conditions');
                        return;
                    }

                if (signaturePad.isEmpty()) {
                    alert('Please provide your signature before submitting.');
                    return;
                }

                // Disable submit button to prevent double submission
                const submitButton = document.querySelector('#submit-signature');
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';

                // Get the signature data
                const signatureData = signaturePad.toDataURL();
                document.querySelector('#signature_data').value = signatureData;

                // Get form data
                const formData = new FormData(this);

                // Submit using fetch API
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'same-origin'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message and reload page
                        window.location.reload();
                    } else {
                        // Show error message
                        alert(data.message || 'An error occurred while processing your signature.');
                        submitButton.disabled = false;
                        submitButton.innerHTML = '<i class="fas fa-signature me-2"></i>Sign Document';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while processing your signature. Please try again.');
                    submitButton.disabled = false;
                    submitButton.innerHTML = '<i class="fas fa-signature me-2"></i>Sign Document';
                });
            });
        });
    </script>
</body>
</html> 