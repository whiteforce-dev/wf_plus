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
        Schema::create('shines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('job_id')->nullable();
            $table->integer('city_grouping_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('industry_id')->nullable();
            $table->integer('experience_lookup_id')->nullable();
            $table->integer('salary_id')->nullable();
            $table->integer('study_field_grouping_id')->nullable();
            $table->integer('study_id')->nullable(); $table->integer('functional_area_id')->nullable();
            $table->integer('min_experience_id')->nullable();
            $table->integer('max_experience_id')->nullable();
            $table->integer('min_salary_id')->nullable();
            $table->integer('max_salary_id')->nullable();
            $table->longText('response')->nullable();
            $table->integer('shine_job_id')->nullable();
            $table->longText('response_history')->nullable();
            $table->integer('update_count')->nullable();
            $table->tinyInteger('is_sent')->nullable();
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
        Schema::dropIfExists('shines');
    }
};
