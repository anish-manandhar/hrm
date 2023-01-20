<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_openings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('total_vacancies')->nullable();
            $table->string('application_deadline')->nullable();
            $table->string('experience')->nullable();
            $table->string('salary')->nullable();
            $table->text('skills')->nullable();
            $table->text('offerings')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();

            $table->unsignedBigInteger('designation_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_openings');
    }
};
