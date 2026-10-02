<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendorApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|in:food,fashion,merch,lifestyle,sponsor,volunteer,performer,media',
            'business_name' => 'nullable|string|max:160',
            'contact_name' => 'required|string|max:120',
            'email' => 'required|email|max:160',
            'phone' => 'required|string|max:30',
            'description' => 'required|string|min:20|max:5000',
            'website' => 'nullable|url|max:200',
            'instagram' => 'nullable|string|max:80',
            'tiktok' => 'nullable|string|max:80',
            'documents' => 'nullable|array|max:5',
            'documents.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120',
        ];
    }
}
