<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'One Nation') }} - Document Signing</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
   
</head>
<body>
    <!-- Header Area -->
    <div class="w-full relative">
    <img class="absolute -top-20 left-0 w-full opacity-20" style="z-index: -1" src="{{asset('assets/images/bgImage.png')}}" alt="">

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Document Header --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-primary to-secondary p-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-white">Document Signing Portal</h1>
                        <div class="flex items-center mt-2 text-white/90">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm">Document ID: DOC-{{ strtoupper(substr($signature->document->name, 0, 3)) }}-{{ $signature->id }}</span>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white border border-white/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Deadline: {{ now()->addDays(3)->format('d M Y') }}
                        </span>
                    </div>
                </div>
            </div>

        </div>

        {{-- Main Content --}}
        <div class="flex flex-col lg:flex-row gap-6">
            {{-- Left Column --}}
            <div class="lg:w-2/3">
                @if(session('success'))
                    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                        <div class="bg-green-50 border-l-4 border-green-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700">
                                        {{ session('success') }} Your document has been successfully signed and is being processed.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($signature->status === 'signed')
                    {{-- Completion View --}}
                    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6 text-center py-8">
                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Document Successfully Signed!</h3>
                        <p class="text-gray-600 mb-6">Thank you for completing the signing process. Your document is now being processed.</p>
                        <div class="flex justify-center gap-4">
                            <a href="{{ url('/members_profile') }}" class="px-4 py-2 bg-primary text-white rounded-lg flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Return to Profile
                            </a>
                            <a href="#" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download Copy
                            </a>
                        </div>
                    </div>
                @else
                    {{-- Member Information --}}
                    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Signer Information
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-12 w-12 rounded-full bg-primary flex items-center justify-center text-white font-bold text-xl mr-4">
                                    {{ strtoupper(substr($signature->agnecy->name ?? 'U', 0, 1)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="text-lg font-medium text-gray-900">{{ $signature->agnecy->name ?? 'Unknown User' }}</p>
                                            <p class="text-sm text-gray-500">{{ $signature->assignedRole->name ?? '' }}</p>
                                        </div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                                            </svg>
                                            Signer
                                        </span>
                                    </div>
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="flex items-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            <div>
                                                <p class="text-sm text-gray-500">Email</p>
                                                <p class="text-sm font-medium text-gray-900">{{ $signature->agnecy->email ?? 'No email available' }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <div>
                                                <p class="text-sm text-gray-500">Member Since</p>
                                                <p class="text-sm font-medium text-gray-900">{{ $signature->created_at ? $signature->created_at->format('d M Y') : 'Unknown' }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                            </svg>
                                            <div>
                                                <p class="text-sm text-gray-500">Member ID</p>
                                                <p class="text-sm font-medium text-gray-900">{{ $signature->member_id ?? 'Not assigned' }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <div>
                                                <p class="text-sm text-gray-500">Signing Deadline</p>
                                                <p class="text-sm font-medium text-gray-900">{{ now()->addDays(3)->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Document Information --}}
                    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Document Information
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Document Title</p>
                                    <p class="text-base font-medium text-gray-900">{{ $signature->document->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Document Type</p>
                                    <p class="text-base font-medium text-gray-900">Agreement</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Date Issued</p>
                                    <p class="text-base font-medium text-gray-900">{{ $signature->created_at->format('d M Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Reference Number</p>
                                    <p class="text-base font-medium text-gray-900">DOC-{{ strtoupper(substr($signature->document->name, 0, 3)) }}-{{ $signature->id }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Document Preview --}}
                    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                Document Preview
                            </h3>
                        </div>
                        <div class="p-6">
                            <iframe src="{{-- {{ route('documents.serve', ['path' => $document->path]) }} --}}" class="w-full h-96 border rounded-lg"></iframe>
                            <div class="mt-4 bg-blue-50 rounded-lg p-4">
                                <div class="flex items-start">
                                    <input type="checkbox" id="show-signature" class="mt-1 mr-3 h-5 w-5 text-primary rounded" required>
                                    <label for="show-signature" class="text-sm text-gray-700">
                                        I have reviewed and agree to the terms of this document
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($signature->status === 'pending')
                        {{-- Signature Section --}}
                        <div class="bg-white rounded-xl shadow-md overflow-hidden">
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    Digital Signature
                                </h3>
                            </div>
                            <div class="p-6">
                                <p class="text-gray-600 mb-6">Please sign in the box below using your mouse or touchscreen</p>
                                
                                <form id="signatureForm" action="" method="POST">
                                    @csrf
                                    <input type="hidden" name="signature_token" value="{{ $signature->signing_token }}">
                                    <input type="hidden" name="signature_data" id="signature_data">
                                    
                                    <div id="signature-pad" class="mb-6 border border-gray-300 rounded-lg">
                                        <canvas class="w-full h-48"></canvas>
                                    </div>
                                    
                                    <div class="flex flex-wrap gap-3">
                                        <button type="button" id="clear-signature" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg flex items-center hover:bg-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Clear Signature
                                        </button>
                                        <button type="submit" id="submit-signature" class="flex-1 px-4 py-2 bg-primary text-white rounded-lg flex items-center justify-center hover:bg-primary-dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                            Sign Document
                                        </button>
                                    </div>

                                    <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4">
                                        <div class="flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                            <div>
                                                <p class="font-medium text-blue-800">Your signature is secure and legally binding</p>
                                                <p class="text-sm text-blue-600 mt-1">By signing, you acknowledge that your digital signature is the legal equivalent of your handwritten signature.</p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            {{-- Right Column --}}
            <div class="lg:w-1/3">
                {{-- Document Status --}}
                <div class="bg-white rounded-xl shadow-md overflow-hidden sticky top-6">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Document Status
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Current Status</p>
                                <div class="flex items-center">
                                    @if($signature->status === 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Pending Signature
                                        </span>
                                    @elseif($signature->status === 'signed')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Signed
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Last Updated</p>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $signature->updated_at ? $signature->updated_at->format('d M Y, h:i A') : 'N/A' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Signing Deadline</p>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ now()->addDays(3)->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <div>
                                    <p class="font-medium text-yellow-800">Important Notice</p>
                                    <p class="text-sm text-yellow-600 mt-1">Please sign this document before the deadline to avoid any processing delays.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.querySelector('#signature-pad canvas');
            const signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)',
                penColor: 'rgb(0, 0, 0)',
                minWidth: 1,
                maxWidth: 3,
                throttle: 16
            });

            // Handle window resize
            function resizeCanvas() {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext('2d').scale(ratio, ratio);
                
                // Redraw existing signature (if any) after resize
                const data = signaturePad.toData();
                if (data) {
                    signaturePad.fromData(data);
                }
            }
            
            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();

            // Clear signature button
            document.getElementById('clear-signature').addEventListener('click', function() {
                signaturePad.clear();
            });

            // Form submission
            document.getElementById('signatureForm').addEventListener('submit', function(e) {
                e.preventDefault();

                if (!document.getElementById('show-signature').checked) {
                    alert('Please confirm that you have reviewed and agree to the document terms.');
                    return;
                }

                if (signaturePad.isEmpty()) {
                    alert('Please provide your signature before submitting.');
                    return;
                }

                const submitButton = document.getElementById('submit-signature');
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing...';

                // Get the signature data
                document.getElementById('signature_data').value = signaturePad.toDataURL();

                // Submit form
                this.submit();
            });

            // Add touch support for mobile devices
            if ('ontouchstart' in window) {
                canvas.addEventListener('touchstart', preventScroll, { passive: false });
                canvas.addEventListener('touchend', preventScroll, { passive: false });
            }

            function preventScroll(e) {
                if (e.target === canvas) {
                    e.preventDefault();
                }
            }
        });
    </script>
</body>
</html>