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
        Schema::create('candidates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('experience')->nullable();
            $table->string('current_company')->nullable();
            $table->string('current_title')->nullable();
            $table->string('current_location')->nullable();
            $table->string('preferred_location')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('highest_qualification')->nullable();
            $table->string('highest_qualification_type')->nullable();
            $table->string('highest_qualification_year')->nullable();
            $table->string('total_experience')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('is_relocate')->nullable();
            $table->string('is_local')->nullable();
            $table->string('salary_type')->nullable();
            $table->string('pay_type')->nullable();
            $table->string('current_salary')->nullable();
            $table->string('expected_salary')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('industry')->nullable();
            $table->string('languages')->nullable();
            $table->string('notice_period')->nullable();
            $table->string('gender')->nullable();
            $table->string('communication')->nullable();
            $table->longText('skills')->nullable();
            $table->date('last_working_day')->nullable();
            $table->string('source')->nullable();
            $table->string('resume_file')->nullable();
            $table->string('last_company')->nullable();
            $table->string('last_ctc')->nullable();
            $table->string('passbook')->nullable();
            $table->string('pan_card')->nullable();
            $table->string('aadhar_card')->nullable();
            $table->string('uan')->nullable();
            $table->string('invoice')->nullable();
            $table->string('payment')->nullable();
            $table->string('incentive')->nullable();
            $table->string('incentive_amount')->nullable();
            $table->string('offer_letter')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->integer('created_by')->nullable();
            $table->string('rating')->nullable();
            $table->longText('resume_parser_json')->nullable();
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
        Schema::dropIfExists('candidates');
    }
};
