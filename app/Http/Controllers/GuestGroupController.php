<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\GuestGroup;
use Illuminate\Support\Facades\DB;

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

    public function confirmPage(GuestGroup $guestGroup){
        $guestGroup->load('event');

        // if (!$guestGroup || !$guestGroup->event) {
        //     abort(404, 'Invalid invitation link');
        // }

        // if (now()->isAfter($guestGroup->event->date)) {
        //     return redirect()->back()->with('error', 'This event has already passed.');
        // }
        return view('guest_groups.confirm', compact('guestGroup'));
    }
    public function confirm(Request $request, GuestGroup $guestGroup)
    {
        $validatedData = $request->validate([
            'attending_count' => [
                'required',
                'integer',
                'min:0',
                'max:' . $guestGroup->max_members
            ]
        ]);

        // try {
            DB::transaction(function () use ($guestGroup, $validatedData) {
                $guestGroup->update([
                    'confirmed_count' => $validatedData['attending_count'],
                    'confirmation_status' => 'confirmed'
                ]);
            });

            return redirect()->route('guest-groups.confirmation-success')->with('success', 
                'Thank you for confirming your attendance!'
            );

        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', 
        //         'Sorry, there was an error processing your confirmation. Please try again.'
        //     )->withInput();
        // }
    }
    public function confirmationSuccess()
    {
        return view('guest_groups.confirmation-success');
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
