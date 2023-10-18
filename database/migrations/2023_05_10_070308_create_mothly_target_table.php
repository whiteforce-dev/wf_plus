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
        Schema::create('mothly_target', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('month_target')->nullable();
            $table->integer('target')->nullable();
            $table->integer('complete')->nullable();
            $table->integer('remaining')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('mothly_target');
    }
};
