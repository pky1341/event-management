<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\GuestGroup;

class GuestGroupController extends Controller
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
    public function create(int $eventId)
    {
        $event = $eventId;
        return view('guest_groups.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $event)
    {
        $validatedData = $request->validate([
            'group_type' => 'required|in:single,couple,family',
            'mobile_number' => 'required|string',
            'max_members' => 'required'
        ]);

        // $maxMembers = $validatedData['group_type'] === 'single' ? 1 :
        //     ($validatedData['group_type'] === 'couple' ? 2 :
        //         $request->input('family_members', 3));
        
        $guestGroup = new GuestGroup($validatedData);
        $guestGroup->event_id = $event;
        // $guestGroup->max_members = $maxMembers;
        $guestGroup->save();
        
        return redirect()->route('events.show', $event)->with('success', 'Guest group added successfully.');
    }
    public function confirm(Request $request, GuestGroup $guestGroup)
    {
        $validatedData = $request->validate([
            'confirmation_status' => 'required|in:attending,not_attending',
            'actual_members' => 'required|integer|min:1|max:' . $guestGroup->max_members,
        ]);

        $guestGroup->confirmation_status = $validatedData['confirmation_status'];
        $guestGroup->actual_members = $validatedData['actual_members'];
        $guestGroup->save();

        return redirect()->back()->with('success', 'Confirmation submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
