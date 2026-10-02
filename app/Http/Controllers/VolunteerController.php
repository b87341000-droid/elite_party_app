<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVendorApplicationRequest;
use App\Services\ApplicationService;

class VolunteerController extends Controller
{
    public function __construct(protected ApplicationService $service) {}

    public function create()
    {
        return view('applications.volunteer');
    }

    public function store(StoreVendorApplicationRequest $request)
    {
        $data = $request->validated();
        $data['type'] = 'volunteer';

        $this->service->submit($data, auth()->user());

        return redirect()->route('apply.success')->with('application_type', 'Volunteer');
    }
}
