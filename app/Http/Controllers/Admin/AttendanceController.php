<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct(Attendance $attendance, User $employee)
    {
        $this->attendance = $attendance;
        $this->employee = $employee;
        $this->route = 'attendance';
    }

    protected function getData($request)
    {
        $query = $this->attendance->orderBy('id', 'DESC');
        if ($request->start_date) {
            $query = $query->where('date', '>', $request->start_date);
        }
        if ($request->end_date) {
            $query = $query->where('date', '<', $request->end_date);
        }
        return $query->pluck('date');
    }

    public function index(Request $request)
    {
        $dates_id = $this->getData($request);
        $dates = $this->attendance->whereIn('date', $dates_id)->select('date')->groupBy('date')->pluck('date');
        $data = [];
        foreach ($dates as $date) {
            $total_employee = $this->attendance->where('date', $date)->count();
            $present_employee = $this->attendance->where('date', $date)->whereHas('checkInCheckOuts')->count();
            $absent_employee = $total_employee - $present_employee;
            $data[] = [
                'date' => $date,
                'total_employee' => $total_employee,
                'present_employee' => $present_employee,
                'absent_employee' => $absent_employee,
            ];
        }
        $data = [
            'page_title' => 'Attendance Report',
            'data' => $data
        ];
        return view('admin.attendance.index', $data);
    }

    public function calendar()
    {
        $dates = $this->attendance->select('date')->groupBy('date')->pluck('date');
        foreach ($dates as $date) {
            $total_employee = $this->attendance->where('date', $date)->count();
            $present_employee = $this->attendance->where('date', $date)->whereHas('checkInCheckOuts')->count();
            $absent_employee = $total_employee - $present_employee;
            $data[] = [
                'date' => $date,
                'total_employee' => $total_employee,
                'present_employee' => $present_employee,
                'absent_employee' => $absent_employee,
            ];
        }
        $data = [
            'page_title' => 'Attendance Calendar',
            'data' => $data
        ];
        return view('admin.attendance.calendar', $data);
    }

    public function create()
    {
        $todayAttendance = $this->attendance->where('date', Carbon::now()->format('Y-m-d'))->get();
        if (!count($todayAttendance)) {
            foreach ($this->employee->get() as $employee) {
                $this->attendance->create([
                    'date' => Carbon::now()->format('Y-m-d'),
                    'user_id' => $employee->id,
                    'created_by' => auth()->user()->id,
                ]);
            }
        }
        $data = [
            'page_title' => "Today's Attendance",
        ];
        return view('admin.attendance.today', $data);
    }

    public function show($id)
    {
        $attendances = Attendance::where('date', Carbon::now()->format('Y-m-d'))->orderBy('user_id')->get();
        $data = [
            'page_title' => $id . "'s Attendance",
            'data' => $attendances,
        ];
        return view('admin.attendance.show', $data);
    }
}
