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
        Schema::create('response_candidates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('job_id')->nullable();
            $table->integer('shine_job_id')->nullable();
            $table->integer('ad_id')->nullable();
            $table->string('publish_to')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_mobile')->nullable();
            $table->string('company')->nullable();
            $table->string('location')->nullable();
            $table->string('total_work_experience')->nullable();
            $table->string('experience_in_current_job')->nullable();
            $table->string('functional_area')->nullable();
            $table->string('industry')->nullable();
            $table->string('title')->nullable();
            $table->string('salary')->nullable();
            $table->string('highest_edulevel')->nullable();
            $table->string('highest_edufield')->nullable();
            $table->string('highest_educollege')->nullable();
            $table->string('highest_edutype')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->longText('skills')->nullable();
            $table->string('preferred_locations')->nullable();
            $table->string('notice_period')->nullable();
            $table->string('curently_working')->nullable();
            $table->string('job_location')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('expacted_salary')->nullable();
            $table->string('adhar_number')->nullable();
            $table->string('resume')->nullable();
            $table->date('response_date')->nullable();
            $table->integer('is_mailed')->nullable();
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
        Schema::dropIfExists('response_candidates');
    }
};
