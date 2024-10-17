<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentDownloadController extends Controller
{
    /**
     * Download the document file with the given filename from the storage directory.
     *
     * @param string $filename The name of the document file to download.
     * @return \Illuminate\Http\Response The response to download the file.
     */
    public function downloadDocument(string $filename)
    {
        $filePath = 'files/' . $filename; // Path to the file in 'storage/app/public/documents'

        // Check if the file exists in the storage
        if (Storage::disk('public')->exists($filePath)) {
            // Trigger the file download
            return Storage::disk('public')->download($filePath);
        }

        // If file does not exist, return a 404 error
        return abort(404, 'File not found');
    }
}
