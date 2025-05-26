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
        return SignedDocument::all();  // Retrieve all documents
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
    $save=$this->agencyService->saveLog($bookings,'Super Admin','Update Document status', Auth::id(),$data['document_status']);
    return $document;
}


   /****Document Data **** */ 
   public function uploadeDocumentById($id){
  
    $visa = $this->visaRepository->getBookingBySingleId($id);
    return $visa;
   }

   /*****Document Save *** */
//    public function saveDocumentData($documents, $files, $bookingId, $invoiceId, $clientId, $agencyId, $bookingType)
//    {
//        $merged = [];
   
//        foreach ($documents as $index => $docName) {
//            $file = $files[$index];
   
//            $fileName = time() . '_' . $file->getClientOriginalName();
//            $filePath = $file->storeAs('documents/clientuploadDocument', $fileName, 'public'); // Use forward slashes
   
//            $merged[] = [
//                'name' => $docName,
//                'file' => $filePath,
//            ];
//        }
   
//        // Insert data into your table
//        DownloadCenter::create([
//         'invoice_id' => $invoiceId,
//         'client_id' => $clientId,
//         'agency_id' => $agencyId,
//         'booking_id' => $bookingId,
//         'booking_type' => $bookingType,
//         'documents' => json_encode($merged),
//     ]);
    
//    }
   
public function saveDocumentData($documents, $files, $bookingId, $invoiceId, $clientId, $agencyId, $bookingType)
{
    $newDocs = [];

    foreach ($documents as $index => $docName) {
        $file = $files[$index];

        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('documents/clientuploadDocument', $fileName, 'public');

        $newDocs[] = [
            'name' => $docName,
            'file' => $filePath,
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

    

}

