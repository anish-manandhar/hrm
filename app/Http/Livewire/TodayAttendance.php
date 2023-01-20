<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use App\Models\CheckInCheckOut;
use Carbon\Carbon;
use Livewire\Component;

class TodayAttendance extends Component
{
    public function render()
    {
        $attendances = Attendance::where('date', Carbon::now()->format('Y-m-d'))->orderBy('user_id')->get();
        $data = [
            'page_title' => "Today's Attendance",
            'data' => $attendances
        ];
        return view('livewire.today-attendance', $data);
    }

    public function checkIn($user_id)
    {
        $previous_attendance = Attendance::where('date', Carbon::now()->format('Y-m-d'))->where('user_id', $user_id)->first();
        CheckInCheckOut::create([
            'created_by' => auth()->user()->id,
            'check_in' => Carbon::now(),
            'attendance_id' => $previous_attendance->id,
        ]);
    }

    public function checkOut($user_id)
    {
        $attendance = Attendance::where('date', Carbon::now()->format('Y-m-d'))->where('user_id', $user_id)->first();
        $check = CheckInCheckOut::where('attendance_id', $attendance->id)->whereNull('check_out')->first();
        $check->update([
            'check_out' => Carbon::now(),
            'stay_in_seconds' => Carbon::now()->diffInSeconds($check->check_in),
        ]);
    }
}
