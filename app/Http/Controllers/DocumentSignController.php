<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\DocumentSignRepositoryInterface;
use App\Repositories\Interfaces\TermConditionRepositoryInterface;
use App\Models\Agency;
use App\Models\DocSignAudit;
use App\Models\DocSignDocument;
use App\Models\DocSignProcess;
use App\Models\Deduction;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;
use DB; 
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;


class DocumentSignController extends Controller
{
    
    protected $documentSignRepository;
    protected $termConditionRepo;

  
    public function __construct( DocumentSignRepositoryInterface $documentSignRepository,TermConditionRepositoryInterface $termConditionRepo) {
        $this->documentSignRepository = $documentSignRepository;
        $this->termConditionRepo = $termConditionRepo;
 

    }

    public function hsviewInvoice($id)
{
   
  
    $booking = $this->documentSignRepository->checkSignDocument($id);
 
    $termconditon = $this->termConditionRepo->allTeamTypes();
    // dd($termconditon);
  
    return view('documents.show', compact('booking','termconditon'));
}


public function hsdownloadeInvoice($id)
{
   
  
    $booking = $this->documentSignRepository->checkSignDocument($id);
 
    $termconditon = $this->termConditionRepo->allTeamTypes();
    return view('components.common.invoice.visa-invoice', compact('booking', 'termconditon'));
}
    //

       /****Doc Sign *****/


   public function haindexDocSign(Request $request){
        
    $documents=$this->documentSignRepository->getAllDocuments();
    // dd($documents);
        return view('superadmin.pages.docsign.index',compact('documents'));

   }

   public function hsCreateDocument(Request $request){
          
           $agencies =Agency::all();
           $termconditions = $this->termConditionRepo->allTeamTypes();
   
        return view('superadmin.pages.docsign.createdoc',compact('agencies','termconditions'));
   }

   public function hsDocumentStore(Request $request){

    $validator = Validator::make($request->all(), [
                    'name'               => 'required|string|max:255',
                    'clientid'           => 'required|integer',
                    'document_type'      => 'required|array|min:1',
                    'document_type.*'    => 'required|string|max:50',
                    'document_name'      => 'required|array|min:1',
                    'document_name.*'    => 'required|string|max:255',
                    'termandcondition'   => 'required|array|min:1',
                    'termandcondition.*' => 'required|string|max:255',
                    'document_file'      => 'required|array|min:1',
                    'document_file.*'    => 'required|file|mimes:pdf,jpg,jpeg,png,gif,webp,bmp,svg',
                    'termstype'          => 'required|array|min:1',
                    'termstype.*'        => 'required|integer',
                ]);
         
                if ($validator->fails()) {
                    // 👇 Get all error messages
                    $errors = $validator->errors()->all(); // array of strings
                    logger()->error('Validation failed:', $errors);
                  return back()
                        ->withErrors($validator)
                        ->withInput();
                }
            $dataRequest = $this->documentSignRepository->signDocumentStore($request);
            if($dataRequest){
                return redirect()->route('superadmin.docsign')->with('success', 'Document created successfully.');
            }else{
                return redirect()->route('superadmin.docsign')->with('error', 'Document created successfully.');
            }
   }

   public function hsSendEmail(Request $request, int $id)
    {
        $this->documentSignRepository->sendEmailForSign($request, $id);
        return back()->with('success', 'Signing request emailed successfully!');
    }



public function showSigningPage(Request $request,$token){

            $signature = DocSignProcess::with('agency','document','bookingdetails')->where('signing_token', $token)
            ->firstOrFail();
         
              
            
       
            $termconditon = $this->termConditionRepo->allTeamTypes();
            if($signature->bookingdetails->servicerelatedtableid){
                $user= $this->documentSignRepository->getDataById($signature->bookingdetails->servicerelatedtableid);
                // dd($user);
                $signature->recordEvent('viewed', 'viewed', $request);

            }
          
           
        //    $term =TermCondition::where(find($signature->termstype);
   // dd($signature);

        return view('superadmin.pages.docsign.document-signing', compact('signature','user','termconditon'));

}


public function hsDownloadeSignDocument($id){

    $booking = $this->documentSignRepository->checkSignDocument($id);
    $termconditon = $this->termConditionRepo->allTeamTypes();
    // return view('documents.download-invoice', compact('booking','termconditon'));
    $pdf = Pdf::loadView('documents.download-invoice', [
        'booking' => $booking,
        'termconditon' => $termconditon,
    ]);

    return $pdf->download('SignedDocument.pdf');
    
}

       public function him_docsign(){
  
        return view('agencies.pages.docsign.createdoc');
    }

    public function hs_docIndex(Request $request)
    {
        $documents=$this->documentSignRepository->getAllDocuments();
        dd($documents);
   
      return view('agencies.pages.docsign.index',compact('documents'));
    }
   
    public function hs_sendDocumentEmail($id){
        $document = $this->documentSignRepository->getDocumentById($id);
        return view('agencies.pages.docsign.sendemail', compact('document'));
    }

    /****Create Document ***** */
    public function hs_docCreate(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',           // Title of the document
            'description' => 'nullable|string|max:500',  // Optional description
            'documentfile' => 'required|file|mimes:pdf|max:10240',  // Validate file type and size
        ]);


        if ($request->hasFile('documentfile')) {
            $timestamp = now()->format('Ymd_His'); 
            $uniqueFileName = $timestamp . '_' . Str::random(10) . '.' . $request->file('documentfile')->getClientOriginalExtension();

            $filePath = $request->file('documentfile')->storeAs(
                'documents/agencies-signdocuments',   
                $uniqueFileName,                       
                'public'                             
            );     
            // Add the file path and other details to the validated data
            $validatedData['path'] = $filePath;
            $validatedData['mimetype'] = $request->file('documentfile')->getMimeType();
            $validatedData['size'] = $request->file('documentfile')->getSize();
        }

        $documents = $this->documentSignRepository->createDocument($validatedData);
        // dd($documents);
        // return view('agencies.document.create');
        return redirect()->route('document.index')->with('success', 'Document created successfully.');

    }

    public function hs_generateInvoice($id, $type){
        $documents = $this->documentSignRepository->createDocumentAgency($id, $type);
        
        
        return redirect()
        ->back()
        ->with('success', 'Invoice generated successfully.');
  
   }

   /****Submit Sign **** */
   public function submitSigning(Request $request)
   {
     
       $request->validate([
           'signature_token' => 'required|string',
           'signature_data' => 'required|string'
       ]);

       $signature = DocSignProcess::with('document')->where('signing_token', $request->signature_token)
           ->where('status', 'pending')
           ->firstOrFail();
           if(isset($signature->document->servicerelatedtableid)){
            
            $url = route('verify.application', ['id' => $signature->document->servicerelatedtableid]);
            // $booking = Deduction::with([
            //     'service_name',
            //     'agency',
            
            //     // Include all 3 possible booking types and their nested relations
            //     'flightBooking',
            
            //     'visaBooking',
            //     'visaBooking.visa',
            //     'visaBooking.origin',
            //     'visaBooking.destination',
            //     'visaBooking.visasubtype',
            //     'visaBooking.clint',
            //     'visaApplicant',
            
            //     'hotelBooking',
            //     'hotelDetails'
            // ])
            // ->where('id',$signature->document->related_id)->first();
     
            // if ($booking && $booking->service == 3) {
            //     // dd("heelo");
          
            // }
            
           
            
        }
    
      
       DB::beginTransaction();
       try {
           // Log the received signature data
           Log::info('Received signature data for token ' . $request->signature_token, [
               'signature_data_length' => strlen($request->signature_data),
               'signature_data_start' => substr($request->signature_data, 0, 100) // Log the beginning of the data
           ]);

           // Generate signature hash
           $signatureHash = hash('sha256', $request->signature_data . $signature->signing_token);

           // Update signature record
           $signature->update([
               'signature_data' => $request->signature_data,
               'signature_hash' => $signatureHash,
               'signed_at' => now(),
               'signed_document_path' => $signature->document->path,
               'status' => 'signed'
           ]);

           // Verify the data was saved
           $signature->refresh();
           Log::info('Signature data after save:', [
               'signature_id' => $signature->id,
               'has_signature_data' => !empty($signature->signature_data),
               'signature_data_length' => strlen($signature->signature_data ?? ''),
               'status' => $signature->status
           ]);

           // Record audit
        //    $signature->recordAudit('processed', [
        //        'document_path' => $signature->document->path,
        //        'processing_completed' => true,
        //        'signature_info' => [
        //            'signed_by' => $signature->coreMember->user->name,
        //            'signed_at' => $signature->signed_at->format('d M Y H:i:s'),
        //            'signature_hash' => $signatureHash
        //        ]
        //    ]);

           DB::commit();


           if ($url) {
            return redirect($url)->with('success', 'Document signed and redirected successfully.');
        }
           // if ($request->ajax()) {
            return back()->with('success', 'Document signed successfully.');
           // }

           // return redirect()
           //     ->route('core-member.document.sign', $signature->signing_token)
           //     ->with('success', 'Document signed successfully.');

       } catch (Exception $e) {
           DB::rollBack();
           
           // Record audit of failure
        //    $signature->recordAudit('signing_failed', [
        //        'error' => $e->getMessage()
        //    ]);

           Log::error('Failed to process document signing', [
               'signature_id' => $signature->id,
               'error' => $e->getMessage(),
               'trace' => $e->getTraceAsString()
           ]);

           if ($request->ajax()) {
               return response()->json([
                   'success' => false,
                   'message' => 'Failed to process document signing. Please try again.'
               ], 500);
           }

           return redirect()
               ->route('core-member.document.sign', $signature->signing_token)
               ->with('error', 'Failed to process document signing. Please try again.');
       }
   }
}
