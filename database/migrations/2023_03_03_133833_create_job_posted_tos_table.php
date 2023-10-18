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
        Schema::create('job_posted_tos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('reference_no')->nullable();
            $table->integer('job_id')->nullable();
            $table->string('publish_to')->nullable();
            $table->string('status')->nullable();
            $table->binary('response')->nullable();
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
        Schema::dropIfExists('job_posted_tos');
    }
};
