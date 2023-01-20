<x-app-layout>
    @section('page_title', @$page_title)
    @push('js')
        <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/highlight/highlight.pack.js') }}"></script>
        <script src="{{ asset('assets/plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('assets/js/pages/datepickers.js') }}"></script>
        <script>
            $("body").delegate(".flatpicker", "focusin", function () {
                $(this).flatpickr();
            });
        </script>
    @endpush
    @push('css')
        <link href="{{ asset('assets/plugins/highlight/styles/github-gist.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    @endpush
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-lg-6">
                            <h5 class="card-title">{{ @$page_title }}</h5>
                        </div>
                        <form action="" class="row mt-4">
                            <div class="col-lg-3">
                                {{ Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Employee']) }}
                            </div>
                            <div class="col-lg-2">
                                {{ Form::select('type', ['All' => 'All' , 'Notice' => 'On Notice Period', 'Ex' => 'Ex-Employees'], @request()->type , ['class' => 'form-select form-select-sm']) }}
                            </div>
                            <div class="col-lg-2 mt-1">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table" style="width:100%">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Department Name</th>
                                <th>Active Status</th>
                                <th>Working Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($employee as $key => $data )
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>
                                        <div class="avatar avatar-xl avatar-rounded">
                                            <img src="{{ $data->getFirstMediaUrl('image') }}" alt="{{ $data->name }}">
                                        </div>
                                    </td>
                                    <td>{{ @$data->name }} @isset($data->employee->getDesignation)
                                            <small>({{  @$data->employee->getDesignation->title }})</small>
                                        @endisset
                                    </td>
                                    <td>{{ @$data->email }}<br>{{ @$data->employee->alt_email }}</td>
                                    <td>{{ @$data->phone }}<br>{{ @$data->employee->alt_phone }}</td>
                                    <td>{{ @$data->employee->getDepartment->title}} @isset($data->employee->getDivison)
                                            ({{ @$data->employee->getDivison->title }})
                                        @endisset</td>
                                    <td>
                                        <span class="badge {{ $data->status ? 'badge-success' : 'badge-danger' }}">
                                            {{ $data->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ @$data->employee->ex_employee ? 'badge-danger' : (@$data->employee->notice_period ? 'badge-warning' : 'badge-success') }}">
                                        {{ @$data->employee->ex_employee ? 'Ex-Employee' : (@$data->employee->notice_period ? 'On Notice Period' : 'Currently Working') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('employee.active', $data->id) }}">
                                                <button type="button" class="btn btn-sm btn-outline-success"><span
                                                        class="material-icons-outlined mt-1">check</span></button>

                                            </a>
                                            <a href="{{ route('employee.edit', $data->id) }}">
                                                <button type="button" class="btn btn-sm btn-outline-warning"><span
                                                        class="material-icons-outlined mt-1">edit</span></button>

                                            </a>
                                            <a href="{{ route('employee.show', $data->id) }}">
                                                <button type="button" class="btn btn-sm btn-outline-info"><span
                                                        class="material-icons-outlined mt-1">visibility</span></button>

                                            </a>
                                            <a href="{{ route('employee.ex', $data->id) }}">
                                                <button type="button"
                                                        class="btn btn-sm {{ @$data->employee->ex_employee ? 'btn-outline-success' : 'btn-outline-danger'}}"
                                                        title="{{ @$data->employee->ex_employee ? 'Send to Currently Working' : 'Move to Ex-Employee'}}">
                                                    <span
                                                        class="material-icons-outlined mt-1">{{ @$data->employee->ex_employee ? 'person_add' : 'person_remove'}}</span>
                                                </button>
                                            </a>
                                            @if(@!$data->employee->notice_period)
                                                <button type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#notice_period_{{ $data->id }}"
                                                        class="btn btn-sm btn-outline-warning"
                                                        title="Move to Notice Period'">
                                                    <span
                                                        class="material-icons-outlined mt-1">schedule</span>
                                                </button>
                                                <x-notice-period-modal :userid="$data->id"/>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
