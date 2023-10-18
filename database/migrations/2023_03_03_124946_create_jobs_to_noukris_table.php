<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_to_noukris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('job_id')->nullable();
            $table->string('UG_Qualifications')->nullable();
            $table->string('UG_Specializations')->nullable();
            $table->string('PG_Qualifications')->nullable();
            $table->string('PG_Specializations')->nullable();
            $table->string('Functional_Area')->nullable();
            $table->string('Functional_role')->nullable();
            $table->string('Industry_Mapping')->nullable();
            $table->string('noukri_Country')->nullable();
            $table->string('noukri_City')->nullable();
            $table->string('Minimum_Experience')->nullable();
            $table->string('Maximum_Experience')->nullable();
            $table->string('Minimum_Salary')->nullable();
            $table->string('Maximum_Salary')->nullable();
            $table->string('noukri_job_description')->nullable();
            $table->string('naukri_job_type')->nullable();
            $table->enum('software_category',array('onrole','offrole', 'franchise-onrole', 'franchise-offrole'))->nullable();
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
        Schema::dropIfExists('jobs_to_noukris');
    }
};
