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
          $bookingApplication = VisaBooking::where('id', $request->bookingid)->first();
 
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
        $document = ClientApplicationDocument::findOrFail($data['documentid']);
        $document->document_status = $data['document_status']; 
        $document->save();
    
        return $document;
    }

   /****Document Data **** */ 
   public function uploadeDocumentById($id){
  
    $visa = $this->visaRepository->getBookingBySingleId($id);
    return $visa;
   }

   /*****Document Save *** */
   public function saveDocumentData($documents, $files, $bookingId, $invoiceId, $clientId, $agencyId, $bookingType)
   {
       $merged = [];
   
       foreach ($documents as $index => $docName) {
           $file = $files[$index];
   
           $fileName = time() . '_' . $file->getClientOriginalName();
           $filePath = $file->storeAs('documents/clientuploadDocument', $fileName, 'public'); // Use forward slashes
   
           $merged[] = [
               'name' => $docName,
               'file' => $filePath,
           ];
       }
   
       // Insert data into your table
       DownloadCenter::create([
        'invoice_id' => $invoiceId,
        'client_id' => $clientId,
        'agency_id' => $agencyId,
        'booking_id' => $bookingId,
        'booking_type' => $bookingType,
        'documents' => json_encode($merged),
    ]);
    
   }
   

    

}

