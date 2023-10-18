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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('job_id')->default(0);
            $table->integer('linkedin')->default(0);
            $table->integer('facebook')->default(0);
            $table->integer('facebook_happiest')->default(0);
            $table->integer('clickindia')->default(0);
            $table->integer('shine')->default(0);
            $table->integer('monster')->default(0);
            $table->integer('jobisjob')->default(0);
            $table->integer('postjobfree')->default(0);
            $table->integer('jora')->default(0);
            $table->integer('careerglobal')->default(0);
            $table->integer('careerjet')->default(0);
            $table->integer('jooble')->default(0);
            $table->integer('ziprecruiter')->default(0);
            $table->integer('noukri')->default(0);
            $table->integer('indeed')->default(0);
            $table->integer('timesjobs')->default(0);
            $table->integer('google')->default(0);
            $table->integer('my_job_helper')->default(0);
            $table->integer('job_vertise')->default(0);
            $table->integer('whatsjob')->default(0);
            $table->integer('drjobs')->default(0);
            $table->integer('adzuna')->default(0);
            $table->integer('CVLibaray')->default(0);
            $table->integer('adzunausa')->default(0);
            $table->integer('whatsjobusa')->default(0);
            $table->integer('timesascent')->default(0);
            $table->integer('tanqeeb')->default(0);
            $table->integer('linkedin_paid')->default(0);
            $table->integer('happiest')->default(0);
            $table->integer('whiteforce')->default(0);
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
        Schema::dropIfExists('job_postings');
    }
};
