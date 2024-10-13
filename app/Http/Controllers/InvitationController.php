<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Invitation;

class InvitationController extends Controller
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
    public function create(Event $event)
    {
        return view('invitations.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Event $event)
    {
        $validatedData = $request->validate([
            'card_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('card_image')->store('invitation_cards', 'public');

        $invitation = new Invitation([
            'event_id' => $event->id,
            'card_path' => $path,
            'status' => 'draft',
        ]);

        $invitation->save();

        return redirect()->route('events.show', $event)->with('success', 'Invitation created successfully.');
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
    public function publish(Event $event)
    {
        $invitation = $event->invitation;
        $invitation->status = 'published';
        $invitation->save();

        // Here you would typically send out the invitations to guests
        // This could involve queuing jobs to send emails or SMS

        return redirect()->route('events.show', $event)->with('success', 'Invitation published successfully.');
    }
}
