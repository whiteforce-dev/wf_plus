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
        Schema::create('call_audit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dep')->nullable();
            $table->integer('manager_id')->nullable();
            $table->integer('recuirter_id')->nullable();
            $table->string('intrcom_no')->nullable();
            $table->date('alloted_date')->nullable();
            $table->string('no_call')->nullable();
            $table->string('rating')->nullable();
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('call_audit');
    }
};
