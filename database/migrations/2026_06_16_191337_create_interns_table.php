<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('interns', function (Blueprint $table) {
           $table->id();
           $table->string('intern_code')->unique();
           $table->string('name');
           $table->string('email')->unique();
           $table->string('password');
           
           $table->string('phone')->nullable();
           
           $table->string('institution')->nullable();
           $table->string('major')->nullable();
           
           $table->string('division')->nullable();
           $table->string('mentor')->nullable();
           
           $table->date('start_date')->nullable();
           $table->date('end_date')->nullable();

$table->enum('status', ['active','finished'])
      ->default('active');

$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interns');
    }
};
