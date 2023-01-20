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
        </script>
    @endpush
    @include('admin.recruitment.candidate.validation')
    <div class="container-fluid">
        <div class="row">
            @if (isset($old_info))
                {{ Form::open(['url' => route('candidate.update', $old_info->id), 'files' => true, 'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
                @method('put')
            @else
                {{ Form::open(['url' => route('candidate.store'), 'files' => true, 'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
            @endif
            <div class="col-md-6">
                {{--Basic Info--}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Basic Info</h5>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-6">
                            {{ Form::label('name', 'Name: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('name', @$old_info->name ?? old('name'), ['class' => 'form-control', 'required' => true]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('job_opening_id', 'Select Job Opening: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::select('job_opening_id', \App\Models\JobOpening::pluck('title', 'id'), @$old_info->job_opening_id ?? old('job_opening_id'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('email', 'Email: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::email('email', @$old_info->email ?? old('email'), ['class' => 'form-control', 'required' => true]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('alt_email', 'Alternative Email:', ['class' => 'form-label mt-4']) }}
                            {{ Form::email('alt_email', @$old_info->alt_email ?? old('alt_email'), ['class' => 'form-control', 'required' => true]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('phone', 'Phone: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::number('phone', @$old_info->phone ?? old('phone'), ['class' => 'form-control', 'required' => true]) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('alt_phone', 'Alternative Phone:', ['class' => 'form-label mt-4']) }}
                            {{ Form::number('alt_phone', @$old_info->alt_phone ?? old('alt_phone'), ['class' => 'form-control', 'required' => true]) }}
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
                            {{ Form::label('salary_expectation', 'Salary Expectation: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::number('salary_expectation',  @$old_info->salary_expectation ?? old('salary_expectation'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('salary_period', 'Salary Period: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::select('salary_period', ['Daily' => 'Daily', 'Weekly' => 'Weekly', 'Monthly' => 'Monthly', 'Quarterly' => 'Quarterly', 'Semi-Yearly' => 'Semi-Yearly', 'Yearly' => 'Yearly', 'Project Basis' => 'Project Basis'],  @$old_info->salary_period ?? (old('salary_period') ?? 'Monthly'), ['class' => 'form-select']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('duty_type', 'Duty Type: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::select('duty_type', ['Full-Time' => 'Full-Time', 'Part-Time' => 'Part-Time', 'Contractual' => 'Contractual', 'Other' => 'Other'],  @$old_info->duty_type ?? old('duty_type'), ['class' => 'form-select']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                {{--Biographical Info--}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Biographical Info</h5>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-6">
                            {{ Form::label('dob', 'Date of Birth:', ['class' => 'form-label mt-4']) }}
                            {{ Form::date('dob', @$old_info->dob ?? old('dob'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('gender', 'Gender:', ['class' => 'form-label mt-4']) }}
                            {{ Form::select('gender', ['Male' => 'Male' , 'Female' => 'Female', 'Others' => 'Others'], @$old_info->gender ?? old('gender'), ['class' => 'form-select']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('marital_status', 'Marital Status:', ['class' => 'form-label mt-4']) }}
                            {{ Form::select('marital_status', ['Single' => 'Single', 'Married' => 'Married', 'Divorced' => 'Divorced', 'Widowed' => 'Widowed', 'Other' => 'Other'], @$old_info->marital_status ?? old('marital_status'), ['class' => 'form-select']) }}
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
                            {{ Form::text('pan', @$old_info->pan ?? old('pan'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('citizenship', 'Citizenship No:', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('citizenship', @$old_info->citizenship ?? old('citizenship'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-12">
                            {{ Form::label('street_address', 'Street Address: *', ['class' => 'form-label mt-4']) }}
                            {{ Form::textarea('street_address', @$old_info->street_address ?? old('street_address'), ['class' => 'form-control', 'rows' => 3, 'required' => true]) }}
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
                            {{ Form::text('organization_name', @$old_info->organization_name ?? old('organization_name'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('organization_contact', 'Organization Contact:', ['class' => 'form-label mt-4']) }}
                            {{ Form::number('organization_contact', @$old_info->organization_contact ?? old('organization_contact'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-12">
                            {{ Form::label('organization_address', 'Organization Address:', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('organization_address', @$old_info->organization_address ?? old('organization_address'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('hr_name', 'HR Name:', ['class' => 'form-label mt-4']) }}
                            {{ Form::text('hr_name', @$old_info->hr_name ?? old('hr_name'), ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('hr_contact', 'HR Contact:', ['class' => 'form-label mt-4']) }}
                            {{ Form::number('hr_contact', @$old_info->hr_contact ?? old('hr_contact'), ['class' => 'form-control']) }}
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
