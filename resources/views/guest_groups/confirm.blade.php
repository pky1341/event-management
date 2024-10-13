@extends('layout')

@section('content')
<div class="container">
    <h1>Confirm Attendance</h1>
    <form action="{{ route('guest-groups.confirm', $guestGroup) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="confirmation_status" class="form-label">Will you attend?</label>
            <select class="form-select" id="confirmation_status" name="confirmation_status" required>
                <option value="attending">Yes, I will attend</option>
                <option value="not_attending">No, I cannot attend</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="actual_members" class="form-label">Number of attendees</label>
            <input type="number" class="form-control" id="actual_members" name="actual_members" required min="1" max="{{ $guestGroup->max_members }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit Confirmation</button>
    </form>
</div>
@endsection