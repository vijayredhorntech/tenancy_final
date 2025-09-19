<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ApplicationController extends Controller
{
    /**
     * Download application document
     */
    public function download($id, $token)
    {
        // Validate token and id
        if (!$this->validateDownloadToken($id, $token)) {
            abort(403, 'Invalid download token');
        }

        // Find the application document path
        $documentPath = $this->getApplicationDocumentPath($id);
        
        if (!$documentPath || !Storage::exists($documentPath)) {
            abort(404, 'Document not found');
        }

        // Get file info
        $fileName = basename($documentPath);
        $mimeType = Storage::mimeType($documentPath);

        // Return file download response
        return Response::download(
            Storage::path($documentPath),
            $fileName,
            ['Content-Type' => $mimeType]
        );
    }

    /**
     * Validate download token
     */
    private function validateDownloadToken($id, $token)
    {
        // Add your token validation logic here
        // This is a placeholder implementation
        return !empty($id) && !empty($token);
    }

    /**
     * Get application document path
     */
    private function getApplicationDocumentPath($id)
    {
        // Add your logic to get document path based on application ID
        // This is a placeholder implementation
        return "applications/{$id}/document.pdf";
    }
}
