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
        Schema::create('shine_cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('city_grouping_id')->nullable();
            $table->string('city_grouping_desc')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('city_desc')->nullable();
            $table->string('id_nosql')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('parent_sort_order')->nullable();
            $table->integer('child_sort_order')->nullable();
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
        Schema::dropIfExists('shine_cities');
    }
};