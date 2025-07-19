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
        Schema::create('user_Management', function (Blueprint $table) {
            $table->id();
            $table->string('userName',10)->unique();
            $table->string('userGroup', 30);
            $table->string('passWord', 255);
            $table->string('fullName', 20);
            $table->string('deparment', 500);
            $table->string('groupName', 50);
            $table->string('groupCode', 5);
            $table->string('mail', 255)->nullable()->unique();

            $table->boolean('isLocked')->default(false);
            
            $table->boolean('isActive')->default(true);

            $table->date('changePWdate');

            $table->string('hisPW_1', 20)->nullable();
            $table->string('hisPW_2', 20)->nullable();
            $table->string('hisPW_3', 20)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_Management');
    }
};
