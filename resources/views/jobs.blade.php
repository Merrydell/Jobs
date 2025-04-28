<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Job Posting Portal</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

  <h1>Job Posting Portal</h1>

  <!-- Admin Post Form -->
<div class="form-container">
  <h2>Admin Post Job</h2>
  <form id="adminForm">
    <input type="text" placeholder="Role" id="adminRole" name="role" autocomplete="off" required />
    <input type="text" placeholder="Company" id="adminCompany" name="company" autocomplete="organization" required />
    <input type="text" placeholder="Contact Person" id="adminContact" name="contact" autocomplete="name" required />
    <input type="text" placeholder="Where to Apply (email or recruiter name)" id="adminApply" name="apply" autocomplete="email" required />
    <input type="text" placeholder="Location" id="adminLocation" name="location" autocomplete="address-level2" required />
    <button type="submit">Post Job</button>
  </form>
</div>

<!-- Volunteer Suggest Form -->
<div class="form-container">
  <h2>Volunteer Suggest Job (Needs Admin Approval)</h2>
  <form id="volunteerForm">
    <input type="text" placeholder="Role" id="volRole" name="role" autocomplete="off" required />
    <input type="text" placeholder="Company" id="volCompany" name="company" autocomplete="organization" required />
    <input type="text" placeholder="Contact Person" id="volContact" name="contact" autocomplete="name" required />
    <input type="text" placeholder="Where to Apply (email or recruiter name)" id="volApply" name="apply" autocomplete="email" required />
    <input type="text" placeholder="Location" id="volLocation" name="location" autocomplete="address-level2" required />
    <button type="submit">Submit for Approval</button>
  </form>
</div>

  <!-- Job Listings -->
  <div class="job-list">
    <h2>Approved Job Listings</h2>
    <div id="jobList">
      @foreach ($approvedJobs as $job)
        <div class="job-post">
          <strong>Role:</strong> {{ $job->role }}<br>
          <strong>Company:</strong> {{ $job->company }}<br>
          <strong>Contact:</strong> {{ $job->contact }}<br>
          <strong>Apply At:</strong> {{ $job->apply }}<br>
          <strong>Location:</strong> {{ $job->location }}<br>
          @if ($job->status !== 'taken')
            <button class="taken" onclick="markAsTaken({{ $job->id }}, this)">Mark as Taken</button>
          @else
            <p><strong>Status:</strong> Taken</p>
          @endif
        </div>
      @endforeach
    </div>
  </div>

  <!-- Pending Approval -->
  <div class="job-list">
    <h2>Pending Volunteer Submissions (For Admin Review)</h2>
    <div id="pendingList">
      @foreach ($pendingJobs as $job)
        <div class="job-post">
          <strong>Role:</strong> {{ $job->role }}<br>
          <strong>Company:</strong> {{ $job->company }}<br>
          <strong>Contact:</strong> {{ $job->contact }}<br>
          <strong>Apply At:</strong> {{ $job->apply }}<br>
          <strong>Location:</strong> {{ $job->location }}<br>
          <button onclick="approveJob({{ $job->id }}, this)">Approve</button>
          <button class="decline" onclick="declineJob({{ $job->id }}, this)">Decline</button>
        </div>
      @endforeach
    </div>
  </div>

  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
