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
        Schema::create('shine_degree_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('study_field_grouping_id')->nullable();
            $table->string('study_field_grouping_desc')->nullable();
            $table->integer('study_id')->nullable();
            $table->string('study_desc')->nullable();
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
        Schema::dropIfExists('shine_degree_levels');
    }
};
