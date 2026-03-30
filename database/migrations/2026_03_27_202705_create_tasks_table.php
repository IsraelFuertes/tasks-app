<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {

            $table->uuid('id')->primary();

            
            $table->string('title', 200);
            $table->text('description')->nullable();

            
            $table->enum('status', ['pending','in_progress','completed'])
                  ->default('pending');

            
            $table->enum('priority', ['low','medium','high'])
                  ->default('medium');

            
            $table->date('due_date')->nullable();

            
            $table->string('assigned_email', 150)->nullable();

            
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};