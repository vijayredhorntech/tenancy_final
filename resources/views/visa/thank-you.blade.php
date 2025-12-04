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
                            <svg class="h-16 w-16 text-white animate-scale-in" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>

                        <h1 class="mt-6 text-4xl font-extrabold tracking-tight">
                            Application Submitted Successfully!
                        </h1>

                        <p class="mt-4 max-w-2xl text-xl mx-auto text-white/90">
                            Your visa application for <span class="font-semibold">{{ $destination ?? 'your destination' }}</span> has been received.
                        </p>

                        <div class="mt-6 bg-white/10 inline-block px-6 py-3 rounded-lg shadow-lg backdrop-blur-sm border border-white/20">
                            <span class="font-mono text-lg tracking-wider">REF: {{ $applicationId }}</span>
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
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-primary/10 rounded-full p-3">
                                <div class="h-6 w-6 text-primary font-bold text-center">1</div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Application Review</h3>
                                <p class="mt-1 text-gray-600">
                                    Our visa specialists are reviewing your application and documents.
                                </p>
                                <p class="mt-2 text-sm text-primary font-medium">
                                    Estimated completion: {{ now()->addDays(2)->format('F j, Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-primary/10 rounded-full p-3">
                                <div class="h-6 w-6 text-primary font-bold text-center">2</div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Status Updates</h3>
                                <p class="mt-1 text-gray-600">
                                    You'll receive updates via email for every important step.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-primary/10 rounded-full p-3">
                                <div class="h-6 w-6 text-primary font-bold text-center">3</div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Final Processing</h3>
                                <p class="mt-1 text-gray-600">
                                    Once approved, remaining steps will be shared instantly!
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Applicant Details Section -->
                <div class="bg-white p-8 border-t border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Applicant Details</h2>

                    <div class="grid md:grid-cols-2 gap-6 text-gray-700">

                 

                        <div class="space-y-3">
                            <p><strong>Name:</strong> {{ $data->full_name }}</p>
                            <p><strong>Email:</strong> {{ $data->email }}</p>
                            <p><strong>Phone:</strong> {{ $data->phone_number }}</p>
                            <p><strong>Nationality:</strong> {{ $data->nationality }}</p>
                        </div>

                        <div class="space-y-3">
                            <p><strong>Visa Type:</strong>
                                    {{ optional($data->visa)->name ?? 'N/A' }}
                                </p>

                                <p><strong>Destination:</strong>
                                    @if(optional($data->combination)->origincountry && optional($data->combination)->destinationcountry)
                                        {{ $data->combination->origincountry->countryName }}
                                        <span class="text-gray-500">→</span>
                                        {{ $data->combination->destinationcountry->countryName }}
                                    @else
                                        N/A
                                    @endif
                                </p>

                                <p><strong>Date of Entry:</strong>
                                    {{ $data->date_of_entry ? \Carbon\Carbon::parse($data->date_of_entry)->format('F j, Y') : 'N/A' }}
                                </p>

                                <p><strong>Status:</strong>
                                    <span class="text-primary font-semibold">
                                        {{ ucfirst($data->status ?? 'pending') }}
                                    </span>
                                </p>

                        </div>

                    </div>

                    <div class="mt-6 flex gap-4">
                     
                    </div>
                </div>
                <!-- End Applicant Details Section -->

                
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .animate-scale-in {
                animation: scaleIn 0.5s ease-out;
            }
            @keyframes scaleIn {
                from { transform: scale(0); opacity: 0; }
                to { transform: scale(1); opacity: 1; }
            }
        </style>
    @endpush

</x-main.layout>
