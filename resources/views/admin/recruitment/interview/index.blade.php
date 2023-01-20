<x-app-layout>
    @section('page_title', @$page_title)
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="row card-header">
                        <div class="col-9">
                            <h5 class="card-title">{{ @$page_title }}</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" style="width:100%">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Candidate</th>
                                <th>Interviewer</th>
                                <th>Date & Time</th>
                                <th>Selected</th>
                                <th>Recommendation</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($interview as $key => $data )
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ @$data->getCandidate->name }}</td>
                                    <td>{{ @$data->getInterviewer->name }}</td>
                                    <td>{{ @$data->date_time }}</td>
                                    <td>
                                        <span class="badge {{ $data->selected ? 'badge-success' : 'badge-danger' }}">
                                            {{ $data->selected ? 'Selected' : 'Unselected' }}
                                        </span>
                                    </td>
                                    <td>{{ @$data->recommendation}}</td>
                                    <td>{{ @$data->remarks}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            @if($data->selected)
                                                <a href="{{ route('interview.select', $data->id) }}">
                                                    <button title="Remove from Selected" type="button"
                                                            class="btn btn-sm btn-outline-danger"><span
                                                            class="material-icons-outlined mt-1">person_remove</span>
                                                    </button>
                                                </a>
                                                <a href="{{ route('interview.send-notification', $data->id) }}">
                                                    <button title="Remove from Selected" type="button"
                                                            class="btn btn-sm btn-outline-success"><span
                                                            class="material-icons-outlined mt-1">notifications</span>
                                                    </button>
                                                </a>
                                            @else
                                                <a href="{{ route('interview.select', $data->id) }}">
                                                    <button title="Select" type="button"
                                                            class="btn btn-sm btn-outline-success"><span
                                                            class="material-icons-outlined mt-1">check</span></button>
                                                </a>
                                            @endif
                                            <a href="{{ route('interview.edit', $data->id) }}">
                                                <button type="button" class="btn btn-sm btn-outline-warning"><span
                                                        class="material-icons-outlined mt-1">edit</span></button>

                                            </a>
                                            {{--<button type="button" class="btn btn-sm btn-outline-danger"--}}
                                            {{--       data-bs-toggle="modal" data-bs-target="#deleteModal_{{ $data->getTable() }}_{{ $data->id }}"--}}
                                            {{--       href="{{ route('interview.destroy', $data->id) }}">--}}
                                            {{--    <span class="material-icons-outlined mt-1">delete</span></button>--}}
                                            {{--<x-delete-modal :data="$data" :route="'interview'" />--}}
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
