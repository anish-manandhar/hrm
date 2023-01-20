<x-app-layout>
    @section('page_title', @$page_title)
    @push('js')

        <script src="{{ asset('assets/plugins/highlight/highlight.pack.js') }}"></script>
        <script src="{{ asset('assets/plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('assets/js/pages/datepickers.js') }}"></script>
        <script>
            $("body").delegate(".flatpicker", "focusin", function () {
                $(this).flatpickr({
                    minDate: 'today',
                    mode: "range",
                });
            });
        </script>
    @endpush
    @push('css')
        <link href="{{ asset('assets/plugins/highlight/styles/github-gist.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    @endpush
    @push('modals')
        <div class="modal fade" id="addValueModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModal">Add {{ @$page_title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{ Form::open(['url' => route('leave.store'), 'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
                    <div class="modal-body">
                        {{ Form::label('employee_id', 'Select Employee : *', ['class' => 'form-label']) }}
                        {{ Form::select('employee_id', \App\Models\User::where('user_type', 'Employee')->pluck('name', 'id'), @$old_info->employee_id ?? old('employee_id'), ['class' => 'form-select', 'required' => true]) }}
                        {{ Form::label('leave_type_id', 'Select Leave Type : *', ['class' => 'form-label mt-2']) }}
                        {{ Form::select('leave_type_id', \App\Models\LeaveType::pluck('title', 'id'), @$old_info->leave_type_id ?? old('leave_type_id'), ['class' => 'form-select', 'required' => true]) }}
                        {{ Form::label('dates', 'Granted Date : *', ['id' => 'dates','class' => 'form-label mt-2']) }}
                        {{ Form::text('dates', @$old_info->dates ?? old('dates'), ['class' => 'form-control flatpicker', 'required' => true]) }}
                        {{ Form::label('remarks', 'Remarks : *', ['id' => 'remarks','class' => 'form-label mt-2']) }}
                        {{ Form::textarea('remarks', @$old_info->remarks ?? old('remarks'), ['col' => 3,'class' => 'form-control', 'required' => true]) }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    @endpush
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-lg-10">
                            <h5 class="card-title">{{ @$page_title }}</h5>
                        </div>
                        <div class="col-lg-2">
                            <button data-bs-toggle="modal" data-bs-target="#addValueModal"
                                    class="btn btn-primary float-end">Add {{ @$page_title }}
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" style="width:100%">
                            <thead>
                            <tr>
                                <th width="10px">S.No.</th>
                                <th>Employee</th>
                                <th>LeaveType</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Days</th>
                                <th width="20px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $value)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->employee->name }}</td>
                                    <td>{{ $value->leaveType->title }}</td>
                                    <td>{{ $value->start_date }}</td>
                                    <td>{{ $value->end_date }}</td>
                                    <td>{{ $value->days }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal_{{ $value->getTable() }}_{{ $value->id }}">
                                                <span class="material-icons-outlined mt-1">delete</span></button>
                                            <x-delete-modal :data="$value" :route="'leave'"/>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="text-sm">
                                        Showing <strong>{{ $data->firstItem() }}</strong> to
                                        <strong>{{ $data->lastItem() }} </strong> of <strong>
                                            {{ $data->total() }}</strong>
                                        entries
                                        <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b> seconds to
                                        render</span>
                                    </p>
                                </div>
                                <div class="col-md-8">
                                    <nav aria-label="Page navigation" class="float-end">{{ $data->links() }}</nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
