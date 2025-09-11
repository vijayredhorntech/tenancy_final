<?php

namespace App\Repositories;

use App\Models\SignedDocument;
use App\Repositories\Interfaces\DocumentSignRepositoryInterface;
use App\Services\AgencyService;
use App\Models\VisaBooking;
use Illuminate\Support\Facades\Auth;
use App\Models\ClientApplicationDocument;
use App\Repositories\Interfaces\VisaRepositoryInterface;
use App\Models\DownloadCenter;
use Illuminate\Support\Facades\Mail;
use App\Mail\DocumentUploadRequestMail;
use App\Models\DocSignAudit;
use App\Models\DocSignDocument;
use App\Models\DocSignProcess;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Mail\DocSignRequestMail;
use Illuminate\Support\Str;
use App\Models\Deduction;





class DocumentSignRepository implements DocumentSignRepositoryInterface
{
    protected $agencyService;
    protected $visaRepository;


    public function __construct(VisaRepositoryInterface $visaRepository,AgencyService $agencyService)
    {
            $this->agencyService = $agencyService;
            $this->visaRepository = $visaRepository;


    }
    public function getAllDocuments()
    {  
        return DocSignDocument::with('sign','agency')->get();  // Retrieve all documents
    }

    public function signDocumentStore($data){
  
        $user = Auth::user();  
        $roleNames = $user->getRoleNames();
        $primaryRole = $roleNames->first(); 

        $termsData = [];
        foreach ($data['termstype'] ?? [] as $typeId) {
           $key = 'terms_' . $typeId;
           $termsData[$key] = $data[$key] ?? [];   // default to empty array if none checked
       }
      
       // Handle file uploads and collect stored paths
       $folder = 'documents/docsigned';           //  no trailing /

       $paths = collect($data->file('document_file', []))
           ->map(fn ($file) => $file->store($folder, 'public'))   // → storage/app/public/documents/docsigned/…
           ->toArray();
       
      
       $doc = DocSignDocument::create([
           'name'             => $data['name'],
           'document_type'    => $data['document_type'],    // array
           'document_name'    => $data['document_name'],    // array
           'termandcondition' => $data['termandcondition'], // array
           'termstype'        => $data['termstype'],        // array
           'terms_data'       => $termsData,
           'document_file'    => $paths,          // array of file paths
           'user_type'        =>$primaryRole, // or however you tag users
           'user_id'          => $user->id,
       ]);
        return $doc;
}

/* -----------------------------------------------------------------
   PUBLIC METHOD – call this from your controller or service layer
   ----------------------------------------------------------------- */
public function sendEmailForSign(Request $request, int $documentId): void
{
 
    DB::transaction(function () use ($request, $documentId) {



        /* 1. Fetch document (+ agency relation) */
        $document = DocSignDocument::with('agency')->findOrFail($documentId);

      $booking=Deduction::with([
        'service_name',
          'agency',
          'visaBooking.visa',
          'visaBooking.origin',
          'visaBooking.destination',
          'visaBooking.visasubtype',])->where('id', $document->related_id)->first();
       
          $data=$this->agencyService->getClientinfoById($booking);
       
        

        /* 2. Create a DocSignProcess row */
        $process = DocSignProcess::updateOrCreate(
            [
                'user_id'     => $document->user_id,
                'document_id' => $document->id,
            ],
            [
                'signing_token'        => Str::uuid(),          // always refresh
                'status'               => 'pending',
                'message'              => $request->input('message', ''),
                'signed_at'            => null,
                'expires_at'           => now()->addDays(7),
                'signature_hash'       => null,
                'signed_document_path' => null,
                'ip_address'           => $request->ip(),
                'user_agent'           => $request->userAgent(),
            ]
        );

        $process->recordEvent('email_sent', 'Signing request email queued', $request);

       /* 4. Send email (queued) */
        // Mail::to($document->agency->email)
        //     ->queue(new DocSignRequestMail($process));
    });
}

    public function getDocumentById($id)
    {
        return SignedDocument::findOrFail($id);  // Find a document by its ID
    }

    public function createDocument(array $data)
    {
        // dd($data);
        $agency = $this->agencyService->getAgencyData();
        $agencyId = $agency->id;
        $agencyId = $agency->id;
        $data['agency_id'] = $agencyId;
        return SignedDocument::create($data);  // Create a new document record
    }

    public function createDocumentAgency($id, $type)
{

     
    $user = $this->agencyService->getCurrentLoginUser();
  
    if($type=="Visa"){
    
       $data=$this->getVisaInformation($id);
    //    dd($data->agency_id);
    //    dd($data);


    }
    // 1. Fetch the booking with all needed relations

    //  dd($data);

    // 3. Build the array of columns you want to insert
    $docData = [
        'name'             => $data->visa->name,
        'title'            => $data->visa->name,
        'document_type'    => "Invoice",
        'document_name'    => "Visa",
        'termandcondition' => [],
        'termstype'        => [],
        'terms_data'       => [],
        'document_file'    => [],
        'client_id'        => $data->client->id,
        'agency_id'        => $data->agency_id ?? null,
        'related_id'       => $data->visaInvoiceStatus->id ?? null,
        'servicerelatedtableid'       => $data->id,
        'user_id'          => $user->id,
        'type_of_document' => 'Auto',
        'user_type'        => 'Agency',
    ];

    // dd($docData);
    // 4. Pass the ARRAY to create(), not the model
    $document = DocSignDocument::create($docData);
    $fakeRequest = request();
    $saveDocument=$this->saveDocumentForSign($document,$fakeRequest);
    // dd($saveDocument);

    return $document;
}

protected function getVisaInformation($id){
   return  $this->visaRepository->getBookingBySingleId($id);

}


protected function saveDocumentForSign($document, $request)
{
    $process = DocSignProcess::updateOrCreate(
        [
            'user_id'     => $document->user_id,
            'document_id' => $document->id,
        ],
        [
            'signing_token'        => Str::uuid(), // always generate a fresh token
            'status'               => 'pending',
            'message'              => $request->input('message', ''),
            'signed_at'            => null,
            'expires_at'           => now()->addDays(7),
            'signature_hash'       => null,
            'signed_document_path' => null,
            'ip_address'           => $request->ip(),
            'user_agent'           => $request->userAgent(),
        ]
    );

    // Log or record the email_sent event
    $process->recordEvent('email_sent', 'Signing request email queued', $request);

    // Optionally send email (you can uncomment if ready to use)
    // Mail::to($document->agency->email)->queue(new DocSignRequestMail($process));

    // ✅ FIX: You had an undefined $id — retrieve ID from the document or related field
    if (isset($document->related_id)) {

        return $this->visaRepository->getBookingBySingleId($document->related_id);
    }

    return null;
}

 


    public function updateDocument($id, array $data)
    {
        $document = SignedDocument::findOrFail($id);
        $document->update($data);  // Update the document record
        return $document;
    }

    public function deleteDocument($id)
    {
        $document = SignedDocument::findOrFail($id);
        $document->delete();  // Soft delete the document record
    }

    public function getSignedDocumentsByAgency($agencyId)
    {
        return SignedDocument::where('agency_id', $agencyId)->get();  // Get documents by agency
    }

      /****Add Document **** */
      public function storeDocument($request)
      {
          $bookingApplication = VisaBooking::with('agency')->where('id', $request->bookingid)->first();
          $bookingApplication->document_status="Pending";
          $bookingApplication->save();
        
        //   dd($bookingApplication);
 
          if (!$bookingApplication) {
              return false;
          }

          // Assuming $request->documents is an array of document names
          foreach ($request->documents as $docName) {   
              ClientApplicationDocument::create([
                  'application_id'     => $request->bookingid,
                  'client_id'          => $bookingApplication->client_id,       
                  'application_number' => $bookingApplication->application_number,
                  'document_name'      => $docName,
                  'agency_id'          => $bookingApplication->agency_id,
                  'user_id'            => Auth::id(), // shortcut for Auth::user()->id
              ]);
          }
          $save=$this->agencyService->saveLog($bookingApplication,'Super Admin','Request Document', Auth::id());

          Mail::to($bookingApplication->agency->email)
          ->send(new DocumentUploadRequestMail(
              $bookingApplication->agency->name,
              $bookingApplication->application_number
          ));
          return true;
      }

    public function getClientApplication($id){

        return ClientApplicationDocument::where('application_id', $id)->get();
    }

    public function getUploadeDocumentById($id){

        return ClientApplicationDocument::where('id', $id)->first();
    }

    /****Update Document Status *** */
    public function updateDocumentStatus($data)
{
    // Step 1: Find and update the specific document
    $document = ClientApplicationDocument::findOrFail($data['documentid']);
    $document->document_status = $data['document_status']; 
    $document->save();
    $bookings=VisaBooking::with('agency')
    ->where('id', $document->application_id)
    ->first();
    // Step 2: Check if any other documents are still pending for the same application
    $pendingDoc = ClientApplicationDocument::where('application_id', $document->application_id)
                    ->where('document_status', '0')
                    ->exists();

    // Step 3: If all documents are verified, update the booking's document status
    if (!$pendingDoc) {
        $bookingApplication = VisaBooking::with('agency')
                                ->where('id', $document->application_id)
                                ->first();

        if ($bookingApplication) {
            $bookingApplication->document_status = "Done";
            $bookingApplication->save();
        }
    }
    $save=$this->agencyService->saveLog($bookings,'Super Admin','Updated Document status', Auth::id(),$data['document_status']);
    return $document;
}




   /****Document Data **** */ 
   public function uploadeDocumentById($id){
  
    $visa = $this->visaRepository->getBookingBySingleId($id);
    return $visa;
   }

   /*****Document Save *** */

   
public function saveDocumentData($documents, $files, $bookingId, $invoiceId, $clientId, $agencyId, $bookingType, $returnableArray = [])
{
    $newDocs = [];

    foreach ($documents as $index => $docName) {
        $file = $files[$index];

        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('documents/clientuploadDocument', $fileName, 'public');
        
        $isReturnable = isset($returnableArray[$index]) && $returnableArray[$index] == '1';

        $newDocs[] = [
            'name' => $docName,
            'file' => $filePath,
            'returnable' => $isReturnable,
        ];
    }

    // Check for existing record by invoice_id
    $existing = DownloadCenter::where('invoice_id', $invoiceId)->first();

    if ($existing) {
        // Merge old documents with new ones
        $oldDocs = json_decode($existing->documents, true) ?? [];
        $merged = array_merge($oldDocs, $newDocs);

        $existing->update([
            'documents' => json_encode($merged),
            'booking_id' => $bookingId,
            'client_id' => $clientId,
            'agency_id' => $agencyId,
            'booking_type' => $bookingType,
        ]);
    } else {
        // Create new record
        DownloadCenter::create([
            'invoice_id' => $invoiceId,
            'client_id' => $clientId,
            'agency_id' => $agencyId,
            'booking_id' => $bookingId,
            'booking_type' => $bookingType,
            'documents' => json_encode($newDocs),
        ]);
    }
}

public function checkSignDocument($id){
   
   
    // $document =DocSignDocument::where('id',$id)->first();
   
//     $realted_id=$id;
//    $bookingData=Deduction::with('invoice','docsign')->where('id',$realted_id)->first(); 
   $clientData=$this->visaRepository->bookingDataById($id);
  
   return $clientData;
}


public function getDataById($id){

 
    // $booking=Deduction::with([
    //   'service_name',
    //     'agency',
    //     'visaBooking.visa',
    //     'visaBooking.origin',
    //     'visaBooking.destination',
    //     'visaBooking.visasubtype',])->where('id', $id)->first();

    $bookingApplication = VisaBooking::with('agency')->where('id', $id)->first();

 
    
  
        $data=$this->agencyService->getClientinfoVisaBookingById($bookingApplication);
     return $data;


}
}
