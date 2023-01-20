@push('css')
    <link href="{{ asset('assets/plugins/highlight/styles/github-gist.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
@endpush
@push('js')
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/highlight/highlight.pack.js') }}"></script>
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datepickers.js') }}"></script>
    <script wire:ignore>
        $('#start_date').flatpickr();
        $('#end_date').flatpickr();
    </script>
@endpush
<div class="row">
    @if (isset($old_info))
        {{ Form::open(['url' => route('salary-generate.update', $old_info->id),'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
        @method('put')
    @else
        {{ Form::open(['url' => route('salary-generate.store'),'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
    @endif
    <div class="row">
        <div class="col-md-3">
            {{ Form::label('employee_id', 'Select Employee: *', ['class' => 'form-label mt-4']) }}
            <select class="form-select" name="employee_id" wire:model="employee_id" id="employee_id" required>
                <option value="" selected>Select Employee</option>
                @forelse($all_employees as $key => $employee)
                    <option value="{{ $key }}">{{ $employee }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-md-3">
            {{ Form::label('start_date', 'Select Start Date: *', ['class' => 'form-label mt-4']) }}
            <input type="text" id="start_date" name="start_date" wire:model="start_date"
                   value="{{ old('start_date', @$old_info) }}"
                   class="form-control" required>
        </div>
        <div class="col-md-3">
            {{ Form::label('end_date', 'Select End Date: *', ['class' => 'form-label mt-4']) }}
            <input type="text" id="end_date" name="end_date" wire:model="end_date"
                   value="{{ old('end_date', @$old_info) }}"
                   class="form-control" required>
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="m-4">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Wage</th>
                <th>Working Days</th>
                <th>Monthly</th>
                <th>Amount</th>
            </tr>
            </thead>
            <tbody>
            @php
                $total = 0;
            @endphp
            @forelse($salary_details as $salary)
                <tr>
                    <td>{{ @$salary['title'] }}</td>
                    <td>{{ @$days }}</td>
                    <td>{{ @$salary['monthly_wage'] }}</td>
                    <td>{{ round($salary['wage']) }}</td>
                    @php
                        $total = $total + $salary['wage'];
                    @endphp
                </tr>
            @empty
                <tr>
                    <td class="text-center text-danger" colspan="4">
                        <span class="material-icons-outlined">error</span><br>
                        No Data Found!<br>
                        <small class="text-warning">
                            Warning! :
                            {{ !$employee_id ? '* Select Employee' : '' }}
                            {{ !$start_date ? ', * Select Start Date' : '' }}
                            {{ !$end_date ? ', * Select End Date' : '' }}
                        </small>
                    </td>
                </tr>
            @endforelse
            <tr>
                <td>Total</td>
                <td>{{ $days }}</td>
                <td></td>
                <td>{{ $total ?? 0 }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="row mt-4">
        <div class="col-lg-6"></div>
        <div class="col-lg-6">
            {{ Form::button('Reset',['class' => 'btn btn-warning ml-1 mr-1 col-lg-3', 'type' => 'reset']) }}
            {{ Form::button('Save',['class' => 'btn btn-success ml-1 mr-1 col-lg-3', 'type' => 'submit']) }}
        </div>
    </div>
    {{ Form::close() }}
</div>
