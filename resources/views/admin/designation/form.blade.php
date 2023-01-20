<x-app-layout>
    @section('page_title', @$page_title)
    @push('css')
    @endpush
    @push('js')
        <script>
            $('#hasWorked').click(function () {
                if ($(this).prop("checked") === true) {
                    $('#previousOrganizationDetails').removeClass('d-none');
                } else if ($(this).prop("checked") === false) {
                    $('#previousOrganizationDetails').addClass('d-none');
                }
            });
        </script>
    @endpush
    <div class="container-fluid">
        <div class="row">
            @if (isset($old_info))
                {{ Form::open(['url' => route('designation.update', $old_info->id), 'files' => true, 'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
                @method('put')
            @endif
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit Designation</h5>
                </div>
                <div class="card-body row">
                    <div class="col-md-6">
                        {{ Form::label('title', 'Title: *', ['class' => 'form-label mt-4']) }}
                        {{ Form::text('title', @$old_info->title ?? old('title'), ['class' => 'form-control', 'required' => true]) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('status', 'Status: *', ['class' => 'form-label mt-4']) }}
                        {{ Form::select('status', ['1' => 'Active' , '0' => 'Inactive'], @$old_info->status ?? old('status'), ['class' => 'form-select', 'required' => true]) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('working', 'Working: *', ['class' => 'form-label mt-4']) }}
                        {{ Form::select('working', ['0' => 'Inactive' , '1' => 'Active'], @$old_info->working ?? old('working'), ['class' => 'form-select', 'required' => true]) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('rank', 'Rank: *', ['class' => 'form-label mt-4']) }}
                        {{ Form::number('rank', @$old_info->rank ?? old('rank'), ['class' => 'form-control', 'required' => true]) }}
                    </div>
                    <div class="card-body">
                        {{ Form::button('Update', ['class' => 'btn btn-success float-end', 'type' => 'submit']) }}
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</x-app-layout>
