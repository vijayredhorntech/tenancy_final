<?php

namespace App\Repositories;

use App\Models\SignedDocument;
use App\Repositories\Interfaces\DocumentSignRepositoryInterface;
use App\Services\AgencyService;

class DocumentSignRepository implements DocumentSignRepositoryInterface
{
    protected $agencyService;

    public function __construct(AgencyService $agencyService)
    {
            $this->agencyService = $agencyService;
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
}
