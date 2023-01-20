@push('modals')
    <div class="modal fade" id="notice_period_{{ $userid }}" tabindex="-1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {{ Form::open(['url' => route('employee.notice-period', @$userid), 'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
                <div class="modal-header">
                    <h5 class="modal-title">Notice Period</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6">
                        {{ Form::label('notice_period_start_date', 'Start Date: *', ['class' => 'form-label mt-4']) }}
                        {{ Form::text('notice_period_start_date', null, ['class' => 'form-control flatpicker', 'required' => true]) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('notice_period_end_date', 'End Date: *', ['class' => 'form-label mt-4']) }}
                        {{ Form::text('notice_period_end_date', null, ['class' => 'form-control flatpicker', 'required' => true]) }}
                    </div>
                    <div class="col-md-12">
                        {{ Form::label('notice_period_remarks', 'Remarks:', ['class' => 'form-label mt-4']) }}
                        {{ Form::textarea('notice_period_remarks', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Move to Notice Period</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endpush
