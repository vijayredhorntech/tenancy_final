<?php

namespace App\Repositories\Interfaces;
use Illuminate\Http\Request;

interface DocumentSignRepositoryInterface
{
    public function getAllDocuments();
    public function getDocumentById($id);
    public function createDocument(array $data);
    public function updateDocument($id, array $data);
    public function deleteDocument($id);
    public function getSignedDocumentsByAgency($agencyId);
  
    public function getClientApplication($id);

    public function getUploadeDocumentById($id);

    public function updateDocumentStatus($data);

    public function uploadeDocumentById($id);

    public function signDocumentStore($data);
    public function sendEmailForSign(Request $request, int $documentId): void;

}
