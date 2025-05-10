<?php

namespace App\Repositories\Interfaces;

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

}
