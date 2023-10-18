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
        Schema::create('positions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            $table->string('position_name')->nullable();
            $table->integer('openings')->default(1);
            $table->string('countries')->nullable();
            $table->string('states')->nullable();
            $table->string('city')->nullable();
            $table->string('locations')->default('india');
            $table->integer('postal_code')->nullable();
            $table->binary('job_description')->nullable();
            $table->string('skill_set')->nullable();
            $table->integer('min_year_exp')->nullable();
            $table->integer('max_year_exp')->nullable();
            $table->string('edu_qualification')->nullable();
            $table->string('specification')->nullable();
            $table->string('salary_type')->nullable();
            $table->string('pay_type')->nullable();
            $table->integer('min_salary')->nullable();
            $table->integer('max_salary')->nullable();
            $table->string('job_type')->nullable();
            $table->tinyInteger('is_remote_work')->default(0);
            $table->string('industry')->nullable();
            $table->string('gender')->nullable();
            $table->string('job_address')->nullable();
            $table->tinyInteger('created_by')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('person_contact')->nullable();
            $table->string('person_email')->nullable();
            $table->tinyInteger('is_local')->default(1);
            $table->integer('is_active')->default(1);
            $table->date('close_date')->nullable();
            $table->longText('jd_json')->nullable();
            $table->enum('status',array('active','hold', 'closed'))->default('active');
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
        Schema::dropIfExists('positions');
    }
};
