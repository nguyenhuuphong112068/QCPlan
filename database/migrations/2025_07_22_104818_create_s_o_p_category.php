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
        Schema::create('unit', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name',20)->unique(); 
            $table->string('prepareBy', 100);
            $table->boolean ('active')->default(true);
            $table->timestamps();
        });

        Schema::create('SOP_Category', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name',255); 
            $table->string('prepareBy', 100);
            $table->boolean ('active')->default(true);
            $table->timestamps();
        });

        Schema::create('Testing_Item', function (Blueprint $table) {
            $table->id();
            $table->string('SOP_Category_code');
            $table->foreign('SOP_Category_code')->references('code')->on('SOP_Category');
            
            $table->string('name',100); 

            $table->float('sample_Amout'); 
            $table->string('unit',20); 
            $table->foreign('unit')->references('code')->on('unit');

            $table->string('prepareBy', 100);
            $table->boolean ('active')->default(true);
            $table->timestamps();
        });




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Testing_Item', function (Blueprint $table) {
            Schema::dropIfExists('Testing_Item');
        });
        Schema::table('SOP_Category', function (Blueprint $table) {
            Schema::dropIfExists('SOP_Category');
        });
        Schema::table('unit', function (Blueprint $table) {
            Schema::dropIfExists('unit');
        });
    }
};
