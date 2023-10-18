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
        Schema::create('ziprecruiter_job', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_name')->nullable();
            $table->string('experience')->nullable();
            $table->string('education')->nullable();
            $table->string('pay_type')->nullable();
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
        Schema::dropIfExists('ziprecruiter_job');
    }
};
