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
        Schema::create('interview_user', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_id');
            $table->unsignedBigInteger('decision_id');
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->dateTime('event_date');
            $table->string('location');
            $table->integer('score')->default(0);
            $table->string('notes')->default('-');
            $table->boolean('notification_sent')->default(false);
            $table->boolean('info_sent')->default(false);
            $table->timestamps();

            $table->foreign('applicant_id')
                  ->references('id')
                  ->on('applicant')
                  ->onDelete('cascade');

            $table->foreign('decision_id')
                  ->references('id')
                  ->on('decisions')
                  ->onDelete('cascade');

            $table->foreign('staff_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interview_user');
    }
};