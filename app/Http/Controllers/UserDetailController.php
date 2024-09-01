<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserDetailRequest;
use App\Http\Requests\UpdateUserDetailRequest;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Redirect;

class UserDetailController extends Controller
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
        return view('userDetail.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserDetailRequest $request)
    {
        $validated = $request->validated();
        $userDetail = UserDetail::create($validated);

        return redirect()->action([self::class, 'edit'], $userDetail)
            ->with([
                'status' => 'information-updated',
                'success' => 'Personal information updated.'
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserDetail $userDetail) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserDetail $userDetail)
    {
        return view('userDetail.edit', compact('userDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserDetailRequest $request, UserDetail $userDetail)
    {
        $validated = $request->validated();
        $userDetail->update($validated);

        return Redirect::back()->with('status', 'information-updated')->with('success', 'Personal information updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDetail $userDetail)
    {
        //
    }
}
