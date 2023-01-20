@push('modals')
    <div class="modal fade" id="deleteModal_{{ $data->getTable() }}_{{ $data->id }}" tabindex="-1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this {{ class_basename(get_class($data)) }}
                </div>
                <div class="modal-footer">
                    {{ Form::open(['method' => 'DELETE', 'route' => [$route.'.destroy', $data->id], 'style' => 'display:inline']) }}
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endpush
