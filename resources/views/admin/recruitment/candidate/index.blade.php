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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Job Applied For</th>
                                <th>Salary Expectation</th>
                                <th>Shortlisted</th>
                                <th>Street Address</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($candidate as $key => $data )
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ @$data->name }}</td>
                                    <td>{{ @$data->email }}<br>{{ @$data->alt_email }}</td>
                                    <td>{{ @$data->phone }}<br>{{ @$data->alt_phone }}</td>
                                    <td>{{ @$data->jobOpening->title }}</td>
                                    <td>{{ @$data->salary_expectation}}<br>({{ @$data->salary_period }})</td>
                                    <td>
                                        <span class="badge {{ $data->shortlisted ? 'badge-success' : 'badge-danger' }}">
                                            {{ $data->shortlisted ? 'Selected' : 'Unselected' }}
                                        </span>
                                    </td>
                                    <td>{{ $data->street_address }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            @if($data->shortlisted)
                                                <a href="{{ route('candidate.shortlist', $data->id) }}">
                                                    <button title="Remove from Shortlisted" type="button"
                                                            class="btn btn-sm btn-outline-warning"><span
                                                            class="material-icons-outlined mt-1">person_remove</span></button>
                                                </a>
                                            @else
                                                <a href="{{ route('candidate.shortlist', $data->id) }}">
                                                    <button title="Shortlist" type="button"
                                                            class="btn btn-sm btn-outline-success"><span
                                                            class="material-icons-outlined mt-1">check</span></button>
                                                </a>
                                            @endif
                                            <a href="{{ route('candidate.edit', $data->id) }}">
                                                <button type="button" class="btn btn-sm btn-outline-warning"><span
                                                        class="material-icons-outlined mt-1">edit</span></button>

                                            </a>
                                            <a href="{{ route('candidate.show', $data->id) }}">
                                                <button type="button" class="btn btn-sm btn-outline-info"><span
                                                        class="material-icons-outlined mt-1">visibility</span></button>

                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal_{{ $data->getTable() }}_{{ $data->id }}"
                                                    href="{{ route('candidate.destroy', $data->id) }}">
                                                <span class="material-icons-outlined mt-1">delete</span></button>
                                            <x-delete-modal :data="$data" :route="'candidate'"/>
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
