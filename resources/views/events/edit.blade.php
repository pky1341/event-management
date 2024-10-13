@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-edit mr-2"></i> Edit Event: {{ $event->title }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('events.update', $event) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Event Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $event->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="event_type" class="form-label">Event Type</label>
                        <select class="form-select" id="event_type" name="event_type" required>
                            <option value="wedding" {{ $event->event_type == 'wedding' ? 'selected' : '' }}>Wedding</option>
                            <option value="birthday" {{ $event->event_type == 'birthday' ? 'selected' : '' }}>Birthday</option>
                            <option value="baby_shower" {{ $event->event_type == 'baby_shower' ? 'selected' : '' }}>Baby Shower</option>
                            <option value="engagement" {{ $event->event_type == 'engagement' ? 'selected' : '' }}>Engagement</option>
                            <option value="family_gathering" {{ $event->event_type == 'family_gathering' ? 'selected' : '' }}>Family Gathering</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Event Date & Time</label>
                        <input type="datetime-local" class="form-control" id="date" name="date" value="{{ $event->date }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ $event->location }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="max_guests" class="form-label">Maximum Guests</label>
                        <input type="number" class="form-control" id="max_guests" name="max_guests" value="{{ $event->max_guests }}" required min="1">
                    </div>
                    <div class="mb-3">
                        <label for="details" class="form-label">Additional Details</label>
                        <textarea class="form-control" id="details" name="details" rows="3">{{ $event->details }}</textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i> Update Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection