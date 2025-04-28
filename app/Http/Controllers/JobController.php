<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class JobController extends Controller
{
    public function index()
    {
        try {
            $approvedJobs = Job::where('status', 'approved')->get();
            $pendingJobs = Job::where('status', 'pending')->get();

            return view('jobs', compact('approvedJobs', 'pendingJobs'));
        } catch (\Exception $e) {
            Log::error('Error fetching jobs: ' . $e->getMessage());
            return view('jobs', ['approvedJobs' => [], 'pendingJobs' => []])
                ->with('error', 'Error loading jobs. Please try again later.');
        }
    }

    public function store(Request $request)
    {
        try {
            Log::info('Job Submission Triggered', $request->all());

            $validated = $request->validate([
                'role' => 'required|string',
                'company' => 'required|string',
                'contact' => 'required|string',
                'apply' => 'required|string',
                'location' => 'required|string',
                'is_admin' => 'required|boolean',
            ]);

            $status = $validated['is_admin'] ? 'approved' : 'pending';

            $job = Job::create([
                'role' => $validated['role'],
                'company' => $validated['company'],
                'contact' => $validated['contact'],
                'apply' => $validated['apply'],
                'location' => $validated['location'],
                'is_admin' => $validated['is_admin'],
                'status' => $status,
            ]);

            Log::info('Job Saved Successfully', ['id' => $job->id, 'status' => $job->status]);

            return response()->json(['message' => 'Job submitted successfully']);
        } catch (\Exception $e) {
            Log::error('Error storing job: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to submit job. Please try again.'], 500);
        }
    }

    public function approve($id)
    {
        try {
            $job = Job::findOrFail($id);
            $job->status = 'approved';
            $job->save();

            Log::info('Job Approved', ['id' => $id]);
            return response()->json(['message' => 'Job approved']);
        } catch (ModelNotFoundException $e) {
            Log::error('Job not found for approval: ' . $id);
            return response()->json(['error' => 'Job not found'], 404);
        } catch (\Exception $e) {
            Log::error('Error approving job: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to approve job'], 500);
        }
    }

    public function decline($id)
    {
        try {
            $job = Job::findOrFail($id);
            $job->status = 'declined';
            $job->save();

            Log::info('Job Declined', ['id' => $id]);
            return response()->json(['message' => 'Job declined']);
        } catch (ModelNotFoundException $e) {
            Log::error('Job not found for decline: ' . $id);
            return response()->json(['error' => 'Job not found'], 404);
        } catch (\Exception $e) {
            Log::error('Error declining job: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to decline job'], 500);
        }
    }

    public function markAsTaken($id)
    {
        try {
            $job = Job::findOrFail($id);
            $job->status = 'taken';
            $job->save();

            Log::info('Job Marked as Taken', ['id' => $id]);
            return response()->json(['message' => 'Job marked as taken']);
        } catch (ModelNotFoundException $e) {
            Log::error('Job not found for marking as taken: ' . $id);
            return response()->json(['error' => 'Job not found'], 404);
        } catch (\Exception $e) {
            Log::error('Error marking job as taken: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to mark job as taken'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $job = Job::findOrFail($id);

            if ($request->has('status')) {
                $job->status = $request->status;
            }

            $job->save();

            Log::info('Job Updated', ['id' => $id, 'status' => $job->status]);
            return response()->json(['message' => 'Job updated']);
        } catch (ModelNotFoundException $e) {
            Log::error('Job not found for update: ' . $id);
            return response()->json(['error' => 'Job not found'], 404);
        } catch (\Exception $e) {
            Log::error('Error updating job: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update job'], 500);
        }
    }
}
