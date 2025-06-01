<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitizenTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citizen', function (Blueprint $table) {
            $table->id();
            $table->string('citizen_id')->unique(); // Add this column
            $table->string('first_name');
            $table->string('surname');
            $table->string('other_names')->nullable();
            $table->string('hometown');
            $table->date('date_of_birth');
            $table->text('address');
            $table->string('contact_info');
            $table->string('photo_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citizen');
    }
};
