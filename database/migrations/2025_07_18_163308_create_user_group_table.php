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
        Schema::create('userGroup', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->unique();
            $table->boolean ('active')->default(true);
            $table->string('prepareBy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('userGroup', function (Blueprint $table) {
            Schema::dropIfExists('userGroup');
        });
    }
};
