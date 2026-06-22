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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

$table->foreignId('intern_id')
      ->constrained()
      ->cascadeOnDelete();

$table->date('attendance_date');

$table->time('check_in')->nullable();

$table->time('check_out')->nullable();

$table->enum('status', [
    'present',
    'late',
    'permit',
    'sick',
    'absent'
])->default('present');

$table->text('reason')->nullable();

$table->string('selfie_photo')->nullable();

$table->string('supporting_document')->nullable();

$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
