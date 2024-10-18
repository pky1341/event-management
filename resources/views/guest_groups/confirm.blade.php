@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Confirm Your Attendance</h4>
                </div>
                <div class="card-body">
                    <h5>{{ $guestGroup->event->title }}</h5>
                    <p>Date: {{ $guestGroup->event->date }}</p>
                    <p>Location: {{ $guestGroup->event->location }}</p>

                    <form action="{{ route('guest-groups.confirm', $guestGroup) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="attending_count" class="form-label">How many people are attending?</label>
                            <input type="number" class="form-control" id="attending_count" name="attending_count" min="0" max="{{ $guestGroup->max_members }}" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Confirm Attendance</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection