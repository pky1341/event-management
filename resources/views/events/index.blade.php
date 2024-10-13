@extends('layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><i class="fas fa-calendar-alt mr-2"></i> Your Events</h4>
                        <a href="{{ route('events.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus"></i> Create Event
                        </a>
                    </div>
                    <div class="card-body">
                        @if ($events->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Date</th>
                                            <th>Guests</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $event)
                                            <tr>
                                                <td>{{ $event->title }}</td>
                                                <td>{{ ucfirst($event->event_type) }}</td>
                                                <td>{{ $event->date }}</td>
                                                <td>
                                                    {{ $event->guestGroups->count() }} / {{ $event->max_guests }}</td>
                                                <td>
                                                    <a href="{{ route('events.show', $event) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('events.edit', $event) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('events.destroy', $event) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this event?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center">You haven't created any events yet. <a
                                    href="{{ route('events.create') }}">Create your first event</a>.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @section('content')
    <div class="container">
        <h1 class="mb-4">Your Events</h1>
        <div class="row">
            @foreach ($events as $event)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ ucfirst($event->event_type) }}</h6>
                            <p class="card-text">
                                <strong>Date:</strong>{{ $event->date }}
                                <br>
                                <strong>Location:</strong> {{ $event->location }}<br>
                                <strong>Guests:</strong> {{ $event->max_guests }}
                            </p>
                            <a href="{{ route('events.show', $event) }}" class="btn btn-primary">
                                <i class="fas fa-eye mr-2"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if ($events->count() == 0)
            <div class="mt-4">
                <a href="{{ route('events.create') }}" class="btn btn-success">
                    <i class="fas fa-plus-circle mr-2"></i> Create New Event
                </a>
            </div>
        @endif
    </div>
@endsection --}}
