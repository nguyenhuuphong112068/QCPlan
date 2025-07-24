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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('impored_id'); // Tham chiếu bảng mẫu chờ kiểm
            $table->unsignedBigInteger('instrument_id'); // Thiết bị kiểm nghiệm
            $table->timestamp('start_time'); // Bắt đầu kiểm
            $table->timestamp('end_time');   // Kết thúc kiểm
            $table->string('note')->nullable();

            // Foreign Keys
            $table->foreign('sample_id')->references('id')->on('samples');
            $table->foreign('instrument_id')->references('id')->on('instruments');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
