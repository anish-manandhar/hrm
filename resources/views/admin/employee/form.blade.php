<x-app-layout>
    @section('page_title', @$page_title)
    @push('css')
    @endpush
    @push('js')
        <script>
            $('#hasWorked').click(function () {
                if ($(this).prop("checked") === true) {
                    $('#previousOrganizationDetails').removeClass('d-none');
                } else if ($(this).prop("checked") === false) {
                    $('#previousOrganizationDetails').addClass('d-none');
                }
            });
            $('#same_per_temp').click(function () {
                if ($(this).prop("checked") === true) {
                    $('#permanent_address').val($('#temporary_address').val());
                    $('#permanent_address_2').val($('#temporary_address_2').val());
                    $('#permanent_city').val($('#temporary_city').val());
                    $('#permanent_country').val($('#temporary_country').val());
                    $('#permanent_postal_code').val($('#temporary_postal_code').val());
                } else if ($(this).prop("checked") === false) {
                    $('#permanent_address').val('');
                    $('#permanent_address_2').val('');
                    $('#permanent_city').val('');
                    $('#permanent_country').val('');
                    $('#permanent_postal_code').val('');
                }
            });
        </script>
    @endpush
    @include('admin.employee.validation')
    <div class="container-fluid">
        <div class="row">
            @if (isset($old_info))
                {{ Form::open(['url' => route('employee.update', $old_info->id), 'files' => true, 'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
                @method('put')
            @else
                {{ Form::open(['url' => route('employee.store'), 'files' => true, 'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
            @endif
            <div class="col-md-6">
                {{--Basic Info--}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Basic Info</h5>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-12">
                            {{ Form::label('name', 'Name: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('name', @$old_info->name ?? old('name'), ['class' => 'form-control', 'required' => true]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('email', 'Email: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::email('email', @$old_info->email ?? old('email'), ['class' => 'form-control', 'required' => true]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('alt_email', 'Alternative Email:', ['class' => 'form-label mt-4']) }}
                            {{ Form::email('alt_email', @$old_info->employee->alt_email ?? old('alt_email'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('phone', 'Phone: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::number('phone', @$old_info->phone ?? old('phone'), ['class' => 'form-control', 'required' => true]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('alt_phone', 'Alternative Phone:', ['class' => 'form-label mt-4']) }}
                            {{ Form::number('alt_phone', @$old_info->employee->alt_phone ?? old('alt_phone'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('father_name', 'Father Name:', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('father_name', @$old_info->employee->father_name ?? old('father_name'), ['class' => 'form-control', 'required' => true]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('father_contact', 'Father Contact:', ['class' => 'form-label mt-4']) }}
                            {{ Form::number('father_contact', @$old_info->employee->father_contact ?? old('father_contact'), ['class' => 'form-control', 'required' => true]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('mother_name', 'Mother Name:', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('mother_name', @$old_info->employee->mother_name ?? old('mother_name'), ['class' => 'form-control', 'required' => true]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('mother_contact', 'Mother Contact:', ['class' => 'form-label mt-4']) }}
                            {{ Form::number('mother_contact', @$old_info->employee->mother_contact ?? old('mother_contact'), ['class' => 'form-control', 'required' => true]) }}
                        </div>
                    </div>
                </div>
                {{--Address Info--}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Address Info</h5>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-6">
                            {{ Form::label('temporary_address', 'Temporary Address: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('temporary_address', @$old_info->employee->temporary_address ?? old('temporary_address'), ['id' => 'temporary_address','class' => 'form-control', 'required' => true, 'placeholder' => 'Ex: Street Address']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('temporary_address_2', 'Temporary Address (Line 2):', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('temporary_address_2', @$old_info->employee->temporary_address_2 ?? old('temporary_address_2'), ['id' => 'temporary_address_2','class' => 'form-control', 'placeholder' => 'Ex: Muncipality or VDC']) }}
                        </div>
                        <div class="col-md-4">
                            {{ Form::label('temporary_city', 'Temporary Address City:', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('temporary_city', @$old_info->employee->temporary_city ?? old('temporary_city'), ['id' => 'temporary_city','class' => 'form-control']) }}
                        </div>
                        <div class="col-md-4">
                            {{ Form::label('temporary_country', 'Temporary Address Country:', ['class' => 'form-label mt-4']) }}
                            {{ Form::select('temporary_country', \App\Models\Country::pluck('name', 'id'), @$old_info->employee->temporary_country ?? get_setting('default_country'), ['id' => 'temporary_country','class' => 'form-select select2']) }}
                        </div>
                        <div class="col-md-4">
                            {{ Form::label('temporary_postal_code', 'Temporary Address Postal Code:', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('temporary_postal_code', @$old_info->employee->temporary_postal_code ?? old('temporary_postal_code'), ['id' => 'temporary_postal_code','class' => 'form-control']) }}
                        </div>
                        <div class="col-md-12">
                            {{ Form::label('same_per_temp', 'Same as Temporary Address:', ['class' => 'form-label mt-4']) }}
                            <input type="checkbox" id="same_per_temp">
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('permanent_address', 'Permanent Address: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('permanent_address', @$old_info->employee->permanent_address ?? old('permanent_address'), ['id' => 'permanent_address','class' => 'form-control', 'required' => true, 'placeholder' => 'Ex: Street Address']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('permanent_address_2', 'Permanent Address (Line 2):', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('permanent_address_2', @$old_info->employee->permanent_address_2 ?? old('permanent_address_2'), ['id' => 'permanent_address_2','class' => 'form-control', 'placeholder' => 'Ex: Muncipality or VDC']) }}
                        </div>
                        <div class="col-md-4">
                            {{ Form::label('permanent_city', 'Permanent Address City:', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('permanent_city', @$old_info->employee->permanent_city ?? old('permanent_city'), ['id' => 'permanent_city','class' => 'form-control']) }}
                        </div>
                        <div class="col-md-4">
                            {{ Form::label('permanent_country', 'Permanent Address Country:', ['class' => 'form-label mt-4']) }}
                            {{ Form::select('permanent_country', \App\Models\Country::pluck('name', 'id'), @$old_info->employee->permanent_country ?? get_setting('default_country'), ['id' => 'permanent_country','class' => 'form-select select2']) }}
                        </div>
                        <div class="col-md-4">
                            {{ Form::label('permanent_postal_code', 'Permanent Address Postal Code:', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('permanent_postal_code', @$old_info->employee->permanent_postal_code ?? old('permanent_postal_code'), ['id' => 'permanent_postal_code','class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                {{--Official Info--}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Official Info</h5>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-6">
                            {{ Form::label('department_id', 'Select Department: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::select('department_id', \App\Models\Department::where('status', 1)->pluck('title', 'id'), @$old_info->employee->department_id ?? old('department_id'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('designation_id', 'Select Designation: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::select('designation_id', \App\Models\Designation::where('status', 1)->pluck('title', 'id'), @$old_info->employee->designation_id ?? old('designation_id'), ['class' => 'form-control']) }}
                        </div>
                        @if(get_setting('division_enabled'))
                            <div class="col-md-6">
                                {{ Form::label('division_id', 'Select Division:', ['class' => 'form-label mt-4']) }}
                                {{ Form::select('division_id', \App\Models\Division::where('status', 1)->pluck('title', 'id'), @$old_info->employee->division_id ?? old('division_id'), ['class' => 'form-control']) }}
                            </div>
                        @endif
                        <div class="col-md-6">
                            {{ Form::label('joining_date', 'Date of Joining: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::date('joining_date',  @$old_info->employee->joining_date ?? old('joining_date'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('salary', 'Salary: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::number('salary',  @$old_info->employee->salary ?? old('salary'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('salary_period', 'Salary Period: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::select('salary_period', ['Daily' => 'Daily', 'Weekly' => 'Weekly', 'Monthly' => 'Monthly', 'Quarterly' => 'Quarterly', 'Semi-Yearly' => 'Semi-Yearly', 'Yearly' => 'Yearly', 'Project Basis' => 'Project Basis'],  @$old_info->employee->salary_period ?? (old('salary_period') ?? 'Monthly'), ['class' => 'form-select']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('duty_type', 'Duty Type: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::select('duty_type', ['Full-Time' => 'Full-Time', 'Part-Time' => 'Part-Time', 'Contractual' => 'Contractual', 'Other' => 'Other'],  @$old_info->employee->duty_type ?? old('duty_type'), ['class' => 'form-select']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('image', 'Profile Picture: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::file('image', ['class' => 'form-select']) }}
                        </div>
                    </div>
                </div>
                {{--Biographical Info--}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Biographical Info</h5>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-6">
                            {{ Form::label('dob', 'Date of Birth: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::date('dob', @$old_info->employee->dob ?? old('dob'), ['class' => 'form-control', 'required' => true]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('marital_status', 'Marital Status: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::select('marital_status', ['Single' => 'Single', 'Married' => 'Married', 'Divorced' => 'Divorced', 'Widowed' => 'Widowed', 'Other' => 'Other'], @$old_info->employee->marital_status ?? old('marital_status'), ['class' => 'form-select', 'required' => true]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('gender', 'Gender: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::select('gender', ['Male' => 'Male' , 'Female' => 'Female', 'Others' => 'Others'], @$old_info->employee->gender ?? old('gender'), ['class' => 'form-select', 'required' => true]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('blood_group', 'Blood Group:', ['class' => 'form-label mt-4']) }}
                            {{ Form::select('blood_group', ['A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-' ,'AB+' => 'AB+' ,'AB-' => 'AB-','O+' => 'O+','O-' => 'O-'], @$old_info->employee->blood_group ?? old('blood_group'), ['class' => 'form-select']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                {{--Login Info--}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Login Credentials</h5>
                        @if($old_info)
                            <small class="text-warning">Re-enter only to change password</small>
                        @endif
                    </div>
                    <div class="card-body row">
                        <div class="col-md-6">
                            {{ Form::label('password', 'Password: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::password('password', ['class' => 'form-control', 'required' => true]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('password_confirmation', 'Confirm Password: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::password('password_confirmation', ['class' => 'form-control', 'required' => true]) }}
                        </div>
                    </div>
                </div>
                {{--Educational Info--}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Educational Info</h5>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-6">
                            {{ Form::label('college_name', 'University or College Name: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('college_name', @$old_info->employee->college_name ?? old('college_name'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('college_address', 'University or College Address: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('college_address', @$old_info->employee->college_address ?? old('college_address'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('completion_year', 'Completion Year: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::number('completion_year', @$old_info->employee->completion_year ?? old('completion_year'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('highest_degree_name', 'Highest Degree Name: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('highest_degree_name', @$old_info->employee->highest_degree_name ?? old('highest_degree_name'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('degree_document[]', 'Upload Documents: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::file('degree_document[]', ['class' => 'form-control', 'multiple' => true]) }}
                        </div>
                    </div>
                </div>
                {{--Additional Info--}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Additional Info</h5>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-6">
                            {{ Form::label('pan', 'PAN No:', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('pan', @$old_info->employee->pan ?? old('pan'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('pan_image', 'PAN Upload:', ['class' => 'form-label mt-4']) }}
                            {{ Form::file('pan_image', ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('citizenship', 'Citizenship No:', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('citizenship', @$old_info->employee->citizenship ?? old('citizenship'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('citizenship_image', 'Citizenship Upload:', ['class' => 'form-label mt-4']) }}
                            {{ Form::file('citizenship_image', ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                {{-- Bank Info --}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Bank Info</h5>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-6">
                            {{ Form::label('bank_name', 'Bank Name:', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('bank_name', @$old_info->employee->bank_name ?? old('bank_name'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('account_holder_name', 'Account Holder Name:', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('account_holder_name', @$old_info->employee->account_holder_name ?? old('account_holder_name'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('bank_branch', 'Bank Branch:', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('bank_branch', @$old_info->employee->bank_branch ?? old('bank_branch', 'Default'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('bank_account_no', 'Bank Account No:', ['class' => 'form-label mt-4']) }}
                            {{ Form::number('bank_account_no', @$old_info->employee->bank_account_no ?? old('bank_account_no'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-12">
                            {{ Form::label('bank_remarks', 'Bank Remarks:', ['class' => 'form-label mt-4']) }}
                            {{ Form::textarea('bank_remarks', @$old_info->employee->bank_remarks ?? old('bank_remarks'), ['class' => 'form-control','rows' => 3]) }}
                        </div>
                    </div>
                </div>
                {{--Previous Organization Info--}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Previous Organization Info</h5>
                        {{ Form::label('worked_before', 'Worked Before:', ['class' => 'form-label mt-4']) }}
                        &nbsp;&nbsp;
                        <input id="hasWorked" type="checkbox" name="worked_before">
                    </div>
                    <div id="previousOrganizationDetails" class="card-body row d-none">
                        <div class="col-md-6">
                            {{ Form::label('organization_name', 'Organization Name:', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('organization_name', @$old_info->employee->organization_name ?? old('organization_name'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('organization_contact', 'Organization Contact:', ['class' => 'form-label mt-4']) }}
                            {{ Form::number('organization_contact', @$old_info->employee->organization_contact ?? old('organization_contact'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('organization_address', 'Organization Address:', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('organization_address', @$old_info->employee->organization_address ?? old('organization_address'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('hr_name', 'HR Name:', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('hr_name', @$old_info->employee->hr_name ?? old('hr_name'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('hr_contact', 'HR Contact:', ['class' => 'form-label mt-4']) }}
                            {{ Form::number('hr_contact', @$old_info->employee->hr_contact ?? old('hr_contact'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('organization_document[]', 'Upload Documents: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::file('organization_document[]', ['class' => 'form-control', 'multiple' => true]) }}
                        </div>
                    </div>
                </div>
                {{--Emergency Contact Info--}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Emergency Contact Info</h5>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-6">
                            {{ Form::label('emergency_contact_person_name', 'Emergency Contact Person Name: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('emergency_contact_person_name', @$old_info->employee->emergency_contact_person_name ?? old('emergency_contact_person_name'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('emergency_contact_person_contact', 'Emergency Contact Person Contact: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::number('emergency_contact_person_contact', @$old_info->employee->emergency_contact_person_contact ?? old('emergency_contact_person_contact'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-12">
                            {{ Form::label('emergency_contact_person_address', 'Emergency Contact Person Address: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('emergency_contact_person_address', @$old_info->employee->emergency_contact_person_address ?? old('emergency_contact_person_address'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('emergency_contact_person_relation', 'Emergency Contact Person Relation: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('emergency_contact_person_relation', @$old_info->employee->emergency_contact_person_relation ?? old('emergency_contact_person_relation'), ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {{ Form::button('Reset', ['class' => 'btn btn-warning', 'type' => 'reset']) }}
                    {{ Form::button('Save Changes', ['class' => 'btn btn-success float-end', 'type' => 'submit']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</x-app-layout>
