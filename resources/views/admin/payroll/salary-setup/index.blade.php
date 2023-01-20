<x-app-layout>
    @section('page_title', @$page_title)
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-lg-10">
                            <h5 class="card-title">{{ @$page_title }}</h5>
                        </div>
                        <div class="col-lg-2">
                            <a href="{{ route('salary-setup.create') }}">
                                <button
                                    class="btn btn-primary float-end">Add {{ @$page_title }}
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" style="width:100%">
                            <thead>
                            <tr>
                                <th width="10px">S.No.</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Total Amount</th>
                                <th width="20px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $value)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ @$value->employee->name }}</td>
                                    <td>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Wage</th>
                                                <th>Gross Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Basic Pay</td>
                                                <td>{{ @$value->employee->employee->salary }}</td>
                                            </tr>
                                            @forelse(json_decode($value->salary_details) as $id => $wage)
                                                @php
                                                    $salary_type = \App\Models\SalaryType::findOrFail($id);
                                                @endphp
                                                <tr>
                                                    <td>{{ $salary_type->title }}</td>
                                                    <td>{{ $wage }}{{ $salary_type->per_amt == 'Percentage' ? '%' : ''}}</td>
                                                </tr>
                                            @empty
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>{{ $value->gross_amount }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal_{{ $value->getTable() }}_{{ $value->id }}">
                                                <span class="material-icons-outlined mt-1">delete</span>
                                            </button>
                                            <x-delete-modal :data="$value" :route="'salary-setup'"/>
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
                                    <nav aria-label="Page navigation"
                                         class="float-end">{{ $data->links() }}</nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
