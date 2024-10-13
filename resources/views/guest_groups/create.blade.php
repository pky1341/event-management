@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-users mr-2"></i> Add Guest Group</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('guest-groups.store', $event) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="group_type" class="form-label">Group Type</label>
                        <select class="form-select" id="group_type" name="group_type" required>
                            <option value="single">Single</option>
                            <option value="couple">Couple</option>
                            <option value="family">Family</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mobile_number" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile_number" name="mobile_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="max_members" class="form-label">Maximum Members</label>
                        <input type="number" class="form-control" id="max_members" name="max_members" required min="1" max="10">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus-circle mr-2"></i> Add Guest Group
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection