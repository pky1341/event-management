@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><i class="fas fa-calendar-day mr-2"></i> {{ $event->title }}</h4>
                        <a href="{{ route('events.edit', $event) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                    <div class="card-body">
                        <p><strong>Type:</strong> {{ ucfirst($event->event_type) }}</p>
                        <p><strong>Date:</strong> {{ $event->date }}</p>
                        <p><strong>Location:</strong> {{ $event->location }}</p>
                        <p><strong>Max Guests:</strong> {{ $event->totalGuests }} / {{ $event->max_guests }}</p>
                        <p><strong>Details:</strong> {{ $event->details }}</p>
                        <h5 class="mt-4">Guest Groups</h5>
                        @if ($event->max_guests > 0)
                            <ul class="list-group">
                                @foreach ($event->guestGroups as $guestGroup)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $guestGroup->group_type }} - {{ $guestGroup->mobile_number }}
                                        <span class="badge bg-primary rounded-pill">
                                            {{ $guestGroup->max_members }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No guest groups added yet.</p>
                        @endif
                        <a href="{{ route('guest-groups.create', ['event' => $event]) }}" class="btn btn-success mt-3">
                            <i class="fas fa-plus-circle"></i> Add Guest Group
                        </a>
                        <h5 class="mt-4">Invitation</h5>
                        @if ($event->invitation)
                            <p>Status: {{ ucfirst($event->invitation->status) }}</p>
                            <img src="{{ asset('storage/' . $event->invitation->card_path) }}" alt="Invitation Card" class="img-fluid mb-3">
                            @if ($event->invitation->status === 'draft')
                                <form action="{{ route('invitations.publish', $event) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane"></i> Publish Invitation
                                    </button>
                                </form>
                            @endif
                        @else
                            <p>No invitation created yet.</p>
                            <a href="{{ route('invitations.create', ['event' => $event]) }}" class="btn btn-primary">
                                <i class="fas fa-envelope"></i> Create Invitation
                            </a>
                        @endif
                        <div class="mt-4">
                            <a href="{{ route('events.send-reminders', $event) }}" class="btn btn-warning">
                                <i class="fas fa-bell"></i> Send Reminders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
