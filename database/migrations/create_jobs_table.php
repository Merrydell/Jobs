<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->string('company');
            $table->string('contact');
            $table->string('apply');
            $table->string('location');
            $table->enum('status', ['approved', 'pending', 'declined', 'taken'])->default('pending');
            $table->boolean('is_admin')->default(false); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
