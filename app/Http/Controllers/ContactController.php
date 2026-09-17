<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:30',
            'subject' => 'nullable|string|max:160',
            'message' => 'required|string|min:10|max:5000',
        ]);

        ContactMessage::create($data);

        return back()->with('success', 'Message sent! We\'ll get back to you within 24 hours.');
    }
}
