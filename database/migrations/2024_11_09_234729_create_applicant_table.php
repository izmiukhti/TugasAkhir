<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('applicant', function (Blueprint $table) {
            $table->string('id')->primary(); // Primary key
            $table->uuid('id_opportunity'); // Sesuaikan tipe data dengan UUID
            $table->string('fullname');
            $table->string('email');
            $table->string('phone_number');
            $table->unsignedBigInteger('gender_id'); // Foreign key for gender
            $table->date('birth_date');
            $table->string('domicile_address');
            $table->unsignedBigInteger('religion_id'); // Foreign key for religion
            $table->unsignedBigInteger('marital_id'); // Foreign key for marital status
            $table->unsignedBigInteger('education_id'); // Foreign key for education level
            $table->string('education_institution');
            $table->string('majority');
            $table->string('gpa');
            $table->string('graduate_status'); // lulus/belum
            $table->string('graduate_year');
            $table->string('information_from'); // darimana mendapatkan informasi pekerjaan
            $table->string('portfolio_link');
            $table->string('cv_file');
            $table->timestamps();
        
            // Definisikan foreign keys
            $table->foreign('id_opportunity')
                  ->references('id')
                  ->on('opportunities')
                  ->onDelete('cascade');
                  
            $table->foreign('gender_id')
                  ->references('id')
                  ->on('genders')
                  ->onDelete('cascade');
        
            $table->foreign('religion_id')
                  ->references('id')
                  ->on('religions')
                  ->onDelete('cascade');
                  
            $table->foreign('marital_id')
                  ->references('id')
                  ->on('maritals')
                  ->onDelete('cascade');
        
            $table->foreign('education_id')
                  ->references('id')
                  ->on('education')
                  ->onDelete('cascade');
        });
    }        

    public function down()
    {
        Schema::dropIfExists('applicant');
    }
};