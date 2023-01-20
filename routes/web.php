<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\JobOpeningController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\SalaryGenerateController;
use App\Http\Controllers\Admin\SalarySetupController;
use App\Http\Controllers\Admin\SalaryTypeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\InterviewController;
use Illuminate\Support\Facades\Route;

Route::get('/clear-cache', function () {
    $value = Artisan::call('optimize:clear');
    echo($value);
})->name('optimize:clear');

Route::get('/', function () {
    return redirect('/login');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified']], function ($router) {
    $router->get('/', [DashboardController::class, 'index'])->name('dashboard');

//    Employee
    $router->resource('employee', EmployeeController::class);
    $router->get('employee/ex/{id}', [EmployeeController::class, 'exEmployee'])->name('employee.ex');
    $router->post('employee/notice-period/{id}', [EmployeeController::class, 'noticePeriodEmployee'])->name('employee.notice-period');
    $router->get('employee/active/{id}', [EmployeeController::class, 'active'])->name('employee.active');
    $router->resource('attendance', AttendanceController::class);
    $router->get('attendance-calendar', [AttendanceController::class, 'calendar'])->name('attendance.calendar');
    $router->resource('setting', SettingController::class);
    $router->group(['prefix' => 'settings'], function ($router) {
        $router->resource('department', DepartmentController::class);
        $router->resource('designation', DesignationController::class);
        $router->resource('division', DivisionController::class);
    });

//    Recruitment
    $router->group(['prefix' => 'recruitment'], function ($router) {
        $router->resource('job-opening', JobOpeningController::class);
        $router->resource('candidate', CandidateController::class);
        $router->get('candidate/shortlist/{id}', [CandidateController::class, 'shortlist'])->name('candidate.shortlist');
        $router->resource('interview', InterviewController::class);
        $router->get('candidate/select/{id}', [InterviewController::class, 'select'])->name('interview.select');
        $router->get('candidate/send-notification/{id}', [InterviewController::class, 'sendNotification'])->name('interview.send-notification');
    });
//    Leave
    $router->group(['prefix' => 'leave'], function ($router) {
        $router->resource('leave-type', LeaveTypeController::class);
        $router->resource('holiday', HolidayController::class);
        $router->resource('leave', LeaveController::class);
    });
//    Payroll
    $router->group(['prefix' => 'payroll'], function ($router) {
        $router->resource('salary-type', SalaryTypeController::class);
        $router->resource('salary-setup', SalarySetupController::class);
        $router->resource('salary-generate', SalaryGenerateController::class);
    });

});
