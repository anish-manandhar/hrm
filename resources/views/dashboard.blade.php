<x-app-layout>
    @section('page_title', @$page_title)
    @push('css')

    @endpush
    @push('js')
        <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    @endpush

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
