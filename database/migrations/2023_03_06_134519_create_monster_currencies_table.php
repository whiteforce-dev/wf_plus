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
        Schema::create('monster_currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('currency_code')->nullable();
            $table->string('currency_name')->nullable();
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
        Schema::dropIfExists('monster_currencies');
    }
};
