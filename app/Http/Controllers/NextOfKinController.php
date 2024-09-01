<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNextOfKinRequest;
use App\Http\Requests\UpdateNextOfKinRequest;
use App\Models\NextOfKin;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class NextOfKinController extends Controller
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
        return view('nextOfKin.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNextOfKinRequest $request)
    {
        $validated = $request->validated();
        $nextOfKin = NextOfKin::create($validated);

        return redirect()->action([self::class, 'edit'], $nextOfKin)
            ->with([
                'status' => 'information-updated',
                'success' => 'Next of kin information updated.'
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(NextOfKin $nextOfKin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NextOfKin $nextOfKin)
    {
        return view('nextOfKin.edit', compact('nextOfKin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNextOfKinRequest $request, NextOfKin $nextOfKin)
    {
        $validated = $request->validated();
        $nextOfKin->update($validated);

        return Redirect::back()->with('status', 'information-updated')->with('success', 'Next of kin information updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NextOfKin $nextOfKin)
    {
        //
    }
}
