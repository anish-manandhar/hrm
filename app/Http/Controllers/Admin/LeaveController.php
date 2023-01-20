<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveController extends Controller
{
    public function __construct(Leave $leave)
    {
        $this->leave = $leave;
        $this->route = 'leave';
    }

    public function index()
    {
        $leaves = $this->leave->paginate(20);
        $data = [
            'page_title' => 'Leave Application',
            'data' => $leaves
        ];
        return view('admin.leave.application.index', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'employee_id' => 'required|exists:users,id',
            'leave_type_id' => 'required|exists:leave_types,id'
        ]);
        try {
            DB::beginTransaction();
            $dates = explode(' to ', $request->dates);
            $start = \DateTime::createFromFormat('Y-m-d', $dates[0]);
            $end = \DateTime::createFromFormat('Y-m-d', $dates[1]);
            $interval = $start->diff($end);
            $days = $interval->format('%a');
            $this->leave->create([
                'employee_id' => strip_tags($request->employee_id),
                'leave_type_id' => strip_tags($request->leave_type_id),
                'start_date' => $start,
                'end_date' => $end,
                'days' => $days,
                'remarks' => strip_tags($request->remarks),
            ]);
            DB::commit();
            showNotification('Division created successfully');
            return back();
        } catch (\Throwable $error) {
            DB::rollBack();
            if (config('app.debug'))
                dd($error->getMessage());
            showNotification($error->getMessage(), 'error');
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            DB::commit();
            return back();
        } catch (\Throwable $error) {
            DB::rollBack();
            return back();
        }
    }
}
