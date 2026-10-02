<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVendorApplicationRequest;
use App\Services\ApplicationService;

class SponsorApplicationController extends Controller
{
    public function __construct(protected ApplicationService $service) {}

    public function create()
    {
        return view('applications.sponsor');
    }

    public function store(StoreVendorApplicationRequest $request)
    {
        $data = $request->validated();
        $data['type'] = 'sponsor';

        $this->service->submit($data, auth()->user());

        return redirect()->route('apply.success')->with('application_type', 'Sponsor');
    }
}
