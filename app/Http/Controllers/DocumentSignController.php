<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\DocumentSignRepositoryInterface;


class DocumentSignController extends Controller
{
    
    protected $documentSignRepository;
    public function __construct( DocumentSignRepositoryInterface $documentSignRepository) {
        $this->documentSignRepository = $documentSignRepository;
 

    }
    //

       /****Doc Sign *****/

   public function haindexDocSign(Request $request){
        
   }

       public function him_docsign(){
  
        return view('agencies.pages.docsign.createdoc');
    }

    public function hs_docIndex(Request $request)
    {
        $documents=$this->documentSignRepository->getAllDocuments();
   
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
}
