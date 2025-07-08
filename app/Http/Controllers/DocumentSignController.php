<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\DocumentSignRepositoryInterface;
use App\Repositories\Interfaces\TermConditionRepositoryInterface;
use App\Models\Agency;
use App\Models\DocSignAudit;
use App\Models\DocSignDocument;
use App\Models\DocSignProcess;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class DocumentSignController extends Controller
{
    
    protected $documentSignRepository;
    protected $termConditionRepo;

  
    public function __construct( DocumentSignRepositoryInterface $documentSignRepository,TermConditionRepositoryInterface $termConditionRepo) {
        $this->documentSignRepository = $documentSignRepository;
        $this->termConditionRepo = $termConditionRepo;
 

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
            $signature = DocSignProcess::with('agency','document')->where('signing_token', $token)
            ->firstOrFail();
      
            $signature->recordEvent('viewed', 'viewed', $request);
        
        // dd($signature);

        return view('superadmin.pages.docsign.document-signing', compact('signature'));

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
}
