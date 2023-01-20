<x-app-layout>
    @section('page_title', @$page_title)
    @push('modals')
        <div class="modal fade" id="addValueModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModal">Add {{ @$page_title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{ Form::open(['url' => route('department.store'), 'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
                    <div class="modal-body">
                        {{ Form::label('title', 'Name : *', ['class' => 'form-label']) }}
                        {{ Form::text('title', @$old_info->title, ['class' => 'form-control', 'required' => true]) }}
                        <div class="valid-feedback">
                            Looks good!
                        </div>
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
                                <th>Title</th>
                                <th>Status</th>
                                <th width="20px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $value)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>
                                        <span class="badge {{ $value->status ? 'badge-success' : 'badge-danger' }}">
                                            {{ $value->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('department.edit', $value->id) }}">
                                                <button type="button" class="btn btn-sm btn-outline-warning"><span
                                                        class="material-icons-outlined mt-1">edit</span></button>

                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal_{{ $value->getTable() }}_{{ $value->id }}"
                                                href="{{ route('department.destroy', $value->id) }}">
                                                <span class="material-icons-outlined mt-1">delete</span></button>
                                            <x-delete-modal :data="$value" :route="'department'" />
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
