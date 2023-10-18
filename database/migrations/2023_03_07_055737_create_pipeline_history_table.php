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
        Schema::create('pipeline_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('position_id')->nullable();
            $table->integer('stage_id')->nullable();
            $table->integer('candidate_id')->nullable();
            $table->string('status')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('jd_count')->nullable();
            $table->date('interview_date')->nullable();
            $table->string('interview_time_from')->nullable();
            $table->string('interview_time_to')->nullable();
            $table->string('interview_venue')->nullable();
            $table->string('interview_stage')->nullable();
            $table->string('history_type')->nullable();
            $table->date('joining_date')->nullable();
            $table->integer('offerd_ctc')->nullable();
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
        Schema::dropIfExists('pipeline_history');
    }
};
