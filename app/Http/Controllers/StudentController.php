<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class StudentController extends Controller
{
    public function dashboard()
    {
        $jobs = Job::where('status', 'approved')->latest()->get();
        return view('student_dashboard', compact('jobs'));
    }
}
