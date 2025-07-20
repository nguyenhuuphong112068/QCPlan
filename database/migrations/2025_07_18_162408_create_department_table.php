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
        Schema::create('deparments', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->unique();
            $table->string('shortName',20)->unique();
            $table->boolean ('active');
            $table->string('prepareBy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deparments', function (Blueprint $table) {
            Schema::dropIfExists('deparments');
        });
    }
};
