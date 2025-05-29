<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VisaSection;

class VisaSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     
        $visa_application_fields = [
            "Personal Details" => [
                "Title", "Full Name", "Gender", "Date of Birth", "Place of Birth","Preview Name",
                "Country of Citizenship", "Nationality at Birth", "Marital Status",
                "Religion", "Visible Identification Marks", "Languages Spoken"
            ],
            "Contact Details" => [
                "Current Residential Address", "City", "State", "Postal Code",
                "Country of Residence", "Phone Number (Mobile)", "Phone Number (Landline)", "Email Address"
            ],
            "Passport Information" => [
                "Passport Type", "Passport Number", "Place of Issue", "Date of Issue",
                "Date of Expiry", "Issuing Authority", "Previous Passport Number"
            ],
            "Family Information" => [
                   "Father Section","Father’s Full Name", "Father Place of Birth", "Father Nationality",
                   "Father Previous Nationality","Father Country of birth","Father’s DOB","Father Employment",
                   //mother section
                   "Mother Section","Mother’s Full Name", "Mother Place of Birth", "Mother Nationality",
                   "Mother Previous Nationality","Mother Country of birth","Mother’s DOB","Mother Employment",
                   "Spouse Section","Spouse’s Full Name", "Spouse’s Nationality", "Spouse’s Place of Birth",
                   "Spouse’s Previous Nationality","Spouse’s DOB","Spouse’s Employment Status","Spouse’s Address",
                   "Children Section"
    // Additional Family Info
    // "Family Members Traveling",
    // "Emergency Contact Name",
    // "Emergency Contact Relationship",
    // "Emergency Contact Phone"
],

            "Employment Education Details" => [
                "Occupation", "Past Occupaton","Designation", "Employer Name", "Business Name", "School Name",
                "Employer Address", "Employer Phone Number", "Duration of Employment",
                "Duration of Study", "Monthly Income", "Educational Qualifications",
                "Employment History", "Education History"
            ],
            
            "Social Media Online Presence" => [
                "Facebook", "Instagram", "Twitter", "LinkedIn",
                "Other Social Media Accounts", "Personal Website", "Blog URLs"
            ],

            "Travel Information" => [
                "Purpose of Travel", "Countries to Visit", "Main Destination Country",
                "Number of Entries Requested", "Intended Arrival Date", "Intended Departure Date",
                "Duration of Stay", "Port of Entry", "Port of Exit", "Travel Itinerary",
                "Mode of Transport"
            ],

            "Visa History Background" => [
                "Previous Visas Held", "Visa Rejections", "Overstays",
                "Countries Visited (Last 5 Years)", "Previous UK Travel", "Previous USA Travel",
                "Previous Schengen Travel", "Previous China Travel", "Previous Russia Travel",
                "Previous India Travel", "Criminal History", "Denied Entry Anywhere",
                "Security Background Questions"
            ],
            "Medical Visa Specifics" => [
                "Patient Name", "Medical Diagnosis", "Hospital Name",
                "Hospital Address", "Doctor’s Letter", "Medical Report",
                "Treatment Duration", "Treatment Cost", "Attendant Name", "Attendant Details"
            ],
            "Student Visa Specifics" => [
                "Course Name", "Institution Name", "Institution Address", "Institution Phone",
                "Letter of Admission", "SEVIS ID", "Tuition Fee Estimate",
                "Living Expenses Estimate", "Financial Sponsor Name", "Sponsor Details"
            ],            
          
            "Accommodation Details" => [
                "Accommodation Type", "Hotel Name", "Host Name", "Full Address of Stay",
                "Contact Number of Hotel", "Contact Number of Host", "Relationship to Host",
                
            ],
            "Host Sponsor Inviter Details" => [
                "Host Full Name", "Company Name", "Relationship to Applicant",
                "Host Address", "Host Phone Number", "Host Email",
                "Company Registration", "Invitation Letter"
            ],
            "Financial Support Details" => [
                "Funding Source", "Sponsor Name", "Host Name", "Financial Documents",
                "Monthly Income", "Means of Financial Support", "Travel Insurance Company",
                "Travel Insurance Policy Number", "Insurance Validity"
            ]
          
        ];

        foreach ($visa_application_fields as $section => $fields) {
            $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '_', $section));

            VisaSection::create([
                'section_name' => $section,
                'slug' => trim($slug, '_'),
                'fields' => $fields,
            ]);
        }
    }
    
}
