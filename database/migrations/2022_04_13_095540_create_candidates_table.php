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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('alt_email')->nullable()->unique();
            $table->string('alt_phone')->nullable()->unique();
            $table->string('dob')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Others'])->nullable();
            $table->string('pan')->nullable();
            $table->string('citizenship')->nullable();
            $table->text('street_address')->nullable();
            $table->string('salary_expectation')->nullable();
            $table->boolean('shortlisted')->default(0);
            $table->enum('salary_period', ['Daily', 'Weekly', 'Monthly', 'Quarterly', 'Semi-Yearly', 'Yearly', 'Project Basis'])->default('Monthly');
            $table->enum('duty_type', ['Full-Time', 'Part-Time', 'Contractual', 'Other'])->default('Full-Time');
            $table->enum('marital_status', ['Single', 'Married', 'Divorced', 'Widowed', 'Other'])->default('Single');

            // Previous Organization Info
            $table->string('organization_name')->nullable();
            $table->string('organization_contact')->nullable();
            $table->string('organization_address')->nullable();
            $table->string('hr_name')->nullable();
            $table->string('hr_contact')->nullable();

            $table->unsignedBigInteger('job_opening_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('job_opening_id')->references('id')->on('job_openings')->onDelete('SET NULL')->onUpdate('CASCADE');
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
        Schema::dropIfExists('candidates');
    }
};
