<x-app-layout>
    @section('page_title', @$page_title)
    @push('js')
        <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/highlight/highlight.pack.js') }}"></script>
        <script src="{{ asset('assets/plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('assets/js/pages/datepickers.js') }}"></script>
        <script>
            $("body").delegate(".flatpicker", "focusin", function () {
                var dateToday = new Date();
                $(this).flatpickr({
                    minDate: dateToday
                });
            });
        </script>
    @endpush
    @push('css')
        <link href="{{ asset('assets/plugins/highlight/styles/github-gist.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    @endpush
    @include('admin.recruitment.job-opening.validation')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-center">Edit Info</h5><br><br>
            </div>
            <div class="card-body">
                <div class="row">
                    {{ Form::open(['url' => route('job-opening.update', $old_info->id), 'files' => true, 'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
                    @method('put')
                    <div class="col-lg-6">
                        {{ Form::label('title', 'Title : *', ['class' => 'form-label']) }}
                        {{ Form::text('title', @$old_info->title ?? old('title'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'eg. Php Develpoper']) }}
                            </div>
                    <div class="col-lg-3">
                        {{ Form::label('total_vacancies', 'Total Vacancies :', ['class' => 'form-label']) }}
                        {{ Form::text('total_vacancies', @$old_info->total_vacancies ?? old('total_vacancies'), ['class' => 'form-control', 'placeholder' => 'eg. 2']) }}
                            </div>
                    <div class="col-lg-3">
                        {{ Form::label('application_deadline', 'Application Deadline :', ['class' => 'form-label']) }}
                        {{ Form::text('application_deadline', @$old_info->application_deadline ?? old('application_deadline'), ['class' => 'form-control flatpicker', 'placeholder' => 'eg. April x']) }}
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        {{ Form::label('salary', 'Salary :', ['class' => 'form-label']) }}
                        {{ Form::text('salary', @$old_info->salary ?? old('salary'), ['class' => 'form-control', 'placeholder' => 'eg. Rs xxx']) }}
                    </div>
                    <div class="col-lg-3">
                        {{ Form::label('experience', 'Experience :', ['class' => 'form-label']) }}
                        {{ Form::text('experience', @$old_info->experience ?? old('experience'), ['class' => 'form-control', 'placeholder' => 'In Years']) }}
                            </div>
                    <div class="col-lg-3">
                        {{ Form::label('skills', 'Skills :', ['class' => 'form-label']) }}
                        {{ Form::text('skills', @$old_info->skills ?? old('skills'), ['class' => 'form-control', 'placeholder' => 'Ex: PHP, Django, Team Leading']) }}
                            </div>
                    <div class="col-lg-3">
                        {{ Form::label('image', 'Picture :', ['class' => 'form-label']) }}
                        {{ Form::file('image', ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-4">
                        {{ Form::label('department_id', 'Select Department: *', ['class' => 'form-label mt-4']) }}
                        {{ Form::select('department_id', \App\Models\Department::where('status', 1)->pluck('title', 'id'), @$old_info->department_id ?? old('department_id'), ['class' => 'form-control']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('designation_id', 'Select Designation: *', ['class' => 'form-label mt-4']) }}
                        {{ Form::select('designation_id', \App\Models\Designation::where('status', 1)->pluck('title', 'id'), @$old_info->designation_id ?? old('designation_id'), ['class' => 'form-control']) }}
                    </div>
                    @if(get_setting('division_enabled'))
                    <div class="col-lg-4">
                        {{ Form::label('division_id', 'Select Division:', ['class' => 'form-label mt-4']) }}
                        {{ Form::select('division_id', \App\Models\Division::where('status', 1)->pluck('title', 'id'), @$old_info->division_id ?? old('division_id'), ['class' => 'form-control']) }}
                    </div>
                    @endif
                    </div>
                <div class="row mt-3">
                    <div class="col-lg-6">
                        {{ Form::label('description', 'Job Description : *', ['class' => 'form-label']) }}
                        {{ Form::textarea('description', @$old_info->description ?? old('description'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Some description']) }}
                    </div>
                    <div class="col-lg-6">
                        {{ Form::label('offerings', 'Job Offerings :', ['class' => 'form-label']) }}
                        {{ Form::textarea('offerings', @$old_info->offerings ?? old('offerings'), ['class' => 'form-control', 'placeholder' => 'Job Offers']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</x-app-layout>
