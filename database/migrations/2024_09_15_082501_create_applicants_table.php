<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('opportunity_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('gender_id');
            $table->date('birth_date');
            $table->string('domicile_address');
            $table->string('religion_id');
            $table->string('marital_id');
            $table->string('education_id');
            $table->string('education_institution');
            $table->string('majority');
            $table->string('gpa');
            $table->string('graduate_status');
            $table->year('graduate_year');
            $table->string('information_from');
            $table->string('portfolio_link')->nullable();
            $table->string('cv_file');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
};
