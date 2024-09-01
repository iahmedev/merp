<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmploymentInfoRequest;
use App\Http\Requests\UpdateEmploymentInfoRequest;
use App\Models\Department;
use App\Models\Designation;
use App\Models\EmploymentInfo;
use App\Models\EmploymentStatus;
use App\Models\EmploymentType;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class EmploymentInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        $departments = Department::all();
        $designations = Designation::all();
        $emp_types = EmploymentType::all();
        $emp_status = EmploymentStatus::all();

        return view('employmentInfo.create', compact('user', 'departments', 'designations', 'emp_types', 'emp_status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmploymentInfoRequest $request)
    {
        $validated = $request->validated();
        $employmentInfo = EmploymentInfo::create($validated);

        return redirect()->action([self::class, 'edit'], $employmentInfo)
            ->with([
                'status' => 'information-updated', 
                'success' => 'Employment information updated.'
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(EmploymentInfo $employmentInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmploymentInfo $employmentInfo)
    {
        $departments = Department::all();
        $designations = Designation::all();
        $emp_types = EmploymentType::all();
        $emp_status = EmploymentStatus::all();
        return view('employmentInfo.edit', compact('employmentInfo', 'departments', 'designations', 'emp_types', 'emp_status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmploymentInfoRequest $request, EmploymentInfo $employmentInfo)
    {
        $validated = $request->validated();
        $employmentInfo->update($validated);

        return Redirect::back()->with('status', 'information-updated')->with('success', 'Employment information updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmploymentInfo $employmentInfo)
    {
        //
    }
}
