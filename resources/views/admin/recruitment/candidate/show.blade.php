<x-app-layout>
    @section('page_title', @$page_title)
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                {{--Basic Info--}}
                <div class="card">
                    <div class="card-header row">
                        <h5 class="card-title text-center">Basic Info</h5><br><br>
                    </div>
                    <div class="card-body row">
                        <div class="row">
                            <div class="col-6">
                                <h5 style="font-weight: bold">Name :</h5><br>
                                <h5>{{ @$candidate->name }}</h5><br>
                            </div>
                            <div class="col-6">
                                <h5 style="font-weight: bold">Job Applied For :</h5><br>
                                <h5>{{ @$candidate->jobOpening->title }}</h5><br>
                            </div>
                            <div class="col-6">
                                <h5 style="font-weight: bold">Email :</h5><br>
                                <h5>{{ @$candidate->email }}</h5><br>
                                <h5>{{ @$candidate->alt_email }}</h5><br>
                            </div>
                            <div class="col-6">                            
                                <h5 style="font-weight: bold">Phone Number :</h5><br>
                                <h5>{{ @$candidate->phone }}</h5><br>
                                <h5>{{ @$candidate->alt_phone }}</h5><br>
                            </div>
                        </div>
                    </div>
                </div>
                {{--Official Info--}}
                <div class="card">
                    <div class="card-header row">
                        <h5 class="card-title text-center">Offical Info</h5><br><br>
                    </div>
                    <div class="card-body row">
                        <div class="row">
                            <div class="col-4">
                                <h5 style="font-weight: bold">Salary Expectation :</h5><br>
                                <h5>{{ @$candidate->salary_expectation }}</h5><br>
                            </div>
                            <div class="col-4">
                                <h5 style="font-weight: bold">Salary Period :</h5><br>
                                <h5>{{ @$candidate->salary_period }}</h5><br>
                            </div>
                            <div class="col-4">
                                <h5 style="font-weight: bold">Duty Type :</h5><br>
                                <h5>{{ @$candidate->duty_type }}</h5><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                {{--Biographical Info--}}
                <div class="card">
                    <div class="card-header row">
                        <h5 class="card-title text-center">Biographical Info</h5><br><br>
                    </div>
                    <div class="card-body row">
                        <div class="row">
                            <div class="col-4">
                                <h5 style="font-weight: bold">Date of Birth</h5><br>
                                <h5>{{ @$candidate->dob }}</h5><br>
                            </div>
                            <div class="col-4">
                                <h5 style="font-weight: bold">Gender :</h5><br>
                                <h5>{{ @$candidate->gender }}</h5><br>
                            </div>
                            <div class="col-4">
                                <h5 style="font-weight: bold">Marital Status :</h5><br>
                                <h5>{{ @$candidate->marital_status }}</h5><br>
                            </div>
                        </div>
                    </div>
                </div>
                {{--Additional Info--}}
                <div class="card">
                    <div class="card-header row">
                        <h5 class="card-title text-center">Additional Info</h5><br><br>
                    </div>
                    <div class="card-body row">
                        <div class="row">
                            <div class="col-4">
                                <h5 style="font-weight: bold">PAN No :</h5><br>
                                <h5>{{ @$candidate->pan }}</h5><br>
                            </div>
                            <div class="col-4">
                                <h5 style="font-weight: bold">citizenship :</h5><br>
                                <h5>{{ @$candidate->citizenship }}</h5><br>
                            </div>
                            <div class="col-4">
                                <h5 style="font-weight: bold">Street Address :</h5><br>
                                <h5>{{ @$candidate->street_address }}</h5><br>
                            </div>
                        </div>
                    </div>
                </div>
                {{--Previous Organization Info--}}
                <div class="card">
                    <div class="card-header row">
                        <h5 class="card-title text-center">Previous Organization Info</h5><br><br>
                    </div>
                    <div class="card-body row">
                        <div class="row">
                            <div class="col-6">
                                <h5 style="font-weight: bold">Organization Name:</h5><br>
                                <h5>{{ @$candidate->organization_name }}</h5><br>
                            </div>
                            <div class="col-6">
                                <h5 style="font-weight: bold">Organization Contact:</h5><br>
                                <h5>{{ @$candidate->organization_contact }}</h5><br>
                            </div>
                            <div class="col-6">
                                <h5 style="font-weight: bold">Organization Address:</h5><br>
                                <h5>{{ @$candidate->organization_address }}</h5><br>
                            </div>
                            <div class="col-6">
                                <h5 style="font-weight: bold">HR Name:</h5><br>
                                <h5>{{ @$candidate->hr_name }}</h5><br>
                            </div>
                            <div class="col-6">
                                <h5 style="font-weight: bold">HR Contact:</h5><br>
                                <h5>{{ @$candidate->hr_contact }}</h5><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-success float-end" href="{{ route('candidate.edit', $candidate->id) }}">Edit</a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
