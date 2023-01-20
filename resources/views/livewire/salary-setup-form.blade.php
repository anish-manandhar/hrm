<div class="row">
    @if (isset($old_info))
        {{ Form::open(['url' => route('salary-setup.update', $old_info->id),'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
        @method('put')
    @else
        {{ Form::open(['url' => route('salary-setup.store'),'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
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
        <div class="col-md-1"></div>
        @if($employee_id)
            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Salary Type</th>
                        <th>Type</th>
                        <th>Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Basic Pay</td>
                        <td>Amount</td>
                        <td>
                            <input type="number" value="{{ $basic_pay }}" class="form-control">
                        </td>
                    </tr>
                    @forelse(\App\Models\SalaryType::all() as $salary_type)
                        <tr>
                            <td>{{ $salary_type->title }}</td>
                            <td>{{ $salary_type->per_amt }}</td>
                            <td>
                                <input wire:model="wages.{{ $salary_type->id }}" type="number" class="form-control">
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <input type="hidden" name="detail" value="{{ json_encode($wages) }}">
    <div class="row mt-4 col-lg-12">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            {{ Form::label('total_payable', 'Gross Salary: *', ['class' => 'form-label']) }}
            {{ Form::number('total_payable', @$old_info->total_payable ?? $total_payable, ['placeholder' => 'Total Gross Salary', 'class' => 'form-control']) }}
        </div>
    </div>
    @if($total_payable)
        <div class="row mt-4">
            <div class="col-lg-6"></div>
            <div class="col-lg-6">
                {{ Form::button('Reset',['class' => 'btn btn-warning ml-1 mr-1 col-lg-3', 'type' => 'reset']) }}
                {{ Form::button('Save',['class' => 'btn btn-success ml-1 mr-1 col-lg-3', 'type' => 'submit']) }}
            </div>
        </div>
    @endif
    {{ Form::close() }}
</div>
