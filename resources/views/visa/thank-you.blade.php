<x-main.layout>
    <style>
        .gradient-bg {
    background: linear-gradient(to right, #26ace2, #1e7ebc);
}
        </style>
    <div class="min-h-screen bg-gray-50">
        <!-- Confirmation Header -->
        <div class="gradient-bg py-16 text-center text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative">
                    <div class="absolute -top-2 -right-2 w-16 h-16 bg-primary/20 rounded-full animate-pulse"></div>
                    <div class="absolute -bottom-2 -left-2 w-16 h-16 bg-primary/20 rounded-full animate-pulse"></div>
                    <div class="relative z-10">
                        <div class="mx-auto h-24 w-24 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                            <svg class="h-16 w-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h1 class="mt-6 text-4xl font-extrabold tracking-tight">Application Submitted Successfully!</h1>
                        <p class="mt-4 max-w-2xl text-xl mx-auto text-white/90">
                            Your visa application for <span class="font-semibold">{{ $destination ?? 'your destination' }}</span> has been received.
                        </p>
                        <div class="mt-6 bg-white/10 inline-block px-6 py-3 rounded-lg shadow-lg backdrop-blur-sm border border-white/20">
                            <span class="font-mono text-lg tracking-wider">REF: {{ $applicationId ?? 'VS-'.strtoupper(uniqid()) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">What Happens Next?</h2>
                    
                    <div class="space-y-8">
                        <!-- Step 1 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-primary/10 rounded-full p-3">
                                <div class="h-6 w-6 text-primary font-bold text-center">1</div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Application Review</h3>
                                <p class="mt-1 text-gray-600">
                                    Our visa specialists are reviewing your application and documents. This typically takes 1-2 business days.
                                </p>
                                <p class="mt-2 text-sm text-primary font-medium">
                                    <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Estimated completion: {{ now()->addDays(2)->format('F j, Y') }}
                                </p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-primary/10 rounded-full p-3">
                                <div class="h-6 w-6 text-primary font-bold text-center">2</div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Status Updates</h3>
                                <p class="mt-1 text-gray-600">
                                    You'll receive email notifications at each important stage of your application process.
                                </p>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Sent to: {{ $email ?? 'your registered email' }}
                                </div>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-primary/10 rounded-full p-3">
                                <div class="h-6 w-6 text-primary font-bold text-center">3</div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Final Processing</h3>
                                <p class="mt-1 text-gray-600">
                                    Once approved, we'll guide you through any remaining steps and document submission.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Support Section -->
                <div class="bg-gray-50 px-8 py-8 border-t border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Need Assistance?</h2>
                    <div class="grid md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                Contact Our Support Team
                            </h3>
                            <p class="text-gray-600 mb-4">
                                Our visa experts are available to answer your questions about the application process.
                            </p>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="ml-3 text-gray-600">visa-support@yourcompany.com</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span class="ml-3 text-gray-600">+1 (800) 123-4567</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                                    </svg>
                                    <span class="ml-3 text-gray-600">Live Chat Support</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                Track Your Application
                            </h3>
                            <p class="text-gray-600 mb-6">
                                Use your reference number to check the status of your application anytime.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="#" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                    Track Application Status
                                </a>
                                <a href="#" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                    Download Receipt
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmation Footer -->
        <div class="bg-white border-t border-gray-200 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-gray-500">
                    Thank you for choosing our visa services. We appreciate your trust in us.
                </p>
                <div class="mt-6 flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-primary hover:text-primary/90">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Return to Homepage
                    </a>
                    <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-primary hover:text-primary/90">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        View Other Services
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .gradient-bg {
                background: linear-gradient(135deg, theme('colors.primary') 0%, theme('colors.secondary') 100%);
            }
            
            /* Animation for the success icon */
            @keyframes scaleIn {
                0% { transform: scale(0); opacity: 0; }
                80% { transform: scale(1.1); opacity: 1; }
                100% { transform: scale(1); opacity: 1; }
            }
            
            .animate-scale-in {
                animation: scaleIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Add animation class to the checkmark icon when page loads
            document.addEventListener('DOMContentLoaded', function() {
                const checkmark = document.querySelector('svg');
                if (checkmark) {
                    checkmark.classList.add('animate-scale-in');
                }
                
                // Confetti effect
                const createConfetti = () => {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti absolute';
                    confetti.style.left = Math.random() * 100 + 'vw';
                    confetti.style.top = -10 + 'px';
                    confetti.style.backgroundColor = `hsl(${Math.random() * 360}, 100%, 50%)`;
                    confetti.style.width = Math.random() * 10 + 5 + 'px';
                    confetti.style.height = Math.random() * 10 + 5 + 'px';
                    confetti.style.opacity = Math.random() + 0.5;
                    confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
                    
                    document.body.appendChild(confetti);
                    
                    let position = -10;
                    let rotation = 0;
                    const fall = () => {
                        position += 2;
                        rotation += 2;
                        confetti.style.top = position + 'px';
                        confetti.style.transform = `rotate(${rotation}deg)`;
                        
                        if (position < window.innerHeight) {
                            requestAnimationFrame(fall);
                        } else {
                            confetti.remove();
                        }
                    };
                    
                    requestAnimationFrame(fall);
                };
                
                // Create confetti for 2 seconds
                const confettiInterval = setInterval(createConfetti, 50);
                setTimeout(() => clearInterval(confettiInterval), 2000);
            });
        </script>
    @endpush
</x-main.layout>