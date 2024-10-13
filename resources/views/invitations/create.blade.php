@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-envelope mr-2"></i> Create Invitation</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('invitations.store', $event) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="card_image" class="form-label">Invitation Card Image</label>
                        <input type="file" class="form-control" id="card_image" name="card_image" accept="image/*" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i> Create Invitation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection