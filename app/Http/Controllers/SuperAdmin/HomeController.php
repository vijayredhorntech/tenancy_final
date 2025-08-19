<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgencyRequest;
use App\Models\Agency;
use App\Models\ContactRequest;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    //
    public function index()
{
    // dd("heelo");
    $siteData = [
    // Hero Slider Images
    'hero_slides' => [
        [
            'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2073&q=80',
            'title' => 'Discover Your Next Adventure',
            'description' => 'CloudTravel brings you the best travel experiences with seamless booking and expert guidance.',
            'buttons' => [
                ['text' => 'Explore Services', 'link' => '#services'],
                ['text' => 'Contact Us', 'link' => '#contact']
            ]
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1506929562872-bb421503ef21?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1686&q=80',
            'title' => 'Luxury Stays Worldwide',
            'description' => 'Find the perfect accommodation for your dream vacation with our curated hotel selections.',
            'buttons' => [
                ['text' => 'View Hotels', 'link' => '#services'],
                ['text' => 'Get Advice', 'link' => '#contact']
            ]
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
            'title' => 'Partner With CloudTravel',
            'description' => 'Join our network of travel agencies and access exclusive rates and benefits.',
            'buttons' => [
                ['text' => 'Agency Registration', 'link' => '#agency'],
                ['text' => 'Become a Partner', 'link' => '#contact']
            ]
        ]
    ],

    // Services Data (now used for both customer services and agency services)
    'services' => [
        [
            'icon' => 'fas fa-plane',
            'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80',
            'title' => 'Flight Bookings',
            'description' => 'Book domestic and international flights with competitive prices and flexible options.',
            'features' => [
                'Best price guarantee',
                '24/7 flight changes',
                'Multi-city itineraries'
            ]
        ],
        [
            'icon' => 'fas fa-hotel',
            'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80',
            'title' => 'Hotel Reservations',
            'description' => 'From budget stays to luxury resorts, find the perfect accommodation for your travel needs.',
            'features' => [
                'Verified guest reviews',
                'Exclusive member rates',
                'Free cancellation options'
            ]
        ],
        [
            'icon' => 'fas fa-passport',
            'image' => 'https://images.unsplash.com/photo-1527631746610-bca00a040d60?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80',
            'title' => 'Visa Assistance',
            'description' => 'Expert guidance and processing for all your visa requirements across countries.',
            'features' => [
                'Document checklist',
                'Application review',
                'Priority processing'
            ]
        ],
        [
            'icon' => 'fas fa-taxi',
            'image' => 'https://images.unsplash.com/photo-1507035895480-2b3156c31fc8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80',
            'title' => 'Cab Services',
            'description' => 'Reliable airport transfers and local transportation in over 100 cities worldwide.',
            'features' => [
                '24/7 availability',
                'Professional drivers',
                'Fixed price quotes'
            ]
        ],
        [
            'icon' => 'fas fa-umbrella-beach',
            'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80',
            'title' => 'Tour Packages',
            'description' => 'Curated vacation packages with flights, hotels, and activities included.',
            'features' => [
                'Customizable itineraries',
                'Local expert guides',
                'All-inclusive options'
            ]
        ]
    ],

    // Business Types
    'business_types' => [
        'Independent Travel Agent',
        'Travel Agency',
        'Corporate Travel Department',
        'Tour Operator',
        'Destination Management Company',
        'Online Travel Agency'
    ],

    // Reviews Data
    'reviews' => [
        [
            'name' => 'Sarah Johnson',
            'role' => 'Frequent Traveler',
            'rating' => 5,
            'content' => 'CloudTravel made booking my round-the-world trip effortless. Their flight and hotel packages saved me both time and money, and their customer service was available 24/7 when I had questions.'
        ],
        [
            'name' => 'Michael Chen',
            'role' => 'Business Traveler',
            'rating' => 5,
            'content' => 'The visa assistance service was exceptional. They handled all the paperwork for my business visas and kept me informed at every step.'
        ],
        [
            'name' => 'Sunrise Travels',
            'role' => 'Partner Agency',
            'rating' => 5,
            'content' => 'As a partner agency, we\'ve seen a 30% increase in bookings since joining CloudTravel\'s network. The support team is always responsive.'
        ],
        [
            'name' => 'Emma Rodriguez',
            'role' => 'Family Vacationer',
            'rating' => 4,
            'content' => 'Planning our family reunion trip was so easy with CloudTravel. They found accommodations that worked for our large group and even helped arrange special activities for the kids.'
        ]
    ],

    // Contact Information
    'contact_info' => [
        'headquarters' => [
            'address' => '62 King Street  Town Centre  Southall UB2 4DB',
            'phone' => '020 3500 0000',
            'email' => 'info@cloudtravel.com'
        ],
        'regional_office' => [
            'address' => '62 King Street  Town Centre  Southall UB2 4DB',
            'phone' => '020 3500 0000',
            'email' => 'ny-office@cloudtravel.com'
        ],
        'business_hours' => [
            'Monday - Friday' => '9:00 AM - 6:00 PM',
            'Saturday' => '10:00 AM - 4:00 PM',
            'Sunday' => 'Closed'
        ]
    ]
];
    return view('superadmin.home', compact('siteData'));
}


/***Store agency Data **** */

public function submitAgencyRequest(Request $request)
{
    $validator = Validator::make($request->all(), [
        'agency_name'   => 'required|string|max:255',
        'first_name'    => 'required|string|max:255',
        'last_name'     => 'required|string|max:255',
        'email'         => 'required|email|unique:agency_requests,email',
        'phone'         => 'required|string|max:20',
        'business_type' => 'required|string|max:255',
        'services'      => 'required|array|min:1',
        'experience'    => 'required|string|max:50',
    ]);

    if ($validator->fails()) {
        return redirect()->to(url()->previous() . '#agency')
                         ->withErrors($validator)
                         ->withInput();
    }

    AgencyRequest::create([
        'agency_name'   => $request->agency_name,
        'first_name'    => $request->first_name,
        'last_name'     => $request->last_name,
        'email'         => $request->email,
        'phone'         => $request->phone,
        'business_type' => $request->business_type,
        'services'      =>  $request->services,
        'experience'    => $request->experience,
    ]);

    return redirect()->back()
                     ->with('success', 'Your agency request has been submitted for approval.');
}


public function submitContactRequest(Request $request)
{
    // Validation
    $validator = Validator::make($request->all(), [
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // If validation fails, redirect to contact section with errors
    if ($validator->fails()) {
        return redirect()->to(url()->previous() . '#contact')
                         ->withErrors($validator)
                         ->withInput();
    }

    // Save data
    ContactRequest::create([
        'name'    => $request->name,
        'email'   => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
    ]);

    // Redirect back with success message
    return redirect()->back()
                     ->with('success', 'Your message has been sent successfully!');
}


}
