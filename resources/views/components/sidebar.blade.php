<ul class="accordion-menu">
    <li class="sidebar-title">
        Apps
    </li>
    <li class="{{ request()->is('dashboard') ? 'active-page' : '' }}">
        <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}"><i
                class="material-icons-two-tone">dashboard</i>Dashboard</a>
    </li>
    <li class="{{ request()->is('dashboard/employee*') ? 'active-page' : '' }}">
        <a href="#"><i class="material-icons-two-tone">badge</i>Employee<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
        <ul class="sub-menu">
            <li>
                <a class="{{ request()->is('dashboard/employee/create') ? 'active' : '' }}"
                   href="{{ route('employee.create') }}">Add Employee</a>
            </li>
            <li>
                <a class="{{ (request()->is('dashboard/employee*') && !request()->is('dashboard/employee/create')) ? 'active' : '' }}"
                   href="{{ route('employee.index') }}">Manage Employee</a>
            </li>
        </ul>
    </li>
    <li class="{{ request()->is('dashboard/attendance*') ? 'active-page' : '' }}">
        <a href="#"><i class="material-icons-two-tone">today</i>Attendance<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
        <ul class="sub-menu">
            <li>
                <a class="{{ request()->is('dashboard/attendance/create') ? 'active' : '' }}"
                   href="{{ route('attendance.create') }}">Today's Attendance</a>
            </li>
            <li>
                <a class="{{ (request()->is('dashboard/attendance*') && !request()->is('dashboard/attendance/create') && !request()->is('dashboard/attendance-calendar')) ? 'active' : '' }}"
                   href="{{ route('attendance.index') }}">Attendance Report</a>
            </li>
            <li>
                <a class="{{ request()->is('dashboard/attendance-calendar') ? 'active' : '' }}"
                   href="{{ route('attendance.calendar') }}">Attendance Calendar</a>
            </li>
        </ul>
    </li>
    <li class="{{ request()->is('dashboard/recruitment*') ? 'active-page' : '' }}">
        <a href="#"><i class="material-icons-two-tone">person_add</i>Recruitment<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
        <ul class="sub-menu">
            <li>
                <a class="{{ request()->is('dashboard/recruitment/job-opening') ? 'active' : '' }}"
                   href="{{ route('job-opening.index') }}">Job Openings</a>
            </li>
            <li>
                <a class="{{ request()->is('dashboard/recruitment/candidate/create') ? 'active' : '' }}"
                   href="{{ route('candidate.create') }}">Add Candidate</a>
            </li>
            <li>
                <a class="{{ request()->is('dashboard/recruitment/candidate') ? 'active' : '' }}"
                   href="{{ route('candidate.index') }}">Shortlist Candidate</a>
            </li>
            <li>
                <a class="{{ request()->is('dashboard/recruitment/interview/create') ? 'active' : '' }}"
                   href="{{ route('interview.create') }}">Add Interview</a>
            </li>
            <li>
                <a class="{{ request()->is('dashboard/recruitment/interview') ? 'active' : '' }}"
                   href="{{ route('interview.index') }}">Interviews</a>
            </li>
        </ul>
    </li>
    <li class="{{ request()->is('dashboard/leave*') ? 'active-page' : '' }}">
        <a href="#"><i class="material-icons-two-tone">exit_to_app</i>Leave<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
        <ul class="sub-menu">
            <li>
                <a class="{{ request()->is('dashboard/leave/leave-type') ? 'active' : '' }}"
                   href="{{ route('leave-type.index') }}">Leave Types</a>
            </li>
            <li>
                <a class="{{ request()->is('dashboard/leave/holiday') ? 'active' : '' }}"
                   href="{{ route('holiday.index') }}">Holidays</a>
            </li>
            <li>
                <a class="{{ request()->is('dashboard/leave/leave') ? 'active' : '' }}"
                   href="{{ route('leave.index') }}">Leave Applications</a>
            </li>
        </ul>
    </li>
    <li class="{{ request()->is('dashboard/payroll*') ? 'active-page' : '' }}">
        <a href="#"><i class="material-icons-two-tone">payments</i>Payroll<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
        <ul class="sub-menu">
            <li>
                <a class="{{ request()->is('dashboard/payroll/salary-type') ? 'active' : '' }}"
                   href="{{ route('salary-type.index') }}">Salary Types</a>
            </li>
            <li>
                <a class="{{ request()->is('dashboard/payroll/salary-setup') ? 'active' : '' }}"
                   href="{{ route('salary-setup.index') }}">Salary Setup</a>
            </li>
            <li>
                <a class="{{ request()->is('dashboard/payroll/salary-generate') ? 'active' : '' }}"
                   href="{{ route('salary-generate.index') }}">Salary Generate</a>
            </li>
        </ul>
    </li>
    <li class="{{ request()->is('dashboard/setting*') ? 'active-page' : '' }}">
        <a href="#"><i class="material-icons-two-tone">settings</i>Settings<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
        <ul class="sub-menu">
            <li>
                <a class="{{ request()->is('dashboard/settings/designation') ? 'active' : '' }}"
                   href="{{ route('designation.index') }}">Designations</a>
            </li>
            <li>
                <a class="{{ request()->is('dashboard/settings/department') ? 'active' : '' }}"
                   href="{{ route('department.index') }}">Departments</a>
            </li>
            @if(get_setting('division_enabled'))
                <li>
                    <a class="{{ request()->is('dashboard/settings/division') ? 'active' : '' }}"
                       href="{{ route('division.index') }}">Divisions</a>
                </li>
            @endif
            <li>
                <a class="{{ request()->is('dashboard/setting') ? 'active' : '' }}"
                   href="{{ route('setting.index') }}">General Settings</a>
            </li>
        </ul>
    </li>
</ul>
