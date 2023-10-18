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
        Schema::create('jobs_to_timesjobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('job_id')->nullable();
            $table->string('times_min_year_exp')->nullable();
            $table->string('times_max_year_exp')->nullable();
            $table->string('times_location')->nullable();
            $table->string('times_location_others')->nullable();
            $table->string('times_currency')->nullable();
            $table->string('times_show_salary')->nullable();
            $table->string('times_min_salary_lakh')->nullable();$table->string('times_min_salary_thousand')->nullable();
            $table->string('times_max_salary_lakh')->nullable();
            $table->string('times_max_salary_thousand')->nullable();
            $table->string('times_industry')->nullable();
            $table->string('times_industry_others')->nullable();
            $table->string('times_farea')->nullable();
            $table->string('times_area_of_spec')->nullable();
            $table->string('times_fa_roles')->nullable();
            $table->string('times_farea_others')->nullable();
            $table->string('times_graduation')->nullable();
            $table->string('times_graduation_course')->nullable();
            $table->string('times_graduation_specialisation')->nullable();
            $table->string('times_post_graduation')->nullable();
            $table->string('times_post_graduation_course')->nullable();
            $table->string('times_post_graduation_specialisation')->nullable();
            $table->binary('times_job_description')->nullable();
            $table->integer('response_id')->nullable();
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
        Schema::dropIfExists('jobs_to_timesjobs');
    }
};
