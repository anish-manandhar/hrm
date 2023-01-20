<x-app-layout>
    @section('page_title', @$page_title)
    @push('css')
        <link href="{{ asset('assets/plugins/highlight/styles/github-gist.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    @endpush
    @push('js')
        <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/highlight/highlight.pack.js') }}"></script>
        <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/select2.js') }}"></script>
        <script>
            $('.select').select2();
        </script>
    @endpush
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="page-description page-description-tabbed">
                    <h1>Settings</h1>

                    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="account-tab" data-bs-toggle="tab"
                                    data-bs-target="#account" type="button" role="tab" aria-controls="account"
                                    aria-selected="true">Account
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sms-tab" data-bs-toggle="tab" data-bs-target="#sms"
                                    type="button" role="tab" aria-controls="sms" aria-selected="false">SMS Settings
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="integrations-tab" data-bs-toggle="tab"
                                    data-bs-target="#integrations" type="button" role="tab" aria-controls="integrations"
                                    aria-selected="false">Integrations
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="employee-tab" data-bs-toggle="tab" data-bs-target="#employee"
                                    type="button" role="tab" aria-controls="employee" aria-selected="false">Employee
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                        <div class="card">
                            {{ Form::open(['url' => route('setting.store'), 'files' => true, 'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="settingsOrganizationName" class="form-label">Organization
                                            Name</label>
                                        <input type="text" class="form-control" id="settingsOrganizationName"
                                               aria-describedby="settingsOrganizationHelp"
                                               value="{{ get_setting('organization_name') }}" name="organization_name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="settingsOrganizationShortName" class="form-label">Organization Short
                                            Name</label>
                                        <input type="text" class="form-control" id="settingsOrganizationShortName"
                                               name="organization_short_name"
                                               value="{{ get_setting('organization_short_name') }}">
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col-md-6">
                                        <label for="settingsOrganizationLogo" class="form-label">Organization
                                            Logo</label>
                                        <input type="file" class="form-control" id="settingsOrganizationLogo"
                                               name="OrgLogo">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="settingsSlogan" class="form-label">Slogan</label>
                                        <input type="text" class="form-control" id="settingsSlogan" name="slogan"
                                               value="{{ get_setting('slogan') }}">
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col-md-6">
                                        <label for="settingsDetailAddress" class="form-label">Detail Address</label>
                                        <input type="text" class="form-control" id="settingsDetailAddress"
                                               name="detail_address" value="{{ get_setting('detail_address') }}"
                                               placeholder="Address">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="settingsCountry" class="form-label">Country</label>
                                        <input type="text" class="form-control" id="settingsCountry"
                                               name="country" value="{{ get_setting('country') }}"
                                               placeholder="Country">
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col-md-6">
                                        <label for="settingsPrimaryNumber" class="form-label">Primary Number</label>
                                        <input type="text" class="form-control" id="settingsPrimaryNumber"
                                               name="primary_phone" value="{{ get_setting('primary_phone') }}"
                                               placeholder="98xxxxxxx">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="settingsSecondaryNumber" class="form-label">Secondary Number</label>
                                        <input type="text" class="form-control" id="settingsSecondaryNumber"
                                               name="secondary_phone" value="{{ get_setting('secondary_phone') }}"
                                               placeholder="98xxxxxxxx">
                                    </div>
                                </div>

                                <div class="row m-t-lg">
                                    <div class="col-md-6">
                                        <label for="settingsEmployeePrefix" class="form-label">Employee Prefix</label>
                                        <input type="text" class="form-control" id="settingsEmployeePrefix" disabled
                                               name="employee_prefix" value="{{ get_setting('employee_prefix') }}"
                                               placeholder="Ex: UTS-">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="settingsWeeklyHoliday" class="form-label">Weekly Holiday</label>
                                        {{ Form::select('weekly_holidary[]', ['Monday' => 'Monday','Tuesday' => 'Tuesday','Wednesday' => 'Wednesday','Thursday' => 'Thursday','Friday' => 'Friday','Saturday' => 'Saturday','Sunday' => 'Sunday'], json_decode(get_setting('weekly_holiday')), ['class' => 'form-select', 'multiple' => true, 'id' => 'settingsWeeklyHoliday']) }}
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary m-t-sm">Update</button>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sms" role="tabpanel" aria-labelledby="sms-tab">
                        <div class="card">
                            {{ Form::open(['url' => route('setting.store'), 'files' => true, 'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="settingSmsIdentity" class="form-label">Sparrow SMS Identity</label>
                                        <input type="text" class="form-control" id="settingSmsIdentity"
                                               value="{{ get_setting('sms_identity') }}" name="sms_identity">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="settingSmsToken" class="form-label">Sparrow SMS Token</label>
                                        <input type="text" class="form-control" id="settingSmsToken"
                                               value="{{ get_setting('sms_token') }}" name="sms_token">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="settingSmsAPI" class="form-label">Sparrow SMS API</label>
                                        <input type="text" class="form-control" id="settingSmsAPI"
                                               value="{{ get_setting('sms_api') }}" name="sms_api">
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary m-t-sm">Update</button>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="integrations" role="tabpanel" aria-labelledby="integrations-tab">
                        <div class="card">
                            <div class="card-body">
                                <div class="settings-integrations">
                                    <div class="settings-integrations-item">
                                        <div class="settings-integrations-item-info">
                                            <img src="../../assets/images/icons/jira_software.png" alt="">
                                            <span>Plan, track, and manage your agile and software development projects in Jira.</span>
                                        </div>
                                        <div class="settings-integrations-item-switcher">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input form-control-md" type="checkbox"
                                                       id="settingsIntegrationOneSwitcher" checked>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="settings-integrations-item">
                                        <div class="settings-integrations-item-info">
                                            <img src="../../assets/images/icons/confluence.png" alt="">
                                            <span>Build, organize, and collaborate on work in one place from virtually anywhere.</span>
                                        </div>
                                        <div class="settings-integrations-item-switcher">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input form-control-md" type="checkbox"
                                                       id="settingsIntegrationTwoSwitcher" checked>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="settings-integrations-item">
                                        <div class="settings-integrations-item-info">
                                            <img src="../../assets/images/icons/bitbucket.png" alt="">
                                            <span>Build, test, and deploy with unlimited private or public space with Bitbucket.</span>
                                        </div>
                                        <div class="settings-integrations-item-switcher">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input form-control-md" type="checkbox"
                                                       id="settingsIntegrationThreeSwitcher">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="settings-integrations-item">
                                        <div class="settings-integrations-item-info">
                                            <img src="../../assets/images/icons/sourcetree.png" alt="">
                                            <span>A Git GUI that offers a visual representation of your repositories.</span>
                                        </div>
                                        <div class="settings-integrations-item-switcher">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input form-control-md" type="checkbox"
                                                       id="settingsIntegrationFourSwitcher">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="employee" role="tabpanel" aria-labelledby="employee-tab">
                        <div class="card">
                            <livewire:setting-bool-input/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
