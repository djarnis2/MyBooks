<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $path = $request->file('file')->store('files', 'public');

            return back()->with('success', 'File uploaded successfully to: ' . $path);
        }

        return back()->with('error', 'File upload failed.');
    }
}
