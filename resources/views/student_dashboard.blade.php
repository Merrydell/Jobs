<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Job Opportunities</title>
    <link rel="stylesheet" href="{{ asset('css/student.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Add Heroicons -->
    <script src="https://unpkg.com/@heroicons/react@2.0.18/24/outline/esm/index.js"></script>
    <style>
        :root {
            --primary: #0A4D68;
            --secondary: #FFFFFF;
            --accent: #05BFDB;
            --body-bg: #0A4D68;
        }
        body {
            background-color: var(--body-bg);
        }
        .bg-primary { background-color: var(--primary); }
        .bg-secondary { background-color: var(--secondary); }
        .bg-accent { background-color: var(--accent); }
        .text-primary { color: var(--primary); }
        .text-secondary { color: var(--secondary); }
        .text-accent { color: var(--accent); }
        .border-primary { border-color: var(--primary); }
        .border-secondary { border-color: var(--secondary); }
        .border-accent { border-color: var(--accent); }
        
        .job-card {
            transition: all 0.3s ease;
            border-left: 4px solid var(--accent);
            background-color: white;
        }
        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--accent);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        .nav-link:hover::after {
            transform: scaleX(1);
        }

        .welcome-section {
            background: #FFFFFF;
            color: #000000;
        }

        /* Icon Styles */
        .job-card svg {
            color: var(--primary);
            flex-shrink: 0;
        }
        .job-card .text-gray-700 {
            display: flex;
            align-items: center;
        }
        .job-card .text-gray-700 svg {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-primary shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="/" class="text-white text-xl font-bold">Hauz Hayag</a>
                        </div>
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <a href="/student-dashboard" class="nav-link text-white inline-flex items-center px-1 pt-1 text-sm font-medium">
                                Student Dashboard
                            </a>
                        </div>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-white hover:text-accent px-3 py-2 rounded-md text-sm font-medium">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Welcome Section -->
                <div class="welcome-section rounded-lg shadow-md p-6 mb-8">
                    <div class="welcome text-center">
                        <h1 class="text-3xl font-bold text-black mb-2">Welcome, {{ Auth::user()->name ?? 'Student' }}!</h1>
                        <p class="text-black text-lg">Here are the latest job opportunities curated for you</p>
                    </div>
                </div>

                <!-- Job Listings -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($jobs as $job)
                        <div class="job-card rounded-lg shadow-md p-6">
                            <h3 class="text-xl font-semibold text-primary mb-3">{{ $job->role }}</h3>
                            <div class="space-y-2">
                                <p class="flex items-center text-gray-700">
                                    <svg class="w-5 h-5 mr-2 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    {{ $job->company }}
                                </p>
                                <p class="flex items-center text-gray-700">
                                    <svg class="w-5 h-5 mr-2 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $job->location }}
                                </p>
                                <p class="flex items-center text-gray-700">
                                    <svg class="w-5 h-5 mr-2 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $job->contact }}
                                </p>
                                <p class="flex items-center text-gray-700">
                                    <svg class="w-5 h-5 mr-2 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    {{ $job->apply }}
                                </p>
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <p class="text-sm text-gray-500">
                                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Posted {{ $job->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>
