<?php

namespace App\Http\Controllers;

use App\Models\VendorApplication;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = VendorApplication::where('status', 'approved')
            ->orderBy('business_name')
            ->get();

        return view('pages.vendors', compact('vendors'));
    }
}
