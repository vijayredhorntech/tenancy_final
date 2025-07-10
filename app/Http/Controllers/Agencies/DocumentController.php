<?php

namespace App\Http\Controllers\Agencies;

use App\Http\Controllers\Controller;

use App\Repositories\Interfaces\DocumentSignRepositoryInterface;
use App\Repositories\Interfaces\ClintRepositoryInterface;
use App\Repositories\Interfaces\VisaRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\AgencyService;
use App\Models\VisaServiceType;


class DocumentController extends Controller
{

    protected $documentSignRepository;
    protected $clintRepository;
    protected $visaRepository;
    protected $agencyService;

    public function __construct(
        ClintRepositoryInterface $clintRepository,
        DocumentSignRepositoryInterface $documentSignRepository,
        VisaRepositoryInterface $visaRepository,
        AgencyService $agencyService
    ) {
        $this->documentSignRepository = $documentSignRepository;
        $this->clintRepository = $clintRepository;
        $this->visaRepository = $visaRepository;
        $this->agencyService = $agencyService;
    }
    
    public function hs_SAAddDocuments($id){
        
   
        $booking = $this->visaRepository->bookingDataById($id);
    
        return view('superadmin.pages.visa.superadminadddocuments',compact('booking'));
        }


          /***view  Document **** */
    public function hs_SAAViewDocuments($id){
        // dd($id);
        $documents = $this->documentSignRepository->getClientApplication($id);
        return view('superadmin.pages.visa.superadminviewdocuments',compact('documents'));
    }

    /*****Edit Document **** */
    
    public function hs_editSAUploadedApplication($id){
        $document = $this->documentSignRepository->getUploadeDocumentById($id);
        return view('superadmin.pages.visa.superadminupdatedocuments',compact('document'));

    }


    /*****Required Document ******/
    public function hsrequiredDocument(Request $request)
    {
        try {
            // Put validation inside try block
            $validated = $request->validate([
                'combinationId' =>'required|integer',
                'documents' =>'required|array|min:1',
                'documents.*' =>'required|string|max:255',
            ]);
    

    
            $visa = VisaServiceType::findOrFail($request->combinationId);
            $visa->required_document = json_encode($request->documents); 
            $visa->save();
    
            return redirect()
                ->back()
                ->with('success', 'Documents assigned successfully.');
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation failed
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('active_tab', 'VisaImportantDocumentDiv');
        } catch (\Exception $e) {
            // Any other exception
            \Log::error('Error saving documents: '.$e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'An error occurred while saving.')
                ->with('active_tab', 'VisaImportantDocumentDiv');
        }
    }
    
    /*****Store Application Document *** */
    public function hs_storeDocument(Request $request){
     
        //  dd($request->all());
        $request->validate([
            'bookingid' => 'required|integer|exists:visabookings,id', // or just 'required|integer' if no DB check
            'documents' => 'required|array|min:1',
            'documents.*' => 'required|string|max:255',
        ]);
        // dd($request->all());
        $storeDocument = $this->documentSignRepository->storeDocument($request);    
        return redirect()->route('superadminvisa.applicationview', ['id' => $request->bookingid])
        ->with('success', 'Booking successful');
        // return redirect()->route('superadminview.allapplication')->with('success', 'Document uploaded successfully.');
    }
     

    /*** Document Status** */
    public function hs_storeUpdateDocument(Request $request){
        // dd($request->all());
        $request->validate([
            'documentid' => 'required|integer|exists:client_application_documents,id',  
            'documentname' => 'required|string|max:255',
            'document_status' => 'required|in:0,1,2',
        ]);
        $document=$this->documentSignRepository->getUploadeDocumentById($request->documentid);
        // dd($document);
        $storeDocument = $this->documentSignRepository->updateDocumentStatus($request->all());
        return redirect()->route('superadminvisa.applicationview', ['id' => $document->application_id])
        ->with('success', 'Document uploaded successfully.');
        
    }

    public function hsshowUploadForm($id){
      
        $booking = $this->documentSignRepository->uploadeDocumentById($id);
         return view('superadmin.pages.visa.superadminuploadedocuments', compact('booking'));
    }

    public function hsuploadDocument(Request $request){
        
    // dd($request->all());
        // Validate the request data
        $request->validate([
            'bookingid' => 'required|numeric',
            'documents' => 'required|array',
            'documents.*' => 'required|string',
            'files' => 'required|array',
            'files.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
       
                $bookingId = $request->input('bookingid');
                $booking = $this->documentSignRepository->uploadeDocumentById($bookingId);
          
                $documents = $request->input('documents');
                $files = $request->file('files');
                $invoiceId = $booking->application_number;
                $clientId = $booking->client_id;
                $agencyId = $booking->agency_id;
                $bookingType = 'Visa';
                
             $booking=$this->documentSignRepository->saveDocumentData(
                    $documents, 
                    $files, 
                    $bookingId, 
                    $invoiceId, 
                    $clientId, 
                    $agencyId, 
                    $bookingType
                );
                return redirect()->route('superadminview.allapplication')->with('success', 'Documents uploaded successfully.');  
              
      }


      /******Document Part **** */
      public function hsClientApplication(){
       
            $agency=$this->agencyService->getAgencyData();
            $type='all';
            // $allbookings=$this->visaRepository->getDataByClientId($client_data->id);
            $allbookings = $this->visaRepository->getPendingBookingByid($agency->id,$type);
   
        return view('agencies.pages.clients.pending',compact('allbookings'));
    }



    public function hsDownloadDocumentCenter(){
        
        
        $agency=$this->agencyService->getAgencyData();
        $type='all';

        $allbookings=$this->visaRepository->getBookingByid($agency->id,$type);
        return view('agencies.pages.clients.downloadcenter',compact('allbookings'));
    }


    public function hsdocuemntdestroy($name, $id)
    {

        $booking = $this->documentSignRepository->uploadeDocumentById($id);
        $documents = json_decode($booking->downloadDocument->documents, true);
        if (!$documents) {
            return redirect()->back()->with('error', 'No documents found.');
        }
        $filteredDocuments = array_filter($documents, function ($doc) use ($name) {
            return $doc['name'] !== $name;
        });
        $filteredDocuments = array_values($filteredDocuments);
        $booking->downloadDocument->documents = json_encode($filteredDocuments);
        $booking->downloadDocument->save();
    
        return redirect()->route('superadminvisa.applicationview', ['id' => $id])
        ->with('success', 'Booking successful');
    }
    
  
}
