<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    public function run() 
    {
        \App\Models\Job::create([
            'role' => 'Developer',
            'company' => 'Capstone Co.',
            'contact' => 'capstone@example.com',
            'apply' => 'http://apply.example.com',
            'location' => 'Remote',
            'is_admin' => true,
            'status' => 'approved'
        ]);
    }
}
