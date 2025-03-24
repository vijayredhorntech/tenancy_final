<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Auth; 

class FileUploadService
{
    /**
     * Upload file to the given destination path.
     *
     * @param UploadedFile $file
     * @param string $folderPath
     * @param object|null $user
     * @param string $prefix
     * @return string File name of the uploaded file
     */
    public function uploadFile(UploadedFile $file, string $folderPath, $user, string $prefix = 'file')
    {
        // dd("heelo");
        $destinationPath = public_path($folderPath); // Store in public directory

        // Create directory if not exists
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }

     

        // Generate a unique file name
        $fileName = $this->generateFileName($file, $user, $prefix);

        // Move the file to destination
        $file->move($destinationPath, $fileName);

        return $fileName;
    }

    /**
     * Generate a unique file name.
     *
     * @param UploadedFile $file
     * @param object|null $user
     * @param string $prefix
     * @return string
     */
    private function generateFileName(UploadedFile $file, $user = null, string $prefix = 'file')
    {
        $userId = $user ? $user : auth()->id();
        return "{$prefix}_{$userId}_" . time() . "_" . Str::random(10) . "." . $file->getClientOriginalExtension();
    }
}
