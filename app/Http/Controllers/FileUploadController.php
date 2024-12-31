<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\WelcomeMail;

class FileUploadController extends Controller
{
    // Handle the file upload
    public function upload(Request $request)
    {
        // Validate the file
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf,docx|max:10240',
        ]);

        // Handle file upload
        $file = $request->file('file');
        $path = $file->store('uploads', 'public');

        // Check if the user is authenticated
        $user = Auth::user();

        if ($user instanceof User) { // Explicit check for User instance
            // Send confirmation email if user is authenticated
            Mail::to($user->email)->send(new WelcomeMail($user));
        } else {
            // Handle the case where no user is authenticated
            return back()->with('error', 'User is not authenticated!');
        }

        return back()->with('success', 'File uploaded successfully!')->with('file_path', $path);
    }

    // Redirect authenticated user to the one page web
    public function redirectToDashboard()
    {
        return view('users.onepageweb');
    }
    public function download($filename)
{
    // Get the file path from storage
    $path = storage_path('app/public/uploads/' . $filename);

    // Check if the file exists
    if (file_exists($path)) {
        // Return the file for download
        return response()->download($path);
    } else {
        // Return an error if the file doesn't exist
        return back()->with('error', 'File not found!');
    }
}

}