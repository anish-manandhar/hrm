<x-app-layout>
    @section('page_title', @$page_title)
    @push('js')
        <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/highlight/highlight.pack.js') }}"></script>
        <script src="{{ asset('assets/plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('assets/js/pages/datepickers.js') }}"></script>
        <script>
            $('.flatpicker').flatpickr({
                minDate: 'today',
                enableTime: true
            });
        </script>
    @endpush
    @push('css')
        <link href="{{ asset('assets/plugins/highlight/styles/github-gist.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    @endpush
    <div class="container-fluid">
        <div class="row">
            @if (isset($old_info))
                {{ Form::open(['url' => route('interview.update', $old_info->id),'files' => true,'class' => 'row g-3 needs-validation','novalidate' => true]) }}
                @method('put')
            @else
                {{ Form::open(['url' => route('interview.store'),'files' => true,'class' => 'row g-3 needs-validation','novalidate' => true]) }}
            @endif
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Add Interview</h5>
                </div>
                <div class="card-body row">
                    <div class="col-md-4">
                        {{ Form::label('candidate_id', 'Select Candidate: *', ['class' => 'form-label mt-4']) }}
                        {{ Form::select('candidate_id',\App\Models\Candidate::where('shortlisted', 1)->pluck('name', 'id'),@$old_info->candidate_id ?? old('candidate_id'),['class' => 'form-select']) }}
                    </div>
                    <div class="col-md-4">
                        {{ Form::label('interviewer_id', 'Select Interviewer: *', ['class' => 'form-label mt-4']) }}
                        {{ Form::select('interviewer_id',\App\Models\User::pluck('name', 'id'),@$old_info->interviewer_id ?? old('interviewer_id'),['class' => 'form-select']) }}
                    </div>
                    <div class="col-md-4">
                        {{ Form::label('date_time', 'Date & Time: *', ['class' => 'form-label mt-4']) }}
                        {{ Form::text('date_time', @$old_info->date_time ?? old('date_time'), ['class' => 'form-control flatpicker','required' => true]) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('recommendation', 'Recommendation:', ['class' => 'form-label mt-4']) }}
                        {{ Form::textarea('recommendation', @$old_info->recommendation ?? old('recommendation'), ['class' => 'form-control','required' => true]) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('remarks', 'Remarks:', ['class' => 'form-label mt-4']) }}
                        {{ Form::textarea('remarks', @$old_info->remarks ?? old('remarks'), ['class' => 'form-control','required' => true]) }}
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {{ Form::button('Reset', ['class' => 'btn btn-warning', 'type' => 'reset']) }}
                    {{ Form::button('Save Changes', ['class' => 'btn btn-success float-end', 'type' => 'submit']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</x-app-layout>
