@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-calendar-plus mr-2"></i> Create New Event</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('events.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Event Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="event_type" class="form-label">Event Type</label>
                        <select class="form-select" id="event_type" name="event_type" required>
                            <option value="wedding">Wedding</option>
                            <option value="birthday">Birthday</option>
                            <option value="baby_shower">Baby Shower</option>
                            <option value="engagement">Engagement</option>
                            <option value="family_gathering">Family Gathering</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Event Date & Time</label>
                        <input type="datetime-local" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                    <div class="mb-3">
                        <label for="max_guests" class="form-label">Maximum Guests</label>
                        <input type="number" class="form-control" id="max_guests" name="max_guests" required min="1">
                    </div>
                    <div class="mb-3">
                        <label for="details" class="form-label">Additional Details</label>
                        <textarea class="form-control" id="details" name="details" rows="3"></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i> Create Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection