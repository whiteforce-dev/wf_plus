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
        Schema::create('calling_sheets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('created_by')->nullable();
            $table->integer('manager_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('candidate_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('position')->nullable();
            $table->string('status')->nullable();
            $table->string('reference')->nullable();
            $table->string('manager_remerk')->nullable();
            $table->integer('excel_id')->nullable();
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
        Schema::dropIfExists('calling_sheets');
    }
};