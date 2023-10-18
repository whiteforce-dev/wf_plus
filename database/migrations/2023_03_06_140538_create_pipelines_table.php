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
        Schema::create('pipelines', function (Blueprint $table) {
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
            $table->date('joining_date')->nullable();
            $table->integer('offerd_ctc')->nullable();
            $table->integer('owner')->nullable();
            $table->integer('is_joined')->nullable();
            $table->string('cre_quarter')->nullable();
            $table->string('cre_quarter_year')->nullable();
            $table->string('join_quarter')->nullable();
            $table->string('join_quarter_year')->nullable();
            $table->string('batch_header_file')->nullable();
            $table->integer('matching_percentage')->nullable();
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
        Schema::dropIfExists('pipelines');
    }
};
