<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('alt_email')->nullable()->unique();
            $table->string('alt_phone')->nullable()->unique();
            $table->string('otp')->nullable();
            $table->string('otp_created_at')->nullable();
            $table->string('dob')->nullable();
            $table->string('joining_date')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Others'])->nullable();
            $table->string('pan')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('uploaded_documents')->nullable();

//            Address Info
            $table->string('permanent_address')->nullable();
            $table->string('temporary_address')->nullable();
            $table->string('permanent_address_2')->nullable();
            $table->string('temporary_address_2')->nullable();
            $table->string('permanent_city')->nullable();
            $table->string('temporary_city')->nullable();
            $table->unsignedBigInteger('permanent_country')->nullable();
            $table->unsignedBigInteger('temporary_country')->nullable();
            $table->string('permanent_postal_code')->nullable();
            $table->string('temporary_postal_code')->nullable();

//            Notice Period Info
            $table->string('notice_period_start_date')->nullable();
            $table->string('notice_period_end_date')->nullable();
            $table->string('notice_period_remarks')->nullable();
            $table->boolean('notice_period')->default(0);
            $table->boolean('ex_employee')->default(0);


            $table->text('disabling_remarks')->nullable();

//            Contract Info
            $table->string('contract_start_date')->nullable();
            $table->string('contract_end_date')->nullable();
            $table->string('contract_files')->nullable();

            $table->string('salary')->nullable();
            $table->enum('salary_period', ['Daily', 'Weekly', 'Monthly', 'Quarterly', 'Semi-Yearly', 'Yearly', 'Project Basis'])->default('Monthly');
            $table->enum('duty_type', ['Full-Time', 'Part-Time', 'Contractual', 'Other'])->default('Full-Time');
            $table->enum('marital_status', ['Single', 'Married', 'Divorced', 'Widowed', 'Other'])->default('Single');
            $table->string('blood_group')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('father_contact')->nullable();
            $table->string('mother_contact')->nullable();

            // Previous Organization Info
            $table->string('organization_name')->nullable();
            $table->string('organization_contact')->nullable();
            $table->string('organization_address')->nullable();
            $table->string('hr_name')->nullable();
            $table->string('hr_contact')->nullable();
            $table->string('organization_document')->nullable();

            // Emergency Contact Person Info
            $table->string('emergency_contact_person_name')->nullable();
            $table->string('emergency_contact_person_contact')->nullable();
            $table->string('emergency_contact_person_address')->nullable();
            $table->string('emergency_contact_person_relation')->nullable();

            // Bank Details
            $table->string('bank_name')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->text('bank_remarks')->nullable();

            // Bank Details
            $table->string('college_name')->nullable();
            $table->string('college_address')->nullable();
            $table->string('completion_year')->nullable();
            $table->string('highest_degree_name')->nullable();
            $table->text('degree_document')->nullable();


            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('permanent_country')->references('id')->on('countries')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('temporary_country')->references('id')->on('countries')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
