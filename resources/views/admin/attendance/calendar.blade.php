<x-app-layout>
    @section('page_title', @$page_title)
    @push('js')
        <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/fullcalendar/lib/main.min.js') }}"></script>
        @include('admin.attendance.calendar_js')
        <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    @endpush
    @push('css')
        <link href="{{ asset('assets/plugins/highlight/styles/github-gist.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/fullcalendar/lib/main.min.css') }}" rel="stylesheet">
    @endpush
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card calendar-container">
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
