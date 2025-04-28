<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->string('company');
            $table->string('contact');
            $table->string('apply');
            $table->string('location');
            $table->boolean('is_admin')->default(false);
            $table->enum('status', ['pending', 'approved', 'declined', 'taken'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}; 