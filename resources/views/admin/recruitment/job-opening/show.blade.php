<x-app-layout>
    @section('page_title', @$page_title)
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead style="font-weight: bold">
                            <tr>
                                <td>Categories</td>
                                <td>Info</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Picture</td>
                                <td><img src="{{ $jobOpening->getFirstMediaUrl('image') }}" alt="{{ @$jobOpening->title }}"></td>
                            </tr>
                            <tr>
                                <td>Title</td>
                                <td>{{ @$jobOpening->title }}</td>
                            </tr>
                            <tr>
                                <td>Total Candidates</td>
                                <td>{{ @$jobOpening->total_vacancies }}</td>
                            </tr>
                            <tr>
                                <td>Application Deadline</td>
                                <td>{{ @$jobOpening->application_deadline }}</td>
                            </tr>
                            <tr>
                                <td>Salary</td>
                                <td>{{ @$jobOpening->title }}</td>
                            </tr>
                            <tr>
                                <td>Experience</td>
                                <td>{{ @$jobOpening->experience }}</td>
                            </tr>
                            <tr>
                                <td>Skills</td>
                                <td>{{ @$jobOpening->skills }}</td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td>{{ @$jobOpening->department->title }}</td>
                            </tr>
                            <tr>
                                <td>Designation</td>
                                <td>{{ @$jobOpening->designation->title }}</td>
                            </tr>
                            <tr>
                                <td>Division</td>
                                <td>{{ @$jobOpening->division->title }}</td>
                            </tr>
                            <tr>
                                <td>Job Description</td>
                                <td>{{ @$jobOpening->description }}</td>
                            </tr>
                            <tr>
                                <td>Job Offerings</td>
                                <td>{{ @$jobOpening->offerings }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-success float-end" href="{{ route('job-opening.edit', $jobOpening->id) }}">Edit</a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
