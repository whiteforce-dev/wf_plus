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
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bd_id')->nullable();
            $table->tinyInteger('is_added_by_bd')->default(0);
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->integer('created_by')->nullable();
            $table->tinyInteger('is_active')->default(1)->nullable();
            $table->float('percentage', 5,2)->nullable();
            $table->string('type')->nullable();
            $table->integer('alloted_to')->nullable();
            $table->string('alloted_by')->nullable();
            $table->string('aggrement')->nullable();
            $table->date('alloted_date')->nullable();
            $table->binary('about')->nullable();
            $table->tinyInteger('is_local')->default(1)->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('location')->nullable();
            $table->enum('sub_type',array('temp','one-time','IT'))->nullable();
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
        Schema::dropIfExists('clients');
    }
};