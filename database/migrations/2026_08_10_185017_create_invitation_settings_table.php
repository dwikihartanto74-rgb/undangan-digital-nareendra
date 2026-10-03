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
        Schema::create('invitation_settings', function (Blueprint $table) {
            $table->id();
            $table->string('baby_name')->nullable();
            $table->string('baby_nickname')->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('birth_order')->nullable();
            $table->decimal('weight', 5, 2)->nullable(); // e.g. 3.50 kg
            $table->decimal('height', 5, 2)->nullable(); // e.g. 50.00 cm
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->date('event_date')->nullable();
            $table->time('event_time')->nullable();
            $table->string('venue')->nullable();
            $table->text('address')->nullable();
            $table->text('maps_url')->nullable();
            $table->dateTime('countdown_datetime')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('baby_photo')->nullable();
            $table->string('music_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitation_settings');
    }
};
