document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
    // Admin form submission
    const adminForm = document.getElementById('adminForm');
    if (adminForm) {
      adminForm.addEventListener('submit', function (e) {
        e.preventDefault();
        submitJob(adminForm, true);
      });
    }
  
    // Volunteer form submission
    const volunteerForm = document.getElementById('volunteerForm');
    if (volunteerForm) {
      volunteerForm.addEventListener('submit', function (e) {
        e.preventDefault();
        submitJob(volunteerForm, false);
      });
    }
  
    function submitJob(form, isAdmin) {
      const data = {
        role: form.querySelector('input[placeholder="Role"]').value,
        company: form.querySelector('input[placeholder="Company"]').value,
        contact: form.querySelector('input[placeholder="Contact Person"]').value,
        apply: form.querySelector('input[placeholder^="Where to Apply"]').value,
        location: form.querySelector('input[placeholder="Location"]').value,
        is_admin: isAdmin,
      };
  
      fetch('/jobs', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify(data),
      })
        .then((response) => {
          if (!response.ok) return response.json().then(err => Promise.reject(err));
          return response.json();
        })
        .then((data) => {
          alert(data.message || 'Job submitted successfully!');
          form.reset();
          location.reload();
        })
        .catch((error) => {
          console.error('Submission Error:', error);
          alert('Failed to submit job.');
        });
    }
  });
  
  // Make job-related functions globally available
  function approveJob(jobId, button) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
    fetch(`/jobs/${jobId}/approve`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
      },
    })
      .then((res) => res.json())
      .then((data) => {
        alert(data.message || 'Job approved!');
        button.closest('.job-post').remove();
      })
      .catch((err) => {
        console.error('Approve Error:', err);
        alert('Failed to approve job.');
      });
  }
  
  function declineJob(jobId, button) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
    fetch(`/jobs/${jobId}/decline`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
      },
    })
      .then((res) => res.json())
      .then((data) => {
        alert(data.message || 'Job declined!');
        button.closest('.job-post').remove();
      })
      .catch((err) => {
        console.error('Decline Error:', err);
        alert('Failed to decline job.');
      });
  }
  
  function markAsTaken(jobId, button) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
    fetch(`/jobs/${jobId}/taken`, {
      method: 'POST', // You are using POST in routes/web.php
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
    })
      .then((res) => res.json())
      .then((data) => {
        alert(data.message || 'Job marked as taken!');
        button.parentElement.innerHTML += `<p><strong>Status:</strong> Taken</p>`;
        button.remove();
      })
      .catch((err) => {
        console.error('Taken Error:', err);
        alert('Failed to mark job as taken.');
      });
  }
  