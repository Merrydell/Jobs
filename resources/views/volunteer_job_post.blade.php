@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-xl font-bold mb-4">Post a Job as Volunteer</h1>
    <form action="{{ route('volunteer.job.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="role" class="block">Role</label>
            <input type="text" name="role" id="role" class="form-input" required>
        </div>
        <div class="mb-4">
            <label for="company" class="block">Company</label>
            <input type="text" name="company" id="company" class="form-input" required>
        </div>
        <div class="mb-4">
            <label for="contact" class="block">Contact</label>
            <input type="text" name="contact" id="contact" class="form-input" required>
        </div>
        <div class="mb-4">
            <label for="apply" class="block">How to Apply</label>
            <input type="text" name="apply" id="apply" class="form-input" required>
        </div>
        <div class="mb-4">
            <label for="location" class="block">Location</label>
            <input type="text" name="location" id="location" class="form-input" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit Job</button>
    </form>
</div>
@endsection
