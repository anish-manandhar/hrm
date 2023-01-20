<x-app-layout>
    @section('page_title', @$page_title)
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header row">
                        <h5 class="card-title text-center">Basic Info</h5><br>
                    </div>
                    <div class="card-body row">
                        <div class="row">
                            <div class="col-6">
                                <h5 style="font-weight: bold">Profile Image</h5><br>
                                <img src="{{ @$employee->getFirstMediaUrl('image') }}" alt="">
                            </div>
                            <div class="col-6">
                                <div>
                                    <h5 style="font-weight: bold">Employee ID :</h5><br>
                                    <h5>{{ @$employee->prefix_id }}</h5><br>
                                </div>
                                <div>
                                    <h5 style="font-weight: bold">Employee Name :</h5><br>
                                    <h5>{{ @$employee->name }}</h5><br>
                                </div>
                                <div>
                                    <h5 style="font-weight: bold">Employee Email :</h5><br>
                                    <h5>{{ @$employee->email }}</h5><br>
                                    <h5>{{ @$employee->employee->alt_email }}</h5><br>
                                </div>
                                <div>
                                    <h5 style="font-weight: bold">Employee Phone Number :</h5><br>
                                    <h5>{{ @$employee->phone }}</h5><br>
                                    <h5>{{ @$employee->employee->alt_phone }}</h5><br>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header row">
                        <h5 class="card-title text-center">Offical Info</h5><br>
                    </div>
                    <div class="card-body row">
                        <div class="row">
                            <div class="col-3">
                                <h5 style="font-weight: bold">Department :</h5><br>
                                <h5>{{ @$employee->employee->getDepartment->title }}</h5><br>
                            </div>
                            <div class="col-3">
                                <h5 style="font-weight: bold">Designation :</h5><br>
                                <h5>{{ @$employee->employee->getDesignation->title }}</h5><br>
                            </div>
                            <div class="col-3">
                                <h5 style="font-weight: bold">Division :</h5><br>
                                <h5>{{ @$employee->employee->getDivison->title }}</h5><br>
                            </div>
                            <div class="col-3">
                                <h5 style="font-weight: bold">Joined Date :</h5><br>
                                <h5>{{ @$employee->employee->joining_date }}</h5><br>
                            </div>
                            <div class="col-3">
                                <h5 style="font-weight: bold">Salary :</h5><br>
                                <h5>{{ @$employee->employee->salary }}</h5><br>
                            </div>
                            <div class="col-3">
                                <h5 style="font-weight: bold">Salary Period :</h5><br>
                                <h5>{{ @$employee->employee->salary_period }}</h5><br>
                            </div>

                            <div class="col-3">
                                <h5 style="font-weight: bold">Duty Type :</h5><br>
                                <h5>{{ @$employee->employee->duty_type }}</h5><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header row">
                        <h5 class="card-title text-center">Biographical Info</h5><br>
                    </div>
                    <div class="card-body row">
                        <div class="row">
                            <div class="col-3">
                                <h5 style="font-weight: bold">Gender :</h5><br>
                                <h5>{{ @$employee->employee->gender }}</h5><br>
                            </div>
                            <div class="col-3">
                                <h5 style="font-weight: bold">Date of Birth :</h5><br>
                                <h5>{{ @$employee->employee->dob }}</h5><br>
                            </div>
                            <div class="col-3">
                                <h5 style="font-weight: bold">Blood Group :</h5><br>
                                <h5>{{ @$employee->employee->blood_group }}</h5><br>
                            </div>
                            <div class="col-3">
                                <h5 style="font-weight: bold">Marital Status :</h5><br>
                                <h5>{{ @$employee->employee->marital_status }}</h5><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header row">
                        <h5 class="card-title text-center">Additional Info</h5><br>
                    </div>
                    <div class="card-body row">
                        <div class="row">
                            <div class="col-6">
                                <h5 style="font-weight: bold">PAN :</h5><br>
                                <h5>{{ @$employee->employee->pan }}</h5><br>
                            </div>
                            <div class="col-6">
                                <h5 style="font-weight: bold">Citizenship :</h5><br>
                                <h5>{{ @$employee->employee->citizenship }}</h5><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header row">
                        <h5 class="card-title text-center">Emergency Contact Info</h5><br>
                    </div>
                    <div class="card-body row">
                        <div class="row">
                            <div class="col-6">
                                <h5 style="font-weight: bold">Emergency Contact Person Name:</h5><br>
                                <h5>{{ @$employee->employee->emergency_contact_person_name }}</h5><br>
                            </div>
                            <div class="col-6">
                                <h5 style="font-weight: bold">Emergency Contact Person Contact:</h5><br>
                                <h5>{{ @$employee->employee->emergency_contact_person_contact }}</h5><br>
                            </div>
                            <div class="col-6">
                                <h5 style="font-weight: bold">Emergency Contact Person Address:</h5><br>
                                <h5>{{ @$employee->employee->emergency_contact_person_address }}</h5><br>
                            </div>
                            <div class="col-6">
                                <h5 style="font-weight: bold">Emergency Contact Person Relation:</h5><br>
                                <h5>{{ @$employee->employee->emergency_contact_person_relation }}</h5><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header row">
                        <h5 class="card-title text-center">Salary Generator Info</h5><br>
                    </div>
                    <div class="card-body row">
                        <div class="row">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Wage</th>
                                    <th>Gross Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Basic Pay</td>
                                    <td>{{ @$employee->employee->salary }}</td>
                                </tr>
                                @forelse(json_decode($employee->salary->salary_details) as $id => $wage)
                                    @php
                                        $salary_type = \App\Models\SalaryType::findOrFail($id);
                                    @endphp
                                    <tr>
                                        <td>{{ $salary_type->title }}</td>
                                        <td>{{ $wage }}{{ $salary_type->per_amt == 'Percentage' ? '%' : ''}}</td>
                                    </tr>
                                @empty
                                @endforelse                                
                                <tr>
                                    <td style="font-weight: bold">Gross Salary</td>
                                    <td style="font-weight: bold">{{ @$employee->salary->gross_amount }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header row">
                        <h5 class="card-title text-center">Bank Info</h5><br>
                    </div>
                    <div class="card-body row">
                        <div class="row">
                            <div class="col-6">
                                <h5 style="font-weight: bold">Bank Name:</h5><br>
                                <h5>{{ @$employee->employee->bank_name }}</h5><br>
                            </div>
                            <div class="col-6">
                                <h5 style="font-weight: bold">Bank Branch:</h5><br>
                                <h5>{{ @$employee->employee->bank_branch }}</h5><br>
                            </div>
                            <div class="col-6">
                                <h5 style="font-weight: bold">Account Holder Name:</h5><br>
                                <h5>{{ @$employee->employee->account_holder_name }}</h5><br>
                            </div>
                            <div class="col-6">
                                <h5 style="font-weight: bold">Bank Account No. :</h5><br>
                                <h5>{{ @$employee->employee->bank_account_no }}</h5><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header row">
                        <h5 class="card-title text-center">Previous Organization Info</h5><br>
                    </div>
                    <div class="card-body row">
                        <div class="row">
                            <div class="col-6">
                                <h5 style="font-weight: bold">Organization Name:</h5><br>
                                <h5>{{ @$employee->employee->organization_name }}</h5><br>
                            </div>
                            <div class="col-6">
                                <h5 style="font-weight: bold">Organization Contact:</h5><br>
                                <h5>{{ @$employee->employee->organization_contact }}</h5><br>
                            </div>
                            <div class="col-6">
                                <h5 style="font-weight: bold">Organization Address:</h5><br>
                                <h5>{{ @$employee->employee->organization_address }}</h5><br>
                            </div>
                            <div class="col-6">
                                <h5 style="font-weight: bold">HR Name:</h5><br>
                                <h5>{{ @$employee->employee->hr_name }}</h5><br>
                            </div>
                            <div class="col-6">
                                <h5 style="font-weight: bold">HR Contact:</h5><br>
                                <h5>{{ @$employee->employee->hr_contact }}</h5><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header row">
                        <h5 class="card-title text-center">Attendance Info</h5><br>
                    </div>
                    <div class="card-body row">
                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Date</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Stays</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendance as $key => $data )
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ readableDate($data->date, 'ymd') }}</td>
                                            <td>
                                                @forelse($data->checkInCheckOuts as $checkIn)
                                                    {{ readableDate($checkIn->check_in,'time') }}<br>
                                                @empty
                                                @endforelse
                                            </td>
                                            <td>
                                                @forelse($data->checkInCheckOuts as $checkOut)
                                                    {{ readableDate($checkOut->check_out,'time') }}<br>
                                                @empty
                                                @endforelse
                                            </td>
                                            <td>
                                                @php
                                                    $stay = 0;
                                                    foreach ($data->checkInCheckOuts as $stayInSecond){
                                                        $stay = $stay + $stayInSecond->stay_in_seconds;
                                                    }
                                                @endphp
                                                {{ getTimeFromSeconds($stay) }}
                                            </td>
                                        </tr>
                                    @endforeach                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-success float-end" href="{{ route('employee.edit', $employee->id) }}">Edit</a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
