<x-app-layout>
    @section('page_title', @$page_title)
    @push('js')

        <script src="{{ asset('assets/plugins/highlight/highlight.pack.js') }}"></script>
        <script src="{{ asset('assets/plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('assets/js/pages/datepickers.js') }}"></script>
        <script>
            $(".flatpicker").flatpickr();
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
                            <div class="col-lg-2">
                                <input value="{{ @request()->start_date }}" name="start_date" class="form-control form-control-sm flatpicker" type="text"
                                       placeholder="Select Start Date">
                            </div>
                            <div class="col-lg-2">
                                <input  value="{{ @request()->end_date }}" name="end_date" class="form-control form-control-sm flatpicker" type="text"
                                       placeholder="Select End Date">
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
                                <th width="10px">S.No.</th>
                                <th>Date</th>
                                <th>Total Employee</th>
                                <th>Present Employee</th>
                                <th>Absent Employee</th>
                                <th width="20px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $value)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value['date'] }}&nbsp;<small>({{ readableDate($value['date'], 'ymd') }}
                                            )</small></td>
                                    <td>{{ $value['total_employee'] }}</small></td>
                                    <td>{{ $value['present_employee'] }}</small></td>
                                    <td>{{ $value['absent_employee'] }}</small></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('attendance.show', $value['date']) }}">
                                                <button type="button" class="btn btn-sm btn-outline-info"><span
                                                        class="material-icons-outlined mt-1">visibility</span></button>

                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{--                        <div class="mt-3">--}}
                        {{--                            <div class="row">--}}
                        {{--                                <div class="col-md-4">--}}
                        {{--                                    <p class="text-sm">--}}
                        {{--                                        Showing <strong>{{ $data->firstItem() }}</strong> to--}}
                        {{--                                        <strong>{{ $data->lastItem() }} </strong> of <strong>--}}
                        {{--                                            {{ $data->total() }}</strong>--}}
                        {{--                                        entries--}}
                        {{--                                        <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b> seconds to--}}
                        {{--                                        render</span>--}}
                        {{--                                    </p>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="col-md-8">--}}
                        {{--                                    <nav aria-label="Page navigation" class="float-end">{{ $data->links() }}</nav>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
